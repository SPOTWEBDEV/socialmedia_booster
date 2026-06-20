<?php
include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/admin.php';

$pageTitle    = 'Deposits';
$pageSubtitle = 'fund requests · approvals';
$activeNav    = 'Deposit';
include '../../components/admin/_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-6">

    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
      <p class="text-sm text-slate-400">Customer deposit requests. Click a row to review and approve or decline.</p>
    </div>

    <!-- Summary strip -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Total deposits</p>
        <p id="statTotal" class="font-display text-2xl font-semibold text-white">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Pending</p>
        <p id="statPending" class="font-display text-2xl font-semibold text-amber-400">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Approved</p>
        <p id="statApproved" class="font-display text-2xl font-semibold text-emerald-400">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Declined</p>
        <p id="statDeclined" class="font-display text-2xl font-semibold text-rose-400">0</p>
      </div>
    </div>

    <!-- Table card -->
    <section class="bg-card border border-line rounded-2xl overflow-hidden">

      <div class="p-5 border-b border-line flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[200px]">
          <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" /></svg>
          <input id="searchInput" type="search" placeholder="Search name, email, or reference"
            class="w-full bg-surface border border-line rounded-lg pl-9 pr-3 py-2 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
        </div>

        <select id="statusFilter" class="bg-surface border border-line rounded-lg px-3 py-2 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
          <option value="">All statuses</option>
          <option value="pending">Pending</option>
          <option value="approved">Approved</option>
          <option value="declined">Declined</option>
        </select>

        <select id="sortSelect" class="bg-surface border border-line rounded-lg px-3 py-2 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
          <option value="date">Sort: Date</option>
          <option value="amount">Sort: Amount</option>
          <option value="method">Sort: Method</option>
        </select>
      </div>

      <div class="overflow-x-auto scrollbar-thin">
        <table class="w-full text-sm">
          <thead>
            <tr class="border-b border-line text-left text-xs uppercase tracking-wider text-slate-500">
              <th class="px-5 py-3 font-medium font-mono">#</th>
              <th class="px-3 py-3 font-medium">Customer</th>
              <th class="px-3 py-3 font-medium">Reference</th>
              <th class="px-3 py-3 font-medium">Method</th>
              <th class="px-3 py-3 font-medium">Amount</th>
              <th class="px-3 py-3 font-medium">Date</th>
              <th class="px-3 py-3 font-medium">Status</th>
              <th class="px-3 py-3 font-medium text-right">Action</th>
            </tr>
          </thead>
          <tbody id="tableBody" class="divide-y divide-line">
            <!-- rows injected by JS -->
          </tbody>
        </table>

        <div id="emptyState" class="hidden flex-col items-center justify-center text-center py-20 px-6">
          <div class="w-12 h-12 rounded-full bg-surface border border-line flex items-center justify-center mb-3 mx-auto">
            <i class="bi bi-wallet2 text-lg text-slate-500"></i>
          </div>
          <p class="text-slate-300 font-medium">No deposits match this search</p>
          <p class="text-slate-500 text-sm mt-1">Try a different search term or status filter.</p>
        </div>

        <div id="loadingState" class="flex flex-col items-center justify-center text-center py-20 px-6">
          <div class="w-8 h-8 rounded-full border-2 border-line border-t-blue-400 animate-spin mb-3"></div>
          <p class="text-slate-400 text-sm">Loading deposits…</p>
        </div>
      </div>

      <div class="border-t border-line px-5 py-3 text-xs text-slate-500 font-mono" id="rowCount">
        Loading…
      </div>
    </section>
  </main>

  <!-- ===================== SLIDE-OVER: DEPOSIT DETAIL ===================== -->
  <div id="panelOverlay" class="hidden fixed inset-0 z-50">
    <div class="absolute inset-0 bg-black/60" id="panelBackdrop"></div>

    <aside id="depositPanel" class="absolute right-0 top-0 h-full w-full sm:w-[480px] bg-card border-l border-line flex flex-col"
           style="transform: translateX(100%); transition: transform .25s ease-out;">

      <div class="flex items-start justify-between gap-3 px-6 py-5 border-b border-line">
        <div class="min-w-0">
          <p class="text-xs text-slate-500 font-mono mb-1" id="panelRef">Ref —</p>
          <h2 class="font-display font-semibold text-white text-base truncate" id="panelCustomer">—</h2>
          <p class="text-xs text-slate-500 truncate" id="panelEmail">—</p>
        </div>
        <button id="closePanel" class="w-8 h-8 rounded-lg hover:bg-surface flex items-center justify-center text-slate-400 hover:text-white transition shrink-0">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>

      <div class="flex-1 overflow-y-auto scrollbar-thin px-6 py-5 space-y-6">

        <div class="grid grid-cols-2 gap-3">
          <div class="bg-surface border border-line rounded-xl p-4">
            <p class="text-xs text-slate-500 mb-1">Amount</p>
            <p class="font-display text-lg font-semibold text-emerald-400" id="panelAmountUsd">$0.00</p>
            <p class="text-xs text-slate-500 font-mono" id="panelAmountNgn">₦0.00</p>
          </div>
          <div class="bg-surface border border-line rounded-xl p-4">
            <p class="text-xs text-slate-500 mb-1">Status</p>
            <span id="panelStatusBadge" class="inline-flex items-center gap-1.5 text-xs px-2 py-1 rounded-full mt-0.5"></span>
          </div>
        </div>

        <div class="text-xs text-slate-500" id="panelDate">Requested —</div>

        <div class="border-t border-line pt-5">
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Payment details</p>
          <div id="panelPaymentDetails" class="bg-surface border border-line rounded-xl p-4 text-sm text-slate-200 space-y-2">
            —
          </div>
        </div>

        <!-- Approve / decline -->
        <div class="border-t border-line pt-5">
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Decision</p>
          <div class="flex gap-2">
            <button id="approveBtn" class="flex-1 px-4 py-2.5 rounded-lg bg-emerald-500/15 text-emerald-400 hover:bg-emerald-500/25 text-sm font-semibold transition flex items-center justify-center gap-2">
              <i class="bi bi-check-circle"></i> Approve
            </button>
            <button id="declineBtn" class="flex-1 px-4 py-2.5 rounded-lg bg-rose-500/15 text-rose-400 hover:bg-rose-500/25 text-sm font-semibold transition flex items-center justify-center gap-2">
              <i class="bi bi-x-circle"></i> Decline
            </button>
          </div>
          <p class="text-xs text-slate-500 mt-2" id="panelDecisionHint"></p>
        </div>

      </div>
    </aside>
  </div>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 right-6 z-50 hidden max-w-sm"></div>

<?php include '../../components/admin/_layout_foot.php'; ?>

<script>
const domain = "<?php echo $domain ?>";

let deposits = [];
let filteredDeposits = [];
let depositsLoaded = false;
let activeDeposit = null;

// ===================================================
//  FETCH DEPOSITS
// ===================================================
function loadDeposits() {
  document.getElementById("loadingState").classList.remove("hidden");
  document.getElementById("emptyState").classList.add("hidden");
  document.getElementById("tableBody").innerHTML = "";

  let formData = new FormData();
  formData.append("action", "admin");

  fetch(domain + "server/api/deposit.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        deposits = data.data;
        filteredDeposits = deposits;
        updateStats();
        applySort();
      }
    })
    .catch(err => console.error("API ERROR:", err))
    .finally(() => {
      depositsLoaded = true;
      document.getElementById("loadingState").classList.add("hidden");
    });
}

// ===================================================
//  STATS
// ===================================================
function updateStats() {
  document.getElementById("statTotal").textContent = deposits.length;
  document.getElementById("statPending").textContent = deposits.filter(d => (d.status || '').toLowerCase() === 'pending').length;
  document.getElementById("statApproved").textContent = deposits.filter(d => (d.status || '').toLowerCase() === 'approved').length;
  document.getElementById("statDeclined").textContent = deposits.filter(d => (d.status || '').toLowerCase() === 'declined').length;
}

// Note: pending should read as neutral/cautionary (amber), approved as
// success (emerald), declined as a clear rejection (rose) — the original
// page had pending mapped to red and declined to yellow, which read backwards.
function statusMeta(status) {
  switch ((status || '').toLowerCase()) {
    case 'approved': return { label: 'Approved', cls: 'bg-emerald-500/15 text-emerald-400' };
    case 'declined': return { label: 'Declined', cls: 'bg-rose-500/15 text-rose-400' };
    case 'pending':  return { label: 'Pending',  cls: 'bg-amber-500/15 text-amber-400' };
    default:         return { label: status || 'Unknown', cls: 'bg-slate-500/15 text-slate-400' };
  }
}

function escapeHtml(str) {
  const div = document.createElement("div");
  div.textContent = str ?? "";
  return div.innerHTML;
}

function fmtUsd(n) {
  const num = parseFloat(n) || 0;
  return '$' + num.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
}
function fmtNgn(n) {
  const num = parseFloat(n) || 0;
  return '₦' + num.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
}

// ===================================================
//  RENDER TABLE
// ===================================================
function renderTable() {
  const tbody = document.getElementById("tableBody");
  const emptyState = document.getElementById("emptyState");
  tbody.innerHTML = "";

  if (depositsLoaded && filteredDeposits.length === 0) {
    emptyState.classList.remove("hidden");
    emptyState.classList.add("flex");
  } else {
    emptyState.classList.add("hidden");
    emptyState.classList.remove("flex");
  }

  filteredDeposits.forEach((dep, index) => {
    const meta = statusMeta(dep.status);
    const tr = document.createElement("tr");
    tr.className = "hover:bg-surface/60 transition-colors cursor-pointer";
    tr.addEventListener("click", () => openPanel(dep));
    tr.innerHTML = `
      <td class="px-5 py-3 font-mono text-slate-500">#${index + 1}</td>
      <td class="px-3 py-3">
        <div class="text-slate-200">${escapeHtml(dep.fullname)}</div>
        <div class="text-xs text-slate-500">${escapeHtml(dep.email)}</div>
      </td>
      <td class="px-3 py-3 font-mono text-xs text-slate-400">${escapeHtml(dep.reference)}</td>
      <td class="px-3 py-3 text-slate-300 capitalize">${escapeHtml(dep.method)}</td>
      <td class="px-3 py-3">
        <div class="text-slate-200 font-mono">${fmtNgn(dep.amount)}</div>
        <div class="text-xs text-slate-500 font-mono">${fmtUsd(dep.amount_in_dollar)}</div>
      </td>
      <td class="px-3 py-3 text-slate-400 text-xs font-mono">${escapeHtml(dep.created_at)}</td>
      <td class="px-3 py-3">
        <span class="inline-flex items-center gap-1.5 text-xs px-2 py-1 rounded-full ${meta.cls}">
          ${meta.label}
        </span>
      </td>
      <td class="px-3 py-3 text-right">
        <button class="inline-flex items-center gap-1.5 text-xs px-3 py-1.5 rounded-lg border border-line text-slate-300 hover:bg-surface hover:text-white transition">
          <i class="bi bi-eye"></i> View
        </button>
      </td>
    `;
    tbody.appendChild(tr);
  });

  document.getElementById("rowCount").textContent = `${deposits.length} deposit${deposits.length === 1 ? "" : "s"} loaded`;
}

// ===================================================
//  SEARCH + FILTER + SORT
// ===================================================
function applyFilters() {
  const term = document.getElementById("searchInput").value.toLowerCase().trim();
  const status = document.getElementById("statusFilter").value;

  filteredDeposits = deposits.filter(d => {
    const haystack = `${d.fullname} ${d.email} ${d.reference}`.toLowerCase();
    const matchesTerm = !term || haystack.includes(term);
    const matchesStatus = !status || (d.status || '').toLowerCase() === status;
    return matchesTerm && matchesStatus;
  });
  applySort();
}

function applySort() {
  const field = document.getElementById("sortSelect").value;
  filteredDeposits.sort((a, b) => {
    if (field === "amount") return parseFloat(b.amount) - parseFloat(a.amount);
    if (field === "method") return String(a.method).localeCompare(String(b.method));
    return new Date(b.created_at) - new Date(a.created_at);
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
const depositPanel = document.getElementById("depositPanel");

function renderPaymentDetails(dep) {
  const rows = [];
  rows.push(['Payment method', dep.type === 'crypto' ? 'Crypto' : 'Bank']);

  if (dep.type === 'crypto') {
    if (dep.wallet_name) rows.push(['Wallet name', dep.wallet_name]);
    if (dep.wallet_network) rows.push(['Wallet network', dep.wallet_network]);
    if (dep.wallet_address) rows.push(['Wallet address', dep.wallet_address]);
  } else {
    if (dep.bank_name) rows.push(['Bank name', dep.bank_name]);
    if (dep.account_name) rows.push(['Account name', dep.account_name]);
    if (dep.account_number) rows.push(['Account number', dep.account_number]);
  }

  return rows.map(([label, value]) => `
    <div class="flex items-center justify-between gap-3">
      <span class="text-xs text-slate-500">${escapeHtml(label)}</span>
      <span class="text-sm text-slate-200 font-mono text-right break-all">${escapeHtml(value)}</span>
    </div>
  `).join('');
}

function openPanel(dep) {
  activeDeposit = dep;
  const meta = statusMeta(dep.status);

  document.getElementById("panelRef").textContent = `Ref ${dep.reference}`;
  document.getElementById("panelCustomer").textContent = dep.fullname;
  document.getElementById("panelEmail").textContent = dep.email;
  document.getElementById("panelAmountUsd").textContent = fmtUsd(dep.amount_in_dollar);
  document.getElementById("panelAmountNgn").textContent = fmtNgn(dep.amount);
  document.getElementById("panelDate").textContent = `Requested ${dep.created_at}`;
  document.getElementById("panelPaymentDetails").innerHTML = renderPaymentDetails(dep);

  const badge = document.getElementById("panelStatusBadge");
  badge.textContent = meta.label;
  badge.className = `inline-flex items-center gap-1.5 text-xs px-2 py-1 rounded-full mt-0.5 ${meta.cls}`;

  const status = (dep.status || '').toLowerCase();
  const approveBtn = document.getElementById("approveBtn");
  const declineBtn = document.getElementById("declineBtn");
  const hint = document.getElementById("panelDecisionHint");

  approveBtn.disabled = status === 'approved';
  approveBtn.classList.toggle("opacity-40", status === 'approved');
  approveBtn.classList.toggle("cursor-not-allowed", status === 'approved');

  declineBtn.disabled = status === 'declined';
  declineBtn.classList.toggle("opacity-40", status === 'declined');
  declineBtn.classList.toggle("cursor-not-allowed", status === 'declined');

  if (status === 'approved') {
    hint.textContent = "This deposit is already approved. Declining now will remove the credited amount from the user's balance.";
  } else if (status === 'declined') {
    hint.textContent = "This deposit is already declined.";
  } else {
    hint.textContent = "Approving credits the user's balance immediately.";
  }

  panelOverlay.classList.remove("hidden");
  requestAnimationFrame(() => { depositPanel.style.transform = "translateX(0)"; });
}

function closePanel() {
  depositPanel.style.transform = "translateX(100%)";
  setTimeout(() => panelOverlay.classList.add("hidden"), 250);
}

document.getElementById("closePanel").addEventListener("click", closePanel);
document.getElementById("panelBackdrop").addEventListener("click", closePanel);

// ===================================================
//  APPROVE / DECLINE (AJAX)
// ===================================================
function submitDecision(action) {
  if (!activeDeposit) return;

  const formData = new FormData();
  formData.append("action", action);
  formData.append("deposit_id", activeDeposit.id);

  fetch(domain + "server/api/update_deposit_status.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        activeDeposit.status = data.status;
        const dep = deposits.find(d => d.id === activeDeposit.id);
        if (dep) dep.status = data.status;
        updateStats();
        renderTable();
        openPanel(activeDeposit);
        showToast(data.message || "Deposit updated.", "success");
      } else {
        showToast(data.error || "Couldn't update this deposit.", "error");
      }
    })
    .catch(err => {
      console.error("Decision error:", err);
      showToast("Network error — deposit wasn't updated.", "error");
    });
}

document.getElementById("approveBtn").addEventListener("click", () => {
  if (!activeDeposit || activeDeposit.status === 'approved') return;
  submitDecision('approve_deposit');
});

document.getElementById("declineBtn").addEventListener("click", () => {
  if (!activeDeposit || activeDeposit.status === 'declined') return;

  const wasApproved = activeDeposit.status === 'approved';
  const warning = wasApproved
    ? "This deposit was already approved. Declining it now will remove the credited amount from the user's balance. Continue?"
    : "Decline this deposit request?";

  if (!confirm(warning)) return;
  submitDecision('decline_deposit');
});

// ===================================================
//  INIT
// ===================================================
loadDeposits();
</script>

</body>
</html>