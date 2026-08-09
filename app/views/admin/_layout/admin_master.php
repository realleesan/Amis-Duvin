<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow, noarchive">
  <title><?= htmlspecialchars($title ?? 'Admin CMS — Amis du Vin') ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            heading: ['var(--font-heading)'],
            serifDisplay: ['var(--font-serif)'],
            sans: ['var(--font-body)'],
            signature: ['var(--font-signature)']
          }
        }
      }
    };
  </script>
</head>
<body class="bg-background text-foreground antialiased h-screen flex overflow-hidden">
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
  </script>
</body>
</html>
