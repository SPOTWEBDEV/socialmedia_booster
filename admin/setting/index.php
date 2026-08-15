<?php
include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/admin.php';

// Fetch current admin row
$adminRow = mysqli_fetch_assoc(mysqli_query($connection, "SELECT id, auth_email FROM admin WHERE id = 1"));

$pageTitle    = 'Settings';
$pageSubtitle = 'security · account';
$activeNav    = 'Settings';
include '../../components/admin/_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-6 max-w-2xl">

    <p class="text-sm text-slate-400 mb-6">Manage your admin account security settings.</p>

    <!-- ===================== TABS ===================== -->
    <div class="flex gap-1 mb-6 bg-card border border-line rounded-xl p-1 w-fit">
      <button data-tab="password"
        class="tab-btn px-4 py-2 rounded-lg text-sm font-medium transition tab-active">
        <i class="bi bi-lock mr-1.5"></i> Password
      </button>
      <button data-tab="email"
        class="tab-btn px-4 py-2 rounded-lg text-sm font-medium transition">
        <i class="bi bi-envelope-check mr-1.5"></i> Auth email
      </button>
    </div>

    <!-- ===================== PASSWORD TAB ===================== -->
    <div id="tab-password" class="tab-panel">
      <div class="bg-card border border-line rounded-2xl overflow-hidden">
        <div class="px-6 py-5 border-b border-line">
          <h2 class="font-display font-semibold text-white text-sm">Change password</h2>
          <p class="text-xs text-slate-500 mt-0.5">Your new password will be hashed and stored securely. You'll need it the next time you log in.</p>
        </div>

        <div class="px-6 py-5 space-y-4">
          <div>
            <label class="text-xs text-slate-400 mb-1.5 block">Current password</label>
            <div class="relative">
              <input type="password" id="currentPassword" placeholder="Enter current password"
                class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 pr-10 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
              <button type="button" class="toggle-pw absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300 transition" data-target="currentPassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <div>
            <label class="text-xs text-slate-400 mb-1.5 block">New password</label>
            <div class="relative">
              <input type="password" id="newPassword" placeholder="At least 8 characters"
                class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 pr-10 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
              <button type="button" class="toggle-pw absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300 transition" data-target="newPassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <div>
            <label class="text-xs text-slate-400 mb-1.5 block">Confirm new password</label>
            <div class="relative">
              <input type="password" id="confirmPassword" placeholder="Repeat new password"
                class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 pr-10 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
              <button type="button" class="toggle-pw absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300 transition" data-target="confirmPassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <!-- Password strength meter -->
          <div id="strengthWrap" class="hidden">
            <div class="flex gap-1 mb-1">
              <div class="strength-bar h-1 flex-1 rounded-full bg-line" id="sb1"></div>
              <div class="strength-bar h-1 flex-1 rounded-full bg-line" id="sb2"></div>
              <div class="strength-bar h-1 flex-1 rounded-full bg-line" id="sb3"></div>
              <div class="strength-bar h-1 flex-1 rounded-full bg-line" id="sb4"></div>
            </div>
            <p class="text-xs text-slate-500" id="strengthLabel">Enter a password</p>
          </div>
        </div>

        <div class="px-6 py-4 border-t border-line flex justify-end">
          <button id="changePasswordBtn"
            class="text-sm font-semibold px-4 py-2.5 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white transition flex items-center gap-2">
            <i class="bi bi-lock"></i> Update password
          </button>
        </div>
      </div>
    </div>

    <!-- ===================== AUTH EMAIL TAB ===================== -->
    <div id="tab-email" class="tab-panel hidden">
      <div class="bg-card border border-line rounded-2xl overflow-hidden">
        <div class="px-6 py-5 border-b border-line">
          <h2 class="font-display font-semibold text-white text-sm">Authentication email</h2>
          <p class="text-xs text-slate-500 mt-0.5">This email receives a one-time code whenever you want to verify your identity — for example, before sending a bulk campaign.</p>
        </div>

        <div class="px-6 py-5 space-y-4">

          <?php if (!empty($adminRow['auth_email'])): ?>
            <div class="flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/20 rounded-xl px-4 py-3">
              <i class="bi bi-check-circle-fill text-emerald-400 shrink-0"></i>
              <div>
                <p class="text-sm text-emerald-300 font-medium">Auth email configured</p>
                <p class="text-xs text-slate-400"><?php echo htmlspecialchars($adminRow['auth_email']); ?></p>
              </div>
            </div>
          <?php else: ?>
            <div class="flex items-center gap-3 bg-amber-500/10 border border-amber-500/20 rounded-xl px-4 py-3">
              <i class="bi bi-exclamation-circle-fill text-amber-400 shrink-0"></i>
              <p class="text-sm text-amber-300">No auth email set yet. Add one to enable OTP verification.</p>
            </div>
          <?php endif; ?>

          <div>
            <label class="text-xs text-slate-400 mb-1.5 block">
              <?php echo !empty($adminRow['auth_email']) ? 'Update auth email' : 'Auth email address'; ?>
            </label>
            <input type="email" id="authEmail" value="<?php echo htmlspecialchars($adminRow['auth_email'] ?? ''); ?>"
              placeholder="you@example.com"
              class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
            <p class="text-xs text-slate-500 mt-1.5">We'll send a verification code here whenever you request one from the OTP page.</p>
          </div>
        </div>

        <div class="px-6 py-4 border-t border-line flex items-center justify-between gap-3">
          <a href="./verify/" class="text-sm text-blue-400 hover:text-blue-300 transition flex items-center gap-1.5">
            <i class="bi bi-send text-xs"></i> Send OTP now
          </a>
          <button id="saveEmailBtn"
            class="text-sm font-semibold px-4 py-2.5 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white transition flex items-center gap-2">
            <i class="bi bi-check2"></i> Save email
          </button>
        </div>
      </div>
    </div>

  </main>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 right-6 z-50 hidden max-w-sm"></div>

<?php include '../../components/admin/_layout_foot.php'; ?>

<script>
const domain = "<?php echo $domain ?>";

// ===================================================
//  TABS
// ===================================================
const tabBtns = document.querySelectorAll(".tab-btn");
const tabPanels = document.querySelectorAll(".tab-panel");

function activateTab(name) {
  tabBtns.forEach(b => {
    const active = b.dataset.tab === name;
    b.classList.toggle("tab-active", active);
    b.classList.toggle("bg-surface", active);
    b.classList.toggle("text-white", active);
    b.classList.toggle("text-slate-400", !active);
  });
  tabPanels.forEach(p => {
    p.classList.toggle("hidden", p.id !== `tab-${name}`);
  });
}
tabBtns.forEach(b => b.addEventListener("click", () => activateTab(b.dataset.tab)));
activateTab("password");

// ===================================================
//  TOGGLE PASSWORD VISIBILITY
// ===================================================
document.querySelectorAll(".toggle-pw").forEach(btn => {
  btn.addEventListener("click", () => {
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

// ===================================================
//  PASSWORD STRENGTH METER
// ===================================================
const newPwInput = document.getElementById("newPassword");
const strengthWrap = document.getElementById("strengthWrap");
const strengthLabel = document.getElementById("strengthLabel");
const bars = [document.getElementById("sb1"), document.getElementById("sb2"), document.getElementById("sb3"), document.getElementById("sb4")];

function scorePassword(pw) {
  let score = 0;
  if (pw.length >= 8) score++;
  if (/[A-Z]/.test(pw)) score++;
  if (/[0-9]/.test(pw)) score++;
  if (/[^A-Za-z0-9]/.test(pw)) score++;
  return score;
}

newPwInput.addEventListener("input", () => {
  const pw = newPwInput.value;
  if (!pw) { strengthWrap.classList.add("hidden"); return; }
  strengthWrap.classList.remove("hidden");

  const score = scorePassword(pw);
  const colors = ["bg-rose-500", "bg-amber-400", "bg-blue-400", "bg-emerald-400"];
  const labels = ["Too weak", "Weak", "Good", "Strong"];

  bars.forEach((bar, i) => {
    bar.className = `strength-bar h-1 flex-1 rounded-full transition-colors ${i < score ? colors[score - 1] : "bg-line"}`;
  });
  strengthLabel.textContent = labels[score - 1] || "Too weak";
});

// ===================================================
//  CHANGE PASSWORD
// ===================================================
document.getElementById("changePasswordBtn").addEventListener("click", () => {
  const current = document.getElementById("currentPassword").value.trim();
  const newPw = document.getElementById("newPassword").value;
  const confirm = document.getElementById("confirmPassword").value;

  if (!current || !newPw || !confirm) {
    return showToast("Fill in all three fields.", "warning");
  }
  if (newPw !== confirm) {
    return showToast("New passwords don't match.", "error");
  }
  if (newPw.length < 8) {
    return showToast("New password must be at least 8 characters.", "warning");
  }

  const btn = document.getElementById("changePasswordBtn");
  btn.disabled = true;
  btn.innerHTML = '<span class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin inline-block"></span> Updating…';

  const fd = new FormData();
  fd.append("action", "change_password");
  fd.append("current_password", current);
  fd.append("new_password", newPw);

  fetch(domain + "server/api/update_admin_settings.php", { method: "POST", body: fd })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        showToast("Password updated. Use the new password next time you log in.", "success");
        document.getElementById("currentPassword").value = "";
        document.getElementById("newPassword").value = "";
        document.getElementById("confirmPassword").value = "";
        strengthWrap.classList.add("hidden");
      } else {
        showToast(data.error || "Couldn't update password.", "error");
      }
    })
    .catch(() => showToast("Network error.", "error"))
    .finally(() => {
      btn.disabled = false;
      btn.innerHTML = '<i class="bi bi-lock"></i> Update password';
    });
});

// ===================================================
//  SAVE AUTH EMAIL
// ===================================================
document.getElementById("saveEmailBtn").addEventListener("click", () => {
  const email = document.getElementById("authEmail").value.trim();
  if (!email) return showToast("Enter an email address.", "warning");
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) return showToast("Enter a valid email address.", "error");

  const btn = document.getElementById("saveEmailBtn");
  btn.disabled = true;
  btn.innerHTML = '<span class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin inline-block"></span> Saving…';

  const fd = new FormData();
  fd.append("action", "save_auth_email");
  fd.append("auth_email", email);

  fetch(domain + "server/api/update_admin_settings.php", { method: "POST", body: fd })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        showToast("Auth email saved. You can now use OTP verification.", "success");
      } else {
        showToast(data.error || "Couldn't save email.", "error");
      }
    })
    .catch(() => showToast("Network error.", "error"))
    .finally(() => {
      btn.disabled = false;
      btn.innerHTML = '<i class="bi bi-check2"></i> Save email';
    });
});
</script>

</body>
</html>