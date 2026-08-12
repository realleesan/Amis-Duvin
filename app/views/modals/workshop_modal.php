<!-- Workshop Reservation Modal -->
<div id="workshopModal" class="modal-overlay">
  <div class="relative w-full max-w-lg max-h-[90vh] flex flex-col bg-card border border-border rounded-sm shadow-2xl animate-scale-in my-auto">
    <!-- Sticky Modal Header -->
    <div class="shrink-0 bg-card px-6 sm:px-8 py-5 flex items-center justify-between border-b border-border">
      <div>
        <p class="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)] mb-1">Giữ chỗ Workshop</p>
        <h3 class="font-heading text-lg text-foreground">Đăng ký tham gia</h3>
      </div>
      <button onclick="closeWorkshopModal()" class="w-10 h-10 flex items-center justify-center text-muted-foreground hover:text-foreground rounded-full hover:bg-muted transition-colors shrink-0" aria-label="Đóng">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
      </button>
    </div>

    <!-- Scrollable Form Body with hidden scrollbar (no-scrollbar) -->
    <form id="workshopModalForm" class="flex-1 overflow-y-auto no-scrollbar p-6 sm:p-8" onsubmit="handleWorkshopModalSubmit(event)">
      <input type="hidden" id="wsModalInputId" name="workshop_id" value="1">
      
      <p class="text-[10px] uppercase tracking-[0.18em] text-foreground/50 mb-3">Workshop bạn chọn</p>
      
      <!-- Selected Workshop Preview Card -->
      <div class="flex gap-4 rounded-sm border border-border bg-background/50 p-4 mb-6">
        <span class="inline-block relative w-20 h-20 rounded-sm shrink-0 overflow-hidden border border-border">
          <img id="wsModalPreviewImg" src="https://media.base44.com/images/public/6a623336361c483b3f15558c/2ff99e699_image.png/v1/fill/w_80,h_80,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/2ff99e699_image.webp" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="Workshop Image">
        </span>
        <div class="min-w-0 flex-1">
          <h4 id="wsModalPreviewTitle" class="font-heading text-base text-foreground leading-tight mb-2">The First Sip</h4>
          <div class="space-y-1 text-xs text-muted-foreground">
            <p id="wsModalPreviewSchedule" class="flex items-center gap-1.5">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3.5 h-3.5 text-[var(--gold)] shrink-0"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
              <span>Thứ 6, 14/08/2026 · 10h – 12h</span>
            </p>
            <p id="wsModalPreviewPrice" class="flex items-center gap-1.5">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coins w-3.5 h-3.5 text-[var(--gold)] shrink-0"><circle cx="8" cy="8" r="6"></circle><path d="M18.09 10.37A6 6 0 1 1 10.34 18"></path><path d="M7 6h1v4"></path><path d="m16.71 13.88.7.71-2.82 2.82"></path></svg>
              <span>1.000.000 VNĐ</span>
            </p>
          </div>
        </div>
      </div>

      <!-- User Information Fields -->
      <div class="mb-4">
        <label for="wsModalFullName" class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Họ và tên</label>
        <div class="relative">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
          </span>
          <input type="text" id="wsModalFullName" name="full_name" required placeholder="Nguyễn Văn An" class="input-elegant w-full bg-transparent pl-11 pr-4 py-3.5 rounded-sm text-sm" autocomplete="name">
        </div>
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div class="mb-4">
          <label for="wsModalPhone" class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Số điện thoại</label>
          <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
            </span>
            <input type="tel" id="wsModalPhone" name="phone" required inputmode="numeric" placeholder="0912345678" maxlength="10" class="input-elegant w-full bg-transparent pl-11 pr-4 py-3.5 rounded-sm text-sm" autocomplete="tel">
          </div>
        </div>

        <div class="mb-4">
          <label for="wsModalEmail" class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Email</label>
          <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-4 h-4"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
            </span>
            <input type="email" id="wsModalEmail" name="email" required placeholder="an@email.com" class="input-elegant w-full bg-transparent pl-11 pr-4 py-3.5 rounded-sm text-sm" autocomplete="email">
          </div>
        </div>
      </div>

      <!-- Optional Add-on Workshops -->
      <div class="mb-6">
        <p class="text-[10px] uppercase tracking-[0.18em] text-foreground/50 mb-3">Đặt chỗ thêm workshop khác (tuỳ chọn)</p>
        <div id="wsAddonContainer" class="space-y-2">
          <!-- Dynamically populated addon items -->
        </div>
      </div>

      <button type="submit" id="btnWsModalSubmit" class="btn-invert w-full py-4 rounded-sm text-sm uppercase tracking-[0.2em] font-medium min-h-[52px] flex items-center justify-center gap-2">
        Giữ chỗ
      </button>
      <p class="text-center text-[11px] text-muted-foreground mt-4">Thông tin của bạn được bảo mật tuyệt đối theo chính sách của Amis Duvin.</p>
    </form>
  </div>
</div>
