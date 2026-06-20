<?php
include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/admin.php';

$pageTitle    = 'Users';
$pageSubtitle = 'accounts · balances · deposit history';
$activeNav    = 'User';
include '../../components/admin/_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-6">

    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
      <p class="text-sm text-slate-400">All registered customers. Click a row to manage their account.</p>
    </div>

    <!-- Summary strip -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Total users</p>
        <p id="statTotal" class="font-display text-2xl font-semibold text-white">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Active</p>
        <p id="statActive" class="font-display text-2xl font-semibold text-emerald-400">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Suspended</p>
        <p id="statSuspended" class="font-display text-2xl font-semibold text-rose-400">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Total balance</p>
        <p id="statBalance" class="font-display text-2xl font-semibold text-blue-400">$0</p>
      </div>
    </div>

    <!-- Table card -->
    <section class="bg-card border border-line rounded-2xl overflow-hidden">

      <div class="p-5 border-b border-line flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[200px]">
          <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" /></svg>
          <input id="searchInput" type="search" placeholder="Search name or email"
            class="w-full bg-surface border border-line rounded-lg pl-9 pr-3 py-2 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
        </div>

        <select id="statusFilter" class="bg-surface border border-line rounded-lg px-3 py-2 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
          <option value="">All statuses</option>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
          <option value="warning">Warning</option>
          <option value="suspended">Suspended</option>
        </select>

        <select id="sortSelect" class="bg-surface border border-line rounded-lg px-3 py-2 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
          <option value="id">Sort: ID</option>
          <option value="name">Sort: Name</option>
          <option value="date">Sort: Date</option>
          <option value="balance">Sort: Balance</option>
        </select>
      </div>

      <div class="overflow-x-auto scrollbar-thin">
        <table class="w-full text-sm">
          <thead>
            <tr class="border-b border-line text-left text-xs uppercase tracking-wider text-slate-500">
              <th class="px-5 py-3 font-medium font-mono">ID</th>
              <th class="px-3 py-3 font-medium">User</th>
              <th class="px-3 py-3 font-medium">Balance</th>
              <th class="px-3 py-3 font-medium">Status</th>
              <th class="px-3 py-3 font-medium">Registered</th>
              <th class="px-3 py-3 font-medium text-right">Action</th>
            </tr>
          </thead>
          <tbody id="tableBody" class="divide-y divide-line">
            <!-- rows injected by JS -->
          </tbody>
        </table>

        <div id="emptyState" class="hidden flex-col items-center justify-center text-center py-20 px-6">
          <div class="w-12 h-12 rounded-full bg-surface border border-line flex items-center justify-center mb-3 mx-auto">
            <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" /></svg>
          </div>
          <p class="text-slate-300 font-medium">No users match this search</p>
          <p class="text-slate-500 text-sm mt-1">Try a different name, email, or status filter.</p>
        </div>
      </div>

      <div class="border-t border-line px-5 py-3 text-xs text-slate-500 font-mono" id="rowCount">
        0 users loaded
      </div>
    </section>
  </main>

  <!-- ===================== SLIDE-OVER: USER DETAIL ===================== -->
  <div id="panelOverlay" class="hidden fixed inset-0 z-50">
    <div class="absolute inset-0 bg-black/60" id="panelBackdrop"></div>

    <aside id="userPanel" class="absolute right-0 top-0 h-full w-full sm:w-[520px] bg-card border-l border-line flex flex-col"
           style="transform: translateX(100%); transition: transform .25s ease-out;">

      <div class="flex items-start justify-between gap-3 px-6 py-5 border-b border-line">
        <div class="min-w-0">
          <p class="text-xs text-slate-500 font-mono mb-1" id="panelUserId">User #—</p>
          <h2 class="font-display font-semibold text-white text-base truncate" id="panelName">—</h2>
          <p class="text-xs text-slate-500 truncate" id="panelEmail">—</p>
        </div>
        <button id="closePanel" class="w-8 h-8 rounded-lg hover:bg-surface flex items-center justify-center text-slate-400 hover:text-white transition shrink-0">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>

      <div class="flex-1 overflow-y-auto scrollbar-thin px-6 py-5 space-y-6">

        <!-- Profile summary -->
        <div class="grid grid-cols-2 gap-3">
          <div class="bg-surface border border-line rounded-xl p-4">
            <p class="text-xs text-slate-500 mb-1">Balance</p>
            <p class="font-display text-lg font-semibold text-emerald-400" id="panelBalance">$0.00</p>
          </div>
          <div class="bg-surface border border-line rounded-xl p-4">
            <p class="text-xs text-slate-500 mb-1">Status</p>
            <span id="panelStatusBadge" class="inline-flex items-center gap-1.5 text-xs px-2 py-1 rounded-full mt-0.5"></span>
          </div>
        </div>

        <div class="text-xs text-slate-500" id="panelRegistered">Registered —</div>

        <div id="panelSuspensionWrap" class="hidden bg-rose-500/5 border border-rose-500/20 rounded-xl p-4">
          <p class="text-xs font-semibold uppercase tracking-wider text-rose-400 mb-1.5">Suspension reason</p>
          <p class="text-sm text-slate-300" id="panelSuspensionReason">—</p>
        </div>

        <!-- Manage account -->
        <div class="border-t border-line pt-5">
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Manage account</p>

          <form method="POST" id="balanceForm" class="mb-4">
            <input type="hidden" name="user_id" id="balanceUserId" value="">
            <label class="text-xs text-slate-400 mb-1.5 block">Set balance</label>
            <div class="flex gap-2">
              <input type="number" step="0.01" name="balance" id="balanceInput" required placeholder="0.00"
                class="flex-1 bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition font-mono" />
              <button type="submit" name="change_balance"
                class="px-4 py-2.5 rounded-lg bg-emerald-500/15 text-emerald-400 hover:bg-emerald-500/25 text-sm font-semibold transition shrink-0">
                Update
              </button>
            </div>
          </form>

          <form method="POST" id="suspendForm">
            <input type="hidden" name="user_id" id="suspendUserId" value="">
            <label class="text-xs text-slate-400 mb-1.5 block">Suspend user</label>
            <textarea name="status_message" id="suspendReasonInput" rows="2" placeholder="Reason for suspension…"
              class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-rose-500/50 focus:border-rose-500/50 transition resize-none mb-2"></textarea>
            <button type="submit" name="suspend_user"
              class="w-full px-4 py-2.5 rounded-lg bg-rose-500/15 text-rose-400 hover:bg-rose-500/25 text-sm font-semibold transition flex items-center justify-center gap-2">
              <i class="bi bi-slash-circle"></i> Suspend user
            </button>
          </form>
        </div>

        <!-- Deposit history -->
        <div class="border-t border-line pt-5">
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Deposit history</p>
          <div id="depositList" class="space-y-2">
            <p class="text-sm text-slate-500" id="depositLoading">Loading deposits…</p>
          </div>
        </div>

      </div>
    </aside>
  </div>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 right-6 z-50 hidden max-w-sm"></div>

<?php include '../../components/admin/_layout_foot.php'; ?>

<script>
const domain = "<?php echo $domain ?>";

let users = [];
let filteredUsers = [];
let activeUserId = null;

// ===================================================
//  FETCH USERS
// ===================================================
function loadUsers() {
  fetch(domain + "server/api/users.php")
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        users = data.data;
        filteredUsers = users;
        updateStats();
        renderTable();
      }
    })
    .catch(err => console.error("API ERROR:", err));
}

// ===================================================
//  STATS
// ===================================================
function updateStats() {
  document.getElementById("statTotal").textContent = users.length;
  document.getElementById("statActive").textContent = users.filter(u => (u.status || '').toLowerCase() === 'active').length;
  document.getElementById("statSuspended").textContent = users.filter(u => (u.status || '').toLowerCase() === 'suspended').length;
  const totalBalance = users.reduce((sum, u) => sum + (parseFloat(u.balance) || 0), 0);
  document.getElementById("statBalance").textContent = '$' + totalBalance.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
}

function statusMeta(status) {
  switch ((status || '').toLowerCase()) {
    case 'active':    return { label: 'Active',    cls: 'bg-emerald-500/15 text-emerald-400', dot: 'bg-emerald-400' };
    case 'inactive':  return { label: 'Inactive',  cls: 'bg-rose-500/15 text-rose-400', dot: 'bg-rose-400' };
    case 'warning':   return { label: 'Warning',   cls: 'bg-amber-500/15 text-amber-400', dot: 'bg-amber-400' };
    case 'suspended': return { label: 'Suspended', cls: 'bg-rose-500/15 text-rose-400', dot: 'bg-rose-400' };
    default:          return { label: status || 'Unknown', cls: 'bg-slate-500/15 text-slate-400', dot: 'bg-slate-400' };
  }
}

function escapeHtml(str) {
  const div = document.createElement("div");
  div.textContent = str ?? "";
  return div.innerHTML;
}

function fmtMoney(n) {
  const num = parseFloat(n) || 0;
  return '$' + num.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
}

// ===================================================
//  RENDER TABLE
// ===================================================
function renderTable() {
  const tbody = document.getElementById("tableBody");
  const emptyState = document.getElementById("emptyState");
  tbody.innerHTML = "";

  if (filteredUsers.length === 0) {
    emptyState.classList.remove("hidden");
    emptyState.classList.add("flex");
  } else {
    emptyState.classList.add("hidden");
    emptyState.classList.remove("flex");
  }

  filteredUsers.forEach(user => {
    const meta = statusMeta(user.status);
    const tr = document.createElement("tr");
    tr.className = "hover:bg-surface/60 transition-colors cursor-pointer";
    tr.addEventListener("click", () => openPanel(user.id));
    tr.innerHTML = `
      <td class="px-5 py-3 font-mono text-slate-500">#${user.id}</td>
      <td class="px-3 py-3">
        <div class="font-medium text-slate-200">${escapeHtml(user.fullname)}</div>
        <div class="text-xs text-slate-500">${escapeHtml(user.email)}</div>
      </td>
      <td class="px-3 py-3 font-mono text-slate-300">${fmtMoney(user.balance)}</td>
      <td class="px-3 py-3">
        <span class="inline-flex items-center gap-1.5 text-xs px-2 py-1 rounded-full ${meta.cls}">
          <span class="w-1.5 h-1.5 rounded-full ${meta.dot}"></span>
          ${meta.label}
        </span>
      </td>
      <td class="px-3 py-3 text-slate-400 text-xs font-mono">${escapeHtml(user.created_at)}</td>
      <td class="px-3 py-3 text-right">
        <button class="inline-flex items-center gap-1.5 text-xs px-3 py-1.5 rounded-lg border border-line text-slate-300 hover:bg-surface hover:text-white transition">
          <i class="bi bi-eye"></i> View
        </button>
      </td>
    `;
    tbody.appendChild(tr);
  });

  document.getElementById("rowCount").textContent = `${users.length} user${users.length === 1 ? "" : "s"} loaded`;
}

// ===================================================
//  SEARCH + FILTER + SORT
// ===================================================
function applyFilters() {
  const term = document.getElementById("searchInput").value.toLowerCase().trim();
  const status = document.getElementById("statusFilter").value;

  filteredUsers = users.filter(u => {
    const matchesTerm = !term || u.fullname.toLowerCase().includes(term) || u.email.toLowerCase().includes(term);
    const matchesStatus = !status || (u.status || '').toLowerCase() === status;
    return matchesTerm && matchesStatus;
  });
  applySort();
}

function applySort() {
  const field = document.getElementById("sortSelect").value;
  filteredUsers.sort((a, b) => {
    if (field === "id") return Number(a.id) - Number(b.id);
    if (field === "date") return new Date(a.created_at) - new Date(b.created_at);
    if (field === "balance") return parseFloat(b.balance) - parseFloat(a.balance);
    return a.fullname.localeCompare(b.fullname);
  });
  renderTable();
}

document.getElementById("searchInput").addEventListener("input", applyFilters);
document.getElementById("statusFilter").addEventListener("change", applyFilters);
document.getElementById("sortSelect").addEventListener("change", applySort);

// ===================================================
//  SLIDE-OVER PANEL
// ===================================================
const panelOverlay = document.getElementById("panelOverlay");
const userPanel = document.getElementById("userPanel");

function openPanel(id) {
  const u = users.find(x => String(x.id) === String(id));
  if (!u) return;

  activeUserId = id;
  const meta = statusMeta(u.status);

  document.getElementById("panelUserId").textContent = `User #${u.id}`;
  document.getElementById("panelName").textContent = u.fullname;
  document.getElementById("panelEmail").textContent = u.email;
  document.getElementById("panelBalance").textContent = fmtMoney(u.balance);
  document.getElementById("panelRegistered").textContent = `Registered ${u.created_at}`;

  const badge = document.getElementById("panelStatusBadge");
  badge.innerHTML = `<span class="w-1.5 h-1.5 rounded-full ${meta.dot}"></span> ${meta.label}`;
  badge.className = `inline-flex items-center gap-1.5 text-xs px-2 py-1 rounded-full mt-0.5 ${meta.cls}`;

  const suspWrap = document.getElementById("panelSuspensionWrap");
  if (u.status_message && u.status_message.trim() !== '') {
    suspWrap.classList.remove("hidden");
    document.getElementById("panelSuspensionReason").textContent = u.status_message;
  } else {
    suspWrap.classList.add("hidden");
  }

  document.getElementById("balanceUserId").value = u.id;
  document.getElementById("balanceInput").value = parseFloat(u.balance) || 0;
  document.getElementById("suspendUserId").value = u.id;
  document.getElementById("suspendReasonInput").value = '';

  loadDeposits(u.id);

  panelOverlay.classList.remove("hidden");
  requestAnimationFrame(() => { userPanel.style.transform = "translateX(0)"; });
}

function closePanel() {
  userPanel.style.transform = "translateX(100%)";
  setTimeout(() => panelOverlay.classList.add("hidden"), 250);
}

document.getElementById("closePanel").addEventListener("click", closePanel);
document.getElementById("panelBackdrop").addEventListener("click", closePanel);

// ===================================================
//  DEPOSIT HISTORY (per user, loaded on panel open)
// ===================================================
function loadDeposits(userId) {
  const list = document.getElementById("depositList");
  list.innerHTML = '<p class="text-sm text-slate-500" id="depositLoading">Loading deposits…</p>';

  let formData = new FormData();
  formData.append("user_id", userId);

  fetch(domain + "server/api/user_deposits.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (!data.success || !data.data || data.data.length === 0) {
        list.innerHTML = '<p class="text-sm text-slate-500">No deposits found.</p>';
        return;
      }
      list.innerHTML = "";
      data.data.forEach(dep => {
        const statusCls = dep.status === 'success' ? 'bg-emerald-500/15 text-emerald-400'
          : dep.status === 'pending' ? 'bg-amber-500/15 text-amber-400'
          : 'bg-rose-500/15 text-rose-400';
        const row = document.createElement("div");
        row.className = "bg-surface border border-line rounded-lg px-3 py-2.5 flex items-center justify-between gap-3";
        row.innerHTML = `
          <div class="min-w-0">
            <p class="text-sm text-slate-200 font-mono">${fmtMoney(dep.amount)}</p>
            <p class="text-xs text-slate-500 truncate">${escapeHtml(dep.method || '—')} · ${escapeHtml(dep.reference || '—')}</p>
            <p class="text-xs text-slate-600">${escapeHtml(dep.created_at)}</p>
          </div>
          <span class="text-xs px-2 py-1 rounded-full shrink-0 ${statusCls}">${escapeHtml((dep.status || '').charAt(0).toUpperCase() + (dep.status || '').slice(1))}</span>
        `;
        list.appendChild(row);
      });
    })
    .catch(err => {
      console.error("Deposit fetch error:", err);
      list.innerHTML = '<p class="text-sm text-rose-400">Couldn\'t load deposits.</p>';
    });
}

// ===================================================
//  MANAGE ACCOUNT: BALANCE + SUSPEND (AJAX)
// ===================================================
document.getElementById("balanceForm").addEventListener("submit", function (e) {
  e.preventDefault();
  if (!activeUserId) return;

  const formData = new FormData();
  formData.append("action", "change_balance");
  formData.append("user_id", document.getElementById("balanceUserId").value);
  formData.append("balance", document.getElementById("balanceInput").value);

  fetch(domain + "server/api/update_user_account.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        const u = users.find(x => String(x.id) === String(activeUserId));
        if (u) u.balance = data.balance;
        updateStats();
        renderTable();
        document.getElementById("panelBalance").textContent = fmtMoney(data.balance);
        showToast("Balance updated.", "success");
      } else {
        showToast(data.error || "Couldn't update balance.", "error");
      }
    })
    .catch(err => {
      console.error("Balance update error:", err);
      showToast("Network error — balance wasn't updated.", "error");
    });
});

document.getElementById("suspendForm").addEventListener("submit", function (e) {
  e.preventDefault();
  if (!activeUserId) return;

  const reason = document.getElementById("suspendReasonInput").value.trim();
  if (reason === '') {
    showToast("Add a reason before suspending.", "warning");
    return;
  }

  if (!confirm("Suspend this user? They won't be able to use their account.")) return;

  const formData = new FormData();
  formData.append("action", "suspend_user");
  formData.append("user_id", document.getElementById("suspendUserId").value);
  formData.append("status_message", reason);

  fetch(domain + "server/api/update_user_account.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        const u = users.find(x => String(x.id) === String(activeUserId));
        if (u) { u.status = data.status; u.status_message = data.status_message; }
        updateStats();
        renderTable();
        openPanel(activeUserId);
        showToast("User suspended.", "success");
      } else {
        showToast(data.error || "Couldn't suspend user.", "error");
      }
    })
    .catch(err => {
      console.error("Suspend error:", err);
      showToast("Network error — user wasn't suspended.", "error");
    });
});

// ===================================================
//  INIT
// ===================================================
loadUsers();
</script>

</body>
</html>
