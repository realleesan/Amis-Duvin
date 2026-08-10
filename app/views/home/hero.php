<?php
$heroTagline = $hero['tagline'] ?? 'Rượu vang & những người bạn';
$heroTitleMain = $hero['title_main'] ?? 'Không gian Tiệc riêng tư';
$heroTitleSub = $hero['title_sub'] ?? '& Tinh hoa ẩm thực Rượu vang';
$heroDescription = $hero['description'] ?? 'Trải nghiệm tiệc riêng tư kết hợp ẩm thực và rượu vang tinh tế, trọn vẹn văn hoá vang tại Hà Nội.';
$heroBgImage = $hero['bg_image'] ?? 'https://media.base44.com/images/public/6a623336361c483b3f15558c/1d3f75363_generated_b7d85214.png/v1/fill/w_1171,h_927,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/1d3f75363_generated_b7d85214.webp';
?>
<section id="hero" class="relative min-h-screen flex items-center overflow-hidden">
  <div class="absolute inset-0">
    <span class="inline-block absolute inset-0 w-full h-full">
      <img src="<?= htmlspecialchars($heroBgImage) ?>" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="<?= htmlspecialchars($heroTitleMain) ?>">
    </span>
    <div class="absolute inset-0 bg-gradient-to-b from-black/75 via-black/45 to-background"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-transparent"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 w-full pt-28 pb-20">
    <div class="reveal is-visible mb-6">
      <span class="editorial-tag inline-block font-body-modern text-[11px] uppercase tracking-[0.25em] font-semibold text-[var(--gold)] border border-[var(--gold)]/40 bg-[var(--gold)]/10 px-3.5 py-1.5 rounded-sm">
        <?= htmlspecialchars($heroTagline) ?>
      </span>
    </div>
    <div class="reveal is-visible">
      <h1 class="font-heading-editorial text-4xl sm:text-6xl lg:text-7xl text-white leading-[1.08] max-w-4xl mb-7 font-bold tracking-wide">
        <?= htmlspecialchars($heroTitleMain) ?>
        <span class="block text-2xl sm:text-3xl lg:text-4xl font-heading-editorial italic font-normal text-[var(--gold-light)] mt-4 tracking-normal"><?= htmlspecialchars($heroTitleSub) ?></span>
      </h1>
    </div>
    <div class="reveal is-visible">
      <p class="font-body-modern text-base sm:text-lg text-white/80 max-w-xl mb-10 leading-relaxed font-normal"><?= htmlspecialchars($heroDescription) ?></p>
    </div>
    <div class="reveal is-visible">
      <div class="flex flex-col sm:flex-row gap-4">
        <button class="btn-brand-burgundy px-8 py-4 rounded-sm text-xs sm:text-sm uppercase tracking-[0.2em] font-semibold min-h-[52px] shadow-lg" onclick="scrollToId('register')">
          Đặt tiệc riêng tư ngay
        </button>
        <button class="btn-brand-gold-outline px-7 py-4 rounded-sm text-xs sm:text-sm uppercase tracking-[0.2em] font-semibold min-h-[52px]" onclick="scrollToId('pairing')">
          Khám phá các Gói Tiệc
        </button>
      </div>
    </div>
  </div>
  <button class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 text-white/50 hover:text-white transition-colors" aria-label="Cuộn xuống" onclick="scrollToId('about')">
    <span class="text-[10px] uppercase tracking-[0.3em]">Cuộn xuống</span>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down w-5 h-5 animate-bounce"><path d="m6 9 6 6 6-6"></path></svg>
  </button>
</section>
