<?php
include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../mailer/index.php';

$step = isset($_GET['step']) ? (int) $_GET['step'] : 1;

$flashMessage = '';
$flashType    = 'success'; // success | error

/*
|--------------------------------------------------------------------------
| STEP 1 — SEND OTP
|--------------------------------------------------------------------------
*/
if (isset($_POST['send_otp'])) {

    $email = trim($_POST['email'] ?? '');

    if (empty($email)) {
        $flashMessage = "Please enter your email address.";
        $flashType = 'error';
    } else {

        $stmt = $connection->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $otp    = rand(1000, 9999);
            $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

            $update = $connection->prepare("UPDATE users SET otp=?, otp_expiry=? WHERE email=?");
            $update->bind_param("sss", $otp, $expiry, $email);
            $update->execute();

            $_SESSION['reset_email'] = $email;

            $subject = "Your OTP Code";
            $message = "Your OTP is: $otp (valid for 5 minutes)";
            $otp_result = smtpmailer($email, $subject, $message);

            if ($otp_result) {

                 echo "<script>window.location.href = '?step=2';</script>";
                exit;
            } else {
                $flashMessage = "Failed to send OTP. Please try again.";
                $flashType = 'error';
            }

        } else {
            $flashMessage = "This email is not registered.";
            $flashType = 'error';
        }
    }
}

/*
|--------------------------------------------------------------------------
| STEP 2 — VERIFY OTP
|--------------------------------------------------------------------------
*/
if (isset($_POST['verify_otp'])) {

    $otp1 = trim($_POST['otp1'] ?? '');
    $otp2 = trim($_POST['otp2'] ?? '');
    $otp3 = trim($_POST['otp3'] ?? '');
    $otp4 = trim($_POST['otp4'] ?? '');

    $entered_otp = $otp1 . $otp2 . $otp3 . $otp4;
    $step = 2;

    if (empty($entered_otp)) {
        $flashMessage = "Please enter the OTP.";
        $flashType = 'error';
    } elseif (!isset($_SESSION['reset_email'])) {
        $flashMessage = "Session expired. Please try again.";
        $flashType = 'error';
    } else {

        $email = $_SESSION['reset_email'];

        $stmt = $connection->prepare("SELECT otp, otp_expiry FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result) {
            if ($entered_otp == $result['otp']) {
                if (strtotime($result['otp_expiry']) > time()) {
                    echo "<script>window.location.href = '?step=3';</script>";
                    exit;
                } else {
                    $flashMessage = "OTP has expired.";
                    $flashType = 'error';
                }
            } else {
                $flashMessage = "Invalid OTP.";
                $flashType = 'error';
            }
        } else {
            $flashMessage = "Something went wrong. Please try again.";
            $flashType = 'error';
        }
    }
}

/*
|--------------------------------------------------------------------------
| STEP 3 — CHANGE PASSWORD
|--------------------------------------------------------------------------
*/
if (isset($_POST['change_password'])) {

    $password = trim($_POST['password'] ?? '');
    $confirm  = trim($_POST['confirm_password'] ?? '');
    $step = 3;

    if (empty($password) || empty($confirm)) {
        $flashMessage = "Please fill in all fields.";
        $flashType = 'error';
    } elseif ($password !== $confirm) {
        $flashMessage = "Passwords do not match.";
        $flashType = 'error';
    } elseif (!isset($_SESSION['reset_email'])) {
        $flashMessage = "Session expired. Please try again.";
        $flashType = 'error';
    } else {

        $email = $_SESSION['reset_email'];
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $connection->prepare("UPDATE users SET password=?, otp=NULL, otp_expiry=NULL WHERE email=?");
        $stmt->bind_param("ss", $hashed, $email);
        $stmt->execute();

        unset($_SESSION['reset_email']);

        echo "<script>window.location.href = '../login/?reset=1';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme-mode="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($sitename ?? 'Reset Password'); ?></title>
  <link rel="icon" href="<?php echo $domain ?>assets/images/brand-logos/favicon.ico" type="image/x-icon">
 <script src="https://cdn.tailwindcss.com"></script>
  <link href="<?php echo $domain ?>assets/css/icons.css" rel="stylesheet">
</head>

<body class="bg-u-bg min-h-screen flex items-center justify-center px-4 py-10">

  <div class="w-full max-w-md">

    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <img src="<?php echo $domain ?>assets/images/logo.png" alt="<?php echo htmlspecialchars($sitename ?? ''); ?>" class="h-[150px] w-auto">
    </div>

    <!-- Step indicator -->
    <div class="flex items-center justify-center gap-2 mb-6">
      <?php for ($i = 1; $i <= 3; $i++): ?>
        <div class="w-2.5 h-2.5 rounded-full <?php echo $i <= $step ? 'bg-blue-600' : 'bg-u-line'; ?> transition"></div>
      <?php endfor; ?>
    </div>

    <div class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm">

      <div class="px-6 pt-6">
        <?php if (!empty($flashMessage)): ?>
          <?php if ($flashType === 'error'): ?>
            <div class="mb-4 flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl px-4 py-3 text-sm">
              <i class="bi bi-exclamation-circle-fill text-rose-500 shrink-0"></i>
              <span><?php echo htmlspecialchars($flashMessage); ?></span>
            </div>
          <?php else: ?>
            <div class="mb-4 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl px-4 py-3 text-sm">
              <i class="bi bi-check-circle-fill text-emerald-500 shrink-0"></i>
              <span><?php echo htmlspecialchars($flashMessage); ?></span>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>

      <?php if ($step === 1): ?>

        <div class="px-6 pb-6">
          <h2 class="font-display text-xl font-bold text-u-text mb-1 text-center">Forgot password</h2>
          <p class="text-sm text-u-muted mb-5 text-center">
            Enter your account email and we'll send you a one-time code.
          </p>

          <form method="POST" class="space-y-4">
            <div>
              <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Email</label>
              <input type="email" name="email" required
                class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
            </div>

            <button type="submit" name="send_otp"
              class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-3 rounded-xl transition shadow-sm">
              <i class="bi bi-send"></i>
              Send OTP
            </button>
          </form>

          <p class="text-center text-sm text-u-muted mt-5">
            Remembered your password? <a href="../login/" class="text-blue-500 hover:underline font-medium">Sign in</a>
          </p>
        </div>

      <?php elseif ($step === 2): ?>

        <div class="px-6 pb-6">
          <h2 class="font-display text-xl font-bold text-u-text mb-1 text-center">Verify your account</h2>
          <p class="text-sm text-u-muted mb-5 text-center">
            Enter the 4-digit code we sent to your email. It's valid for 5 minutes.
          </p>

          <form method="POST" class="space-y-4">
            <div class="flex justify-center gap-3">
              <input type="text" name="otp1" maxlength="1" inputmode="numeric" required
                class="otp-input w-12 h-12 text-center text-lg font-semibold border border-u-line rounded-xl text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
              <input type="text" name="otp2" maxlength="1" inputmode="numeric" required
                class="otp-input w-12 h-12 text-center text-lg font-semibold border border-u-line rounded-xl text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
              <input type="text" name="otp3" maxlength="1" inputmode="numeric" required
                class="otp-input w-12 h-12 text-center text-lg font-semibold border border-u-line rounded-xl text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
              <input type="text" name="otp4" maxlength="1" inputmode="numeric" required
                class="otp-input w-12 h-12 text-center text-lg font-semibold border border-u-line rounded-xl text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
            </div>

            <button type="submit" name="verify_otp"
              class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-3 rounded-xl transition shadow-sm">
              <i class="bi bi-shield-check"></i>
              Verify
            </button>
          </form>

          <p class="text-center text-sm text-u-muted mt-5">
            Didn't get a code? <a href="?step=1" class="text-blue-500 hover:underline font-medium">Try again</a>
          </p>
        </div>

      <?php elseif ($step === 3): ?>

        <div class="px-6 pb-6">
          <h2 class="font-display text-xl font-bold text-u-text mb-1 text-center">Change password</h2>
          <p class="text-sm text-u-muted mb-5 text-center">Choose a new password for your account.</p>

          <form method="POST" class="space-y-4">
            <div>
              <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">New password</label>
              <input type="password" name="password" required
                class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
            </div>
            <div>
              <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Confirm password</label>
              <input type="password" name="confirm_password" required
                class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
            </div>

            <button type="submit" name="change_password"
              class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-3 rounded-xl transition shadow-sm">
              <i class="bi bi-check2-circle"></i>
              Update password
            </button>
          </form>
        </div>

      <?php endif; ?>

    </div>
  </div>

<script>
// Auto-advance focus between OTP boxes
document.querySelectorAll(".otp-input").forEach(function (input, index, list) {
  input.addEventListener("input", function () {
    if (this.value.length === 1 && index < list.length - 1) {
      list[index + 1].focus();
    }
  });
  input.addEventListener("keydown", function (e) {
    if (e.key === "Backspace" && this.value === "" && index > 0) {
      list[index - 1].focus();
    }
  });
});
</script>

</body>
</html>