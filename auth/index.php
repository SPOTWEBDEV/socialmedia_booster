<?php

include_once '../server/connection.php';
include_once '../server/model.php';

$flashMessage = '';
$flashType    = 'success'; // success | error
$activeTab    = (isset($_GET['tab']) && $_GET['tab'] === 'signup') ? 'signup' : 'login';

if (isset($_GET['registered'])) {
    $flashMessage = "Account created successfully! You can now sign in.";
    $flashType    = 'success';
    $activeTab    = 'login';
}

// ===================== LOGIN =====================
if (isset($_POST['login'])) {
    $email     = trim($_POST['email'] ?? '');
    $password  = trim($_POST['password'] ?? '');
    $activeTab = 'login';

    if (empty($email) || empty($password)) {
        $flashMessage = "Please fill in all fields.";
        $flashType = 'error';
    } else {
        $stmt = $connection->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                // Check if account is suspended
                if (($user['status'] ?? '') === 'suspended') {
                    $reason = !empty($user['status_message']) ? " Reason: " . htmlspecialchars($user['status_message']) : "";
                    $flashMessage = "Your account has been suspended." . $reason;
                    $flashType = 'error';
                } else {
                    $_SESSION['user_id'] = $user['id'];
                    echo "<script>window.location.href = '../user/dashboard/';</script>";
                    exit;
                }
            } else {
                $flashMessage = "Incorrect password.";
                $flashType = 'error';
            }
        } else {
            $flashMessage = "Email not registered.";
            $flashType = 'error';
        }
    }
}

// ===================== REGISTER =====================
if (isset($_POST['create_account'])) {
    $fullname         = trim($_POST['fullname'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $password         = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    $activeTab = 'signup';

    if (empty($fullname) || empty($email) || empty($password)) {
        $flashMessage = "Please fill in all required fields.";
        $flashType = 'error';
    } elseif ($password !== $confirm_password) {
        $flashMessage = "Passwords do not match.";
        $flashType = 'error';
    } else {
        $stmt = $connection->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $flashMessage = "This email is already registered.";
            $flashType = 'error';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert = $connection->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
            $insert->bind_param("sss", $fullname, $email, $hashed_password);

            if ($insert->execute()) {
                echo "<script>window.location.href = './?registered=1';</script>";
                exit;
            } else {
                $flashMessage = "Something went wrong creating your account. Please try again.";
                $flashType = 'error';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme-mode="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $sitename . ' - Sign In / Sign Up'; ?></title>
  <link rel="icon" href="<?php echo $domain ?>assets/images/brand-logos/favicon.ico" type="image/x-icon">

  <link href="<?php echo $domain ?>assets/css/icons.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-u-bg min-h-screen flex items-center justify-center px-4 py-10">

  <div class="w-full max-w-lg">

    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <img src="<?php echo $domain ?>assets/images/logo.png" alt="<?php echo htmlspecialchars($sitename ?? ''); ?>" class="h-[150px] w-auto">
    </div>

    <div class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm">

      <!-- Tabs -->
      <div class="flex border-b border-u-line">
        <button type="button" id="tabLoginBtn"
          class="tab-btn flex-1 text-sm font-semibold py-4 transition">
          Sign in
        </button>
        <button type="button" id="tabSignupBtn"
          class="tab-btn flex-1 text-sm font-semibold py-4 transition">
          Sign up
        </button>
      </div>

      <div class="px-6 pt-5">
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

      <!-- Sign in panel -->
      <div id="loginPanel" class="px-6 pb-6">
        <p class="text-sm text-u-muted mb-5">Welcome back — log in to your account.</p>

        <form method="POST" class="space-y-4">
          <div>
            <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Email</label>
            <input type="email" name="email" required
              class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
          </div>

          <div>
            <div class="flex items-center justify-between mb-2">
              <label class="text-xs font-semibold text-u-muted uppercase tracking-wider">Password</label>
              <a href="./verification/" class="text-xs text-blue-500 hover:underline font-medium">Forgot password?</a>
            </div>
            <div class="relative">
              <input type="password" name="password" id="loginPassword" required
                class="w-full border border-u-line rounded-xl px-4 py-3 pr-11 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
              <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-u-muted" data-target="loginPassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <button type="submit" name="login"
            class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-3 rounded-xl transition shadow-sm">
            <i class="bi bi-box-arrow-in-right"></i>
            Sign in
          </button>
        </form>
      </div>

      <!-- Sign up panel -->
      <div id="signupPanel" class="px-6 pb-6 hidden">
        <p class="text-sm text-u-muted mb-5">Create a free account to get started.</p>

        <form method="POST" class="space-y-4">
          <div>
            <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Full name</label>
            <input type="text" name="fullname" required
              class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
          </div>

          <div>
            <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Email</label>
            <input type="email" name="email" required
              class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
          </div>

          <div>
            <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Password</label>
            <div class="relative">
              <input type="password" name="password" id="signupPassword" required
                class="w-full border border-u-line rounded-xl px-4 py-3 pr-11 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
              <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-u-muted" data-target="signupPassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <div>
            <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Confirm password</label>
            <div class="relative">
              <input type="password" name="confirm_password" id="signupConfirmPassword" required
                class="w-full border border-u-line rounded-xl px-4 py-3 pr-11 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
              <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-u-muted" data-target="signupConfirmPassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <label class="flex items-start gap-2 text-xs text-u-muted">
            <input type="checkbox" required class="mt-0.5">
            <span>
              By creating an account you agree to our
              <a href="terms_conditions.html" class="text-blue-500 hover:underline">Terms &amp; Conditions</a>
              and Privacy Policy.
            </span>
          </label>

          <button type="submit" name="create_account"
            class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-3 rounded-xl transition shadow-sm">
            <i class="bi bi-person-plus"></i>
            Create account
          </button>
        </form>
      </div>

    </div>
  </div>

<style>
  .tab-btn { color: var(--u-muted, #6b7280); }
  .tab-btn.active { color: var(--u-text, #111827); box-shadow: inset 0 -2px 0 0 #3b82f6; }
</style>

<script>
const tabLoginBtn = document.getElementById("tabLoginBtn");
const tabSignupBtn = document.getElementById("tabSignupBtn");
const loginPanel = document.getElementById("loginPanel");
const signupPanel = document.getElementById("signupPanel");

function showTab(tab) {
  const isLogin = tab === "login";
  loginPanel.classList.toggle("hidden", !isLogin);
  signupPanel.classList.toggle("hidden", isLogin);
  tabLoginBtn.classList.toggle("active", isLogin);
  tabSignupBtn.classList.toggle("active", !isLogin);
}

tabLoginBtn.addEventListener("click", () => showTab("login"));
tabSignupBtn.addEventListener("click", () => showTab("signup"));

// Initial tab from server-side state
showTab("<?php echo $activeTab; ?>");

// Show/hide password toggles
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