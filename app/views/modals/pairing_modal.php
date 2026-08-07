<!-- Pairing Details Modal -->
<div id="pairingModal" class="modal-overlay">
  <div class="relative w-full max-w-lg animate-scale-in bg-card border border-border rounded-sm overflow-hidden shadow-[0_40px_80px_-30px_rgba(33,30,25,0.5)] max-h-[92vh] flex flex-col no-scrollbar">
    <button onclick="closePairingModal()" class="absolute top-4 right-4 z-10 w-10 h-10 flex items-center justify-center text-white/80 hover:text-white rounded-full hover:bg-white/15 transition-colors" aria-label="Đóng">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>

    <div class="relative h-44 sm:h-52 shrink-0 overflow-hidden">
      <span class="inline-block relative w-full h-full">
        <img id="pairingModalImg" src="" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="Pairing Image">
      </span>
      <div class="absolute inset-0 bg-gradient-to-t from-card via-black/40 to-black/20"></div>
      <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-7">
        <span id="pairingModalLevel" class="inline-block text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border backdrop-blur-sm mb-2 text-white/80 border-white/25 bg-white/10">Standard Level</span>
        <h3 id="pairingModalTitle" class="font-heading text-2xl sm:text-3xl text-white leading-tight drop-shadow-md">Signature Pairing</h3>
      </div>
    </div>

    <div class="p-6 sm:p-8 overflow-y-auto no-scrollbar">
      <p id="pairingModalSubtitle" class="text-xs sm:text-sm text-muted-foreground leading-relaxed mb-6">Sự kết hợp kinh điển...</p>
      
      <div class="grid grid-cols-3 gap-2 sm:gap-3 mb-6">
        <div class="rounded-sm border border-border bg-background px-2 py-3 text-center min-w-0 flex flex-col justify-center items-center">
          <span class="text-[var(--gold)] flex justify-center mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coins w-3.5 h-3.5"><circle cx="8" cy="8" r="6"></circle><path d="M18.09 10.37A6 6 0 1 1 10.34 18"></path><path d="M7 6h1v4"></path><path d="m16.71 13.88.7.71-2.82 2.82"></path></svg>
          </span>
          <p class="text-[9px] uppercase tracking-wide text-muted-foreground mb-0.5">Chi phí dự kiến</p>
          <p id="pairingModalPrice" class="text-[11px] sm:text-xs text-foreground font-semibold leading-tight tracking-tight break-words">Từ 1.500.000đ/khách</p>
        </div>
        <div class="rounded-sm border border-border bg-background px-2 py-3 text-center min-w-0 flex flex-col justify-center items-center">
          <span class="text-[var(--gold)] flex justify-center mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-3.5 h-3.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
          </span>
          <p class="text-[9px] uppercase tracking-wide text-muted-foreground mb-0.5">Thời lượng</p>
          <p id="pairingModalDuration" class="text-[11px] sm:text-xs text-foreground font-semibold leading-tight tracking-tight">2.5 giờ</p>
        </div>
        <div class="rounded-sm border border-border bg-background px-2 py-3 text-center min-w-0 flex flex-col justify-center items-center">
          <span class="text-[var(--gold)] flex justify-center mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-3.5 h-3.5"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
          </span>
          <p class="text-[9px] uppercase tracking-wide text-muted-foreground mb-0.5">Sức chứa</p>
          <p id="pairingModalCapacity" class="text-[11px] sm:text-xs text-foreground font-semibold leading-tight tracking-tight">8–20 khách</p>
        </div>
      </div>

      <h4 class="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)] mb-3">Thực đơn &amp; Rượu vang</h4>
      <ul id="pairingModalMenu" class="space-y-2.5 mb-7">
        <!-- Dynamic menu items -->
      </ul>

      <div class="space-y-2.5">
        <button onclick="closePairingModal(); scrollToId('register');" class="btn-invert w-full flex items-center justify-center gap-2 py-4 rounded-sm text-sm uppercase tracking-[0.2em] font-medium min-h-[52px]">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-check w-4 h-4"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path><path d="m9 16 2 2 4-4"></path></svg> Đặt tiệc ngay!
        </button>
        <div class="grid grid-cols-2 gap-2.5">
          <a href="https://zalo.me/0919686540" target="_blank" rel="noopener noreferrer" class="btn-ghost flex items-center justify-center gap-2 py-3.5 rounded-sm text-xs uppercase tracking-[0.15em] font-medium min-h-[48px]">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle w-4 h-4"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path></svg> Tư vấn Zalo
          </a>
          <a href="tel:0919686540" class="btn-ghost flex items-center justify-center gap-2 py-3.5 rounded-sm text-xs uppercase tracking-[0.15em] font-medium min-h-[48px]">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> Hotline
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
