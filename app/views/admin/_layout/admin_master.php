<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Admin CMS — Amis du Vin') ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/assets/css/global.css">
</head>
<body class="bg-background text-foreground antialiased min-h-screen flex">
  <!-- Sidebar -->
  <aside class="w-64 bg-card border-r border-border flex flex-col shrink-0 min-h-screen">
    <div class="p-6 border-b border-border flex items-center gap-3">
      <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png" alt="Amis du Vin" class="h-10 w-auto object-contain">
      <div>
        <h1 class="font-heading text-sm text-foreground">Amis du Vin</h1>
        <p class="text-[10px] text-[var(--gold)] uppercase tracking-widest">CMS Admin</p>
      </div>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 p-4 space-y-1 text-sm font-medium">
      <a href="/admin" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'dashboard' ? 'bg-[var(--wine)]/15 text-[var(--gold)] border border-[var(--gold)]/30 font-semibold' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard w-4 h-4"><rect width="7" height="9" x="3" y="3" rx="1"></rect><rect width="7" height="5" x="14" y="3" rx="1"></rect><rect width="7" height="9" x="14" y="12" rx="1"></rect><rect width="7" height="5" x="3" y="16" rx="1"></rect></svg>
        <span>Tổng quan (Dashboard)</span>
      </a>

      <?php if (in_array(($user['role'] ?? ''), ['admin', 'cskh'], true)): ?>
        <a href="/admin/bookings" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'bookings' ? 'bg-[var(--wine)]/15 text-[var(--gold)] border border-[var(--gold)]/30 font-semibold' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-check w-4 h-4"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path><path d="m9 16 2 2 4-4"></path></svg>
          <span>Quản lý Đặt tiệc (CSKH)</span>
        </a>
      <?php endif; ?>

      <?php if (in_array(($user['role'] ?? ''), ['admin', 'marketing'], true)): ?>
        <a href="/admin/content" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'content' ? 'bg-[var(--wine)]/15 text-[var(--gold)] border border-[var(--gold)]/30 font-semibold' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-4 h-4"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>
          <span>Nội dung Landing Page</span>
        </a>
      <?php endif; ?>

      <?php if (($user['role'] ?? '') === 'admin'): ?>
        <a href="/admin/google-sheets" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'sheets' ? 'bg-[var(--wine)]/15 text-[var(--gold)] border border-[var(--gold)]/30 font-semibold' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sheet w-4 h-4"><rect width="18" height="18" x="3" y="3" rx="2"></rect><line x1="3" x2="21" y1="9" y2="9"></line><line x1="3" x2="21" y1="15" y2="15"></line><line x1="9" x2="9" y1="3" y2="21"></line><line x1="15" x2="15" y1="3" y2="21"></line></svg>
          <span>Tích hợp Google Sheets</span>
        </a>
      <?php endif; ?>
    </nav>

    <!-- User Profile & Logout -->
    <div class="p-4 border-t border-border bg-muted/20">
      <div class="flex items-center justify-between">
        <div class="min-w-0">
          <p class="text-xs font-semibold text-foreground truncate"><?= htmlspecialchars($user['full_name'] ?? 'User') ?></p>
          <span class="inline-block text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full bg-[var(--gold)]/15 text-[var(--gold)] border border-[var(--gold)]/30"><?= htmlspecialchars($user['role'] ?? 'Admin') ?></span>
        </div>
        <a href="/admin/logout" class="p-2 rounded-sm text-muted-foreground hover:text-rose-400 hover:bg-muted transition-colors" title="Đăng xuất">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out w-4 h-4"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" x2="9" y1="12" y2="12"></line></svg>
        </a>
      </div>
    </div>
  </aside>

  <!-- Main Content Area -->
  <div class="flex-1 flex flex-col min-w-0">
    <!-- Top Header Bar -->
    <header class="h-16 border-b border-border bg-card/60 backdrop-blur-md px-6 flex items-center justify-between shrink-0">
      <div class="flex items-center gap-3">
        <span class="text-xs uppercase tracking-[0.2em] text-[var(--gold)]">CMS Workspace</span>
        <span class="text-muted-foreground/40">•</span>
        <a href="/" target="_blank" class="text-xs text-muted-foreground hover:text-foreground flex items-center gap-1.5 transition-colors">
          <span>Xem Landing Page</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link w-3.5 h-3.5"><path d="M15 3h6v6"></path><path d="M10 14 21 3"></path><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path></svg>
        </a>
      </div>

      <div class="text-xs text-muted-foreground font-mono">
        <?= date('d/m/Y H:i') ?>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 p-6 sm:p-8 overflow-y-auto">
      <?php if (!empty($message)): ?>
        <div class="mb-6 p-4 rounded-sm bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle-2 w-4 h-4"><circle cx="12" cy="12" r="10"></circle><path d="m9 12 2 2 4-4"></path></svg>
          <span><?= htmlspecialchars($message) ?></span>
        </div>
      <?php endif; ?>

      <?php if (!empty($error)): ?>
        <div class="mb-6 p-4 rounded-sm bg-rose-500/10 border border-rose-500/30 text-rose-400 text-sm flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle w-4 h-4"><circle cx="12" cy="12" r="10"></circle><line x1="12" x2="12" y1="8" y2="12"></line><line x1="12" x2="12.01" y1="16" y2="16"></line></svg>
          <span><?= htmlspecialchars($error) ?></span>
        </div>
      <?php endif; ?>

      <?= $adminContent ?? '' ?>
    </main>
  </div>
</body>
</html>
