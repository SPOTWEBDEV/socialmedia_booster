<?php
include_once '../../server/connection.php';
require_once '../../server/auth/admin/otp.php';

admin_session_start();
admin_security_headers();

// Only reachable after the password step (or if already fully signed in)
if (!empty($_SESSION['admin_']) && !empty($_SESSION['admin_otp_verified'])) {
    admin_redirect('../dashboard/');
}
$pendingId = $_SESSION['admin_pending_id'] ?? null;
if (!$pendingId) {
    admin_redirect('../login/');
}

function json_out(bool $success, string $message, ?string $redirect = null): void
{
    header('Content-Type: application/json');
    echo json_encode(['success' => $success, 'message' => $message, 'redirect' => $redirect]);
    exit;
}

// ===================================================
//  POST actions: verify | send | cancel
// ===================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if (!csrf_check($_POST['csrf'] ?? null)) {
        if ($action === 'verify') {
            json_out(false, 'Your session expired. Refresh the page and try again.');
        }
        $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Your session expired. Please try again.'];
        admin_redirect('./');
    }

    if ($action === 'verify') {
        [$ok, $msg] = admin_otp_verify(trim((string) ($_POST['code'] ?? '')));
        json_out($ok, $msg, $ok ? '../dashboard/' : null);
    }

    if ($action === 'send') {
        [$ok, $msg] = admin_otp_send($connection, (int) $pendingId);
        $_SESSION['flash'] = ['type' => $ok ? 'success' : 'error', 'msg' => $msg];
        admin_redirect('./'); // Post/Redirect/Get: refreshing can't re-send
    }

    if ($action === 'cancel') {
        admin_logout();
        admin_redirect('../login/');
    }

    admin_redirect('./');
}

// ===================================================
//  View state
// ===================================================
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$otp       = $_SESSION['otp'] ?? null;
$step      = $otp ? 'verify' : 'send';
$remaining = $otp ? max(0, (int) $otp['expires'] - time()) : 0;
$maskedTo  = $otp ? mask_email($otp['email']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title><?php echo htmlspecialchars($sitename ?? 'Admin'); ?> — Verify identity</title>
<link rel="icon" href="<?php echo htmlspecialchars($domain); ?>assets/images/brand-logos/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<script>
  tailwind.config = {
    theme: { extend: { fontFamily: { display: ['"Space Grotesk"', 'sans-serif'], body: ['Inter', 'sans-serif'], mono: ['"JetBrains Mono"', 'monospace'] }, colors: { base: '#0B1120', surface: '#101826', card: '#141D2E', line: '#1F2937' } } }
  }
</script>
<style>
  body { font-family: 'Inter', sans-serif; }
  .otp-input { letter-spacing: 0.25em; }
</style>
</head>
<body class="bg-base text-slate-200 min-h-screen flex items-center justify-center px-4 py-12">

<div class="w-full max-w-sm">

  <div class="flex justify-center mb-8">
    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center font-display font-bold text-white text-xl">BY</div>
  </div>

  <div class="bg-card border border-line rounded-2xl overflow-hidden">

    <div class="px-6 pt-6 pb-2 text-center">
      <div class="w-12 h-12 rounded-full bg-blue-500/15 border border-blue-500/20 flex items-center justify-center mx-auto mb-3">
        <i class="bi bi-shield-check text-xl text-blue-400"></i>
      </div>
      <h2 class="font-display font-semibold text-white text-lg mb-1">
        <?php echo $step === 'verify' ? 'Enter your code' : 'Verify your identity'; ?>
      </h2>
      <p class="text-sm text-slate-400 mb-4">
        <?php if ($step === 'verify'): ?>
          We sent a 6-digit code to <strong class="text-slate-300"><?php echo htmlspecialchars($maskedTo); ?></strong>.
        <?php else: ?>
          We'll send a one-time code to your registered auth email.
        <?php endif; ?>
      </p>
    </div>

    <div class="px-6 pb-6 space-y-4">

      <?php if ($flash): ?>
        <?php $isErr = $flash['type'] === 'error'; ?>
        <div class="flex items-center gap-3 border rounded-xl px-4 py-3 text-sm <?php echo $isErr ? 'bg-rose-500/10 border-rose-500/20 text-rose-300' : 'bg-emerald-500/10 border-emerald-500/20 text-emerald-300'; ?>">
          <i class="bi <?php echo $isErr ? 'bi-exclamation-circle-fill' : 'bi-check-circle-fill'; ?> shrink-0"></i>
          <span><?php echo htmlspecialchars($flash['msg']); ?></span>
        </div>
      <?php endif; ?>

      <div id="inlineError" class="hidden items-center gap-3 bg-rose-500/10 border border-rose-500/20 text-rose-300 rounded-xl px-4 py-3 text-sm">
        <i class="bi bi-exclamation-circle-fill shrink-0"></i>
        <span id="inlineErrorText"></span>
      </div>

      <?php if ($step === 'send'): ?>

        <form method="POST">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="action" value="send">
          <button type="submit"
            class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold py-3 rounded-xl transition">
            <i class="bi bi-send"></i> Send verification code
          </button>
        </form>

      <?php else: ?>

        <form method="POST" id="verifyForm">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="action" value="verify">
          <label class="text-xs text-slate-400 mb-2 block text-center">6-digit code</label>
          <input type="text" name="code" id="codeInput" inputmode="numeric" pattern="\d{6}" maxlength="6" required autocomplete="one-time-code" autofocus
            class="otp-input w-full bg-surface border border-line rounded-xl px-4 py-3 text-center text-2xl font-mono text-slate-100 tracking-widest focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition"
            placeholder="••••••" />

          <p class="text-xs text-slate-500 text-center mt-2">
            Code expires in <span id="countdown" class="text-amber-400 font-mono font-medium">--:--</span>
          </p>

          <button type="submit" id="verifyBtn"
            class="mt-4 w-full flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold py-3 rounded-xl transition disabled:opacity-60">
            <i class="bi bi-unlock"></i> Verify code
          </button>
        </form>

        <form method="POST" class="text-center">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="action" value="send">
          <button type="submit" class="text-xs text-slate-500 hover:text-slate-300 transition underline underline-offset-2">
            Didn't receive it? Send again
          </button>
        </form>

      <?php endif; ?>

    </div>
  </div>

  <form method="POST" class="text-center mt-4">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="action" value="cancel">
    <button type="submit" class="text-xs text-slate-500 hover:text-slate-300 transition inline-flex items-center gap-1">
      <i class="bi bi-arrow-left text-xs"></i> Cancel and return to login
    </button>
  </form>

</div>

<?php if ($step === 'verify'): ?>
<script>
const form   = document.getElementById("verifyForm");
const input  = document.getElementById("codeInput");
const btn    = document.getElementById("verifyBtn");
const errBox = document.getElementById("inlineError");
const errTxt = document.getElementById("inlineErrorText");
const label  = document.getElementById("countdown");

// Countdown uses server-computed seconds, so a wrong device clock can't mislead the user
const endsAt = Date.now() + <?php echo (int) $remaining; ?> * 1000;
function tick() {
  const left = Math.max(0, Math.floor((endsAt - Date.now()) / 1000));
  label.textContent = String(Math.floor(left / 60)).padStart(2, "0") + ":" + String(left % 60).padStart(2, "0");
  if (left <= 0) {
    label.textContent = "Expired";
    label.classList.replace("text-amber-400", "text-rose-400");
  }
}
tick();
setInterval(tick, 1000);

function showError(msg) {
  errTxt.textContent = msg;               // textContent, never innerHTML
  errBox.classList.remove("hidden");
  errBox.classList.add("flex");
}

let busy = false;
form.addEventListener("submit", async (e) => {
  e.preventDefault();
  if (busy) return;
  busy = true;
  btn.disabled = true;
  btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Verifying...';
  errBox.classList.add("hidden");

  try {
    const res  = await fetch(location.href, { method: "POST", body: new FormData(form), credentials: "same-origin" });
    const data = await res.json();
    if (data.success) {
      window.location.href = data.redirect;
      return;
    }
    showError(data.message || "Verification failed.");
    input.value = "";
    input.focus();
  } catch (err) {
    showError("Something went wrong. Please try again.");
  }
  busy = false;
  btn.disabled = false;
  btn.innerHTML = '<i class="bi bi-unlock"></i> Verify code';
});

// Digits only; auto-submit on the 6th digit
input.addEventListener("input", () => {
  input.value = input.value.replace(/\D/g, "").slice(0, 6);
  if (input.value.length === 6) form.requestSubmit();
});
</script>
<?php endif; ?>

</body>
</html>