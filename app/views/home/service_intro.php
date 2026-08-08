<?php
$introTagline = $serviceIntro['tagline'] ?? 'Dịch vụ tiệc riêng Amis du Vin';
$introTitleMain = $serviceIntro['title_main'] ?? 'Không gian Tiệc riêng tư';
$introTitleSub = $serviceIntro['title_sub'] ?? '& Tinh hoa ẩm thực Rượu vang';
$introDescription = $serviceIntro['description'] ?? 'Khái quát về mô hình tiệc riêng tư (Private Party) — sự kết hợp đỉnh cao giữa văn hóa rượu vang hảo hạng và nghệ thuật ẩm thực tinh tế (Food & Wine Pairing), mang đến không gian biệt lập, đẳng cấp cho các buổi tiếp khách, kỷ niệm hay giao lưu doanh nhân.';
$introHighlightNote = $serviceIntro['highlight_note'] ?? 'Bốn trải nghiệm kết hợp ẩm thực và rượu vang, từ tinh hoa tiêu chuẩn đến đỉnh cao thượng lưu.';
$introCardTag = $serviceIntro['card_tag'] ?? 'Private Party Experience';
$introCardTitle = $serviceIntro['card_title'] ?? 'Không gian Biệt lập & Đẳng cấp';
$introCardSubtitle = $serviceIntro['card_subtitle'] ?? 'Thiết kế thực đơn riêng bởi Chef & Sommelier chuyên nghiệp.';
$introCardImage = $serviceIntro['card_image'] ?? 'https://media.base44.com/images/public/6a623336361c483b3f15558c/4f229480d_generated_ffd34238.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/4f229480d_generated_ffd34238.webp';
?>
<section id="service-intro" class="scroll-anchor relative py-24 sm:py-32 bg-card/50 border-y border-border overflow-hidden">
  <div class="absolute inset-0 bg-wine-radial opacity-40"></div>
  <div class="relative max-w-7xl mx-auto px-5 sm:px-8">
    <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-center">
      <!-- Left Column: Text & CTA -->
      <div class="reveal is-visible lg:col-span-7 space-y-6">
        <div>
          <p class="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-4"><?= htmlspecialchars($introTagline) ?></p>
          <h2 class="font-heading text-3xl sm:text-5xl text-foreground leading-[1.15]">
            <?= htmlspecialchars($introTitleMain) ?> <br>
            <span class="font-serif-display italic text-[var(--gold)] font-normal text-2xl sm:text-4xl block mt-2"><?= htmlspecialchars($introTitleSub) ?></span>
          </h2>
          <div class="hairline w-24 my-6"></div>
        </div>

        <p class="text-base sm:text-lg text-foreground/80 leading-relaxed font-light">
          <?= htmlspecialchars($introDescription) ?>
        </p>

        <p class="text-sm text-muted-foreground leading-relaxed border-l-2 border-[var(--gold)]/60 pl-4 py-1 italic">
          <?= htmlspecialchars($introHighlightNote) ?>
        </p>

        <div class="pt-4">
          <button onclick="scrollToId('pairing')" class="btn-invert px-8 py-4 rounded-sm text-xs sm:text-sm uppercase tracking-[0.2em] font-medium inline-flex items-center gap-3 shadow-lg group">
            <span>Khám phá các gói tiệc</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down w-4 h-4 transition-transform group-hover:translate-y-1"><path d="M12 5v14"></path><path d="m19 12-7 7-7-7"></path></svg>
          </button>
        </div>
      </div>

      <!-- Right Column: Visual Feature Card -->
      <div class="reveal is-visible lg:col-span-5">
        <div class="relative rounded-sm border border-border bg-card p-3 shadow-2xl group">
          <div class="relative aspect-[4/5] overflow-hidden rounded-sm">
            <img src="<?= htmlspecialchars($introCardImage) ?>" alt="<?= htmlspecialchars($introCardTitle) ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
            <div class="absolute bottom-6 left-6 right-6 text-white space-y-2">
              <span class="text-[10px] uppercase tracking-[0.25em] px-3 py-1 rounded-full bg-[var(--wine)]/80 backdrop-blur-md border border-[var(--gold)]/30 text-white inline-block"><?= htmlspecialchars($introCardTag) ?></span>
              <h3 class="font-heading text-xl text-white"><?= htmlspecialchars($introCardTitle) ?></h3>
              <p class="text-xs text-white/70"><?= htmlspecialchars($introCardSubtitle) ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
