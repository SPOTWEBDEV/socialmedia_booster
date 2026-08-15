<?php
session_start();
include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/admin.php';
include_once '../../mailer/index.php';
include_once '../reach/email_template.php'; // buildEmailHtml()

$adminRow = mysqli_fetch_assoc(mysqli_query($connection, "SELECT id, auth_email FROM admin WHERE id = 1"));
$authEmail = $adminRow['auth_email'] ?? '';

$error   = '';
$success = '';
$step    = isset($_SESSION['otp_hash']) ? 'verify' : 'send'; // which UI to show

// ===================================================
//  SEND OTP
// ===================================================
if (isset($_POST['send_otp'])) {
    if (empty($authEmail)) {
        $error = "No auth email configured. Go to Settings → Auth email first.";
    } else {
        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $_SESSION['otp_hash']    = password_hash($code, PASSWORD_DEFAULT);
        $_SESSION['otp_expires'] = time() + 600; // 10 minutes
        $_SESSION['otp_email']   = $authEmail;

        $subject = "Your admin verification code";
        $body    = "Your one-time verification code is:\n\n**{$code}**\n\nThis code expires in 10 minutes. Do not share it with anyone.";
        $html    = buildEmailHtml($subject, $body, 'Admin');

        $sent = smtpmailer($authEmail, $subject, $html);
        if ($sent) {
            $success = "Code sent to " . htmlspecialchars($authEmail) . ". Check your inbox.";
            $step = 'verify';
        } else {
            $error = "Failed to send the email. Check your SMTP configuration.";
            unset($_SESSION['otp_hash'], $_SESSION['otp_expires'], $_SESSION['otp_email']);
        }
    }
}

// ===================================================
//  VERIFY OTP
// ===================================================
if (isset($_POST['verify_otp'])) {
    $submitted = trim($_POST['code'] ?? '');

    if (empty($_SESSION['otp_hash'])) {
        $error = "No code was sent yet. Click 'Send code' first.";
        $step = 'send';
    } elseif (time() > ($_SESSION['otp_expires'] ?? 0)) {
        $error = "This code has expired. Please request a new one.";
        unset($_SESSION['otp_hash'], $_SESSION['otp_expires']);
        $step = 'send';
    } elseif (!password_verify($submitted, $_SESSION['otp_hash'])) {
        $error = "Incorrect code. Please try again.";
        $step = 'verify';
    } else {
        unset($_SESSION['otp_hash'], $_SESSION['otp_expires'], $_SESSION['otp_email']);
        $_SESSION['admin_otp_verified'] = time();
        header("Location: ../../reach/"); // or wherever verified admins should go
        exit;
    }
}

// ===================================================
//  RESEND
// ===================================================
if (isset($_POST['resend_otp'])) {
    unset($_SESSION['otp_hash'], $_SESSION['otp_expires'], $_SESSION['otp_email']);
    header("Location: ./");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($sitename ?? 'Admin'); ?> — Verify identity</title>
<link rel="icon" href="<?php echo $domain ?>assets/images/brand-logos/favicon.ico" type="image/x-icon">
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

  <!-- Brand -->
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
          We sent a 6-digit code to <strong class="text-slate-300"><?php echo htmlspecialchars($_SESSION['otp_email'] ?? $authEmail); ?></strong>.
        <?php else: ?>
          We'll send a one-time code to your registered auth email.
        <?php endif; ?>
      </p>
    </div>

    <div class="px-6 pb-6 space-y-4">

      <?php if (!empty($error)): ?>
        <div class="flex items-center gap-3 bg-rose-500/10 border border-rose-500/20 text-rose-300 rounded-xl px-4 py-3 text-sm">
          <i class="bi bi-exclamation-circle-fill shrink-0"></i>
          <span><?php echo htmlspecialchars($error); ?></span>
        </div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div class="flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/20 text-emerald-300 rounded-xl px-4 py-3 text-sm">
          <i class="bi bi-check-circle-fill shrink-0"></i>
          <span><?php echo $success; ?></span>
        </div>
      <?php endif; ?>

      <?php if ($step === 'send'): ?>
        <?php if (empty($authEmail)): ?>
          <div class="text-center py-2">
            <p class="text-sm text-slate-400 mb-4">No auth email is set on your account.</p>
            <a href="../settings/" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
              <i class="bi bi-gear"></i> Go to Settings
            </a>
          </div>
        <?php else: ?>
          <form method="POST">
            <div class="bg-surface border border-line rounded-xl p-4 mb-4 text-center">
              <p class="text-xs text-slate-500 mb-1">Sending code to</p>
              <p class="text-sm text-slate-200 font-medium"><?php echo htmlspecialchars($authEmail); ?></p>
            </div>
            <button type="submit" name="send_otp"
              class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold py-3 rounded-xl transition">
              <i class="bi bi-send"></i> Send verification code
            </button>
          </form>
        <?php endif; ?>

      <?php else: ?>

        <form method="POST" id="verifyForm">
          <label class="text-xs text-slate-400 mb-2 block text-center">6-digit code</label>
          <input type="text" name="code" id="codeInput" inputmode="numeric" pattern="\d{6}" maxlength="6" required autocomplete="one-time-code"
            class="otp-input w-full bg-surface border border-line rounded-xl px-4 py-3 text-center text-2xl font-mono text-slate-100 tracking-widest focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition"
            placeholder="• • • • • •" />

          <!-- Expiry countdown -->
          <p class="text-xs text-slate-500 text-center mt-2">
            Code expires in <span id="countdown" class="text-amber-400 font-mono font-medium">10:00</span>
          </p>

          <button type="submit" name="verify_otp"
            class="mt-4 w-full flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold py-3 rounded-xl transition">
            <i class="bi bi-unlock"></i> Verify code
          </button>
        </form>

        <form method="POST" class="text-center">
          <button type="submit" name="resend_otp" class="text-xs text-slate-500 hover:text-slate-300 transition underline underline-offset-2">
            Didn't receive it? Send again
          </button>
        </form>

      <?php endif; ?>

    </div>
  </div>

  <div class="text-center mt-4">
    <a href="../../dashboard/" class="text-xs text-slate-500 hover:text-slate-300 transition flex items-center gap-1 justify-center">
      <i class="bi bi-arrow-left text-xs"></i> Back to dashboard
    </a>
  </div>

</div>

<?php if ($step === 'verify'): ?>
<script>
// Count down from 10 minutes
const expiresAt = <?php echo ($_SESSION['otp_expires'] ?? (time() + 600)); ?>;

function tick() {
  const remaining = Math.max(0, expiresAt - Math.floor(Date.now() / 1000));
  const m = String(Math.floor(remaining / 60)).padStart(2, '0');
  const s = String(remaining % 60).padStart(2, '0');
  const el = document.getElementById("countdown");
  if (el) el.textContent = `${m}:${s}`;
  if (remaining <= 0 && el) {
    el.textContent = "Expired";
    el.classList.remove("text-amber-400");
    el.classList.add("text-rose-400");
  }
}
tick();
setInterval(tick, 1000);

// Auto-submit when 6 digits entered
document.getElementById("codeInput")?.addEventListener("input", function () {
  if (this.value.replace(/\D/g,'').length === 6) {
    this.value = this.value.replace(/\D/g,'');
    document.getElementById("verifyForm").submit();
  }
});
</script>
<?php endif; ?>

</body>
</html>
