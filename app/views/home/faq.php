<?php
if (empty($faqs)) {
    $faqs = [
        [
            'id' => 1,
            'question' => 'Amis du Vin có phục vụ tiệc riêng tư theo yêu cầu không?',
            'answer' => 'Có. Chúng tôi thiết kế thực đơn và lựa chọn rượu vang riêng cho từng bữa tiệc, phù hợp sở thích, ngân sách và dịp lễ của Quý khách.'
        ],
        [
            'id' => 2,
            'question' => 'Mỗi buổi tiệc phục vụ tối đa bao nhiêu khách?',
            'answer' => 'Không gian ấm cúng tối ưu cho nhóm từ 8 đến 30 khách. Với quy mô lớn hơn, vui lòng liên hệ để chúng tôi bố trí riêng.'
        ],
        [
            'id' => 3,
            'question' => 'Tôi cần đặt trước bao lâu?',
            'answer' => 'Khuyến nghị đặt trước 3–5 ngày để Sommelier và Bếp chuẩn bị thực đơn tốt nhất. Các gói Premium nên đặt trước 1–2 tuần.'
        ],
        [
            'id' => 4,
            'question' => 'Chưa hiểu về rượu vang, có tham gia được không?',
            'answer' => 'Tuyệt đối được. Trải nghiệm dành cho mọi trình độ — Sommelier hướng dẫn từ cơ bản, giúp Quý khách tự tin thưởng thức.'
        ],
        [
            'id' => 5,
            'question' => 'Chi phí bao gồm những gì?',
            'answer' => 'Đã bao gồm thực đơn ẩm thực, rượu vang pairing, không gian riêng và sự hướng dẫn trực tiếp của Sommelier trong suốt bữa tiệc.'
        ],
        [
            'id' => 6,
            'question' => 'Có hỗ trợ khách ăn chay hoặc dị ứng không?',
            'answer' => 'Có. Vui lòng ghi chú yêu cầu đặc biệt khi đặt tiệc, bếp sẽ chuẩn bị thực đơn thay thế phù hợp.'
        ],
        [
            'id' => 7,
            'question' => 'Chính sách hoàn/hủy đặt tiệc thế nào?',
            'answer' => 'Hoàn 100% nếu hủy trước 72 giờ. Trong vòng 72 giờ, giữ 50% chi phí. Chi tiết xem tại mục chính sách cạnh Form đặt tiệc.'
        ]
    ];
}
?>
<section id="faq" class="scroll-anchor relative py-24 sm:py-32 bg-background">
  <div class="max-w-3xl mx-auto px-5 sm:px-8">
    <div class="reveal is-visible">
      <div class="text-center mb-12">
        <span class="editorial-tag inline-block font-body-modern text-[11px] uppercase tracking-[0.25em] font-semibold text-[var(--gold)] border border-champagneGold/40 bg-champagneGold/10 px-3.5 py-1 mb-4 rounded-sm">
          Giải đáp thắc mắc
        </span>
        <h2 class="font-heading-editorial text-3xl sm:text-5xl text-foreground font-bold tracking-wide">Câu Hỏi Thường Gặp (FAQ)</h2>
      </div>
    </div>
    <div class="space-y-3">
      <?php foreach ($faqs as $faq): ?>
        <div class="reveal is-visible">
          <div class="faq-item rounded-sm border bg-card/60 transition-colors duration-300 border-champagneGold/20 hover:border-champagneGold/50">
            <button type="button" class="faq-toggle w-full flex items-center justify-between gap-4 text-left px-5 sm:px-6 py-5 min-h-[64px]" aria-expanded="false">
              <span class="font-heading-editorial text-base sm:text-xl text-foreground font-semibold tracking-wide"><?= htmlspecialchars($faq['question']) ?></span>
              <span class="faq-icon shrink-0 w-8 h-8 rounded-full flex items-center justify-center transition-colors bg-champagneGold/10 text-[var(--gold)] border border-champagneGold/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
              </span>
            </button>
            <div class="faq-content hidden overflow-hidden transition-all duration-300">
              <p class="px-5 sm:px-6 pb-5 font-body-modern text-sm text-muted-foreground leading-relaxed"><?= htmlspecialchars($faq['answer']) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
