  </div>
</div>

<script>
// ===================================================
//  MOBILE SIDENAV (shared across pages)
// ===================================================
const mobileNavToggle = document.getElementById("mobileNavToggle");
const mobileNavOverlay = document.getElementById("mobileNavOverlay");
const mobileNavClose = document.getElementById("mobileNavClose");
const mobileNavBackdrop = document.getElementById("mobileNavBackdrop");

function openMobileNav() { mobileNavOverlay.classList.remove("hidden"); }
function closeMobileNav() { mobileNavOverlay.classList.add("hidden"); }

mobileNavToggle?.addEventListener("click", openMobileNav);
mobileNavClose?.addEventListener("click", closeMobileNav);
mobileNavBackdrop?.addEventListener("click", closeMobileNav);

// ===================================================
//  TOAST (shared across pages)
// ===================================================
function showToast(message, type = "success") {
  const toast = document.getElementById("toast");
  if (!toast) return;
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
</script>
