<?php

include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/user.php';

$user_id = $_SESSION['user_id']; // replace with actual logged-in user ID

$flashMessage = '';
$flashType    = 'success'; // success | error

// Fetch existing keys
$apiKeys = [
  'test_key' => '',
  'live_key' => ''
];

$stmt = $connection->prepare("SELECT test_key, live_key FROM user_api_keys WHERE user_id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
if ($row = $res->fetch_assoc()) {
  $apiKeys = $row;
}

// ===================== HANDLE FORM SUBMISSION =====================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // --- Save Security Settings ---
  if (isset($_POST['save_settings'])) {
    $two_step = isset($_POST['two_step']) ? 1 : 0;
    $auth_type = $_POST['auth_type'] ?? 'pin';
    $recovery_email = isset($_POST['recovery_email']) ? 1 : 0;

    $sql = "INSERT INTO user_security_settings (user_id, two_step, auth_type, recovery_email)
                VALUES (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                two_step = VALUES(two_step),
                auth_type = VALUES(auth_type),
                recovery_email = VALUES(recovery_email)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("iisi", $user_id, $two_step, $auth_type, $recovery_email);

    if ($stmt->execute()) {
      $flashMessage = "Security settings saved successfully.";
      $flashType = 'success';
    } else {
      $flashMessage = "Error saving settings. Please try again.";
      $flashType = 'error';
    }
  }

  // --- Change Password ---
  if (isset($_POST['change_password'])) {
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    $stmt = $connection->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'] ?? '';

    if (!password_verify($current, $hashed_password)) {
      $flashMessage = "Current password is incorrect.";
      $flashType = 'error';
    } elseif ($new !== $confirm) {
      $flashMessage = "New password and confirmation do not match.";
      $flashType = 'error';
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/', $new)) {
      $flashMessage = "Password must be 8+ characters, include 1 capital and 1 special character.";
      $flashType = 'error';
    } else {
      $new_hashed = password_hash($new, PASSWORD_DEFAULT);
      $stmt = $connection->prepare("UPDATE users SET password = ? WHERE id = ?");
      $stmt->bind_param("si", $new_hashed, $user_id);
      if ($stmt->execute()) {
        $flashMessage = "Password changed successfully.";
        $flashType = 'success';
      } else {
        $flashMessage = "Error updating password.";
        $flashType = 'error';
      }
    }
  }

  function generateApiKey($prefix) {
    return $prefix . '_' . bin2hex(random_bytes(16));
  }

  // Generate Test API
  if (isset($_POST['generate_test_key'])) {
    $test_key = generateApiKey('test');
    $stmt = $connection->prepare("
        INSERT INTO user_api_keys (user_id, test_key)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE test_key=VALUES(test_key)
    ");
    $stmt->bind_param("is", $user_id, $test_key);
    $stmt->execute();
    $apiKeys['test_key'] = $test_key;
    $flashMessage = "Test API key generated successfully.";
    $flashType = 'success';
  }

  // Generate Live API
  if (isset($_POST['generate_live_key'])) {
    $live_key = generateApiKey('live');
    $stmt = $connection->prepare("
        INSERT INTO user_api_keys (user_id, live_key)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE live_key=VALUES(live_key)
    ");
    $stmt->bind_param("is", $user_id, $live_key);
    $stmt->execute();
    $apiKeys['live_key'] = $live_key;
    $flashMessage = "Live API key generated successfully.";
    $flashType = 'success';
  }
}

// ===================== FETCH CURRENT SETTINGS =====================
$settings = [
  'two_step' => 0,
  'auth_type' => 'pin',
  'recovery_email' => 1
];

$stmt = $connection->prepare("SELECT two_step, auth_type, recovery_email FROM user_security_settings WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
  $settings = $row;
}

$pageTitle    = 'Settings';
$pageSubtitle = 'Manage your account security and API access';
$activeNav    = 'Settings';
include '../../components/client/_user_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-8">

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-u-muted mb-6">
      <span class="text-u-text font-medium">Settings</span>
    </div>

    <!-- Hero prompt -->
    <div class="mb-8">
      <h2 class="font-display text-2xl font-bold text-u-text mb-2">Account settings</h2>
      <p class="text-u-muted text-sm leading-relaxed">
        Manage your login security, password, and API access from one place.
      </p>
    </div>

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

    <!-- Security settings -->
    <form method="POST" class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm mb-6">

      <div class="px-6 pt-6 pb-2">
        <p class="text-xs font-semibold uppercase tracking-wider text-u-muted mb-1">Security</p>
      </div>

      <div class="px-6 py-3 space-y-5">

        <!-- Two-step verification -->
        <div class="flex items-center justify-between gap-4">
          <div>
            <p class="text-sm font-medium text-u-text">Two-step verification</p>
            <p class="text-xs text-u-muted">Adds an extra layer of security to your account.</p>
          </div>
          <label class="relative inline-flex items-center cursor-pointer shrink-0">
            <input type="checkbox" name="two_step" class="sr-only peer" <?= ($settings['two_step'] ?? 0) ? 'checked' : '' ?>>
            <div class="w-11 h-6 bg-u-line rounded-full peer peer-checked:bg-blue-600 transition"></div>
            <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-5"></div>
          </label>
        </div>

        <!-- Auth type -->
        <div>
          <p class="text-sm font-medium text-u-text mb-2">Authentication method</p>
          <div class="flex gap-2">
            <label class="flex-1">
              <input type="radio" name="auth_type" value="pin" class="sr-only peer" <?= ($settings['auth_type'] ?? 'pin') === 'pin' ? 'checked' : '' ?>>
              <div class="text-center text-sm font-medium px-4 py-2.5 rounded-xl border border-u-line text-u-muted peer-checked:border-blue-400 peer-checked:bg-blue-50 peer-checked:text-blue-600 cursor-pointer transition">
                <i class="bi bi-unlock mr-1"></i> Pin
              </div>
            </label>
            <label class="flex-1">
              <input type="radio" name="auth_type" value="password" class="sr-only peer" <?= ($settings['auth_type'] ?? '') === 'password' ? 'checked' : '' ?>>
              <div class="text-center text-sm font-medium px-4 py-2.5 rounded-xl border border-u-line text-u-muted peer-checked:border-blue-400 peer-checked:bg-blue-50 peer-checked:text-blue-600 cursor-pointer transition">
                <i class="bi bi-key mr-1"></i> Password
              </div>
            </label>
          </div>
        </div>

        <!-- Recovery email -->
        <div class="flex items-center justify-between gap-4">
          <div>
            <p class="text-sm font-medium text-u-text">Recovery email</p>
            <p class="text-xs text-u-muted">If disabled, you will <strong class="text-rose-500">not</strong> receive recovery emails.</p>
          </div>
          <label class="relative inline-flex items-center cursor-pointer shrink-0">
            <input type="checkbox" name="recovery_email" class="sr-only peer" <?= ($settings['recovery_email'] ?? 1) ? 'checked' : '' ?>>
            <div class="w-11 h-6 bg-u-line rounded-full peer peer-checked:bg-blue-600 transition"></div>
            <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-5"></div>
          </label>
        </div>

      </div>

      <div class="px-6 py-4 border-t border-u-line flex items-center justify-end bg-u-surface/40">
        <button type="submit" name="save_settings"
          class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-sm">
          <i class="bi bi-check2"></i>
          Save settings
        </button>
      </div>
    </form>

    <!-- Change password -->
    <form method="POST" class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm mb-6">

      <div class="px-6 pt-6 pb-2">
        <p class="text-xs font-semibold uppercase tracking-wider text-u-muted mb-1">Password</p>
        <p class="text-xs text-u-muted">
          Must be 8+ characters and include 1 capital letter and 1 special character.
        </p>
      </div>

      <div class="px-6 py-4 space-y-4">
        <div>
          <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Current password</label>
          <input type="password" name="current_password"
            class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
        </div>
        <div>
          <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">New password</label>
          <input type="password" name="new_password"
            class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
        </div>
        <div>
          <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Confirm password</label>
          <input type="password" name="confirm_password"
            class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
        </div>
      </div>

      <div class="px-6 py-4 border-t border-u-line flex items-center justify-end bg-u-surface/40">
        <button type="submit" name="change_password"
          class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-sm">
          <i class="bi bi-shield-lock"></i>
          Change password
        </button>
      </div>
    </form>

    <!-- API access -->
    <form method="POST" class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm">

      <div class="px-6 pt-6 pb-2">
        <p class="text-xs font-semibold uppercase tracking-wider text-u-muted mb-1">API access</p>
        <p class="text-xs text-u-muted">Use API keys to connect your applications to our platform.</p>
      </div>

      <div class="px-6 py-4 space-y-5">

        <div>
          <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Test API key</label>
          <div class="flex items-center gap-2">
            <input type="text" readonly value="<?= htmlspecialchars($apiKeys['test_key'] ?? '') ?>"
              class="flex-1 border border-u-line rounded-xl px-4 py-2.5 text-sm text-u-text font-mono bg-u-bg">
            <button type="submit" name="generate_test_key"
              class="text-sm font-semibold px-4 py-2.5 rounded-xl border border-u-line text-u-text hover:bg-u-surface transition shrink-0">
              Generate
            </button>
          </div>
        </div>

        <div>
          <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Live API key</label>
          <div class="flex items-center gap-2">
            <input type="text" readonly value="<?= htmlspecialchars($apiKeys['live_key'] ?? '') ?>"
              class="flex-1 border border-u-line rounded-xl px-4 py-2.5 text-sm text-u-text font-mono bg-u-bg">
            <button type="submit" name="generate_live_key"
              class="text-sm font-semibold px-4 py-2.5 rounded-xl border border-u-line text-u-text hover:bg-u-surface transition shrink-0">
              Generate
            </button>
          </div>
        </div>

      </div>

      <div class="px-6 py-4 border-t border-u-line flex items-center justify-between bg-u-surface/40">
        <a href="<?= $domain ?>documentation/" target="_blank"
          class="text-sm text-u-muted hover:text-u-text transition-colors flex items-center gap-1.5">
          <i class="bi bi-book text-xs"></i> View API documentation
        </a>
      </div>
    </form>

  </main>

<?php include '../../components/client/_user_layout_foot.php'; ?>

</body>
</html>