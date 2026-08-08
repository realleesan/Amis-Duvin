<!-- Module 0.2: Welcome Popup Modal (Luxury Ambient Redesign) -->
<div id="welcomeModal" class="modal-overlay">
  <div class="relative w-full max-w-lg text-center animate-scale-in bg-card border border-border rounded-sm overflow-hidden shadow-[0_30px_70px_-20px_rgba(0,0,0,0.8)] my-auto group">
    <!-- Ambient Background Banner Image -->
    <div class="absolute inset-0 z-0">
      <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/1d3f75363_generated_b7d85214.png/v1/fill/w_1171,h_927,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/1d3f75363_generated_b7d85214.webp" alt="Amis du Vin Ambient" class="w-full h-full object-cover opacity-25">
      <div class="absolute inset-0 bg-gradient-to-t from-card via-card/90 to-card/75"></div>
      <div class="absolute inset-0 bg-wine-radial opacity-60"></div>
    </div>

    <!-- Modal Content -->
    <div class="relative z-10 p-8 sm:p-12">
      <button onclick="closeWelcomeModal()" type="button" class="absolute top-4 right-4 w-9 h-9 flex items-center justify-center text-muted-foreground hover:text-foreground rounded-full hover:bg-muted/50 transition-colors shrink-0" aria-label="Đóng">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
      </button>

      <div class="flex justify-center mb-6">
        <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png" alt="Amis du Vin" class="h-16 sm:h-20 w-auto object-contain rounded-sm drop-shadow-md">
      </div>

      <p class="text-[10px] uppercase tracking-[0.4em] text-[var(--gold)] mb-3">— WELCOME TO AMIS DU VIN —</p>

      <h3 class="font-heading text-2xl sm:text-3xl text-white leading-snug mb-4">
        Không gian Tiệc riêng tư <br>
        <span class="font-serif-display italic font-normal text-xl sm:text-2xl text-[var(--gold)] block mt-1">&amp; Tinh hoa ẩm thực Rượu vang</span>
      </h3>

      <div class="hairline w-20 mx-auto my-5"></div>

      <p class="text-xs sm:text-sm text-white/80 max-w-sm mx-auto leading-relaxed font-light">
        Trải nghiệm tiệc riêng tư kết hợp ẩm thực và rượu vang tinh tế, trọn vẹn văn hoá vang tại Hà Nội.
      </p>
    </div>
  </div>
</div>
