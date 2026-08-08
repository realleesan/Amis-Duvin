<?php
if (empty($pairings)) {
    $pairings = [
        [
            'id' => 1,
            'slug' => 'signature-pairing',
            'title' => 'Signature Pairing',
            'level' => 'Standard Level',
            'subtitle' => 'Sự kết hợp kinh điển giữa rượu vang và các món ngon đặc trưng, mở đầu hành trình thưởng thức tinh tế.',
            'price_text' => 'Từ 1.500.000đ/khách',
            'duration' => '2.5 giờ',
            'capacity' => '8–20 khách',
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/e6d25f6b5_generated_78290a91.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/e6d25f6b5_generated_78290a91.webp',
            'menu_items' => [
                ['course' => 'Khởi vị — Carpaccio bò, parmigiano', 'wine' => 'Pinot Noir'],
                ['course' => 'Món chính — Ngừ sốt tiêu, bơ thảo mộc', 'wine' => 'Cabernet Sauvignon'],
                ['course' => 'Tráng miệng — Tart chocolate đen', 'wine' => 'Port Tawny']
            ]
        ],
        [
            'id' => 2,
            'slug' => 'gourmet-selection',
            'title' => 'Gourmet Selection',
            'level' => 'Standard Level',
            'subtitle' => 'Bộ sưu tập món cao cấp được thiết kế riêng, kết hợp hoàn hảo cùng những dòng vang thượng hạng.',
            'price_text' => 'Từ 2.000.000đ/khách',
            'duration' => '3 giờ',
            'capacity' => '8–20 khách',
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/4f229480d_generated_ffd34238.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/4f229480d_generated_ffd34238.webp',
            'menu_items' => [
                ['course' => 'Khởi vị — Sashimi cá hồi Na Uy', 'wine' => 'Chardonnay'],
                ['course' => 'Món chính — Bò bít tết Wagyu', 'wine' => 'Malbec'],
                ['course' => 'Tráng miệng — Crème brûlée vani', 'wine' => 'Sauternes']
            ]
        ],
        [
            'id' => 3,
            'slug' => 'private-cellar',
            'title' => 'Private Cellar',
            'level' => 'Premium Level',
            'subtitle' => 'Trải nghiệm thử rượu độc quyền trong hầm rượu riêng, dành cho những người sành vang đích thực.',
            'price_text' => 'Từ 3.500.000đ/khách',
            'duration' => '3.5 giờ',
            'capacity' => '6–12 khách',
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/0a280a9c0_generated_bbd5d622.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/0a280a9c0_generated_bbd5d622.webp',
            'menu_items' => [
                ['course' => 'Nếm thử 5 dòng vang hầm riêng', 'wine' => 'Vertical Tasting'],
                ['course' => 'Phô mai nhập khẩu & pâté', 'wine' => 'Bordeaux Grand Cru'],
                ['course' => 'Món chính — Thỏ nấu rượu vang', 'wine' => 'Burgundy Pinot']
            ]
        ],
        [
            'id' => 4,
            'slug' => 'amis-du-vin-gala-night',
            'title' => 'Amis du Vin Gala Night',
            'level' => 'Premium Level',
            'subtitle' => 'Đêm tiệc thượng lưu tráng lệ với thực đơn Sommelier thiết kế, không gian riêng tư đẳng cấp.',
            'price_text' => 'Từ 5.000.000đ/khách',
            'duration' => '4 giờ',
            'capacity' => '15–40 khách',
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/af384a896_generated_47deb67b.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/af384a896_generated_47deb67b.webp',
            'menu_items' => [
                ['course' => 'Aperitif & lộ trình vang 7 món', 'wine' => 'Champagne'],
                ['course' => 'Món chính — Cừu nướng thảo mộc', 'wine' => 'Barolo Riserva'],
                ['course' => 'Tráng miệng — Soufflé chocolate', 'wine' => 'Tokaji Aszú']
            ]
        ]
    ];
}
?>
<section id="pairing" class="scroll-anchor relative py-24 sm:py-32 bg-background overflow-hidden">
  <div class="absolute inset-0 bg-wine-radial opacity-60"></div>
  <div class="relative max-w-7xl mx-auto px-5 sm:px-8">
    <div class="reveal is-visible">
      <div class="text-center max-w-2xl mx-auto mb-14">
        <p class="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-4">Danh sách gói tiệc</p>
        <h2 class="font-heading text-3xl sm:text-5xl text-foreground mb-5">Food &amp; Wine Pairing</h2>
        <p class="text-sm sm:text-base text-muted-foreground">Bốn trải nghiệm kết hợp ẩm thực và rượu vang, từ tinh hoa tiêu chuẩn đến đỉnh cao thượng lưu.</p>
      </div>
    </div>

    <!-- Desktop Grid View -->
    <div class="hidden md:grid grid-cols-2 gap-6 lg:gap-8">
      <?php foreach ($pairings as $pairing): ?>
        <?php $jsonData = htmlspecialchars(json_encode($pairing), ENT_QUOTES, 'UTF-8'); ?>
        <div class="reveal is-visible">
          <div role="button" tabindex="0" onclick="openPairingModal(<?= $jsonData ?>)" class="card-lift group h-full rounded-sm border border-border bg-card overflow-hidden flex flex-col cursor-pointer">
            <div class="relative aspect-[4/3] overflow-hidden">
              <span class="inline-block relative w-full h-full transition-transform duration-700 group-hover:scale-105">
                <img src="<?= htmlspecialchars($pairing['image']) ?>" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="<?= htmlspecialchars($pairing['title']) ?>">
              </span>
              <div class="absolute inset-0 bg-gradient-to-t from-card via-card/20 to-transparent"></div>
              <?php if (str_contains(strtolower($pairing['level']), 'premium')): ?>
                <span class="absolute top-4 left-4 text-[10px] uppercase tracking-[0.18em] px-3 py-1.5 rounded-full backdrop-blur-sm bg-[var(--gold)]/15 text-[var(--gold)] border border-[var(--gold)]/40"><?= htmlspecialchars($pairing['level']) ?></span>
              <?php else: ?>
                <span class="absolute top-4 left-4 text-[10px] uppercase tracking-[0.18em] px-3 py-1.5 rounded-full backdrop-blur-sm bg-black/50 text-white border border-white/20"><?= htmlspecialchars($pairing['level']) ?></span>
              <?php endif; ?>
            </div>
            <div class="p-6 flex flex-col flex-1">
              <h3 class="font-heading text-xl sm:text-2xl text-foreground mb-3"><?= htmlspecialchars($pairing['title']) ?></h3>
              <p class="text-sm text-muted-foreground leading-relaxed mb-6 flex-1"><?= htmlspecialchars($pairing['subtitle']) ?></p>
              <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-[var(--wine)]"><?= htmlspecialchars($pairing['price_text']) ?></span>
                <button type="button" onclick="event.stopPropagation(); openPairingModal(<?= $jsonData ?>)" class="btn-invert inline-flex items-center gap-2 px-5 py-2.5 rounded-sm text-xs uppercase tracking-[0.15em] font-medium">
                  Xem chi tiết 
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-3.5 h-3.5"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Mobile Slider View -->
    <div class="md:hidden">
      <div class="flex items-center justify-between mb-4">
        <span class="text-xs uppercase tracking-[0.2em] text-[var(--gold)]">Vuốt để xem tiếp</span>
        <div class="flex gap-2">
          <button id="btnPairingPrev" class="w-11 h-11 rounded-full border border-border flex items-center justify-center text-foreground/70 active:bg-foreground/5 transition-colors" aria-label="Trước">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-5 h-5"><path d="m15 18-6-6 6-6"></path></svg>
          </button>
          <button id="btnPairingNext" class="w-11 h-11 rounded-full border border-border flex items-center justify-center text-foreground/70 active:bg-foreground/5 transition-colors" aria-label="Sau">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-5 h-5"><path d="m9 18 6-6-6-6"></path></svg>
          </button>
        </div>
      </div>
      <div id="pairingCarousel" class="no-scrollbar flex gap-4 overflow-x-auto snap-x snap-mandatory pb-4 -mx-5 px-5">
        <?php foreach ($pairings as $pairing): ?>
          <?php $jsonData = htmlspecialchars(json_encode($pairing), ENT_QUOTES, 'UTF-8'); ?>
          <div class="snap-center shrink-0 w-[85%]">
            <div role="button" tabindex="0" onclick="openPairingModal(<?= $jsonData ?>)" class="card-lift group h-full rounded-sm border border-border bg-card overflow-hidden flex flex-col cursor-pointer">
              <div class="relative aspect-[4/3] overflow-hidden">
                <span class="inline-block relative w-full h-full transition-transform duration-700 group-hover:scale-105">
                  <img src="<?= htmlspecialchars($pairing['image']) ?>" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="<?= htmlspecialchars($pairing['title']) ?>">
                </span>
                <div class="absolute inset-0 bg-gradient-to-t from-card via-card/20 to-transparent"></div>
                <?php if (str_contains(strtolower($pairing['level']), 'premium')): ?>
                  <span class="absolute top-4 left-4 text-[10px] uppercase tracking-[0.18em] px-3 py-1.5 rounded-full backdrop-blur-sm bg-[var(--gold)]/15 text-[var(--gold)] border border-[var(--gold)]/40"><?= htmlspecialchars($pairing['level']) ?></span>
                <?php else: ?>
                  <span class="absolute top-4 left-4 text-[10px] uppercase tracking-[0.18em] px-3 py-1.5 rounded-full backdrop-blur-sm bg-black/50 text-white border border-white/20"><?= htmlspecialchars($pairing['level']) ?></span>
                <?php endif; ?>
              </div>
              <div class="p-6 flex flex-col flex-1">
                <h3 class="font-heading text-xl sm:text-2xl text-foreground mb-3"><?= htmlspecialchars($pairing['title']) ?></h3>
                <p class="text-sm text-muted-foreground leading-relaxed mb-6 flex-1"><?= htmlspecialchars($pairing['subtitle']) ?></p>
                <div class="flex items-center justify-between">
                  <span class="text-sm font-medium text-[var(--wine)]"><?= htmlspecialchars($pairing['price_text']) ?></span>
                  <button type="button" onclick="event.stopPropagation(); openPairingModal(<?= $jsonData ?>)" class="btn-invert inline-flex items-center gap-2 px-5 py-2.5 rounded-sm text-xs uppercase tracking-[0.15em] font-medium">
                    Xem chi tiết 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-3.5 h-3.5"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
