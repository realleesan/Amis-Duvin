<!DOCTYPE html>
<html lang="vi" class="dark scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Amis du Vin — Rượu vang và những người bạn') ?></title>
  <meta name="description" content="Amis du Vin — Không gian Tiệc riêng tư & Tinh hoa ẩm thực Rượu vang tại Hà Nội. Trải nghiệm Food & Wine Pairing và Workshop rượu vang tinh tế.">
  <meta name="keywords" content="Amis du Vin, Rượu vang Hà Nội, Tiệc riêng tư, Food and Wine Pairing, Sommelier Alex Thịnh, Workshop rượu vang">
  
  <!-- Open Graph / Zalo / Facebook Meta Tags -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://amis.duvin.vn/">
  <meta property="og:title" content="<?= htmlspecialchars($title ?? 'Amis du Vin — Rượu vang và những người bạn') ?>">
  <meta property="og:description" content="Trải nghiệm tiệc riêng tư kết hợp ẩm thực và rượu vang tinh tế, trọn vẹn văn hoá vang tại Hà Nội.">
  <meta property="og:image" content="https://media.base44.com/images/public/6a623336361c483b3f15558c/1d3f75363_generated_b7d85214.png/v1/fill/w_1171,h_927,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/1d3f75363_generated_b7d85214.webp">

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
  <?php require __DIR__ . '/../modals/welcome_popup.php'; ?>
  <?php require __DIR__ . '/../modals/sommelier_modal.php'; ?>
  <?php require __DIR__ . '/../modals/pairing_modal.php'; ?>
  <?php require __DIR__ . '/../modals/workshop_modal.php'; ?>
  <?php require __DIR__ . '/../modals/workshop_details_modal.php'; ?>
  <?php require __DIR__ . '/../modals/privacy_policy_modal.php'; ?>
  <?php require __DIR__ . '/../modals/refund_policy_modal.php'; ?>
  <?php require __DIR__ . '/../modals/success_modal.php'; ?>
  <?php require __DIR__ . '/../modals/workshop_success_modal.php'; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>
  <script src="/assets/js/global.js"></script>
  <script src="/assets/js/booking.js"></script>
  <script src="/assets/js/workshop.js"></script>
</body>
</html>
