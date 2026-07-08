<?php

include_once '../../../server/connection.php';
include_once '../../../server/model.php';
include_once '../../../server/auth/user.php';

$pageTitle    = 'Deposit History';
$pageSubtitle = 'Track all of your past deposits';
$activeNav    = 'Deposit';
include '../../../components/client/_user_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-8">

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-u-muted mb-6">
      <a href="../" class="hover:text-u-text transition-colors">Deposit</a>
      <i class="bi bi-chevron-right text-xs"></i>
      <span class="text-u-text font-medium">History</span>
    </div>

    <?php if (isset($_GET['confirmed'])): ?>
      <div class="mb-4 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl px-4 py-3 text-sm">
        <i class="bi bi-check-circle-fill text-emerald-500 shrink-0"></i>
        <span>Thanks! We've received your payment confirmation and our team will review it shortly.</span>
      </div>
    <?php endif; ?>

    <!-- Hero prompt -->
    <div class="mb-6 flex items-start justify-between gap-4 flex-wrap">
      <div>
        <h2 class="font-display text-2xl font-bold text-u-text mb-2">Deposit history</h2>
        <p class="text-u-muted text-sm leading-relaxed">
          You've made <span class="font-semibold text-u-text" id="orderCount">0</span> deposit(s) so far.
        </p>
      </div>
      <a href="../"
        class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-sm shrink-0">
        <i class="bi bi-plus-circle"></i>
        Fund account
      </a>
    </div>

    <!-- Toolbar -->
    <div class="bg-u-card border border-u-line rounded-2xl px-5 py-4 mb-4 flex flex-wrap items-center gap-3">

      <select id="sortSelect"
        class="border border-u-line rounded-xl px-3 py-2 text-sm text-u-text bg-u-bg focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition">
        <option value="">Sort by</option>
        <option value="id">ID</option>
        <option value="amount">Amount</option>
        <option value="method">Payment method</option>
        <option value="created_at">Date</option>
      </select>

      <select id="categoryFilter"
        class="border border-u-line rounded-xl px-3 py-2 text-sm text-u-text bg-u-bg focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition">
        <option value="">All statuses</option>
      </select>

      <div class="flex items-center gap-2 flex-1 min-w-[200px]">
        <input type="search" id="searchInput" placeholder="Search by reference or method"
          class="flex-1 border border-u-line rounded-xl px-3 py-2 text-sm text-u-text placeholder-u-muted/60 bg-u-bg focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition">
        <button id="searchBtn" type="button"
          class="text-sm font-semibold px-4 py-2 rounded-xl border border-u-line text-u-text hover:bg-u-surface transition shrink-0">
          Search
        </button>
      </div>

    </div>

    <!-- List -->
    <div id="listWrap" class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm divide-y divide-u-line">
      <div class="px-6 py-10 text-center text-sm text-u-muted" id="emptyState">
        <i class="bi bi-hourglass-split text-2xl mb-2 block"></i>
        Loading your deposits…
      </div>
      <div id="rows"></div>
    </div>

  </main>

  <!-- Deposit detail modal -->
  <div id="depositModal" class="fixed inset-0 z-50 hidden">
    <div id="depositModalBackdrop" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <div class="relative min-h-full flex items-center justify-center px-4 py-8">
      <div class="bg-u-card border border-u-line rounded-2xl shadow-xl w-full max-w-lg overflow-hidden">

        <div class="px-6 py-4 border-b border-u-line flex items-center justify-between gap-3">
          <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-u-muted mb-1">Deposit <span id="modalRef"></span></p>
            <span id="modalStatusBadge" class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full border"></span>
          </div>
          <button type="button" id="depositModalClose" class="text-u-muted hover:text-u-text transition p-1">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>

        <div class="px-6 py-5 space-y-4">
          <div class="grid grid-cols-2 gap-4">
            <div>
              <p class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-1">Amount</p>
              <p id="modalAmount" class="text-sm text-u-text font-medium"></p>
            </div>
            <div>
              <p class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-1">Method</p>
              <p id="modalMethod" class="text-sm text-u-text font-medium"></p>
            </div>
          </div>
          <div>
            <p class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-1">Date</p>
            <p id="modalDate" class="text-sm text-u-text font-medium"></p>
          </div>
        </div>

        <div class="px-6 py-4 border-t border-u-line flex items-center justify-end bg-u-surface/40">
          <button type="button" id="depositModalCloseBottom"
            class="text-sm font-semibold px-4 py-2 rounded-xl border border-u-line text-u-text hover:bg-u-surface transition">
            Close
          </button>
        </div>

      </div>
    </div>
  </div>

<?php include '../../../components/client/_user_layout_foot.php'; ?>

<script>
let orders = [];
let filteredOrders = [];

const STATUS_STYLES = {
  pending:    { label: "Pending",     classes: "bg-rose-50 text-rose-600 border-rose-200" },
  inprogress: { label: "In Progress", classes: "bg-sky-50 text-sky-600 border-sky-200" },
  processing: { label: "Processing", classes: "bg-sky-50 text-sky-600 border-sky-200" },
  completed:  { label: "Completed",  classes: "bg-emerald-50 text-emerald-600 border-emerald-200" },
  resolved:   { label: "Resolved",   classes: "bg-emerald-50 text-emerald-600 border-emerald-200" },
  canceled:   { label: "Canceled",   classes: "bg-amber-50 text-amber-600 border-amber-200" },
  declined:   { label: "Declined",   classes: "bg-amber-50 text-amber-600 border-amber-200" },
};

function statusStyle(status) {
  const key = (status || "").toLowerCase();
  return STATUS_STYLES[key] || { label: status || "Unknown", classes: "bg-slate-100 text-slate-500 border-slate-200" };
}

function methodLabel(method) {
  if (method === "manual") return "Manual Bank Transfer";
  if (method === "paystack") return "Automatic Bank Transfer";
  if (method === "crypto") return "Crypto (USDT)";
  return method;
}

// =============================
//  FETCH ORDERS FROM PHP
// =============================
function loadOrders() {
  const formData = new FormData();
  formData.append("action", "user");
  formData.append("userId", "<?php echo (int) $id; ?>");

  fetch("<?php echo $domain; ?>server/api/deposit.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        orders = data.data;
        filteredOrders = orders;
        updateOrderCount();
        populateStatusCategory();
        renderTable();
      } else {
        showEmpty("Could not load your deposits.");
      }
    })
    .catch(() => showEmpty("Could not load your deposits."));
}

function updateOrderCount() {
  document.getElementById("orderCount").textContent = orders.length;
}

function populateStatusCategory() {
  const statuses = [...new Set(orders.map(o => (o.status || "").toLowerCase()))].filter(Boolean);
  const select = document.getElementById("categoryFilter");
  statuses.forEach(status => {
    const opt = document.createElement("option");
    opt.value = status;
    opt.textContent = statusStyle(status).label;
    select.appendChild(opt);
  });
}

function showEmpty(message) {
  document.getElementById("emptyState").classList.remove("hidden");
  document.getElementById("emptyState").innerHTML =
    `<i class="bi bi-inbox text-2xl mb-2 block"></i>${message}`;
  document.getElementById("rows").innerHTML = "";
}

// =============================
// RENDER LIST
// =============================
function renderTable() {
  const rows = document.getElementById("rows");
  const emptyState = document.getElementById("emptyState");

  if (!filteredOrders.length) {
    showEmpty("No deposits match your filters yet.");
    return;
  }

  emptyState.classList.add("hidden");
  rows.innerHTML = "";

  filteredOrders.forEach((deposit, index) => {
    const style = statusStyle(deposit.status);

    const row = document.createElement("button");
    row.type = "button";
    row.className = "deposit-row w-full text-left px-6 py-4 flex items-center gap-4 hover:bg-u-surface/60 transition";

    row.innerHTML = `

    <span class="text-xs font-mono text-u-muted shrink-0  truncate">${index + 1}</span>
      <span class="text-xs font-mono text-u-muted shrink-0 w-24 truncate">${deposit.reference}</span>
      <span class="flex-1 min-w-0">
        <span class="block text-sm text-u-text truncate">${methodLabel(deposit.method)}</span>
        <span class="block text-xs text-u-muted">${deposit.created_at}</span>
      </span>
      <span class="shrink-0 text-sm text-u-text font-medium hidden sm:block">$${Number(deposit.amount_in_dollar).toFixed(2)}</span>
      <span class="shrink-0 text-xs text-capitalize font-semibold px-2.5 py-1 rounded-full border ${style.classes}">${style.label}</span>
      <i class="bi bi-chevron-right text-u-muted text-xs shrink-0"></i>
    `;

    row.addEventListener("click", () => openDepositModal(deposit));
    rows.appendChild(row);
  });
}

// =============================
// SORTING
// =============================
document.getElementById("sortSelect").addEventListener("change", function () {
  const field = this.value;
  if (!field) return;

  filteredOrders = [...filteredOrders].sort((a, b) => {
    if (field === "id") return Number(a.id) - Number(b.id);
    if (field === "created_at") return new Date(a.created_at) - new Date(b.created_at);
    if (field === "method") return a.method.localeCompare(b.method);
    if (field === "amount") return Number(a.amount_in_dollar) - Number(b.amount_in_dollar);
    return 0;
  });

  renderTable();
});

// =============================
// SEARCH (reference + method)
// =============================
document.getElementById("searchBtn").addEventListener("click", () => {
  const search = document.getElementById("searchInput").value.toLowerCase();

  filteredOrders = orders.filter(o =>
    (o.reference || "").toLowerCase().includes(search) ||
    (o.method || "").toLowerCase().includes(search) ||
    (o.status || "").toLowerCase().includes(search)
  );

  renderTable();
});

document.getElementById("searchInput").addEventListener("keydown", (e) => {
  if (e.key === "Enter") document.getElementById("searchBtn").click();
});

// =============================
// STATUS FILTER
// =============================
document.getElementById("categoryFilter").addEventListener("change", function () {
  filteredOrders = this.value === ""
    ? orders
    : orders.filter(o => (o.status || "").toLowerCase() === this.value.toLowerCase());

  renderTable();
});

// =============================
// DETAIL MODAL
// =============================
const depositModal = document.getElementById("depositModal");

function openDepositModal(deposit) {
  const style = statusStyle(deposit.status);

  document.getElementById("modalRef").textContent = deposit.reference;
  document.getElementById("modalAmount").textContent =
    `$${Number(deposit.amount_in_dollar).toFixed(2)} (₦${Number(deposit.amount).toLocaleString("en-NG", { minimumFractionDigits: 2 })})`;
  document.getElementById("modalMethod").textContent = methodLabel(deposit.method);
  document.getElementById("modalDate").textContent = deposit.created_at;

  const badge = document.getElementById("modalStatusBadge");
  badge.textContent = style.label;
  badge.className = "inline-block text-xs font-semibold px-2.5 py-1 rounded-full border " + style.classes;

  depositModal.classList.remove("hidden");
  document.body.style.overflow = "hidden";
}

function closeDepositModal() {
  depositModal.classList.add("hidden");
  document.body.style.overflow = "";
}

document.getElementById("depositModalClose").addEventListener("click", closeDepositModal);
document.getElementById("depositModalCloseBottom").addEventListener("click", closeDepositModal);
document.getElementById("depositModalBackdrop").addEventListener("click", closeDepositModal);
document.addEventListener("keydown", (e) => { if (e.key === "Escape") closeDepositModal(); });

loadOrders();
</script>

</body>
</html>