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

    <!-- 2. Section Giới thiệu Dịch vụ Settings Form (Module 3.1) -->
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

    <!-- 3. Section Các Gói tiệc Pairing Form (Module 3.2) -->
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
  </div>
</div>

<?php
$adminContent = ob_get_clean();
require __DIR__ . '/../_layout/admin_master.php';
?>
