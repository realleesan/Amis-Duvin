<?php
$title = 'Quản lý Thông báo & Nhật ký Biến động — Amis du Vin';
$activeNav = 'notifications';
ob_start();
?>

<div class="space-y-6">
  <!-- Header Title -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-xl font-bold tracking-tight text-foreground font-heading">Quản lý Thông báo &amp; Nhật ký Biến động</h1>
      <p class="text-xs text-muted-foreground mt-0.5">Theo dõi lịch sử đơn đặt tiệc, chỉnh sửa nội dung CMS, thao tác nhân sự và nhật ký hệ thống.</p>
    </div>
    <div class="flex items-center gap-2">
      <button type="button" onclick="markAllNotificationsRead()" class="admin-btn-gold px-3 py-1.5 rounded text-xs font-semibold flex items-center gap-1.5">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-check w-3.5 h-3.5"><path d="M18 6 7 17l-5-5"></path><path d="m22 10-7.5 7.5L13 16"></path></svg>
        <span>Đánh dấu đã đọc tất cả</span>
      </button>

      <?php if (($user['role'] ?? '') === 'admin'): ?>
        <a href="<?= admin_url('trash') ?>?type=notifications" class="px-3 py-1.5 rounded bg-rose-500/10 text-rose-400 border border-rose-500/30 hover:bg-rose-500/20 transition-colors text-xs font-medium inline-flex items-center gap-1.5" title="Xem thùng rác thông báo">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
          <span>Thùng rác</span>
        </a>
      <?php endif; ?>
    </div>
  </div>

  <!-- Filters Bar -->
  <div class="bg-card border border-border/40 p-4 rounded-sm">
    <form method="GET" action="<?= admin_url('notifications') ?>" class="flex flex-wrap items-center gap-3">
      <div>
        <label class="block text-[10px] uppercase tracking-wider text-muted-foreground mb-1">Loại thông báo</label>
        <select name="type" onchange="this.form.submit()" class="input-elegant px-3 py-1.5 rounded text-xs font-medium bg-background cursor-pointer">
          <option value="" class="bg-card text-foreground">Tất cả các loại</option>
          <option value="booking" <?= $typeFilter === 'booking' ? 'selected' : '' ?> class="bg-card text-foreground">Đặt tiệc &amp; Leads</option>
          <option value="workshop" <?= $typeFilter === 'workshop' ? 'selected' : '' ?> class="bg-card text-foreground">Khóa học &amp; Workshop</option>
          <option value="content" <?= $typeFilter === 'content' ? 'selected' : '' ?> class="bg-card text-foreground">Nội dung CMS</option>
          <option value="user" <?= $typeFilter === 'user' ? 'selected' : '' ?> class="bg-card text-foreground">Nhân sự &amp; Auth</option>
          <option value="system" <?= $typeFilter === 'system' ? 'selected' : '' ?> class="bg-card text-foreground">Hệ thống &amp; Sheets</option>
        </select>
      </div>

      <div>
        <label class="block text-[10px] uppercase tracking-wider text-muted-foreground mb-1">Trạng thái đọc</label>
        <select name="status" onchange="this.form.submit()" class="input-elegant px-3 py-1.5 rounded text-xs font-medium bg-background cursor-pointer">
          <option value="" class="bg-card text-foreground">Tất cả trạng thái</option>
          <option value="unread" <?= $statusFilter === 'unread' ? 'selected' : '' ?> class="bg-card text-foreground">Chưa đọc</option>
          <option value="read" <?= $statusFilter === 'read' ? 'selected' : '' ?> class="bg-card text-foreground">Đã đọc</option>
        </select>
      </div>

      <?php if ($typeFilter || $statusFilter): ?>
        <div class="self-end pb-0.5">
          <a href="<?= admin_url('notifications') ?>" class="text-xs text-muted-foreground hover:text-rose-400 underline">Xóa bộ lọc</a>
        </div>
      <?php endif; ?>
    </form>
  </div>

  <!-- Bulk Action Bar -->
  <div id="bulkNotifBar" class="hidden items-center justify-between p-3.5 bg-muted/40 border border-[var(--wine)]/30 rounded-sm shadow-md mb-4">
    <div class="flex items-center gap-2 text-xs text-foreground font-medium">
      <span class="w-2 h-2 rounded-full bg-[var(--gold)] animate-pulse"></span>
      <span>Đã chọn <strong id="bulkNotifCount" class="text-[var(--gold)] font-mono font-bold">0</strong> thông báo</span>
    </div>
    <div class="flex items-center gap-2">
      <button type="button" onclick="submitBulkNotifAction('mark-read')" class="px-3 py-1.5 rounded text-xs font-medium bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 hover:bg-emerald-500/25 transition-colors flex items-center gap-1.5">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-check"><path d="M18 6 7 17l-5-5"></path><path d="m22 10-7.5 7.5L13 16"></path></svg>
        <span>Đánh dấu đã đọc</span>
      </button>
      <?php if (($user['role'] ?? '') === 'admin'): ?>
        <button type="button" onclick="submitBulkNotifAction('delete')" class="px-3 py-1.5 rounded text-xs font-medium bg-rose-500/15 text-rose-400 border border-rose-500/30 hover:bg-rose-500/25 transition-colors flex items-center gap-1.5">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
          <span>Chuyển vào Thùng rác</span>
        </button>
      <?php endif; ?>
    </div>
  </div>

  <!-- Notifications List Form -->
  <form id="bulkNotifForm" method="POST" action="<?= admin_url('notifications/bulk-delete') ?>">
    <div class="bg-card border border-border/40 rounded-sm overflow-hidden">
      <?php if (empty($notifications)): ?>
        <div class="p-12 text-center text-muted-foreground">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell-off mx-auto mb-2 opacity-50"><path d="M10.268 21a2 2 0 0 0 3.464 0"></path><path d="M17 17H3"></path><path d="M17 17a2 2 0 0 0 2-2V9a7 7 0 0 0-3.51-6.04"></path><path d="M2 2l20 20"></path></svg>
          <p class="text-sm font-medium">Không tìm thấy thông báo nào phù hợp.</p>
        </div>
      <?php else: ?>
        <div class="px-4 py-2.5 bg-muted/40 border-b border-border/40 flex items-center gap-3 text-xs text-muted-foreground font-medium">
          <input type="checkbox" id="selectAllNotifs" onclick="toggleSelectAllNotifs(this)" class="rounded border-border cursor-pointer">
          <label for="selectAllNotifs" class="cursor-pointer select-none">Chọn tất cả thông báo trên trang này</label>
        </div>

        <div class="divide-y divide-border/40">
          <?php foreach ($notifications as $n): ?>
            <?php
            $typeBadge = match($n['type']) {
              'booking' => ['bg' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30', 'label' => 'Đặt tiệc'],
              'workshop' => ['bg' => 'bg-purple-500/10 text-purple-400 border-purple-500/30', 'label' => 'Workshop'],
              'content' => ['bg' => 'bg-amber-500/10 text-amber-400 border-amber-500/30', 'label' => 'Nội dung CMS'],
              'user' => ['bg' => 'bg-blue-500/10 text-blue-400 border-blue-500/30', 'label' => 'Nhân sự'],
              default => ['bg' => 'bg-rose-500/10 text-rose-400 border-rose-500/30', 'label' => 'Hệ thống']
            };
            ?>
            <div class="p-4 flex items-start justify-between gap-4 transition-colors hover:bg-muted/20 <?= !$n['is_read'] ? 'bg-amber-500/5' : '' ?>">
              <div class="flex items-start gap-3 min-w-0">
                <input type="checkbox" name="ids[]" value="<?= $n['id'] ?>" class="notif-cb rounded border-border cursor-pointer shrink-0 mt-1" onchange="updateBulkNotifBar()">
                <!-- Type Indicator Badge -->
                <span class="inline-block mt-0.5 px-2 py-0.5 rounded text-[10px] uppercase font-mono font-semibold border shrink-0 <?= $typeBadge['bg'] ?>">
                  <?= $typeBadge['label'] ?>
                </span>
              <div>
                <div class="flex items-center gap-2">
                  <h3 class="text-xs font-semibold text-foreground <?= !$n['is_read'] ? 'font-bold' : '' ?>">
                    <?= htmlspecialchars($n['title']) ?>
                  </h3>
                  <?php if (!$n['is_read']): ?>
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--wine)] inline-block" title="Chưa đọc"></span>
                  <?php endif; ?>
                </div>
                <p class="text-xs text-muted-foreground mt-1 leading-relaxed">
                  <?= htmlspecialchars($n['content']) ?>
                </p>
                <div class="flex items-center gap-3 text-[11px] font-mono text-muted-foreground/75 mt-2">
                  <span>Thực hiện bởi: <strong class="text-foreground font-sans"><?= htmlspecialchars($n['user_name']) ?></strong></span>
                  <span>•</span>
                  <span><?= date('d/m/Y H:i:s', strtotime($n['created_at'])) ?></span>
                </div>
              </div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
              <?php if (!empty($n['action_url'])): ?>
                <a href="<?= htmlspecialchars($n['action_url']) ?>" class="px-2.5 py-1 rounded text-xs font-medium bg-muted hover:bg-muted/80 text-foreground transition-colors">
                  Chi tiết ➔
                </a>
              <?php endif; ?>
              <?php if (!$n['is_read']): ?>
                <button type="button" onclick="markSingleNotificationRead(<?= $n['id'] ?>, this)" class="p-1 rounded text-muted-foreground hover:text-emerald-400 hover:bg-muted transition-colors" title="Đánh dấu đã đọc">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-4 h-4"><path d="M20 6 9 17l-5-5"></path></svg>
                </button>
              <?php endif; ?>

              <?php if (($user['role'] ?? '') === 'admin'): ?>
                <form action="<?= admin_url('notifications/delete') ?>" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc muốn chuyển thông báo này vào Thùng rác?')">
                  <input type="hidden" name="id" value="<?= $n['id'] ?>">
                  <button type="submit" class="p-1 rounded text-muted-foreground hover:text-rose-400 hover:bg-muted transition-colors" title="Xóa tạm (vào thùng rác)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                  </button>
                </form>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Pagination -->
      <?php if ($totalPages > 1): ?>
        <div class="p-4 border-t border-border/40 flex items-center justify-between text-xs text-muted-foreground">
          <span>Trang <?= $page ?> / <?= $totalPages ?> (Tổng <?= $totalItems ?> thông báo)</span>
          <div class="flex gap-1">
            <?php if ($page > 1): ?>
              <a href="<?= admin_url('notifications') ?>?type=<?= urlencode($typeFilter) ?>&status=<?= urlencode($statusFilter) ?>&page=<?= $page - 1 ?>" class="px-2.5 py-1 rounded border border-border/40 hover:bg-muted text-foreground">Trước</a>
            <?php endif; ?>
            <?php if ($page < $totalPages): ?>
              <a href="<?= admin_url('notifications') ?>?type=<?= urlencode($typeFilter) ?>&status=<?= urlencode($statusFilter) ?>&page=<?= $page + 1 ?>" class="px-2.5 py-1 rounded border border-border/40 hover:bg-muted text-foreground">Sau</a>
            <?php endif; ?>
          </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</form>
</div>

<script>
function markSingleNotificationRead(id, btn) {
  fetch('<?= admin_url('api/notifications/mark-read') ?>', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'id=' + id
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      window.location.reload();
    }
  });
}

function markAllNotificationsRead() {
  fetch('<?= admin_url('api/notifications/mark-all-read') ?>', {
    method: 'POST'
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      window.location.reload();
    }
  });
}

function toggleSelectAllNotifs(master) {
  const checkboxes = document.querySelectorAll('.notif-cb');
  checkboxes.forEach(cb => cb.checked = master.checked);
  updateBulkNotifBar();
}

function updateBulkNotifBar() {
  const checked = document.querySelectorAll('.notif-cb:checked');
  const all = document.querySelectorAll('.notif-cb');
  const bar = document.getElementById('bulkNotifBar');
  const countEl = document.getElementById('bulkNotifCount');
  const master = document.getElementById('selectAllNotifs');

  if (countEl) countEl.textContent = checked.length;
  if (bar) {
    if (checked.length > 0) {
      bar.classList.remove('hidden');
      bar.classList.add('flex');
    } else {
      bar.classList.add('hidden');
      bar.classList.remove('flex');
    }
  }
  if (master && all.length > 0) {
    master.checked = (checked.length === all.length);
    master.indeterminate = (checked.length > 0 && checked.length < all.length);
  }
}

function submitBulkNotifAction(action) {
  const checked = document.querySelectorAll('.notif-cb:checked');
  if (checked.length === 0) {
    alert('Vui lòng chọn ít nhất 1 thông báo.');
    return;
  }

  if (action === 'mark-read') {
    const ids = Array.from(checked).map(cb => cb.value);
    const body = ids.map(id => 'ids[]=' + encodeURIComponent(id)).join('&');
    fetch('<?= admin_url('api/notifications/bulk-mark-read') ?>', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: body
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) window.location.reload();
    });
  } else if (action === 'delete') {
    if (confirm(`Bạn có chắc chắn muốn chuyển ${checked.length} thông báo đã chọn vào Thùng rác?`)) {
      document.getElementById('bulkNotifForm').submit();
    }
  }
}
</script>

<?php
$adminContent = ob_get_clean();
require __DIR__ . '/../_layout/admin_master.php';
