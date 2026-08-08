<!-- Workshop Details Modal -->
<div id="workshopDetailsModal" class="modal-overlay">
  <div class="relative w-full max-w-lg animate-scale-in bg-card border border-border rounded-sm overflow-hidden shadow-[0_40px_80px_-30px_rgba(33,30,25,0.5)] max-h-[92vh] flex flex-col my-auto">
    <!-- Top-Right Close Button -->
    <button onclick="closeWorkshopDetailsModal()" class="absolute top-4 right-4 z-20 w-10 h-10 flex items-center justify-center text-white/80 hover:text-white rounded-full bg-black/40 hover:bg-black/60 transition-colors" aria-label="Đóng">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>

    <!-- Banner Header with Image & Title Overlay -->
    <div class="relative h-44 sm:h-52 shrink-0 overflow-hidden">
      <span class="inline-block relative w-full h-full">
        <img id="wsDetailImg" src="https://media.base44.com/images/public/6a623336361c483b3f15558c/2ff99e699_image.png/v1/fill/w_510,h_208,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/2ff99e699_image.webp" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="Workshop Cover">
      </span>
      <div class="absolute inset-0 bg-gradient-to-t from-card via-black/40 to-black/20"></div>
      <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-7">
        <div class="flex items-center gap-3 mb-1.5">
          <span id="wsDetailNum" class="font-heading text-2xl text-gradient-gold">01</span>
          <span id="wsDetailBadge" class="inline-flex items-center text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border backdrop-blur-sm text-emerald-300 border-emerald-400/40 bg-emerald-500/20">Còn nhận đăng ký</span>
        </div>
        <h3 id="wsDetailTitle" class="font-heading text-2xl sm:text-3xl text-white leading-tight drop-shadow-md">The First Sip</h3>
      </div>
    </div>

    <!-- Scrollable Body with hidden scrollbar (.no-scrollbar) -->
    <div class="p-7 sm:p-9 overflow-y-auto no-scrollbar">
      <div class="grid sm:grid-cols-2 gap-4 mb-5">
        <div class="flex items-start gap-2.5">
          <span class="text-[var(--gold)] mt-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
          </span>
          <div>
            <p class="text-[10px] uppercase tracking-wide text-muted-foreground">Ngày</p>
            <p id="wsDetailDate" class="text-sm text-foreground font-medium">Thứ 6, 14/08/2026</p>
          </div>
        </div>

        <div class="flex items-start gap-2.5">
          <span class="text-[var(--gold)] mt-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
          </span>
          <div>
            <p class="text-[10px] uppercase tracking-wide text-muted-foreground">Giờ</p>
            <p id="wsDetailTime" class="text-sm text-foreground font-medium">10h – 12h</p>
          </div>
        </div>

        <div class="flex items-start gap-2.5">
          <span class="text-[var(--gold)] mt-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coins w-4 h-4"><circle cx="8" cy="8" r="6"></circle><path d="M18.09 10.37A6 6 0 1 1 10.34 18"></path><path d="M7 6h1v4"></path><path d="m16.71 13.88.7.71-2.82 2.82"></path></svg>
          </span>
          <div>
            <p class="text-[10px] uppercase tracking-wide text-muted-foreground">Học phí dự kiến</p>
            <p id="wsDetailFee" class="text-sm text-foreground font-medium">1.000.000 VNĐ</p>
          </div>
        </div>

        <div class="flex items-start gap-2.5">
          <span class="text-[var(--gold)] mt-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-4 h-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
          </span>
          <div>
            <p class="text-[10px] uppercase tracking-wide text-muted-foreground">Sĩ số lớp</p>
            <p id="wsDetailCapacity" class="text-sm text-foreground font-medium">8 – 12 HV</p>
          </div>
        </div>
      </div>

      <div class="flex items-center justify-between rounded-sm border border-border bg-background px-4 py-3.5 mb-6">
        <span class="text-xs uppercase tracking-wide text-foreground/60">Số chỗ còn nhận</span>
        <span id="wsDetailRemaining" class="text-base font-bold text-[var(--wine)]">Chỉ còn 3 chỗ</span>
      </div>

      <!-- Description -->
      <p id="wsDetailDescription" class="text-sm text-muted-foreground leading-relaxed mb-7">
        Ly vang đầu tiên — khởi đầu hành trình cảm nhận rượu vang: lịch sử, phân loại và bước thử nếm cơ bản dành cho người mới bắt đầu.
      </p>

      <!-- Action Button -->
      <button id="btnWsDetailRegister" onclick="triggerWsDetailRegister(event)" class="w-full flex items-center justify-center gap-2 py-4 rounded-sm text-sm uppercase tracking-[0.2em] font-medium min-h-[52px] transition-all duration-300 btn-wine">
        Đăng ký Workshop này
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
      </button>
    </div>
  </div>
</div>
