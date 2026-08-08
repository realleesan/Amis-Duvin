<?php
$title = 'Quản lý Nội dung Landing Page — Admin CMS Amis du Vin';
$activeNav = 'content';

ob_start();
?>

<div class="space-y-8">
  <!-- Header -->
  <div class="border-b border-border/40 pb-6">
    <h2 class="font-heading text-2xl sm:text-3xl text-foreground">Quản lý Nội dung Landing Page</h2>
    <p class="text-sm text-muted-foreground mt-1">Cấu hình linh hoạt văn bản, khẩu hiệu và hình ảnh các section trên trang web</p>
  </div>

  <!-- Section Tabs / Forms Container -->
  <div class="space-y-8">
    <!-- 1. Section Hero Settings Form -->
    <div class="rounded-sm border border-border/40 bg-card p-6 sm:p-8 space-y-6 shadow-sm">
      <div class="border-b border-border/40 pb-4 flex items-center justify-between">
        <div>
          <span class="text-[10px] uppercase tracking-widest text-[var(--gold)]">Module 1.2</span>
          <h3 class="font-heading text-xl text-foreground">Cấu hình Section Hero (Đầu trang)</h3>
        </div>
        <span class="text-xs text-muted-foreground">Dynamic Content</span>
      </div>

      <form action="/admin/content/hero" method="POST" class="space-y-5">
        <div class="grid sm:grid-cols-2 gap-5">
          <div>
            <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tagline (Khẩu hiệu nhỏ)</label>
            <input type="text" name="tagline" value="<?= htmlspecialchars($hero['tagline'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>

          <div>
            <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tiêu đề chính dòng 1</label>
            <input type="text" name="title_main" value="<?= htmlspecialchars($hero['title_main'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
          <div>
            <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tiêu đề phụ dòng 2 (Font chữ nghiêng)</label>
            <input type="text" name="title_sub" value="<?= htmlspecialchars($hero['title_sub'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>

          <div>
            <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Đường dẫn Ảnh nền (Banner URL)</label>
            <input type="url" name="bg_image" value="<?= htmlspecialchars($hero['bg_image'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>
        </div>

        <div>
          <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Đoạn văn mô tả tóm tắt</label>
          <textarea name="description" rows="3" class="input-elegant w-full p-3 rounded-sm text-sm leading-relaxed"><?= htmlspecialchars($hero['description'] ?? '') ?></textarea>
        </div>

        <div class="pt-2">
          <button type="submit" class="btn-wine px-6 py-3 rounded-sm text-xs uppercase tracking-widest font-medium shadow-md">
            Lưu thay đổi Section Hero
          </button>
        </div>
      </form>
    </div>

    <!-- 2. Section 3 Lợi ích Cốt lõi (Module 2.1) -->
    <div class="rounded-sm border border-border/40 bg-card p-6 sm:p-8 space-y-6 shadow-sm">
      <div class="border-b border-border/40 pb-4 flex items-center justify-between">
        <div>
          <span class="text-[10px] uppercase tracking-widest text-[var(--gold)]">Module 2.1</span>
          <h3 class="font-heading text-xl text-foreground">Cấu hình 03 Lợi ích Cốt lõi (Core Benefits)</h3>
        </div>
        <span class="text-xs text-muted-foreground">Dynamic Content</span>
      </div>

      <div class="grid md:grid-cols-3 gap-6">
        <?php foreach ($benefits as $b): ?>
          <div class="rounded-sm border border-border/40 bg-card/40 p-5 space-y-4 shadow-sm">
            <h4 class="font-heading text-base text-foreground font-semibold flex items-center justify-between">
              <span>Lợi ích #<?= $b['id'] ?></span>
              <span class="text-xs text-[var(--gold)] font-mono">ID: <?= $b['id'] ?></span>
            </h4>

            <form action="/admin/content/benefit" method="POST" class="space-y-3">
              <input type="hidden" name="id" value="<?= $b['id'] ?>">

              <div>
                <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Tiêu đề lợi ích</label>
                <input type="text" name="title" value="<?= htmlspecialchars($b['title']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs font-medium">
              </div>

              <div>
                <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Nội dung diễn giải</label>
                <textarea name="description" rows="3" class="input-elegant w-full p-2.5 rounded-sm text-xs leading-relaxed"><?= htmlspecialchars($b['description']) ?></textarea>
              </div>

              <button type="submit" class="btn-invert w-full py-2.5 rounded-sm text-xs uppercase tracking-widest font-medium mt-2">
                Cập nhật Lợi ích này
              </button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- 3. Section Giới thiệu Dịch vụ Settings Form (Module 3.1) -->
    <div class="rounded-sm border border-border/40 bg-card p-6 sm:p-8 space-y-6 shadow-sm">
      <div class="border-b border-border/40 pb-4 flex items-center justify-between">
        <div>
          <span class="text-[10px] uppercase tracking-widest text-[var(--gold)]">Module 3.1</span>
          <h3 class="font-heading text-xl text-foreground">Cấu hình Section Giới thiệu Dịch vụ (Service Intro)</h3>
        </div>
        <span class="text-xs text-muted-foreground">Dynamic Content</span>
      </div>

      <form action="/admin/content/service-intro" method="POST" class="space-y-5">
        <div class="grid sm:grid-cols-3 gap-5">
          <div>
            <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tagline Dịch vụ</label>
            <input type="text" name="tagline" value="<?= htmlspecialchars($serviceIntro['tagline'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>

          <div>
            <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tiêu đề chính</label>
            <input type="text" name="title_main" value="<?= htmlspecialchars($serviceIntro['title_main'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>

          <div>
            <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tiêu đề phụ (Chữ nghiêng gold)</label>
            <input type="text" name="title_sub" value="<?= htmlspecialchars($serviceIntro['title_sub'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>
        </div>

        <div>
          <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Mô tả tổng quan mô hình tiệc riêng tư</label>
          <textarea name="description" rows="3" class="input-elegant w-full p-3 rounded-sm text-sm leading-relaxed"><?= htmlspecialchars($serviceIntro['description'] ?? '') ?></textarea>
        </div>

        <div>
          <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Ghi chú nhấn mạnh (Trích dẫn viền trái gold)</label>
          <textarea name="highlight_note" rows="2" class="input-elegant w-full p-3 rounded-sm text-sm leading-relaxed"><?= htmlspecialchars($serviceIntro['highlight_note'] ?? '') ?></textarea>
        </div>

        <div class="border-t border-border/40 pt-5 space-y-4">
          <p class="text-xs uppercase tracking-widest text-[var(--gold)] font-semibold">Cấu hình Card Ảnh bên phải</p>
          <div class="grid sm:grid-cols-2 gap-5">
            <div>
              <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tag Card</label>
              <input type="text" name="card_tag" value="<?= htmlspecialchars($serviceIntro['card_tag'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm">
            </div>

            <div>
              <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tiêu đề Card</label>
              <input type="text" name="card_title" value="<?= htmlspecialchars($serviceIntro['card_title'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm">
            </div>
          </div>

          <div>
            <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Đường dẫn Ảnh Card minh họa (Image URL)</label>
            <input type="url" name="card_image" value="<?= htmlspecialchars($serviceIntro['card_image'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm">
          </div>
        </div>

        <div class="pt-2">
          <button type="submit" class="btn-wine px-6 py-3 rounded-sm text-xs uppercase tracking-widest font-medium shadow-md">
            Lưu thay đổi Section Giới thiệu Dịch vụ
          </button>
        </div>
      </form>
    </div>

    <!-- 4. Section Các Gói tiệc Pairing Form (Module 3.2) -->
    <div class="rounded-sm border border-border/40 bg-card p-6 sm:p-8 space-y-6 shadow-sm">
      <div class="border-b border-border/40 pb-4 flex items-center justify-between">
        <div>
          <span class="text-[10px] uppercase tracking-widest text-[var(--gold)]">Module 3.2</span>
          <h3 class="font-heading text-xl text-foreground">Danh sách 04 Gói tiệc Food &amp; Wine Pairing</h3>
        </div>
        <span class="text-xs text-muted-foreground">Dynamic Content</span>
      </div>

      <div class="grid sm:grid-cols-2 gap-6">
        <?php foreach ($pairings as $p): ?>
          <div class="rounded-sm border border-border/40 bg-card/40 p-5 space-y-4 shadow-sm">
            <h4 class="font-heading text-lg text-foreground flex items-center justify-between">
              <span><?= htmlspecialchars($p['title']) ?></span>
              <span class="text-xs text-[var(--gold)] font-mono font-normal"><?= htmlspecialchars($p['price_text']) ?></span>
            </h4>

            <form action="/admin/content/pairing" method="POST" class="space-y-3">
              <input type="hidden" name="id" value="<?= $p['id'] ?>">

              <div>
                <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Tên gói tiệc</label>
                <input type="text" name="title" value="<?= htmlspecialchars($p['title']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs font-medium">
              </div>

              <div>
                <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Phân cấp (Standard / Premium Level)</label>
                <input type="text" name="level" value="<?= htmlspecialchars($p['level']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs">
              </div>

              <div>
                <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Mô tả tóm tắt</label>
                <textarea name="subtitle" rows="2" class="input-elegant w-full p-2.5 rounded-sm text-xs leading-relaxed"><?= htmlspecialchars($p['subtitle']) ?></textarea>
              </div>

              <div>
                <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Chi tiết Món ăn &amp; Rượu vang (Thực đơn)</label>
                <?php $menuStr = is_array($p['menu_items'] ?? null) ? json_encode($p['menu_items'], JSON_UNESCAPED_UNICODE) : ($p['menu_items'] ?? ''); ?>
                <textarea name="menu_items" rows="3" placeholder="Mô tả danh sách các món ăn và vang đi kèm" class="input-elegant w-full p-2.5 rounded-sm text-xs leading-relaxed"><?= htmlspecialchars($menuStr) ?></textarea>
              </div>

              <div class="grid grid-cols-2 gap-3">
                <div>
                  <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Mức giá khởi điểm</label>
                  <input type="text" name="price_text" value="<?= htmlspecialchars($p['price_text']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs">
                </div>

                <div>
                  <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Ảnh đại diện URL</label>
                  <input type="url" name="image" value="<?= htmlspecialchars($p['image']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs">
                </div>
              </div>

              <button type="submit" class="btn-invert w-full py-2.5 rounded-sm text-xs uppercase tracking-widest font-medium mt-2">
                Cập nhật gói tiệc này
              </button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- 5. Section Đánh giá Khách hàng Testimonials (Module 5.2 - Full CRUD) -->
    <div class="rounded-sm border border-border/40 bg-card p-6 sm:p-8 space-y-6 shadow-sm">
      <div class="border-b border-border/40 pb-4 flex items-center justify-between">
        <div>
          <span class="text-[10px] uppercase tracking-widest text-[var(--gold)]">Module 5.2</span>
          <h3 class="font-heading text-xl text-foreground">Quản lý Đánh giá Khách hàng (Testimonials)</h3>
        </div>
        
        <button type="button" onclick="openCreateTestimonialModal()" class="btn-wine inline-flex items-center gap-2 px-4 py-2 rounded-sm text-xs uppercase tracking-widest font-medium shadow-sm">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-3.5 h-3.5"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
          <span>Thêm Đánh giá mới</span>
        </button>
      </div>

      <div class="grid sm:grid-cols-2 gap-6">
        <?php foreach ($testimonials as $t): ?>
          <div class="rounded-sm border border-border/40 bg-card/40 p-5 space-y-4 shadow-sm relative group">
            <div class="flex items-center justify-between">
              <h4 class="font-heading text-base text-foreground font-semibold"><?= htmlspecialchars($t['name']) ?></h4>
              <div class="flex items-center gap-3">
                <span class="text-xs text-[var(--gold)]">★ <?= (int)($t['rating'] ?? 5) ?>/5</span>

                <!-- Delete Testimonial Form -->
                <form action="/admin/content/testimonial/delete" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?');" class="inline">
                  <input type="hidden" name="id" value="<?= $t['id'] ?>">
                  <button type="submit" class="p-1 rounded text-muted-foreground hover:text-rose-400 hover:bg-muted transition-colors" title="Xóa đánh giá này">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                  </button>
                </form>
              </div>
            </div>

            <form action="/admin/content/testimonial" method="POST" class="space-y-3">
              <input type="hidden" name="id" value="<?= $t['id'] ?>">

              <div class="grid grid-cols-2 gap-3">
                <div>
                  <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Tên khách hàng</label>
                  <input type="text" name="name" value="<?= htmlspecialchars($t['name']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs font-medium">
                </div>

                <div>
                  <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Chức danh / Công ty</label>
                  <input type="text" name="role" value="<?= htmlspecialchars($t['role']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs">
                </div>
              </div>

              <div class="grid grid-cols-2 gap-3">
                <div>
                  <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Tag Gói dịch vụ</label>
                  <input type="text" name="package_tag" value="<?= htmlspecialchars($t['package_tag'] ?? 'Gói Signature Pairing') ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs">
                </div>

                <div>
                  <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Số sao (1 - 5)</label>
                  <input type="number" name="rating" min="1" max="5" value="<?= (int)($t['rating'] ?? 5) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs font-mono">
                </div>
              </div>

              <div>
                <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Nội dung đánh giá</label>
                <textarea name="content" rows="3" class="input-elegant w-full p-2.5 rounded-sm text-xs leading-relaxed"><?= htmlspecialchars($t['content'] ?? $t['quote'] ?? '') ?></textarea>
              </div>

              <div>
                <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">URL Avatar Ảnh đại diện</label>
                <input type="url" name="avatar" value="<?= htmlspecialchars($t['avatar']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs">
              </div>

              <button type="submit" class="btn-invert w-full py-2.5 rounded-sm text-xs uppercase tracking-widest font-medium mt-2">
                Cập nhật đánh giá này
              </button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- 6. Section Câu hỏi Thường gặp FAQ (Module 5.3 - Full CRUD) -->
    <div class="rounded-sm border border-border/40 bg-card p-6 sm:p-8 space-y-6 shadow-sm">
      <div class="border-b border-border/40 pb-4 flex items-center justify-between">
        <div>
          <span class="text-[10px] uppercase tracking-widest text-[var(--gold)]">Module 5.3</span>
          <h3 class="font-heading text-xl text-foreground">Quản lý Câu hỏi Thường gặp (FAQ Accordion)</h3>
        </div>

        <button type="button" onclick="openCreateFaqModal()" class="btn-wine inline-flex items-center gap-2 px-4 py-2 rounded-sm text-xs uppercase tracking-widest font-medium shadow-sm">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-3.5 h-3.5"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
          <span>Thêm FAQ mới</span>
        </button>
      </div>

      <div class="space-y-4">
        <?php foreach ($faqs as $f): ?>
          <div class="rounded-sm border border-border/40 bg-card/40 p-5 space-y-3 shadow-sm">
            <div class="flex items-center justify-between">
              <span class="text-xs uppercase tracking-widest text-[var(--gold)] font-mono">FAQ #<?= $f['id'] ?></span>
              <form action="/admin/content/faq/delete" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa câu hỏi FAQ này?');" class="inline">
                <input type="hidden" name="id" value="<?= $f['id'] ?>">
                <button type="submit" class="p-1 rounded text-muted-foreground hover:text-rose-400 hover:bg-muted transition-colors" title="Xóa câu hỏi FAQ này">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                </button>
              </form>
            </div>

            <form action="/admin/content/faq" method="POST" class="space-y-3">
              <input type="hidden" name="id" value="<?= $f['id'] ?>">

              <div>
                <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Câu hỏi</label>
                <input type="text" name="question" value="<?= htmlspecialchars($f['question']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs font-semibold">
              </div>

              <div>
                <label class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Câu trả lời chi tiết</label>
                <textarea name="answer" rows="3" class="input-elegant w-full p-2.5 rounded-sm text-xs leading-relaxed"><?= htmlspecialchars($f['answer']) ?></textarea>
              </div>

              <div class="text-right">
                <button type="submit" class="btn-invert px-5 py-2 rounded-sm text-xs uppercase tracking-widest font-medium">
                  Cập nhật câu hỏi này
                </button>
              </div>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal Thêm Đánh giá Testimonial mới -->
<div id="createTestimonialModal" class="modal-overlay">
  <div class="relative w-full max-w-lg bg-card border border-border/40 rounded-sm p-6 sm:p-8 shadow-2xl animate-scale-in my-auto">
    <button onclick="closeCreateTestimonialModal()" type="button" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>

    <h3 class="font-heading text-xl text-foreground mb-4">Thêm Đánh giá Khách hàng mới</h3>

    <form action="/admin/content/testimonial/create" method="POST" class="space-y-4">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Tên khách hàng *</label>
          <input type="text" name="name" required placeholder="Anh Nguyễn Văn A" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm font-medium">
        </div>

        <div>
          <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Chức danh / Công ty</label>
          <input type="text" name="role" placeholder="CEO / Doanh nhân" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Tag Gói tiệc</label>
          <input type="text" name="package_tag" value="Gói Signature Pairing" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
        </div>

        <div>
          <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Số sao đánh giá (1-5)</label>
          <input type="number" name="rating" min="1" max="5" value="5" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm font-mono">
        </div>
      </div>

      <div>
        <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Nội dung đánh giá *</label>
        <textarea name="content" rows="3" required placeholder="Trải nghiệm tuyệt vời, không gian riêng tư đẳng cấp..." class="input-elegant w-full p-3 rounded-sm text-sm leading-relaxed"></textarea>
      </div>

      <div>
        <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">URL Avatar Ảnh đại diện</label>
        <input type="url" name="avatar" placeholder="https://..." class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
      </div>

      <div class="pt-2 flex gap-3">
        <button type="submit" class="btn-wine flex-1 py-3 rounded-sm text-xs uppercase tracking-widest font-medium">
          Thêm đánh giá mới
        </button>
        <button type="button" onclick="closeCreateTestimonialModal()" class="px-5 py-3 rounded-sm bg-muted text-xs uppercase tracking-widest text-muted-foreground hover:text-foreground">
          Hủy
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Thêm FAQ mới -->
<div id="createFaqModal" class="modal-overlay">
  <div class="relative w-full max-w-lg bg-card border border-border/40 rounded-sm p-6 sm:p-8 shadow-2xl animate-scale-in my-auto">
    <button onclick="closeCreateFaqModal()" type="button" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>

    <h3 class="font-heading text-xl text-foreground mb-4">Thêm Câu hỏi FAQ mới</h3>

    <form action="/admin/content/faq/create" method="POST" class="space-y-4">
      <div>
        <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Câu hỏi *</label>
        <input type="text" name="question" required placeholder="Nhà hàng có chỗ đỗ xe ô tô không?" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm font-semibold">
      </div>

      <div>
        <label class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Câu trả lời chi tiết *</label>
        <textarea name="answer" rows="4" required placeholder="Có, Amis du Vin có bãi đỗ xe ô tô miễn phí ngay trước sảnh..." class="input-elegant w-full p-3 rounded-sm text-sm leading-relaxed"></textarea>
      </div>

      <div class="pt-2 flex gap-3">
        <button type="submit" class="btn-wine flex-1 py-3 rounded-sm text-xs uppercase tracking-widest font-medium">
          Thêm câu hỏi FAQ
        </button>
        <button type="button" onclick="closeCreateFaqModal()" class="px-5 py-3 rounded-sm bg-muted text-xs uppercase tracking-widest text-muted-foreground hover:text-foreground">
          Hủy
        </button>
      </div>
    </form>
  </div>
</div>

<script>
function openCreateTestimonialModal() {
  document.getElementById('createTestimonialModal').classList.add('active');
}
function closeCreateTestimonialModal() {
  document.getElementById('createTestimonialModal').classList.remove('active');
}
function openCreateFaqModal() {
  document.getElementById('createFaqModal').classList.add('active');
}
function closeCreateFaqModal() {
  document.getElementById('createFaqModal').classList.remove('active');
}
</script>

<?php
$adminContent = ob_get_clean();
require __DIR__ . '/../_layout/admin_master.php';
?>
