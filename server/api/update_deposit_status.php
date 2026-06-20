<?php
/**
 * update_deposit_status.php
 * Approves or declines a deposit, adjusting the user's balance accordingly.
 *
 * Expects POST: action ('approve_deposit' | 'decline_deposit'), deposit_id
 * Returns JSON: { success: bool, status?: string, message?: string, error?: string }
 */

include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/admin.php';

header('Content-Type: application/json');

$action = $_POST['action'] ?? '';
$depositId = $_POST['deposit_id'] ?? null;

if (!ctype_digit((string) $depositId)) {
    echo json_encode(['success' => false, 'error' => 'Invalid deposit id.']);
    exit;
}
$depositId = (int) $depositId;

$stmt = mysqli_prepare($connection, "SELECT id, user, amount_in_dollar, status FROM deposits WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $depositId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$deposit = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$deposit) {
    echo json_encode(['success' => false, 'error' => 'Deposit not found.']);
    exit;
}

$amount = (float) $deposit['amount_in_dollar'];
$userId = (int) $deposit['user'];
$currentStatus = $deposit['status'];

if ($action === 'approve_deposit') {
    if ($currentStatus === 'pending' || $currentStatus === 'declined') {
        $upd = mysqli_prepare($connection, "UPDATE deposits SET status = 'approved' WHERE id = ?");
        mysqli_stmt_bind_param($upd, "i", $depositId);
        mysqli_stmt_execute($upd);
        mysqli_stmt_close($upd);

        $bal = mysqli_prepare($connection, "UPDATE users SET balance = balance + ? WHERE id = ?");
        mysqli_stmt_bind_param($bal, "di", $amount, $userId);
        mysqli_stmt_execute($bal);
        mysqli_stmt_close($bal);

        echo json_encode(['success' => true, 'status' => 'approved', 'message' => 'Deposit approved and balance credited.']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Deposit is already approved.']);
    }
    exit;
}

if ($action === 'decline_deposit') {
    if ($currentStatus !== 'declined') {
        $upd = mysqli_prepare($connection, "UPDATE deposits SET status = 'declined' WHERE id = ?");
        mysqli_stmt_bind_param($upd, "i", $depositId);
        mysqli_stmt_execute($upd);
        mysqli_stmt_close($upd);

        // If it was previously approved, claw back the credited balance.
        if ($currentStatus === 'approved') {
            $bal = mysqli_prepare($connection, "UPDATE users SET balance = balance - ? WHERE id = ?");
            mysqli_stmt_bind_param($bal, "di", $amount, $userId);
            mysqli_stmt_execute($bal);
            mysqli_stmt_close($bal);
        }

        echo json_encode(['success' => true, 'status' => 'declined', 'message' => 'Deposit declined.']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Deposit is already declined.']);
    }
    exit;
}

echo json_encode(['success' => false, 'error' => 'Unknown action.']);
