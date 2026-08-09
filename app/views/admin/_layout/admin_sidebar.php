<?php
$userRole = (is_array($user ?? null) && isset($user['role'])) ? $user['role'] : '';
$userFullName = (is_array($user ?? null) && isset($user['full_name'])) ? $user['full_name'] : 'User';
?>
<!-- Admin Sidebar Component -->
<aside class="w-64 bg-card border-r border-border/40 flex flex-col shrink-0 h-screen">
  <div class="p-6 border-b border-border/40 flex items-center gap-3">
    <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png" alt="Amis du Vin" class="h-10 w-auto object-contain">
    <div>
      <h1 class="font-heading text-sm text-foreground">Amis du Vin</h1>
      <p class="text-[10px] text-[var(--gold)] uppercase tracking-widest font-medium">CMS Admin</p>
    </div>
  </div>

  <!-- Navigation Links -->
  <nav class="flex-1 p-4 space-y-1 text-sm font-medium">
    <a href="<?= admin_url() ?>" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'dashboard' ? 'bg-[var(--wine)]/15 text-[var(--gold)] border border-[var(--gold)]/30 font-semibold' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard w-4 h-4"><rect width="7" height="9" x="3" y="3" rx="1"></rect><rect width="7" height="5" x="14" y="3" rx="1"></rect><rect width="7" height="9" x="14" y="12" rx="1"></rect><rect width="7" height="5" x="3" y="16" rx="1"></rect></svg>
      <span>Tổng quan (Dashboard)</span>
    </a>

    <?php if (empty($userRole) || in_array($userRole, ['admin', 'cskh'], true)): ?>
      <a href="<?= admin_url('bookings') ?>" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'bookings' ? 'bg-[var(--wine)]/15 text-[var(--gold)] border border-[var(--gold)]/30 font-semibold' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-check w-4 h-4"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path><path d="m9 16 2 2 4-4"></path></svg>
        <span>Quản lý Đặt tiệc (CSKH)</span>
      </a>
    <?php endif; ?>

    <?php if (empty($userRole) || in_array($userRole, ['admin', 'marketing'], true)): ?>
      <a href="<?= admin_url('content') ?>" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'content' ? 'bg-[var(--wine)]/15 text-[var(--gold)] border border-[var(--gold)]/30 font-semibold' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-4 h-4"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>
        <span>Nội dung Landing Page</span>
      </a>
    <?php endif; ?>

    <?php if (empty($userRole) || $userRole === 'admin'): ?>
      <a href="<?= admin_url('users') ?>" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'users' ? 'bg-[var(--wine)]/15 text-[var(--gold)] border border-[var(--gold)]/30 font-semibold' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-4 h-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
        <span>Quản lý Nhân sự</span>
      </a>

      <a href="<?= admin_url('google-sheets') ?>" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'sheets' ? 'bg-[var(--wine)]/15 text-[var(--gold)] border border-[var(--gold)]/30 font-semibold' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sheet w-4 h-4"><rect width="18" height="18" x="3" y="3" rx="2"></rect><line x1="3" x2="21" y1="9" y2="9"></line><line x1="3" x2="21" y1="15" y2="15"></line><line x1="9" x2="9" y1="3" y2="21"></line><line x1="15" x2="15" y1="3" y2="21"></line></svg>
        <span>Tích hợp Google Sheets</span>
      </a>
    <?php endif; ?>
  </nav>

  <!-- User Profile & Logout -->
  <div class="p-4 border-t border-border/40 bg-muted/20">
    <div class="flex items-center justify-between">
      <div class="min-w-0">
        <p class="text-xs font-semibold text-foreground truncate"><?= htmlspecialchars($userFullName) ?></p>
        <span class="inline-block text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full bg-[var(--gold)]/15 text-[var(--gold)] border border-[var(--gold)]/30"><?= htmlspecialchars(!empty($userRole) ? $userRole : 'Admin') ?></span>
      </div>
      <a href="<?= admin_url('logout') ?>" class="p-2 rounded-sm text-muted-foreground hover:text-rose-400 hover:bg-muted transition-colors" title="Đăng xuất">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out w-4 h-4"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" x2="9" y1="12" y2="12"></line></svg>
      </a>
    </div>
  </div>
</aside>
