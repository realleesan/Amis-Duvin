<header id="mainHeader" class="fixed top-0 inset-x-0 z-50 transition-all duration-500 bg-transparent py-5">
  <div class="max-w-7xl mx-auto px-5 sm:px-8 flex items-center justify-between">
    <button class="flex items-center group transition-transform duration-300 hover:scale-[1.03]" aria-label="Amis du Vin" onclick="scrollToId('hero')">
      <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png" alt="Amis du Vin" class="h-9 sm:h-10 w-auto object-contain rounded-sm">
    </button>

    <!-- Desktop Navigation -->
    <nav class="hidden md:flex items-center gap-7 font-body-modern">
      <button class="nav-link relative text-sm tracking-wide font-medium py-2 group transition-colors text-white/80 hover:text-white" onclick="scrollToId('about')">
        Về chúng tôi
        <span class="absolute left-0 -bottom-0.5 h-px w-0 bg-[var(--gold)] transition-all duration-300 group-hover:w-full"></span>
      </button>
      <button class="nav-link relative text-sm tracking-wide font-medium py-2 group transition-colors text-white/80 hover:text-white" onclick="scrollToId('pairing')">
        Food &amp; Wine Pairing
        <span class="absolute left-0 -bottom-0.5 h-px w-0 bg-[var(--gold)] transition-all duration-300 group-hover:w-full"></span>
      </button>
      <button class="nav-link relative text-sm tracking-wide font-medium py-2 group transition-colors text-white/80 hover:text-white" onclick="scrollToId('workshops')">
        Dịch vụ khác
        <span class="absolute left-0 -bottom-0.5 h-px w-0 bg-[var(--gold)] transition-all duration-300 group-hover:w-full"></span>
      </button>
      <button class="nav-link relative text-sm tracking-wide font-medium py-2 group transition-colors text-white/80 hover:text-white" onclick="scrollToId('map')">
        Liên hệ
        <span class="absolute left-0 -bottom-0.5 h-px w-0 bg-[var(--gold)] transition-all duration-300 group-hover:w-full"></span>
      </button>

      <!-- Theme Toggle Button -->
      <button id="themeToggleBtn" class="theme-toggle-btn w-11 h-11 flex items-center justify-center rounded-full transition-colors hover:bg-foreground/5 text-white" aria-label="Chuyển đổi giao diện" title="Chuyển đổi giao diện Sáng / Tối">
        <svg id="sunIcon" class="w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2"></path><path d="M12 20v2"></path><path d="m4.93 4.93 1.41 1.41"></path><path d="m17.66 17.66 1.41 1.41"></path><path d="M2 12h2"></path><path d="M20 12h2"></path><path d="m6.34 17.66-1.41 1.41"></path><path d="m19.07 4.93-1.41 1.41"></path></svg>
        <svg id="moonIcon" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path></svg>
      </button>

      <button class="btn-brand-burgundy px-6 py-2.5 rounded-sm text-xs uppercase tracking-[0.18em] font-semibold shadow-md" onclick="scrollToId('register')">Đặt tiệc ngay</button>
    </nav>

    <!-- Mobile Navigation Toggle -->
    <div class="md:hidden flex items-center gap-1">
      <button id="mobileThemeToggleBtn" class="theme-toggle-btn w-11 h-11 flex items-center justify-center rounded-full transition-colors hover:bg-foreground/5 text-white" aria-label="Chuyển đổi giao diện">
        <svg class="sunIconMobile w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2"></path><path d="M12 20v2"></path><path d="m4.93 4.93 1.41 1.41"></path><path d="m17.66 17.66 1.41 1.41"></path><path d="M2 12h2"></path><path d="M20 12h2"></path><path d="m6.34 17.66-1.41 1.41"></path><path d="m19.07 4.93-1.41 1.41"></path></svg>
        <svg class="moonIconMobile w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path></svg>
      </button>
      <button id="mobileMenuBtn" class="w-11 h-11 flex items-center justify-center transition-colors text-white" aria-label="Mở menu">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu w-6 h-6"><line x1="4" x2="20" y1="12" y2="12"></line><line x1="4" x2="20" y1="6" y2="6"></line><line x1="4" x2="20" y1="18" y2="18"></line></svg>
      </button>
    </div>
  </div>

  <!-- Mobile Dropdown Menu -->
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
