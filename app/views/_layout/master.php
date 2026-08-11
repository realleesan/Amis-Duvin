<!DOCTYPE html>
<html lang="vi" class="dark scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
    $metaTitle = htmlspecialchars($seo['meta_title'] ?? $title ?? 'Amis Duvin — Rượu vang và những người bạn');
    $metaDesc = htmlspecialchars($seo['meta_description'] ?? 'Amis Duvin — Không gian Tiệc riêng tư & Tinh hoa ẩm thực Rượu vang tại Hà Nội.');
    $metaKey = htmlspecialchars($seo['meta_keywords'] ?? 'Amis Duvin, Rượu vang Hà Nội, Tiệc riêng tư, Food and Wine Pairing');
    $ogImg = htmlspecialchars($seo['og_image'] ?? 'https://media.base44.com/images/public/6a623336361c483b3f15558c/1d3f75363_generated_b7d85214.png/v1/fill/w_1171,h_927,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/1d3f75363_generated_b7d85214.webp');
    $canonicalUrl = htmlspecialchars($seo['canonical_url'] ?? 'https://amis.duvin.vn/');
  ?>
  <title><?= $metaTitle ?></title>
  <meta name="description" content="<?= $metaDesc ?>">
  <meta name="keywords" content="<?= $metaKey ?>">
  <link rel="canonical" href="<?= $canonicalUrl ?>">
  
  <!-- Open Graph / Zalo / Facebook Meta Tags -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= $canonicalUrl ?>">
  <meta property="og:title" content="<?= $metaTitle ?>">
  <meta property="og:description" content="<?= $metaDesc ?>">
  <meta property="og:image" content="<?= $ogImg ?>">

  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= $metaTitle ?>">
  <meta name="twitter:description" content="<?= $metaDesc ?>">
  <meta name="twitter:image" content="<?= $ogImg ?>">

  <!-- JSON-LD Structured Data Schemas (Google Rich Snippets) -->
  <?php
    $schemaGraph = [
      '@context' => 'https://schema.org',
      '@graph' => [
        [
          '@type' => 'Restaurant',
          '@id' => 'https://amis.duvin.vn/#restaurant',
          'name' => 'Amis Duvin',
          'image' => $seo['og_image'] ?? $ogImg,
          'url' => 'https://amis.duvin.vn/',
          'telephone' => '091 968 65 40',
          'priceRange' => '1.500.000đ - 5.000.000đ',
          'servesCuisine' => ['Wine Pairing', 'Fine Dining', 'European Cuisine'],
          'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => '58B Võ Văn Dũng, Phường Ô Chợ Dừa',
            'addressLocality' => 'Quận Đống Đa',
            'addressRegion' => 'Hà Nội',
            'postalCode' => '100000',
            'addressCountry' => 'VN'
          ],
          'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => 21.0167,
            'longitude' => 105.8239
          ],
          'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            'opens' => '10:00',
            'closes' => '23:00'
          ]
        ],
        [
          '@type' => 'Organization',
          '@id' => 'https://amis.duvin.vn/#organization',
          'name' => 'Amis Duvin',
          'url' => 'https://amis.duvin.vn/',
          'logo' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png',
          'parentOrganization' => [
            '@type' => 'Organization',
            'name' => 'Hệ sinh thái Vang Huy Phong'
          ]
        ]
      ]
    ];

    if (!empty($faqs) && is_array($faqs)) {
      $faqSchemaItems = [];
      foreach ($faqs as $f) {
        $faqSchemaItems[] = [
          '@type' => 'Question',
          'name' => $f['question'],
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => $f['answer']
          ]
        ];
      }
      $schemaGraph['@graph'][] = [
        '@type' => 'FAQPage',
        '@id' => 'https://amis.duvin.vn/#faqpage',
        'mainEntity' => $faqSchemaItems
      ];
    }

    $jsonLdString = json_encode($schemaGraph, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    echo '<script type="application/ld+json">' . "\n" . $jsonLdString . "\n" . '</script>' . "\n";
  ?>

  <link rel="icon" type="image/png" href="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png">
  <link rel="apple-touch-icon" href="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://media.base44.com" crossorigin>
  <link rel="dns-prefetch" href="https://media.base44.com">
  <?php if (!empty($hero['bg_image'])): ?>
    <link rel="preload" as="image" href="<?= htmlspecialchars($hero['bg_image']) ?>">
  <?php endif; ?>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600;1,700&display=swap" rel="stylesheet">
  
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
            burgundy: '#B62025',
            champagneGold: '#C9A96A',
            ivoryWhite: '#F7F4EF',
            warmBeige: '#DCCDB8',
            charcoalBlack: '#222222',
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
            body: ['Montserrat', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            display: ['Playfair Display', 'Georgia', 'serif'],
            serif: ['Playfair Display', 'Georgia', 'serif'],
            signature: ['Playfair Display', 'Georgia', 'serif'],
            playfair: ['Playfair Display', 'Georgia', 'serif'],
            montserrat: ['Montserrat', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            cormorant: ['Playfair Display', 'Georgia', 'serif'],
            manrope: ['Montserrat', 'ui-sans-serif', 'system-ui', 'sans-serif']
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
