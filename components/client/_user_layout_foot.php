  </div><!-- end main column -->
</div><!-- end page flex -->

<!-- Toast -->
<div id="toast" class="fixed bottom-6 right-6 z-50 hidden max-w-sm"></div>

<script>
// ===================================================
//  MOBILE SIDENAV (user)
// ===================================================
const mobileNavToggle = document.getElementById("mobileNavToggle");
const mobileNavOverlay = document.getElementById("mobileNavOverlay");
const mobileNavClose = document.getElementById("mobileNavClose");
const mobileNavBackdrop = document.getElementById("mobileNavBackdrop");

function openMobileNav() { mobileNavOverlay?.classList.remove("hidden"); }
function closeMobileNav() { mobileNavOverlay?.classList.add("hidden"); }

mobileNavToggle?.addEventListener("click", openMobileNav);
mobileNavClose?.addEventListener("click", closeMobileNav);
mobileNavBackdrop?.addEventListener("click", closeMobileNav);

// ===================================================
//  TOAST (user)
// ===================================================
function showToast(message, type = "success") {
  const toast = document.getElementById("toast");
  if (!toast) return;
  const configs = {
    success: { cls: "bg-white border-emerald-200 text-emerald-700", icon: "bi-check-circle-fill text-emerald-500" },
    error:   { cls: "bg-white border-rose-200 text-rose-700",    icon: "bi-x-circle-fill text-rose-500" },
    warning: { cls: "bg-white border-amber-200 text-amber-700",  icon: "bi-exclamation-circle-fill text-amber-500" },
  };
  const c = configs[type] || configs.success;
  toast.className = `toast-in fixed bottom-6 right-6 z-50 max-w-sm border rounded-2xl px-4 py-3 text-sm font-medium shadow-lg flex items-center gap-3 ${c.cls}`;
  toast.innerHTML = `<i class="bi ${c.icon} text-lg shrink-0"></i><span>${message}</span>`;
  toast.classList.remove("hidden");
  clearTimeout(window._toastTimeout);
  window._toastTimeout = setTimeout(() => toast.classList.add("hidden"), 4500);
}
</script>
