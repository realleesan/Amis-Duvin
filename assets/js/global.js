document.addEventListener('DOMContentLoaded', () => {
  // 1. Header scroll effect (Hardware-accelerated & Debounced for Macbook/Safari)
  const header = document.getElementById('mainHeader');
  const themeToggleBtns = document.querySelectorAll('.theme-toggle-btn');
  let lastHeaderScrolledState = null;
  let lastScrollTopBtnState = null;
  let scrollTicking = false;

  function updateHeaderScroll() {
    if (!header) return;
    const isScrolled = window.scrollY > 40;
    if (isScrolled === lastHeaderScrolledState) return;
    lastHeaderScrolledState = isScrolled;

    header.classList.toggle('scrolled', isScrolled);
    header.classList.toggle('glass', isScrolled);
    header.classList.toggle('bg-transparent', !isScrolled);
    header.classList.toggle('py-5', !isScrolled);
  }

  // Scroll To Top functionality
  window.scrollToTop = function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  function handleScrollToTopButton() {
    const btn = document.getElementById('btnScrollToTop');
    if (!btn) return;
    const isVisible = window.scrollY > 300;
    if (isVisible === lastScrollTopBtnState) return;
    lastScrollTopBtnState = isVisible;

    if (isVisible) {
      btn.classList.remove('opacity-0', 'translate-y-6', 'pointer-events-none');
      btn.classList.add('opacity-100', 'translate-y-0');
    } else {
      btn.classList.add('opacity-0', 'translate-y-6', 'pointer-events-none');
      btn.classList.remove('opacity-100', 'translate-y-0');
    }
  }

  window.addEventListener('scroll', () => {
    if (!scrollTicking) {
      window.requestAnimationFrame(() => {
        updateHeaderScroll();
        handleScrollToTopButton();
        scrollTicking = false;
      });
      scrollTicking = true;
    }
  }, { passive: true });

  updateHeaderScroll();
  handleScrollToTopButton();

  // 2. Dark / Light Theme Toggle with smooth transition guard
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
      document.body.classList.add('theme-transitioning');
      const isDark = document.documentElement.classList.toggle('dark');
      try {
        localStorage.setItem('adv-theme', isDark ? 'dark' : 'light');
      } catch (e) {}
      syncThemeUI();
      setTimeout(() => {
        document.body.classList.remove('theme-transitioning');
      }, 450);
    });
  });

  syncThemeUI();

  // 3. Module 0.1 & 0.2: Age Verification & Welcome Popup
  const ageModal = document.getElementById('ageVerificationModal');
  const welcomeModal = document.getElementById('welcomeModal');
  const btnAgeYes = document.getElementById('btnAgeYes');
  const btnAgeNo = document.getElementById('btnAgeNo');

  function setCookie(name, value, days) {
    let expires = "";
    if (days) {
      const date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/; SameSite=Lax";
  }

  function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) === ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  const isOver18 = getCookie('is_over_18');

  if (isOver18 === 'false' && window.location.pathname !== '/under-18') {
    window.location.href = '/under-18';
  } else if (!isOver18 && ageModal && window.location.pathname !== '/under-18') {
    ageModal.classList.add('active');
  }

  let welcomeInterval = null;

  window.closeWelcomeModal = function() {
    if (welcomeInterval) clearInterval(welcomeInterval);
    if (welcomeModal) {
      welcomeModal.classList.add('animate-fade-out');
      setTimeout(() => {
        welcomeModal.classList.remove('active', 'animate-fade-out');
      }, 480);
    }
  };

  function startWelcomeCountdown() {
    if (!welcomeModal) return;
    welcomeModal.classList.add('active');

    let secondsLeft = 3;

    welcomeInterval = setInterval(() => {
      secondsLeft--;
      if (secondsLeft <= 0) {
        clearInterval(welcomeInterval);
        window.closeWelcomeModal();
      }
    }, 1000);
  }

  if (btnAgeYes) {
    btnAgeYes.addEventListener('click', () => {
      setCookie('is_over_18', 'true', 30);
      if (ageModal) ageModal.classList.remove('active');
      startWelcomeCountdown();
    });
  }

  if (btnAgeNo) {
    btnAgeNo.addEventListener('click', () => {
      // Lock for 15 minutes (15 / 1440 days)
      setCookie('is_over_18', 'false', 15 / 1440);
      window.location.href = '/under-18';
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

  // 5. FAQ Accordion (Smooth Expand & Collapse)
  document.querySelectorAll('.faq-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.faq-item');
      if (!item) return;
      const isOpen = item.classList.contains('active');

      document.querySelectorAll('.faq-item').forEach(other => {
        other.classList.remove('active');
        const otherBtn = other.querySelector('.faq-toggle');
        if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
      });

      if (!isOpen) {
        item.classList.add('active');
        btn.setAttribute('aria-expanded', 'true');
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

      const sectionLabels = {
        'khai_vi': 'Khai vị',
        'mon_chinh': 'Món chính',
        'trang_mieng': 'Tráng miệng'
      };

      if (Array.isArray(menuItems)) {
        const li = document.createElement('li');
        li.className = "grid grid-cols-12 gap-3 items-start py-3 border-b border-border/40 text-xs sm:text-sm last:border-0";
        let courseStr = (menuItems[0]?.course || '').replace(/^Khởi vị/g, 'Khai vị');
        li.innerHTML = `
          <div class="col-span-7 sm:col-span-8 text-foreground/90 font-medium leading-relaxed">
            ${courseStr}
          </div>
          <div class="col-span-5 sm:col-span-4 text-[var(--wine)] font-semibold text-right leading-relaxed">
            ${menuItems[0]?.wine || ''}
          </div>
        `;
        menuContainer.appendChild(li);
      } else if (typeof menuItems === 'object' && menuItems !== null) {
        const sectionOrder = ['khai_vi', 'mon_chinh', 'trang_mieng'];
        for (const secKey of sectionOrder) {
          const section = menuItems[secKey];
          if (!section) continue;
          const items = section.items || [];
          const wines = section.wines || [];
          if (!items.length && !wines.length) continue;

          const header = document.createElement('li');
          header.className = "text-[11px] uppercase tracking-[0.25em] text-[var(--gold)] font-bold pt-4 pb-1.5 border-t border-champagneGold/30 first:border-t-0 flex items-center gap-2";
          header.innerHTML = `<span class="w-1.5 h-1.5 rounded-full bg-[var(--gold)] shrink-0"></span>${sectionLabels[secKey] || secKey}`;
          menuContainer.appendChild(header);

          const maxLen = Math.max(items.length, wines.length);
          for (let i = 0; i < maxLen; i++) {
            const li = document.createElement('li');
            li.className = "grid grid-cols-12 gap-3 items-start py-2.5 pl-4 border-b border-border/30 text-xs sm:text-sm last:border-0 relative";
            const itemText = items[i] || '';
            const wineText = wines[i] || '';
            li.innerHTML = `
              <div class="col-span-7 sm:col-span-8 text-foreground/90 font-medium leading-relaxed relative">
                <span class="absolute -left-4 top-[0.65rem] w-1 h-1 rounded-full bg-[var(--gold)]/60 shrink-0"></span>
                ${itemText}
              </div>
              <div class="col-span-5 sm:col-span-4 text-[var(--wine)] font-semibold text-right leading-relaxed">
                ${wineText}
              </div>
            `;
            menuContainer.appendChild(li);
          }
        }
      }

      if (!menuContainer.children.length) {
        const empty = document.createElement('li');
        empty.className = "text-xs text-muted-foreground italic py-3 text-center";
        empty.textContent = 'Chưa cập nhật thực đơn';
        menuContainer.appendChild(empty);
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

  window.closeWorkshopSuccessModal = function() {
    const modal = document.getElementById('workshopSuccessModal');
    if (modal) modal.classList.remove('active');
  };

  window.openWorkshopSuccessModal = function() {
    const modal = document.getElementById('workshopSuccessModal');
    if (modal) modal.classList.add('active');
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

  window.handleWorkshopModalSubmit = async function(event) {
    if (event) event.preventDefault();
    const form = document.getElementById('workshopModalForm');
    if (!form) return;

    const btnSubmit = document.getElementById('btnWsModalSubmit');
    if (btnSubmit) {
      btnSubmit.disabled = true;
      btnSubmit.textContent = 'Đang gửi đăng ký...';
    }

    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());
    payload.addons = formData.getAll('addons[]');

    try {
      const res = await fetch('/api/workshop-register', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });

      const data = await res.json();
      if (res.ok && data.success) {
        form.reset();
        closeWorkshopModal();
        const workshopSuccessModal = document.getElementById('workshopSuccessModal');
        if (workshopSuccessModal) workshopSuccessModal.classList.add('active');
      } else {
        alert(data.message || 'Vui lòng kiểm tra lại họ tên và số điện thoại.');
      }
    } catch (err) {
      console.error('Workshop register error:', err);
      alert('Đã xảy ra lỗi kết nối. Vui lòng thử lại!');
    } finally {
      if (btnSubmit) {
        btnSubmit.disabled = false;
        btnSubmit.textContent = 'Giữ chỗ';
      }
    }
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
          badge.className = 'inline-flex items-center text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-sm border backdrop-blur-sm text-white/70 border-white/20 bg-black/40';
          badge.textContent = 'Hết chỗ';
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

  // Touch Swipe Gesture Support for Topic Coverflow Track ("Các workshop khác") on mobile & small devices
  const topicTrack = document.getElementById('topicCoverflowTrack');
  if (topicTrack) {
    let touchStartX = 0;
    let touchStartY = 0;
    let touchEndX = 0;
    let touchEndY = 0;

    topicTrack.addEventListener('touchstart', (e) => {
      if (e.touches && e.touches.length > 0) {
        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
      }
    }, { passive: true });

    topicTrack.addEventListener('touchend', (e) => {
      if (e.changedTouches && e.changedTouches.length > 0) {
        touchEndX = e.changedTouches[0].clientX;
        touchEndY = e.changedTouches[0].clientY;

        const diffX = touchEndX - touchStartX;
        const diffY = touchEndY - touchStartY;

        if (Math.abs(diffX) > 35 && Math.abs(diffX) > Math.abs(diffY)) {
          if (diffX < 0) {
            if (typeof window.nextTopicSlide === 'function') window.nextTopicSlide();
          } else {
            if (typeof window.prevTopicSlide === 'function') window.prevTopicSlide();
          }
        }
      }
    }, { passive: true });
  }

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

  // 9. Analytics Click Tracking Beacon
  window.trackClickBeacon = function(key, label) {
    try {
      const payload = new FormData();
      payload.append('element_key', key);
      payload.append('element_label', label);
      payload.append('path', window.location.pathname);
      if (navigator.sendBeacon) {
        navigator.sendBeacon('/api/track-click', payload);
      } else {
        fetch('/api/track-click', { method: 'POST', body: payload });
      }
    } catch(e){}
  };

  document.addEventListener('click', (e) => {
    const trackTarget = e.target.closest('[data-track-key]');
    if (trackTarget) {
      const key = trackTarget.getAttribute('data-track-key');
      const label = trackTarget.getAttribute('data-track-label') || trackTarget.innerText.trim();
      window.trackClickBeacon(key, label);
      return;
    }

    const btn = e.target.closest('button, a');
    if (!btn) return;
    const txt = (btn.innerText || '').trim();
    const href = btn.getAttribute('href') || '';

    if (txt.includes('Đặt tiệc ngay') || txt.includes('Gửi thông tin đặt tiệc')) {
      window.trackClickBeacon('btn_booking_cta', txt || 'Đặt tiệc ngay');
    } else if (txt.includes('Đăng ký Workshop') || txt.includes('Tham gia Workshop')) {
      window.trackClickBeacon('btn_workshop_cta', txt || 'Đăng ký Workshop');
    } else if (href.includes('tel:') || txt.includes('090') || txt.includes('Hotline')) {
      window.trackClickBeacon('btn_hotline', txt || 'Gọi Hotline CSKH');
    } else if (href.includes('zalo.me') || txt.includes('Zalo')) {
      window.trackClickBeacon('btn_zalo', txt || 'Liên hệ Zalo');
    } else if (txt.includes('Xem thực đơn') || txt.includes('Gói tiệc')) {
      window.trackClickBeacon('btn_pairing_card', txt || 'Xem thực đơn gói tiệc');
    } else if (txt.includes('Bằng chứng nhận Sommelier') || btn.closest('#certLightboxModal')) {
      window.trackClickBeacon('btn_sommelier_cert', 'Xem Chứng nhận Sommelier');
    }
  });
});

function scrollToId(id) {
  const el = document.getElementById(id);
  if (el) el.scrollIntoView({ behavior: 'smooth' });
}
