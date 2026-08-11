<?php
$title = 'Quản lý Đơn Đặt tiệc — Admin CMS Amis Duvin';
$activeNav = 'bookings';

ob_start();
?>


<div class="space-y-6">
  <!-- Header Title Section -->
  <div class="border-b border-[var(--gold)]/20 pb-5">
    <h2 class="font-heading-editorial text-2xl sm:text-3xl text-foreground font-bold tracking-wide">Danh sách Đơn Đặt tiệc</h2>
    <p class="font-body-modern text-sm text-muted-foreground mt-1">Quản lý lead khách hàng, chốt cọc 30% và đồng bộ Google Sheets</p>
  </div>

  <!-- Toolbar Controls Bar: Filters on Left, Actions on Right -->
  <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
    <!-- Left: Filter Controls -->
    <div class="flex flex-wrap items-center gap-3">
      <form id="bookingFilterForm" method="GET" action="<?= admin_url('bookings') ?>" class="flex flex-wrap items-center gap-3">
        <label for="filterStatusSelect" class="sr-only">Lọc theo trạng thái</label>
        <select id="filterStatusSelect" name="status" aria-label="Lọc theo trạng thái" onchange="this.form.submit()" class="input-elegant px-3.5 py-2 rounded-sm text-xs cursor-pointer">
          <option value="" class="bg-card text-foreground">Tất cả trạng thái</option>
          <option value="Chờ xác nhận" <?= ($statusFilter ?? '') === 'Chờ xác nhận' ? 'selected' : '' ?> class="bg-card text-foreground">Chờ xác nhận</option>
          <option value="Đã chốt cọc 30%" <?= ($statusFilter ?? '') === 'Đã chốt cọc 30%' ? 'selected' : '' ?> class="bg-card text-foreground">Đã chốt cọc 30%</option>
          <option value="Hoàn thành" <?= ($statusFilter ?? '') === 'Hoàn thành' ? 'selected' : '' ?> class="bg-card text-foreground">Hoàn thành</option>
          <option value="Đã hủy" <?= ($statusFilter ?? '') === 'Đã hủy' ? 'selected' : '' ?> class="bg-card text-foreground">Đã hủy</option>
        </select>

        <?php
          $formattedDateDisplay = '';
          if (!empty($dateFilter)) {
              if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $dateFilter, $m)) {
                  $formattedDateDisplay = "{$m[3]}/{$m[2]}/{$m[1]}";
              } else {
                  $formattedDateDisplay = $dateFilter;
              }
          }
        ?>
        <div class="relative flex items-center">
          <label for="filterDatePicker" class="sr-only">Lọc theo ngày tiệc</label>
          <input type="text" id="filterDatePicker" name="date" aria-label="Lọc theo ngày tiệc" placeholder="dd/mm/yyyy" value="<?= htmlspecialchars($formattedDateDisplay) ?>" class="input-elegant px-3.5 py-2 rounded-sm text-xs cursor-pointer w-36 font-mono">
        </div>
      </form>

      <?php if (!empty($statusFilter) || !empty($dateFilter)): ?>
        <a href="<?= admin_url('bookings') ?>" class="px-3 py-2 rounded-sm bg-rose-500/15 text-rose-400 border border-rose-500/30 hover:bg-rose-500/25 transition-colors text-xs font-medium inline-flex items-center gap-1.5" title="Xóa tất cả bộ lọc">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-3.5 h-3.5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
          <span>Xóa lọc</span>
        </a>
      <?php endif; ?>
    </div>

    <!-- Right: Action Buttons -->
    <div class="flex flex-wrap items-center gap-3">
      <!-- Full Resync to Google Sheets Button -->
      <form action="<?= admin_url('bookings/resync-all-sheets') ?>" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc muốn làm sạch dữ liệu cũ trên Google Sheets và tống toàn bộ dữ liệu Đặt tiệc hiện tại sang?');">
        <button type="submit" class="px-3.5 py-2 rounded-sm bg-amber-500/15 text-[var(--gold)] hover:bg-amber-500/25 transition-colors text-xs font-medium inline-flex items-center gap-1.5 shadow-sm" style="border: 1px solid rgba(212, 175, 55, 0.4);" title="Làm sạch dữ liệu cũ & tống toàn bộ đơn tiệc sang Google Sheets">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sheet"><rect width="18" height="18" x="3" y="3" rx="2"></rect><line x1="3" x2="21" y1="9" y2="9"></line><line x1="3" x2="21" y1="15" y2="15"></line><line x1="9" x2="9" y1="3" y2="21"></line><line x1="15" x2="15" y1="3" y2="21"></line></svg>
          <span>Đồng bộ toàn bộ sang Google Sheets</span>
        </button>
      </form>

      <!-- CSKH Manual Entry Button -->
      <button type="button" onclick="openManualCreateModal()" class="btn-wine inline-flex items-center gap-2 px-3.5 py-2 rounded-sm text-xs uppercase tracking-wider font-semibold shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-circle w-4 h-4"><circle cx="12" cy="12" r="10"></circle><path d="M12 8v8"></path><path d="M8 12h8"></path></svg>
        <span>Thêm đơn nhập tay</span>
      </button>

      <?php if (($user['role'] ?? '') === 'admin'): ?>
        <a href="<?= admin_url('trash') ?>?type=bookings" class="px-3 py-2 rounded-sm bg-rose-500/10 text-rose-400 border border-rose-500/30 hover:bg-rose-500/20 transition-colors text-xs font-medium inline-flex items-center gap-1.5" title="Xem thùng rác đơn đặt tiệc">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-3.5 h-3.5"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
          <span>Thùng rác</span>
        </a>
      <?php endif; ?>
    </div>
  </div>

  <!-- Bulk Action Bar -->
  <div id="bulkBookingBar" class="hidden items-center justify-between p-3.5 rounded-sm shadow-md mb-4" style="border: 1px solid rgba(178, 2, 37, 0.35);">
    <div class="flex items-center gap-2 text-xs text-foreground font-medium">
      <span class="w-2 h-2 rounded-full bg-[var(--gold)] animate-pulse"></span>
      <span>Đã chọn <strong id="bulkBookingCount" class="text-[var(--gold)] font-mono font-bold">0</strong> đơn tiệc</span>
    </div>
    <?php if (($user['role'] ?? '') === 'admin'): ?>
      <button type="button" onclick="submitBulkBookingDelete()" class="px-3 py-1.5 rounded text-xs font-medium bg-rose-500/15 text-rose-400 border border-rose-500/30 hover:bg-rose-500/25 transition-colors flex items-center gap-1.5">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
        <span>Chuyển vào Thùng rác</span>
      </button>
    <?php endif; ?>
  </div>

  <!-- Bookings Data Table Form -->
  <form id="bulkBookingForm" method="POST" action="<?= admin_url('bookings/bulk-delete') ?>">
    <div class="rounded-sm border border-border/40 bg-card overflow-hidden shadow-sm">
      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm border-collapse">
          <thead>
            <tr class="bg-muted/40 text-[11px] uppercase tracking-wider text-muted-foreground border-b border-border/40 whitespace-nowrap">
              <th class="p-4 w-10 text-center">
                <input type="checkbox" id="selectAllBookings" onchange="toggleSelectAllBookings(this)" class="rounded border-border cursor-pointer">
              </th>
              <th class="p-4 w-28">Mã Lead</th>
              <th class="p-4 min-w-[170px]">Khách hàng</th>
              <th class="p-4 min-w-[190px]">Số ĐT / Email</th>
              <th class="p-4 w-24 text-center">Số khách</th>
              <th class="p-4 min-w-[150px]">Ngày tiệc / Ca</th>
              <th class="p-4 w-36">Trạng thái cọc</th>
              <th class="p-4 w-36">Ngày tạo</th>
              <th class="p-4 w-36 text-right">Thao tác</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-border/40">
            <?php if (empty($bookings)): ?>
              <tr>
                <td colspan="9" class="p-8 text-center text-muted-foreground text-sm">
                  Chưa có đơn đặt tiệc nào phù hợp với bộ lọc.
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
                  <td class="p-4 text-center">
                    <input type="checkbox" name="ids[]" value="<?= $b['id'] ?>" class="booking-cb rounded border-border cursor-pointer" onchange="updateBulkBookingBar()">
                  </td>
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
                <td class="p-4 font-semibold tabular-nums text-foreground text-center whitespace-nowrap"><?= (int)$b['participants'] ?> người</td>
                <td class="p-4 text-xs whitespace-nowrap">
                  <div class="font-medium text-foreground font-mono"><?= date('d/m/Y', strtotime($b['booking_date'])) ?></div>
                  <div class="text-muted-foreground"><?= htmlspecialchars($b['time_slot']) ?></div>
                </td>
                <td class="p-4 whitespace-nowrap">
                  <span class="inline-block text-[11px] font-medium px-2.5 py-1 rounded-full border <?= $badgeClass ?>">
                    <?= htmlspecialchars($status) ?>
                  </span>
                </td>
                <td class="p-4 text-xs text-muted-foreground font-mono whitespace-nowrap">
                  <?= !empty($b['created_at']) ? date('d/m/Y H:i', strtotime($b['created_at'])) : '—' ?>
                </td>
                <td class="p-4 text-right whitespace-nowrap">
                  <!-- Quick Edit Status Modal Trigger -->
                  <button type="button" onclick="openEditBookingModal(<?= htmlspecialchars(json_encode($b), ENT_QUOTES, 'UTF-8') ?>)" class="px-3 py-1.5 rounded-sm bg-muted text-xs text-foreground hover:bg-[var(--wine)] hover:text-white transition-colors">
                    Cập nhật
                  </button>

                  <!-- Soft Delete Button (Admin Only) -->
                  <?php if (($user['role'] ?? '') === 'admin'): ?>
                    <button type="button" onclick="submitSingleBookingDelete(<?= $b['id'] ?>)" class="px-3 py-1.5 rounded-sm bg-rose-500/10 text-xs text-rose-400 border border-rose-500/20 hover:bg-rose-500/20 transition-colors" title="Xóa tạm">
                      Xóa
                    </button>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</form>
</div>

<!-- Manual Create Booking Modal (CSKH Hotline Entry) -->
<div id="manualCreateBookingModal" class="modal-overlay">
  <div class="relative w-full max-w-lg bg-card border border-border/40 rounded-sm p-6 sm:p-8 shadow-2xl animate-scale-in my-auto">
    <button onclick="closeManualCreateModal()" type="button" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>

    <h3 class="font-heading text-xl text-foreground mb-1">Tạo Đơn tiệc Nhập tay (CSKH)</h3>
    <p class="text-xs text-muted-foreground mb-4">Tiếp nhận thông tin khách gọi qua Hotline / Zalo</p>

    <form action="<?= admin_url('bookings/manual-create') ?>" method="POST" class="space-y-4">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="manualFullName" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Họ và tên khách *</label>
          <input type="text" id="manualFullName" name="full_name" required autocomplete="name" placeholder="Nguyễn Văn A" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
        </div>

        <div>
          <label for="manualPhone" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Số điện thoại *</label>
          <input type="tel" id="manualPhone" name="phone" required autocomplete="tel" placeholder="0912345678" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm font-mono">
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="manualEmail" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Email liên hệ</label>
          <input type="email" id="manualEmail" name="email" autocomplete="email" placeholder="khach@gmail.com" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
        </div>

        <div>
          <label for="manualParticipants" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Số khách (Trần 24) *</label>
          <input type="number" id="manualParticipants" name="participants" autocomplete="off" min="1" max="24" required value="4" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm font-semibold">
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="manualBookingDatePicker" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Ngày tiệc (Đặt trước &ge; 5 ngày) *</label>
          <input type="text" id="manualBookingDatePicker" name="booking_date" required autocomplete="off" placeholder="dd/mm/yyyy" value="<?= date('d/m/Y', strtotime('+5 days')) ?>" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm font-mono cursor-pointer">
        </div>

        <div>
          <label for="manualTimeSlot" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Ca tiệc *</label>
          <select id="manualTimeSlot" name="time_slot" required autocomplete="off" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
            <option value="Ca 1 (11h00 – 14h00)" class="bg-card text-foreground">Ca 1 (11h00 – 14h00)</option>
            <option value="Ca 2 (18h00 – 21h00)" class="bg-card text-foreground">Ca 2 (18h00 – 21h00)</option>
          </select>
        </div>
      </div>

      <div>
        <label for="manualDepositStatus" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Trạng thái cọc ban đầu</label>
        <select id="manualDepositStatus" name="deposit_status" autocomplete="off" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
          <option value="Chờ xác nhận" class="bg-card text-foreground">Chờ xác nhận</option>
          <option value="Đã chốt cọc 30%" class="bg-card text-foreground">Đã chốt cọc 30%</option>
          <option value="Hoàn thành" class="bg-card text-foreground">Hoàn thành</option>
        </select>
      </div>

      <div>
        <label for="manualNotes" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Ghi chú yêu cầu của khách</label>
        <textarea id="manualNotes" name="notes" rows="2" autocomplete="off" placeholder="Ví dụ: Gọi điện lúc 15h chốt thực đơn Signature Pairing" class="input-elegant w-full p-2.5 rounded-sm text-sm"></textarea>
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

    <form action="<?= admin_url('bookings/update') ?>" method="POST" class="space-y-4">
      <input type="hidden" id="modalBookingId" name="id" value="">

      <div>
        <label for="modalStatusSelect" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Trạng thái tiền cọc (Master Data)</label>
        <select id="modalStatusSelect" name="deposit_status" autocomplete="off" class="input-elegant w-full px-4 py-3 rounded-sm text-sm">
          <option value="Chờ xác nhận" class="bg-card text-foreground">Chờ xác nhận</option>
          <option value="Đã chốt cọc 30%" class="bg-card text-foreground">Đã chốt cọc 30%</option>
          <option value="Hoàn thành" class="bg-card text-foreground">Hoàn thành</option>
          <option value="Đã hủy" class="bg-card text-foreground">Đã hủy</option>
        </select>
      </div>

      <div>
        <label for="modalNotesText" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Ghi chú CSKH</label>
        <textarea id="modalNotesText" name="notes" rows="3" autocomplete="off" placeholder="Ví dụ: Đã nhận cọc 30% qua QR VNPay 1.500.000đ" class="input-elegant w-full p-3 rounded-sm text-sm"></textarea>
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

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  if (typeof flatpickr !== 'undefined') {
    if (flatpickr.l10ns && flatpickr.l10ns.vn) {
      flatpickr.localize(flatpickr.l10ns.vn);
    }

    // Filter date picker: visual dropdown calendar + strict dd/mm/yyyy display
    flatpickr('#filterDatePicker', {
      disableMobile: true,
      dateFormat: 'd/m/Y',
      allowInput: true,
      monthSelectorType: 'dropdown',
      onReady: function(selectedDates, dateStr, instance) {
        var container = instance.calendarContainer;
        if (container) {
          var yearInput = container.querySelector('.numInput.cur-year');
          if (yearInput) {
            if (!yearInput.getAttribute('id')) yearInput.setAttribute('id', 'adminFpYearFilter_' + Math.random().toString(36).substr(2, 5));
            if (!yearInput.getAttribute('name')) yearInput.setAttribute('name', 'admin_flatpickr_year_filter');
            yearInput.setAttribute('aria-label', 'Chọn năm');
          }
          var monthSelect = container.querySelector('.flatpickr-monthDropdown-months');
          if (monthSelect) {
            if (!monthSelect.getAttribute('id')) monthSelect.setAttribute('id', 'adminFpMonthFilter_' + Math.random().toString(36).substr(2, 5));
            if (!monthSelect.getAttribute('name')) monthSelect.setAttribute('name', 'admin_flatpickr_month_filter');
            monthSelect.setAttribute('aria-label', 'Chọn tháng');
          }
        }
      },
      onClose: function(selectedDates, dateStr, instance) {
        if (dateStr) {
          document.getElementById('bookingFilterForm').submit();
        }
      }
    });

    // Manual Create date picker: 5 days constraint + strict dd/mm/yyyy display
    var today = new Date();
    var maxDate = new Date();
    maxDate.setDate(today.getDate() + 5);

    flatpickr('#manualBookingDatePicker', {
      disableMobile: true,
      dateFormat: 'd/m/Y',
      minDate: 'today',
      maxDate: maxDate,
      allowInput: true,
      monthSelectorType: 'dropdown',
      defaultDate: 'today',
      onReady: function(selectedDates, dateStr, instance) {
        var container = instance.calendarContainer;
        if (container) {
          var yearInput = container.querySelector('.numInput.cur-year');
          if (yearInput) {
            if (!yearInput.getAttribute('id')) yearInput.setAttribute('id', 'adminFpYearManual_' + Math.random().toString(36).substr(2, 5));
            if (!yearInput.getAttribute('name')) yearInput.setAttribute('name', 'admin_flatpickr_year_manual');
            yearInput.setAttribute('aria-label', 'Chọn năm');
          }
          var monthSelect = container.querySelector('.flatpickr-monthDropdown-months');
          if (monthSelect) {
            if (!monthSelect.getAttribute('id')) monthSelect.setAttribute('id', 'adminFpMonthManual_' + Math.random().toString(36).substr(2, 5));
            if (!monthSelect.getAttribute('name')) monthSelect.setAttribute('name', 'admin_flatpickr_month_manual');
            monthSelect.setAttribute('aria-label', 'Chọn tháng');
          }
        }
      }
    });
  }
});

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

function toggleSelectAllBookings(master) {
  const checkboxes = document.querySelectorAll('.booking-cb');
  checkboxes.forEach(cb => cb.checked = master.checked);
  updateBulkBookingBar();
}

function updateBulkBookingBar() {
  const checked = document.querySelectorAll('.booking-cb:checked');
  const all = document.querySelectorAll('.booking-cb');
  const bar = document.getElementById('bulkBookingBar');
  const countEl = document.getElementById('bulkBookingCount');
  const syncCountEl = document.getElementById('bulkBookingSyncCount');
  const master = document.getElementById('selectAllBookings');

  if (countEl) countEl.textContent = checked.length;
  if (syncCountEl) syncCountEl.textContent = checked.length;
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

function submitBulkBookingDelete() {
  const checked = document.querySelectorAll('.booking-cb:checked');
  if (checked.length === 0) {
    alert('Vui lòng chọn ít nhất 1 đơn tiệc để xóa.');
    return;
  }
  if (confirm(`Bạn có chắc chắn muốn chuyển ${checked.length} đơn tiệc đã chọn vào Thùng rác?`)) {
    const form = document.getElementById('bulkBookingForm');
    form.action = '<?= admin_url('bookings/bulk-delete') ?>';
    form.submit();
  }
}

function submitBulkBookingSync() {
  const checked = document.querySelectorAll('.booking-cb:checked');
  if (checked.length === 0) {
    alert('Vui lòng chọn ít nhất 1 đơn tiệc để đồng bộ Google Sheets.');
    return;
  }
  const form = document.getElementById('bulkBookingForm');
  form.action = '<?= admin_url('bookings/bulk-sync-sheets') ?>';
  form.submit();
}

function submitSingleBookingSync(id) {
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = '<?= admin_url('bookings/sync') ?>';
  const input = document.createElement('input');
  input.type = 'hidden';
  input.name = 'id';
  input.value = id;
  form.appendChild(input);
  document.body.appendChild(form);
  form.submit();
}

function submitSingleBookingDelete(id) {
  if (!confirm('Bạn có chắc muốn chuyển đơn tiệc này vào Thùng rác?')) return;
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = '<?= admin_url('bookings/delete') ?>';
  const input = document.createElement('input');
  input.type = 'hidden';
  input.name = 'id';
  input.value = id;
  form.appendChild(input);
  document.body.appendChild(form);
  form.submit();
}
</script>

<?php
$adminContent = ob_get_clean();
require __DIR__ . '/../_layout/admin_master.php';
?>
