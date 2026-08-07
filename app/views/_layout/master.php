<!DOCTYPE html>
<html lang="vi" class="dark scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Amis du Vin — Rượu vang và những người bạn') ?></title>
  <meta name="description" content="Amis du Vin — Không gian kết nối văn hóa, nghệ thuật và ẩm thực rượu vang. Workshop rượu vang tinh tế, đầy cảm hứng tại Hà Nội.">
  <link rel="icon" type="image/png" href="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png">
  <link rel="apple-touch-icon" href="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Inter:wght@300;400;500;600;700&family=Sacramento&display=swap" rel="stylesheet">
  
  <script>
    (function () {
      try {
        var theme = localStorage.getItem("adv-theme");
        if (theme === "light") {
          document.documentElement.classList.remove("dark");
        } else {
          document.documentElement.classList.add("dark");
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
            body: ['var(--font-body)'],
            display: ['var(--font-heading)'],
            serif: ['var(--font-serif)'],
            signature: ['var(--font-signature)']
          }
        }
      }
    }
  </script>
  <link rel="stylesheet" href="/assets/css/global.css">
</head>
<body class="bg-background text-foreground antialiased min-h-screen flex flex-col">
  <?php require __DIR__ . '/header.php'; ?>

  <main class="flex-1">
    <?= $content ?>
  </main>

  <?php require __DIR__ . '/footer.php'; ?>

  <!-- Modals -->
  <?php require __DIR__ . '/../modals/age_verification.php'; ?>
  <?php require __DIR__ . '/../modals/sommelier_modal.php'; ?>
  <?php require __DIR__ . '/../modals/workshop_modal.php'; ?>
  <?php require __DIR__ . '/../modals/success_modal.php'; ?>

  <!-- Scripts -->
  <script src="/assets/js/global.js"></script>
  <script src="/assets/js/booking.js"></script>
  <script src="/assets/js/workshop.js"></script>
</body>
</html>
