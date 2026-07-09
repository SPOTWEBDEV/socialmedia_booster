<?php

include('../../server/connection.php');
include_once '../../server/model.php';

$flashMessage = '';
$flashType    = 'success'; // success | error

if (isset($_POST['login'])) {
    $password = $_POST['password'] ?? '';

    if (empty($password)) {
        $flashMessage = "Please enter the admin password.";
        $flashType = 'error';
    } else {
        // NOTE: matches against the plaintext `password` column as the original
        // code did, just via a prepared statement instead of string interpolation
        // (the original built the query as WHERE password='$password', which was
        // a direct SQL injection risk). If this column actually stores a hash,
        // swap this for a password_verify() check against the stored hash instead.
        $stmt = $connection->prepare("SELECT id FROM `admin` WHERE `password` = ? LIMIT 1");
        $stmt->bind_param("s", $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            $_SESSION['admin_'] = $admin['id'];
            header("Location: ../dashboard/");
            exit;
        } else {
            $flashMessage = "Incorrect password.";
            $flashType = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme-mode="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <p class="text-sm text-u-muted mb-5 text-center">Enter the admin password to continue.</p>

        <div class="flex items-center gap-3 bg-u-surface/40 border border-u-line rounded-xl px-4 py-3 mb-5">
          <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-sm font-bold shrink-0">
            <i class="bi bi-shield-lock"></i>
          </div>
          <p class="text-sm text-u-text truncate">admin@admin.com</p>
        </div>

        <form method="POST" class="space-y-4">
          <div>
            <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Password</label>
            <div class="relative">
              <input type="password" name="password" id="adminPassword" required
                class="w-full border border-u-line rounded-xl px-4 py-3 pr-11 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
              <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-u-muted" data-target="adminPassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <label class="flex items-center gap-2 text-sm text-u-muted">
            <input type="checkbox" class="rounded border-u-line">
            Remember password
          </label>

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
document.querySelectorAll(".toggle-password").forEach(function (btn) {
  btn.addEventListener("click", function () {
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