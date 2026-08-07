<section id="register" class="scroll-anchor relative py-24 sm:py-32 bg-background overflow-hidden">
  <div class="absolute inset-0 bg-wine-radial opacity-70"></div>
  <div class="relative max-w-6xl mx-auto px-5 sm:px-8">
    <div class="reveal is-visible">
      <div class="text-center mb-12">
        <p class="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-4">Đặt tiệc riêng</p>
        <h2 class="font-heading text-3xl sm:text-5xl text-foreground mb-5">Đăng ký đặt tiệc</h2>
        <p class="text-sm text-muted-foreground">Để lại thông tin, Amis du Vin sẽ liên hệ xác nhận qua Zalo &amp; Email.</p>
      </div>
    </div>
    <div class="grid lg:grid-cols-5 gap-8 lg:gap-10 items-start">
      <div class="reveal is-visible lg:col-span-3">
        <form id="bookingForm" class="bg-card border border-border rounded-sm p-7 sm:p-9 shadow-[0_20px_60px_-30px_rgba(33,30,25,0.25)]" novalidate="">
          <input type="hidden" id="selectedSlot" name="slot" value="">
          <div class="mb-5">
            <label class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Họ và tên</label>
            <div class="relative">
              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
              </span>
              <input type="text" name="full_name" required placeholder="Nguyễn Văn An" class="input-elegant w-full bg-transparent pl-11 pr-4 py-4 rounded-sm text-sm" autocomplete="name" value="">
            </div>
          </div>
          <div class="grid sm:grid-cols-2 gap-5">
            <div class="mb-5">
              <label class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Số điện thoại</label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                </span>
                <input type="tel" name="phone" required inputmode="numeric" placeholder="0912345678" maxlength="10" class="input-elegant w-full bg-transparent pl-11 pr-4 py-4 rounded-sm text-sm" autocomplete="tel" value="">
              </div>
            </div>
            <div class="mb-5">
              <label class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Email</label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-4 h-4"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                </span>
                <input type="email" name="email" required placeholder="an@email.com" class="input-elegant w-full bg-transparent pl-11 pr-4 py-4 rounded-sm text-sm" autocomplete="email" value="">
              </div>
            </div>
          </div>
          <div class="mb-5">
            <label class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Số lượng người tham gia</label>
            <div class="relative">
              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-4 h-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
              </span>
              <input type="number" name="participants" min="1" class="input-elegant w-full bg-transparent pl-11 pr-4 py-4 rounded-sm text-sm" value="1">
            </div>
          </div>
          <div class="mb-5">
            <label class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Ngày đặt tiệc</label>
            <div class="relative">
              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
              </span>
              <input type="date" id="bookingDate" name="booking_date" min="2026-08-07" class="input-elegant w-full bg-transparent pl-11 pr-4 py-4 rounded-sm text-sm" value="">
            </div>
          </div>
          <div class="mb-5">
            <label class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Khung giờ (lịch Sommelier)</label>
            <div id="slotsContainer">
              <p class="text-xs text-muted-foreground italic py-3">Vui lòng chọn ngày để xem khung giờ còn trống.</p>
            </div>
          </div>
          <div class="mb-6">
            <label class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Ghi chú (tuỳ chọn)</label>
            <textarea name="notes" rows="3" placeholder="Yêu cầu đặc biệt, dị ứng, chế độ ăn, dịp lễ..." class="input-elegant w-full px-4 py-3.5 rounded-sm text-sm resize-none"></textarea>
          </div>
          <button type="submit" id="btnBookingSubmit" class="btn-invert w-full py-4 rounded-sm text-sm uppercase tracking-[0.2em] font-medium min-h-[52px] flex items-center justify-center gap-2 mt-2">Đặt tiệc ngay</button>
          <p class="text-center text-[11px] text-muted-foreground mt-5">Thông tin của bạn được bảo mật tuyệt đối theo chính sách của Amis du Vin.</p>
        </form>
      </div>
      <div class="reveal is-visible lg:col-span-2">
        <div class="rounded-sm border border-border bg-card p-7 sm:p-8 space-y-6">
          <div>
            <p class="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)] mb-2">An tâm khi đặt tiệc</p>
            <h3 class="font-heading text-xl text-foreground">Thông tin đặt tiệc</h3>
            <div class="hairline w-16 mt-4"></div>
          </div>
          <div class="flex gap-3.5">
            <span class="w-10 h-10 rounded-full bg-[var(--wine)]/10 border border-[var(--wine)]/25 flex items-center justify-center text-[var(--wine)] shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet w-4 h-4"><path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"></path><path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"></path></svg>
            </span>
            <div>
              <p class="text-sm font-medium text-foreground mb-1">Chi phí dự kiến</p>
              <p class="text-xs text-muted-foreground leading-relaxed">Từ 1.500.000đ/khách — tuỳ gói Food &amp; Wine Pairing và số lượng khách. Báo giá chi tiết sau khi chốt thực đơn.</p>
            </div>
          </div>
          <div class="flex gap-3.5">
            <span class="w-10 h-10 rounded-full bg-[var(--wine)]/10 border border-[var(--wine)]/25 flex items-center justify-center text-[var(--wine)] shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet w-4 h-4"><path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"></path><path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"></path></svg>
            </span>
            <div>
              <p class="text-sm font-medium text-foreground mb-1">Phương thức thanh toán</p>
              <p class="text-xs text-muted-foreground leading-relaxed">Chuyển khoản ngân hàng, QR VNPay hoặc tiền mặt. Đặt cọc 30% để giữ chỗ, thanh toán phần còn lại trước tiệc.</p>
            </div>
          </div>
          <div class="flex gap-3.5">
            <span class="w-10 h-10 rounded-full bg-[var(--wine)]/10 border border-[var(--wine)]/25 flex items-center justify-center text-[var(--wine)] shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </span>
            <div>
              <p class="text-sm font-medium text-foreground mb-1">Thời gian CSKH xác nhận</p>
              <p class="text-xs text-muted-foreground leading-relaxed">Trong vòng 2 giờ làm việc, bộ phận CSKH sẽ liên hệ qua Zalo/SĐT để chốt thông tin.</p>
            </div>
          </div>
          <div class="flex gap-3.5">
            <span class="w-10 h-10 rounded-full bg-[var(--wine)]/10 border border-[var(--wine)]/25 flex items-center justify-center text-[var(--wine)] shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check w-4 h-4"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path><path d="m9 12 2 2 4-4"></path></svg>
            </span>
            <div>
              <p class="text-sm font-medium text-foreground mb-1">Chính sách hoàn/hủy</p>
              <p class="text-xs text-muted-foreground leading-relaxed">Hoàn 100% nếu hủy trước 72 giờ. Trong vòng 72 giờ, giữ 50% chi phí đặt cọc.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
