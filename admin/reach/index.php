<?php
include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/admin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $sitename . ' -- User Reachout'; ?></title>
<link rel="icon" href="<?php echo $domain ?>assets/images/brand-logos/favicon.ico" type="image/x-icon">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: {
          display: ['"Space Grotesk"', 'sans-serif'],
          body: ['Inter', 'sans-serif'],
          mono: ['"JetBrains Mono"', 'monospace'],
        },
        colors: {
          base: '#0B1120',
          surface: '#101826',
          card: '#141D2E',
          line: '#1F2937',
        }
      }
    }
  }
</script>
<style>
  body { font-family: 'Inter', sans-serif; }
  .scrollbar-thin::-webkit-scrollbar { width: 6px; height: 6px; }
  .scrollbar-thin::-webkit-scrollbar-thumb { background: #2A3548; border-radius: 999px; }
  .scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
  .checkbox-glow:checked { background-color: #3B82F6; border-color: #3B82F6; }
  @keyframes pop-chip { from { opacity:0; transform: scale(.85); } to { opacity:1; transform: scale(1); } }
  .chip-in { animation: pop-chip .18s ease-out; }
  @keyframes toast-in { from { opacity:0; transform: translateY(8px); } to { opacity:1; transform: translateY(0); } }
  .toast-in { animation: toast-in .25s ease-out; }
  ::selection { background: #3B82F6; color: white; }
</style>
</head>
<body class="bg-base text-slate-200 font-body min-h-screen">

<div class="min-h-screen flex flex-col">

  <!-- Top bar -->
  <header class="border-b border-line bg-surface/80 backdrop-blur sticky top-0 z-30">
    <div class="max-w-[1600px] mx-auto px-6 py-4 flex items-center justify-between gap-4">
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center font-display font-bold text-white text-sm">BY</div>
        <div>
          <h1 class="font-display font-semibold text-lg text-white leading-tight">User Reachout</h1>
          <p class="text-xs text-slate-500 font-mono">compose once · send to many</p>
        </div>
      </div>
      <a href="../" class="text-sm text-slate-400 hover:text-white transition-colors flex items-center gap-1.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        Back to dashboard
      </a>
    </div>
  </header>

  <main class="flex-1 max-w-[1600px] w-full mx-auto px-6 py-6 grid grid-cols-1 xl:grid-cols-[1fr_440px] gap-6">

    <!-- ===================== LEFT: USER TABLE ===================== -->
    <section class="bg-card border border-line rounded-2xl overflow-hidden flex flex-col min-h-[600px]">

      <!-- Controls -->
      <div class="p-5 border-b border-line flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[200px]">
          <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" /></svg>
          <input id="searchInput" type="search" placeholder="Search by name or email"
            class="w-full bg-surface border border-line rounded-lg pl-9 pr-3 py-2 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
        </div>

        <select id="statusFilter" class="bg-surface border border-line rounded-lg px-3 py-2 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
          <option value="">All statuses</option>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
          <option value="warning">Warning</option>
        </select>

        <button id="selectAllVisible" class="text-sm px-3 py-2 rounded-lg border border-line text-slate-300 hover:bg-surface hover:text-white transition">
          Select all visible
        </button>
        <button id="clearSelection" class="text-sm px-3 py-2 rounded-lg border border-line text-slate-400 hover:bg-surface hover:text-white transition">
          Clear
        </button>
      </div>

      <!-- Table -->
      <div class="flex-1 overflow-auto scrollbar-thin">
        <table class="w-full text-sm">
          <thead class="sticky top-0 bg-card z-10">
            <tr class="border-b border-line text-left text-xs uppercase tracking-wider text-slate-500">
              <th class="px-5 py-3 w-10">
                <input type="checkbox" id="headerCheckbox" class="checkbox-glow w-4 h-4 rounded border-line bg-surface accent-blue-500 cursor-pointer" />
              </th>
              <th class="px-3 py-3 font-medium font-mono">ID</th>
              <th class="px-3 py-3 font-medium">User</th>
              <th class="px-3 py-3 font-medium">Status</th>
              <th class="px-3 py-3 font-medium">Registered</th>
            </tr>
          </thead>
          <tbody id="userTableBody" class="divide-y divide-line">
            <!-- rows injected by JS -->
          </tbody>
        </table>
        <div id="emptyState" class="hidden flex-col items-center justify-center text-center py-20 px-6">
          <div class="w-12 h-12 rounded-full bg-surface border border-line flex items-center justify-center mb-3 mx-auto">
            <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" /></svg>
          </div>
          <p class="text-slate-300 font-medium">No users match this search</p>
          <p class="text-slate-500 text-sm mt-1">Try a different name, email, or status filter.</p>
        </div>
      </div>

      <!-- Footer summary -->
      <div class="border-t border-line px-5 py-3 flex items-center justify-between text-xs text-slate-500 font-mono">
        <span id="rowCount">0 users loaded</span>
        <span id="selectedCountFooter">0 selected</span>
      </div>
    </section>

    <!-- ===================== RIGHT: COMPOSE + PREVIEW ===================== -->
    <aside class="flex flex-col gap-4">

      <!-- Recipients chip box -->
      <div class="bg-card border border-line rounded-2xl p-5">
        <div class="flex items-center justify-between mb-3">
          <h2 class="font-display font-semibold text-white text-sm">Recipients</h2>
          <span id="selectedCountChipHeader" class="font-mono text-xs px-2 py-0.5 rounded-full bg-blue-500/15 text-blue-400 border border-blue-500/20">0 selected</span>
        </div>
        <div id="chipContainer" class="flex flex-wrap gap-2 max-h-28 overflow-y-auto scrollbar-thin">
          <p id="noRecipientsHint" class="text-sm text-slate-500">Check users on the left to add them here.</p>
        </div>
      </div>

      <!-- Compose form -->
      <form id="reachoutForm" class="bg-card border border-line rounded-2xl p-5 flex flex-col gap-4">
        <h2 class="font-display font-semibold text-white text-sm">Compose</h2>

        <div>
          <label class="text-xs text-slate-400 mb-1.5 block">Subject</label>
          <input id="subjectInput" type="text" required placeholder="e.g. Your account has a new update"
            class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition" />
        </div>

        <div>
          <label class="text-xs text-slate-400 mb-1.5 block">Message</label>
          <textarea id="messageInput" required rows="6" placeholder="Write your message here. It'll be dropped into the Booster Yard email template automatically — no HTML needed."
            class="w-full bg-surface border border-line rounded-lg px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition resize-none"></textarea>
          <p class="text-xs text-slate-500 mt-1.5">Line breaks are preserved automatically. The greeting and footer are added for you.</p>
        </div>

        <!-- Hidden field synced with selection -->
        <input type="hidden" id="recipientsField" name="recipients" />

        <button type="submit" id="sendBtn"
          class="mt-1 w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 disabled:opacity-40 disabled:cursor-not-allowed text-white font-semibold text-sm py-3 rounded-lg transition flex items-center justify-center gap-2">
          <svg id="sendIcon" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
          <span id="sendBtnLabel">Send to 0 recipients</span>
        </button>
      </form>

      <!-- Live preview -->
      <div class="bg-card border border-line rounded-2xl p-5">
        <div class="flex items-center justify-between mb-3">
          <h2 class="font-display font-semibold text-white text-sm">Live preview</h2>
          <span class="text-xs text-slate-500 font-mono">what recipients will see</span>
        </div>

        <div class="rounded-xl overflow-hidden border border-line bg-[#0B1120]">
          <!-- fake email client chrome -->
          <div class="px-4 py-2.5 border-b border-line flex items-center gap-1.5">
            <span class="w-2.5 h-2.5 rounded-full bg-red-400/70"></span>
            <span class="w-2.5 h-2.5 rounded-full bg-yellow-400/70"></span>
            <span class="w-2.5 h-2.5 rounded-full bg-green-400/70"></span>
          </div>
          <div class="px-4 py-3 border-b border-line text-xs space-y-1 font-mono text-slate-400">
            <div><span class="text-slate-600">From:</span> Booster Yard &lt;support@boostyard.com.yahhh44.com&gt;</div>
            <div><span class="text-slate-600">To:</span> <span id="previewToLine">—</span></div>
            <div><span class="text-slate-600">Subject:</span> <span id="previewSubjectLine" class="text-slate-300">—</span></div>
          </div>

          <!-- rendered template -->
          <div class="p-4">
            <div class="rounded-xl overflow-hidden bg-[#F8FAFC]">
              <div class="px-5 py-4" style="background:linear-gradient(135deg,#3B82F6,#6366F1);">
                <span class="text-white font-display font-bold text-sm">Booster Yard</span>
              </div>
              <div class="px-5 pt-5 pb-2">
                <p id="previewEyebrow" class="text-[11px] font-semibold uppercase tracking-wider text-blue-600 mb-1">Subject</p>
                <h3 id="previewGreeting" class="text-[#0B1120] font-bold text-base mb-3">Hi there,</h3>
                <p id="previewBody" class="text-slate-600 text-sm leading-relaxed whitespace-pre-line">Your message preview will appear here as you type.</p>
              </div>
              <div class="px-5 pt-4 pb-5 mt-3 border-t border-slate-200">
                <p class="text-[11px] text-slate-400">This message was sent to you by Booster Yard support.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </aside>
  </main>
</div>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 right-6 z-50 hidden max-w-sm"></div>

<script>
const domain = "<?php echo $domain ?>";

let users = [];
let filteredUsers = [];
let selected = new Map(); // id -> {id, email, fullname}

// ===================================================
//  FETCH USERS
// ===================================================
function loadUsers() {
  fetch(domain + "server/api/users.php")
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        users = data.data;
        filteredUsers = users;
        renderTable();
      }
    })
    .catch(err => console.error("API ERROR:", err));
}

// ===================================================
//  RENDER TABLE
// ===================================================
function renderTable() {
  const tbody = document.getElementById("userTableBody");
  const emptyState = document.getElementById("emptyState");
  tbody.innerHTML = "";

  if (filteredUsers.length === 0) {
    emptyState.classList.remove("hidden");
    emptyState.classList.add("flex");
  } else {
    emptyState.classList.add("hidden");
    emptyState.classList.remove("flex");
  }

  filteredUsers.forEach(user => {
    const isChecked = selected.has(String(user.id));
    const tr = document.createElement("tr");
    tr.className = "hover:bg-surface/60 transition-colors";
    tr.innerHTML = `
      <td class="px-5 py-3">
        <input type="checkbox" data-id="${user.id}" class="row-checkbox checkbox-glow w-4 h-4 rounded border-line bg-surface accent-blue-500 cursor-pointer" ${isChecked ? "checked" : ""} />
      </td>
      <td class="px-3 py-3 font-mono text-slate-500">#${user.id}</td>
      <td class="px-3 py-3">
        <div class="font-medium text-slate-200">${escapeHtml(user.fullname)}</div>
        <div class="text-xs text-slate-500">${escapeHtml(user.email)}</div>
      </td>
      <td class="px-3 py-3">
        <span class="inline-flex items-center gap-1.5 text-xs px-2 py-1 rounded-full ${statusBadge(user.status)}">
          <span class="w-1.5 h-1.5 rounded-full ${statusDot(user.status)}"></span>
          ${escapeHtml(user.status)}
        </span>
      </td>
      <td class="px-3 py-3 text-slate-400 text-xs font-mono">${escapeHtml(user.created_at)}</td>
    `;
    tbody.appendChild(tr);
  });

  document.getElementById("rowCount").textContent = `${users.length} user${users.length === 1 ? "" : "s"} loaded`;

  document.querySelectorAll(".row-checkbox").forEach(cb => {
    cb.addEventListener("change", onRowCheckboxChange);
  });

  syncHeaderCheckbox();
}

function statusBadge(status) {
  switch ((status || "").toLowerCase()) {
    case "active": return "bg-emerald-500/15 text-emerald-400";
    case "inactive": return "bg-rose-500/15 text-rose-400";
    case "warning": return "bg-amber-500/15 text-amber-400";
    default: return "bg-slate-500/15 text-slate-400";
  }
}
function statusDot(status) {
  switch ((status || "").toLowerCase()) {
    case "active": return "bg-emerald-400";
    case "inactive": return "bg-rose-400";
    case "warning": return "bg-amber-400";
    default: return "bg-slate-400";
  }
}
function escapeHtml(str) {
  const div = document.createElement("div");
  div.textContent = str ?? "";
  return div.innerHTML;
}

// ===================================================
//  SELECTION LOGIC
// ===================================================
function onRowCheckboxChange(e) {
  const id = e.target.getAttribute("data-id");
  const user = users.find(u => String(u.id) === String(id));
  if (!user) return;

  if (e.target.checked) {
    selected.set(String(id), { id: user.id, email: user.email, fullname: user.fullname });
  } else {
    selected.delete(String(id));
  }
  refreshSelectionUI();
}

function refreshSelectionUI() {
  renderChips();
  updateSelectedCounts();
  syncHeaderCheckbox();
  updateRecipientsField();
  updatePreviewRecipients();
}

function renderChips() {
  const container = document.getElementById("chipContainer");
  const hint = document.getElementById("noRecipientsHint");
  container.innerHTML = "";

  if (selected.size === 0) {
    container.appendChild(hint);
    return;
  }

  selected.forEach((user, id) => {
    const chip = document.createElement("span");
    chip.className = "chip-in inline-flex items-center gap-1.5 bg-surface border border-line text-slate-200 text-xs pl-2.5 pr-1.5 py-1 rounded-full";
    chip.innerHTML = `
      ${escapeHtml(user.fullname)}
      <button type="button" data-remove="${id}" class="w-4 h-4 rounded-full hover:bg-rose-500/20 hover:text-rose-400 flex items-center justify-center transition">
        <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
      </button>
    `;
    container.appendChild(chip);
  });

  container.querySelectorAll("[data-remove]").forEach(btn => {
    btn.addEventListener("click", () => {
      const id = btn.getAttribute("data-remove");
      selected.delete(id);
      refreshSelectionUI();
      const cb = document.querySelector(`.row-checkbox[data-id="${id}"]`);
      if (cb) cb.checked = false;
    });
  });
}

function updateSelectedCounts() {
  const n = selected.size;
  document.getElementById("selectedCountFooter").textContent = `${n} selected`;
  document.getElementById("selectedCountChipHeader").textContent = `${n} selected`;
  document.getElementById("sendBtnLabel").textContent = `Send to ${n} recipient${n === 1 ? "" : "s"}`;
  document.getElementById("sendBtn").disabled = n === 0;
}

function syncHeaderCheckbox() {
  const visibleIds = filteredUsers.map(u => String(u.id));
  const headerCb = document.getElementById("headerCheckbox");
  if (visibleIds.length === 0) { headerCb.checked = false; headerCb.indeterminate = false; return; }
  const allChecked = visibleIds.every(id => selected.has(id));
  const someChecked = visibleIds.some(id => selected.has(id));
  headerCb.checked = allChecked;
  headerCb.indeterminate = someChecked && !allChecked;
}

function updateRecipientsField() {
  const arr = Array.from(selected.values());
  document.getElementById("recipientsField").value = JSON.stringify(arr);
}

// header checkbox toggles all *visible/filtered* rows
document.getElementById("headerCheckbox").addEventListener("change", (e) => {
  filteredUsers.forEach(user => {
    if (e.target.checked) {
      selected.set(String(user.id), { id: user.id, email: user.email, fullname: user.fullname });
    } else {
      selected.delete(String(user.id));
    }
  });
  renderTable();
  refreshSelectionUI();
});

document.getElementById("selectAllVisible").addEventListener("click", () => {
  filteredUsers.forEach(user => selected.set(String(user.id), { id: user.id, email: user.email, fullname: user.fullname }));
  renderTable();
  refreshSelectionUI();
});

document.getElementById("clearSelection").addEventListener("click", () => {
  selected.clear();
  renderTable();
  refreshSelectionUI();
});

// ===================================================
//  SEARCH + FILTER
// ===================================================
function applyFilters() {
  const term = document.getElementById("searchInput").value.toLowerCase().trim();
  const status = document.getElementById("statusFilter").value;

  filteredUsers = users.filter(u => {
    const matchesTerm = !term || u.fullname.toLowerCase().includes(term) || u.email.toLowerCase().includes(term);
    const matchesStatus = !status || u.status.toLowerCase() === status.toLowerCase();
    return matchesTerm && matchesStatus;
  });
  renderTable();
}

document.getElementById("searchInput").addEventListener("input", applyFilters);
document.getElementById("statusFilter").addEventListener("change", applyFilters);

// ===================================================
//  LIVE PREVIEW
// ===================================================
const subjectInput = document.getElementById("subjectInput");
const messageInput = document.getElementById("messageInput");

function updatePreviewText() {
  const subject = subjectInput.value.trim();
  const message = messageInput.value.trim();

  document.getElementById("previewSubjectLine").textContent = subject || "—";
  document.getElementById("previewEyebrow").textContent = subject || "Subject";
  document.getElementById("previewBody").textContent = message || "Your message preview will appear here as you type.";
}

function updatePreviewRecipients() {
  const n = selected.size;
  const toLine = document.getElementById("previewToLine");
  const greeting = document.getElementById("previewGreeting");

  if (n === 0) {
    toLine.textContent = "—";
    greeting.textContent = "Hi there,";
  } else if (n === 1) {
    const first = Array.from(selected.values())[0];
    toLine.textContent = first.email;
    greeting.textContent = `Hi ${first.fullname},`;
  } else {
    const first = Array.from(selected.values())[0];
    toLine.textContent = `${first.email} +${n - 1} more`;
    greeting.textContent = `Hi ${first.fullname}, (+${n - 1} others, each personalized)`;
  }
}

subjectInput.addEventListener("input", updatePreviewText);
messageInput.addEventListener("input", updatePreviewText);

// ===================================================
//  SUBMIT
// ===================================================
document.getElementById("reachoutForm").addEventListener("submit", function (e) {
  e.preventDefault();

  if (selected.size === 0) {
    showToast("Select at least one recipient first.", "warning");
    return;
  }

  updateRecipientsField();

  const sendBtn = document.getElementById("sendBtn");
  const originalLabel = document.getElementById("sendBtnLabel").textContent;
  sendBtn.disabled = true;
  document.getElementById("sendBtnLabel").textContent = "Sending…";

  const formData = new FormData();
  formData.append("subject", subjectInput.value.trim());
  formData.append("message", messageInput.value.trim());
  formData.append("recipients", document.getElementById("recipientsField").value);

  fetch("./send_reachout.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast(`Sent to ${data.sent} recipient${data.sent === 1 ? "" : "s"}${data.failed.length ? `, ${data.failed.length} failed` : ""}.`, "success");
        selected.clear();
        renderTable();
        refreshSelectionUI();
        messageInput.value = "";
        subjectInput.value = "";
        updatePreviewText();
      } else {
        showToast(data.error || "Send failed. Check the email config and try again.", "error");
      }
    })
    .catch(err => {
      console.error(err);
      showToast("Network error — the message wasn't sent.", "error");
    })
    .finally(() => {
      sendBtn.disabled = selected.size === 0;
      document.getElementById("sendBtnLabel").textContent = `Send to ${selected.size} recipient${selected.size === 1 ? "" : "s"}`;
    });
});

// ===================================================
//  TOAST
// ===================================================
function showToast(message, type = "success") {
  const toast = document.getElementById("toast");
  const colors = {
    success: "bg-emerald-500/15 border-emerald-500/30 text-emerald-300",
    error: "bg-rose-500/15 border-rose-500/30 text-rose-300",
    warning: "bg-amber-500/15 border-amber-500/30 text-amber-300",
  };
  toast.className = `toast-in fixed bottom-6 right-6 z-50 max-w-sm border rounded-xl px-4 py-3 text-sm font-medium shadow-lg backdrop-blur ${colors[type]}`;
  toast.textContent = message;
  toast.classList.remove("hidden");
  clearTimeout(window._toastTimeout);
  window._toastTimeout = setTimeout(() => toast.classList.add("hidden"), 4000);
}

// init
loadUsers();
updatePreviewText();
</script>

</body>
</html>