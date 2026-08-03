<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include_once '../../../server/connection.php';
include_once '../../../server/model.php';
include_once '../../../server/auth/user.php';
include_once '../../../server/etegram_helper.php';

/* ---------------------------------------------------------
   This is where Etegram redirects the user back to after
   they finish (or abandon) checkout — set this exact URL as
   the "Callback URL" in your Etegram dashboard, e.g.
   https://yourdomain.com/user/deposit/status/

   We never trust query params to decide success — anyone
   could hit this URL with ?status=success manually. Every
   check here (on load, on poll, on expiry) goes through
   etegram_helper.php, which asks Etegram directly.
--------------------------------------------------------- */

$accessCode = isset($_GET['access-code'])
    ? explode('?', $_GET['access-code'])[0]
    : null;

$lookup = $_GET['reference']
    ?? $accessCode
    ?? $_GET['ref']
    ?? $_GET['trxref']
    ?? $_SESSION['last_etegram_reference']
    ?? null;

$outcome = 'error';
$message = "We couldn't find your transaction reference. If you completed payment, please check your deposit history — it may still be confirming.";
$deposit = null;

if ($lookup) {
    $result  = etegram_verify_deposit($connection, $id, $lookup);
    $outcome = $result['outcome'];
    $message = $result['message'];
    $deposit = $result['deposit'];
}

unset($_SESSION['last_etegram_reference']);

/* ---------------------------------------------------------
   Countdown: 20 minutes from when the deposit was created,
   not from page load — so refreshing doesn't reset the clock.
   Only relevant while still pending.
--------------------------------------------------------- */
$windowSeconds     = 5 * 60;
$remainingSeconds  = 0;
if ($deposit && $outcome === 'pending') {
    $elapsed          = (int) ($deposit['elapsed_seconds'] ?? 0);
    $remainingSeconds = min($windowSeconds, max(0, $windowSeconds - $elapsed));
}

$pageTitle    = 'Deposit status';
$pageSubtitle = 'Payment confirmation';
$activeNav    = 'Deposit';
include '../../../components/client/_user_layout_head.php';
?>

  <main class="flex-1 w-full px-4 sm:px-6 py-6 sm:py-10">
    <div class="max-w-lg mx-auto bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm">

      <div class="px-5 sm:px-8 py-8 sm:py-10 text-center">

        <div id="statusIcon" class="w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl transition-colors">
          <i id="statusIconGlyph" class="bi"></i>
        </div>

        <h2 id="statusHeading" class="font-display text-lg sm:text-xl font-bold text-u-text mb-2">—</h2>

        <p id="statusMessage" class="text-u-muted text-sm leading-relaxed mb-2">
          <?php echo htmlspecialchars($message); ?>
        </p>

        <!-- Countdown + polling indicator (pending only) -->
        <div id="pendingBlock" class="hidden mt-5 mb-2">
          <div class="inline-flex flex-col items-center gap-2">
            <div class="relative w-20 h-20">
              <svg class="w-20 h-20 -rotate-90" viewBox="0 0 80 80">
                <circle cx="40" cy="40" r="34" fill="none" stroke="currentColor" class="text-u-line" stroke-width="6" />
                <circle id="countdownRing" cx="40" cy="40" r="34" fill="none" stroke="currentColor" class="text-blue-500" stroke-width="6"
                  stroke-linecap="round" stroke-dasharray="213.6" stroke-dashoffset="0" style="transition: stroke-dashoffset 1s linear;" />
              </svg>
              <div class="absolute inset-0 flex items-center justify-center">
                <span id="countdownText" class="font-mono text-sm font-semibold text-u-text">05:00</span>
              </div>
            </div>
            <p class="text-xs text-u-muted flex items-center gap-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
              Checking automatically every 30 seconds
            </p>
            <?php if ($deposit): ?>
              <!-- TEMP DEBUG — remove once countdown is confirmed working -->
              <p class="text-[10px] text-u-muted/70 font-mono">
                debug: elapsed <?php echo (int) ($deposit['elapsed_seconds'] ?? -1); ?>s / window <?php echo (int) $windowSeconds; ?>s / remaining <?php echo (int) $remainingSeconds; ?>s
              </p>
            <?php endif; ?>
          </div>
        </div>

        <!-- Transaction details -->
        <?php if ($deposit): ?>
          <div class="mt-6 text-left border border-u-line rounded-xl overflow-hidden bg-u-surface">

            <div class="px-4 py-3 border-b border-u-line">
              <h3 class="font-semibold text-u-text text-sm">Transaction details</h3>
            </div>

            <div class="divide-y divide-u-line text-sm">

              <div class="flex justify-between gap-3 px-4 py-3">
                <span class="text-u-muted shrink-0">Reference</span>
                <span class="font-medium text-u-text font-mono text-xs sm:text-sm text-right break-all"><?php echo htmlspecialchars($deposit['reference']); ?></span>
              </div>

              <div class="flex justify-between gap-3 px-4 py-3">
                <span class="text-u-muted shrink-0">Payment method</span>
                <span class="font-medium text-u-text capitalize">Etegram</span>
              </div>

              <div class="flex justify-between gap-3 px-4 py-3">
                <span class="text-u-muted shrink-0">Amount</span>
                <span class="text-right">
                  <span class="block font-semibold text-u-text">₦<?php echo number_format((float) $deposit['amount'], 2); ?></span>
                  <span class="block text-xs text-u-muted">$<?php echo number_format((float) $deposit['amount_in_dollar'], 2); ?></span>
                </span>
              </div>

              <div class="flex justify-between gap-3 px-4 py-3">
                <span class="text-u-muted shrink-0">Status</span>
                <span id="statusBadge" class="px-3 py-1 rounded-full text-xs font-semibold">—</span>
              </div>

              <div class="flex justify-between gap-3 px-4 py-3">
                <span class="text-u-muted shrink-0">Date</span>
                <span class="font-medium text-u-text text-xs sm:text-sm text-right"><?php echo date('d M Y, h:i A', strtotime($deposit['created_at'])); ?></span>
              </div>

            </div>
          </div>
        <?php endif; ?>

        <div id="actionButtons" class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-2.5 sm:gap-3 mt-6<?php echo $outcome === 'pending' ? ' hidden' : ''; ?>">
          <a href="../" class="text-sm font-semibold px-4 py-2.5 rounded-xl border border-u-line text-u-text hover:bg-u-surface transition text-center">
            Make another deposit
          </a>
          <a href="../history/" class="text-sm font-semibold px-4 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white hover:from-blue-400 hover:to-indigo-500 transition text-center">
            View deposit history
          </a>
        </div>
      </div>
    </div>
  </main>

<?php include '../../../components/client/_user_layout_foot.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {

const domain = "<?php echo $domain ?>";
const reference = <?php echo json_encode($deposit['reference'] ?? $lookup); ?>;

let outcome = <?php echo json_encode($outcome); ?>;
let message = <?php echo json_encode($message); ?>;
let depositStatus = <?php echo json_encode($deposit['status'] ?? null); ?>;
let remainingSeconds = <?php echo (int) $remainingSeconds; ?>;

const RING_CIRCUMFERENCE = 213.6; // 2 * π * 34
const WINDOW_SECONDS = <?php echo (int) $windowSeconds; ?>;

// Debug: open DevTools > Console to see the exact values this page
// started with. If remainingSeconds is already 0/near-0 on a *fresh*
// deposit, the bug is server-side (elapsed_seconds). If it starts
// correct (e.g. ~295) but never ticks down in the UI, the bug is in
// the interval/render below.
console.log('[etegram-status] init', { outcome, remainingSeconds, WINDOW_SECONDS, reference, depositStatus });

let pollTimer = null;
let countdownTimer = null;

function statusMeta(o) {
  switch (o) {
    case 'success':
    case 'already':
      return {
        heading: o === 'already' ? 'Already confirmed' : 'Payment confirmed',
        icon: 'bi-check-circle-fill',
        iconWrap: 'bg-emerald-50 text-emerald-500',
        badge: 'bg-emerald-100 text-emerald-700',
        badgeLabel: 'Approved',
      };
    case 'failed':
      return {
        heading: 'Payment cancelled',
        icon: 'bi-x-circle-fill',
        iconWrap: 'bg-rose-50 text-rose-500',
        badge: 'bg-rose-100 text-rose-700',
        badgeLabel: 'Declined',
      };
    case 'pending':
      return {
        heading: 'Waiting for your payment',
        icon: 'bi-hourglass-split',
        iconWrap: 'bg-blue-50 text-blue-500',
        badge: 'bg-amber-100 text-amber-700',
        badgeLabel: 'Pending',
      };
    default:
      return {
        heading: "Couldn't confirm yet",
        icon: 'bi-exclamation-circle-fill',
        iconWrap: 'bg-amber-50 text-amber-500',
        badge: 'bg-slate-100 text-slate-700',
        badgeLabel: depositStatus ? depositStatus.charAt(0).toUpperCase() + depositStatus.slice(1) : 'Unknown',
      };
  }
}

function render() {
  try {
    const meta = statusMeta(outcome);

    document.getElementById('statusHeading').textContent = meta.heading;
    document.getElementById('statusMessage').textContent = message;

    const iconWrap = document.getElementById('statusIcon');
    iconWrap.className = 'w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl transition-colors ' + meta.iconWrap;
    document.getElementById('statusIconGlyph').className = 'bi ' + meta.icon;

    const badge = document.getElementById('statusBadge');
    if (badge) {
      badge.className = 'px-3 py-1 rounded-full text-xs font-semibold ' + meta.badge;
      badge.textContent = meta.badgeLabel;
    }

    const pendingBlock = document.getElementById('pendingBlock');
    const actionButtons = document.getElementById('actionButtons');
    if (outcome === 'pending') {
      pendingBlock.classList.remove('hidden');
      if (actionButtons) actionButtons.classList.add('hidden');
    } else {
      pendingBlock.classList.add('hidden');
      if (actionButtons) actionButtons.classList.remove('hidden');
      stopPolling();
      stopCountdown();
    }
  } catch (err) {
    console.error('[etegram-status] render() failed:', err);
  }
}

function renderCountdown() {
  const minutes = Math.floor(remainingSeconds / 60);
  const seconds = remainingSeconds % 60;
  document.getElementById('countdownText').textContent =
    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

  const ring = document.getElementById('countdownRing');
  const fraction = Math.max(0, remainingSeconds / WINDOW_SECONDS);
  ring.style.strokeDashoffset = String(RING_CIRCUMFERENCE * (1 - fraction));
}

function stopPolling() {
  if (pollTimer) { clearInterval(pollTimer); pollTimer = null; }
}
function stopCountdown() {
  if (countdownTimer) { clearInterval(countdownTimer); countdownTimer = null; }
}

async function callEtegramVerify(action) {
  const formData = new FormData();
  formData.append('reference', reference);
  formData.append('action', action);

  const res = await fetch(domain + 'server/api/etegram_verify.php', { method: 'POST', body: formData });
  if (!res.ok) throw new Error('HTTP ' + res.status);
  return res.json();
}

async function poll() {
  try {
    const data = await callEtegramVerify('verify');
    console.log('[etegram-status] poll result', data);
    outcome = data.outcome;
    message = data.message;
    depositStatus = data.status;
    render();
  } catch (e) {
    console.error('[etegram-status] verify poll failed:', e);
  }
}

async function expire() {
  stopPolling();
  stopCountdown();
  console.log('[etegram-status] countdown reached zero, calling expire');
  try {
    const data = await callEtegramVerify('expire');
    console.log('[etegram-status] expire result', data);
    outcome = data.outcome;
    message = data.message;
    depositStatus = data.status;
  } catch (e) {
    console.error('[etegram-status] expire call failed:', e);
    outcome = 'failed';
    message = "This payment wasn't completed in time, so it was cancelled.";
  }
  render();
}

// ---- init ----
render();

if (outcome === 'pending' && reference) {
  renderCountdown();

  countdownTimer = setInterval(() => {
    remainingSeconds = Math.max(0, remainingSeconds - 1);
    renderCountdown();
    if (remainingSeconds <= 0) {
      expire();
    }
  }, 1000);

  pollTimer = setInterval(poll, 30000);

  console.log('[etegram-status] countdown + polling started');
} else {
  console.log('[etegram-status] countdown NOT started — outcome is "' + outcome + '", reference is', reference);
}

});
</script>