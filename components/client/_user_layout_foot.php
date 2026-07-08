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


 <!-- Floating Support Buttons -->

 <style>
   .support-float-container {
     position: fixed;
     bottom: 20px;
     right: 20px;
     display: flex;
     flex-direction: column;
     align-items: flex-end;
     z-index: 9999;
   }

   /* Tooltip Box */
   .support-tooltip {
     background: #0d6efd;
     color: #fff;
     padding: 8px 12px;
     border-radius: 6px;
     margin-bottom: 8px;
     font-size: 13px;
     box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.2);
     opacity: 0;
     transform: translateX(10px);
     transition: 0.3s ease;
     pointer-events: none;
     white-space: nowrap;
     position: absolute;
     right: 65px;
   }

   .support-btn {
     width: 55px;
     height: 55px;
     border-radius: 50%;
     display: flex;
     align-items: center;
     justify-content: center;
     font-size: 26px;
     color: white;
     margin-top: 10px;
     text-decoration: none;
     cursor: pointer;
     transition: 0.3s ease;
     box-shadow: 0px 5px 12px rgba(0, 0, 0, 0.25);
   }

   .support-btn:hover {
     transform: translateY(-5px) scale(1.05);
   }

   .support-btn.whatsapp {
     background: #25D366;
   }

   .support-btn.telegram {
     background: #0088cc;
   }
 </style>
 <!-- Floating Support Buttons -->
 <div class="support-float-container">

   <div class="support-tooltip" id="tooltip-text">Join WhatsApp Community</div>

   <!-- WhatsApp Button -->
   <a href="https://wa.me/+2349164687839"
     target="_blank"
     class="support-btn whatsapp"
     onmouseover="showTooltip('Send us a message on WhatsApp')"
     onmouseout="hideTooltip()">
     <i class="bi bi-whatsapp"></i>
   </a>

   <!-- Telegram Button -->
   <a href="https://t.me/Boostyard01"
     target="_blank"
     class="support-btn telegram"
     onmouseover="showTooltip('Join Telegram Community')"
     onmouseout="hideTooltip()">
     <i class="bi bi-telegram"></i>
   </a>

 </div>

 <script>
function showTooltip(text) {
    let tooltip = document.getElementById("tooltip-text");
    tooltip.textContent = text;
    tooltip.style.opacity = "1";
    tooltip.style.transform = "translateX(0)";
}

function hideTooltip() {
    let tooltip = document.getElementById("tooltip-text");
    tooltip.style.opacity = "0";
    tooltip.style.transform = "translateX(10px)";
}
</script>