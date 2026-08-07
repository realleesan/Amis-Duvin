document.addEventListener('DOMContentLoaded', () => {
  // Age verification check
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

  // Mobile Menu Toggle
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');
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

  // FAQ Accordion
  document.querySelectorAll('.faq-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.faq-item');
      if (!item) return;
      const content = item.querySelector('.faq-content');
      const icon = item.querySelector('.faq-icon');

      const isHidden = content.classList.contains('hidden');

      // Close other accordion items
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

  // Pairing Mobile Carousel Navigation
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

  // Smooth scroll links helper
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
