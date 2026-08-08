<?php
$title = 'Quản lý Đơn Đặt tiệc — Admin CMS Amis du Vin';
$activeNav = 'bookings';

ob_start();
?>

<div class="space-y-6">
  <!-- Header & Filters -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-border/40 pb-6">
    <div>
      <h2 class="font-heading text-2xl sm:text-3xl text-foreground">Danh sách Đơn Đặt tiệc</h2>
      <p class="text-sm text-muted-foreground mt-1">Quản lý lead khách hàng, chốt cọc 30% và đồng bộ Google Sheets</p>
    </div>

    <div class="flex flex-wrap items-center gap-3">
      <!-- CSKH Manual Entry Button -->
      <button type="button" onclick="openManualCreateModal()" class="btn-wine inline-flex items-center gap-2 px-4 py-2.5 rounded-sm text-xs uppercase tracking-widest font-medium shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-circle w-4 h-4"><circle cx="12" cy="12" r="10"></circle><path d="M12 8v8"></path><path d="M8 12h8"></path></svg>
        <span>Thêm đơn nhập tay</span>
      </button>

      <!-- Filter Form -->
      <form method="GET" action="/admin/bookings" class="flex flex-wrap items-center gap-3">
        <select name="status" onchange="this.form.submit()" class="input-elegant px-3.5 py-2.5 rounded-sm text-xs cursor-pointer">
          <option value="" class="bg-card text-foreground">Tất cả trạng thái</option>
          <option value="Chờ xác nhận" <?= ($statusFilter ?? '') === 'Chờ xác nhận' ? 'selected' : '' ?> class="bg-card text-foreground">Chờ xác nhận</option>
          <option value="Đã chốt cọc 30%" <?= ($statusFilter ?? '') === 'Đã chốt cọc 30%' ? 'selected' : '' ?> class="bg-card text-foreground">Đã chốt cọc 30%</option>
          <option value="Hoàn thành" <?= ($statusFilter ?? '') === 'Hoàn thành' ? 'selected' : '' ?> class="bg-card text-foreground">Hoàn thành</option>
          <option value="Đã hủy" <?= ($statusFilter ?? '') === 'Đã hủy' ? 'selected' : '' ?> class="bg-card text-foreground">Đã hủy</option>
        </select>

        <input type="date" name="date" value="<?= htmlspecialchars($dateFilter ?? '') ?>" onchange="this.form.submit()" class="input-elegant px-3.5 py-2.5 rounded-sm text-xs cursor-pointer">

        <?php if (!empty($statusFilter) || !empty($dateFilter)): ?>
          <a href="/admin/bookings" class="text-xs text-rose-400 hover:underline">Xóa lọc</a>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <!-- Bookings Data Table -->
  <div class="rounded-sm border border-border/40 bg-card overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm border-collapse">
        <thead>
          <tr class="bg-muted/40 text-[11px] uppercase tracking-wider text-muted-foreground border-b border-border/40">
            <th class="p-4">Mã Lead</th>
            <th class="p-4">Khách hàng</th>
            <th class="p-4">Số ĐT / Email</th>
            <th class="p-4">Số khách</th>
            <th class="p-4">Ngày tiệc / Ca</th>
            <th class="p-4">Trạng thái cọc</th>
            <th class="p-4 text-right">Thao tác</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-border/40">
          <?php if (empty($bookings)): ?>
            <tr>
              <td colspan="7" class="p-8 text-center text-muted-foreground text-sm">
                Chưa có đơn đặt tiệc nào trong hệ thống.
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($bookings as $b): ?>
              <?php 
                $leadCode = 'LEAD-' . str_pad((string)$b['id'], 5, '0', STR_PAD_LEFT);
                $status = $b['deposit_status'] ?? 'Chờ xác nhận';
                $badgeClass = match($status) {
                  'Đã chốt cọc 30%' => 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30',
                  'Hoàn thành' => 'bg-blue-500/15 text-blue-400 border-blue-500/30',
                  'Đã hủy' => 'bg-rose-500/15 text-rose-400 border-rose-500/30',
                  default => 'bg-[var(--gold)]/15 text-[var(--gold)] border-[var(--gold)]/30'
                };
              ?>
              <tr class="hover:bg-muted/20 transition-colors">
                <td class="p-4 font-mono text-xs font-semibold text-[var(--gold)]"><?= $leadCode ?></td>
                <td class="p-4 font-medium text-foreground">
                  <div><?= htmlspecialchars($b['full_name']) ?></div>
                  <?php if (!empty($b['notes'])): ?>
                    <div class="text-[11px] text-muted-foreground/80 truncate max-w-xs" title="<?= htmlspecialchars($b['notes']) ?>"><?= htmlspecialchars($b['notes']) ?></div>
                  <?php endif; ?>
                </td>
                <td class="p-4 text-xs text-foreground/80">
                  <div><a href="tel:<?= htmlspecialchars($b['phone']) ?>" class="hover:text-[var(--wine)] font-mono"><?= htmlspecialchars($b['phone']) ?></a></div>
                  <div class="text-muted-foreground truncate max-w-xs"><?= htmlspecialchars($b['email']) ?></div>
                </td>
                <td class="p-4 font-semibold tabular-nums text-foreground"><?= (int)$b['participants'] ?> người</td>
                <td class="p-4 text-xs">
                  <div class="font-medium text-foreground"><?= date('d/m/Y', strtotime($b['booking_date'])) ?></div>
                  <div class="text-muted-foreground"><?= htmlspecialchars($b['time_slot']) ?></div>
                </td>
                <td class="p-4">
                  <span class="inline-block text-[11px] font-medium px-2.5 py-1 rounded-full border <?= $badgeClass ?>">
                    <?= htmlspecialchars($status) ?>
                  </span>
                </td>
                <td class="p-4 text-right space-x-2">
                  <!-- Quick Edit Status Modal Trigger -->
                  <button type="button" onclick="openEditBookingModal(<?= htmlspecialchars(json_encode($b), ENT_QUOTES, 'UTF-8') ?>)" class="px-3 py-1.5 rounded-sm bg-muted text-xs text-foreground hover:bg-[var(--wine)] hover:text-white transition-colors">
                    Cập nhật
                  </button>

                  <!-- Manual Sync Button -->
                  <form action="/admin/bookings/sync" method="POST" class="inline-block">
                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                    <button type="submit" class="px-3 py-1.5 rounded-sm bg-muted text-xs text-muted-foreground hover:text-[var(--gold)] hover:bg-muted/80 transition-colors" title="Đẩy sang Google Sheets">
                      Đồng bộ Sheets
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Manual Create Booking Modal (CSKH Hotline Entry) -->
<div id="manualCreateBookingModal" class="modal-overlay">
  <div class="relative w-full max-w-lg bg-card border border-border/40 rounded-sm p-6 sm:p-8 shadow-2xl animate-scale-in my-auto">
    <button onclick="closeManualCreateModal()" type="button" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>

    <h3 class="font-heading text-xl text-foreground mb-1">Tạo Đơn tiệc Nhập tay (CSKH)</h3>
    <p class="text-xs text-muted-foreground mb-4">Tiếp nhận thông tin khách gọi qua Hotline / Zalo</p>

    <form action="/admin/bookings/manual-create" method="POST" class="space-y-4">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Họ và tên khách *</label>
          <input type="text" name="full_name" required placeholder="Nguyễn Văn A" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
        </div>

        <div>
          <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Số điện thoại *</label>
          <input type="tel" name="phone" required placeholder="0912345678" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm font-mono">
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Email liên hệ</label>
          <input type="email" name="email" placeholder="khach@gmail.com" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
        </div>

        <div>
          <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Số khách (Trần 24) *</label>
          <input type="number" name="participants" min="1" max="24" required value="4" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm font-semibold">
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Ngày tiệc (Trong vòng 5 ngày tới) *</label>
          <input type="date" name="booking_date" required min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+5 days')) ?>" value="<?= date('Y-m-d') ?>" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
        </div>

        <div>
          <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Ca tiệc *</label>
          <select name="time_slot" required class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
            <option value="Ca 1 (11h00 – 14h00)" class="bg-card text-foreground">Ca 1 (11h00 – 14h00)</option>
            <option value="Ca 2 (18h00 – 21h00)" class="bg-card text-foreground">Ca 2 (18h00 – 21h00)</option>
          </select>
        </div>
      </div>

      <div>
        <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Trạng thái cọc ban đầu</label>
        <select name="deposit_status" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
          <option value="Chờ xác nhận" class="bg-card text-foreground">Chờ xác nhận</option>
          <option value="Đã chốt cọc 30%" class="bg-card text-foreground">Đã chốt cọc 30%</option>
          <option value="Hoàn thành" class="bg-card text-foreground">Hoàn thành</option>
        </select>
      </div>

      <div>
        <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Ghi chú yêu cầu của khách</label>
        <textarea name="notes" rows="2" placeholder="Ví dụ: Gọi điện lúc 15h chốt thực đơn Signature Pairing" class="input-elegant w-full p-2.5 rounded-sm text-sm"></textarea>
      </div>

      <div class="pt-2 flex gap-3">
        <button type="submit" class="btn-wine flex-1 py-3 rounded-sm text-xs uppercase tracking-widest font-medium">
          Tạo đơn &amp; Đẩy Sheets
        </button>
        <button type="button" onclick="closeManualCreateModal()" class="px-5 py-3 rounded-sm bg-muted text-xs uppercase tracking-widest text-muted-foreground hover:text-foreground">
          Hủy
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Booking Status Modal -->
<div id="editBookingModal" class="modal-overlay">
  <div class="relative w-full max-w-lg bg-card border border-border/40 rounded-sm p-6 sm:p-8 shadow-2xl animate-scale-in my-auto">
    <button onclick="closeEditBookingModal()" type="button" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>

    <h3 class="font-heading text-xl text-foreground mb-4">Cập nhật đơn <span id="modalLeadCode" class="text-[var(--gold)] font-mono"></span></h3>

    <form action="/admin/bookings/update" method="POST" class="space-y-4">
      <input type="hidden" id="modalBookingId" name="id" value="">

      <div>
        <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Trạng thái tiền cọc (Master Data)</label>
        <select id="modalStatusSelect" name="deposit_status" class="input-elegant w-full px-4 py-3 rounded-sm text-sm">
          <option value="Chờ xác nhận" class="bg-card text-foreground">Chờ xác nhận</option>
          <option value="Đã chốt cọc 30%" class="bg-card text-foreground">Đã chốt cọc 30%</option>
          <option value="Hoàn thành" class="bg-card text-foreground">Hoàn thành</option>
          <option value="Đã hủy" class="bg-card text-foreground">Đã hủy</option>
        </select>
      </div>

      <div>
        <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Ghi chú CSKH</label>
        <textarea id="modalNotesText" name="notes" rows="3" placeholder="Ví dụ: Đã nhận cọc 30% qua QR VNPay 1.500.000đ" class="input-elegant w-full p-3 rounded-sm text-sm"></textarea>
      </div>

      <div class="pt-3 flex gap-3">
        <button type="submit" class="btn-wine flex-1 py-3 rounded-sm text-xs uppercase tracking-widest font-medium">
          Lưu &amp; Đồng bộ Sheets
        </button>
        <button type="button" onclick="closeEditBookingModal()" class="px-5 py-3 rounded-sm bg-muted text-xs uppercase tracking-widest text-muted-foreground hover:text-foreground">
          Hủy
        </button>
      </div>
    </form>
  </div>
</div>

<script>
function openManualCreateModal() {
  document.getElementById('manualCreateBookingModal').classList.add('active');
}
function closeManualCreateModal() {
  document.getElementById('manualCreateBookingModal').classList.remove('active');
}
function openEditBookingModal(booking) {
  document.getElementById('modalBookingId').value = booking.id;
  document.getElementById('modalLeadCode').textContent = 'LEAD-' + String(booking.id).padStart(5, '0');
  document.getElementById('modalStatusSelect').value = booking.deposit_status || 'Chờ xác nhận';
  document.getElementById('modalNotesText').value = booking.notes || '';
  document.getElementById('editBookingModal').classList.add('active');
}
function closeEditBookingModal() {
  document.getElementById('editBookingModal').classList.remove('active');
}
</script>

<?php
$adminContent = ob_get_clean();
require __DIR__ . '/../_layout/admin_master.php';
?>
