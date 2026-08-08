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

  // 8. Sommelier Drawer Modal & Slider
  let currentSommelierSlide = 0;
  const totalSommelierSlides = 4;

  window.openSommelierModal = function() {
    const modal = document.getElementById('sommelierModal');
    if (modal) modal.classList.add('active');
  };

  window.closeSommelierModal = function() {
    const modal = document.getElementById('sommelierModal');
    if (modal) modal.classList.remove('active');
  };

  window.goToSommelierSlide = function(index) {
    currentSommelierSlide = (index + totalSommelierSlides) % totalSommelierSlides;
    const track = document.getElementById('sommelierSliderTrack');
    if (track) {
      track.style.transform = `translateX(-${currentSommelierSlide * 100}%)`;
    }
    const dotsContainer = document.getElementById('sommelierSliderDots');
    if (dotsContainer) {
      const dots = dotsContainer.querySelectorAll('button');
      dots.forEach((dot, idx) => {
        if (idx === currentSommelierSlide) {
          dot.className = "h-1.5 rounded-full transition-all duration-300 w-6 bg-[var(--wine)]";
        } else {
          dot.className = "h-1.5 rounded-full transition-all duration-300 w-1.5 bg-white/50";
        }
      });
    }
  };

  window.prevSommelierSlide = function() {
    window.goToSommelierSlide(currentSommelierSlide - 1);
  };

  window.nextSommelierSlide = function() {
    window.goToSommelierSlide(currentSommelierSlide + 1);
  };

  // Certificate Lightbox Zoom Modal Handlers
  window.openCertLightbox = function(imgSrc) {
    const modal = document.getElementById('certLightboxModal');
    const img = document.getElementById('certLightboxImg');
    if (modal && img) {
      img.src = imgSrc || '';
      modal.classList.add('active');
    }
  };

  window.closeCertLightbox = function() {
    const modal = document.getElementById('certLightboxModal');
    if (modal) modal.classList.remove('active');
  };

  // Policy Modal Handlers
  window.openPrivacyPolicyModal = function() {
    const modal = document.getElementById('privacyPolicyModal');
    if (modal) modal.classList.add('active');
  };

  window.closePrivacyPolicyModal = function() {
    const modal = document.getElementById('privacyPolicyModal');
    if (modal) modal.classList.remove('active');
  };

  window.openRefundPolicyModal = function() {
    const modal = document.getElementById('refundPolicyModal');
    if (modal) modal.classList.add('active');
  };

  window.closeRefundPolicyModal = function() {
    const modal = document.getElementById('refundPolicyModal');
    if (modal) modal.classList.remove('active');
  };

  window.closeSuccessModal = function() {
    const modal = document.getElementById('successModal');
    if (modal) modal.classList.remove('active');
  };

  // Workshop Reservation Modal Handlers
  window.openWorkshopReservationModal = function(wsData, event) {
    if (event) event.stopPropagation();
    
    const modal = document.getElementById('workshopModal');
    if (!modal) return;

    if (wsData) {
      const inputId = document.getElementById('wsModalInputId');
      const img = document.getElementById('wsModalPreviewImg');
      const title = document.getElementById('wsModalPreviewTitle');
      const schedule = document.getElementById('wsModalPreviewSchedule');
      const price = document.getElementById('wsModalPreviewPrice');

      if (inputId) inputId.value = wsData.id || 1;
      if (img) img.src = wsData.image || '';
      if (title) title.textContent = wsData.title || '';
      
      if (schedule) {
        schedule.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3.5 h-3.5 text-[var(--gold)] shrink-0"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg> <span>${wsData.schedule || ''}</span>`;
      }
      
      if (price) {
        const priceStr = wsData.price_text || (wsData.price ? (Number(wsData.price).toLocaleString('vi-VN') + ' VNĐ') : '');
        price.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coins w-3.5 h-3.5 text-[var(--gold)] shrink-0"><circle cx="8" cy="8" r="6"></circle><path d="M18.09 10.37A6 6 0 1 1 10.34 18"></path><path d="M7 6h1v4"></path><path d="m16.71 13.88.7.71-2.82 2.82"></path></svg> <span>${priceStr}</span>`;
      }
    }

    // Populate Add-on workshops
    const addonContainer = document.getElementById('wsAddonContainer');
    if (addonContainer && window.__ALL_WORKSHOPS__) {
      const currentId = wsData ? wsData.id : null;
      const otherWorkshops = window.__ALL_WORKSHOPS__.filter(w => w.id !== currentId);
      
      addonContainer.innerHTML = otherWorkshops.map(w => {
        const pText = w.price_text || (w.price ? (Number(w.price).toLocaleString('vi-VN') + ' VNĐ') : '');
        const schDate = w.schedule ? w.schedule.split('·')[0].trim() : '';
        return `
          <label class="flex items-center gap-3 rounded-sm border px-3.5 py-3 cursor-pointer transition-colors border-border hover:border-[var(--wine)]/40 ws-addon-item" onclick="toggleWsAddonItem(this)">
            <span class="ws-addon-check w-5 h-5 rounded border flex items-center justify-center shrink-0 transition-colors border-border text-transparent text-xs font-bold">✓</span>
            <input type="checkbox" name="addons[]" value="${w.id}" class="sr-only">
            <div class="min-w-0 flex-1">
              <p class="text-sm text-foreground truncate">${w.title}</p>
              <p class="text-[11px] text-muted-foreground">${schDate} · ${pText}</p>
            </div>
          </label>
        `;
      }).join('');
    }

    modal.classList.add('active');
  };

  window.closeWorkshopModal = function() {
    const modal = document.getElementById('workshopModal');
    if (modal) modal.classList.remove('active');
  };

  window.toggleWsAddonItem = function(labelEl) {
    const checkbox = labelEl.querySelector('input[type="checkbox"]');
    const checkSpan = labelEl.querySelector('.ws-addon-check');
    if (!checkbox) return;
    
    setTimeout(() => {
      if (checkbox.checked) {
        labelEl.classList.add('border-[var(--wine)]', 'bg-[var(--wine)]/10');
        if (checkSpan) {
          checkSpan.classList.remove('border-border', 'text-transparent');
          checkSpan.classList.add('border-[var(--wine)]', 'bg-[var(--wine)]', 'text-white');
        }
      } else {
        labelEl.classList.remove('border-[var(--wine)]', 'bg-[var(--wine)]/10');
        if (checkSpan) {
          checkSpan.classList.remove('border-[var(--wine)]', 'bg-[var(--wine)]', 'text-white');
          checkSpan.classList.add('border-border', 'text-transparent');
        }
      }
    }, 10);
  };

  window.handleWorkshopModalSubmit = function(event) {
    if (event) event.preventDefault();
    closeWorkshopModal();
    const successModal = document.getElementById('successModal');
    if (successModal) successModal.classList.add('active');
  };

  // Workshop Details Modal Handlers
  let currentWorkshopDetailData = null;

  window.openWorkshopDetailsModal = function(wsData, event) {
    if (event) event.stopPropagation();

    const modal = document.getElementById('workshopDetailsModal');
    if (!modal) return;

    currentWorkshopDetailData = wsData;

    if (wsData) {
      const img = document.getElementById('wsDetailImg');
      const num = document.getElementById('wsDetailNum');
      const badge = document.getElementById('wsDetailBadge');
      const title = document.getElementById('wsDetailTitle');
      const date = document.getElementById('wsDetailDate');
      const time = document.getElementById('wsDetailTime');
      const fee = document.getElementById('wsDetailFee');
      const capacity = document.getElementById('wsDetailCapacity');
      const remaining = document.getElementById('wsDetailRemaining');
      const desc = document.getElementById('wsDetailDescription');

      if (img) img.src = wsData.image || '';
      if (num) {
        const numVal = wsData.id ? String(wsData.id).padStart(2, '0') : '01';
        num.textContent = numVal;
      }

      if (badge) {
        const isFull = (wsData.status === 'full' || (wsData.remaining_spots !== undefined && wsData.remaining_spots <= 0));
        if (isFull) {
          badge.className = 'inline-flex items-center text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border backdrop-blur-sm text-white/70 border-white/25 bg-white/10';
          badge.textContent = 'Đã đầy';
        } else {
          badge.className = 'inline-flex items-center text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border backdrop-blur-sm text-emerald-300 border-emerald-400/40 bg-emerald-500/20';
          badge.textContent = 'Còn nhận đăng ký';
        }
      }

      if (title) title.textContent = wsData.title || '';

      if (date && time) {
        if (wsData.schedule && wsData.schedule.includes('·')) {
          const parts = wsData.schedule.split('·');
          date.textContent = parts[0].trim();
          time.textContent = parts[1].trim();
        } else {
          date.textContent = wsData.schedule || 'Thứ 6, 14/08/2026';
          time.textContent = '10h – 12h';
        }
      }

      if (fee) {
        fee.textContent = wsData.price_text || (wsData.price ? (Number(wsData.price).toLocaleString('vi-VN') + ' VNĐ') : '1.000.000 VNĐ');
      }

      if (capacity) {
        capacity.textContent = `8 – ${wsData.max_participants || 12} HV`;
      }

      if (remaining) {
        const rem = wsData.remaining_spots !== undefined ? wsData.remaining_spots : (Math.max(0, (wsData.max_participants || 12) - (wsData.current_participants || 0)));
        if (rem <= 0 || wsData.status === 'full') {
          remaining.textContent = 'Đã hết chỗ';
        } else {
          remaining.textContent = `Chỉ còn ${rem} chỗ`;
        }
      }

      if (desc) {
        desc.textContent = wsData.description || 'Ly vang đầu tiên — khởi đầu hành trình cảm nhận rượu vang: lịch sử, phân loại và bước thử nếm cơ bản dành cho người mới bắt đầu.';
      }
    }

    modal.classList.add('active');
  };

  window.closeWorkshopDetailsModal = function() {
    const modal = document.getElementById('workshopDetailsModal');
    if (modal) modal.classList.remove('active');
  };

  window.triggerWsDetailRegister = function(event) {
    if (event) event.stopPropagation();
    closeWorkshopDetailsModal();
    if (currentWorkshopDetailData) {
      openWorkshopReservationModal(currentWorkshopDetailData, event);
    }
  };

  // Workshop 3D Card Flip Handler
  window.toggleWorkshopCardFlip = function(cardEl, event) {
    if (!cardEl) return;
    if (event && event.target && event.target.closest('button, a, input')) {
      return;
    }
    cardEl.classList.toggle('is-flipped');
  };

  // Workshop Topic 3D Coverflow Stack Carousel Handler (Infinite Circular Loop: ... 5 6 1 2 3 ...)
  let currentTopicIndex = 0;
  
  window.updateTopicCoverflow = function() {
    const cards = document.querySelectorAll('.topic-coverflow-card');
    const indicator = document.getElementById('topicIndicator');
    if (!cards.length) return;

    const total = cards.length;
    currentTopicIndex = (currentTopicIndex % total + total) % total;

    cards.forEach((card, idx) => {
      // Calculate circular shortest offset
      let offset = idx - currentTopicIndex;
      if (offset > total / 2) offset -= total;
      if (offset < -total / 2) offset += total;

      const innerFlipCard = card.querySelector('.workshop-flip-card');
      
      if (offset === 0) {
        card.style.transform = 'translateX(-50%) translateX(0px) translateZ(0px) rotateY(0deg) scale(1)';
        card.style.opacity = '1';
        card.style.zIndex = '10';
        card.style.pointerEvents = 'auto';
      } else if (offset === 1) {
        card.style.transform = 'translateX(-50%) translateX(175px) translateZ(-150px) rotateY(-35deg) scale(0.82)';
        card.style.opacity = '0.5';
        card.style.zIndex = '9';
        card.style.pointerEvents = 'auto';
        if (innerFlipCard) innerFlipCard.classList.remove('is-flipped');
      } else if (offset === 2) {
        card.style.transform = 'translateX(-50%) translateX(330px) translateZ(-280px) rotateY(-65deg) scale(0.72)';
        card.style.opacity = '0.25';
        card.style.zIndex = '8';
        card.style.pointerEvents = 'auto';
        if (innerFlipCard) innerFlipCard.classList.remove('is-flipped');
      } else if (offset === -1) {
        card.style.transform = 'translateX(-50%) translateX(-175px) translateZ(-150px) rotateY(35deg) scale(0.82)';
        card.style.opacity = '0.5';
        card.style.zIndex = '9';
        card.style.pointerEvents = 'auto';
        if (innerFlipCard) innerFlipCard.classList.remove('is-flipped');
      } else if (offset === -2) {
        card.style.transform = 'translateX(-50%) translateX(-330px) translateZ(-280px) rotateY(65deg) scale(0.72)';
        card.style.opacity = '0.25';
        card.style.zIndex = '8';
        card.style.pointerEvents = 'auto';
        if (innerFlipCard) innerFlipCard.classList.remove('is-flipped');
      } else {
        const sign = offset < 0 ? 1 : -1;
        const posX = offset * 160;
        card.style.transform = `translateX(-50%) translateX(${posX}px) translateZ(-350px) rotateY(${sign * 70}deg) scale(0.65)`;
        card.style.opacity = '0';
        card.style.zIndex = '0';
        card.style.pointerEvents = 'none';
        if (innerFlipCard) innerFlipCard.classList.remove('is-flipped');
      }
    });

    if (indicator) {
      indicator.textContent = `${currentTopicIndex + 1} / ${total}`;
    }
  };

  window.prevTopicSlide = function() {
    const cards = document.querySelectorAll('.topic-coverflow-card');
    if (!cards.length) return;
    currentTopicIndex = (currentTopicIndex - 1 + cards.length) % cards.length;
    window.updateTopicCoverflow();
  };

  window.nextTopicSlide = function() {
    const cards = document.querySelectorAll('.topic-coverflow-card');
    if (!cards.length) return;
    currentTopicIndex = (currentTopicIndex + 1) % cards.length;
    window.updateTopicCoverflow();
  };

  window.handleTopicCardClick = function(idx, cardEl, event) {
    if (event && event.target && event.target.closest('button, a, input')) {
      return;
    }
    if (idx !== currentTopicIndex) {
      currentTopicIndex = idx;
      window.updateTopicCoverflow();
    } else {
      window.toggleWorkshopCardFlip(cardEl, event);
    }
  };

  setTimeout(() => {
    window.updateTopicCoverflow();
  }, 100);

  document.querySelectorAll('[data-modal-target]').forEach(btn => {
    btn.addEventListener('click', () => {
      const targetId = btn.getAttribute('data-modal-target');
      const modal = document.getElementById(targetId);
      if (modal) modal.classList.add('active');
    });
  });

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
