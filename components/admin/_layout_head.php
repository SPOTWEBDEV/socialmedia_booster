<?php
/**
 * _layout_head.php
 * Shared <head> + sidenav + topbar partial for the new dark admin UI.
 *
 * Usage in a page:
 *   $pageTitle    = 'Payment Methods';
 *   $pageSubtitle = 'manual accounts · crypto wallets';
 *   $activeNav    = 'Payment Method'; // must match a label in $navItems below
 *   include 'partials/_layout_head.php';
 */

$navItems = [
    ['label' => 'Dashboard',       'icon' => 'bi-house',     'href' => $domain . 'admin/dashboard/'],
    ['label' => 'Deposit',         'icon' => 'bi-people',    'href' => $domain . 'admin/deposit'],
    ['label' => 'User',            'icon' => 'bi-people',    'href' => $domain . 'admin/user'],
    ['label' => 'Orders',          'icon' => 'bi-bag',       'href' => $domain . 'admin/order'],
    ['label' => 'Payment Method',  'icon' => 'bi-bag',       'href' => $domain . 'admin/payment'],
    ['label' => 'Support',         'icon' => 'bi-headset',   'href' => $domain . 'admin/support'],
    ['label' => 'Email Campaign',  'icon' => 'bi-envelope',  'href' => $domain . 'admin/reach'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $sitename . ' -- ' . $pageTitle; ?></title>
<link rel="icon" href="<?php echo $domain ?>assets/images/brand-logos/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
  @keyframes modal-in { from { opacity:0; transform: scale(.97) translateY(6px); } to { opacity:1; transform: scale(1) translateY(0); } }
  .modal-in { animation: modal-in .18s ease-out; }
  ::selection { background: #3B82F6; color: white; }
</style>
</head>
<body class="bg-base text-slate-200 font-body min-h-screen">

<div class="min-h-screen flex">

  <!-- ===================== SIDENAV ===================== -->
  <aside class="hidden lg:flex w-64 shrink-0 flex-col bg-surface border-r border-line sticky top-0 h-screen">
    <div class="h-16 flex items-center gap-3 px-5 border-b border-line">
      <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center font-display font-bold text-white text-sm shrink-0">BY</div>
      <div class="leading-tight overflow-hidden">
        <p class="font-display font-semibold text-white text-sm truncate">Booster Yard</p>
        <p class="text-[11px] text-slate-500 font-mono truncate">admin panel</p>
      </div>
    </div>

    <nav class="flex-1 overflow-y-auto scrollbar-thin py-4 px-3">
      <ul class="space-y-1">
        <?php foreach ($navItems as $item):
          $isActive = $item['label'] === $activeNav;
        ?>
          <li>
            <a href="<?php echo $item['href']; ?>"
               class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors
                      <?php echo $isActive
                        ? 'bg-blue-500/15 text-blue-400 font-medium'
                        : 'text-slate-400 hover:bg-card hover:text-slate-200'; ?>">
              <i class="bi <?php echo $item['icon']; ?> text-base <?php echo $isActive ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300'; ?>"></i>
              <span><?php echo $item['label']; ?></span>
              <?php if ($isActive): ?>
                <span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-400"></span>
              <?php endif; ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <div class="p-3 border-t border-line">
      <a href="<?php echo $domain; ?>admin/signout"
         class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-400 hover:bg-rose-500/10 hover:text-rose-400 transition-colors">
        <i class="bi bi-box-arrow-right text-base"></i>
        <span>Sign out</span>
      </a>
    </div>
  </aside>

  <!-- ===================== MAIN COLUMN ===================== -->
  <div class="flex-1 flex flex-col min-w-0">

    <!-- Top bar -->
    <header class="border-b border-line bg-surface/80 backdrop-blur sticky top-0 z-30">
      <div class="px-6 py-4 flex items-center justify-between gap-4">
        <div class="flex items-center gap-3">
          <button id="mobileNavToggle" class="lg:hidden w-9 h-9 rounded-lg border border-line flex items-center justify-center text-slate-300">
            <i class="bi bi-list text-lg"></i>
          </button>
          <div>
            <h1 class="font-display font-semibold text-lg text-white leading-tight"><?php echo htmlspecialchars($pageTitle); ?></h1>
            <?php if (!empty($pageSubtitle)): ?>
              <p class="text-xs text-slate-500 font-mono"><?php echo htmlspecialchars($pageSubtitle); ?></p>
            <?php endif; ?>
          </div>
        </div>
        <?php if ($activeNav !== 'Dashboard'): ?>
          <a href="<?php echo $domain; ?>admin/dashboard/" class="text-sm text-slate-400 hover:text-white transition-colors flex items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to dashboard
          </a>
        <?php endif; ?>
      </div>
    </header>

    <!-- Mobile sidenav drawer -->
    <div id="mobileNavOverlay" class="hidden fixed inset-0 z-40 lg:hidden">
      <div class="absolute inset-0 bg-black/60" id="mobileNavBackdrop"></div>
      <aside class="absolute left-0 top-0 h-full w-64 bg-surface border-r border-line flex flex-col">
        <div class="h-16 flex items-center justify-between gap-3 px-5 border-b border-line">
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center font-display font-bold text-white text-sm">BY</div>
            <p class="font-display font-semibold text-white text-sm">Booster Yard</p>
          </div>
          <button id="mobileNavClose" class="text-slate-400"><i class="bi bi-x-lg"></i></button>
        </div>
        <nav class="flex-1 overflow-y-auto scrollbar-thin py-4 px-3">
          <ul class="space-y-1">
            <?php foreach ($navItems as $item):
              $isActive = $item['label'] === $activeNav;
            ?>
              <li>
                <a href="<?php echo $item['href']; ?>"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors
                          <?php echo $isActive ? 'bg-blue-500/15 text-blue-400 font-medium' : 'text-slate-400 hover:bg-card hover:text-slate-200'; ?>">
                  <i class="bi <?php echo $item['icon']; ?> text-base"></i>
                  <span><?php echo $item['label']; ?></span>
                </a>
              </li>
            <?php endforeach; ?>
            <li>
              <a href="<?php echo $domain; ?>admin/signout" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-400 hover:bg-rose-500/10 hover:text-rose-400 transition-colors">
                <i class="bi bi-box-arrow-right text-base"></i>
                <span>Sign out</span>
              </a>
            </li>
          </ul>
        </nav>
      </aside>
    </div>
