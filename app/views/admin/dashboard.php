<?php
$title = 'Tổng quan — Admin CMS Amis du Vin';
$activeNav = 'dashboard';

ob_start();
?>

<div class="space-y-8">
  <!-- Page Header -->
  <div>
    <h2 class="font-heading text-2xl sm:text-3xl text-foreground">Tổng quan Hệ thống</h2>
    <p class="text-sm text-muted-foreground mt-1">Xin chào <strong><?= htmlspecialchars($user['full_name'] ?? 'Quản trị viên') ?></strong>, chúc bạn một ngày làm việc hiệu quả!</p>
  </div>

  <!-- Metric Cards -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
    <div class="rounded-sm border border-border bg-card p-5 space-y-2">
      <p class="text-xs uppercase tracking-widest text-muted-foreground">Tổng Đơn đặt tiệc</p>
      <p class="font-heading text-3xl text-foreground tabular-nums"><?= number_format($totalBookings) ?></p>
      <span class="text-[11px] text-muted-foreground">Tích lũy từ hệ thống</span>
    </div>

    <div class="rounded-sm border border-border bg-card p-5 space-y-2">
      <p class="text-xs uppercase tracking-widest text-[var(--gold)]">Chờ CSKH xác nhận</p>
      <p class="font-heading text-3xl text-[var(--gold)] tabular-nums"><?= number_format($pendingBookings) ?></p>
      <span class="text-[11px] text-muted-foreground">Đơn mới cần xử lý</span>
    </div>

    <div class="rounded-sm border border-border bg-card p-5 space-y-2">
      <p class="text-xs uppercase tracking-widest text-emerald-400">Đã chốt cọc 30%</p>
      <p class="font-heading text-3xl text-emerald-400 tabular-nums"><?= number_format($confirmedBookings) ?></p>
      <span class="text-[11px] text-muted-foreground">Đã chuyển khoản giữ chỗ</span>
    </div>

    <div class="rounded-sm border border-border bg-card p-5 space-y-2">
      <p class="text-xs uppercase tracking-widest text-[var(--wine)]">Tổng số khách hàng</p>
      <p class="font-heading text-3xl text-foreground tabular-nums"><?= number_format($totalGuests) ?></p>
      <span class="text-[11px] text-muted-foreground">Tổng lượng khách đặt chỗ</span>
    </div>
  </div>

  <!-- Quick Actions Panel -->
  <div class="grid lg:grid-cols-2 gap-6">
    <!-- CSKH Quick Actions -->
    <div class="rounded-sm border border-border bg-card p-6 space-y-4">
      <div class="flex items-center justify-between border-b border-border pb-4">
        <h3 class="font-heading text-lg text-foreground">Xử lý Đơn Đặt tiệc (CSKH)</h3>
        <span class="text-xs uppercase tracking-widest text-[var(--gold)]">Master Data</span>
      </div>
      <p class="text-sm text-muted-foreground leading-relaxed">
        Quản lý chi tiết các đơn đặt tiệc trong vòng 5 ngày tới, kiểm tra trần giới hạn 2 đoàn/ca (tối đa 24 khách/ca), cập nhật tiền cọc 30% và đồng bộ tự động sang Google Sheets.
      </p>
      <a href="/admin/bookings" class="btn-wine inline-flex items-center gap-2 px-6 py-3 rounded-sm text-xs uppercase tracking-widest font-medium">
        <span>Vào trang quản lý đơn</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
      </a>
    </div>

    <!-- Marketing Quick Actions -->
    <div class="rounded-sm border border-border bg-card p-6 space-y-4">
      <div class="flex items-center justify-between border-b border-border pb-4">
        <h3 class="font-heading text-lg text-foreground">Quản lý Nội dung (Marketing)</h3>
        <span class="text-xs uppercase tracking-widest text-[var(--gold)]">Dynamic CMS</span>
      </div>
      <p class="text-sm text-muted-foreground leading-relaxed">
        Tùy chỉnh linh hoạt văn bản, khẩu hiệu, thông điệp, hình ảnh của các Section: Hero, 3 Lợi ích cốt lõi, Giới thiệu dịch vụ, 4 Gói tiệc Food &amp; Wine Pairing.
      </p>
      <a href="/admin/content" class="btn-invert inline-flex items-center gap-2 px-6 py-3 rounded-sm text-xs uppercase tracking-widest font-medium">
        <span>Chỉnh sửa nội dung</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-edit w-4 h-4"><path d="M12 20h9"></path><path d="M16.376 3.622a1 1 0 0 1 3.002 3.002L7.368 18.635a2 2 0 0 1-.855.506l-2.872.838a.5.5 0 0 1-.62-.62l.838-2.872a2 2 0 0 1 .506-.854z"></path></svg>
      </a>
    </div>
  </div>
</div>

<?php
$adminContent = ob_get_clean();
require __DIR__ . '/_layout/admin_master.php';
?>
