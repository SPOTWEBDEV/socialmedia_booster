<?php

include_once '../../../server/connection.php';
include_once '../../../server/model.php';
include_once '../../../server/auth/user.php';

require_once '../../../server/controller/boosting.php';

$api = new Api($api_key);

$flashError = '';

// Fetch site price
$get = mysqli_query($connection, "SELECT sitePrice FROM admin WHERE id = 1");
$data = mysqli_fetch_assoc($get);
$site_price = floatval($data['sitePrice'] ?? 0);

if (isset($_POST['send_message'])) {

    $service_id     = intval($_POST['service']);
    $order_name     = trim($_POST['order_name']);
    $order_rate     = floatval(str_replace('$', '', $_POST['orderRate']));
    $order_category = trim($_POST['order_category']);
    $social_url     = trim($_POST['order_url']);
    $message        = trim($_POST['message']);
    $quantity       = floatval($_POST['quanity']);

    if ($quantity <= 0 || $order_rate <= 0 || $service_id <= 0) {
        $flashError = "Please check your order details and try again.";
    } else {

        $thirdPartyPrice = ($quantity / 1000) * $order_rate;
        $siteFee         = ($quantity / 1000) * $site_price;

        $sub_price   = round($thirdPartyPrice, 4);
        $order_price = round($thirdPartyPrice + $siteFee, 4);

        if ($order_price <= $balance) {

            $order = $api->order([
                'service'  => $service_id,
                'link'     => $social_url,
                'quantity' => $quantity
            ]);

            if (isset($order->error)) {

                $flashError = "API error: " . htmlspecialchars($order->error);

            } elseif (isset($order->order)) {

                $orderId = $order->order;

                $stmt = $connection->prepare("
                    INSERT INTO user_orders (
                        user, service_id, order_name, sub_price, order_price, 
                        order_category, social_url, message, quanity, order_id
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");

                $stmt->bind_param(
                    "sissdssssi",
                    $id,
                    $service_id,
                    $order_name,
                    $sub_price,
                    $order_price,
                    $order_category,
                    $social_url,
                    $message,
                    $quantity,
                    $orderId
                );

                if ($stmt->execute()) {

                    $deduct = $connection->prepare("UPDATE users SET balance = balance - ? WHERE id = ?");
                    $deduct->bind_param("ds", $order_price, $id);
                    $deduct->execute();

                    header("Location: ../my-order/?placed=" . urlencode($orderId));
                    exit;

                } else {
                    $flashError = "Error saving your order. Please try again.";
                }

            } else {
                $flashError = "We received an unexpected response from the provider. Please try again.";
            }

        } else {
            $flashError = "Insufficient balance. Please fund your wallet first.";
        }
    }
}

$pageTitle    = 'New Order';
$pageSubtitle = 'Boost your social media handle';
$activeNav    = 'Boosting';
include '../../../components/client/_user_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-8">

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-u-muted mb-6">
      <a href="../" class="hover:text-u-text transition-colors">Boost services</a>
      <i class="bi bi-chevron-right text-xs"></i>
      <span class="text-u-text font-medium">New order</span>
    </div>

    <!-- Hero prompt -->
    <div class="mb-8">
      <h2 class="font-display text-2xl font-bold text-u-text mb-2">Boost your social media handle</h2>
      <p class="text-u-muted text-sm leading-relaxed">
        Review the service you picked and fill in the details below. You can track this order on your
        <a href="../my-order/" class="text-blue-500 hover:underline font-medium">order list</a>.
      </p>
    </div>

    <?php if (!empty($flashError)): ?>
      <div class="mb-4 flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl px-4 py-3 text-sm">
        <i class="bi bi-exclamation-circle-fill text-rose-500 shrink-0"></i>
        <span><?php echo $flashError; ?></span>
      </div>
    <?php endif; ?>

    <div id="noOrderState" class="hidden mb-4 flex items-center gap-3 bg-amber-50 border border-amber-200 text-amber-700 rounded-2xl px-4 py-3 text-sm">
      <i class="bi bi-exclamation-triangle-fill text-amber-500 shrink-0"></i>
      <span>No service was selected. Please <a href="../" class="underline font-medium">pick a service</a> first.</span>
    </div>

    <form method="POST" id="orderForm" class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm">

      <!-- Service context -->
      <div class="px-6 pt-6 pb-2 border-b border-u-line">
        <p class="text-xs font-semibold uppercase tracking-wider text-u-muted mb-3">Service</p>
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shrink-0">
            <i class="bi bi-rocket-takeoff"></i>
          </div>
          <div>
            <p class="text-sm font-semibold text-u-text" id="orderNameDisplay">—</p>
            <p class="text-xs text-u-muted" id="orderCategoryDisplay">—</p>
          </div>
        </div>
        <input type="hidden" id="orderName" name="order_name">
        <input type="hidden" id="orderRate" name="orderRate">
        <input type="hidden" id="orderCategory" name="order_category">
        <input type="hidden" id="orderService" name="service">
      </div>

      <!-- Compose -->
      <div class="px-6 py-5 space-y-5">

        <div>
          <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Quantity</label>
          <input type="number" id="quanity" name="quanity" min="0" step="1" required
            class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text placeholder-u-muted/60 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
        </div>

        <div id="priceBreakdown" class="bg-blue-50 border border-blue-100 rounded-xl p-4 hidden">
          <p class="text-xs font-semibold text-blue-600 mb-2">Price breakdown</p>
          <div class="text-xs text-blue-700 space-y-1">
            <p>Third-party fee: <span id="thirdPartyFee" class="font-mono">$0.00</span></p>
            <p>Site fee: <span id="siteFeeDisplay" class="font-mono">$0.00</span></p>
            <p class="font-semibold text-sm text-blue-800 pt-1">Total: <span id="totalDisplay" class="font-mono">$0.00</span></p>
          </div>
          <input type="hidden" id="totalPrice" name="totalprice">
        </div>

        <div>
          <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Your social media URL</label>
          <input type="text" id="order-url" name="order_url" required
            placeholder="Enter the profile/post URL you want to boost"
            class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text placeholder-u-muted/60 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
        </div>

        <div>
          <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Additional notes</label>
          <textarea id="text-area" name="message" rows="3"
            placeholder="Enter any additional instructions here"
            class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text placeholder-u-muted/60 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition resize-none bg-u-bg"></textarea>
        </div>

      </div>

      <div class="px-6 py-4 border-t border-u-line flex items-center justify-between gap-3 bg-u-surface/40">
        <a href="../" class="text-sm text-u-muted hover:text-u-text transition-colors flex items-center gap-1.5">
          <i class="bi bi-arrow-left text-xs"></i> Choose another service
        </a>
        <button type="submit" name="send_message"
          class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-sm">
          <i class="bi bi-send"></i>
          Submit order
        </button>
      </div>
    </form>

  </main>

<?php include '../../../components/client/_user_layout_foot.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const raw = localStorage.getItem("selectedOrder");

  if (!raw) {
    document.getElementById("noOrderState").classList.remove("hidden");
    document.getElementById("orderForm").classList.add("hidden");
    return;
  }

  const order = JSON.parse(raw);

  document.getElementById("orderName").value = order.name;
  document.getElementById("orderRate").value = order.rate;
  document.getElementById("orderCategory").value = order.category;
  document.getElementById("orderService").value = order.service;

  document.getElementById("orderNameDisplay").textContent = order.name;
  document.getElementById("orderCategoryDisplay").textContent = order.category;

  const qtyInput = document.getElementById("quanity");
  qtyInput.placeholder = `Min: ${order.min} - Max: ${order.max}`;
});

document.getElementById("quanity").addEventListener("input", function () {
  const quantity = parseFloat(this.value);
  const rate = parseFloat(document.getElementById("orderRate").value);
  const sitePrice = Number(<?php echo (float) $site_price; ?>);
  const breakdown = document.getElementById("priceBreakdown");

  if (!isNaN(quantity) && !isNaN(rate) && quantity > 0) {
    const thirdPartyPrice = (quantity / 1000) * rate;
    const siteFee = (quantity / 1000) * sitePrice;
    const total = thirdPartyPrice + siteFee;

    document.getElementById("totalPrice").value = total.toFixed(4);
    document.getElementById("thirdPartyFee").textContent = "$" + thirdPartyPrice.toFixed(4);
    document.getElementById("siteFeeDisplay").textContent = "$" + siteFee.toFixed(4);
    document.getElementById("totalDisplay").textContent = "$" + total.toFixed(4);
    breakdown.classList.remove("hidden");
  } else {
    document.getElementById("totalPrice").value = "";
    breakdown.classList.add("hidden");
  }
});
</script>

</body>
</html>