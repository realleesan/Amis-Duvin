<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow, noarchive">
  <title><?= htmlspecialchars($title ?? 'Admin CMS — Amis Duvin') ?></title>
  <link rel="icon" type="image/png" href="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png">
  <link rel="apple-touch-icon" href="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/global.css">
  <script>
    (function() {
      try {
        const saved = localStorage.getItem('adv-theme');
        if (saved === 'light') {
          document.documentElement.classList.remove('dark');
        } else {
          document.documentElement.classList.add('dark');
        }
      } catch (e) {}

      var origWarn = console.warn;
      console.warn = function () {
        if (arguments[0] && typeof arguments[0] === 'string' && arguments[0].indexOf('cdn.tailwindcss.com') !== -1) return;
        origWarn.apply(console, arguments);
      };
    })();
  </script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          borderRadius: {
            lg: 'var(--radius)',
            md: 'calc(var(--radius) - 2px)',
            sm: 'calc(var(--radius) - 4px)'
          },
          colors: {
            background: 'hsl(var(--background))',
            foreground: 'hsl(var(--foreground))',
            burgundy: '#b20225',
            champagneGold: '#c2a565',
            wine: '#b20225',
            gold: '#a07f3e',
            ivoryWhite: '#F6F5F3',
            warmBeige: '#ECEAE6',
            charcoalBlack: '#23201E',
            card: {
              DEFAULT: 'hsl(var(--card))',
              foreground: 'hsl(var(--card-foreground))'
            },
            popover: {
              DEFAULT: 'hsl(var(--popover))',
              foreground: 'hsl(var(--popover-foreground))'
            },
            primary: {
              DEFAULT: 'hsl(var(--primary))',
              foreground: 'hsl(var(--primary-foreground))'
            },
            secondary: {
              DEFAULT: 'hsl(var(--secondary))',
              foreground: 'hsl(var(--secondary-foreground))'
            },
            muted: {
              DEFAULT: 'hsl(var(--muted))',
              foreground: 'hsl(var(--muted-foreground))'
            },
            accent: {
              DEFAULT: 'hsl(var(--accent))',
              foreground: 'hsl(var(--accent-foreground))'
            },
            destructive: {
              DEFAULT: 'hsl(var(--destructive))',
              foreground: 'hsl(var(--destructive-foreground))'
            },
            border: 'hsl(var(--border))',
            input: 'hsl(var(--input))',
            ring: 'hsl(var(--ring))'
          },
          fontFamily: {
            heading: ['Playfair Display', 'Georgia', 'serif'],
            serifDisplay: ['Playfair Display', 'Georgia', 'serif'],
            sans: ['Montserrat', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            body: ['Montserrat', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            signature: ['Playfair Display', 'Georgia', 'serif'],
            playfair: ['Playfair Display', 'Georgia', 'serif'],
            montserrat: ['Montserrat', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            cormorant: ['Playfair Display', 'Georgia', 'serif'],
            manrope: ['Montserrat', 'ui-sans-serif', 'system-ui', 'sans-serif']
          }
        }
      }
    };
  </script>
</head>
<body class="bg-background text-foreground antialiased h-screen flex overflow-hidden">
  <!-- Mobile Environment Unsupported Overlay (Blocks Admin access on mobile screens & landscape orientation) -->
  <style>
    @media (max-width: 900px), (max-width: 1024px) and (pointer: coarse), (max-height: 500px) and (pointer: coarse) {
      #adminMobileBlockOverlay {
        display: flex !important;
      }
    }
  </style>

  <div id="adminMobileBlockOverlay" class="fixed inset-0 z-[999999] bg-[#0c090a] text-foreground hidden flex-col items-center justify-center p-6 text-center overflow-y-auto">
    <div class="max-w-md w-full p-6 sm:p-8 rounded-sm border border-[var(--gold)]/30 bg-[#140f11] shadow-2xl space-y-5 relative overflow-hidden my-auto">
      <!-- Glow background decoration -->
      <div class="absolute -top-24 -left-24 w-48 h-48 bg-[var(--wine)]/20 rounded-full blur-3xl pointer-events-none"></div>
      <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-[var(--gold)]/10 rounded-full blur-3xl pointer-events-none"></div>

      <!-- Icon & Logo -->
      <div class="flex flex-col items-center space-y-2 relative z-10">
        <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-[var(--wine)]/20 border border-[var(--gold)]/40 flex items-center justify-center text-[var(--gold)] shadow-inner">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-monitor-off"><path d="M17 17H4a2 2 0 0 1-2-2V5c0-1.5 1-2 2-2h9"></path><line x1="2" x2="22" y1="22" y2="2"></line><path d="M8 21h8"></path><path d="M12 17v4"></path><path d="M22 15V8c0-1-.5-1.7-1.3-2"></path></svg>
        </div>
        <div class="font-serif font-bold text-lg sm:text-xl text-[var(--gold)] tracking-wide uppercase">Amis Duvin Admin</div>
      </div>

      <!-- Title & Message -->
      <div class="space-y-2.5 relative z-10">
        <h2 class="font-heading text-lg sm:text-2xl text-foreground font-semibold">Môi trường Điện thoại Không hỗ trợ Admin</h2>
        <p class="text-xs sm:text-sm text-muted-foreground leading-relaxed">
          Hệ thống Quản trị CMS Amis Duvin chứa các bảng dữ liệu chuyên sâu và bộ công cụ đòi hỏi màn hình rộng để đảm bảo trải nghiệm quản lý tối ưu nhất.
        </p>
        <p class="text-[11px] sm:text-xs text-[var(--gold)]/90 font-medium italic">
          Vui lòng truy cập trên Máy tính cá nhân (PC / Laptop) để sử dụng trang quản trị.
        </p>
      </div>

      <!-- Action Button -->
      <div class="pt-1 relative z-10">
        <a href="/" class="btn-wine w-full py-3 rounded-sm text-xs font-semibold uppercase tracking-widest inline-flex items-center justify-center gap-2 shadow-lg">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left"><path d="m12 19-7-7 7-7"></path><path d="M19 12H5"></path></svg>
          <span>Quay lại trang Landing Page</span>
        </a>
      </div>
    </div>
  </div>

  <script>
    (function enforceAdminDesktopOnly() {
      function checkMobile() {
        var overlay = document.getElementById('adminMobileBlockOverlay');
        if (!overlay) return;

        var isMobileUA = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        var isCoarse = window.matchMedia && window.matchMedia('(pointer: coarse)').matches;
        var isSmallWidth = window.innerWidth <= 960;
        var isSmallHeight = window.innerHeight <= 520;

        if (isMobileUA || (isCoarse && isSmallWidth) || (isCoarse && isSmallHeight) || isSmallWidth) {
          overlay.style.setProperty('display', 'flex', 'important');
        } else {
          overlay.style.setProperty('display', 'none', 'important');
        }
      }

      window.addEventListener('DOMContentLoaded', checkMobile);
      window.addEventListener('resize', checkMobile);
      window.addEventListener('orientationchange', checkMobile);
      checkMobile();
    })();
  </script>

  <!-- Modular Admin Sidebar -->
  <?php require __DIR__ . '/admin_sidebar.php'; ?>

  <!-- Main Content Area -->
  <div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
    <!-- Modular Admin Header -->
    <?php require __DIR__ . '/admin_header.php'; ?>

    <!-- Main Content Body -->
    <main class="flex-1 p-6 sm:p-8 overflow-y-auto">
      <?php if (!empty($message)): ?>
        <div id="adminFlashAlert" class="mb-6 p-4 rounded-sm bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm flex items-center justify-between gap-3 shadow-sm transition-all duration-300">
          <div class="flex items-center gap-2 min-w-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle-2 w-4 h-4 shrink-0"><circle cx="12" cy="12" r="10"></circle><path d="m9 12 2 2 4-4"></path></svg>
            <span class="truncate"><?= htmlspecialchars($message) ?></span>
          </div>
          <button type="button" onclick="dismissAdminFlashAlert()" class="p-1 rounded text-emerald-400/70 hover:text-emerald-400 hover:bg-emerald-500/15 transition-colors" title="Đóng thông báo">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-4 h-4"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
          </button>
        </div>
      <?php endif; ?>

      <?php if (!empty($error)): ?>
        <div id="adminFlashAlert" class="mb-6 p-4 rounded-sm bg-rose-500/10 border border-rose-500/30 text-rose-400 text-sm flex items-center justify-between gap-3 shadow-sm transition-all duration-300">
          <div class="flex items-center gap-2 min-w-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle w-4 h-4 shrink-0"><circle cx="12" cy="12" r="10"></circle><line x1="12" x2="12" y1="8" y2="12"></line><line x1="12" x2="12.01" y1="16" y2="16"></line></svg>
            <span class="truncate"><?= htmlspecialchars($error) ?></span>
          </div>
          <button type="button" onclick="dismissAdminFlashAlert()" class="p-1 rounded text-rose-400/70 hover:text-rose-400 hover:bg-rose-500/15 transition-colors" title="Đóng thông báo">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-4 h-4"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
          </button>
        </div>
      <?php endif; ?>

      <?= $adminContent ?? '' ?>
    </main>
  </div>

  <!-- Global Admin Image Lightbox Modal -->
  <div id="adminImageLightbox" class="fixed inset-0 z-[99999] hidden items-center justify-center p-4 bg-black/80 backdrop-blur-sm transition-all duration-300 opacity-0 cursor-zoom-out" onclick="closeAdminImageLightbox(event)">
    <div class="relative max-w-4xl max-h-[90vh] flex flex-col items-center justify-center pointer-events-auto" onclick="event.stopPropagation()">
      <button type="button" onclick="closeAdminImageLightbox(event)" class="absolute -top-3 -right-3 sm:-top-4 sm:-right-4 w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-neutral-900/90 hover:bg-rose-600 text-white flex items-center justify-center border border-white/20 shadow-2xl transition-all z-20 hover:scale-110 cursor-pointer" title="Đóng (ESC)">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
      </button>
      <img id="adminLightboxImg" src="" alt="Full Preview" class="max-w-full max-h-[85vh] object-contain rounded-md shadow-2xl border border-white/10 select-none cursor-default">
    </div>
  </div>

  <script src="/assets/js/global.js"></script>
  <script>
    function dismissAdminFlashAlert() {
      const alertEl = document.getElementById('adminFlashAlert');
      if (alertEl) {
        alertEl.style.opacity = '0';
        alertEl.style.transform = 'translateY(-6px)';
        setTimeout(() => alertEl.remove(), 300);
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      const alertEl = document.getElementById('adminFlashAlert');
      if (alertEl) {
        setTimeout(dismissAdminFlashAlert, 4000);
      }

      // Auto clean URL params 'msg' and 'err' for clean URL & prevent duplicate alerts on refresh
      try {
        const url = new URL(window.location.href);
        if (url.searchParams.has('msg') || url.searchParams.has('err')) {
          url.searchParams.delete('msg');
          url.searchParams.delete('err');
          window.history.replaceState({}, document.title, url.toString());
        }
      } catch(e) {}
    });

    function openAdminImageLightbox(src) {
      if (!src || src.trim() === '') return;
      const modal = document.getElementById('adminImageLightbox');
      const img = document.getElementById('adminLightboxImg');
      if (!modal || !img) return;

      img.src = src;
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      setTimeout(() => {
        modal.classList.remove('opacity-0');
        modal.classList.add('opacity-100');
      }, 10);
    }

    function closeAdminImageLightbox(e) {
      if (e) e.stopPropagation();
      const modal = document.getElementById('adminImageLightbox');
      if (!modal) return;
      modal.classList.remove('opacity-100');
      modal.classList.add('opacity-0');
      setTimeout(() => {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
      }, 200);
    }

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeAdminImageLightbox();
      }
    });

    function updateImagePreview(inputEl, previewImgId) {
      const previewImg = document.getElementById(previewImgId);
      if (!previewImg) return;
      const placeholder = previewImg.nextElementSibling;
      const val = (inputEl.value || '').trim();

      if (val) {
        previewImg.src = val;
        previewImg.classList.remove('hidden');
        if (placeholder && placeholder.classList.contains('preview-placeholder')) {
          placeholder.classList.add('hidden');
        }
      } else {
        previewImg.src = '';
        previewImg.classList.add('hidden');
        if (placeholder && placeholder.classList.contains('preview-placeholder')) {
          placeholder.classList.remove('hidden');
        }
      }
    }

    async function handleAdminImageUpload(fileInput, targetUrlInputId, previewImgId) {
      const file = fileInput.files ? fileInput.files[0] : null;
      if (!file) return;

      const parentLabel = fileInput.closest('label');
      const statusSpan = parentLabel ? parentLabel.parentElement.querySelector('.upload-status') : null;
      const targetInput = document.getElementById(targetUrlInputId);

      if (statusSpan) {
        statusSpan.textContent = 'Đang tải ảnh...';
        statusSpan.className = 'upload-status text-[11px] text-muted-foreground italic';
      }

      const formData = new FormData();
      formData.append('image', file);

      try {
        const res = await fetch('<?= admin_url('api/upload-image') ?>', {
          method: 'POST',
          body: formData
        });

        const rawText = await res.text();
        let data;
        try {
          data = JSON.parse(rawText);
        } catch (parseErr) {
          console.error('Server upload response is non-JSON HTML:', rawText);
          throw new Error('Máy chủ phản hồi không đúng định dạng JSON.');
        }

        if (res.ok && data.success) {
          if (targetInput) {
            targetInput.value = data.url;
            updateImagePreview(targetInput, previewImgId);
          }
          if (statusSpan) {
            statusSpan.textContent = '✓ Tải lên thành công!';
            statusSpan.className = 'upload-status text-[11px] text-emerald-400 font-medium';
            setTimeout(() => { statusSpan.textContent = ''; }, 3000);
          }
        } else {
          alert('⚠️ Lỗi: ' + (data.message || 'Lỗi khi tải ảnh lên.'));
          if (statusSpan) statusSpan.textContent = '';
        }
      } catch (err) {
        console.error('Image upload error:', err);
        alert('⚠️ Lỗi khi tải ảnh lên: ' + err.message);
        if (statusSpan) statusSpan.textContent = '';
      } finally {
        fileInput.value = '';
      }
    }
  </script>

  <!-- Global Flatpickr Library -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>
</body>
</html>
