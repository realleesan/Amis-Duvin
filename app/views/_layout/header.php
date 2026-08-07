<header class="fixed top-0 inset-x-0 z-50 transition-all duration-500 bg-transparent py-5">
  <div class="max-w-7xl mx-auto px-5 sm:px-8 flex items-center justify-between">
    <button class="flex items-center group transition-transform duration-300 hover:scale-[1.03]" aria-label="Amis du Vin" onclick="scrollToId('hero')">
      <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png" alt="Amis du Vin" class="h-9 sm:h-10 w-auto object-contain rounded-sm">
    </button>
    <nav class="hidden md:flex items-center gap-7">
      <button class="relative text-sm tracking-wide py-2 group transition-colors text-white/80 hover:text-white" onclick="scrollToId('about')">Về chúng tôi<span class="absolute left-0 -bottom-0.5 h-px w-0 bg-[var(--wine)] transition-all duration-300 group-hover:w-full"></span></button>
      <button class="relative text-sm tracking-wide py-2 group transition-colors text-white/80 hover:text-white" onclick="scrollToId('pairing')">Food &amp; Wine Pairing<span class="absolute left-0 -bottom-0.5 h-px w-0 bg-[var(--wine)] transition-all duration-300 group-hover:w-full"></span></button>
      <button class="relative text-sm tracking-wide py-2 group transition-colors text-white/80 hover:text-white" onclick="scrollToId('workshops')">Dịch vụ khác<span class="absolute left-0 -bottom-0.5 h-px w-0 bg-[var(--wine)] transition-all duration-300 group-hover:w-full"></span></button>
      <button class="relative text-sm tracking-wide py-2 group transition-colors text-white/80 hover:text-white" onclick="scrollToId('map')">Liên hệ<span class="absolute left-0 -bottom-0.5 h-px w-0 bg-[var(--wine)] transition-all duration-300 group-hover:w-full"></span></button>
      <button class="btn-invert px-6 py-2.5 rounded-sm text-xs uppercase tracking-[0.18em] font-medium" onclick="scrollToId('register')">Đặt tiệc ngay</button>
    </nav>
    <div class="md:hidden flex items-center gap-1">
      <button id="mobileMenuBtn" class="w-11 h-11 flex items-center justify-center transition-colors text-white" aria-label="Mở menu">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu w-6 h-6"><line x1="4" x2="20" y1="12" y2="12"></line><line x1="4" x2="20" y1="6" y2="6"></line><line x1="4" x2="20" y1="18" y2="18"></line></svg>
      </button>
    </div>
  </div>
  <div id="mobileMenuDropdown" class="md:hidden overflow-hidden transition-all duration-500 max-h-0 bg-background/95 backdrop-blur-md">
    <nav class="px-5 py-4 flex flex-col gap-1">
      <button class="text-left py-3.5 text-base text-foreground/85 hover:text-[var(--wine)] transition-colors min-h-[44px] border-b border-border" onclick="scrollToId('about'); toggleMobileMenu();">Về chúng tôi</button>
      <button class="text-left py-3.5 text-base text-foreground/85 hover:text-[var(--wine)] transition-colors min-h-[44px] border-b border-border" onclick="scrollToId('pairing'); toggleMobileMenu();">Food &amp; Wine Pairing</button>
      <button class="text-left py-3.5 text-base text-foreground/85 hover:text-[var(--wine)] transition-colors min-h-[44px] border-b border-border" onclick="scrollToId('workshops'); toggleMobileMenu();">Dịch vụ khác</button>
      <button class="text-left py-3.5 text-base text-foreground/85 hover:text-[var(--wine)] transition-colors min-h-[44px] border-b border-border" onclick="scrollToId('map'); toggleMobileMenu();">Liên hệ</button>
      <button class="btn-invert mt-3 py-3.5 rounded-sm text-sm uppercase tracking-[0.18em] font-medium min-h-[48px]" onclick="scrollToId('register'); toggleMobileMenu();">Đặt tiệc ngay</button>
    </nav>
  </div>
</header>
