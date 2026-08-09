<?php 
$title = 'Thùng rác hệ thống — Amis du Vin CMS';
ob_start();
?>

<div class="space-y-6">
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-border/40">
    <div>
      <div class="flex items-center gap-2">
        <h1 class="text-2xl font-bold font-serif tracking-tight text-foreground">Thùng rác</h1>
        <span class="px-2 py-0.5 text-[10px] uppercase font-mono tracking-wider font-semibold rounded bg-rose-500/10 text-rose-400 border border-rose-500/20">Admin Only</span>
      </div>
      <p class="text-xs text-muted-foreground mt-1">Quản lý, khôi phục hoặc xóa vĩnh viễn các dữ liệu đã bị xóa tạm khỏi hệ thống.</p>
    </div>
  </div>

  <!-- Messages -->
  <?php if (!empty($message)): ?>
    <div class="p-4 rounded-sm bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-medium flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle w-4 h-4 shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
      <span><?= htmlspecialchars($message) ?></span>
    </div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div class="p-4 rounded-sm bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-medium flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle w-4 h-4 shrink-0"><circle cx="12" cy="12" r="10"></circle><line x1="12" x2="12" y1="8" y2="12"></line><line x1="12" x2="12.01" y1="16" y2="16"></line></svg>
      <span><?= htmlspecialchars($error) ?></span>
    </div>
  <?php endif; ?>

  <!-- Category Tabs -->
  <div class="flex items-center gap-2 border-b border-border/40 pb-3 overflow-x-auto">
    <a href="<?= admin_url('trash') ?>?type=bookings" class="px-3.5 py-2 rounded-sm text-xs font-medium transition-colors flex items-center gap-2 whitespace-nowrap <?= $type === 'bookings' ? 'bg-[var(--wine)] text-white font-semibold shadow-sm' : 'bg-card text-muted-foreground hover:text-foreground hover:bg-muted/50' ?>">
      <span>Đặt tiệc (Leads)</span>
      <span class="px-1.5 py-0.5 rounded-full text-[10px] font-mono <?= $type === 'bookings' ? 'bg-white/20 text-white' : 'bg-muted text-muted-foreground' ?>"><?= $counts['bookings'] ?></span>
    </a>

    <a href="<?= admin_url('trash') ?>?type=workshops" class="px-3.5 py-2 rounded-sm text-xs font-medium transition-colors flex items-center gap-2 whitespace-nowrap <?= $type === 'workshops' ? 'bg-[var(--wine)] text-white font-semibold shadow-sm' : 'bg-card text-muted-foreground hover:text-foreground hover:bg-muted/50' ?>">
      <span>Đăng ký Workshop</span>
      <span class="px-1.5 py-0.5 rounded-full text-[10px] font-mono <?= $type === 'workshops' ? 'bg-white/20 text-white' : 'bg-muted text-muted-foreground' ?>"><?= $counts['workshops'] ?></span>
    </a>

    <a href="<?= admin_url('trash') ?>?type=users" class="px-3.5 py-2 rounded-sm text-xs font-medium transition-colors flex items-center gap-2 whitespace-nowrap <?= $type === 'users' ? 'bg-[var(--wine)] text-white font-semibold shadow-sm' : 'bg-card text-muted-foreground hover:text-foreground hover:bg-muted/50' ?>">
      <span>Nhân sự</span>
      <span class="px-1.5 py-0.5 rounded-full text-[10px] font-mono <?= $type === 'users' ? 'bg-white/20 text-white' : 'bg-muted text-muted-foreground' ?>"><?= $counts['users'] ?></span>
    </a>

    <a href="<?= admin_url('trash') ?>?type=notifications" class="px-3.5 py-2 rounded-sm text-xs font-medium transition-colors flex items-center gap-2 whitespace-nowrap <?= $type === 'notifications' ? 'bg-[var(--wine)] text-white font-semibold shadow-sm' : 'bg-card text-muted-foreground hover:text-foreground hover:bg-muted/50' ?>">
      <span>Thông báo</span>
      <span class="px-1.5 py-0.5 rounded-full text-[10px] font-mono <?= $type === 'notifications' ? 'bg-white/20 text-white' : 'bg-muted text-muted-foreground' ?>"><?= $counts['notifications'] ?></span>
    </a>
  </div>

  <!-- Trash Data Table -->
  <div class="rounded-sm border border-border/40 bg-card overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm border-collapse">
        <thead>
          <tr class="bg-muted/40 text-[11px] uppercase tracking-wider text-muted-foreground border-b border-border/40">
            <?php if ($type === 'bookings'): ?>
              <th class="p-4">Mã Lead</th>
              <th class="p-4">Khách hàng</th>
              <th class="p-4">Số ĐT / Email</th>
              <th class="p-4">Số khách</th>
              <th class="p-4">Ngày tiệc / Ca</th>
              <th class="p-4">Ngày xóa</th>
              <th class="p-4 text-right">Thao tác</th>
            <?php elseif ($type === 'workshops'): ?>
              <th class="p-4">Mã Đơn</th>
              <th class="p-4">Khách hàng</th>
              <th class="p-4">Số ĐT / Email</th>
              <th class="p-4">Tên Workshop</th>
              <th class="p-4">Số vé</th>
              <th class="p-4">Ngày xóa</th>
              <th class="p-4 text-right">Thao tác</th>
            <?php elseif ($type === 'users'): ?>
              <th class="p-4">ID</th>
              <th class="p-4">Tên đăng nhập</th>
              <th class="p-4">Họ và tên</th>
              <th class="p-4">Vai trò</th>
              <th class="p-4">Ngày xóa</th>
              <th class="p-4 text-right">Thao tác</th>
            <?php elseif ($type === 'notifications'): ?>
              <th class="p-4">Loại</th>
              <th class="p-4">Tiêu đề / Nội dung</th>
              <th class="p-4">Thực hiện bởi</th>
              <th class="p-4">Ngày xóa</th>
              <th class="p-4 text-right">Thao tác</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody class="divide-y divide-border/40">
          <?php if (empty($items)): ?>
            <tr>
              <td colspan="7" class="p-12 text-center text-muted-foreground">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 mx-auto mb-2 opacity-50"><path d="3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>
                <p class="text-xs font-medium">Thùng rác mục này hiện đang trống.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($items as $item): ?>
              <tr class="hover:bg-muted/20 transition-colors">
                <?php if ($type === 'bookings'): ?>
                  <td class="p-4 font-mono text-xs font-semibold text-[var(--gold)]">LEAD-<?= str_pad((string)$item['id'], 5, '0', STR_PAD_LEFT) ?></td>
                  <td class="p-4 font-medium text-foreground">
                    <div><?= htmlspecialchars($item['full_name']) ?></div>
                    <?php if (!empty($item['notes'])): ?>
                      <div class="text-[11px] text-muted-foreground/80 truncate max-w-xs"><?= htmlspecialchars($item['notes']) ?></div>
                    <?php endif; ?>
                  </td>
                  <td class="p-4 text-xs text-foreground/80 font-mono">
                    <div><?= htmlspecialchars($item['phone']) ?></div>
                    <div class="text-muted-foreground truncate max-w-xs"><?= htmlspecialchars($item['email']) ?></div>
                  </td>
                  <td class="p-4 font-semibold tabular-nums text-foreground"><?= (int)$item['participants'] ?> người</td>
                  <td class="p-4 text-xs">
                    <div class="font-medium text-foreground font-mono"><?= date('d/m/Y', strtotime($item['booking_date'])) ?></div>
                    <div class="text-muted-foreground"><?= htmlspecialchars($item['time_slot']) ?></div>
                  </td>
                  <td class="p-4 text-xs text-rose-400 font-mono whitespace-nowrap">
                    <?= !empty($item['deleted_at']) ? date('d/m/Y H:i', strtotime($item['deleted_at'])) : '—' ?>
                  </td>

                <?php elseif ($type === 'workshops'): ?>
                  <td class="p-4 font-mono text-xs font-semibold text-[var(--gold)]">WS-<?= str_pad((string)$item['id'], 4, '0', STR_PAD_LEFT) ?></td>
                  <td class="p-4 font-medium text-foreground">
                    <div><?= htmlspecialchars($item['full_name']) ?></div>
                    <?php if (!empty($item['notes'])): ?>
                      <div class="text-[11px] text-muted-foreground/80 truncate max-w-xs"><?= htmlspecialchars($item['notes']) ?></div>
                    <?php endif; ?>
                  </td>
                  <td class="p-4 font-mono text-xs text-muted-foreground">
                    <div><?= htmlspecialchars($item['phone']) ?></div>
                    <div class="text-[11px] text-muted-foreground/75"><?= htmlspecialchars($item['email']) ?></div>
                  </td>
                  <td class="p-4 font-medium text-foreground">
                    <?= htmlspecialchars($item['workshop_title'] ?? 'Workshop #' . $item['workshop_id']) ?>
                  </td>
                  <td class="p-4 font-mono text-xs text-foreground font-semibold"><?= (int)$item['participants'] ?> vé</td>
                  <td class="p-4 text-xs text-rose-400 font-mono whitespace-nowrap">
                    <?= !empty($item['deleted_at']) ? date('d/m/Y H:i', strtotime($item['deleted_at'])) : '—' ?>
                  </td>

                <?php elseif ($type === 'users'): ?>
                  <td class="p-4 font-mono text-xs font-semibold text-muted-foreground">#<?= $item['id'] ?></td>
                  <td class="p-4 font-mono text-xs font-bold text-foreground"><?= htmlspecialchars($item['username']) ?></td>
                  <td class="p-4 font-medium text-foreground"><?= htmlspecialchars($item['full_name']) ?></td>
                  <td class="p-4">
                    <span class="inline-block px-2 py-0.5 rounded text-[10px] uppercase font-mono tracking-wider font-semibold border bg-blue-500/10 text-blue-400 border-blue-500/20">
                      <?= htmlspecialchars($item['role']) ?>
                    </span>
                  </td>
                  <td class="p-4 text-xs text-rose-400 font-mono whitespace-nowrap">
                    <?= !empty($item['deleted_at']) ? date('d/m/Y H:i', strtotime($item['deleted_at'])) : '—' ?>
                  </td>

                <?php elseif ($type === 'notifications'): ?>
                  <td class="p-4">
                    <span class="inline-block px-2 py-0.5 rounded text-[10px] uppercase font-mono tracking-wider font-semibold border bg-purple-500/10 text-purple-400 border-purple-500/20">
                      <?= htmlspecialchars($item['type']) ?>
                    </span>
                  </td>
                  <td class="p-4">
                    <div class="font-semibold text-xs text-foreground"><?= htmlspecialchars($item['title']) ?></div>
                    <div class="text-xs text-muted-foreground truncate max-w-md mt-0.5"><?= htmlspecialchars($item['content']) ?></div>
                  </td>
                  <td class="p-4 text-xs font-medium text-foreground"><?= htmlspecialchars($item['user_name']) ?></td>
                  <td class="p-4 text-xs text-rose-400 font-mono whitespace-nowrap">
                    <?= !empty($item['deleted_at']) ? date('d/m/Y H:i', strtotime($item['deleted_at'])) : '—' ?>
                  </td>
                <?php endif; ?>

                <!-- Action buttons -->
                <td class="p-4 text-right whitespace-nowrap">
                  <div class="inline-flex items-center gap-2">
                    <!-- Restore Form -->
                    <form action="<?= admin_url('trash/restore') ?>" method="POST" class="inline-block">
                      <input type="hidden" name="type" value="<?= htmlspecialchars($type) ?>">
                      <input type="hidden" name="id" value="<?= $item['id'] ?>">
                      <button type="submit" class="px-2.5 py-1 rounded text-xs font-medium bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 hover:bg-emerald-500/25 transition-colors inline-flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rotate-ccw"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><path d="M3 3v5h5"></path></svg>
                        <span>Khôi phục</span>
                      </button>
                    </form>

                    <!-- Force Delete Form -->
                    <form action="<?= admin_url('trash/force-delete') ?>" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn mục này? Thao tác này không thể hoàn tác!')">
                      <input type="hidden" name="type" value="<?= htmlspecialchars($type) ?>">
                      <input type="hidden" name="id" value="<?= $item['id'] ?>">
                      <button type="submit" class="px-2.5 py-1 rounded text-xs font-medium bg-rose-500/15 text-rose-400 border border-rose-500/30 hover:bg-rose-500/25 transition-colors inline-flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                        <span>Xóa vĩnh viễn</span>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php 
$adminContent = ob_get_clean();
require __DIR__ . '/../_layout/admin_master.php';
?>
