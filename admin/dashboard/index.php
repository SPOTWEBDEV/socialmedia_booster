<?php
include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/controller/boosting.php';
include_once '../../server/auth/admin.php';

$api = new Api($api_key);
$balance = $api->balance();

// TOTAL USERS
$totalUsers = mysqli_num_rows(mysqli_query($connection, "SELECT id FROM users"));

// TOTAL ORDERS
$totalOrders = mysqli_num_rows(mysqli_query($connection, "SELECT id FROM user_orders"));

// SUPPORT MESSAGES
$totalSupport = mysqli_num_rows(mysqli_query($connection, "SELECT id FROM support_messages"));

// DEPOSITS
$pendingDeposit  = mysqli_num_rows(mysqli_query($connection, "SELECT id FROM deposits WHERE status='pending'"));
$approvedDeposit = mysqli_num_rows(mysqli_query($connection, "SELECT id FROM deposits WHERE status='approved'"));
$declinedDeposit = mysqli_num_rows(mysqli_query($connection, "SELECT id FROM deposits WHERE status='declined'"));

// TOTAL APPROVED DEPOSIT AMOUNT
$getAmount = mysqli_query($connection, "SELECT SUM(amount) AS total FROM deposits WHERE status='approved'");
$totalDepositAmount = mysqli_fetch_assoc($getAmount)['total'] ?? 0;

// Fetch current price
$get = mysqli_query($connection, "SELECT sitePrice, usd_to_naria_rate FROM admin WHERE id = 1");
$data = mysqli_fetch_assoc($get);
$price = $data['sitePrice'] ?? 0;
$usd_to_naria_rate = $data['usd_to_naria_rate'] ?? 0;

// Update price (traditional POST + redirect, unchanged logic)
if (isset($_POST['update_price'])) {
    $new_price = $_POST['price'];
    $new_usd_to_naria_rate = $_POST['usd_to_naria_rate'];

    if (!is_numeric($new_price)) {
        $flashError = 'Invalid price value or USD to Naira rate value.';
    } else {
        $stmt = $connection->prepare("UPDATE admin SET sitePrice = ?, usd_to_naria_rate = ? WHERE id = 1");
        $stmt->bind_param("ss", $new_price, $new_usd_to_naria_rate);

        if ($stmt->execute()) {
            header("Location: ./?updated=1");
            exit;
        } else {
            $flashError = 'Could not update site settings.';
        }
    }
}

$pageTitle    = 'Dashboard';
$pageSubtitle = 'overview · site settings';
$activeNav    = 'Dashboard';
include '../../components/admin/_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-6">

    <p class="text-sm text-slate-400 mb-6">A snapshot of your platform right now.</p>

    <!-- ===================== OVERVIEW ===================== -->
    <div class="mb-8">
      <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Overview</p>
      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        <div class="bg-card border border-line rounded-2xl p-5 flex items-center gap-4">
          <div class="w-11 h-11 rounded-xl bg-blue-500/15 flex items-center justify-center shrink-0">
            <i class="bi bi-wallet2 text-lg text-blue-400"></i>
          </div>
          <div class="min-w-0">
            <p class="text-xs text-slate-500 mb-1 truncate">Third-party balance</p>
            <p class="font-display text-xl font-semibold text-white">$<?php echo htmlspecialchars($balance->balance); ?></p>
          </div>
        </div>

        <div class="bg-card border border-line rounded-2xl p-5 flex items-center gap-4">
          <div class="w-11 h-11 rounded-xl bg-blue-500/15 flex items-center justify-center shrink-0">
            <i class="bi bi-people text-lg text-blue-400"></i>
          </div>
          <div class="min-w-0">
            <p class="text-xs text-slate-500 mb-1 truncate">Total users</p>
            <p class="font-display text-xl font-semibold text-white"><?php echo (int) $totalUsers; ?></p>
          </div>
        </div>

        <div class="bg-card border border-line rounded-2xl p-5 flex items-center gap-4">
          <div class="w-11 h-11 rounded-xl bg-emerald-500/15 flex items-center justify-center shrink-0">
            <i class="bi bi-bag-check text-lg text-emerald-400"></i>
          </div>
          <div class="min-w-0">
            <p class="text-xs text-slate-500 mb-1 truncate">Total orders</p>
            <p class="font-display text-xl font-semibold text-white"><?php echo (int) $totalOrders; ?></p>
          </div>
        </div>

        <div class="bg-card border border-line rounded-2xl p-5 flex items-center gap-4">
          <div class="w-11 h-11 rounded-xl bg-sky-500/15 flex items-center justify-center shrink-0">
            <i class="bi bi-chat-dots text-lg text-sky-400"></i>
          </div>
          <div class="min-w-0">
            <p class="text-xs text-slate-500 mb-1 truncate">Support messages</p>
            <p class="font-display text-xl font-semibold text-white"><?php echo (int) $totalSupport; ?></p>
          </div>
        </div>

      </div>
    </div>

    <!-- ===================== DEPOSITS ===================== -->
    <div class="mb-8">
      <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Deposits</p>
      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        <div class="bg-card border border-line rounded-2xl p-5 flex items-center gap-4">
          <div class="w-11 h-11 rounded-xl bg-amber-500/15 flex items-center justify-center shrink-0">
            <i class="bi bi-hourglass-split text-lg text-amber-400"></i>
          </div>
          <div class="min-w-0">
            <p class="text-xs text-slate-500 mb-1 truncate">Pending</p>
            <p class="font-display text-xl font-semibold text-white"><?php echo (int) $pendingDeposit; ?></p>
          </div>
        </div>

        <div class="bg-card border border-line rounded-2xl p-5 flex items-center gap-4">
          <div class="w-11 h-11 rounded-xl bg-emerald-500/15 flex items-center justify-center shrink-0">
            <i class="bi bi-check-circle text-lg text-emerald-400"></i>
          </div>
          <div class="min-w-0">
            <p class="text-xs text-slate-500 mb-1 truncate">Approved</p>
            <p class="font-display text-xl font-semibold text-white"><?php echo (int) $approvedDeposit; ?></p>
          </div>
        </div>

        <div class="bg-card border border-line rounded-2xl p-5 flex items-center gap-4">
          <div class="w-11 h-11 rounded-xl bg-rose-500/15 flex items-center justify-center shrink-0">
            <i class="bi bi-x-circle text-lg text-rose-400"></i>
          </div>
          <div class="min-w-0">
            <p class="text-xs text-slate-500 mb-1 truncate">Declined</p>
            <p class="font-display text-xl font-semibold text-white"><?php echo (int) $declinedDeposit; ?></p>
          </div>
        </div>

        <div class="bg-card border border-line rounded-2xl p-5 flex items-center gap-4">
          <div class="w-11 h-11 rounded-xl bg-blue-500/15 flex items-center justify-center shrink-0">
            <i class="bi bi-cash-stack text-lg text-blue-400"></i>
          </div>
          <div class="min-w-0">
            <p class="text-xs text-slate-500 mb-1 truncate">Total approved amount</p>
            <p class="font-display text-xl font-semibold text-white">₦<?php echo number_format($totalDepositAmount); ?></p>
          </div>
        </div>

      </div>
    </div>

    <!-- ===================== SITE SETTINGS ===================== -->
    <div>
      <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Site settings</p>
      <form method="POST" class="bg-card border border-line rounded-2xl overflow-hidden max-w-2xl">
        <div class="px-6 py-5 border-b border-line">
          <h2 class="font-display font-semibold text-white text-sm">Pricing</h2>
          <p class="text-xs text-slate-500 mt-0.5">Used to calculate order costs across the platform.</p>
        </div>

        <div class="px-6 py-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="text-xs text-slate-400 mb-1.5 block">Site order price</label>
            <input type="text" name="price" value="<?php echo htmlspecialchars($price); ?>"
              class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition font-mono" />
          </div>
          <div>
            <label class="text-xs text-slate-400 mb-1.5 block">USD to Naira rate</label>
            <input type="text" name="usd_to_naria_rate" value="<?php echo htmlspecialchars($usd_to_naria_rate); ?>"
              class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition font-mono" />
          </div>
        </div>

        <div class="px-6 py-4 border-t border-line flex justify-end">
          <button type="submit" name="update_price"
            class="text-sm font-semibold px-4 py-2.5 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white transition">
            Save settings
          </button>
        </div>
      </form>
    </div>

  </main>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 right-6 z-50 hidden max-w-sm"></div>

<?php include '../../components/admin/_layout_foot.php'; ?>

<script>
<?php if (isset($_GET['updated'])): ?>
  showToast("Site settings updated successfully.", "success");
<?php endif; ?>
<?php if (isset($flashError)): ?>
  showToast(<?php echo json_encode($flashError); ?>, "error");
<?php endif; ?>
</script>

</body>
</html>
