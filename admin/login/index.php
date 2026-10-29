<?php
include_once '../../server/connection.php';
include_once '../../server/model.php';
require_once '../../server/auth/admin/otp.php';

admin_session_start();
admin_security_headers();

// Already fully signed in (password + OTP)
if (!empty($_SESSION['admin_']) && !empty($_SESSION['admin_otp_verified'])) {
  admin_redirect('../dashboard/');
}

$flashMessage = '';
$flashType    = 'success'; // success | error

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
  $ip       = $_SERVER['REMOTE_ADDR'] ?? '';
  $password = (string) ($_POST['password'] ?? '');

  if (!csrf_check($_POST['csrf'] ?? null)) {
    $flashMessage = "Your session expired. Refresh the page and try again.";
    $flashType = 'error';
  } elseif (login_is_locked($connection, $ip)) {
    $flashMessage = "Too many failed attempts. Try again in 15 minutes.";
    $flashType = 'error';
  } elseif ($password === '') {
    $flashMessage = "Please enter the admin password.";
    $flashType = 'error';
  } else {
    // Single-admin site: use the first admin row
    $result = $connection->query("SELECT id, password FROM `admin` ORDER BY id ASC LIMIT 1");
    $admin  = $result ? $result->fetch_assoc() : null;

    if ($admin && password_verify($password, $admin['password'])) {
      login_clear_failures($connection, $ip);

      // Upgrade the hash if PHP's default algorithm/cost has moved on
      if (password_needs_rehash($admin['password'], PASSWORD_DEFAULT)) {
        $new = password_hash($password, PASSWORD_DEFAULT);
        $up  = $connection->prepare("UPDATE `admin` SET password = ? WHERE id = ?");
        $up->bind_param('si', $new, $admin['id']);
        $up->execute();
        $up->close();
      }

      session_regenerate_id(true);
      $_SESSION = [];                                   // wipe stale state
      $_SESSION['admin_pending_id'] = (int) $admin['id']; // password OK, NOT logged in yet

      [$ok, $msg] = admin_otp_send($connection, (int) $admin['id']);
      $_SESSION['flash'] = ['type' => $ok ? 'success' : 'error', 'msg' => $msg];

      admin_redirect('../verify/');
    }

    login_record_failure($connection, $ip);
    $flashMessage = "Incorrect password."; // same message whatever the cause
    $flashType = 'error';
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme-mode="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title><?php echo htmlspecialchars($sitename ?? 'Admin'); ?> - Admin Login</title>
  <link rel="icon" href="<?php echo $domain ?>assets/images/brand-logos/favicon.ico" type="image/x-icon">
  <link href="<?php echo $domain ?>assets/css/icons.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-u-bg min-h-screen flex items-center justify-center px-4 py-10">

  <div class="w-full max-w-md">

    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <img src="<?php echo $domain ?>assets/images/logo.png" alt="<?php echo htmlspecialchars($sitename ?? ''); ?>" class="h-9">
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

      <div class="px-6 pb-6">
        <h2 class="font-display text-xl font-bold text-u-text mb-1 text-center">Admin access</h2>
        <p class="text-sm text-u-muted mb-5 text-center">Enter the admin password. We'll then email you a verification code.</p>

        <div class="flex items-center justify-center mb-5">
          <div class="w-11 h-11 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-lg shrink-0">
            <i class="bi bi-shield-lock"></i>
          </div>
        </div>

        <form method="POST" class="space-y-4" autocomplete="off">
          <?php echo csrf_field(); ?>
          <div>
            <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Password</label>
            <div class="relative">
              <input type="password" name="password" id="adminPassword" required autocomplete="current-password"
                class="w-full border border-u-line rounded-xl px-4 py-3 pr-11 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
              <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-u-muted" data-target="adminPassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <button type="submit" name="login"
            class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-3 rounded-xl transition shadow-sm">
            <i class="bi bi-unlock"></i>
            Unlock
          </button>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.querySelectorAll(".toggle-password").forEach(function(btn) {
      btn.addEventListener("click", function() {
        const input = document.getElementById(btn.dataset.target);
        const icon = btn.querySelector("i");
        if (input.type === "password") {
          input.type = "text";
          icon.className = "bi bi-eye-slash";
        } else {
          input.type = "password";
          icon.className = "bi bi-eye";
        }
      });
    });
  </script>

</body>

</html>