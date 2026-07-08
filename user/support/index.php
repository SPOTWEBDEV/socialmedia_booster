<?php
include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/user.php';

$flashError   = '';
$flashSuccess = '';

/* ---------- Create a new ticket ---------- */
if (isset($_POST['send_message'])) {
    $message = trim($_POST['message'] ?? '');

    if (empty($message)) {
        $flashError = "Please write your message before sending.";
    } else {
        $insert = mysqli_prepare($connection, "INSERT INTO support_messages (user, message) VALUES (?, ?)");
        mysqli_stmt_bind_param($insert, "is", $id, $message);

        if (mysqli_stmt_execute($insert)) {
            header("Location: ./?sent=1");
            exit;
        } else {
            $flashError = "Database error. Please try again.";
        }
    }
}

if (isset($_GET['sent'])) {
    $flashSuccess = "Your message has been sent. We'll get back to you soon.";
}

/* ---------- Fetch this user's tickets ---------- */
$tickets = [];
$ticketQuery = mysqli_prepare($connection, "SELECT * FROM support_messages WHERE user = ? ORDER BY id DESC");
mysqli_stmt_bind_param($ticketQuery, "i", $id);
mysqli_stmt_execute($ticketQuery);
$ticketResult = mysqli_stmt_get_result($ticketQuery);
while ($row = mysqli_fetch_assoc($ticketResult)) {
    $tickets[] = $row;
}

/* ---------- Badge styling helper (used for list rows) ---------- */
function statusBadge($status) {
    switch ($status) {
        case 'pending':
            return ['Pending', 'bg-rose-50 text-rose-600 border-rose-200'];
        case 'inprogress':
            return ['In Progress', 'bg-sky-50 text-sky-600 border-sky-200'];
        case 'resolved':
            return ['Resolved', 'bg-emerald-50 text-emerald-600 border-emerald-200'];
        case 'replied':
            return ['Replied', 'bg-amber-50 text-amber-600 border-amber-200'];
        default:
            return ['Unknown', 'bg-slate-100 text-slate-500 border-slate-200'];
    }
}

$pageTitle    = 'Support';
$pageSubtitle = 'Get help from our team';
$activeNav    = 'Support';
include '../../components/client/_user_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-8">

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-u-muted mb-6">
      <span class="text-u-text font-medium">Support</span>
    </div>

    <!-- Hero prompt -->
    <div class="mb-8">
      <h2 class="font-display text-2xl font-bold text-u-text mb-2">How can we help?</h2>
      <p class="text-u-muted text-sm leading-relaxed">
        Describe your issue below and our support team will get back to you as soon as possible.
        All of your past tickets are listed underneath &mdash; tap any of them to see the full message and our reply.
      </p>
    </div>

    <?php if (!empty($flashError)): ?>
      <div class="mb-4 flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl px-4 py-3 text-sm">
        <i class="bi bi-exclamation-circle-fill text-rose-500 shrink-0"></i>
        <span><?php echo htmlspecialchars($flashError); ?></span>
      </div>
    <?php endif; ?>

    <?php if (!empty($flashSuccess)): ?>
      <div class="mb-4 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl px-4 py-3 text-sm">
        <i class="bi bi-check-circle-fill text-emerald-500 shrink-0"></i>
        <span><?php echo htmlspecialchars($flashSuccess); ?></span>
      </div>
    <?php endif; ?>

    <!-- Compose form -->
    <form method="POST" class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm mb-10">

      <!-- From (read-only user context) -->
      <div class="px-6 pt-6 pb-2 border-b border-u-line">
        <p class="text-xs font-semibold uppercase tracking-wider text-u-muted mb-3">From</p>
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shrink-0">
            <?php echo strtoupper(substr($fullname ?? 'U', 0, 1)); ?>
          </div>
          <div>
            <p class="text-sm font-semibold text-u-text"><?php echo htmlspecialchars($fullname); ?></p>
            <p class="text-xs text-u-muted"><?php echo htmlspecialchars($email); ?></p>
          </div>
        </div>
      </div>

      <!-- Compose -->
      <div class="px-6 py-5 space-y-5">

        <div>
          <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Your message</label>
          <textarea name="message" id="messageInput" rows="8" required
            placeholder="Describe your issue in detail…&#10;&#10;Include any relevant order IDs, transaction references, or screenshots that might help us resolve this faster."
            class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text placeholder-u-muted/60 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition resize-none bg-u-bg"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
          <div class="flex justify-between items-center mt-1.5">
            <p class="text-xs text-u-muted">We typically reply within a few hours.</p>
            <p class="text-xs text-u-muted font-mono" id="charCount">0 characters</p>
          </div>
        </div>

        <!-- Tips -->
        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
          <p class="text-xs font-semibold text-blue-600 mb-2">Tips for a faster response</p>
          <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside">
            <li>Include your order or transaction reference</li>
            <li>Describe what you expected vs. what happened</li>
            <li>Mention when the issue started</li>
          </ul>
        </div>

      </div>

      <div class="px-6 py-4 border-t border-u-line flex items-center justify-between gap-3 bg-u-surface/40">
        <span class="text-sm text-u-muted flex items-center gap-1.5">
          <i class="bi bi-ticket-perforated"></i>
          <?php echo count($tickets); ?> ticket<?php echo count($tickets) === 1 ? '' : 's'; ?> total
        </span>
        <button type="submit" name="send_message"
          class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-sm">
          <i class="bi bi-send"></i>
          Send message
        </button>
      </div>
    </form>

    <!-- My Tickets -->
    <div class="mb-4 flex items-center justify-between">
      <h3 class="font-display text-lg font-bold text-u-text">My tickets</h3>
    </div>

    <?php if (empty($tickets)): ?>
      <div class="bg-u-card border border-u-line rounded-2xl px-6 py-10 text-center">
        <i class="bi bi-inbox text-2xl text-u-muted mb-2 block"></i>
        <p class="text-sm text-u-muted">You haven't sent any support tickets yet.</p>
      </div>
    <?php else: ?>
      <div class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm divide-y divide-u-line">
        <?php foreach ($tickets as $ticket):
          $preview = mb_substr($ticket['message'], 0, 60);
          if (mb_strlen($ticket['message']) > 60) {
              $preview .= '…';
          }
          [$badgeLabel, $badgeClasses] = statusBadge($ticket['status']);
        ?>
          <button type="button"
            class="ticket-row w-full text-left px-6 py-4 flex items-center gap-4 hover:bg-u-surface/60 transition"
            data-id="<?php echo (int) $ticket['id']; ?>"
            data-message="<?php echo htmlspecialchars($ticket['message'], ENT_QUOTES); ?>"
            data-reply="<?php echo htmlspecialchars($ticket['reply'] ?? '', ENT_QUOTES); ?>"
            data-status-label="<?php echo htmlspecialchars($badgeLabel, ENT_QUOTES); ?>"
            data-status-classes="<?php echo htmlspecialchars($badgeClasses, ENT_QUOTES); ?>"
            data-date="<?php echo htmlspecialchars($ticket['created_at'], ENT_QUOTES); ?>">

            <span class="text-xs font-mono text-u-muted shrink-0 w-14">#<?php echo (int) $ticket['id']; ?></span>

            <span class="flex-1 min-w-0">
              <span class="block text-sm text-u-text truncate"><?php echo htmlspecialchars($preview); ?></span>
              <span class="block text-xs text-u-muted"><?php echo htmlspecialchars($ticket['created_at']); ?></span>
            </span>

            <span class="shrink-0 text-xs font-semibold px-2.5 py-1 rounded-full border <?php echo $badgeClasses; ?>">
              <?php echo $badgeLabel; ?>
            </span>

            <i class="bi bi-chevron-right text-u-muted text-xs shrink-0"></i>
          </button>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </main>

  <!-- Ticket detail modal -->
  <div id="ticketModal" class="fixed inset-0 z-50 hidden">
    <div id="ticketModalBackdrop" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <div class="relative min-h-full flex items-center justify-center px-4 py-8">
      <div class="bg-u-card border border-u-line rounded-2xl shadow-xl w-full max-w-lg overflow-hidden">

        <div class="px-6 py-4 border-b border-u-line flex items-center justify-between gap-3">
          <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-u-muted mb-1">Ticket <span id="modalTicketId"></span></p>
            <span id="modalStatusBadge" class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full border"></span>
          </div>
          <button type="button" id="ticketModalClose" class="text-u-muted hover:text-u-text transition p-1">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>

        <div class="px-6 py-5 space-y-5 max-h-[60vh] overflow-y-auto">
          <div>
            <p class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2">Your message</p>
            <p id="modalMessage" class="text-sm text-u-text whitespace-pre-wrap leading-relaxed"></p>
          </div>

          <div>
            <p class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2">Support reply</p>
            <p id="modalReply" class="text-sm text-u-text whitespace-pre-wrap leading-relaxed"></p>
          </div>
        </div>

        <div class="px-6 py-4 border-t border-u-line flex items-center justify-between gap-3 bg-u-surface/40">
          <span id="modalDate" class="text-xs text-u-muted"></span>
          <button type="button" id="ticketModalCloseBottom"
            class="text-sm font-semibold px-4 py-2 rounded-xl border border-u-line text-u-text hover:bg-u-surface transition">
            Close
          </button>
        </div>

      </div>
    </div>
  </div>

<?php include '../../components/client/_user_layout_foot.php'; ?>

<script>
// Character counter
const msgInput = document.getElementById("messageInput");
const charCount = document.getElementById("charCount");
if (msgInput && charCount) {
  function updateCount() {
    const n = msgInput.value.length;
    charCount.textContent = `${n} character${n === 1 ? "" : "s"}`;
  }
  msgInput.addEventListener("input", updateCount);
  updateCount();
}

// Ticket detail modal
const ticketModal = document.getElementById("ticketModal");
const modalTicketId = document.getElementById("modalTicketId");
const modalMessage = document.getElementById("modalMessage");
const modalReply = document.getElementById("modalReply");
const modalDate = document.getElementById("modalDate");
const modalStatusBadge = document.getElementById("modalStatusBadge");

function openTicketModal(row) {
  modalTicketId.textContent = "#" + row.dataset.id;
  modalMessage.textContent = row.dataset.message;
  modalReply.textContent = row.dataset.reply && row.dataset.reply.trim() !== ""
    ? row.dataset.reply
    : "No reply yet.";
  modalDate.textContent = row.dataset.date;

  modalStatusBadge.textContent = row.dataset.statusLabel;
  modalStatusBadge.className = "inline-block text-xs font-semibold px-2.5 py-1 rounded-full border " + row.dataset.statusClasses;

  ticketModal.classList.remove("hidden");
  document.body.style.overflow = "hidden";
}

function closeTicketModal() {
  ticketModal.classList.add("hidden");
  document.body.style.overflow = "";
}

document.querySelectorAll(".ticket-row").forEach(function (row) {
  row.addEventListener("click", function () {
    openTicketModal(row);
  });
});

document.getElementById("ticketModalClose").addEventListener("click", closeTicketModal);
document.getElementById("ticketModalCloseBottom").addEventListener("click", closeTicketModal);
document.getElementById("ticketModalBackdrop").addEventListener("click", closeTicketModal);

document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") closeTicketModal();
});
</script>

</body>
</html>