<?php
$todayDate = date('Y-m-d');
$maxBookingDate = date('Y-m-d', strtotime('+5 days'));
?>
<section id="register" class="scroll-anchor relative py-24 sm:py-32 bg-background overflow-hidden">
  <div class="absolute inset-0 bg-wine-radial opacity-70"></div>
  <div class="relative max-w-6xl mx-auto px-5 sm:px-8">
    <div class="reveal is-visible">
      <div class="text-center mb-12">
        <p class="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-4">Đặt tiệc riêng</p>
        <h2 class="font-heading text-3xl sm:text-5xl text-foreground mb-5">Đăng ký đặt tiệc</h2>
        <p class="text-sm text-muted-foreground">Để lại thông tin, bộ phận CSKH Amis du Vin sẽ liên hệ xác nhận trực tiếp qua Điện thoại/Zalo.</p>
      </div>
    </div>
    <div class="grid lg:grid-cols-5 gap-8 lg:gap-10 items-start">
      <!-- Left Column: Booking Form -->
      <div class="reveal is-visible lg:col-span-3">
        <form id="bookingForm" class="bg-card border border-border rounded-sm p-7 sm:p-9 shadow-[0_20px_60px_-30px_rgba(33,30,25,0.25)]" novalidate="">
          <input type="hidden" name="time_slot" id="selectedTimeSlot" value="">

          <div class="mb-5">
            <label for="bookingFullName" class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Họ và tên <span class="text-rose-500">*</span></label>
            <div class="relative">
              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
              </span>
              <input type="text" id="bookingFullName" name="full_name" required placeholder="Nguyễn Văn An" class="input-elegant w-full pl-11 pr-4 py-4 rounded-sm text-sm" autocomplete="name">
            </div>
          </div>

          <div class="grid sm:grid-cols-2 gap-5">
            <div class="mb-5">
              <label for="bookingPhone" class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Số điện thoại <span class="text-rose-500">*</span></label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                </span>
                <input type="tel" id="bookingPhone" name="phone" required inputmode="numeric" placeholder="0912345678" maxlength="10" class="input-elegant w-full pl-11 pr-4 py-4 rounded-sm text-sm" autocomplete="tel">
              </div>
            </div>

            <div class="mb-5">
              <label for="bookingEmail" class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Email <span class="text-rose-500">*</span></label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-4 h-4"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                </span>
                <input type="email" id="bookingEmail" name="email" required placeholder="an@email.com" class="input-elegant w-full pl-11 pr-4 py-4 rounded-sm text-sm" autocomplete="email">
              </div>
            </div>
          </div>

          <div class="grid sm:grid-cols-2 gap-5">
            <div class="mb-5">
              <label for="bookingParticipants" class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Số lượng khách <span class="text-rose-500">*</span></label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-4 h-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </span>
                <input type="number" id="bookingParticipants" name="participants" min="1" max="24" required class="input-elegant w-full pl-11 pr-4 py-4 rounded-sm text-sm" value="1">
              </div>
            </div>

            <div class="mb-5">
              <label for="bookingDate" class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Ngày đặt tiệc (Trong 5 ngày) <span class="text-rose-500">*</span></label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                </span>
                <input type="text" id="bookingDate" name="booking_date" required placeholder="dd/mm/yyyy" class="input-elegant w-full bg-card text-foreground pl-11 pr-10 py-4 rounded-sm text-sm font-medium cursor-pointer" value="<?= date('d/m/Y') ?>">
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                </span>
              </div>
            </div>
          </div>

          <div class="mb-6">
            <span id="slotPickerLabel" class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Khung giờ (Lịch Chef/Sommelier) <span class="text-rose-500">*</span></span>
            <div class="grid grid-cols-2 gap-3" id="slotPickerContainer" role="radiogroup" aria-labelledby="slotPickerLabel">
              <button type="button" onclick="selectBookingSlot('Ca 1 (11h00 – 14h00)', this)" class="slot-pill-btn rounded-sm border border-border bg-card hover:border-[var(--wine)] px-4 py-3.5 text-center transition-all cursor-pointer">
                <span class="block text-xs font-semibold text-foreground">Ca 1</span>
                <span class="block text-[11px] text-muted-foreground mt-0.5">11h00 – 14h00</span>
              </button>
              <button type="button" onclick="selectBookingSlot('Ca 2 (18h00 – 21h00)', this)" class="slot-pill-btn rounded-sm border border-border bg-card hover:border-[var(--wine)] px-4 py-3.5 text-center transition-all cursor-pointer">
                <span class="block text-xs font-semibold text-foreground">Ca 2</span>
                <span class="block text-[11px] text-muted-foreground mt-0.5">18h00 – 21h00</span>
              </button>
            </div>
          </div>

          <div class="mb-6">
            <label for="bookingNotes" class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Ghi chú (tuỳ chọn)</label>
            <textarea id="bookingNotes" name="notes" rows="3" placeholder="Yêu cầu đặc biệt, dị ứng, chế độ ăn, dịp lễ..." class="input-elegant w-full px-4 py-3.5 rounded-sm text-sm resize-none"></textarea>
          </div>

          <button type="submit" id="btnBookingSubmit" class="btn-invert w-full py-4 rounded-sm text-sm uppercase tracking-[0.2em] font-medium min-h-[52px] flex items-center justify-center gap-2 mt-2">Đặt tiệc ngay</button>
          
          <div class="flex items-center justify-center gap-2 mt-5 text-[11px] text-muted-foreground">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock w-3.5 h-3.5 text-[var(--gold)] shrink-0"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            <span>Thông tin của bạn được bảo mật tuyệt đối theo <button type="button" onclick="openPrivacyPolicyModal()" class="underline hover:text-[var(--gold)]">chính sách của Amis du Vin</button>.</span>
          </div>
        </form>
      </div>

      <!-- Right Column: Info Summary Card -->
      <div class="reveal is-visible lg:col-span-2">
        <div class="rounded-sm border border-border bg-card p-7 sm:p-8 space-y-6">
          <div>
            <p class="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)] mb-2">An tâm khi đặt tiệc</p>
            <h3 class="font-heading text-xl text-foreground">Thông tin đặt tiệc</h3>
            <div class="hairline w-16 mt-4"></div>
          </div>

          <div class="flex gap-3.5">
            <span class="w-10 h-10 rounded-full border border-border bg-card flex items-center justify-center text-[var(--wine)] shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coins w-4 h-4"><circle cx="8" cy="8" r="6"></circle><path d="M18.09 10.37A6 6 0 1 1 10.34 18"></path><path d="M7 6h1v4"></path><path d="m16.71 13.88.7.71-2.82 2.82"></path></svg>
            </span>
            <div>
              <p class="text-sm font-medium text-foreground mb-1">Chi phí dự kiến</p>
              <p class="text-xs text-muted-foreground leading-relaxed">Từ 1.500.000đ/khách — báo giá chi tiết sau khi chốt thực đơn với CSKH.</p>
            </div>
          </div>

          <div class="flex gap-3.5">
            <span class="w-10 h-10 rounded-full border border-border bg-card flex items-center justify-center text-[var(--wine)] shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet w-4 h-4"><path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"></path><path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"></path></svg>
            </span>
            <div>
              <p class="text-sm font-medium text-foreground mb-1">Phương thức thanh toán</p>
              <p class="text-xs text-muted-foreground leading-relaxed">Chuyển khoản ngân hàng, QR VNPay hoặc tiền mặt. Bắt buộc đặt cọc 30% để giữ chỗ.</p>
            </div>
          </div>

          <div class="flex gap-3.5">
            <span class="w-10 h-10 rounded-full border border-border bg-card flex items-center justify-center text-[var(--wine)] shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </span>
            <div>
              <p class="text-sm font-medium text-foreground mb-1">Thời gian CSKH xác nhận</p>
              <p class="text-xs text-muted-foreground leading-relaxed">Trong vòng 2 giờ làm việc, bộ phận CSKH sẽ liên hệ qua Điện thoại/Zalo để tư vấn thực đơn và chốt lịch.</p>
            </div>
          </div>

          <div class="flex gap-3.5">
            <span class="w-10 h-10 rounded-full border border-border bg-card flex items-center justify-center text-[var(--wine)] shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-4 h-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </span>
            <div>
              <p class="text-sm font-medium text-foreground mb-1">Giới hạn phục vụ</p>
              <p class="text-xs text-muted-foreground leading-relaxed">Tối đa 02 ca/ngày (11h–14h &amp; 18h–21h). Mỗi ca tối đa 02 đoàn khách và không quá 24 người/ca.</p>
            </div>
          </div>

          <div class="flex gap-3.5">
            <span class="w-10 h-10 rounded-full border border-border bg-card flex items-center justify-center text-[var(--wine)] shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check w-4 h-4"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path><path d="m9 12 2 2 4-4"></path></svg>
            </span>
            <div>
              <p class="text-sm font-medium text-foreground mb-1">Đặt chỗ &amp; Hoàn hủy cọc</p>
              <p class="text-xs text-muted-foreground leading-relaxed mb-1.5">Đặt tiệc trong vòng 5 ngày tới. Báo hủy trước 48-72 giờ được hoàn 100% cọc.</p>
              <button type="button" onclick="openRefundPolicyModal()" class="text-xs font-semibold text-[var(--wine)] hover:underline">Xem quy định chi tiết &rarr;</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
