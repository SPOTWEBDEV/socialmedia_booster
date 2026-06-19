<?php
include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/admin.php';

// =========================================================
//  ADD ACCOUNT  (traditional POST + redirect, unchanged logic)
// =========================================================
if (isset($_POST['add_account'])) {
    $type = $_POST['type'];
    $status = 'active'; // default status

    if ($type == 'manual') {
        $bank_name = mysqli_real_escape_string($connection, $_POST['bank_name']);
        $account_name = mysqli_real_escape_string($connection, $_POST['account_name']);
        $account_number = mysqli_real_escape_string($connection, $_POST['account_number']);

        $insertQuery = "INSERT INTO payment_account 
            (type, bank_name, account_name, account_number, status) 
            VALUES ('$type', '$bank_name', '$account_name', '$account_number', '$status')";
    } elseif ($type == 'crypto') {
        $wallet_name = mysqli_real_escape_string($connection, $_POST['wallet_name']);
        $wallet_network = mysqli_real_escape_string($connection, $_POST['wallet_network']);
        $wallet_address = mysqli_real_escape_string($connection, $_POST['wallet_address']);

        $insertQuery = "INSERT INTO payment_account 
            (type, wallet_name, wallet_network, wallet_address, status) 
            VALUES ('$type', '$wallet_name', '$wallet_network', '$wallet_address', '$status')";
    }

    if (isset($insertQuery) && mysqli_query($connection, $insertQuery)) {
        showToast("Payment account added successfully", 'success');
        echo "<script>
            setTimeout(function() {
                window.location.href = './';
            }, 1500);
        </script>";
    } else {
        showToast("Error adding payment account", 'error');
    }
}

$pageTitle    = 'Payment Methods';
$pageSubtitle = 'manual accounts · crypto wallets';
$activeNav    = 'Payment Method';
include '../../components/admin/_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-6">

    <!-- Page header row -->
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
      <div>
        <p class="text-sm text-slate-400">Accounts customers see when funding their balance.</p>
      </div>
      <button id="openAddModal" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition">
        <i class="bi bi-plus-lg"></i>
        Add Account
      </button>
    </div>

    <!-- Summary strip -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Total accounts</p>
        <p id="statTotal" class="font-display text-2xl font-semibold text-white">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Active</p>
        <p id="statActive" class="font-display text-2xl font-semibold text-emerald-400">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Inactive</p>
        <p id="statInactive" class="font-display text-2xl font-semibold text-rose-400">0</p>
      </div>
    </div>

    <!-- Table card -->
    <section class="bg-card border border-line rounded-2xl overflow-hidden">

      <div class="p-5 border-b border-line flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[200px]">
          <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" /></svg>
          <input id="searchInput" type="search" placeholder="Search bank, wallet, name, or address"
            class="w-full bg-surface border border-line rounded-lg pl-9 pr-3 py-2 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
        </div>

        <select id="typeFilter" class="bg-surface border border-line rounded-lg px-3 py-2 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
          <option value="">All types</option>
          <option value="manual">Bank</option>
          <option value="crypto">Crypto</option>
        </select>

        <select id="statusFilter" class="bg-surface border border-line rounded-lg px-3 py-2 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
          <option value="">All statuses</option>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
      </div>

      <div class="overflow-x-auto scrollbar-thin">
        <table class="w-full text-sm">
          <thead>
            <tr class="border-b border-line text-left text-xs uppercase tracking-wider text-slate-500">
              <th class="px-5 py-3 font-medium font-mono">#</th>
              <th class="px-3 py-3 font-medium">Type</th>
              <th class="px-3 py-3 font-medium">Bank / Wallet</th>
              <th class="px-3 py-3 font-medium">Account name</th>
              <th class="px-3 py-3 font-medium">Account no. / address</th>
              <th class="px-3 py-3 font-medium">Network</th>
              <th class="px-3 py-3 font-medium">Status</th>
              <th class="px-3 py-3 font-medium text-right">Actions</th>
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
          <p class="text-slate-300 font-medium">No payment accounts yet</p>
          <p class="text-slate-500 text-sm mt-1">Add a bank or crypto account so customers have somewhere to send funds.</p>
        </div>
      </div>

      <div class="border-t border-line px-5 py-3 text-xs text-slate-500 font-mono" id="rowCount">
        0 accounts loaded
      </div>
    </section>
  </main>

  <!-- ===================== ADD ACCOUNT MODAL ===================== -->
  <div id="addModalOverlay" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60" id="addModalBackdrop"></div>

    <div class="modal-in relative w-full max-w-lg bg-card border border-line rounded-2xl overflow-hidden">
      <form method="POST" id="paymentAccountForm">
        <div class="flex items-center justify-between px-6 py-5 border-b border-line">
          <div>
            <h2 class="font-display font-semibold text-white text-base">Add payment account</h2>
            <p class="text-xs text-slate-500 mt-0.5">Choose a type and fill in the details.</p>
          </div>
          <button type="button" id="closeAddModal" class="w-8 h-8 rounded-lg hover:bg-surface flex items-center justify-center text-slate-400 hover:text-white transition">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>

        <div class="px-6 py-5 space-y-4 max-h-[60vh] overflow-y-auto scrollbar-thin">

          <div>
            <label class="text-xs text-slate-400 mb-1.5 block">Account type</label>
            <select name="type" id="accountType" required
              class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition">
              <option value="" selected disabled>Select type</option>
              <option value="manual">Bank</option>
              <option value="crypto">Crypto</option>
            </select>
          </div>

          <!-- Bank fields -->
          <div id="bankFields" class="hidden space-y-4">
            <div>
              <label class="text-xs text-slate-400 mb-1.5 block">Bank name</label>
              <input type="text" name="bank_name" placeholder="e.g. GTBank"
                class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
            </div>
            <div>
              <label class="text-xs text-slate-400 mb-1.5 block">Account name</label>
              <input type="text" name="account_name" placeholder="e.g. Booster Yard Ltd"
                class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
            </div>
            <div>
              <label class="text-xs text-slate-400 mb-1.5 block">Account number</label>
              <input type="text" name="account_number" placeholder="0123456789"
                class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition font-mono" />
            </div>
          </div>

          <!-- Crypto fields -->
          <div id="cryptoFields" class="hidden space-y-4">
            <div>
              <label class="text-xs text-slate-400 mb-1.5 block">Wallet name</label>
              <input type="text" name="wallet_name" placeholder="e.g. USDT Wallet"
                class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
            </div>
            <div>
              <label class="text-xs text-slate-400 mb-1.5 block">Network</label>
              <input type="text" name="wallet_network" placeholder="e.g. TRC20, ERC20, BEP20"
                class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
            </div>
            <div>
              <label class="text-xs text-slate-400 mb-1.5 block">Wallet address</label>
              <input type="text" name="wallet_address" placeholder="0x..."
                class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition font-mono" />
            </div>
          </div>

        </div>

        <div class="px-6 py-4 border-t border-line flex items-center justify-end gap-3">
          <button type="button" id="cancelAddModal" class="text-sm px-4 py-2.5 rounded-lg border border-line text-slate-300 hover:bg-surface hover:text-white transition">
            Cancel
          </button>
          <button type="submit" name="add_account" class="text-sm font-semibold px-4 py-2.5 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white transition">
            Add account
          </button>
        </div>
      </form>
    </div>
  </div>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 right-6 z-50 hidden max-w-sm"></div>

<?php include '../../components/admin/_layout_foot.php'; ?>

<script>
const domain = "<?php echo $domain ?>";

let accounts = [];
let filteredAccounts = [];

// ===================================================
//  FETCH ACCOUNTS
// ===================================================
function loadAccounts() {
  let formData = new FormData();
  formData.append("action", "admin");

  fetch(domain + "server/api/payment_account.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        accounts = data.data;
        filteredAccounts = accounts;
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
  document.getElementById("statTotal").textContent = accounts.length;
  document.getElementById("statActive").textContent = accounts.filter(a => (a.status || '').toLowerCase() === 'active').length;
  document.getElementById("statInactive").textContent = accounts.filter(a => (a.status || '').toLowerCase() !== 'active').length;
}

// ===================================================
//  RENDER TABLE
// ===================================================
function renderTable() {
  const tbody = document.getElementById("tableBody");
  const emptyState = document.getElementById("emptyState");
  tbody.innerHTML = "";

  if (filteredAccounts.length === 0) {
    emptyState.classList.remove("hidden");
    emptyState.classList.add("flex");
  } else {
    emptyState.classList.add("hidden");
    emptyState.classList.remove("flex");
  }

  filteredAccounts.forEach((acc, index) => {
    const isActive = (acc.status || '').toLowerCase() === 'active';
    const typeLabel = acc.type === 'crypto' ? 'Crypto' : 'Bank';
    const typeIcon = acc.type === 'crypto' ? 'bi-currency-bitcoin' : 'bi-bank';

    const tr = document.createElement("tr");
    tr.className = "hover:bg-surface/60 transition-colors";
    tr.innerHTML = `
      <td class="px-5 py-3 font-mono text-slate-500">${index + 1}</td>
      <td class="px-3 py-3">
        <span class="inline-flex items-center gap-1.5 text-xs px-2 py-1 rounded-full bg-slate-500/15 text-slate-300">
          <i class="bi ${typeIcon}"></i> ${typeLabel}
        </span>
      </td>
      <td class="px-3 py-3 font-medium text-slate-200">${escapeHtml(acc.bank_name ?? acc.wallet_name ?? "—")}</td>
      <td class="px-3 py-3 text-slate-300">${escapeHtml(acc.account_name ?? "—")}</td>
      <td class="px-3 py-3 font-mono text-xs text-slate-400">${escapeHtml(acc.account_number ?? acc.wallet_address ?? "—")}</td>
      <td class="px-3 py-3 text-slate-400">${escapeHtml(acc.wallet_network ?? "—")}</td>
      <td class="px-3 py-3">
        <button onclick="toggleStatus(${acc.id}, '${isActive ? 'inactive' : 'active'}')"
          class="inline-flex items-center gap-1.5 text-xs px-2 py-1 rounded-full transition cursor-pointer ${isActive ? 'bg-emerald-500/15 text-emerald-400 hover:bg-emerald-500/25' : 'bg-rose-500/15 text-rose-400 hover:bg-rose-500/25'}"
          title="Click to ${isActive ? 'deactivate' : 'activate'}">
          <span class="w-1.5 h-1.5 rounded-full ${isActive ? 'bg-emerald-400' : 'bg-rose-400'}"></span>
          ${isActive ? 'Active' : 'Inactive'}
        </button>
      </td>
      <td class="px-3 py-3 text-right">
        <button onclick="deleteAccount(${acc.id})" class="inline-flex items-center gap-1.5 text-xs px-3 py-1.5 rounded-lg border border-line text-slate-400 hover:bg-rose-500/10 hover:text-rose-400 hover:border-rose-500/30 transition">
          <i class="bi bi-trash3"></i> Delete
        </button>
      </td>
    `;
    tbody.appendChild(tr);
  });

  document.getElementById("rowCount").textContent = `${accounts.length} account${accounts.length === 1 ? "" : "s"} loaded`;
}

function escapeHtml(str) {
  const div = document.createElement("div");
  div.textContent = str ?? "";
  return div.innerHTML;
}

// ===================================================
//  TOGGLE STATUS
// ===================================================
function toggleStatus(id, newStatus) {
  let formData = new FormData();
  formData.append("id", id);
  formData.append("status", newStatus);

  fetch(domain + "server/api/toggle_payment_account_status.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        const acc = accounts.find(a => a.id == id);
        if (acc) acc.status = newStatus;
        updateStats();
        renderTable();
        showToast(`Account marked ${newStatus}.`, "success");
      } else {
        showToast(data.error || "Couldn't update status.", "error");
      }
    })
    .catch(err => {
      console.error("Toggle status error:", err);
      showToast("Network error — status wasn't changed.", "error");
    });
}

// ===================================================
//  DELETE
// ===================================================
function deleteAccount(id) {
  if (!confirm("Delete this payment account? This can't be undone.")) return;

  let formData = new FormData();
  formData.append("delete", "1");
  formData.append("id", id);

  fetch(domain + "server/api/delete_payment_account.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        accounts = accounts.filter(item => item.id != id);
        filteredAccounts = filteredAccounts.filter(item => item.id != id);
        updateStats();
        renderTable();
        showToast("Account deleted.", "success");
      } else {
        showToast("Failed to delete account.", "error");
      }
    })
    .catch(err => {
      console.error("Delete error:", err);
      showToast("Network error — account wasn't deleted.", "error");
    });
}

// ===================================================
//  SEARCH + FILTER
// ===================================================
function applyFilters() {
  const term = document.getElementById("searchInput").value.toLowerCase().trim();
  const type = document.getElementById("typeFilter").value;
  const status = document.getElementById("statusFilter").value;

  filteredAccounts = accounts.filter(a => {
    const haystack = [a.bank_name, a.wallet_name, a.account_name, a.account_number, a.wallet_address, a.wallet_network]
      .filter(Boolean).join(" ").toLowerCase();
    const matchesTerm = !term || haystack.includes(term);
    const matchesType = !type || a.type === type;
    const matchesStatus = !status || (a.status || '').toLowerCase() === status;
    return matchesTerm && matchesType && matchesStatus;
  });
  renderTable();
}

document.getElementById("searchInput").addEventListener("input", applyFilters);
document.getElementById("typeFilter").addEventListener("change", applyFilters);
document.getElementById("statusFilter").addEventListener("change", applyFilters);

// ===================================================
//  ADD ACCOUNT MODAL
// ===================================================
const addModalOverlay = document.getElementById("addModalOverlay");

function openAddModal() { addModalOverlay.classList.remove("hidden"); }
function closeAddModalFn() { addModalOverlay.classList.add("hidden"); }

document.getElementById("openAddModal").addEventListener("click", openAddModal);
document.getElementById("closeAddModal").addEventListener("click", closeAddModalFn);
document.getElementById("cancelAddModal").addEventListener("click", closeAddModalFn);
document.getElementById("addModalBackdrop").addEventListener("click", closeAddModalFn);

document.getElementById("accountType").addEventListener("change", function () {
  const type = this.value;
  document.getElementById("bankFields").classList.toggle("hidden", type !== "manual");
  document.getElementById("cryptoFields").classList.toggle("hidden", type !== "crypto");
});

<?php if (isset($_POST['add_account'])): ?>
  // server flagged an add attempt this request — keep modal open on validation-style errors,
  // the PHP toast + redirect above handles the success path.
  openAddModal();
<?php endif; ?>

// init
loadAccounts();
</script>

</body>
</html>