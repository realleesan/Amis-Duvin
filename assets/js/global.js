document.addEventListener('DOMContentLoaded', () => {
  // 1. Header scroll effect (glass & text color)
  const header = document.getElementById('mainHeader');
  const navLinks = document.querySelectorAll('.nav-link');
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');
  const themeToggleBtns = document.querySelectorAll('.theme-toggle-btn');

  function updateHeaderScroll() {
    const isScrolled = window.scrollY > 40;
    if (!header) return;

    if (isScrolled) {
      header.classList.remove('bg-transparent', 'py-5');
      header.classList.add('glass', 'py-3');
      navLinks.forEach(link => {
        link.classList.remove('text-white/80', 'hover:text-white');
        link.classList.add('text-foreground/70', 'hover:text-foreground');
      });
      themeToggleBtns.forEach(btn => {
        btn.classList.remove('text-white');
        btn.classList.add('text-foreground');
      });
      if (mobileMenuBtn) {
        mobileMenuBtn.classList.remove('text-white');
        mobileMenuBtn.classList.add('text-foreground');
      }
    } else {
      header.classList.remove('glass', 'py-3');
      header.classList.add('bg-transparent', 'py-5');
      navLinks.forEach(link => {
        link.classList.remove('text-foreground/70', 'hover:text-foreground');
        link.classList.add('text-white/80', 'hover:text-white');
      });
      themeToggleBtns.forEach(btn => {
        btn.classList.remove('text-foreground');
        btn.classList.add('text-white');
      });
      if (mobileMenuBtn) {
        mobileMenuBtn.classList.remove('text-foreground');
        mobileMenuBtn.classList.add('text-white');
      }
    }
  }

  window.addEventListener('scroll', updateHeaderScroll, { passive: true });
  updateHeaderScroll();

  // 2. Dark / Light Theme Toggle
  function syncThemeUI() {
    const isDark = document.documentElement.classList.contains('dark');
    document.querySelectorAll('#sunIcon, .sunIconMobile').forEach(el => {
      el.classList.toggle('hidden', !isDark);
    });
    document.querySelectorAll('#moonIcon, .moonIconMobile').forEach(el => {
      el.classList.toggle('hidden', isDark);
    });
  }

  themeToggleBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const isDark = document.documentElement.classList.toggle('dark');
      try {
        localStorage.setItem('adv-theme', isDark ? 'dark' : 'light');
      } catch (e) {}
      syncThemeUI();
    });
  });

  syncThemeUI();

  // 3. Age verification check
  const ageModal = document.getElementById('ageVerificationModal');
  const isVerified = sessionStorage.getItem('adv_verified') === '1';

  if (!isVerified && ageModal) {
    ageModal.classList.add('active');
  }

  const ageSlider = document.getElementById('ageSlider');
  const ageYearDisplay = document.getElementById('ageYearDisplay');
  const ageFeedback = document.getElementById('ageFeedback');
  const btnVerifyAge = document.getElementById('btnVerifyAge');

  if (ageSlider && ageYearDisplay && ageFeedback) {
    const updateAge = () => {
      const year = parseInt(ageSlider.value, 10);
      const currentYear = 2026;
      const age = currentYear - year;
      ageYearDisplay.textContent = year;

      if (age >= 18) {
        ageFeedback.textContent = `Bạn đủ ${age} tuổi — đủ điều kiện truy cập`;
        ageFeedback.className = "text-sm mt-7 mb-7 transition-colors text-[var(--gold)]";
        if (btnVerifyAge) btnVerifyAge.disabled = false;
      } else {
        ageFeedback.textContent = `Bạn ${age} tuổi — chưa đủ 18 tuổi để truy cập`;
        ageFeedback.className = "text-sm mt-7 mb-7 transition-colors text-red-400";
        if (btnVerifyAge) btnVerifyAge.disabled = true;
      }
    };

    ageSlider.addEventListener('input', updateAge);
    updateAge();
  }

  if (btnVerifyAge) {
    btnVerifyAge.addEventListener('click', () => {
      sessionStorage.setItem('adv_verified', '1');
      if (ageModal) ageModal.classList.remove('active');
    });
  }

  // 4. Mobile Menu Toggle
  const mobileMenuDropdown = document.getElementById('mobileMenuDropdown');

  if (mobileMenuBtn && mobileMenuDropdown) {
    mobileMenuBtn.addEventListener('click', () => {
      window.toggleMobileMenu();
    });
  }

  window.toggleMobileMenu = function () {
    if (!mobileMenuDropdown) return;
    if (mobileMenuDropdown.classList.contains('max-h-0')) {
      mobileMenuDropdown.classList.remove('max-h-0');
      mobileMenuDropdown.classList.add('max-h-96');
    } else {
      mobileMenuDropdown.classList.remove('max-h-96');
      mobileMenuDropdown.classList.add('max-h-0');
    }
  };

  // 5. FAQ Accordion
  document.querySelectorAll('.faq-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.faq-item');
      if (!item) return;
      const content = item.querySelector('.faq-content');
      const icon = item.querySelector('.faq-icon');

      const isHidden = content.classList.contains('hidden');

      document.querySelectorAll('.faq-item').forEach(other => {
        const otherContent = other.querySelector('.faq-content');
        const otherIcon = other.querySelector('.faq-icon');
        if (otherContent) otherContent.classList.add('hidden');
        if (otherIcon) {
          otherIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>`;
          otherIcon.classList.remove('bg-[var(--wine)]', 'text-white');
          otherIcon.classList.add('bg-foreground/5', 'text-foreground/60');
        }
      });

      if (isHidden && content) {
        content.classList.remove('hidden');
        if (icon) {
          icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus w-4 h-4"><path d="M5 12h14"></path></svg>`;
          icon.classList.remove('bg-foreground/5', 'text-foreground/60');
          icon.classList.add('bg-[var(--wine)]', 'text-white');
        }
      }
    });
  });

  // 6. Pairing Mobile Carousel Navigation
  const pairingCarousel = document.getElementById('pairingCarousel');
  const btnPairingPrev = document.getElementById('btnPairingPrev');
  const btnPairingNext = document.getElementById('btnPairingNext');

  if (pairingCarousel && btnPairingPrev && btnPairingNext) {
    btnPairingPrev.addEventListener('click', () => {
      pairingCarousel.scrollBy({ left: -300, behavior: 'smooth' });
    });
    btnPairingNext.addEventListener('click', () => {
      pairingCarousel.scrollBy({ left: 300, behavior: 'smooth' });
    });
  }

  // 7. Dynamic Pairing Modal handlers
  window.openPairingModal = function(data) {
    if (!data) return;
    const modal = document.getElementById('pairingModal');
    if (!modal) return;

    const img = document.getElementById('pairingModalImg');
    const level = document.getElementById('pairingModalLevel');
    const title = document.getElementById('pairingModalTitle');
    const subtitle = document.getElementById('pairingModalSubtitle');
    const price = document.getElementById('pairingModalPrice');
    const duration = document.getElementById('pairingModalDuration');
    const capacity = document.getElementById('pairingModalCapacity');
    const menuContainer = document.getElementById('pairingModalMenu');

    if (img) {
      img.src = data.image || '';
      img.alt = data.title || '';
    }
    if (level) {
      level.textContent = data.level || 'Standard Level';
      if (data.level && data.level.toLowerCase().includes('premium')) {
        level.className = "inline-block text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border backdrop-blur-sm mb-2 text-[var(--gold)] border-[var(--gold)]/40 bg-[var(--gold)]/15";
      } else {
        level.className = "inline-block text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border backdrop-blur-sm mb-2 text-white/80 border-white/25 bg-white/10";
      }
    }
    if (title) title.textContent = data.title || '';
    if (subtitle) subtitle.textContent = data.subtitle || '';
    if (price) price.textContent = data.price_text || '';
    if (duration) duration.textContent = data.duration || '';
    if (capacity) capacity.textContent = data.capacity || '';

    if (menuContainer) {
      menuContainer.innerHTML = '';
      let menuItems = data.menu_items;
      if (typeof menuItems === 'string') {
        try { menuItems = JSON.parse(menuItems); } catch(e) { menuItems = []; }
      }
      if (Array.isArray(menuItems)) {
        menuItems.forEach(item => {
          const li = document.createElement('li');
          li.className = "flex items-start justify-between gap-3 text-sm border-b border-border pb-2.5 last:border-0";
          li.innerHTML = `
            <span class="text-foreground/85">${item.course || ''}</span>
            <span class="text-[var(--wine)] font-medium text-right shrink-0 max-w-[45%]">${item.wine || ''}</span>
          `;
          menuContainer.appendChild(li);
        });
      }
    }

    modal.classList.add('active');
  };

  window.closePairingModal = function() {
    const modal = document.getElementById('pairingModal');
    if (modal) modal.classList.remove('active');
  };

  // Close modal when clicking outside content
  document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) {
        overlay.classList.remove('active');
      }
    });
  });

  // 8. Smooth scroll links helper
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const targetId = this.getAttribute('href').substring(1);
      scrollToId(targetId);
    });
  });
});

function scrollToId(id) {
  const el = document.getElementById(id);
  if (el) el.scrollIntoView({ behavior: 'smooth' });
}
