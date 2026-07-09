<?php

include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/user.php';

$flashError = '';

$data = mysqli_fetch_assoc(mysqli_query($connection, "SELECT usd_to_naria_rate FROM admin WHERE id = 1"));
$usd_to_naria_rate = $data['usd_to_naria_rate'];

/* ---------------------------------------------------------
   Figure out which "step" of the flow we're on:
   - form    : choose amount + method
   - payment : show bank / crypto details for an existing,
               unpaid deposit (identified by ?ref=...)
--------------------------------------------------------- */
$step    = 'form';
$ref     = $_GET['ref'] ?? null;
$deposit = null;
$account = null;

if ($ref) {
    $stmt = mysqli_prepare($connection, "SELECT * FROM deposits WHERE reference = ? AND user = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "si", $ref, $id);
    mysqli_stmt_execute($stmt);
    $deposit = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if (!$deposit) {
        $flashError = "We couldn't find that deposit. Please start again.";
    } else {
        $method = $deposit['method'];

        $stmt2 = mysqli_prepare($connection, "SELECT * FROM payment_account WHERE type = ? ORDER BY RAND() LIMIT 1");
        mysqli_stmt_bind_param($stmt2, "s", $method);
        mysqli_stmt_execute($stmt2);
        $account = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt2));

        $step = 'payment';
    }
}

/* ---------------------------------------------------------
   Step 1 submit: create the deposit record
--------------------------------------------------------- */
if (isset($_POST['deposit'])) {
    $method    = $_POST['method'];
    $reference = uniqid("dep_"); // unique transaction reference

    $amount           = (float) $_POST['amount'];
    $amount_in_naira  = $amount * $usd_to_naria_rate;
    $amount_in_dollar = $amount;

    $stmt = $connection->prepare("
        INSERT INTO deposits (user, method, amount, amount_in_dollar, reference, status)
        VALUES (?, ?, ?, ?, ?, 'pending')
    ");
    $stmt->bind_param("issss", $id, $method, $amount_in_naira, $amount_in_dollar, $reference);
    $stmt->execute();

    if ($method === "paystack") {

        $curl = curl_init();
        $callback_url = $domain . "user/deposit/status/";

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                "email" => $email,
                "amount" => $amount * 100, // Convert to kobo
                "reference" => $reference,
                "callback_url" => $callback_url
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer PAYSTACK_PUBLIC_KEY",
                "content-type: application/json",
                "cache-control: no-cache"
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response);

        if ($res->status === true) {
            
            echo "<script>window.location.href = '" . $res->data->authorization_url . "';</script>";
            exit;
        } else {
            $flashError = "Could not initialize Paystack payment. Please try again.";
        }
    }

    if ($method === "crypto") {
        if ($amount < $min_crypto_deposit) {
            $flashError = "Minimum deposit for crypto is \$$min_crypto_deposit.";
        } else {
            echo "<script>
              window.location.href = './?ref=$reference';
            </script>";
            exit;
        }
    }

    if ($method === "manual") {
        echo "<script>
          window.location.href = './?ref=$reference';
        </script>";
        exit;
    }
}

/* ---------------------------------------------------------
   Step 2 submit: user confirms they've sent payment
--------------------------------------------------------- */
if (isset($_POST['confirm_payment']) && $deposit) {
    $paidto_id = $account['id'] ?? null;

    $stmt3 = mysqli_prepare($connection, "UPDATE deposits SET paidto = ? WHERE reference = ?");
    mysqli_stmt_bind_param($stmt3, "is", $paidto_id, $ref);

    if (mysqli_stmt_execute($stmt3)) {
        echo "<script>
          window.location.href = './history/';
        </script>";
        exit;
    } else {
        $flashError = "Error updating your deposit. Please try again.";
    }
}

$pageTitle    = 'Deposit';
$pageSubtitle = 'Add funds to your account';
$activeNav    = 'Deposit';
include '../../components/client/_user_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-8">

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-u-muted mb-6">
      <?php if ($step === 'payment'): ?>
        <a href="./" class="hover:text-u-text transition-colors">Deposit</a>
        <i class="bi bi-chevron-right text-xs"></i>
        <span class="text-u-text font-medium">Complete payment</span>
      <?php else: ?>
        <span class="text-u-text font-medium">Deposit</span>
      <?php endif; ?>
    </div>

    <?php if ($step === 'form'): ?>

      <!-- Hero prompt -->
      <div class="mb-8">
        <h2 class="font-display text-2xl font-bold text-u-text mb-2">Make a deposit</h2>
        <p class="text-u-muted text-sm leading-relaxed">
          Choose how much you'd like to add and pick a payment method. Once your payment is
          confirmed your balance updates automatically. You can review past transactions on your
          <a href="./history/" class="text-blue-500 hover:underline font-medium">deposit history</a>.
        </p>
      </div>

      <?php if (!empty($flashError)): ?>
        <div class="mb-4 flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl px-4 py-3 text-sm">
          <i class="bi bi-exclamation-circle-fill text-rose-500 shrink-0"></i>
          <span><?php echo htmlspecialchars($flashError); ?></span>
        </div>
      <?php endif; ?>

      <form method="POST" class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm">

        <!-- Rate context -->
        <div class="px-6 pt-6 pb-2 border-b border-u-line">
          <p class="text-xs font-semibold uppercase tracking-wider text-u-muted mb-3">Exchange rate</p>
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shrink-0">
              <i class="bi bi-currency-exchange"></i>
            </div>
            <div>
              <p class="text-sm font-semibold text-u-text">$1 = ₦<?php echo number_format((float) $usd_to_naria_rate, 2); ?></p>
              <p class="text-xs text-u-muted">Live rate, updated by our team</p>
            </div>
          </div>
        </div>

        <!-- Compose -->
        <div class="px-6 py-5 space-y-5">

          <div>
            <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Amount in USD ($)</label>
            <input type="number" name="amount" id="amountUSD" min="0" step="0.01" required
              placeholder="0.00"
              class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text placeholder-u-muted/60 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
            <p class="text-xs text-u-muted mt-1.5">
              You will pay: <strong id="amountNGN" class="text-u-text font-mono">₦0.00</strong>
            </p>
          </div>

          <div>
            <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Payment method</label>
            <select name="method" required
              class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
              <option value="">Select method</option>
              <!-- <option value="paystack">Automatic Bank Transfer (Paystack)</option> -->
              <option value="crypto">Crypto (USDT)</option>
              <option value="manual">Manual Bank Payment</option>
            </select>
          </div>

          <!-- Tips -->
          <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
            <p class="text-xs font-semibold text-blue-600 mb-2">Good to know</p>
            <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside">
              <li>Automatic transfers confirm instantly once payment is completed</li>
              <li>Crypto and manual bank deposits are reviewed by our team</li>
              <li>Your naira amount is calculated using the live exchange rate above</li>
            </ul>
          </div>

        </div>

        <div class="px-6 py-4 border-t border-u-line flex items-center justify-between gap-3 bg-u-surface/40">
          <a href="./history/" class="text-sm text-u-muted hover:text-u-text transition-colors flex items-center gap-1.5">
            <i class="bi bi-clock-history text-xs"></i> Deposit history
          </a>
          <button type="submit" name="deposit"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-sm">
            <i class="bi bi-arrow-right-circle"></i>
            Proceed
          </button>
        </div>
      </form>

    <?php else: /* step === 'payment' */ ?>

      <!-- Hero prompt -->
      <div class="mb-8">
        <h2 class="font-display text-2xl font-bold text-u-text mb-2">Complete your payment</h2>
        <p class="text-u-muted text-sm leading-relaxed">
          Send the exact amount to the details below, then tap "I've sent payment" so our team can confirm it.
        </p>
      </div>

      <?php if (!empty($flashError)): ?>
        <div class="mb-4 flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl px-4 py-3 text-sm">
          <i class="bi bi-exclamation-circle-fill text-rose-500 shrink-0"></i>
          <span><?php echo htmlspecialchars($flashError); ?></span>
        </div>
      <?php endif; ?>

      <form method="POST" class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm">

        <!-- Header with countdown -->
        <div class="px-6 pt-6 pb-4 border-b border-u-line flex items-center justify-between gap-3">
          <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-u-muted mb-1">Amount to pay</p>
            <p class="text-lg font-bold text-u-text">
              $<?php echo number_format((float) $deposit['amount_in_dollar'], 2); ?>
              <span class="text-u-muted font-normal text-sm">
                (₦<?php echo number_format((float) $deposit['amount'], 2); ?>)
              </span>
            </p>
          </div>
          <div id="countdown"
            class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white text-sm font-bold flex items-center justify-center shrink-0">
            20:00
          </div>
        </div>

        <!-- Payment details -->
        <div class="px-6 py-5 space-y-5">

          <?php if ($deposit['method'] === 'manual' && $account): ?>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <p class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-1">Bank name</p>
                <p class="text-sm text-u-text font-medium"><?php echo htmlspecialchars($account['bank_name']); ?></p>
              </div>
              <div>
                <p class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-1">Account name</p>
                <p class="text-sm text-u-text font-medium"><?php echo htmlspecialchars($account['account_name']); ?></p>
              </div>
            </div>

            <div>
              <p class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-1">Account number</p>
              <div class="flex items-center gap-2">
                <p class="text-sm text-u-text font-mono flex-1 bg-u-bg border border-u-line rounded-xl px-4 py-2.5" id="copyValue"><?php echo htmlspecialchars($account['account_number']); ?></p>
                <button type="button" class="copy-btn text-sm font-semibold px-4 py-2.5 rounded-xl border border-u-line text-u-text hover:bg-u-surface transition shrink-0"
                  data-copy="<?php echo htmlspecialchars($account['account_number']); ?>">
                  Copy
                </button>
              </div>
            </div>

          <?php elseif ($deposit['method'] === 'crypto' && $account): ?>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <p class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-1">Wallet name</p>
                <p class="text-sm text-u-text font-medium"><?php echo htmlspecialchars($account['wallet_name']); ?></p>
              </div>
              <div>
                <p class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-1">Network</p>
                <p class="text-sm text-u-text font-medium"><?php echo htmlspecialchars($account['wallet_network']); ?></p>
              </div>
            </div>

            <div>
              <p class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-1">Wallet address</p>
              <div class="flex items-center gap-2">
                <p class="text-sm text-u-text font-mono flex-1 bg-u-bg border border-u-line rounded-xl px-4 py-2.5 break-all"><?php echo htmlspecialchars($account['wallet_address']); ?></p>
                <button type="button" class="copy-btn text-sm font-semibold px-4 py-2.5 rounded-xl border border-u-line text-u-text hover:bg-u-surface transition shrink-0"
                  data-copy="<?php echo htmlspecialchars($account['wallet_address']); ?>">
                  Copy
                </button>
              </div>
            </div>

          <?php else: ?>
            <p class="text-sm text-u-muted">No payment account is available right now. Please contact support.</p>
          <?php endif; ?>

          <!-- Tips -->
          <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
            <p class="text-xs font-semibold text-blue-600 mb-2">Before you confirm</p>
            <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside">
              <li>Double-check the amount and destination match exactly</li>
              <li>Only tap confirm after the transfer has been sent</li>
              <li>Our team will review and update your balance shortly after</li>
            </ul>
          </div>

        </div>

        <div class="px-6 py-4 border-t border-u-line flex items-center justify-between gap-3 bg-u-surface/40">
          <a href="./" class="text-sm text-u-muted hover:text-u-text transition-colors flex items-center gap-1.5">
            <i class="bi bi-arrow-left text-xs"></i> Start over
          </a>
          <button type="submit" name="confirm_payment"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-sm">
            <i class="bi bi-check-circle"></i>
            I've sent payment
          </button>
        </div>
      </form>

    <?php endif; ?>

  </main>

<?php include '../../components/client/_user_layout_foot.php'; ?>

<script>
// Live Naira conversion (step 1)
const usdToNairaRate = <?php echo (float) $usd_to_naria_rate; ?>;
const amountInput = document.getElementById("amountUSD");
const nairaDisplay = document.getElementById("amountNGN");

if (amountInput && nairaDisplay) {
  amountInput.addEventListener("input", function () {
    const usdAmount = parseFloat(this.value) || 0;
    const nairaAmount = usdAmount * usdToNairaRate;

    nairaDisplay.textContent = "₦" + nairaAmount.toLocaleString("en-NG", {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });
  });
}

// Countdown timer (step 2)
const countdownElement = document.getElementById("countdown");
if (countdownElement) {
  let timeLeft = 20 * 60; // 20 minutes

  const timer = setInterval(function () {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    countdownElement.textContent = `${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;

    if (timeLeft <= 0) {
      clearInterval(timer);
      countdownElement.textContent = "Expired";
      const confirmBtn = document.querySelector('button[name="confirm_payment"]');
      if (confirmBtn) confirmBtn.disabled = true;
    }

    timeLeft--;
  }, 1000);
}

// Copy-to-clipboard buttons (step 2)
document.querySelectorAll(".copy-btn").forEach(function (btn) {
  btn.addEventListener("click", function () {
    const text = btn.dataset.copy;
    navigator.clipboard.writeText(text).then(function () {
      const original = btn.textContent;
      btn.textContent = "Copied!";
      setTimeout(function () {
        btn.textContent = original;
      }, 1500);
    });
  });
});
</script>

</body>
</html>