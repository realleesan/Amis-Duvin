<?php
if (empty($benefits)) {
    $benefits = [
        [
            'id' => 1,
            'title' => 'Hiểu vang dễ dàng',
            'description' => 'Kiến thức rượu vang được truyền đạt gần gũi, thực tế — ai cũng tự tin thưởng thức và chọn vang cho mọi dịp.',
            'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wine w-6 h-6"><path d="M8 22h8"></path><path d="M7 10h10"></path><path d="M12 15v7"></path><path d="M12 15a5 5 0 0 0 5-5c0-2-.5-4-2-8H9c-1.5 4-2 6-2 8a5 5 0 0 0 5 5Z"></path></svg>'
        ],
        [
            'id' => 2,
            'title' => 'Trải nghiệm cùng chuyên gia',
            'description' => 'Được dẫn dắt trực tiếp bởi Sommelier Alex Thịnh với hơn 24 năm kinh nghiệm tại các nhà hàng, khách sạn 5 sao.',
            'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-6 h-6"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>'
        ],
        [
            'id' => 3,
            'title' => 'Kết nối trong không gian thân mật',
            'description' => 'Không gian nhỏ, ấm cúng — nơi mỗi buổi tiệc trở thành câu chuyện kết nối giữa người, vang và ẩm thực.',
            'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-6 h-6"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>'
        ]
    ];
}
?>
<section id="about" class="scroll-anchor relative py-24 sm:py-28 bg-background overflow-hidden">
  <div class="absolute inset-0 bg-wine-radial opacity-60"></div>
  <div class="relative max-w-7xl mx-auto px-5 sm:px-8">
    <div class="reveal is-visible">
      <div class="text-center max-w-2xl mx-auto mb-14">
        <span class="editorial-tag inline-block font-body-modern text-[11px] uppercase tracking-[0.25em] font-semibold text-[var(--gold)] border border-champagneGold/40 bg-champagneGold/10 px-3.5 py-1 mb-4 rounded-sm">
          Về Amis du Vin
        </span>
        <h2 class="font-heading-editorial text-3xl sm:text-5xl text-foreground font-bold tracking-wide">Lợi ích Cốt lõi</h2>
      </div>
    </div>
    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 lg:gap-8">
      <?php foreach ($benefits as $b): ?>
        <div class="reveal is-visible">
          <div class="card-lift h-full rounded-sm border-thin-gold bg-card/60 p-8 text-center backdrop-blur-sm transition-all duration-300 hover:border-champagneGold/60 shadow-sm">
            <!-- Minimal Line Icon Frame -->
            <div class="w-14 h-14 rounded-full border-thin-gold bg-champagneGold/10 flex items-center justify-center mx-auto mb-6 text-[var(--gold)] shadow-sm">
              <?= $b['icon_svg'] ?>
            </div>
            <h3 class="font-heading-editorial text-xl text-foreground mb-3 font-semibold"><?= htmlspecialchars($b['title']) ?></h3>
            <p class="font-body-modern text-sm text-muted-foreground leading-relaxed"><?= htmlspecialchars($b['description']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="reveal is-visible">
      <div class="flex items-center justify-center gap-4 mt-12">
        <span class="hairline w-12"></span>
        <p class="text-center text-xs sm:text-sm uppercase tracking-[0.2em] text-foreground/55">Amis du Vin — Một thương hiệu thuộc hệ sinh thái Vang Huy Phong</p>
        <span class="hairline w-12"></span>
      </div>
    </div>
  </div>
</section>
