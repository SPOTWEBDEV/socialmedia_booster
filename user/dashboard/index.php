<?php

include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/user.php';

$totalOrder   = mysqli_num_rows(mysqli_query($connection, "SELECT `id` FROM user_orders WHERE user='$id'"));
$totalSupport = mysqli_num_rows(mysqli_query($connection, "SELECT `id` FROM support_messages WHERE user='$id'"));

$pageTitle    = 'Dashboard';
$pageSubtitle = 'Your account at a glance';
$activeNav    = 'Dashboard';
include '../../components/client/_user_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-8">

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-u-muted mb-6">
      <span class="text-u-text font-medium">Dashboard</span>
    </div>

    <!-- Hero prompt -->
    <div class="mb-8">
      <h2 class="font-display text-2xl font-bold text-u-text mb-2">Welcome back, <?php echo htmlspecialchars($fullname); ?></h2>
      <p class="text-u-muted text-sm leading-relaxed">Here's a quick look at your account.</p>
    </div>

    <!-- Stat cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">

      <div class="bg-u-card border border-u-line rounded-2xl px-5 py-5 flex items-center gap-3 shadow-sm">
        <div class="w-11 h-11 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 text-lg shrink-0">
          <i class="bi bi-currency-dollar"></i>
        </div>
        <div>
          <p class="text-xs text-u-muted mb-0.5">Balance</p>
          <p class="text-lg font-bold text-u-text">$<?php echo number_format($balance, 2); ?></p>
        </div>
      </div>

      <div class="bg-u-card border border-u-line rounded-2xl px-5 py-5 flex items-center gap-3 shadow-sm">
        <div class="w-11 h-11 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 text-lg shrink-0">
          <i class="bi bi-bag-check"></i>
        </div>
        <div>
          <p class="text-xs text-u-muted mb-0.5">Total orders</p>
          <p class="text-lg font-bold text-u-text"><?php echo number_format($totalOrder); ?></p>
        </div>
      </div>

      <div class="bg-u-card border border-u-line rounded-2xl px-5 py-5 flex items-center gap-3 shadow-sm">
        <div class="w-11 h-11 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 text-lg shrink-0">
          <i class="bi bi-life-preserver"></i>
        </div>
        <div>
          <p class="text-xs text-u-muted mb-0.5">Support tickets</p>
          <p class="text-lg font-bold text-u-text"><?php echo number_format($totalSupport); ?></p>
        </div>
      </div>

    </div>

    <!-- Recent orders -->
    <div class="mb-4 flex items-center justify-between flex-wrap gap-3">
      <h3 class="font-display text-lg font-bold text-u-text">Recent orders</h3>
      <a href="../my-order/" class="text-sm text-blue-500 hover:underline font-medium">View all orders</a>
    </div>

    <!-- Toolbar -->
    <div class="bg-u-card border border-u-line rounded-2xl px-5 py-4 mb-4 flex flex-wrap items-center gap-3">

      <select id="sortSelect"
        class="border border-u-line rounded-xl px-3 py-2 text-sm text-u-text bg-u-bg focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition">
        <option value="">Sort by</option>
        <option value="order_id">ID</option>
        <option value="price">Price</option>
        <option value="date">Date</option>
      </select>

      <select id="categoryFilter"
        class="border border-u-line rounded-xl px-3 py-2 text-sm text-u-text bg-u-bg focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition">
        <option value="">All statuses</option>
      </select>

      <div class="flex items-center gap-2 flex-1 min-w-[200px]">
        <input type="search" id="searchInput" placeholder="Search orders"
          class="flex-1 border border-u-line rounded-xl px-3 py-2 text-sm text-u-text placeholder-u-muted/60 bg-u-bg focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition">
      </div>

    </div>

    <!-- List -->
    <div id="listWrap" class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm divide-y divide-u-line">
      <div class="px-6 py-10 text-center text-sm text-u-muted" id="emptyState">
        <i class="bi bi-hourglass-split text-2xl mb-2 block"></i>
        Loading your orders…
      </div>
      <div id="rows"></div>
    </div>

  </main>

<?php include '../../components/client/_user_layout_foot.php'; ?>

<script>
let orders = [];
let filteredOrders = [];

const STATUS_STYLES = {
  pending:    { label: "Pending",     classes: "bg-sky-50 text-sky-600 border-sky-200" },
  processing: { label: "Processing", classes: "bg-amber-50 text-amber-600 border-amber-200" },
  completed:  { label: "Completed",  classes: "bg-emerald-50 text-emerald-600 border-emerald-200" },
  canceled:   { label: "Canceled",   classes: "bg-rose-50 text-rose-600 border-rose-200" },
};

function statusStyle(status) {
  const key = (status || "").toLowerCase();
  return STATUS_STYLES[key] || { label: status || "Unknown", classes: "bg-slate-100 text-slate-500 border-slate-200" };
}

function loadOrders() {
  const formData = new FormData();
  formData.append("action", "fetchUserOrders");
  formData.append("userId", "<?php echo (int) $id; ?>");

  fetch("<?php echo $domain; ?>server/api/orders.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        orders = data.data;
        filteredOrders = orders;
        populateStatusCategory();
        renderTable();
      } else {
        showEmpty("Could not load your orders.");
      }
    })
    .catch(() => showEmpty("Could not load your orders."));
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
  document.getElementById("emptyState").innerHTML = `<i class="bi bi-inbox text-2xl mb-2 block"></i>${message}`;
  document.getElementById("rows").innerHTML = "";
}

function renderTable() {
  const rows = document.getElementById("rows");
  const emptyState = document.getElementById("emptyState");

  const rowsToShow = filteredOrders.slice(0, 3);

  if (!rowsToShow.length) {
    showEmpty("No orders yet.");
    return;
  }

  emptyState.classList.add("hidden");
  rows.innerHTML = "";

  rowsToShow.forEach((order) => {
    const style = statusStyle(order.status);

    const row = document.createElement("button");
    row.type = "button";
    row.className = "w-full text-left px-6 py-4 flex items-center gap-4 hover:bg-u-surface/60 transition";

    row.innerHTML = `
      <span class="text-xs font-mono text-u-muted shrink-0 w-24 truncate">${order.order_id}</span>
      <span class="flex-1 min-w-0">
        <span class="block text-sm text-u-text truncate">${order.social_url}</span>
        <span class="block text-xs text-u-muted">${order.created_at}</span>
      </span>
      <span class="shrink-0 text-sm text-u-text font-medium hidden sm:block">$${Number(order.order_price).toFixed(2)}</span>
      <span class="shrink-0 text-xs font-semibold px-2.5 py-1 rounded-full border ${style.classes}">${style.label}</span>
      <i class="bi bi-chevron-right text-u-muted text-xs shrink-0"></i>
    `;

    row.addEventListener("click", () => {
      window.location.href = "../order/my-order?order_id=" + encodeURIComponent(order.order_id);
    });

    rows.appendChild(row);
  });
}

document.getElementById("sortSelect").addEventListener("change", function () {
  const field = this.value;
  if (!field) return;

  filteredOrders = [...filteredOrders].sort((a, b) => {
    if (field === "order_id") return Number(a.id) - Number(b.id);
    if (field === "date") return new Date(a.created_at) - new Date(b.created_at);
    if (field === "price") return Number(a.order_price) - Number(b.order_price);
    return 0;
  });

  renderTable();
});

document.getElementById("searchInput").addEventListener("input", function () {
  const search = this.value.toLowerCase();
  filteredOrders = orders.filter(o =>
    (o.social_url || "").toLowerCase().includes(search) ||
    (o.order_id || "").toLowerCase().includes(search) ||
    (o.status || "").toLowerCase().includes(search)
  );
  renderTable();
});

document.getElementById("categoryFilter").addEventListener("change", function () {
  filteredOrders = this.value === ""
    ? orders
    : orders.filter(o => (o.status || "").toLowerCase() === this.value.toLowerCase());
  renderTable();
});

loadOrders();
</script>

</body>
</html>