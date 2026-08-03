<?php
/**
 * Shared Etegram verification + crediting logic.
 *
 * Used by:
 *  - user/deposit/status/index.php (initial page load)
 *  - server/api/etegram_verify.php (30s AJAX poll from the status page)
 *  - server/api/etegram_verify.php with action=expire (countdown ran out)
 *
 * Keeping this in one place means the page load, the poll, and the
 * expiry check can never disagree about what counts as "paid".
 */

if (!function_exists('etegram_find_deposit')) {

    function etegram_find_deposit(mysqli $connection, int $userId, string $lookup): ?array
    {
        // Etegram may hand back either `reference` or `access_code` on
        // redirect (their docs aren't explicit), so we match either.
        $stmt = mysqli_prepare(
            $connection,
            "SELECT *, TIMESTAMPDIFF(SECOND, created_at, NOW()) AS elapsed_seconds
             FROM deposits
             WHERE (reference = ? OR access_code = ?) AND user = ? AND method = 'etegram' LIMIT 1"
        );
        mysqli_stmt_bind_param($stmt, "ssi", $lookup, $lookup, $userId);
        mysqli_stmt_execute($stmt);
        $deposit = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        return $deposit ?: null;
    }
}

if (!function_exists('etegram_credit_deposit')) {

    /**
     * Marks a deposit approved and credits the user's balance.
     * Locked + idempotent: safe to call from multiple overlapping
     * requests (page load + poll racing each other) without double
     * crediting.
     */
    function etegram_credit_deposit(mysqli $connection, array $deposit, int $userId): array
    {
        mysqli_begin_transaction($connection);
        try {
            $lock = mysqli_prepare($connection, "SELECT status FROM deposits WHERE id = ? FOR UPDATE");
            mysqli_stmt_bind_param($lock, "i", $deposit['id']);
            mysqli_stmt_execute($lock);
            $current = mysqli_fetch_assoc(mysqli_stmt_get_result($lock));

            if ($current && $current['status'] === 'pending') {
                $updateDeposit = mysqli_prepare($connection, "UPDATE deposits SET status = 'approved' WHERE id = ?");
                mysqli_stmt_bind_param($updateDeposit, "i", $deposit['id']);
                mysqli_stmt_execute($updateDeposit);

                $updateBalance = mysqli_prepare($connection, "UPDATE users SET balance = balance + ? WHERE id = ?");
                mysqli_stmt_bind_param($updateBalance, "di", $deposit['amount_in_dollar'], $userId);
                mysqli_stmt_execute($updateBalance);
            }

            mysqli_commit($connection);
            $deposit['status'] = 'approved';
            return ['outcome' => 'success', 'message' => "Payment confirmed! Your balance has been updated.", 'deposit' => $deposit];
        } catch (Throwable $e) {
            mysqli_rollback($connection);
            return ['outcome' => 'error', 'message' => "We verified your payment but couldn't update your balance. Please contact support with reference {$deposit['reference']}.", 'deposit' => $deposit];
        }
    }
}

if (!function_exists('etegram_verify_deposit')) {

    function etegram_verify_deposit(mysqli $connection, int $userId, string $lookup): array
    {
        $deposit = etegram_find_deposit($connection, $userId, $lookup);

        if (!$deposit) {
            return ['outcome' => 'error', 'message' => "We couldn't find that deposit on your account.", 'deposit' => null];
        }

        if ($deposit['status'] === 'approved') {
            return ['outcome' => 'already', 'message' => "This deposit has already been confirmed and credited to your balance.", 'deposit' => $deposit];
        }

        if ($deposit['status'] === 'declined') {
            return ['outcome' => 'failed', 'message' => "This payment wasn't completed, so it was declined.", 'deposit' => $deposit];
        }

        if (empty($deposit['access_code'])) {
            return ['outcome' => 'error', 'message' => "This deposit is missing verification details. Please contact support with reference {$deposit['reference']}.", 'deposit' => $deposit];
        }

        $url = "https://api-checkout.etegram.com/api/transaction/verify-payment/"
            . ETEGRAM_PROJECT_ID . "/" . $deposit['access_code'];

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST  => "PATCH",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_HTTPHEADER     => [
                "Authorization: Bearer " . ETEGRAM_PUBLIC_KEY,
                "Content-Type: application/json",
            ],
        ]);
        $response  = curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            return ['outcome' => 'pending', 'message' => "We couldn't reach Etegram just now. We'll keep trying automatically.", 'deposit' => $deposit];
        }

        // Etegram's verify endpoint replies with a plain human-readable
        // sentence rather than a structured status field, so we match
        // on the wording it's documented to return.
        $normalized = strtolower(trim($response));

        echo "Etegram verify response: $normalized\n"; // debug

        $receivedNotYet = strpos($normalized, "hasn't been recieved") !== false
            || strpos($normalized, "hasn't been received") !== false
            || strpos($normalized, "has not been recieved") !== false
            || strpos($normalized, "has not been received") !== false;

        $alreadyProcessed = strpos($normalized, "already been processed") !== false;

        $received = !$receivedNotYet && (
            strpos($normalized, "has been recieved") !== false
            || strpos($normalized, "has been received") !== false
        );

        if ($alreadyProcessed || $received) {
            return etegram_credit_deposit($connection, $deposit, $userId);
        }

        if ($receivedNotYet) {
            return ['outcome' => 'pending', 'message' => "Payment hasn't been received yet. We'll keep checking automatically.", 'deposit' => $deposit];
        }

        // Unrecognized response body — don't guess, stay pending and
        // let the countdown / next poll sort it out.
        return ['outcome' => 'pending', 'message' => "We couldn't confirm your payment status yet. We'll keep checking automatically.", 'deposit' => $deposit];
    }
}

if (!function_exists('etegram_expire_deposit')) {

    /**
     * Called when the on-page countdown runs out and payment still
     * hasn't been confirmed. Does one last live check with Etegram
     * before giving up, so we never decline a payment that actually
     * went through in the final seconds.
     */
    function etegram_expire_deposit(mysqli $connection, int $userId, string $lookup): array
    {
        $result = etegram_verify_deposit($connection, $userId, $lookup);

        if (in_array($result['outcome'], ['success', 'already'], true)) {
            return $result;
        }

        $deposit = $result['deposit'];
        if ($deposit && $deposit['status'] === 'pending') {
            $update = mysqli_prepare($connection, "UPDATE deposits SET status = 'declined' WHERE id = ?");
            mysqli_stmt_bind_param($update, "i", $deposit['id']);
            mysqli_stmt_execute($update);
            $deposit['status'] = 'declined';
        }

        return [
            'outcome'  => 'failed',
            'message'  => "This payment wasn't completed in time, so it was cancelled. No funds were deducted — feel free to try again.",
            'deposit'  => $deposit,
        ];
    }
}