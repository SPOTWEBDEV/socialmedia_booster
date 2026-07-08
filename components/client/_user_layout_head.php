<?php

$userNavItems = [
    ['label' => 'Dashboard',   'icon' => 'bi-house',          'href' => $domain . 'user/dashboard/'],
    ['label' => 'New Order',   'icon' => 'bi-plus-circle',    'href' => $domain . 'user/order/'],
    ['label' => 'My Orders',   'icon' => 'bi-bag',            'href' => $domain . 'user/order/my-order/'],
    ['label' => 'Deposit',     'icon' => 'bi-wallet2',        'href' => $domain . 'user/deposit/'],
    ['label' => 'Support',     'icon' => 'bi-headset',        'href' => $domain . 'user/support/'],
    ['label' => 'Deposit',     'icon' => 'bi-wallet2',        'href' => $domain . 'user/deposit/'],
    ['label' => 'Settings',    'icon' => 'bi-gear',           'href' => $domain . 'user/settings/'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($sitename . ' — ' . $pageTitle); ?></title>
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
          'u-bg':      '#F8FAFC',
          'u-card':    '#FFFFFF',
          'u-line':    '#E2E8F0',
          'u-muted':   '#64748B',
          'u-text':    '#0F172A',
          'u-surface': '#F1F5F9',
        }
      }
    }
  }
</script>
<style>
  body { font-family: 'Inter', sans-serif; background-color: #F8FAFC; color: #0F172A; }
  .scrollbar-thin::-webkit-scrollbar { width: 5px; height: 5px; }
  .scrollbar-thin::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 999px; }
  .scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
  @keyframes toast-in { from { opacity:0; transform: translateY(8px); } to { opacity:1; transform: translateY(0); } }
  .toast-in { animation: toast-in .25s ease-out; }
  @keyframes modal-in { from { opacity:0; transform: scale(.97) translateY(6px); } to { opacity:1; transform: scale(1) translateY(0); } }
  .modal-in { animation: modal-in .18s ease-out; }
  @keyframes slide-over-in { from { transform: translateX(100%); } to { transform: translateX(0); } }
  ::selection { background: #3B82F6; color: white; }
</style>
</head>
<body class="bg-u-bg text-u-text font-body min-h-screen">

<div class="min-h-screen flex">

  <!-- ===================== USER SIDENAV ===================== -->
  <aside class="hidden lg:flex w-60 shrink-0 flex-col bg-u-card border-r border-u-line sticky top-0 h-screen">
    <div class="h-16 flex items-center gap-3 px-5 border-b border-u-line">
      <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center font-display font-bold text-white text-xs shrink-0">BY</div>
      <span class="font-display font-semibold text-u-text text-sm truncate">Boost Yard</span>
    </div>

    <nav class="flex-1 overflow-y-auto scrollbar-thin py-4 px-3">
      <ul class="space-y-0.5">
        <?php foreach ($userNavItems as $item):
          $isActive = $item['label'] === $activeNav;
        ?>
          <li>
            <a href="<?php echo $item['href']; ?>"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors
                      <?php echo $isActive
                        ? 'bg-blue-50 text-blue-600 font-medium'
                        : 'text-u-muted hover:bg-u-surface hover:text-u-text'; ?>">
              <i class="bi <?php echo $item['icon']; ?> text-base <?php echo $isActive ? 'text-blue-500' : ''; ?>"></i>
              <span><?php echo $item['label']; ?></span>
              <?php if ($isActive): ?>
                <span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-500"></span>
              <?php endif; ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <div class="p-3 border-t border-u-line">
      <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl mb-1">
        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold shrink-0">
          <?php echo strtoupper(substr($fullname ?? 'U', 0, 1)); ?>
        </div>
        <div class="min-w-0">
          <p class="text-xs font-semibold text-u-text truncate"><?php echo htmlspecialchars($fullname ?? ''); ?></p>
          <p class="text-[11px] text-u-muted truncate"><?php echo htmlspecialchars($email ?? ''); ?></p>
        </div>
      </div>
      <a href="<?php echo $domain; ?>user/signout"
         class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-u-muted hover:bg-red-50 hover:text-red-500 transition-colors">
        <i class="bi bi-box-arrow-right text-base"></i>
        <span>Sign out</span>
      </a>
    </div>
  </aside>

  <!-- ===================== MAIN COLUMN ===================== -->
  <div class="flex-1 flex flex-col min-w-0">

    <!-- Top bar -->
    <header class="border-b border-u-line bg-u-card/80 backdrop-blur sticky top-0 z-30">
      <div class="px-6 py-4 flex items-center justify-between gap-4">
        <div class="flex items-center gap-3">
          <button id="mobileNavToggle" class="lg:hidden w-9 h-9 rounded-xl border border-u-line flex items-center justify-center text-u-muted hover:bg-u-surface transition">
            <i class="bi bi-list text-lg"></i>
          </button>
          <div>
            <h1 class="font-display font-semibold text-base text-u-text leading-tight"><?php echo htmlspecialchars($pageTitle); ?></h1>
            <?php if (!empty($pageSubtitle)): ?>
              <p class="text-xs text-u-muted"><?php echo htmlspecialchars($pageSubtitle); ?></p>
            <?php endif; ?>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <span class="hidden sm:block text-sm text-u-muted">Hi, <strong class="text-u-text font-medium"><?php echo htmlspecialchars($fullname ?? ''); ?></strong></span>
          <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold">
            <?php echo strtoupper(substr($fullname ?? 'U', 0, 1)); ?>
          </div>
        </div>
      </div>
    </header>

    <!-- Mobile sidenav drawer -->
    <div id="mobileNavOverlay" class="hidden fixed inset-0 z-40 lg:hidden">
      <div class="absolute inset-0 bg-black/40" id="mobileNavBackdrop"></div>
      <aside class="absolute left-0 top-0 h-full w-60 bg-u-card border-r border-u-line flex flex-col shadow-xl">
        <div class="h-16 flex items-center justify-between gap-3 px-5 border-b border-u-line">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center font-display font-bold text-white text-xs">BY</div>
            <span class="font-display font-semibold text-u-text text-sm">Boost Yard</span>
          </div>
          <button id="mobileNavClose" class="text-u-muted hover:text-u-text"><i class="bi bi-x-lg"></i></button>
        </div>
        <nav class="flex-1 overflow-y-auto scrollbar-thin py-4 px-3">
          <ul class="space-y-0.5">
            <?php foreach ($userNavItems as $item):
              $isActive = $item['label'] === $activeNav;
            ?>
              <li>
                <a href="<?php echo $item['href']; ?>"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors
                          <?php echo $isActive ? 'bg-blue-50 text-blue-600 font-medium' : 'text-u-muted hover:bg-u-surface hover:text-u-text'; ?>">
                  <i class="bi <?php echo $item['icon']; ?> text-base"></i>
                  <span><?php echo $item['label']; ?></span>
                </a>
              </li>
            <?php endforeach; ?>
            <li>
              <a href="<?php echo $domain; ?>user/signout" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-u-muted hover:bg-red-50 hover:text-red-500 transition-colors">
                <i class="bi bi-box-arrow-right text-base"></i>
                <span>Sign out</span>
              </a>
            </li>
          </ul>
        </nav>
      </aside>
    </div>
