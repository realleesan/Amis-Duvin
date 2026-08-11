<?php
$title = 'Tổng quan — Admin CMS Amis Duvin';
$activeNav = 'dashboard';

ob_start();
?>

<div class="space-y-8">
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h2 class="font-heading-editorial text-2xl sm:text-3xl text-foreground font-bold tracking-wide">Tổng quan Hệ thống &amp; Thống kê Marketing</h2>
      <p class="font-body-modern text-sm text-muted-foreground mt-1">Xin chào <strong><?= htmlspecialchars($user['full_name'] ?? 'Quản trị viên') ?></strong>, dưới đây là chỉ số vận hành và đo lường truy cập theo thời gian thực.</p>
    </div>
    <div class="flex items-center gap-2 shrink-0">
      <a href="<?= admin_url('notifications') ?>" class="admin-btn-gold px-3.5 py-2 rounded text-xs font-semibold flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell w-4 h-4"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path></svg>
        <span>Nhật ký Thông báo</span>
        <?php if (!empty($unreadCount) && $unreadCount > 0): ?>
          <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-rose-500 text-white font-mono font-bold"><?= $unreadCount ?></span>
        <?php endif; ?>
      </a>
    </div>
  </div>

  <!-- Operational Metric Cards -->
  <div>
    <h3 class="text-xs uppercase tracking-widest text-[var(--gold)] font-mono font-semibold mb-3">1. Chỉ số Vận hành Đặt tiệc (Operational Data)</h3>
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
  </div>

  <!-- Traffic & Click Analytics Section (Marketing CRO) -->
  <div>
    <div class="flex items-center justify-between mb-3">
      <h3 class="text-xs uppercase tracking-widest text-[var(--gold)] font-mono font-semibold">2. Đo lường Lượt truy cập Landing Page (Traffic Analytics)</h3>
      <span class="text-[11px] font-mono text-muted-foreground">Real-time Analytics</span>
    </div>

    <!-- Traffic Cards -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <div class="rounded-sm border border-border/50 bg-card/80 p-4 space-y-1">
        <span class="text-[10px] uppercase tracking-wider text-muted-foreground font-mono">Hôm nay</span>
        <p class="text-2xl font-bold text-foreground tabular-nums"><?= number_format($trafficStats['today'] ?? 0) ?></p>
        <span class="text-[10px] text-emerald-400 font-mono">Lượt xem trang</span>
      </div>

      <div class="rounded-sm border border-border/50 bg-card/80 p-4 space-y-1">
        <span class="text-[10px] uppercase tracking-wider text-muted-foreground font-mono">Tuần này</span>
        <p class="text-2xl font-bold text-foreground tabular-nums"><?= number_format($trafficStats['week'] ?? 0) ?></p>
        <span class="text-[10px] text-emerald-400 font-mono">Lượt xem 7 ngày qua</span>
      </div>

      <div class="rounded-sm border border-border/50 bg-card/80 p-4 space-y-1">
        <span class="text-[10px] uppercase tracking-wider text-muted-foreground font-mono">Tháng này</span>
        <p class="text-2xl font-bold text-[var(--gold)] tabular-nums"><?= number_format($trafficStats['month'] ?? 0) ?></p>
        <span class="text-[10px] text-muted-foreground font-mono">Lượt xem tháng <?= date('m/Y') ?></span>
      </div>

      <div class="rounded-sm border border-border/50 bg-card/80 p-4 space-y-1">
        <span class="text-[10px] uppercase tracking-wider text-muted-foreground font-mono">Năm nay</span>
        <p class="text-2xl font-bold text-foreground tabular-nums"><?= number_format($trafficStats['year'] ?? 0) ?></p>
        <span class="text-[10px] text-muted-foreground font-mono">Tổng năm <?= date('Y') ?></span>
      </div>
    </div>
  </div>

  <!-- Click Analytics & Daily Trend Grid -->
  <div class="grid lg:grid-cols-2 gap-6">
    <!-- Top Clicked Elements Table -->
    <div class="rounded-sm border border-border bg-card p-5 space-y-4">
      <div class="flex items-center justify-between border-b border-border pb-3">
        <h4 class="font-heading text-base text-foreground">Top Điểm Click &amp; Nút Tương tác Marketing</h4>
        <span class="text-[10px] uppercase tracking-widest text-[var(--gold)] font-mono">CTR CRO</span>
      </div>

      <?php if (empty($topClicks)): ?>
        <p class="text-xs text-muted-foreground py-6 text-center">Chưa có dữ liệu lượt click nào được ghi nhận.</p>
      <?php else: ?>
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead>
              <tr class="border-b border-border/40 text-[10px] uppercase tracking-widest text-muted-foreground font-mono">
                <th class="pb-2">Nút / Điểm tương tác</th>
                <th class="pb-2 text-right">Lượt Click</th>
                <th class="pb-2 text-right">Mới nhất</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-border/30">
              <?php foreach ($topClicks as $c): ?>
                <tr>
                  <td class="py-2.5 font-medium text-foreground">
                    <span class="block truncate max-w-[200px]" title="<?= htmlspecialchars($c['element_label']) ?>">
                      <?= htmlspecialchars($c['element_label']) ?>
                    </span>
                    <span class="text-[10px] text-muted-foreground font-mono"><?= htmlspecialchars($c['element_key']) ?></span>
                  </td>
                  <td class="py-2.5 text-right font-mono font-bold text-[var(--gold)]">
                    <?= number_format($c['click_count']) ?>
                  </td>
                  <td class="py-2.5 text-right font-mono text-[10px] text-muted-foreground">
                    <?= date('H:i d/m', strtotime($c['last_clicked'])) ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>

    <!-- Daily Traffic Trend Chart -->
    <div class="rounded-sm border border-border bg-card p-5 space-y-4">
      <div class="flex items-center justify-between border-b border-border pb-3">
        <h4 class="font-heading text-base text-foreground">Biểu đồ Lượt truy cập 7 ngày qua</h4>
        <span class="text-[10px] uppercase tracking-widest text-emerald-400 font-mono">Pageviews Trend</span>
      </div>

      <?php if (empty($dailyTrend)): ?>
        <p class="text-xs text-muted-foreground py-6 text-center">Chưa có dữ liệu biểu đồ lượt truy cập 7 ngày qua.</p>
      <?php else: ?>
        <div class="space-y-3 pt-2">
          <?php
          $maxViews = max(array_column($dailyTrend, 'total_views')) ?: 1;
          foreach ($dailyTrend as $dt):
            $pct = round(($dt['total_views'] / $maxViews) * 100);
          ?>
            <div class="space-y-1 text-xs">
              <div class="flex items-center justify-between text-[11px] font-mono">
                <span class="text-muted-foreground"><?= date('d/m/Y', strtotime($dt['view_date'])) ?></span>
                <span class="font-bold text-foreground"><?= number_format($dt['total_views']) ?> lượt xem (<?= number_format($dt['unique_ips']) ?> IPs)</span>
              </div>
              <div class="w-full bg-muted/40 rounded-full h-2 overflow-hidden">
                <div class="bg-[var(--wine)] h-2 rounded-full transition-all duration-500" style="width: <?= max(5, $pct) ?>%"></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Quick Actions Panel -->
  <?php $userRole = $user['role'] ?? 'guest'; ?>
  <div class="grid lg:grid-cols-2 gap-6">
    <!-- CSKH Quick Actions -->
    <div class="rounded-sm border border-border bg-card p-6 space-y-4">
      <div class="flex items-center justify-between border-b border-border pb-4">
        <div>
          <h3 class="font-heading text-lg text-foreground">Xử lý Đơn Đặt tiệc (CSKH)</h3>
          <span class="text-[10px] uppercase tracking-widest text-[var(--gold)] font-mono">Master Data</span>
        </div>
        <?php if (in_array($userRole, ['admin', 'cskh'], true)): ?>
          <span class="inline-flex items-center gap-1.5 text-[10px] uppercase tracking-widest px-2.5 py-1 rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 font-semibold font-mono">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
            Có quyền truy cập
          </span>
        <?php else: ?>
          <span class="inline-flex items-center gap-1.5 text-[10px] uppercase tracking-widest px-2.5 py-1 rounded bg-rose-500/10 text-rose-400 border border-rose-500/30 font-semibold font-mono">
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            Yêu cầu CSKH / Admin
          </span>
        <?php endif; ?>
      </div>
      <p class="text-sm text-muted-foreground leading-relaxed">
        Quản lý chi tiết các đơn đặt tiệc trong vòng 5 ngày tới, kiểm tra trần giới hạn 2 đoàn/ca (tối đa 24 khách/ca), cập nhật tiền cọc 30% và đồng bộ tự động sang Google Sheets.
      </p>
      <a href="<?= admin_url('bookings') ?>" class="btn-wine inline-flex items-center gap-2 px-6 py-3 rounded-sm text-xs uppercase tracking-widest font-medium shadow-sm">
        <span>Vào trang quản lý đơn</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
      </a>
    </div>

    <!-- Marketing Quick Actions -->
    <div class="rounded-sm border border-border bg-card p-6 space-y-4">
      <div class="flex items-center justify-between border-b border-border pb-4">
        <div>
          <h3 class="font-heading text-lg text-foreground">Quản lý Nội dung (Marketing)</h3>
          <span class="text-[10px] uppercase tracking-widest text-[var(--gold)] font-mono">Dynamic CMS</span>
        </div>
        <?php if (in_array($userRole, ['admin', 'marketing'], true)): ?>
          <span class="inline-flex items-center gap-1.5 text-[10px] uppercase tracking-widest px-2.5 py-1 rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 font-semibold font-mono">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
            Có quyền truy cập
          </span>
        <?php else: ?>
          <span class="inline-flex items-center gap-1.5 text-[10px] uppercase tracking-widest px-2.5 py-1 rounded bg-rose-500/10 text-rose-400 border border-rose-500/30 font-semibold font-mono">
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            Yêu cầu Marketing / Admin
          </span>
        <?php endif; ?>
      </div>
      <p class="text-sm text-muted-foreground leading-relaxed">
        Tùy chỉnh linh hoạt văn bản, khẩu hiệu, thông điệp, hình ảnh của các Section: Hero, 3 Lợi ích cốt lõi, Giới thiệu dịch vụ, 4 Gói tiệc Food &amp; Wine Pairing.
      </p>
      <a href="<?= admin_url('content') ?>" class="btn-invert inline-flex items-center gap-2 px-6 py-3 rounded-sm text-xs uppercase tracking-widest font-medium shadow-sm">
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
