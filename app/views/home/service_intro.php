<?php
$introTagline = $serviceIntro['tagline'] ?? 'Dịch vụ tiệc riêng Amis Duvin';
$introTitleMain = $serviceIntro['title_main'] ?? 'Không gian Tiệc riêng tư';
$introTitleSub = $serviceIntro['title_sub'] ?? '& Tinh hoa ẩm thực Rượu vang';
$introDescription = $serviceIntro['description'] ?? "Có những cuộc gặp gỡ chỉ kéo dài vài giờ, nhưng để lại ký ức nhiều năm.\nCó những ly vang không chỉ để thưởng thức, mà để mở ra những cuộc trò chuyện, những kết nối và những cảm xúc đẹp.\nAmis Duvin được tạo nên từ niềm tin rằng mỗi người đều xứng đáng có những khoảnh khắc sống thật chậm, thật tinh tế và thật trọn vẹn.";
$introHighlightNote = $serviceIntro['highlight_note'] ?? 'Chúng tôi mong được đồng hành cùng bạn trên hành trình ấy.';
$introCardTag = $serviceIntro['card_tag'] ?? 'Private Party Experience';
$introCardTitle = $serviceIntro['card_title'] ?? 'Không gian Biệt lập & Đẳng cấp';
$introCardSubtitle = $serviceIntro['card_subtitle'] ?? 'Thiết kế thực đơn riêng bởi Chef & Sommelier chuyên nghiệp.';
$introCardImage = $serviceIntro['card_image'] ?? 'https://media.base44.com/images/public/6a623336361c483b3f15558c/4f229480d_generated_ffd34238.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/4f229480d_generated_ffd34238.webp';
?>
<section id="service-intro" class="scroll-anchor relative py-24 sm:py-32 bg-card/50 border-y border-champagneGold/20 overflow-hidden">
  <div class="absolute inset-0 bg-wine-radial opacity-40"></div>
  <div class="relative max-w-7xl mx-auto px-5 sm:px-8">
    <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-center">
      <!-- Left Column: Text & CTA -->
      <div class="reveal is-visible lg:col-span-7 space-y-6">
        <div>
          <span class="editorial-tag inline-block font-body-modern text-[11px] uppercase tracking-[0.25em] font-semibold text-[var(--gold)] border border-champagneGold/40 bg-champagneGold/10 px-3.5 py-1 mb-4 rounded-sm">
            <?= htmlspecialchars($introTagline) ?>
          </span>
          <h2 class="font-heading-editorial text-3xl sm:text-5xl text-foreground leading-[1.15] font-bold tracking-wide">
            <?= htmlspecialchars($introTitleMain) ?> <br>
            <span class="font-heading-editorial italic text-[var(--gold)] font-normal text-2xl sm:text-4xl block mt-2 tracking-normal"><?= htmlspecialchars($introTitleSub) ?></span>
          </h2>
          <div class="hairline w-24 my-6 bg-[var(--gold)]/50"></div>
        </div>

        <div class="font-body-modern text-base sm:text-lg text-foreground/85 leading-relaxed font-normal space-y-3">
          <?= nl2br(htmlspecialchars($introDescription)) ?>
        </div>

        <p class="font-body-modern text-sm sm:text-base text-muted-foreground leading-relaxed border-l-2 border-[var(--wine)] pl-4 py-1.5 italic bg-[var(--gold)]/5 rounded-r-sm">
          <?= htmlspecialchars($introHighlightNote) ?>
        </p>

        <div class="pt-4">
          <button onclick="scrollToId('pairing')" class="bg-[var(--wine)] hover:bg-[var(--wine-deep)] text-white px-8 py-4 rounded-sm text-xs sm:text-sm uppercase tracking-[0.2em] font-semibold inline-flex items-center gap-3 shadow-lg border border-champagneGold/30 transition-all transform hover:-translate-y-0.5 group whitespace-nowrap">
            <span>Khám&nbsp;phá các&nbsp;gói&nbsp;tiệc</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down w-4 h-4 transition-transform group-hover:translate-y-1"><path d="M12 5v14"></path><path d="m19 12-7 7-7-7"></path></svg>
          </button>
        </div>
      </div>

      <!-- Right Column: Visual Feature Card -->
      <div class="reveal is-visible lg:col-span-5">
        <div class="relative rounded-sm border-thin-gold shadow-2xl group overflow-hidden">
          <div class="relative aspect-[4/5] overflow-hidden rounded-sm">
            <img src="<?= htmlspecialchars($introCardImage) ?>" alt="<?= htmlspecialchars($introCardTitle) ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
            <div class="absolute bottom-6 left-6 right-6 text-white space-y-2">
              <span class="editorial-tag text-[10px] uppercase tracking-[0.2em] px-3 py-1 rounded-sm bg-[var(--wine)] text-white border border-champagneGold/40 inline-block font-semibold"><?= htmlspecialchars($introCardTag) ?></span>
              <h3 class="font-heading text-xl text-white"><?= htmlspecialchars($introCardTitle) ?></h3>
              <p class="text-xs text-white/70"><?= htmlspecialchars($introCardSubtitle) ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
