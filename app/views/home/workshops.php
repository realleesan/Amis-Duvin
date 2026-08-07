<?php
if (empty($featuredWorkshops)) {
    $featuredWorkshops = [
        [
            'id' => 1,
            'slug' => 'the-first-sip',
            'title' => 'The First Sip',
            'level' => 'Cơ bản',
            'price' => 1000000.00,
            'price_text' => '1.000.000 VNĐ',
            'schedule' => 'Thứ 6, 14/08/2026 · 10h – 12h',
            'max_participants' => 12,
            'current_participants' => 9,
            'remaining_spots' => 3,
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/2ff99e699_image.png/v1/fill/w_370,h_458,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/2ff99e699_image.webp',
            'status' => 'active'
        ],
        [
            'id' => 2,
            'slug' => 'the-art-of-taste',
            'title' => 'The Art of Taste',
            'level' => 'Nâng cao',
            'price' => 1200000.00,
            'price_text' => '1.200.000 VNĐ',
            'schedule' => '28/08/2026 · 19h – 21h',
            'max_participants' => 12,
            'current_participants' => 7,
            'remaining_spots' => 5,
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/ef11c3040_image.png/v1/fill/w_370,h_458,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/ef11c3040_image.webp',
            'status' => 'active'
        ]
    ];
}

if (empty($topicWorkshops)) {
    $topicWorkshops = [
        [
            'id' => 3,
            'slug' => 'wine-food-romance',
            'title' => 'Wine & Food Romance',
            'level' => 'Chuyên đề',
            'price' => 1500000.00,
            'price_text' => '1.500.000 VNĐ',
            'schedule' => '11/09/2026 · 19h – 21h',
            'max_participants' => 12,
            'current_participants' => 10,
            'remaining_spots' => 2,
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/ff4488a83_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/ff4488a83_image.webp',
            'status' => 'active'
        ],
        [
            'id' => 4,
            'slug' => 'around-the-wine-world',
            'title' => 'Around the Wine World',
            'level' => 'Khám phá',
            'price' => 1800000.00,
            'price_text' => '1.800.000 VNĐ',
            'schedule' => '25/09/2026 · 19h – 21h',
            'max_participants' => 12,
            'current_participants' => 12,
            'remaining_spots' => 0,
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/4e47aee24_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/4e47aee24_image.webp',
            'status' => 'full'
        ],
        [
            'id' => 5,
            'slug' => 'wine-art',
            'title' => 'Wine & Art',
            'level' => 'Cảm nhận',
            'price' => 1000000.00,
            'price_text' => '1.000.000 VNĐ',
            'schedule' => '09/10/2026 · 19h – 21h',
            'max_participants' => 12,
            'current_participants' => 6,
            'remaining_spots' => 6,
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/0d495c825_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/0d495c825_image.webp',
            'status' => 'active'
        ],
        [
            'id' => 6,
            'slug' => 'wine-business',
            'title' => 'Wine & Business',
            'level' => 'Ngoại giao',
            'price' => 2000000.00,
            'price_text' => '2.000.000 VNĐ',
            'schedule' => '23/10/2026 · 19h – 21h',
            'max_participants' => 12,
            'current_participants' => 11,
            'remaining_spots' => 1,
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/2a054bd36_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/2a054bd36_image.webp',
            'status' => 'active'
        ],
        [
            'id' => 7,
            'slug' => 'wine-fine-living',
            'title' => 'Wine & Fine Living',
            'level' => 'Thưởng thức',
            'price' => 1500000.00,
            'price_text' => '1.500.000 VNĐ',
            'schedule' => '06/11/2026 · 19h – 21h',
            'max_participants' => 12,
            'current_participants' => 2,
            'remaining_spots' => 10,
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/2a054bd36_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/2a054bd36_image.webp',
            'status' => 'active'
        ],
        [
            'id' => 8,
            'slug' => 'amis-du-vin-gala',
            'title' => 'Amis du Vin Gala',
            'level' => 'Thượng lưu',
            'price' => 2000000.00,
            'price_text' => '2.000.000 VNĐ',
            'schedule' => '20/11/2026 · 18h – 22h',
            'max_participants' => 20,
            'current_participants' => 5,
            'remaining_spots' => 15,
            'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/f807fd6b1_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/f807fd6b1_image.webp',
            'status' => 'active'
        ]
    ];
}
?>
<section id="workshops" class="scroll-anchor relative py-24 sm:py-32 bg-card overflow-hidden">
  <div class="max-w-7xl mx-auto px-5 sm:px-8">
    
    <!-- Header -->
    <div class="reveal is-visible">
      <div class="text-center max-w-2xl mx-auto mb-14">
        <p class="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-4">Dịch vụ phụ</p>
        <h2 class="font-heading text-3xl sm:text-5xl text-foreground mb-5">Chọn Workshop phù hợp với bạn</h2>
        <p class="text-sm sm:text-base text-muted-foreground">Hai buổi gần nhất nổi bật — chạm vào thẻ để xem thông tin chi tiết.</p>
      </div>
    </div>

    <!-- 1. Featured Workshops Grid (2 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-3xl mx-auto mb-16">
      <?php foreach ($featuredWorkshops as $idx => $ws): ?>
        <?php 
          $numStr = str_pad($idx + 1, 2, '0', STR_PAD_LEFT);
          $priceText = $ws['price_text'] ?? (number_format($ws['price'], 0, ',', '.') . ' VNĐ');
          $rem = isset($ws['remaining_spots']) ? $ws['remaining_spots'] : (max(0, $ws['max_participants'] - $ws['current_participants']));
          $isFull = ($ws['status'] === 'full' || $rem <= 0);
        ?>
        <div class="reveal is-visible">
          <div class="group [perspective:1400px] h-[460px] transition-shadow duration-500 hover:shadow-[0_24px_50px_-22px_rgba(33,30,25,0.3)]">
            <div class="workshop-flip-card relative w-full h-full transition-transform duration-700 [transform-style:preserve-3d] cursor-pointer" onclick="toggleWorkshopCardFlip(this, event)">
              
              <!-- Front Face -->
              <div class="absolute inset-0 [backface-visibility:hidden] rounded-sm border border-border overflow-hidden">
                <span class="inline-block absolute inset-0 w-full h-full transition-transform duration-[1.2s] group-hover:scale-105">
                  <img src="<?= htmlspecialchars($ws['image']) ?>" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="<?= htmlspecialchars($ws['title']) ?>">
                </span>
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-black/25"></div>
                <div class="relative h-full p-6 sm:p-7 flex flex-col text-white">
                  <div class="flex items-start justify-between mb-5">
                    <span class="font-heading text-3xl text-gradient-gold"><?= $numStr ?></span>
                    <?php if ($isFull): ?>
                      <span class="inline-flex items-center gap-1.5 text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border backdrop-blur-sm text-white/70 border-white/25 bg-white/10"><span class="w-1.5 h-1.5 rounded-full bg-current"></span>Đã đầy</span>
                    <?php else: ?>
                      <span class="inline-flex items-center gap-1.5 text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border backdrop-blur-sm text-emerald-300 border-emerald-400/40 bg-emerald-500/20"><span class="w-1.5 h-1.5 rounded-full bg-current"></span>Còn nhận đăng ký</span>
                    <?php endif; ?>
                  </div>
                  
                  <h3 class="font-heading text-xl text-white mb-4 leading-tight min-h-[3.5rem] drop-shadow-md"><?= htmlspecialchars($ws['title']) ?></h3>
                  
                  <div class="space-y-2 mb-4">
                    <div class="flex items-center gap-2 text-xs text-white/80">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3.5 h-3.5 text-[var(--gold)] shrink-0"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                      <span><?= htmlspecialchars($ws['schedule']) ?></span>
                    </div>
                  </div>
                  
                  <div class="flex-1"></div>
                  
                  <div class="flex items-center gap-1.5 text-[11px] text-white/60 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rotate-cw w-3 h-3"><path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8"></path><path d="M21 3v5h-5"></path></svg> 
                    Chạm để xem chi tiết
                  </div>
                  
                  <?php if ($isFull): ?>
                    <button type="button" onclick="event.stopPropagation(); scrollToId('register');" class="w-full flex items-center justify-center gap-2 py-3.5 rounded-sm text-xs uppercase tracking-[0.18em] font-medium min-h-[48px] btn-ghost text-white border-white/30">
                      Giữ chỗ cho lần tới
                    </button>
                  <?php else: ?>
                    <button type="button" onclick="event.stopPropagation(); scrollToId('register');" class="w-full flex items-center justify-center gap-2 py-3.5 rounded-sm text-xs uppercase tracking-[0.18em] font-medium min-h-[48px] btn-invert">
                      Giữ chỗ <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-3.5 h-3.5"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </button>
                  <?php endif; ?>
                </div>
              </div>

              <!-- Back Face (Details) -->
              <div class="absolute inset-0 [backface-visibility:hidden] [transform:rotateY(180deg)] rounded-sm border border-[var(--wine)]/30 bg-background p-6 sm:p-7 flex flex-col">
                <div class="flex items-center justify-between mb-5">
                  <p class="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)]">Thông tin Workshop</p>
                  <?php if ($isFull): ?>
                    <span class="inline-flex items-center text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border text-white/70 border-white/20 bg-white/5">Đã đầy</span>
                  <?php else: ?>
                    <span class="inline-flex items-center text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border text-emerald-600 dark:text-emerald-400 border-emerald-500/30 bg-emerald-500/10">Còn nhận đăng ký</span>
                  <?php endif; ?>
                </div>

                <h3 class="font-heading text-lg text-foreground mb-5 leading-tight"><?= htmlspecialchars($ws['title']) ?></h3>

                <div class="space-y-3.5 text-sm flex-1">
                  <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2 text-foreground/60 text-xs uppercase tracking-wide">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coins w-4 h-4"><circle cx="8" cy="8" r="6"></circle><path d="M18.09 10.37A6 6 0 1 1 10.34 18"></path><path d="M7 6h1v4"></path><path d="m16.71 13.88.7.71-2.82 2.82"></path></svg>
                      Học phí dự kiến
                    </span>
                    <span class="text-sm text-foreground font-medium text-right"><?= htmlspecialchars($priceText) ?></span>
                  </div>

                  <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2 text-foreground/60 text-xs uppercase tracking-wide">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-4 h-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                      Sĩ số lớp
                    </span>
                    <span class="text-sm text-foreground font-medium text-right">8 – <?= (int)$ws['max_participants'] ?> học viên</span>
                  </div>

                  <div class="flex items-center justify-between border-t border-border pt-3.5">
                    <span class="flex items-center gap-2 text-foreground/60 text-xs uppercase tracking-wide">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-4 h-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                      Số chỗ còn nhận
                    </span>
                    <?php if ($isFull): ?>
                      <span class="text-sm font-semibold text-muted-foreground">Đã hết chỗ</span>
                    <?php else: ?>
                      <span class="text-sm font-bold text-[var(--wine)] animate-pulse">Chỉ còn <?= $rem ?> chỗ</span>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="flex flex-col gap-2.5 mt-5">
                  <button type="button" onclick="event.stopPropagation(); scrollToId('register');" class="w-full flex items-center justify-center gap-2 py-3.5 rounded-sm text-xs uppercase tracking-[0.18em] font-medium min-h-[48px] btn-invert">
                    Giữ chỗ
                  </button>
                  <button type="button" onclick="event.stopPropagation(); toggleWorkshopCardFlip(this.closest('.workshop-flip-card'), event);" class="btn-ghost w-full flex items-center justify-center gap-2 py-3 rounded-sm text-xs uppercase tracking-[0.15em] font-medium min-h-[44px]">
                    Xem chi tiết
                  </button>
                </div>
              </div>

            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- 2. Topic Workshops 3D Coverflow Carousel Section ("Các chủ đề tiếp theo") -->
    <div class="reveal is-visible">
      <div class="relative">
        <p class="text-center text-xs uppercase tracking-[0.25em] text-[var(--gold)] mb-8">Các chủ đề tiếp theo</p>
        
        <div class="relative select-none">
          <div id="topicCoverflowTrack" class="relative h-[450px] [perspective:1400px]">
            <?php foreach ($topicWorkshops as $tIdx => $tWs): ?>
              <?php 
                $tNumStr = str_pad($tIdx + 3, 2, '0', STR_PAD_LEFT);
                $tPriceText = $tWs['price_text'] ?? (number_format($tWs['price'], 0, ',', '.') . ' VNĐ');
                $tRem = isset($tWs['remaining_spots']) ? $tWs['remaining_spots'] : (max(0, $tWs['max_participants'] - $tWs['current_participants']));
                $tIsFull = ($tWs['status'] === 'full' || $tRem <= 0);
              ?>
              <div class="topic-coverflow-card absolute left-1/2 top-0 w-[270px] sm:w-[310px] h-full transition-all duration-500 ease-out [transform-style:preserve-3d]" data-topic-index="<?= $tIdx ?>">
                <div class="workshop-flip-card relative w-full h-full rounded-sm border border-border overflow-hidden bg-card flex flex-col shadow-[0_24px_60px_-25px_rgba(33,30,25,0.4)] transition-transform duration-700 [transform-style:preserve-3d] cursor-pointer" onclick="handleTopicCardClick(<?= $tIdx ?>, this, event)">
                  
                  <!-- Front Face -->
                  <div class="absolute inset-0 [backface-visibility:hidden] flex flex-col">
                    <div class="relative h-40 overflow-hidden shrink-0">
                      <span class="inline-block relative w-full h-full">
                        <img src="<?= htmlspecialchars($tWs['image']) ?>" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="<?= htmlspecialchars($tWs['title']) ?>">
                      </span>
                      <div class="absolute inset-0 bg-gradient-to-t from-card via-black/40 to-transparent"></div>
                      <span class="absolute top-3 left-3 font-heading text-2xl text-gradient-gold"><?= $tNumStr ?></span>
                      <?php if ($tIsFull): ?>
                        <span class="absolute top-3 right-3 inline-flex items-center text-[9px] uppercase tracking-[0.15em] px-2 py-0.5 rounded-full border backdrop-blur-sm text-white/70 border-white/25 bg-white/10">Đã đầy</span>
                      <?php else: ?>
                        <span class="absolute top-3 right-3 inline-flex items-center text-[9px] uppercase tracking-[0.15em] px-2 py-0.5 rounded-full border backdrop-blur-sm text-emerald-300 border-emerald-400/40 bg-emerald-500/20">Còn nhận đăng ký</span>
                      <?php endif; ?>
                    </div>

                    <div class="p-5 flex flex-col flex-1">
                      <h3 class="font-heading text-lg text-foreground mb-1.5 leading-tight"><?= htmlspecialchars($tWs['title']) ?></h3>
                      <p class="text-xs text-muted-foreground mb-3"><?= htmlspecialchars($tWs['schedule']) ?></p>
                      
                      <div class="flex items-center gap-1.5 text-xs text-foreground/70 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coins w-3.5 h-3.5 text-[var(--gold)]"><circle cx="8" cy="8" r="6"></circle><path d="M18.09 10.37A6 6 0 1 1 10.34 18"></path><path d="M7 6h1v4"></path><path d="m16.71 13.88.7.71-2.82 2.82"></path></svg> 
                        <?= htmlspecialchars($tPriceText) ?>
                      </div>

                      <?php if ($tIsFull): ?>
                        <p class="text-xs font-semibold text-muted-foreground mb-3">Đã hết chỗ</p>
                      <?php else: ?>
                        <p class="text-xs font-semibold text-[var(--wine)] mb-3">Chỉ còn <?= $tRem ?> chỗ</p>
                      <?php endif; ?>

                      <div class="flex-1"></div>

                      <?php if ($tIsFull): ?>
                        <button type="button" onclick="event.stopPropagation(); scrollToId('register');" class="w-full py-3 rounded-sm text-xs uppercase tracking-[0.18em] font-medium min-h-[44px] btn-ghost text-muted-foreground">Giữ chỗ cho lần tới</button>
                      <?php else: ?>
                        <button type="button" onclick="event.stopPropagation(); scrollToId('register');" class="w-full py-3 rounded-sm text-xs uppercase tracking-[0.18em] font-medium min-h-[44px] btn-invert">Giữ chỗ</button>
                      <?php endif; ?>
                    </div>
                  </div>

                  <!-- Back Face (Details) -->
                  <div class="absolute inset-0 [backface-visibility:hidden] [transform:rotateY(180deg)] rounded-sm border border-[var(--wine)]/30 bg-background p-5 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                      <p class="text-[9px] uppercase tracking-[0.25em] text-[var(--gold)]">Thông tin Workshop</p>
                      <?php if ($tIsFull): ?>
                        <span class="inline-flex items-center text-[9px] uppercase tracking-[0.15em] px-2 py-0.5 rounded-full border text-white/70 border-white/20 bg-white/5">Đã đầy</span>
                      <?php else: ?>
                        <span class="inline-flex items-center text-[9px] uppercase tracking-[0.15em] px-2 py-0.5 rounded-full border text-emerald-600 dark:text-emerald-400 border-emerald-500/30 bg-emerald-500/10">Còn nhận đăng ký</span>
                      <?php endif; ?>
                    </div>

                    <h3 class="font-heading text-base text-foreground mb-3 leading-tight"><?= htmlspecialchars($tWs['title']) ?></h3>

                    <div class="space-y-3 text-xs flex-1">
                      <div class="flex items-center justify-between">
                        <span class="text-foreground/60 uppercase tracking-wide text-[10px]">Học phí dự kiến</span>
                        <span class="text-xs text-foreground font-medium"><?= htmlspecialchars($tPriceText) ?></span>
                      </div>
                      <div class="flex items-center justify-between">
                        <span class="text-foreground/60 uppercase tracking-wide text-[10px]">Sĩ số lớp</span>
                        <span class="text-xs text-foreground font-medium">8 – <?= (int)$tWs['max_participants'] ?> học viên</span>
                      </div>
                      <div class="flex items-center justify-between border-t border-border pt-2.5">
                        <span class="text-foreground/60 uppercase tracking-wide text-[10px]">Số chỗ còn nhận</span>
                        <?php if ($tIsFull): ?>
                          <span class="text-xs font-semibold text-muted-foreground">Đã hết chỗ</span>
                        <?php else: ?>
                          <span class="text-xs font-bold text-[var(--wine)] animate-pulse">Chỉ còn <?= $tRem ?> chỗ</span>
                        <?php endif; ?>
                      </div>
                    </div>

                    <div class="flex flex-col gap-2 mt-4">
                      <button type="button" onclick="event.stopPropagation(); scrollToId('register');" class="w-full py-2.5 rounded-sm text-xs uppercase tracking-[0.18em] font-medium min-h-[40px] btn-invert">Giữ chỗ</button>
                      <button type="button" onclick="event.stopPropagation(); toggleWorkshopCardFlip(this.closest('.workshop-flip-card'), event);" class="btn-ghost w-full py-2 rounded-sm text-[11px] uppercase tracking-[0.15em] font-medium min-h-[38px]">Xem mặt trước</button>
                    </div>
                  </div>

                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Coverflow Stack Carousel Navigation -->
          <div class="flex items-center justify-center gap-4 mt-8">
            <button id="btnTopicPrev" onclick="prevTopicSlide()" class="w-11 h-11 rounded-full border border-border flex items-center justify-center text-foreground/70 hover:border-[var(--wine)] hover:text-[var(--wine)] transition-colors" aria-label="Trước">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-5 h-5"><path d="m15 18-6-6 6-6"></path></svg>
            </button>
            <span id="topicIndicator" class="text-xs uppercase tracking-[0.2em] text-muted-foreground tabular-nums">1 / <?= count($topicWorkshops) ?></span>
            <button id="btnTopicNext" onclick="nextTopicSlide()" class="w-11 h-11 rounded-full border border-border flex items-center justify-center text-foreground/70 hover:border-[var(--wine)] hover:text-[var(--wine)] transition-colors" aria-label="Sau">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-5 h-5"><path d="m9 18 6-6-6-6"></path></svg>
            </button>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
