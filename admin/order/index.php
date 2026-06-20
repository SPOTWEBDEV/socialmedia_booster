<?php
include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/admin.php';

$pageTitle    = 'Orders';
$pageSubtitle = 'all orders placed on the platform';
$activeNav    = 'Orders';
include '../../components/admin/_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-6">

    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
      <p class="text-sm text-slate-400">Every order placed by customers, newest first.</p>
    </div>

    <!-- Summary strip -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Total orders</p>
        <p id="statTotal" class="font-display text-2xl font-semibold text-white">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Completed</p>
        <p id="statCompleted" class="font-display text-2xl font-semibold text-emerald-400">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Processing / Pending</p>
        <p id="statActive" class="font-display text-2xl font-semibold text-amber-400">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Total revenue</p>
        <p id="statRevenue" class="font-display text-2xl font-semibold text-blue-400">$0.00</p>
      </div>
    </div>

    <!-- Table card -->
    <section class="bg-card border border-line rounded-2xl overflow-hidden">

      <div class="p-5 border-b border-line flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[200px]">
          <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" /></svg>
          <input id="searchInput" type="search" placeholder="Search order ID, link, name, or status"
            class="w-full bg-surface border border-line rounded-lg pl-9 pr-3 py-2 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
        </div>

        <select id="statusFilter" class="bg-surface border border-line rounded-lg px-3 py-2 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
          <option value="">All statuses</option>
          <option value="completed">Completed</option>
          <option value="processing">Processing</option>
          <option value="pending">Pending</option>
          <option value="canceled">Canceled</option>
        </select>

        <select id="sortSelect" class="bg-surface border border-line rounded-lg px-3 py-2 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
          <option value="date">Sort: Date</option>
          <option value="order_id">Sort: Order ID</option>
          <option value="price">Sort: Amount</option>
        </select>
      </div>

      <div class="overflow-x-auto scrollbar-thin">
        <table class="w-full text-sm">
          <thead>
            <tr class="border-b border-line text-left text-xs uppercase tracking-wider text-slate-500">
              <th class="px-5 py-3 font-medium font-mono">#</th>
              <th class="px-3 py-3 font-medium">Order ID</th>
              <th class="px-3 py-3 font-medium">Link / Customer</th>
              <th class="px-3 py-3 font-medium">Status</th>
              <th class="px-3 py-3 font-medium">Amount paid</th>
              <th class="px-3 py-3 font-medium text-right">Action</th>
            </tr>
          </thead>
          <tbody id="tableBody" class="divide-y divide-line">
            <!-- rows injected by JS -->
          </tbody>
        </table>

        <div id="emptyState" class="hidden flex-col items-center justify-center text-center py-20 px-6">
          <div class="w-12 h-12 rounded-full bg-surface border border-line flex items-center justify-center mb-3 mx-auto">
            <i class="bi bi-bag text-lg text-slate-500"></i>
          </div>
          <p class="text-slate-300 font-medium">No orders match this search</p>
          <p class="text-slate-500 text-sm mt-1">Try a different search term or status filter.</p>
        </div>

        <div id="loadingState" class="flex flex-col items-center justify-center text-center py-20 px-6">
          <div class="w-8 h-8 rounded-full border-2 border-line border-t-blue-400 animate-spin mb-3"></div>
          <p class="text-slate-400 text-sm">Loading orders…</p>
        </div>
      </div>

      <div class="border-t border-line px-5 py-3 text-xs text-slate-500 font-mono" id="rowCount">
        Loading…
      </div>
    </section>
  </main>

  <!-- ===================== SLIDE-OVER: ORDER DETAIL ===================== -->
  <div id="panelOverlay" class="hidden fixed inset-0 z-50">
    <div class="absolute inset-0 bg-black/60" id="panelBackdrop"></div>

    <aside id="orderPanel" class="absolute right-0 top-0 h-full w-full sm:w-[480px] bg-card border-l border-line flex flex-col"
           style="transform: translateX(100%); transition: transform .25s ease-out;">

      <div class="flex items-start justify-between gap-3 px-6 py-5 border-b border-line">
        <div class="min-w-0">
          <p class="text-xs text-slate-500 font-mono mb-1" id="panelOrderRef">Order —</p>
          <h2 class="font-display font-semibold text-white text-base truncate" id="panelCustomer">—</h2>
        </div>
        <button id="closePanel" class="w-8 h-8 rounded-lg hover:bg-surface flex items-center justify-center text-slate-400 hover:text-white transition shrink-0">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>

      <div class="flex-1 overflow-y-auto scrollbar-thin px-6 py-5 space-y-6">

        <div class="grid grid-cols-2 gap-3">
          <div class="bg-surface border border-line rounded-xl p-4">
            <p class="text-xs text-slate-500 mb-1">Amount paid</p>
            <p class="font-display text-lg font-semibold text-emerald-400" id="panelAmount">$0.00</p>
          </div>
          <div class="bg-surface border border-line rounded-xl p-4">
            <p class="text-xs text-slate-500 mb-1">Status</p>
            <span id="panelStatusBadge" class="inline-flex items-center gap-1.5 text-xs px-2 py-1 rounded-full mt-0.5"></span>
          </div>
        </div>

        <div class="text-xs text-slate-500" id="panelDate">Placed —</div>

        <div class="border-t border-line pt-5">
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Link / target</p>
          <div class="bg-surface border border-line rounded-xl p-4 text-sm text-slate-200 break-all" id="panelLink">
            —
          </div>
        </div>

        <div id="panelExtraWrap" class="border-t border-line pt-5 hidden">
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Additional details</p>
          <div id="panelExtra" class="space-y-2 text-sm text-slate-300"></div>
        </div>

      </div>
    </aside>
  </div>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 right-6 z-50 hidden max-w-sm"></div>

<?php include '../../components/admin/_layout_foot.php'; ?>

<script>
const domain = "<?php echo $domain ?>";

let orders = [];
let filteredOrders = [];
let ordersLoaded = false;

// ===================================================
//  FETCH ORDERS
// ===================================================
function loadOrders() {
  document.getElementById("loadingState").classList.remove("hidden");
  document.getElementById("emptyState").classList.add("hidden");
  document.getElementById("tableBody").innerHTML = "";

  let formData = new FormData();
  formData.append("action", "fetchAllOrders");

  fetch(domain + "server/api/orders.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        orders = data.data;
        filteredOrders = orders;
        updateStats();
        applySort();
      }
    })
    .catch(err => console.error("API ERROR:", err))
    .finally(() => {
      ordersLoaded = true;
      document.getElementById("loadingState").classList.add("hidden");
    });
}

// ===================================================
//  STATS
// ===================================================
function updateStats() {
  document.getElementById("statTotal").textContent = orders.length;
  document.getElementById("statCompleted").textContent = orders.filter(o => (o.status || '').toLowerCase() === 'completed').length;
  document.getElementById("statActive").textContent = orders.filter(o => ['processing', 'pending'].includes((o.status || '').toLowerCase())).length;
  const revenue = orders.reduce((sum, o) => sum + (parseFloat(o.order_price) || 0), 0);
  document.getElementById("statRevenue").textContent = '$' + revenue.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
}

function statusMeta(status) {
  switch ((status || '').toLowerCase()) {
    case 'completed':  return { label: 'Completed',  cls: 'bg-emerald-500/15 text-emerald-400' };
    case 'processing': return { label: 'Processing', cls: 'bg-amber-500/15 text-amber-400' };
    case 'pending':    return { label: 'Pending',     cls: 'bg-sky-500/15 text-sky-400' };
    case 'canceled':   return { label: 'Canceled',    cls: 'bg-rose-500/15 text-rose-400' };
    default:           return { label: status || 'Unknown', cls: 'bg-slate-500/15 text-slate-400' };
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

  if (ordersLoaded && filteredOrders.length === 0) {
    emptyState.classList.remove("hidden");
    emptyState.classList.add("flex");
  } else {
    emptyState.classList.add("hidden");
    emptyState.classList.remove("flex");
  }

  filteredOrders.forEach((order, index) => {
    const meta = statusMeta(order.status);
    const tr = document.createElement("tr");
    tr.className = "hover:bg-surface/60 transition-colors cursor-pointer";
    tr.addEventListener("click", () => openPanel(order));
    tr.innerHTML = `
      <td class="px-5 py-3 font-mono text-slate-500">#${index + 1}</td>
      <td class="px-3 py-3 font-mono text-slate-300">${escapeHtml(order.order_id)}</td>
      <td class="px-3 py-3">
        <div class="text-slate-200 max-w-xs truncate">${escapeHtml(order.social_url)}</div>
        <div class="text-xs text-slate-500">${escapeHtml(order.fullname)}</div>
      </td>
      <td class="px-3 py-3">
        <span class="inline-flex items-center gap-1.5 text-xs px-2 py-1 rounded-full ${meta.cls}">
          ${meta.label}
        </span>
      </td>
      <td class="px-3 py-3">
        <div class="text-slate-200 font-mono">${fmtMoney(order.order_price)}</div>
        <div class="text-xs text-slate-500 font-mono">${escapeHtml(order.created_at)}</div>
      </td>
      <td class="px-3 py-3 text-right">
        <button class="inline-flex items-center gap-1.5 text-xs px-3 py-1.5 rounded-lg border border-line text-slate-300 hover:bg-surface hover:text-white transition">
          <i class="bi bi-eye"></i> View
        </button>
      </td>
    `;
    tbody.appendChild(tr);
  });

  document.getElementById("rowCount").textContent = `${orders.length} order${orders.length === 1 ? "" : "s"} loaded`;
}

// ===================================================
//  SEARCH + FILTER + SORT
// ===================================================
function applyFilters() {
  const term = document.getElementById("searchInput").value.toLowerCase().trim();
  const status = document.getElementById("statusFilter").value;

  filteredOrders = orders.filter(o => {
    const haystack = `${o.order_id} ${o.social_url} ${o.fullname} ${o.status}`.toLowerCase();
    const matchesTerm = !term || haystack.includes(term);
    const matchesStatus = !status || (o.status || '').toLowerCase() === status;
    return matchesTerm && matchesStatus;
  });
  applySort();
}

function applySort() {
  const field = document.getElementById("sortSelect").value;
  filteredOrders.sort((a, b) => {
    if (field === "order_id") return String(a.order_id).localeCompare(String(b.order_id));
    if (field === "price") return parseFloat(b.order_price) - parseFloat(a.order_price);
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
const orderPanel = document.getElementById("orderPanel");

// Fields already shown in the main summary — anything else on the order
// object gets surfaced automatically in "Additional details" below.
const KNOWN_FIELDS = new Set(['order_id', 'social_url', 'fullname', 'status', 'order_price', 'created_at', 'user', 'id']);

function prettifyKey(key) {
  return key.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
}

function openPanel(order) {
  const meta = statusMeta(order.status);

  document.getElementById("panelOrderRef").textContent = `Order ${order.order_id}`;
  document.getElementById("panelCustomer").textContent = order.fullname || '—';
  document.getElementById("panelAmount").textContent = fmtMoney(order.order_price);
  document.getElementById("panelDate").textContent = `Placed ${order.created_at}`;
  document.getElementById("panelLink").textContent = order.social_url || '—';

  const badge = document.getElementById("panelStatusBadge");
  badge.textContent = meta.label;
  badge.className = `inline-flex items-center gap-1.5 text-xs px-2 py-1 rounded-full mt-0.5 ${meta.cls}`;

  // Surface any extra fields the API returns beyond the known set,
  // so this panel stays correct even if more order data gets added later.
  const extraWrap = document.getElementById("panelExtraWrap");
  const extraEl = document.getElementById("panelExtra");
  extraEl.innerHTML = "";
  let hasExtra = false;

  Object.keys(order).forEach(key => {
    if (KNOWN_FIELDS.has(key)) return;
    const value = order[key];
    if (value === null || value === undefined || value === '') return;
    hasExtra = true;
    const row = document.createElement("div");
    row.className = "flex items-center justify-between gap-3 bg-surface border border-line rounded-lg px-3 py-2";
    row.innerHTML = `
      <span class="text-xs text-slate-500">${escapeHtml(prettifyKey(key))}</span>
      <span class="text-sm text-slate-200 font-mono truncate">${escapeHtml(value)}</span>
    `;
    extraEl.appendChild(row);
  });

  extraWrap.classList.toggle("hidden", !hasExtra);

  panelOverlay.classList.remove("hidden");
  requestAnimationFrame(() => { orderPanel.style.transform = "translateX(0)"; });
}

function closePanel() {
  orderPanel.style.transform = "translateX(100%)";
  setTimeout(() => panelOverlay.classList.add("hidden"), 250);
}

document.getElementById("closePanel").addEventListener("click", closePanel);
document.getElementById("panelBackdrop").addEventListener("click", closePanel);

// ===================================================
//  INIT
// ===================================================
loadOrders();
</script>

</body>
</html>