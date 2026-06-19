<?php
include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/admin.php';

// =========================================================
//  SAVE REPLY  (sets status to 'replied' automatically)
// =========================================================
if (isset($_POST['save_reply'])) {
    $reply  = $_POST['reply'];
    $status = 'replied';
    $msg_id = $_POST['msg_id'];

    $stmt = $connection->prepare("
        UPDATE support_messages
        SET reply = ?, status = ?
        WHERE id = ?
    ");
    $stmt->bind_param("ssi", $reply, $status, $msg_id);

    if ($stmt->execute()) {
        header("Location: ./?replied=$msg_id");
        exit;
    } else {
        $flashError = "Failed to save reply.";
    }
}

// =========================================================
//  DELETE REPLY
// =========================================================
if (isset($_POST['delete_reply'])) {
    $msg_id = $_POST['msg_id'];

    $stmt = $connection->prepare("UPDATE support_messages SET reply = '' WHERE id = ?");
    $stmt->bind_param("i", $msg_id);

    if ($stmt->execute()) {
        header("Location: ./?deleted=$msg_id");
        exit;
    } else {
        $flashError = "Failed to delete reply.";
    }
}

// =========================================================
//  MANUAL STATUS UPDATE (used by the AJAX status dropdown-free
//  flow is intentionally NOT here per spec — status is reply-driven only)
// =========================================================

$pageTitle    = 'Support Tickets';
$pageSubtitle = 'customer messages · replies';
$activeNav    = 'Support';
include '../../components/admin/_layout_head.php';
?>

  <main class="flex-1 w-full px-6 py-6">

    <!-- Page header row -->
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
      <p class="text-sm text-slate-400">Customer support messages and your replies.</p>
    </div>

    <!-- Summary strip -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Total tickets</p>
        <p id="statTotal" class="font-display text-2xl font-semibold text-white">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Pending</p>
        <p id="statPending" class="font-display text-2xl font-semibold text-rose-400">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">In progress</p>
        <p id="statProgress" class="font-display text-2xl font-semibold text-sky-400">0</p>
      </div>
      <div class="bg-card border border-line rounded-2xl p-5">
        <p class="text-xs text-slate-500 mb-1">Replied / resolved</p>
        <p id="statDone" class="font-display text-2xl font-semibold text-emerald-400">0</p>
      </div>
    </div>

    <!-- Table card -->
    <section class="bg-card border border-line rounded-2xl overflow-hidden">

      <div class="p-5 border-b border-line flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[200px]">
          <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" /></svg>
          <input id="searchInput" type="search" placeholder="Search name, email, or message"
            class="w-full bg-surface border border-line rounded-lg pl-9 pr-3 py-2 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
        </div>

        <select id="statusFilter" class="bg-surface border border-line rounded-lg px-3 py-2 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
          <option value="">All statuses</option>
          <option value="pending">Pending</option>
          <option value="inprogress">In progress</option>
          <option value="replied">Replied</option>
          <option value="resolved">Resolved</option>
        </select>
      </div>

      <div class="overflow-x-auto scrollbar-thin">
        <table class="w-full text-sm">
          <thead>
            <tr class="border-b border-line text-left text-xs uppercase tracking-wider text-slate-500">
              <th class="px-5 py-3 font-medium font-mono">Ticket</th>
              <th class="px-3 py-3 font-medium">Customer</th>
              <th class="px-3 py-3 font-medium">Message preview</th>
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
            <i class="bi bi-headset text-lg text-slate-500"></i>
          </div>
          <p class="text-slate-300 font-medium">No tickets match this search</p>
          <p class="text-slate-500 text-sm mt-1">Try a different name, email, or status filter.</p>
        </div>
      </div>

      <div class="border-t border-line px-5 py-3 text-xs text-slate-500 font-mono" id="rowCount">
        0 tickets loaded
      </div>
    </section>
  </main>

  <!-- ===================== SLIDE-OVER: TICKET DETAIL + REPLY ===================== -->
  <div id="panelOverlay" class="hidden fixed inset-0 z-50">
    <div class="absolute inset-0 bg-black/60" id="panelBackdrop"></div>

    <aside id="ticketPanel" class="absolute right-0 top-0 h-full w-full sm:w-[480px] bg-card border-l border-line flex flex-col"
           style="transform: translateX(100%); transition: transform .25s ease-out;">

      <div class="flex items-start justify-between gap-3 px-6 py-5 border-b border-line">
        <div class="min-w-0">
          <p class="text-xs text-slate-500 font-mono mb-1" id="panelTicketId">Ticket #—</p>
          <h2 class="font-display font-semibold text-white text-base truncate" id="panelName">—</h2>
          <p class="text-xs text-slate-500 truncate" id="panelEmail">—</p>
        </div>
        <button id="closePanel" class="w-8 h-8 rounded-lg hover:bg-surface flex items-center justify-center text-slate-400 hover:text-white transition shrink-0">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>

      <div class="flex-1 overflow-y-auto scrollbar-thin px-6 py-5 space-y-6">

        <div>
          <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Status</p>
            <span id="panelStatusBadge" class="text-xs px-2 py-1 rounded-full"></span>
          </div>
          <p class="text-xs text-slate-500" id="panelDate">—</p>
        </div>

        <div>
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Customer message</p>
          <div class="bg-surface border border-line rounded-xl p-4 text-sm text-slate-200 leading-relaxed whitespace-pre-line" id="panelMessage">
            —
          </div>
        </div>

        <div id="panelExistingReplyWrap" class="hidden">
          <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Current reply</p>
            <form method="POST" id="deleteReplyForm">
              <input type="hidden" name="msg_id" id="deleteReplyMsgId" value="">
              <button type="submit" name="delete_reply" class="text-xs text-rose-400 hover:text-rose-300 flex items-center gap-1 transition">
                <i class="bi bi-trash3"></i> Delete reply
              </button>
            </form>
          </div>
          <div class="bg-emerald-500/5 border border-emerald-500/20 rounded-xl p-4 text-sm text-slate-200 leading-relaxed whitespace-pre-line" id="panelExistingReply">
            —
          </div>
        </div>

        <form method="POST" id="replyForm">
          <input type="hidden" name="msg_id" id="replyMsgId" value="">
          <label class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2 block">Write a reply</label>
          <textarea name="reply" id="replyTextarea" rows="5" placeholder="Type your response to the customer…"
            class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition resize-none"></textarea>
          <p class="text-xs text-slate-500 mt-1.5">Saving sets this ticket's status to <span class="text-amber-400 font-medium">Replied</span> automatically.</p>
          <button type="submit" name="save_reply"
            class="mt-3 w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white font-semibold text-sm py-2.5 rounded-lg transition flex items-center justify-center gap-2">
            <i class="bi bi-send"></i> Save reply
          </button>
        </form>

      </div>
    </aside>
  </div>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 right-6 z-50 hidden max-w-sm"></div>

<?php include '../../components/admin/_layout_foot.php'; ?>

<script>
const domain = "<?php echo $domain ?>";

// Tickets are rendered server-side into JSON so we get one DB query,
// then all filtering/search/panel logic runs client-side.
let tickets = <?php
    $query = mysqli_query($connection, "SELECT support_messages.*, users.fullname, users.email FROM support_messages, users WHERE users.id = support_messages.user ORDER BY support_messages.id DESC");
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $rows[] = [
            'id'        => (int) $row['id'],
            'fullname'  => $row['fullname'],
            'email'     => $row['email'],
            'message'   => $row['message'],
            'reply'     => $row['reply'],
            'status'    => $row['status'],
            'created_at'=> $row['created_at'],
        ];
    }
    echo json_encode($rows, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
?>;
let filteredTickets = tickets;

// ===================================================
//  STATUS HELPERS
// ===================================================
function statusMeta(status) {
  switch ((status || '').toLowerCase()) {
    case 'pending':    return { label: 'Pending',     cls: 'bg-rose-500/15 text-rose-400' };
    case 'inprogress': return { label: 'In progress', cls: 'bg-sky-500/15 text-sky-400' };
    case 'resolved':   return { label: 'Resolved',    cls: 'bg-emerald-500/15 text-emerald-400' };
    case 'replied':    return { label: 'Replied',     cls: 'bg-amber-500/15 text-amber-400' };
    default:           return { label: 'Unknown',     cls: 'bg-slate-500/15 text-slate-400' };
  }
}

function escapeHtml(str) {
  const div = document.createElement("div");
  div.textContent = str ?? "";
  return div.innerHTML;
}

// ===================================================
//  STATS
// ===================================================
function updateStats() {
  document.getElementById("statTotal").textContent = tickets.length;
  document.getElementById("statPending").textContent = tickets.filter(t => (t.status || '').toLowerCase() === 'pending').length;
  document.getElementById("statProgress").textContent = tickets.filter(t => (t.status || '').toLowerCase() === 'inprogress').length;
  document.getElementById("statDone").textContent = tickets.filter(t => ['replied', 'resolved'].includes((t.status || '').toLowerCase())).length;
}

// ===================================================
//  RENDER TABLE
// ===================================================
function renderTable() {
  const tbody = document.getElementById("tableBody");
  const emptyState = document.getElementById("emptyState");
  tbody.innerHTML = "";

  if (filteredTickets.length === 0) {
    emptyState.classList.remove("hidden");
    emptyState.classList.add("flex");
  } else {
    emptyState.classList.add("hidden");
    emptyState.classList.remove("flex");
  }

  filteredTickets.forEach(t => {
    const meta = statusMeta(t.status);
    let preview = (t.message || '').slice(0, 50);
    if ((t.message || '').length > 50) preview += '…';

    const tr = document.createElement("tr");
    tr.className = "hover:bg-surface/60 transition-colors cursor-pointer";
    tr.addEventListener("click", () => openPanel(t.id));
    tr.innerHTML = `
      <td class="px-5 py-3 font-mono text-slate-500">#${t.id}</td>
      <td class="px-3 py-3">
        <div class="font-medium text-slate-200">${escapeHtml(t.fullname)}</div>
        <div class="text-xs text-slate-500">${escapeHtml(t.email)}</div>
      </td>
      <td class="px-3 py-3 text-slate-400 max-w-xs truncate">${escapeHtml(preview)}</td>
      <td class="px-3 py-3 text-slate-400 text-xs font-mono">${escapeHtml(t.created_at)}</td>
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

  document.getElementById("rowCount").textContent = `${tickets.length} ticket${tickets.length === 1 ? "" : "s"} loaded`;
}

// ===================================================
//  SEARCH + FILTER
// ===================================================
function applyFilters() {
  const term = document.getElementById("searchInput").value.toLowerCase().trim();
  const status = document.getElementById("statusFilter").value;

  filteredTickets = tickets.filter(t => {
    const haystack = `${t.fullname} ${t.email} ${t.message}`.toLowerCase();
    const matchesTerm = !term || haystack.includes(term);
    const matchesStatus = !status || (t.status || '').toLowerCase() === status;
    return matchesTerm && matchesStatus;
  });
  renderTable();
}

document.getElementById("searchInput").addEventListener("input", applyFilters);
document.getElementById("statusFilter").addEventListener("change", applyFilters);

// ===================================================
//  SLIDE-OVER PANEL
// ===================================================
const panelOverlay = document.getElementById("panelOverlay");
const ticketPanel = document.getElementById("ticketPanel");

function openPanel(id) {
  const t = tickets.find(x => x.id === id);
  if (!t) return;

  const meta = statusMeta(t.status);

  document.getElementById("panelTicketId").textContent = `Ticket #${t.id}`;
  document.getElementById("panelName").textContent = t.fullname;
  document.getElementById("panelEmail").textContent = t.email;
  document.getElementById("panelDate").textContent = t.created_at;
  document.getElementById("panelMessage").textContent = t.message;

  const badge = document.getElementById("panelStatusBadge");
  badge.textContent = meta.label;
  badge.className = `text-xs px-2 py-1 rounded-full ${meta.cls}`;

  const existingWrap = document.getElementById("panelExistingReplyWrap");
  if (t.reply && t.reply.trim() !== '') {
    existingWrap.classList.remove("hidden");
    document.getElementById("panelExistingReply").textContent = t.reply;
    document.getElementById("deleteReplyMsgId").value = t.id;
  } else {
    existingWrap.classList.add("hidden");
  }

  document.getElementById("replyMsgId").value = t.id;
  document.getElementById("replyTextarea").value = t.reply || '';

  panelOverlay.classList.remove("hidden");
  requestAnimationFrame(() => { ticketPanel.style.transform = "translateX(0)"; });
}

function closePanel() {
  ticketPanel.style.transform = "translateX(100%)";
  setTimeout(() => panelOverlay.classList.add("hidden"), 250);
}

document.getElementById("closePanel").addEventListener("click", closePanel);
document.getElementById("panelBackdrop").addEventListener("click", closePanel);

// ===================================================
//  INIT
// ===================================================
updateStats();
renderTable();

<?php if (isset($_GET['replied'])): ?>
  showToast("Reply saved — ticket marked as Replied.", "success");
<?php endif; ?>
<?php if (isset($_GET['deleted'])): ?>
  showToast("Reply deleted.", "success");
<?php endif; ?>
<?php if (isset($flashError)): ?>
  showToast(<?php echo json_encode($flashError); ?>, "error");
<?php endif; ?>
</script>

</body>
</html>
