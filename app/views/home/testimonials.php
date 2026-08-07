<?php
if (empty($testimonials)) {
    $testimonials = [
        [
            'id' => 1,
            'name' => 'Anh Trần Tuấn Minh',
            'role' => 'CEO · Công ty Đầu tư',
            'package_tag' => 'Gói Signature Pairing',
            'avatar' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/0c749a039_generated_image.png/v1/fill/w_56,h_56,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/0c749a039_generated_image.webp',
            'avatar_initials' => null,
            'rating' => 5,
            'content' => '“Bữa tiệc hoàn hảo đến từng chi tiết. Sommelier Alex Thịnh kể chuyện vang cuốn hút, khách hàng đối tác của tôi rất ấn tượng.”'
        ],
        [
            'id' => 2,
            'name' => 'Chị Lê Hoàng Yến',
            'role' => 'Giám đốc Marketing',
            'package_tag' => 'Gói Gourmet Selection',
            'avatar' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/054117747_generated_image.png/v1/fill/w_56,h_56,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/054117747_generated_image.webp',
            'avatar_initials' => null,
            'rating' => 5,
            'content' => '“Không gian nhỏ, riêng tư, ấm cúng. Pairing rượu và món ăn tinh tế — một trải nghiệm văn hoá đúng nghĩa.”'
        ],
        [
            'id' => 3,
            'name' => 'Anh Phạm Đức Anh',
            'role' => 'Doanh nhân',
            'package_tag' => 'Workshop Wine & Food Romance',
            'avatar' => null,
            'avatar_initials' => 'ĐA',
            'rating' => 5,
            'content' => '“Tôi không rành vang nhưng được hướng dẫn rất gần gũi. Ra về tự tin chọn vang cho bữa tiệc gia đình.”'
        ],
        [
            'id' => 4,
            'name' => 'Chị Vũ Thu Hà',
            'role' => 'Chủ Spa cao cấp',
            'package_tag' => 'Gói Private Cellar',
            'avatar' => null,
            'avatar_initials' => 'TH',
            'rating' => 5,
            'content' => '“Dịch vụ chu đáo, khách hàng VIP của tôi đều hài lòng. Sẽ quay lại cho các dịp kỷ niệm quan trọng.”'
        ],
        [
            'id' => 5,
            'name' => 'Anh Nguyễn Quốc Bảo',
            'role' => 'Nhà đầu tư',
            'package_tag' => 'Amis du Vin Gala Night',
            'avatar' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/c14ed7531_generated_image.png/v1/fill/w_56,h_56,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/c14ed7531_generated_image.webp',
            'avatar_initials' => null,
            'rating' => 5,
            'content' => '“Đẳng cấp và tinh tế. Đêm Gala thật sự vượt mong đợi — điểm đến xứng đáng cho giới doanh nhân.”'
        ]
    ];
}
?>
<section class="relative py-24 sm:py-32 bg-card">
  <div class="max-w-7xl mx-auto px-5 sm:px-8">
    <div class="reveal is-visible">
      <div class="text-center max-w-2xl mx-auto mb-14">
        <p class="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-4">Khách hàng nói gì</p>
        <h2 class="font-heading text-3xl sm:text-5xl text-foreground mb-5">Dẫn chứng tin cậy</h2>
      </div>
    </div>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
      <?php foreach ($testimonials as $t): ?>
        <div class="reveal is-visible">
          <div class="card-lift h-full rounded-sm border border-border bg-background p-7 flex flex-col">
            <div class="flex items-center gap-4 mb-5">
              <?php if (!empty($t['avatar'])): ?>
                <span class="inline-block relative w-14 h-14 rounded-full shrink-0 overflow-hidden">
                  <img src="<?= htmlspecialchars($t['avatar']) ?>" loading="lazy" class="w-full h-full object-cover" alt="<?= htmlspecialchars($t['name']) ?>">
                </span>
              <?php else: ?>
                <div class="w-14 h-14 rounded-full bg-[var(--wine)]/10 border border-[var(--wine)]/25 flex items-center justify-center font-heading text-base text-[var(--wine)] shrink-0">
                  <?= htmlspecialchars($t['avatar_initials'] ?? 'AV') ?>
                </div>
              <?php endif; ?>
              
              <div class="min-w-0">
                <p class="font-heading text-sm text-foreground truncate"><?= htmlspecialchars($t['name']) ?></p>
                <p class="text-xs text-muted-foreground truncate"><?= htmlspecialchars($t['role']) ?></p>
              </div>
            </div>
            
            <span class="inline-flex items-center self-start gap-1.5 text-[10px] uppercase tracking-[0.12em] px-2.5 py-1 rounded-full border border-[var(--gold)]/30 bg-[var(--gold)]/10 text-[var(--gold)] mb-4">
              <?= htmlspecialchars($t['package_tag']) ?>
            </span>
            
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-quote w-7 h-7 text-[var(--wine)]/25 mb-3">
              <path d="M16 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"></path>
              <path d="M5 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"></path>
            </svg>
            
            <div class="flex gap-0.5 mb-4">
              <?php $rating = (int)($t['rating'] ?? 5); ?>
              <?php for ($i = 0; $i < $rating; $i++): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-4 h-4 fill-[var(--gold)] text-[var(--gold)]"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
              <?php endfor; ?>
            </div>
            
            <p class="text-sm text-foreground/80 leading-relaxed flex-1"><?= htmlspecialchars($t['content']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
