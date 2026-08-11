<!-- Module 0.1: Age Verification Modal (Fullscreen Overlay) -->
<div id="ageVerificationModal" class="modal-overlay">
  <div class="relative w-full max-w-lg text-center animate-scale-in bg-card border border-border rounded-sm px-7 py-10 sm:px-12 shadow-[0_40px_80px_-30px_rgba(33,30,25,0.5)] my-auto">
    <div class="flex justify-center mb-6">
      <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png" alt="Amis Duvin" class="h-16 sm:h-20 w-auto object-contain rounded-sm">
    </div>
    
    <p class="text-[10px] uppercase tracking-[0.35em] text-[var(--gold)] mb-3">Xác minh độ tuổi</p>
    <h2 class="font-heading text-2xl sm:text-3xl text-foreground leading-snug mb-4">
      Vui lòng xác nhận bạn đủ 18 tuổi<br class="hidden sm:block"> để tiếp tục truy cập
    </h2>
    
    <p class="text-xs sm:text-sm text-muted-foreground max-w-sm mx-auto mb-8 leading-relaxed">
      Theo quy định của pháp luật về đồ uống có cồn, Quý khách cần xác nhận độ tuổi trước khi truy cập không gian Amis Duvin.
    </p>

    <!-- 02 Clear Buttons: Trên 18 tuổi & Dưới 18 tuổi -->
    <div class="space-y-3 sm:space-y-0 sm:flex sm:gap-4 justify-center">
      <button id="btnAgeYes" type="button" class="w-full sm:w-1/2 py-4 rounded-sm text-xs sm:text-sm uppercase tracking-[0.18em] font-semibold bg-[#B62025] text-[#F6F5F4] hover:bg-[#8A1216] transition-all min-h-[52px] shadow-lg">
        Trên 18 tuổi
      </button>
      
      <button id="btnAgeNo" type="button" class="w-full sm:w-1/2 py-4 rounded-sm text-xs sm:text-sm uppercase tracking-[0.18em] font-semibold bg-[#171717] text-[#F6F5F4] border border-border hover:bg-black transition-all min-h-[52px]">
        Dưới 18 tuổi
      </button>
    </div>
  </div>
</div>
