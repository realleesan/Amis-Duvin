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
  <nav class="flex-1 p-4 space-y-1 text-sm font-medium overflow-y-auto min-h-0">
    <a href="<?= admin_url() ?>" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'dashboard' ? 'admin-active-nav' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard w-4 h-4"><rect width="7" height="9" x="3" y="3" rx="1"></rect><rect width="7" height="5" x="14" y="3" rx="1"></rect><rect width="7" height="9" x="14" y="12" rx="1"></rect><rect width="7" height="5" x="3" y="16" rx="1"></rect></svg>
      <span>Tổng quan (Dashboard)</span>
    </a>

    <a href="<?= admin_url('notifications') ?>" class="flex items-center justify-between px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'notifications' ? 'admin-active-nav' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
      <div class="flex items-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell w-4 h-4"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path></svg>
        <span>Quản lý Thông báo</span>
      </div>
      <?php if (!empty($unreadCount) && $unreadCount > 0): ?>
        <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-rose-500 text-white font-mono font-bold"><?= $unreadCount ?></span>
      <?php endif; ?>
    </a>

    <?php if (empty($userRole) || in_array($userRole, ['admin', 'cskh'], true)): ?>
      <a href="<?= admin_url('bookings') ?>" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'bookings' ? 'admin-active-nav' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-check w-4 h-4"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path><path d="m9 16 2 2 4-4"></path></svg>
        <span>Quản lý Đặt tiệc (CSKH)</span>
      </a>

      <a href="<?= admin_url('workshops') ?>" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'workshops' ? 'admin-active-nav' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-graduation-cap w-4 h-4"><path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"></path><path d="M22 10v6"></path><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path></svg>
        <span>Quản lý Workshop</span>
      </a>
    <?php endif; ?>

    <?php if (empty($userRole) || in_array($userRole, ['admin', 'marketing'], true)): ?>
      <?php 
        $isContentActive = ($activeNav ?? '') === 'content';
        $currSec = $_GET['sec'] ?? 'all';
      ?>
      <div class="space-y-0.5">
        <button type="button" onclick="toggleContentSubmenu(event)" class="w-full flex items-center justify-between px-4 py-3 rounded-sm transition-colors <?= $isContentActive ? 'admin-active-nav' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
          <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-4 h-4"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>
            <span>Nội dung Landing Page</span>
          </div>
          <svg id="contentSubmenuChevron" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down w-3.5 h-3.5 transition-transform duration-200 <?= $isContentActive ? 'rotate-180 text-[var(--gold)]' : '' ?>"><path d="m6 9 6 6 6-6"></path></svg>
        </button>

        <div id="contentSubmenu" class="pl-9 pr-2 py-1 space-y-1 text-[11px] font-normal <?= $isContentActive ? '' : 'hidden' ?>">
          <a href="<?= admin_url('content') ?>?sec=all" class="block py-1.5 px-2 rounded font-medium transition-colors <?= $currSec === 'all' ? 'text-[var(--gold)] bg-muted/60 font-semibold' : 'text-muted-foreground hover:text-foreground hover:bg-muted/30' ?>">Tất cả các phần</a>
          <a href="<?= admin_url('content') ?>?sec=seo" class="block py-1.5 px-2 rounded font-medium transition-colors <?= $currSec === 'seo' ? 'text-[var(--gold)] bg-muted/60 font-semibold' : 'text-muted-foreground hover:text-foreground hover:bg-muted/30' ?>">1. SEO &amp; Meta Tags</a>
          <a href="<?= admin_url('content') ?>?sec=hero" class="block py-1.5 px-2 rounded font-medium transition-colors <?= $currSec === 'hero' ? 'text-[var(--gold)] bg-muted/60 font-semibold' : 'text-muted-foreground hover:text-foreground hover:bg-muted/30' ?>">2. Banner Hero</a>
          <a href="<?= admin_url('content') ?>?sec=service-intro" class="block py-1.5 px-2 rounded font-medium transition-colors <?= $currSec === 'service-intro' ? 'text-[var(--gold)] bg-muted/60 font-semibold' : 'text-muted-foreground hover:text-foreground hover:bg-muted/30' ?>">3. Giới thiệu Dịch vụ</a>
          <a href="<?= admin_url('content') ?>?sec=pairings" class="block py-1.5 px-2 rounded font-medium transition-colors <?= $currSec === 'pairings' ? 'text-[var(--gold)] bg-muted/60 font-semibold' : 'text-muted-foreground hover:text-foreground hover:bg-muted/30' ?>">4. Gói tiệc Pairing</a>
          <a href="<?= admin_url('content') ?>?sec=workshops" class="block py-1.5 px-2 rounded font-medium transition-colors <?= $currSec === 'workshops' ? 'text-[var(--gold)] bg-muted/60 font-semibold' : 'text-muted-foreground hover:text-foreground hover:bg-muted/30' ?>">5. Gói Workshop</a>
          <a href="<?= admin_url('content') ?>?sec=benefits" class="block py-1.5 px-2 rounded font-medium transition-colors <?= $currSec === 'benefits' ? 'text-[var(--gold)] bg-muted/60 font-semibold' : 'text-muted-foreground hover:text-foreground hover:bg-muted/30' ?>">6. Lợi ích cốt lõi</a>
          <a href="<?= admin_url('content') ?>?sec=testimonials" class="block py-1.5 px-2 rounded font-medium transition-colors <?= $currSec === 'testimonials' ? 'text-[var(--gold)] bg-muted/60 font-semibold' : 'text-muted-foreground hover:text-foreground hover:bg-muted/30' ?>">7. Đánh giá khách hàng</a>
          <a href="<?= admin_url('content') ?>?sec=faq" class="block py-1.5 px-2 rounded font-medium transition-colors <?= $currSec === 'faq' ? 'text-[var(--gold)] bg-muted/60 font-semibold' : 'text-muted-foreground hover:text-foreground hover:bg-muted/30' ?>">8. Câu hỏi FAQ</a>
        </div>
      </div>
    <?php endif; ?>

    <?php if (empty($userRole) || $userRole === 'admin'): ?>
      <a href="<?= admin_url('users') ?>" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'users' ? 'admin-active-nav' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-4 h-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
        <span>Quản lý Nhân sự</span>
      </a>

      <?php /* Ẩn mục cấu hình Google Sheets khỏi Sidebar để bảo mật (Truy cập trực tiếp /admin/google-sheets khi cần)
      <a href="<?= admin_url('google-sheets') ?>" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'sheets' ? 'admin-active-nav' : 'text-foreground/75 hover:bg-muted hover:text-foreground' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sheet w-4 h-4"><rect width="18" height="18" x="3" y="3" rx="2"></rect><line x1="3" x2="21" y1="9" y2="9"></line><line x1="3" x2="21" y1="15" y2="15"></line><line x1="9" x2="9" y1="3" y2="21"></line><line x1="15" x2="15" y1="3" y2="21"></line></svg>
        <span>Tích hợp Google Sheets</span>
      </a>
      */ ?>

      <a href="<?= admin_url('trash') ?>" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors <?= ($activeNav ?? '') === 'trash' ? 'admin-active-nav' : 'text-rose-400/90 hover:bg-muted hover:text-rose-400' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>
        <span>Thùng rác hệ thống</span>
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

<script>
function toggleContentSubmenu(e) {
  e.preventDefault();
  const menu = document.getElementById('contentSubmenu');
  const chevron = document.getElementById('contentSubmenuChevron');
  if (menu) {
    menu.classList.toggle('hidden');
    if (chevron) chevron.classList.toggle('rotate-180');
  }
}
</script>
