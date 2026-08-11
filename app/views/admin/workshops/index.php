<?php
$title = 'Quản lý Workshop & Khóa học — Admin CMS Amis Duvin';
$activeNav = 'workshops';
ob_start();
?>

<div class="space-y-6">
  <!-- Top Navigation Header -->
  <div class="border-b border-[var(--gold)]/20 pb-4">
    <h2 class="font-heading-editorial text-2xl sm:text-3xl text-foreground font-bold tracking-wide">Quản lý Workshop &amp; Lịch Trải nghiệm</h2>
    <p class="font-body-modern text-sm text-muted-foreground mt-1">Quản lý danh sách khách hàng đăng ký trải nghiệm Workshop.</p>
  </div>

  <!-- REGISTRATIONS MANAGEMENT -->
  <div class="space-y-4">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
      <!-- Filters Bar -->
      <form id="wsRegFilterForm" method="GET" action="<?= admin_url('workshops') ?>" class="flex flex-wrap items-center gap-3">
        <input type="hidden" name="tab" value="registrations">

        <div>
          <label class="sr-only">Lọc Workshop</label>
          <select name="workshop_id" onchange="this.form.submit()" class="input-elegant px-3.5 py-2 rounded-sm text-xs cursor-pointer">
            <option value="" class="bg-card text-foreground">Tất cả các Workshop</option>
            <?php foreach ($workshops as $w): ?>
              <option value="<?= $w['id'] ?>" <?= (string)$workshopFilter === (string)$w['id'] ? 'selected' : '' ?> class="bg-card text-foreground">
                <?= htmlspecialchars($w['title']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div>
          <label class="sr-only">Lọc Trạng thái</label>
          <select name="status" onchange="this.form.submit()" class="input-elegant px-3.5 py-2 rounded-sm text-xs cursor-pointer">
            <option value="" class="bg-card text-foreground">Tất cả trạng thái</option>
            <option value="pending" <?= $statusFilter === 'pending' ? 'selected' : '' ?> class="bg-card text-foreground">Chờ xác nhận</option>
            <option value="confirmed" <?= $statusFilter === 'confirmed' ? 'selected' : '' ?> class="bg-card text-foreground">Đã chốt vé / Đã cọc</option>
            <option value="cancelled" <?= $statusFilter === 'cancelled' ? 'selected' : '' ?> class="bg-card text-foreground">Đã hủy</option>
          </select>
        </div>

        <?php
          $formattedWsDateDisplay = '';
          if (!empty($dateFilter)) {
              if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $dateFilter, $m)) {
                  $formattedWsDateDisplay = "{$m[3]}/{$m[2]}/{$m[1]}";
              } else {
                  $formattedWsDateDisplay = $dateFilter;
              }
          }
        ?>
        <div class="relative flex items-center">
          <label for="filterWsDatePicker" class="sr-only">Lọc theo ngày tạo</label>
          <input type="text" id="filterWsDatePicker" name="date" aria-label="Lọc theo ngày tạo" placeholder="dd/mm/yyyy" value="<?= htmlspecialchars($formattedWsDateDisplay) ?>" class="input-elegant px-3.5 py-2 rounded-sm text-xs cursor-pointer w-36 font-mono">
        </div>

        <?php if ($statusFilter || $workshopFilter || !empty($dateFilter)): ?>
          <a href="<?= admin_url('workshops') ?>?tab=registrations" class="px-3 py-2 rounded-sm bg-rose-500/15 text-rose-400 border border-rose-500/30 hover:bg-rose-500/25 transition-colors text-xs font-medium inline-flex items-center gap-1.5" title="Xóa tất cả bộ lọc">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-3.5 h-3.5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
            <span>Xóa lọc</span>
          </a>
        <?php endif; ?>
      </form>

      <div class="flex flex-wrap items-center gap-3">
        <!-- Full Resync to Google Sheets Button -->
        <form action="<?= admin_url('workshops/registration/resync-all-sheets') ?>" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc muốn làm sạch dữ liệu cũ trên Google Sheets và tống toàn bộ dữ liệu Đăng ký Workshop hiện tại sang?');">
          <button type="submit" class="px-3.5 py-2 rounded-sm bg-amber-500/15 text-[var(--gold)] hover:bg-amber-500/25 transition-colors text-xs font-medium inline-flex items-center gap-1.5 shadow-sm" style="border: 1px solid rgba(212, 175, 55, 0.4);" title="Làm sạch dữ liệu cũ & tống toàn bộ đăng ký Workshop sang Google Sheets">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sheet"><rect width="18" height="18" x="3" y="3" rx="2"></rect><line x1="3" x2="21" y1="9" y2="9"></line><line x1="3" x2="21" y1="15" y2="15"></line><line x1="9" x2="9" y1="3" y2="21"></line><line x1="15" x2="15" y1="3" y2="21"></line></svg>
            <span>Đồng bộ toàn bộ sang Google Sheets</span>
          </button>
        </form>

        <button type="button" onclick="openManualRegModal()" class="btn-wine px-3.5 py-2 rounded-sm text-xs uppercase tracking-wider font-semibold flex items-center gap-1.5 shadow-sm">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-circle w-4 h-4"><circle cx="12" cy="12" r="10"></circle><path d="M12 8v8"></path><path d="M8 12h8"></path></svg>
          <span>Nhập tay đăng ký</span>
        </button>

        <?php if (($user['role'] ?? '') === 'admin'): ?>
          <a href="<?= admin_url('trash') ?>?type=workshops" class="px-3 py-2 rounded-sm bg-rose-500/10 text-rose-400 border border-rose-500/30 hover:bg-rose-500/20 transition-colors text-xs font-medium inline-flex items-center gap-1.5" title="Xem thùng rác đăng ký workshop">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-3.5 h-3.5"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
            <span>Thùng rác</span>
          </a>
        <?php endif; ?>
      </div>
    </div>

    <!-- Bulk Action Bar -->
    <div id="bulkWsRegBar" class="hidden items-center justify-between p-3.5 rounded-sm shadow-md mb-4" style="border: 1px solid rgba(178, 2, 37, 0.35);">
      <div class="flex items-center gap-2 text-xs text-foreground font-medium">
        <span class="w-2 h-2 rounded-full bg-[var(--gold)] animate-pulse"></span>
        <span>Đã chọn <strong id="bulkWsRegCount" class="text-[var(--gold)] font-mono font-bold">0</strong> đăng ký</span>
      </div>
      <?php if (($user['role'] ?? '') === 'admin'): ?>
        <button type="button" onclick="submitBulkWsRegDelete()" class="px-3 py-1.5 rounded text-xs font-medium bg-rose-500/15 text-rose-400 border border-rose-500/30 hover:bg-rose-500/25 transition-colors flex items-center gap-1.5">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
          <span>Chuyển vào Thùng rác</span>
        </button>
      <?php endif; ?>
    </div>

      <!-- Registrations Data Table Form -->
      <form id="bulkWsRegForm" method="POST" action="<?= admin_url('workshops/registration/bulk-delete') ?>">
        <div class="rounded-sm border border-border/40 bg-card overflow-hidden shadow-sm">
          <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
              <thead>
                <tr class="bg-muted/40 text-[11px] uppercase tracking-wider text-muted-foreground border-b border-border/40 whitespace-nowrap">
                  <th class="p-4 w-10 text-center">
                    <input type="checkbox" id="selectAllWsReg" onchange="toggleSelectAllWsReg(this)" class="rounded border-border cursor-pointer">
                  </th>
                  <th class="p-4 w-28">Mã Đơn</th>
                  <th class="p-4 min-w-[170px]">Khách hàng</th>
                  <th class="p-4 min-w-[190px]">Số ĐT / Email</th>
                  <th class="p-4 min-w-[170px]">Tên Workshop</th>
                  <th class="p-4 w-24 text-center">Số vé</th>
                  <th class="p-4 w-36">Trạng thái</th>
                  <th class="p-4 w-36">Ngày tạo</th>
                  <th class="p-4 w-36 text-right">Thao tác</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-border/40">
                <?php if (empty($registrations)): ?>
                  <tr>
                    <td colspan="9" class="p-8 text-center text-muted-foreground text-sm">
                      Chưa có đăng ký Workshop nào phù hợp với bộ lọc.
                    </td>
                  </tr>
                <?php else: ?>
                  <?php foreach ($registrations as $r): ?>
                    <?php
                      $regCode = 'WS-' . str_pad((string)$r['id'], 4, '0', STR_PAD_LEFT);
                      $status = $r['status'] ?? 'pending';
                      $badgeClass = match($status) {
                        'confirmed' => 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30',
                        'cancelled' => 'bg-rose-500/15 text-rose-400 border-rose-500/30',
                        default => 'bg-[var(--gold)]/15 text-[var(--gold)] border-[var(--gold)]/30'
                      };
                      $statusText = match($status) {
                        'confirmed' => 'Đã chốt vé',
                        'cancelled' => 'Đã hủy',
                        default => 'Chờ CSKH xác nhận'
                      };
                    ?>
                    <tr class="hover:bg-muted/20 transition-colors">
                      <td class="p-4 text-center">
                        <input type="checkbox" name="ids[]" value="<?= $r['id'] ?>" class="ws-reg-cb rounded border-border cursor-pointer" onchange="updateBulkWsRegBar()">
                      </td>
                      <td class="p-4 font-mono text-xs font-semibold text-[var(--gold)]"><?= $regCode ?></td>
                    <td class="p-4 font-medium text-foreground">
                      <div><?= htmlspecialchars($r['full_name']) ?></div>
                      <?php if (!empty($r['notes'])): ?>
                        <div class="text-[11px] text-muted-foreground/80 truncate max-w-xs" title="<?= htmlspecialchars($r['notes']) ?>"><?= htmlspecialchars($r['notes']) ?></div>
                      <?php endif; ?>
                    </td>
                    <td class="p-4 font-mono text-xs text-muted-foreground">
                      <div><?= htmlspecialchars($r['phone']) ?></div>
                      <div class="text-[11px] text-muted-foreground/75"><?= htmlspecialchars($r['email']) ?></div>
                    </td>
                    <td class="p-4 font-medium text-foreground">
                      <?= htmlspecialchars($r['workshop_title'] ?? 'Workshop #' . $r['workshop_id']) ?>
                    </td>
                    <td class="p-4 font-mono text-xs text-foreground font-semibold text-center whitespace-nowrap">
                      <?= (int)$r['participants'] ?> vé
                    </td>
                    <td class="p-4 whitespace-nowrap">
                      <span class="inline-block px-2.5 py-1 rounded-full text-[10px] uppercase font-mono tracking-wider font-semibold border <?= $badgeClass ?>">
                        <?= $statusText ?>
                      </span>
                    </td>
                    <td class="p-4 text-xs text-muted-foreground font-mono whitespace-nowrap">
                      <?= !empty($r['created_at']) ? date('d/m/Y H:i', strtotime($r['created_at'])) : '—' ?>
                    </td>
                    <td class="p-4 text-right whitespace-nowrap">
                      <div class="inline-flex items-center gap-1.5 justify-end">
                        <button type="button" onclick='openEditRegModal(<?= json_encode($r, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)' class="px-2.5 py-1 rounded text-xs font-medium bg-muted hover:bg-muted/80 text-foreground transition-colors">
                          Đổi trạng thái
                        </button>
                        <?php if (($user['role'] ?? '') === 'admin'): ?>
                          <button type="button" onclick="submitSingleWsRegDelete(<?= $r['id'] ?>)" class="px-2.5 py-1 rounded text-xs font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20 hover:bg-rose-500/20 transition-colors" title="Xóa tạm">
                            Xóa
                          </button>
                        <?php endif; ?>
                      </div>
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
</div>

<!-- Modal 1: Nhập tay Đăng ký Workshop (CSKH) -->
<div id="manualRegModal" class="modal-overlay">
  <div class="modal-content max-w-lg">
    <div class="flex items-center justify-between mb-4 pb-3 border-b border-border/40">
      <h3 class="font-heading text-lg text-foreground">Nhập tay Đăng ký Workshop (Hotline)</h3>
      <button type="button" onclick="closeManualRegModal()" class="text-muted-foreground hover:text-foreground">✕</button>
    </div>

    <form action="<?= admin_url('workshops/registration/manual-create') ?>" method="POST" class="space-y-4">
      <div>
        <label class="block text-xs font-medium mb-1">Chọn Workshop *</label>
        <select name="workshop_id" required class="input-elegant w-full px-3 py-2 rounded text-xs">
          <?php foreach ($workshops as $w): ?>
            <option value="<?= $w['id'] ?>" class="bg-card text-foreground"><?= htmlspecialchars($w['title']) ?> (<?= number_format($w['price']) ?>đ)</option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-xs font-medium mb-1">Họ tên khách *</label>
          <input type="text" name="full_name" required autocomplete="name" class="input-elegant w-full px-3 py-2 rounded text-xs">
        </div>
        <div>
          <label class="block text-xs font-medium mb-1">Số điện thoại *</label>
          <input type="tel" name="phone" required autocomplete="tel" placeholder="090..." class="input-elegant w-full px-3 py-2 rounded text-xs">
        </div>
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-xs font-medium mb-1">Email</label>
          <input type="email" name="email" autocomplete="email" class="input-elegant w-full px-3 py-2 rounded text-xs">
        </div>
        <div>
          <label class="block text-xs font-medium mb-1">Số lượng vé *</label>
          <input type="number" name="participants" value="1" min="1" max="20" required class="input-elegant w-full px-3 py-2 rounded text-xs">
        </div>
      </div>

      <div>
        <label class="block text-xs font-medium mb-1">Ghi chú (CSKH)</label>
        <textarea name="notes" rows="2" placeholder="Ghi chú chuyển khoản / hẹn chốt vé..." class="input-elegant w-full px-3 py-2 rounded text-xs"></textarea>
      </div>

      <div class="pt-2 flex justify-end gap-2">
        <button type="button" onclick="closeManualRegModal()" class="px-4 py-2 rounded text-xs bg-muted text-foreground">Hủy</button>
        <button type="submit" class="btn-wine px-5 py-2 rounded text-xs font-semibold">Tạo đăng ký</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal 2: Đổi trạng thái Đăng ký Workshop -->
<div id="editRegModal" class="modal-overlay">
  <div class="modal-content max-w-md">
    <div class="flex items-center justify-between mb-4 pb-3 border-b border-border/40">
      <h3 class="font-heading text-lg text-foreground">Cập nhật Đăng ký <span id="regCodeLabel" class="text-[var(--gold)] font-mono"></span></h3>
      <button type="button" onclick="closeEditRegModal()" class="text-muted-foreground hover:text-foreground">✕</button>
    </div>

    <form action="<?= admin_url('workshops/registration/update') ?>" method="POST" class="space-y-4">
      <input type="hidden" id="editRegId" name="id">

      <div>
        <label class="block text-xs font-medium mb-1">Trạng thái đăng ký</label>
        <select id="editRegStatus" name="status" class="input-elegant w-full px-3 py-2 rounded text-xs">
          <option value="pending" class="bg-card text-foreground">Chờ xác nhận</option>
          <option value="confirmed" class="bg-card text-foreground">Đã chốt vé / Đã cọc</option>
          <option value="cancelled" class="bg-card text-foreground">Đã hủy</option>
        </select>
      </div>

      <div>
        <label class="block text-xs font-medium mb-1">Ghi chú xử lý</label>
        <textarea id="editRegNotes" name="notes" rows="3" class="input-elegant w-full px-3 py-2 rounded text-xs"></textarea>
      </div>

      <div class="pt-2 flex justify-end gap-2">
        <button type="button" onclick="closeEditRegModal()" class="px-4 py-2 rounded text-xs bg-muted text-foreground">Hủy</button>
        <button type="submit" class="btn-wine px-5 py-2 rounded text-xs font-semibold">Cập nhật</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal 3: Tạo/Sửa Gói Workshop (Admin) -->
<div id="workshopPackageModal" class="modal-overlay">
  <div class="modal-content max-w-xl">
    <div class="flex items-center justify-between mb-4 pb-3 border-b border-border/40">
      <h3 id="workshopPackageModalTitle" class="font-heading text-lg text-foreground">Biên tập Gói Workshop</h3>
      <button type="button" onclick="closeWorkshopPackageModal()" class="text-muted-foreground hover:text-foreground">✕</button>
    </div>

    <form id="workshopPackageForm" action="<?= admin_url('workshops/create') ?>" method="POST" class="space-y-4">
      <input type="hidden" id="wpId" name="id">

      <div>
        <label class="block text-xs font-medium mb-1">Tên Workshop *</label>
        <input type="text" id="wpTitle" name="title" required class="input-elegant w-full px-3 py-2 rounded text-xs">
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-xs font-medium mb-1">Cấp độ (Level)</label>
          <input type="text" id="wpLevel" name="level" placeholder="VD: Standard Level" class="input-elegant w-full px-3 py-2 rounded text-xs">
        </div>
        <div>
          <label class="block text-xs font-medium mb-1">Giá vé (VNĐ) *</label>
          <input type="number" id="wpPrice" name="price" required step="10000" class="input-elegant w-full px-3 py-2 rounded text-xs">
        </div>
      </div>

      <div class="grid grid-cols-3 gap-3">
        <div>
          <label class="block text-xs font-medium mb-1">Thời lượng</label>
          <input type="text" id="wpDuration" name="duration" placeholder="2.5 giờ" class="input-elegant w-full px-3 py-2 rounded text-xs">
        </div>
        <div>
          <label class="block text-xs font-medium mb-1">Số dòng vang</label>
          <input type="number" id="wpWinesCount" name="wines_count" value="5" class="input-elegant w-full px-3 py-2 rounded text-xs">
        </div>
        <div>
          <label class="block text-xs font-medium mb-1">Số chỗ tối đa</label>
          <input type="number" id="wpMaxParticipants" name="max_participants" value="12" class="input-elegant w-full px-3 py-2 rounded text-xs">
        </div>
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-xs font-medium mb-1">Lịch học / Thời gian</label>
          <input type="text" id="wpSchedule" name="schedule" placeholder="Thứ Bảy hàng tuần, 15h00" class="input-elegant w-full px-3 py-2 rounded text-xs">
        </div>
        <div>
          <label class="block text-xs font-medium mb-1">Địa điểm</label>
          <input type="text" id="wpLocation" name="location" placeholder="Hầm rượu Amis Duvin" class="input-elegant w-full px-3 py-2 rounded text-xs">
        </div>
      </div>

      <div>
        <label for="wpImage" class="block text-xs font-medium mb-1">Ảnh bìa Workshop</label>
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 rounded border border-border/60 bg-muted/30 overflow-hidden shrink-0 flex items-center justify-center relative">
            <img id="preview_wpImage" src="" onclick="openAdminImageLightbox(this.src)" title="Bấm để xem ảnh phóng to" class="w-full h-full object-cover cursor-pointer hover:opacity-80 transition-opacity hidden" alt="Preview">
            <span class="preview-placeholder text-[9px] text-muted-foreground font-mono uppercase text-center px-1">No img</span>
          </div>
          <div class="flex-1 space-y-1.5">
            <input type="text" id="wpImage" name="image" autocomplete="off" placeholder="URL hoặc chọn từ máy..." class="input-elegant w-full px-3.5 py-2 rounded-sm text-xs font-medium" oninput="updateImagePreview(this, 'preview_wpImage')">
            <div class="flex items-center gap-2">
              <label class="px-2.5 py-1 rounded bg-muted hover:bg-muted/80 border border-border/50 text-[11px] text-foreground font-medium cursor-pointer inline-flex items-center gap-1.5 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>
                <span>Tải ảnh từ máy</span>
                <input type="file" accept="image/*" class="sr-only" onchange="handleAdminImageUpload(this, 'wpImage', 'preview_wpImage')">
              </label>
              <span class="upload-status text-[11px] text-muted-foreground italic"></span>
            </div>
          </div>
        </div>
      </div>

      <div>
        <label class="block text-xs font-medium mb-1">Mô tả ngắn</label>
        <textarea id="wpDescription" name="description" rows="3" class="input-elegant w-full px-3 py-2 rounded text-xs"></textarea>
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-xs font-medium mb-1">Trạng thái mở</label>
          <select id="wpStatus" name="status" class="input-elegant w-full px-3 py-2 rounded text-xs">
            <option value="active" class="bg-card text-foreground">Đang mở đăng ký (Active)</option>
            <option value="full" class="bg-card text-foreground">Đã hết chỗ (Full)</option>
            <option value="inactive" class="bg-card text-foreground">Tạm ẩn (Inactive)</option>
          </select>
        </div>
        <div class="flex items-center pt-5">
          <label class="flex items-center gap-2 text-xs font-medium cursor-pointer">
            <input type="checkbox" id="wpIsFeatured" name="is_featured" value="1" class="rounded text-[var(--wine)]">
            <span>Hiển thị làm Workshop Nổi bật</span>
          </label>
        </div>
      </div>

      <div class="pt-2 flex justify-end gap-2">
        <button type="button" onclick="closeWorkshopPackageModal()" class="px-4 py-2 rounded text-xs bg-muted text-foreground">Hủy</button>
        <button type="submit" class="btn-wine px-5 py-2 rounded text-xs font-semibold">Lưu thông tin</button>
      </div>
    </form>
  </div>
</div>

<script>
function openManualRegModal() {
  document.getElementById('manualRegModal').classList.add('active');
}
function closeManualRegModal() {
  document.getElementById('manualRegModal').classList.remove('active');
}

function openEditRegModal(reg) {
  document.getElementById('editRegId').value = reg.id;
  document.getElementById('regCodeLabel').textContent = 'WS-' + String(reg.id).padStart(4, '0');
  document.getElementById('editRegStatus').value = reg.status || 'pending';
  document.getElementById('editRegNotes').value = reg.notes || '';
  document.getElementById('editRegModal').classList.add('active');
}
function closeEditRegModal() {
  document.getElementById('editRegModal').classList.remove('active');
}

function openCreateWorkshopModal() {
  document.getElementById('workshopPackageForm').action = '<?= admin_url('workshops/create') ?>';
  document.getElementById('workshopPackageModalTitle').textContent = 'Tạo Gói Workshop mới';
  document.getElementById('wpId').value = '';
  document.getElementById('wpTitle').value = '';
  document.getElementById('wpLevel').value = 'Standard Level';
  document.getElementById('wpPrice').value = '1500000';
  document.getElementById('wpDuration').value = '2.5 giờ';
  document.getElementById('wpWinesCount').value = '5';
  document.getElementById('wpMaxParticipants').value = '12';
  document.getElementById('wpSchedule').value = 'Thứ 7 hàng tuần (15:00 - 17:30)';
  document.getElementById('wpLocation').value = 'Hầm rượu riêng Amis Duvin';
  document.getElementById('wpImage').value = '';
  document.getElementById('wpDescription').value = '';
  document.getElementById('wpStatus').value = 'active';
  document.getElementById('wpIsFeatured').checked = false;
  updateImagePreview(document.getElementById('wpImage'), 'preview_wpImage');
  document.getElementById('workshopPackageModal').classList.add('active');
}

function openEditWorkshopModal(w) {
  document.getElementById('workshopPackageForm').action = '<?= admin_url('workshops/update') ?>';
  document.getElementById('workshopPackageModalTitle').textContent = 'Sửa Gói Workshop #' + w.id;
  document.getElementById('wpId').value = w.id;
  document.getElementById('wpTitle').value = w.title || '';
  document.getElementById('wpLevel').value = w.level || 'Standard Level';
  document.getElementById('wpPrice').value = w.price || 0;
  document.getElementById('wpDuration').value = w.duration || '';
  document.getElementById('wpWinesCount').value = w.wines_count || 5;
  document.getElementById('wpMaxParticipants').value = w.max_participants || 12;
  document.getElementById('wpSchedule').value = w.schedule || '';
  document.getElementById('wpLocation').value = w.location || '';
  document.getElementById('wpImage').value = w.image || '';
  document.getElementById('wpDescription').value = w.description || '';
  document.getElementById('wpStatus').value = w.status || 'active';
  document.getElementById('wpIsFeatured').checked = w.is_featured == 1;
  updateImagePreview(document.getElementById('wpImage'), 'preview_wpImage');
  document.getElementById('workshopPackageModal').classList.add('active');
}

function closeWorkshopPackageModal() {
  document.getElementById('workshopPackageModal').classList.remove('active');
}

function toggleSelectAllWsReg(master) {
  const checkboxes = document.querySelectorAll('.ws-reg-cb');
  checkboxes.forEach(cb => cb.checked = master.checked);
  updateBulkWsRegBar();
}

function updateBulkWsRegBar() {
  const checked = document.querySelectorAll('.ws-reg-cb:checked');
  const all = document.querySelectorAll('.ws-reg-cb');
  const bar = document.getElementById('bulkWsRegBar');
  const countEl = document.getElementById('bulkWsRegCount');
  const syncCountEl = document.getElementById('bulkWsRegSyncCount');
  const master = document.getElementById('selectAllWsReg');

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

function submitBulkWsRegDelete() {
  const checked = document.querySelectorAll('.ws-reg-cb:checked');
  if (checked.length === 0) {
    alert('Vui lòng chọn ít nhất 1 đăng ký Workshop để xóa.');
    return;
  }
  if (confirm(`Bạn có chắc chắn muốn chuyển ${checked.length} đăng ký Workshop đã chọn vào Thùng rác?`)) {
    const form = document.getElementById('bulkWsRegForm');
    form.action = '<?= admin_url('workshops/registration/bulk-delete') ?>';
    form.submit();
  }
}

function submitBulkWsRegSync() {
  const checked = document.querySelectorAll('.ws-reg-cb:checked');
  if (checked.length === 0) {
    alert('Vui lòng chọn ít nhất 1 đăng ký Workshop để đồng bộ Google Sheets.');
    return;
  }
  const form = document.getElementById('bulkWsRegForm');
  form.action = '<?= admin_url('workshops/registration/bulk-sync-sheets') ?>';
  form.submit();
}

function submitSingleWsRegSync(id) {
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = '<?= admin_url('workshops/registration/sync') ?>';
  const input = document.createElement('input');
  input.type = 'hidden';
  input.name = 'id';
  input.value = id;
  form.appendChild(input);
  document.body.appendChild(form);
  form.submit();
}

function submitSingleWsRegDelete(id) {
  if (!confirm('Bạn có chắc muốn chuyển đăng ký Workshop này vào Thùng rác?')) return;
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = '<?= admin_url('workshops/registration/delete') ?>';
  const input = document.createElement('input');
  input.type = 'hidden';
  input.name = 'id';
  input.value = id;
  form.appendChild(input);
  document.body.appendChild(form);
  form.submit();
}

document.addEventListener('DOMContentLoaded', function() {
  if (typeof flatpickr !== 'undefined') {
    if (flatpickr.l10ns && flatpickr.l10ns.vn) {
      flatpickr.localize(flatpickr.l10ns.vn);
    }
    const filterInput = document.getElementById('filterWsDatePicker');
    if (filterInput) {
      flatpickr(filterInput, {
        disableMobile: true,
        dateFormat: 'd/m/Y',
        allowInput: true,
        monthSelectorType: 'dropdown',
        onReady: function(selectedDates, dateStr, instance) {
          var container = instance.calendarContainer;
          if (container) {
            var yearInput = container.querySelector('.numInput.cur-year');
            if (yearInput) {
              if (!yearInput.getAttribute('id')) yearInput.setAttribute('id', 'adminFpWsYearFilter_' + Math.random().toString(36).substr(2, 5));
              if (!yearInput.getAttribute('name')) yearInput.setAttribute('name', 'admin_flatpickr_ws_year_filter');
              yearInput.setAttribute('aria-label', 'Chọn năm');
            }
            var monthSelect = container.querySelector('.flatpickr-monthDropdown-months');
            if (monthSelect) {
              if (!monthSelect.getAttribute('id')) monthSelect.setAttribute('id', 'adminFpWsMonthFilter_' + Math.random().toString(36).substr(2, 5));
              if (!monthSelect.getAttribute('name')) monthSelect.setAttribute('name', 'admin_flatpickr_ws_month_filter');
              monthSelect.setAttribute('aria-label', 'Chọn tháng');
            }
          }
        },
        onClose: function(selectedDates, dateStr, instance) {
          if (dateStr) {
            document.getElementById('wsRegFilterForm').submit();
          }
        }
      });
    }
  }
});
</script>

<?php
$adminContent = ob_get_clean();
require __DIR__ . '/../_layout/admin_master.php';
