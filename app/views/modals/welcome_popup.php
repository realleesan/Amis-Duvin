<!-- Module 0.2: Welcome Popup Modal (3s Auto Countdown) -->
<div id="welcomeModal" class="modal-overlay">
  <div class="relative w-full max-w-lg text-center animate-scale-in bg-card border border-border rounded-sm p-8 sm:p-10 shadow-2xl my-auto">
    <button onclick="closeWelcomeModal()" type="button" class="absolute top-4 right-4 w-9 h-9 flex items-center justify-center text-muted-foreground hover:text-foreground rounded-full hover:bg-muted transition-colors shrink-0" aria-label="Đóng">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>

    <div class="flex justify-center mb-6">
      <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png" alt="Amis du Vin" class="h-14 sm:h-16 w-auto object-contain rounded-sm">
    </div>

    <p class="text-[10px] uppercase tracking-[0.35em] text-[var(--gold)] mb-2">Lời chào mừng</p>
    <h3 class="font-heading text-2xl sm:text-3xl text-foreground leading-snug mb-4">
      Chào mừng Quý khách đến với Amis du Vin
    </h3>

    <p class="text-sm text-muted-foreground leading-relaxed mb-6">
      Không gian Tiệc riêng tư &amp; Tinh hoa ẩm thực Rượu vang.
    </p>

    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-muted/60 border border-border text-xs text-muted-foreground">
      <span class="w-2 h-2 rounded-full bg-[var(--gold)] animate-ping"></span>
      <span>Tự động đóng sau <strong id="welcomeCountdown" class="text-foreground font-bold">3</strong>s...</span>
    </div>
  </div>
</div>
