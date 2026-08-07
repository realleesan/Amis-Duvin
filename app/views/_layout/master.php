<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Amis du Vin') ?></title>
  <meta name="description" content="Amis du Vin — Đơn vị tổ chức tiệc thử rượu vang cá nhân hóa cao cấp & Workshops nếm thử chuyên sâu cùng Chuyên gia Sommelier.">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            border: 'var(--border)',
            input: 'var(--border)',
            ring: 'var(--wine)',
            background: 'var(--background)',
            foreground: 'var(--foreground)',
            card: {
              DEFAULT: 'var(--card)',
              foreground: 'var(--card-foreground)',
            },
            muted: {
              DEFAULT: 'var(--muted)',
              foreground: 'var(--muted-foreground)',
            },
            popover: {
              DEFAULT: 'var(--popover)',
              foreground: 'var(--popover-foreground)',
            },
          }
        }
      }
    }
  </script>
  <link rel="stylesheet" href="/assets/css/global.css">
</head>
<body class="bg-[#0f0d0e] text-[#f4ede4] antialiased">
  <?php require __DIR__ . '/header.php'; ?>

  <main>
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
