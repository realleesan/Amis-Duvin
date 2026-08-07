<section id="workshops" class="py-24 bg-[#141113] border-t border-[#332a2e]">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <p class="text-[#D4AF37] text-xs uppercase tracking-[0.35em] mb-3">Lớp học &amp; Nếm thử</p>
      <h2 class="font-heading text-3xl sm:text-5xl text-[#f4ede4]">Các Buổi Workshop Sắp Tới</h2>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
      <?php foreach ($workshops as $ws): ?>
        <div class="bg-[#191517] border border-[#332a2e] rounded-sm overflow-hidden flex flex-col justify-between">
          <div>
            <div class="h-48 relative overflow-hidden border-b border-[#332a2e]">
              <img src="<?= htmlspecialchars($ws['image']) ?>" alt="<?= htmlspecialchars($ws['title']) ?>" class="w-full h-full object-cover" />
              <span class="absolute top-3 right-3 bg-[#722F37] text-white text-[10px] uppercase font-bold px-3 py-1 rounded-sm">
                <?= htmlspecialchars($ws['level']) ?>
              </span>
            </div>
            <div class="p-6">
              <h3 class="font-heading text-2xl text-[#f4ede4] mb-3"><?= htmlspecialchars($ws['title']) ?></h3>
              <p class="text-xs text-[#D4AF37] mb-4"><?= htmlspecialchars($ws['schedule']) ?></p>
              <p class="text-xs text-[#a69c96] mb-2">📍 <?= htmlspecialchars($ws['location']) ?></p>
              <p class="text-xs text-[#a69c96]">🍷 Nếm thử <?= (int)$ws['wines_count'] ?> dòng vang tuyển chọn</p>
            </div>
          </div>

          <div class="p-6 pt-0 border-t border-[#332a2e]/50 mt-4 flex items-center justify-between">
            <div>
              <span class="text-[10px] text-[#a69c96] uppercase block">Học phí</span>
              <span class="font-heading text-xl text-[#D4AF37] font-bold"><?= number_format($ws['price'], 0, ',', '.') ?>đ</span>
            </div>

            <button
              data-workshop-id="<?= (int)$ws['id'] ?>"
              data-workshop-title="<?= htmlspecialchars($ws['title']) ?>"
              class="btn-wine text-xs uppercase tracking-widest px-4 py-2.5"
            >
              Đăng ký
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
