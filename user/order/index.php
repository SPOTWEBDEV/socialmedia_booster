<?php

include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/user.php';

$pageTitle    = 'Boost Services';
$pageSubtitle = 'Grow your social media presence';
$activeNav    = 'Boosting';


// Fetch site price
$get = mysqli_query($connection, "SELECT sitePrice FROM admin WHERE id = 1");
$data = mysqli_fetch_assoc($get);
$site_price = floatval($data['sitePrice'] ?? 0);





include '../../components/client/_user_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-8">

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-u-muted mb-6">
      <span class="text-u-text font-medium">Boost services</span>
    </div>

    <!-- Hero prompt -->
    <div class="mb-6 flex items-start justify-between gap-4 flex-wrap">
      <div>
        <h2 class="font-display text-2xl font-bold text-u-text mb-2">Boost services</h2>
        <p class="text-u-muted text-sm leading-relaxed">
          <span class="font-semibold text-u-text" id="orderCount">0</span> services available right now.
        </p>
      </div>
      <a href="./my-order/"
        class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-sm shrink-0">
        <i class="bi bi-list-check"></i>
        View my orders
      </a>
    </div>

    <!-- Toolbar -->
    <div class="bg-u-card border border-u-line rounded-2xl px-5 py-4 mb-4 flex  flex-wrap items-center gap-3">

      <select id="sortSelect"
        class="border border-u-line rounded-xl px-3 py-2 text-sm text-u-text bg-u-bg focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition">
        <option value="">Sort by</option>
        <option value="name">Name</option>
        <option value="rate">Price</option>
        <option value="service">Service ID</option>
      </select>

      <select id="categoryFilter"
        class="border border-u-line rounded-xl max-w-full px-3 py-2 text-sm text-u-text bg-u-bg focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition">
        <option value="">All categories</option>
      </select>

      <div class="flex items-center gap-2 flex-1 min-w-[200px]">
        <input type="search" id="searchInput" placeholder="Search services"
          class="flex-1 border border-u-line rounded-xl px-3 py-2 text-sm text-u-text placeholder-u-muted/60 bg-u-bg focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition">
      </div>

    </div>

    <!-- Services -->
    <div id="emptyState" class="bg-u-card border border-u-line rounded-2xl px-6 py-10 text-center hidden">
      <i class="bi bi-inbox text-2xl text-u-muted mb-2 block"></i>
      <p class="text-sm text-u-muted" id="emptyMessage">No services available right now.</p>
    </div>

    <div id="servicesGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-4"></div>

  </main>

<?php include '../../components/client/_user_layout_foot.php'; ?>

<script>
let ordersData = [];
let filteredData = [];

function loadOrders() {
  fetch("<?php echo $domain ?>server/api/boosting.php")
    .then(res => res.json())
    .then(data => {
      ordersData = data;
      filteredData = [...ordersData];
      populateCategories();
      renderOrders(filteredData);
    })
    .catch(() => showEmpty("Could not load services right now."));
}

function populateCategories() {
  const categories = [...new Set(ordersData.map(o => o.category))];
  const select = document.getElementById("categoryFilter");
  categories.forEach(cat => {
    const opt = document.createElement("option");
    opt.value = cat;
    opt.textContent = cat;
    select.appendChild(opt);
  });
}

function showEmpty(message) {
  document.getElementById("emptyState").classList.remove("hidden");
  document.getElementById("emptyMessage").textContent = message;
  document.getElementById("servicesGrid").innerHTML = "";
}

function renderOrders(data) {
  document.getElementById("orderCount").textContent = data.length;
  const grid = document.getElementById("servicesGrid");
  const emptyState = document.getElementById("emptyState");

  if (!data.length) {
    showEmpty("No services match your search or filters.");
    return;
  }

  emptyState.classList.add("hidden");
  grid.innerHTML = "";

  data.forEach(item => {
    const sitePrice = Number(<?php echo (float) $site_price; ?>);
    const quantity = 1000;
     const thirdPartyPrice = (quantity / 1000) * item.rate;
    
    const siteFee = (quantity / 1000) * sitePrice;

     console.log(siteFee)
    const total = thirdPartyPrice + siteFee;

    

    const card = document.createElement("div");
    card.className = "bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm flex flex-col";
    card.innerHTML = `
      <div class="px-5 pt-5 pb-3 border-b border-u-line">
        <p class="text-sm font-semibold text-u-text">${item.name}</p>
        <p class="text-xs text-emerald-600 font-medium mt-1">Rate Per 1000: $${total}</p>
      </div>
      <div class="px-5 py-4 flex-1">
        <p class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-1">Category</p>
        <p class="text-sm text-u-text">${item.category}</p>
      </div>
      <div class="px-5 py-4 border-t border-u-line flex items-center justify-between bg-u-surface/40">
        <span class="text-xs font-semibold px-2.5 py-1 rounded-full border bg-sky-50 text-sky-600 border-sky-200">Available</span>
        <button class="order-btn text-sm font-semibold px-4 py-2 rounded-xl border border-u-line text-u-text hover:bg-u-surface transition">
          Order service
        </button>
      </div>
    `;
    card.querySelector(".order-btn").addEventListener("click", () => viewOrder(item));
    grid.appendChild(card);
  });
}

function applyFilters() {
  const searchVal = document.getElementById("searchInput").value.toLowerCase();
  const categoryVal = document.getElementById("categoryFilter").value;

  filteredData = ordersData.filter(o => {
    const matchSearch = o.name.toLowerCase().includes(searchVal);
    const matchCat = categoryVal ? o.category === categoryVal : true;
    return matchSearch && matchCat;
  });

  renderOrders(filteredData);
}

document.getElementById("sortSelect").addEventListener("change", function () {
  const sortBy = this.value;
  if (!sortBy) return;

  filteredData = [...filteredData].sort((a, b) => {
    if (sortBy === "rate") return parseFloat(a.rate) - parseFloat(b.rate);
    if (sortBy === "service") return a.service - b.service;
    return a.name.localeCompare(b.name);
  });

  renderOrders(filteredData);
});

document.getElementById("searchInput").addEventListener("input", applyFilters);
document.getElementById("categoryFilter").addEventListener("change", applyFilters);

function viewOrder(order) {
  localStorage.setItem("selectedOrder", JSON.stringify(order));
  window.location.href = "order-details";
}

loadOrders();
</script>

</body>
</html>