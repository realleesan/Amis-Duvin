<!-- Workshop Success Notification Modal -->
<div id="workshopSuccessModal" class="modal-overlay">
  <div class="relative w-full max-w-md bg-card border border-border rounded-sm shadow-2xl p-7 sm:p-9 text-center animate-scale-in my-auto">
    <button onclick="closeWorkshopSuccessModal()" type="button" class="absolute top-4 right-4 w-9 h-9 flex items-center justify-center text-muted-foreground hover:text-foreground rounded-full hover:bg-muted transition-colors" aria-label="Đóng">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>
    
    <div class="w-16 h-16 rounded-full border border-border bg-card flex items-center justify-center mx-auto mb-6 text-[var(--wine)] shadow-md">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-8 h-8"><path d="M20 6 9 17l-5-5"></path></svg>
    </div>

    <p class="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)] mb-2">Thông báo</p>
    <h3 class="font-heading text-2xl text-foreground mb-3">Đăng ký Workshop Thành công!</h3>
    <p class="text-xs sm:text-sm text-muted-foreground leading-relaxed mb-7">
      Cảm ơn Quý khách đã đăng ký trải nghiệm Workshop tại Amis du Vin. Chuyên viên chăm sóc khách hàng sẽ liên hệ xác nhận lịch trực tiếp qua Điện thoại/Zalo trong thời gian sớm nhất.
    </p>

    <button onclick="closeWorkshopSuccessModal()" type="button" class="btn-wine w-full py-3.5 rounded-sm text-xs uppercase tracking-[0.2em] font-medium transition-transform active:scale-[0.98]">
      Đóng
    </button>
  </div>
</div>
