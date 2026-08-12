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
                'khai_vi' => ['items' => ['Carpaccio bò, parmigiano'], 'wines' => ['Pinot Noir']],
                'mon_chinh' => ['items' => ['Ngừ sốt tiêu, bơ thảo mộc'], 'wines' => ['Cabernet Sauvignon']],
                'trang_mieng' => ['items' => ['Tart chocolate đen'], 'wines' => ['Port Tawny']]
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
                'khai_vi' => ['items' => ['Sashimi cá hồi Na Uy'], 'wines' => ['Chardonnay']],
                'mon_chinh' => ['items' => ['Bò bít tết Wagyu'], 'wines' => ['Malbec']],
                'trang_mieng' => ['items' => ['Crème brûlée vani'], 'wines' => ['Sauternes']]
            ]
        ],
        [
            'id' => 3,
            'slug' => 'private-cellar',
            'title' => 'Private Cellar',
            'level' => 'Premium Level',
            'subtitle' => 'Trải nghiệm thử rượu tại không gian độc quyền trong hầm rượu riêng, dành cho những người sành vang',
            'price_text' => 'Từ 3.500.000đ/khách',
            'duration' => '3.5 giờ',
            'capacity' => '6–12 khách',
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/0a280a9c0_generated_bbd5d622.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/0a280a9c0_generated_bbd5d622.webp',
            'menu_items' => [
                'khai_vi' => ['items' => ['Nếm thử 5 dòng vang hầm riêng'], 'wines' => ['Vertical Tasting']],
                'mon_chinh' => ['items' => ['Phô mai nhập khẩu & pâté', 'Thỏ nấu rượu vang'], 'wines' => ['Bordeaux Grand Cru', 'Burgundy Pinot']],
                'trang_mieng' => ['items' => [], 'wines' => []]
            ]
        ],
        [
            'id' => 4,
            'slug' => 'amis-du-vin-gala-night',
            'title' => 'Amis Duvin Gala Night',
            'level' => 'Premium Level',
            'subtitle' => 'Đêm tiệc thượng lưu với thực đơn do Sommelier thiết kế riêng, trong không gian private sang trọng.',
            'price_text' => 'Từ 5.000.000đ/khách',
            'duration' => '4 giờ',
            'capacity' => '15–40 khách',
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/af384a896_generated_47deb67b.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/af384a896_generated_47deb67b.webp',
            'menu_items' => [
                'khai_vi' => ['items' => ['Aperitif & lộ trình vang 7 món'], 'wines' => ['Champagne']],
                'mon_chinh' => ['items' => ['Cừu nướng thảo mộc'], 'wines' => ['Barolo Riserva']],
                'trang_mieng' => ['items' => ['Soufflé chocolate'], 'wines' => ['Tokaji Aszú']]
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
        <span class="editorial-tag inline-block font-body-modern text-[11px] uppercase tracking-[0.25em] font-semibold text-[var(--gold)] border border-champagneGold/40 bg-champagneGold/10 px-3.5 py-1 mb-4 rounded-sm">
          Danh sách gói tiệc
        </span>
        <h2 class="font-heading-editorial text-3xl sm:text-5xl text-foreground mb-4 font-bold tracking-wide">Food &amp; Wine Pairing</h2>
        <p class="font-body-modern text-sm sm:text-base text-muted-foreground leading-relaxed">Chúng tôi mong được đồng hành cùng bạn trên hành trình ấy.</p>
      </div>
    </div>

    <!-- Desktop Grid View -->
    <div class="hidden md:grid grid-cols-2 gap-6 lg:gap-8">
      <?php foreach ($pairings as $pairing): ?>
        <?php $jsonData = htmlspecialchars(json_encode($pairing), ENT_QUOTES, 'UTF-8'); ?>
        <div class="reveal is-visible">
          <div role="button" tabindex="0" onclick="openPairingModal(<?= $jsonData ?>)" class="card-lift group h-full rounded-sm border-thin-gold bg-card/60 overflow-hidden flex flex-col cursor-pointer transition-all duration-300 hover:border-champagneGold/60 shadow-sm backdrop-blur-sm">
            <div class="relative aspect-[4/3] overflow-hidden bg-card">
              <img src="<?= htmlspecialchars($pairing['image']) ?>" loading="lazy" class="w-full h-full object-cover select-none" alt="<?= htmlspecialchars($pairing['title']) ?>">
              <div class="absolute inset-0 bg-gradient-to-t from-card via-card/30 to-transparent pointer-events-none"></div>
              <?php if (str_contains(strtolower($pairing['level']), 'premium') || str_contains(strtolower($pairing['level']), 'grand') || str_contains(strtolower($pairing['level']), 'bespoke')): ?>
                <span class="editorial-tag absolute top-4 left-4 text-[10px] uppercase tracking-[0.2em] font-semibold px-3 py-1 rounded-sm bg-[var(--wine)] text-white border border-champagneGold/40"><?= htmlspecialchars($pairing['level']) ?></span>
              <?php else: ?>
                <span class="editorial-tag absolute top-4 left-4 text-[10px] uppercase tracking-[0.2em] font-semibold px-3 py-1 rounded-sm bg-[var(--gold)]/20 text-[var(--gold)] border border-champagneGold/40 backdrop-blur-md"><?= htmlspecialchars($pairing['level']) ?></span>
              <?php endif; ?>
            </div>
            <div class="p-4 sm:p-5 lg:p-6 flex flex-col flex-1">
              <h3 class="font-heading-editorial text-xl sm:text-2xl text-foreground mb-2.5 lg:mb-3 font-semibold tracking-wide"><?= htmlspecialchars($pairing['title']) ?></h3>
              <p class="font-body-modern text-xs sm:text-sm text-muted-foreground leading-relaxed mb-5 lg:mb-6 flex-1"><?= htmlspecialchars($pairing['subtitle']) ?></p>
              <div class="flex items-center justify-between gap-2 lg:gap-4 pt-3.5 lg:pt-4 border-t border-champagneGold/20 mt-auto">
                <div class="flex flex-col min-w-0">
                  <span class="text-[10px] uppercase tracking-wider text-muted-foreground">Mức giá</span>
                  <span class="font-body-modern text-xs sm:text-sm lg:text-base font-bold text-[var(--gold)] whitespace-nowrap"><?= htmlspecialchars($pairing['price_text']) ?></span>
                </div>
                <button type="button" onclick="event.stopPropagation(); openPairingModal(<?= $jsonData ?>)" class="btn-brand-burgundy inline-flex items-center justify-center gap-1.5 sm:gap-2 px-3 lg:px-5 py-2 lg:py-2.5 rounded-sm text-[11px] lg:text-xs uppercase tracking-[0.1em] lg:tracking-[0.15em] font-semibold whitespace-nowrap shrink-0 transition-all border border-champagneGold/30 shadow-sm active:scale-95">
                  <span>Xem&nbsp;chi&nbsp;tiết</span>
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
          <div class="snap-center shrink-0 w-[88%] sm:w-[350px]">
            <div role="button" tabindex="0" onclick="openPairingModal(<?= $jsonData ?>)" class="card-lift group h-full rounded-sm border border-border bg-card overflow-hidden flex flex-col cursor-pointer">
              <div class="relative aspect-[4/3] overflow-hidden bg-card">
                <img src="<?= htmlspecialchars($pairing['image']) ?>" loading="lazy" class="w-full h-full object-cover select-none" alt="<?= htmlspecialchars($pairing['title']) ?>">
                <div class="absolute inset-0 bg-gradient-to-t from-card via-card/20 to-transparent pointer-events-none"></div>
                <?php if (str_contains(strtolower($pairing['level']), 'premium')): ?>
                  <span class="absolute top-4 left-4 text-[10px] uppercase tracking-[0.18em] px-3 py-1.5 rounded-full backdrop-blur-sm bg-[var(--gold)]/15 text-[var(--gold)] border border-[var(--gold)]/40"><?= htmlspecialchars($pairing['level']) ?></span>
                <?php else: ?>
                  <span class="absolute top-4 left-4 text-[10px] uppercase tracking-[0.18em] px-3 py-1.5 rounded-full backdrop-blur-sm bg-black/50 text-white border border-white/20"><?= htmlspecialchars($pairing['level']) ?></span>
                <?php endif; ?>
              </div>
              <div class="p-5 flex flex-col flex-1">
                <h3 class="font-heading text-xl sm:text-2xl text-foreground mb-2.5"><?= htmlspecialchars($pairing['title']) ?></h3>
                <p class="text-xs sm:text-sm text-muted-foreground leading-relaxed mb-5 flex-1"><?= htmlspecialchars($pairing['subtitle']) ?></p>
                <div class="flex flex-col gap-3 pt-3.5 border-t border-champagneGold/20 mt-auto">
                  <div class="flex items-center justify-between gap-2">
                    <span class="text-[11px] uppercase tracking-wider text-muted-foreground">Mức giá</span>
                    <span class="font-body-modern text-sm font-bold text-[var(--gold)] whitespace-nowrap"><?= htmlspecialchars($pairing['price_text']) ?></span>
                  </div>
                  <button type="button" onclick="event.stopPropagation(); openPairingModal(<?= $jsonData ?>)" class="w-full btn-brand-burgundy inline-flex items-center justify-center gap-2 py-2.5 rounded-sm text-xs uppercase tracking-[0.15em] font-semibold whitespace-nowrap transition-all border border-champagneGold/30 shadow-sm active:scale-95">
                    <span>Xem&nbsp;chi&nbsp;tiết</span>
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
