<?php
$title = 'Quản lý Nội dung Landing Page — Admin CMS Amis du Vin';
$activeNav = 'content';

ob_start();
?>

<div class="space-y-8">
  <!-- Header & Quick Section Filter -->
  <div class="border-b border-border/40 pb-6 space-y-4">
    <div>
      <h2 class="font-heading text-2xl sm:text-3xl text-foreground">Quản lý Nội dung Landing Page</h2>
      <p class="text-sm text-muted-foreground mt-1">Cấu hình linh hoạt văn bản, khẩu hiệu và hình ảnh các section trên trang web</p>
    </div>

    <!-- Top Section Quick Selector Bar -->
    <div class="flex flex-wrap items-center gap-1.5 p-1.5 rounded-sm bg-muted/30 border border-border/40 text-xs overflow-x-auto">
      <?php
        $secs = [
          'all' => 'Tất cả các phần',
          'seo' => '1. SEO & Meta Tags',
          'hero' => '2. Banner Hero',
          'service-intro' => '3. Giới thiệu Dịch vụ',
          'pairings' => '4. Gói tiệc Pairing',
          'workshops' => '5. Gói Workshop',
          'benefits' => '6. Lợi ích cốt lõi',
          'testimonials' => '7. Đánh giá khách hàng',
          'faq' => '8. Câu hỏi FAQ'
        ];
        foreach ($secs as $secKey => $secLabel):
          $isActive = ($activeSection ?? 'all') === $secKey;
      ?>
        <a href="<?= admin_url('content') ?>?sec=<?= $secKey ?>" class="px-3 py-1.5 rounded-sm font-semibold whitespace-nowrap transition-colors <?= $isActive ? 'bg-card text-[var(--gold)] border border-border/40 shadow-sm' : 'text-muted-foreground hover:text-foreground hover:bg-muted/50' ?>">
          <?= $secLabel ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Section Forms Container -->
  <div class="space-y-8">
    <?php if (in_array($activeSection ?? 'all', ['all', 'seo'], true)): ?>
    <!-- 0. SEO & Meta Tags Settings Form (Module 2.3 & 9.1) -->
    <div class="rounded-sm border border-border/40 bg-card p-6 sm:p-8 space-y-6 shadow-sm">
      <div class="border-b border-border/40 pb-4 flex items-center justify-between">
        <div>
          <span class="text-[10px] uppercase tracking-widest text-[var(--gold)]">Module 2.3 &amp; 9.1</span>
          <h3 class="font-heading text-xl text-foreground">Cấu hình SEO Meta Tags &amp; Open Graph (Zalo/FB Sharing)</h3>
        </div>
        <span class="text-xs text-muted-foreground">SEO Optimization</span>
      </div>

      <form action="<?= admin_url('content/seo') ?>" method="POST" class="space-y-5">
        <div class="grid sm:grid-cols-2 gap-5">
          <div>
            <label for="seoMetaTitle" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Meta Title (Tiêu đề SEO Trang chủ) *</label>
            <input type="text" id="seoMetaTitle" name="meta_title" required value="<?= htmlspecialchars($seo['meta_title'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>

          <div>
            <label for="seoCanonicalUrl" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Canonical URL (Đường dẫn chuẩn)</label>
            <input type="url" id="seoCanonicalUrl" name="canonical_url" required value="<?= htmlspecialchars($seo['canonical_url'] ?? 'https://amis.duvin.vn/') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>
        </div>

        <div>
          <label for="seoMetaDescription" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Meta Description (Mô tả SEO khi tìm kiếm) *</label>
          <textarea id="seoMetaDescription" name="meta_description" rows="3" required class="input-elegant w-full p-3 rounded-sm text-sm leading-relaxed"><?= htmlspecialchars($seo['meta_description'] ?? '') ?></textarea>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
          <div>
            <label for="seoMetaKeywords" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Meta Keywords (Từ khóa SEO cách nhau bởi dấu phẩy)</label>
            <input type="text" id="seoMetaKeywords" name="meta_keywords" value="<?= htmlspecialchars($seo['meta_keywords'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>

          <div>
            <label for="seoOgImage" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Open Graph Image URL (Ảnh xem trước khi gửi Zalo/FB) *</label>
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 rounded border border-border/60 bg-muted/30 overflow-hidden shrink-0 flex items-center justify-center relative">
                <img id="preview_seoOgImage" src="<?= htmlspecialchars($seo['og_image'] ?? '') ?>" onclick="openAdminImageLightbox(this.src)" title="Bấm để xem ảnh phóng to" class="w-full h-full object-cover cursor-pointer hover:opacity-80 transition-opacity <?= empty($seo['og_image']) ? 'hidden' : '' ?>" alt="Preview">
                <span class="preview-placeholder text-[9px] text-muted-foreground font-mono uppercase text-center px-1 <?= !empty($seo['og_image']) ? 'hidden' : '' ?>">No img</span>
              </div>
              <div class="flex-1 space-y-1.5">
                <input type="text" id="seoOgImage" name="og_image" required value="<?= htmlspecialchars($seo['og_image'] ?? '') ?>" placeholder="URL ảnh hoặc chọn từ máy..." class="input-elegant w-full px-3.5 py-2 rounded-sm text-xs font-medium" oninput="updateImagePreview(this, 'preview_seoOgImage')">
                <div class="flex items-center gap-2">
                  <label class="px-2.5 py-1 rounded bg-muted hover:bg-muted/80 border border-border/50 text-[11px] text-foreground font-medium cursor-pointer inline-flex items-center gap-1.5 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>
                    <span>Tải ảnh từ máy</span>
                    <input type="file" accept="image/*" class="sr-only" onchange="handleAdminImageUpload(this, 'seoOgImage', 'preview_seoOgImage')">
                  </label>
                  <span class="upload-status text-[11px] text-muted-foreground italic"></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="pt-2">
          <button type="submit" class="btn-wine px-6 py-3 rounded-sm text-xs uppercase tracking-widest font-medium shadow-md">
            Lưu thay đổi Cấu hình SEO
          </button>
        </div>
      </form>
    </div>
    <?php endif; ?>

    <?php if (in_array($activeSection ?? 'all', ['all', 'hero'], true)): ?>
    <!-- 1. Section Hero Settings Form -->
    <div class="rounded-sm border border-border/40 bg-card p-6 sm:p-8 space-y-6 shadow-sm">
      <div class="border-b border-border/40 pb-4 flex items-center justify-between">
        <div>
          <span class="text-[10px] uppercase tracking-widest text-[var(--gold)]">Module 1.2</span>
          <h3 class="font-heading text-xl text-foreground">Cấu hình Section Hero (Đầu trang)</h3>
        </div>
        <span class="text-xs text-muted-foreground">Dynamic Content</span>
      </div>

      <form action="<?= admin_url('content/hero') ?>" method="POST" class="space-y-5">
        <div class="grid sm:grid-cols-2 gap-5">
          <div>
            <label for="heroTagline" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tagline (Khẩu hiệu nhỏ)</label>
            <input type="text" id="heroTagline" name="tagline" autocomplete="off" value="<?= htmlspecialchars($hero['tagline'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>

          <div>
            <label for="heroTitleMain" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tiêu đề chính dòng 1</label>
            <input type="text" id="heroTitleMain" name="title_main" autocomplete="off" value="<?= htmlspecialchars($hero['title_main'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
          <div>
            <label for="heroTitleSub" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tiêu đề phụ dòng 2 (Font chữ nghiêng)</label>
            <input type="text" id="heroTitleSub" name="title_sub" autocomplete="off" value="<?= htmlspecialchars($hero['title_sub'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>

          <div>
            <label for="heroBgImage" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Đường dẫn Ảnh nền (Banner URL)</label>
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 rounded border border-border/60 bg-muted/30 overflow-hidden shrink-0 flex items-center justify-center relative">
                <img id="preview_heroBgImage" src="<?= htmlspecialchars($hero['bg_image'] ?? '') ?>" onclick="openAdminImageLightbox(this.src)" title="Bấm để xem ảnh phóng to" class="w-full h-full object-cover cursor-pointer hover:opacity-80 transition-opacity <?= empty($hero['bg_image']) ? 'hidden' : '' ?>" alt="Preview">
                <span class="preview-placeholder text-[9px] text-muted-foreground font-mono uppercase text-center px-1 <?= !empty($hero['bg_image']) ? 'hidden' : '' ?>">No img</span>
              </div>
              <div class="flex-1 space-y-1.5">
                <input type="text" id="heroBgImage" name="bg_image" autocomplete="off" value="<?= htmlspecialchars($hero['bg_image'] ?? '') ?>" placeholder="URL ảnh hoặc chọn từ máy..." class="input-elegant w-full px-3.5 py-2 rounded-sm text-xs font-medium" oninput="updateImagePreview(this, 'preview_heroBgImage')">
                <div class="flex items-center gap-2">
                  <label class="px-2.5 py-1 rounded bg-muted hover:bg-muted/80 border border-border/50 text-[11px] text-foreground font-medium cursor-pointer inline-flex items-center gap-1.5 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>
                    <span>Tải ảnh từ máy</span>
                    <input type="file" accept="image/*" class="sr-only" onchange="handleAdminImageUpload(this, 'heroBgImage', 'preview_heroBgImage')">
                  </label>
                  <span class="upload-status text-[11px] text-muted-foreground italic"></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <label for="heroDescription" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Đoạn văn mô tả tóm tắt</label>
          <textarea id="heroDescription" name="description" rows="3" autocomplete="off" class="input-elegant w-full p-3 rounded-sm text-sm leading-relaxed"><?= htmlspecialchars($hero['description'] ?? '') ?></textarea>
        </div>

        <div class="pt-2">
          <button type="submit" class="btn-wine px-6 py-3 rounded-sm text-xs uppercase tracking-widest font-medium shadow-md">
            Lưu thay đổi Section Hero
          </button>
        </div>
      </form>
    </div>
    <?php endif; ?>

    <?php if (in_array($activeSection ?? 'all', ['all', 'benefits'], true)): ?>
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

            <form action="<?= admin_url('content/benefit') ?>" method="POST" class="space-y-3">
              <input type="hidden" name="id" value="<?= $b['id'] ?>">

              <div>
                <label for="benefitTitle_<?= $b['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Tiêu đề lợi ích</label>
                <input type="text" id="benefitTitle_<?= $b['id'] ?>" name="title" autocomplete="off" value="<?= htmlspecialchars($b['title']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs font-medium">
              </div>

              <div>
                <label for="benefitDesc_<?= $b['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Nội dung diễn giải</label>
                <textarea id="benefitDesc_<?= $b['id'] ?>" name="description" rows="3" autocomplete="off" class="input-elegant w-full p-2.5 rounded-sm text-xs leading-relaxed"><?= htmlspecialchars($b['description']) ?></textarea>
              </div>

              <button type="submit" class="btn-invert w-full py-2.5 rounded-sm text-xs uppercase tracking-widest font-medium mt-2">
                Cập nhật Lợi ích này
              </button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

    <?php if (in_array($activeSection ?? 'all', ['all', 'service-intro'], true)): ?>
    <!-- 3. Section Giới thiệu Dịch vụ Settings Form (Module 3.1) -->
    <div class="rounded-sm border border-border/40 bg-card p-6 sm:p-8 space-y-6 shadow-sm">
      <div class="border-b border-border/40 pb-4 flex items-center justify-between">
        <div>
          <span class="text-[10px] uppercase tracking-widest text-[var(--gold)]">Module 3.1</span>
          <h3 class="font-heading text-xl text-foreground">Cấu hình Section Giới thiệu Dịch vụ (Service Intro)</h3>
        </div>
        <span class="text-xs text-muted-foreground">Dynamic Content</span>
      </div>

      <form action="<?= admin_url('content/service-intro') ?>" method="POST" class="space-y-5">
        <div class="grid sm:grid-cols-3 gap-5">
          <div>
            <label for="serviceTagline" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tagline Dịch vụ</label>
            <input type="text" id="serviceTagline" name="tagline" autocomplete="off" value="<?= htmlspecialchars($serviceIntro['tagline'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>

          <div>
            <label for="serviceTitleMain" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tiêu đề chính</label>
            <input type="text" id="serviceTitleMain" name="title_main" autocomplete="off" value="<?= htmlspecialchars($serviceIntro['title_main'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>

          <div>
            <label for="serviceTitleSub" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tiêu đề phụ (Chữ nghiêng gold)</label>
            <input type="text" id="serviceTitleSub" name="title_sub" autocomplete="off" value="<?= htmlspecialchars($serviceIntro['title_sub'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-medium">
          </div>
        </div>

        <div>
          <label for="serviceDescription" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Mô tả tổng quan mô hình tiệc riêng tư</label>
          <textarea id="serviceDescription" name="description" rows="3" autocomplete="off" class="input-elegant w-full p-3 rounded-sm text-sm leading-relaxed"><?= htmlspecialchars($serviceIntro['description'] ?? '') ?></textarea>
        </div>

        <div>
          <label for="serviceHighlightNote" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Ghi chú nhấn mạnh (Trích dẫn viền trái gold)</label>
          <textarea id="serviceHighlightNote" name="highlight_note" rows="2" autocomplete="off" class="input-elegant w-full p-3 rounded-sm text-sm leading-relaxed"><?= htmlspecialchars($serviceIntro['highlight_note'] ?? '') ?></textarea>
        </div>

        <div class="border-t border-border/40 pt-5 space-y-4">
          <p class="text-xs uppercase tracking-widest text-[var(--gold)] font-semibold">Cấu hình Card Ảnh bên phải</p>
          <div class="grid sm:grid-cols-2 gap-5">
            <div>
              <label for="serviceCardTag" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tag Card</label>
              <input type="text" id="serviceCardTag" name="card_tag" autocomplete="off" value="<?= htmlspecialchars($serviceIntro['card_tag'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm">
            </div>

            <div>
              <label for="serviceCardTitle" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tiêu đề Card</label>
              <input type="text" id="serviceCardTitle" name="card_title" autocomplete="off" value="<?= htmlspecialchars($serviceIntro['card_title'] ?? '') ?>" class="input-elegant w-full px-4 py-3 rounded-sm text-sm">
            </div>
          </div>

          <div>
            <label for="serviceCardImage" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Đường dẫn Ảnh Card minh họa (Image URL)</label>
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 rounded border border-border/60 bg-muted/30 overflow-hidden shrink-0 flex items-center justify-center relative">
                <img id="preview_serviceCardImage" src="<?= htmlspecialchars($serviceIntro['card_image'] ?? '') ?>" onclick="openAdminImageLightbox(this.src)" title="Bấm để xem ảnh phóng to" class="w-full h-full object-cover cursor-pointer hover:opacity-80 transition-opacity <?= empty($serviceIntro['card_image']) ? 'hidden' : '' ?>" alt="Preview">
                <span class="preview-placeholder text-[9px] text-muted-foreground font-mono uppercase text-center px-1 <?= !empty($serviceIntro['card_image']) ? 'hidden' : '' ?>">No img</span>
              </div>
              <div class="flex-1 space-y-1.5">
                <input type="text" id="serviceCardImage" name="card_image" autocomplete="off" value="<?= htmlspecialchars($serviceIntro['card_image'] ?? '') ?>" placeholder="URL ảnh hoặc chọn từ máy..." class="input-elegant w-full px-3.5 py-2 rounded-sm text-xs font-medium" oninput="updateImagePreview(this, 'preview_serviceCardImage')">
                <div class="flex items-center gap-2">
                  <label class="px-2.5 py-1 rounded bg-muted hover:bg-muted/80 border border-border/50 text-[11px] text-foreground font-medium cursor-pointer inline-flex items-center gap-1.5 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>
                    <span>Tải ảnh từ máy</span>
                    <input type="file" accept="image/*" class="sr-only" onchange="handleAdminImageUpload(this, 'serviceCardImage', 'preview_serviceCardImage')">
                  </label>
                  <span class="upload-status text-[11px] text-muted-foreground italic"></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="pt-2">
          <button type="submit" class="btn-wine px-6 py-3 rounded-sm text-xs uppercase tracking-widest font-medium shadow-md">
            Lưu thay đổi Section Giới thiệu Dịch vụ
          </button>
        </div>
      </form>
    </div>
    <?php endif; ?>

    <?php if (in_array($activeSection ?? 'all', ['all', 'pairings'], true)): ?>
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

            <form action="<?= admin_url('content/pairing') ?>" method="POST" class="space-y-3">
              <input type="hidden" name="id" value="<?= $p['id'] ?>">

              <div>
                <label for="pairingTitle_<?= $p['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Tên gói tiệc</label>
                <input type="text" id="pairingTitle_<?= $p['id'] ?>" name="title" autocomplete="off" value="<?= htmlspecialchars($p['title']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs font-medium">
              </div>

              <div>
                <label for="pairingLevel_<?= $p['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Phân cấp (Standard / Premium Level)</label>
                <input type="text" id="pairingLevel_<?= $p['id'] ?>" name="level" autocomplete="off" value="<?= htmlspecialchars($p['level']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs">
              </div>

              <div>
                <label for="pairingSubtitle_<?= $p['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Mô tả tóm tắt</label>
                <textarea id="pairingSubtitle_<?= $p['id'] ?>" name="subtitle" rows="2" autocomplete="off" class="input-elegant w-full p-2.5 rounded-sm text-xs leading-relaxed"><?= htmlspecialchars($p['subtitle']) ?></textarea>
              </div>

              <div>
                <div class="flex items-center justify-between mb-2">
                  <span class="block text-[11px] uppercase tracking-widest text-muted-foreground">Thực đơn &amp; Rượu Vang đi kèm</span>
                  <button type="button" onclick="addMenuItemRow(<?= $p['id'] ?>)" class="admin-btn-gold px-2.5 py-1 rounded text-[10px] uppercase tracking-wider font-semibold flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-3 h-3"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                    <span>Thêm món</span>
                  </button>
                </div>

                <?php
                  $menuList = [];
                  if (!empty($p['menu_items'])) {
                      if (is_array($p['menu_items'])) {
                          $menuList = $p['menu_items'];
                      } else {
                          $decoded = json_decode($p['menu_items'], true);
                          if (is_array($decoded)) {
                              $menuList = $decoded;
                          }
                      }
                  }
                  if (empty($menuList)) {
                      $menuList = [['course' => '', 'wine' => '']];
                  }
                ?>

                <div id="menuItemsContainer_<?= $p['id'] ?>" class="space-y-2.5">
                  <?php foreach ($menuList as $mIdx => $mItem): ?>
                    <div class="menu-item-row bg-muted/20 border border-border/40 p-2.5 rounded-sm space-y-2">
                      <div class="flex items-center justify-between text-[10px] text-muted-foreground uppercase tracking-widest font-mono">
                        <span>Món #<span class="item-number"><?= $mIdx + 1 ?></span></span>
                        <button type="button" onclick="removeMenuItemRow(this)" class="text-muted-foreground hover:text-rose-400 p-0.5 transition-colors" title="Xóa món này">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-3.5 h-3.5"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                        </button>
                      </div>

                      <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                          <label for="course_<?= $p['id'] ?>_<?= $mIdx ?>" class="block text-[10px] text-muted-foreground mb-0.5">Tên món ăn</label>
                          <input type="text" id="course_<?= $p['id'] ?>_<?= $mIdx ?>" name="courses[]" autocomplete="off" value="<?= htmlspecialchars($mItem['course'] ?? '') ?>" placeholder="VD: Khởi vị — Carpaccio bò" class="input-elegant w-full px-2.5 py-1.5 rounded-sm text-xs font-medium">
                        </div>
                        <div>
                          <label for="wine_<?= $p['id'] ?>_<?= $mIdx ?>" class="block text-[10px] text-muted-foreground mb-0.5">Rượu Vang đi kèm</label>
                          <input type="text" id="wine_<?= $p['id'] ?>_<?= $mIdx ?>" name="wines[]" autocomplete="off" value="<?= htmlspecialchars($mItem['wine'] ?? '') ?>" placeholder="VD: Pinot Noir" class="input-elegant w-full px-2.5 py-1.5 rounded-sm text-xs font-mono text-[var(--gold)]">
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="grid grid-cols-2 gap-3">
                <div>
                  <label for="pairingPrice_<?= $p['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Mức giá khởi điểm</label>
                  <input type="text" id="pairingPrice_<?= $p['id'] ?>" name="price_text" autocomplete="off" value="<?= htmlspecialchars($p['price_text']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs">
                </div>

                <div>
                  <label for="pairingImage_<?= $p['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Ảnh đại diện Gói tiệc</label>
                  <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded border border-border/60 bg-muted/30 overflow-hidden shrink-0 flex items-center justify-center relative">
                      <img id="preview_pairingImage_<?= $p['id'] ?>" src="<?= htmlspecialchars($p['image']) ?>" onclick="openAdminImageLightbox(this.src)" title="Bấm để xem ảnh phóng to" class="w-full h-full object-cover cursor-pointer hover:opacity-80 transition-opacity <?= empty($p['image']) ? 'hidden' : '' ?>" alt="Preview">
                      <span class="preview-placeholder text-[8px] text-muted-foreground font-mono uppercase text-center px-0.5 <?= !empty($p['image']) ? 'hidden' : '' ?>">No img</span>
                    </div>
                    <div class="flex-1 space-y-1">
                      <input type="text" id="pairingImage_<?= $p['id'] ?>" name="image" autocomplete="off" value="<?= htmlspecialchars($p['image']) ?>" placeholder="URL hoặc tải từ máy" class="input-elegant w-full px-2.5 py-1.5 rounded-sm text-xs font-mono" oninput="updateImagePreview(this, 'preview_pairingImage_<?= $p['id'] ?>')">
                      <div class="flex items-center gap-1.5">
                        <label class="px-2 py-0.5 rounded bg-muted hover:bg-muted/80 border border-border/50 text-[10px] text-foreground font-medium cursor-pointer inline-flex items-center gap-1 transition-colors">
                          <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>
                          <span>Tải ảnh</span>
                          <input type="file" accept="image/*" class="sr-only" onchange="handleAdminImageUpload(this, 'pairingImage_<?= $p['id'] ?>', 'preview_pairingImage_<?= $p['id'] ?>')">
                        </label>
                        <span class="upload-status text-[10px] text-muted-foreground italic"></span>
                      </div>
                    </div>
                  </div>
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
    <?php endif; ?>

    <?php if (in_array($activeSection ?? 'all', ['all', 'workshops'], true)): ?>
    <!-- 5. Section Các Gói Workshop & Khóa học (Module 3.3) -->
    <div class="rounded-sm border border-border/40 bg-card p-6 sm:p-8 space-y-6 shadow-sm">
      <div class="border-b border-border/40 pb-4 flex items-center justify-between">
        <div>
          <span class="text-[10px] uppercase tracking-widest text-[var(--gold)]">Module 3.3</span>
          <h3 class="font-heading text-xl text-foreground">Danh sách Các Gói Workshop &amp; Khóa học Trải nghiệm</h3>
        </div>
        <span class="text-xs text-muted-foreground">Dynamic Workshop CMS</span>
      </div>

      <div class="grid sm:grid-cols-2 gap-6">
        <?php foreach ($workshops as $ws): ?>
          <div class="rounded-sm border border-border/40 bg-card/40 p-5 space-y-4 shadow-sm">
            <h4 class="font-heading text-lg text-foreground flex items-center justify-between">
              <span><?= htmlspecialchars($ws['title']) ?></span>
              <span class="text-xs text-[var(--gold)] font-mono font-normal"><?= number_format($ws['price']) ?>đ/khách</span>
            </h4>

            <form action="<?= admin_url('content/workshop') ?>" method="POST" class="space-y-3">
              <input type="hidden" name="id" value="<?= $ws['id'] ?>">

              <div>
                <label for="wsTitle_<?= $ws['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Tên Workshop *</label>
                <input type="text" id="wsTitle_<?= $ws['id'] ?>" name="title" autocomplete="off" value="<?= htmlspecialchars($ws['title']) ?>" required class="input-elegant w-full px-3 py-2 rounded-sm text-xs font-medium">
              </div>

              <div class="grid grid-cols-2 gap-2">
                <div>
                  <label for="wsLevel_<?= $ws['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Phân cấp (Level)</label>
                  <input type="text" id="wsLevel_<?= $ws['id'] ?>" name="level" autocomplete="off" value="<?= htmlspecialchars($ws['level']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs">
                </div>
                <div>
                  <label for="wsPrice_<?= $ws['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Giá vé (VNĐ) *</label>
                  <input type="number" id="wsPrice_<?= $ws['id'] ?>" name="price" autocomplete="off" value="<?= (float)$ws['price'] ?>" required step="10000" class="input-elegant w-full px-3 py-2 rounded-sm text-xs font-mono text-[var(--gold)] font-semibold">
                </div>
              </div>

              <div class="grid grid-cols-3 gap-2">
                <div>
                  <label for="wsDuration_<?= $ws['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Thời lượng</label>
                  <input type="text" id="wsDuration_<?= $ws['id'] ?>" name="duration" autocomplete="off" value="<?= htmlspecialchars($ws['duration']) ?>" class="input-elegant w-full px-2.5 py-1.5 rounded-sm text-xs">
                </div>
                <div>
                  <label for="wsWines_<?= $ws['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Số dòng vang</label>
                  <input type="number" id="wsWines_<?= $ws['id'] ?>" name="wines_count" autocomplete="off" value="<?= (int)$ws['wines_count'] ?>" class="input-elegant w-full px-2.5 py-1.5 rounded-sm text-xs">
                </div>
                <div>
                  <label for="wsMax_<?= $ws['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Chỗ tối đa</label>
                  <input type="number" id="wsMax_<?= $ws['id'] ?>" name="max_participants" autocomplete="off" value="<?= (int)$ws['max_participants'] ?>" class="input-elegant w-full px-2.5 py-1.5 rounded-sm text-xs">
                </div>
              </div>

              <div class="grid grid-cols-2 gap-2">
                <div>
                  <label for="wsSchedule_<?= $ws['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Lịch học</label>
                  <input type="text" id="wsSchedule_<?= $ws['id'] ?>" name="schedule" autocomplete="off" value="<?= htmlspecialchars($ws['schedule']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs">
                </div>
                <div>
                  <label for="wsLocation_<?= $ws['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Địa điểm</label>
                  <input type="text" id="wsLocation_<?= $ws['id'] ?>" name="location" autocomplete="off" value="<?= htmlspecialchars($ws['location']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs">
                </div>
              </div>

              <div>
                <label for="wsImage_<?= $ws['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Ảnh bìa Workshop</label>
                <div class="flex items-center gap-2">
                  <div class="w-10 h-10 rounded border border-border/60 bg-muted/30 overflow-hidden shrink-0 flex items-center justify-center relative">
                    <img id="preview_wsImage_<?= $ws['id'] ?>" src="<?= htmlspecialchars($ws['image']) ?>" onclick="openAdminImageLightbox(this.src)" title="Bấm để xem ảnh phóng to" class="w-full h-full object-cover cursor-pointer hover:opacity-80 transition-opacity <?= empty($ws['image']) ? 'hidden' : '' ?>" alt="Preview">
                    <span class="preview-placeholder text-[8px] text-muted-foreground font-mono uppercase text-center px-0.5 <?= !empty($ws['image']) ? 'hidden' : '' ?>">No img</span>
                  </div>
                  <div class="flex-1 space-y-1">
                    <input type="text" id="wsImage_<?= $ws['id'] ?>" name="image" autocomplete="off" value="<?= htmlspecialchars($ws['image']) ?>" placeholder="URL hoặc tải từ máy" class="input-elegant w-full px-2.5 py-1.5 rounded-sm text-xs font-mono" oninput="updateImagePreview(this, 'preview_wsImage_<?= $ws['id'] ?>')">
                    <div class="flex items-center gap-1.5">
                      <label class="px-2 py-0.5 rounded bg-muted hover:bg-muted/80 border border-border/50 text-[10px] text-foreground font-medium cursor-pointer inline-flex items-center gap-1 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>
                        <span>Tải ảnh</span>
                        <input type="file" accept="image/*" class="sr-only" onchange="handleAdminImageUpload(this, 'wsImage_<?= $ws['id'] ?>', 'preview_wsImage_<?= $ws['id'] ?>')">
                      </label>
                      <span class="upload-status text-[10px] text-muted-foreground italic"></span>
                    </div>
                  </div>
                </div>
              </div>

              <div>
                <label for="wsDesc_<?= $ws['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Mô tả tóm tắt</label>
                <textarea id="wsDesc_<?= $ws['id'] ?>" name="description" rows="2" autocomplete="off" class="input-elegant w-full p-2.5 rounded-sm text-xs leading-relaxed"><?= htmlspecialchars($ws['description']) ?></textarea>
              </div>

              <div class="flex items-center justify-between pt-1">
                <div class="flex items-center gap-3">
                  <select name="status" class="input-elegant px-2.5 py-1 rounded text-xs">
                    <option value="active" <?= $ws['status'] === 'active' ? 'selected' : '' ?> class="bg-card text-foreground">Đang mở (Active)</option>
                    <option value="full" <?= $ws['status'] === 'full' ? 'selected' : '' ?> class="bg-card text-foreground">Đã hết chỗ (Full)</option>
                    <option value="inactive" <?= $ws['status'] === 'inactive' ? 'selected' : '' ?> class="bg-card text-foreground">Tạm ẩn (Inactive)</option>
                  </select>

                  <label class="flex items-center gap-1.5 text-xs text-muted-foreground cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" <?= $ws['is_featured'] ? 'checked' : '' ?> class="rounded text-[var(--wine)]">
                    <span>Nổi bật</span>
                  </label>
                </div>

                <button type="submit" class="btn-wine px-4 py-2 rounded-sm text-xs uppercase tracking-widest font-medium shadow-sm">
                  Lưu Workshop
                </button>
              </div>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

    <?php if (in_array($activeSection ?? 'all', ['all', 'testimonials'], true)): ?>
    <!-- 6. Section Đánh giá Khách hàng Testimonials (Module 5.2 - Full CRUD) -->
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
                <form action="<?= admin_url('content/testimonial/delete') ?>" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?');" class="inline">
                  <input type="hidden" name="id" value="<?= $t['id'] ?>">
                  <button type="submit" class="p-1 rounded text-muted-foreground hover:text-rose-400 hover:bg-muted transition-colors" title="Xóa đánh giá này">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                  </button>
                </form>
              </div>
            </div>

            <form action="<?= admin_url('content/testimonial') ?>" method="POST" class="space-y-3">
              <input type="hidden" name="id" value="<?= $t['id'] ?>">

              <div class="grid grid-cols-2 gap-3">
                <div>
                  <label for="testimonialName_<?= $t['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Tên khách hàng</label>
                  <input type="text" id="testimonialName_<?= $t['id'] ?>" name="name" autocomplete="off" value="<?= htmlspecialchars($t['name']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs font-medium">
                </div>

                <div>
                  <label for="testimonialRole_<?= $t['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Chức danh / Công ty</label>
                  <input type="text" id="testimonialRole_<?= $t['id'] ?>" name="role" autocomplete="off" value="<?= htmlspecialchars($t['role']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs">
                </div>
              </div>

              <div class="grid grid-cols-2 gap-3">
                <div>
                  <label for="testimonialTag_<?= $t['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Tag Gói dịch vụ</label>
                  <input type="text" id="testimonialTag_<?= $t['id'] ?>" name="package_tag" autocomplete="off" value="<?= htmlspecialchars($t['package_tag'] ?? 'Gói Signature Pairing') ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs">
                </div>

                <div>
                  <label for="testimonialRating_<?= $t['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Số sao (1 - 5)</label>
                  <input type="number" id="testimonialRating_<?= $t['id'] ?>" name="rating" autocomplete="off" min="1" max="5" value="<?= (int)($t['rating'] ?? 5) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs font-mono">
                </div>
              </div>

              <div>
                <label for="testimonialContent_<?= $t['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Nội dung đánh giá</label>
                <textarea id="testimonialContent_<?= $t['id'] ?>" name="content" rows="3" autocomplete="off" class="input-elegant w-full p-2.5 rounded-sm text-xs leading-relaxed"><?= htmlspecialchars($t['content'] ?? $t['quote'] ?? '') ?></textarea>
              </div>

              <div>
                <label for="testimonialAvatar_<?= $t['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Avatar Ảnh đại diện</label>
                <div class="flex items-center gap-2">
                  <div class="w-10 h-10 rounded border border-border/60 bg-muted/30 overflow-hidden shrink-0 flex items-center justify-center relative">
                    <img id="preview_testimonialAvatar_<?= $t['id'] ?>" src="<?= htmlspecialchars($t['avatar']) ?>" onclick="openAdminImageLightbox(this.src)" title="Bấm để xem ảnh phóng to" class="w-full h-full object-cover cursor-pointer hover:opacity-80 transition-opacity <?= empty($t['avatar']) ? 'hidden' : '' ?>" alt="Preview">
                    <span class="preview-placeholder text-[8px] text-muted-foreground font-mono uppercase text-center px-0.5 <?= !empty($t['avatar']) ? 'hidden' : '' ?>">No img</span>
                  </div>
                  <div class="flex-1 space-y-1">
                    <input type="text" id="testimonialAvatar_<?= $t['id'] ?>" name="avatar" autocomplete="off" value="<?= htmlspecialchars($t['avatar']) ?>" placeholder="URL hoặc tải từ máy" class="input-elegant w-full px-2.5 py-1.5 rounded-sm text-xs font-mono" oninput="updateImagePreview(this, 'preview_testimonialAvatar_<?= $t['id'] ?>')">
                    <div class="flex items-center gap-1.5">
                      <label class="px-2 py-0.5 rounded bg-muted hover:bg-muted/80 border border-border/50 text-[10px] text-foreground font-medium cursor-pointer inline-flex items-center gap-1 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>
                        <span>Tải ảnh</span>
                        <input type="file" accept="image/*" class="sr-only" onchange="handleAdminImageUpload(this, 'testimonialAvatar_<?= $t['id'] ?>', 'preview_testimonialAvatar_<?= $t['id'] ?>')">
                      </label>
                      <span class="upload-status text-[10px] text-muted-foreground italic"></span>
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn-invert w-full py-2.5 rounded-sm text-xs uppercase tracking-widest font-medium mt-2">
                Cập nhật đánh giá này
              </button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

    <?php if (in_array($activeSection ?? 'all', ['all', 'faq'], true)): ?>
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
              <form action="<?= admin_url('content/faq/delete') ?>" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa câu hỏi FAQ này?');" class="inline">
                <input type="hidden" name="id" value="<?= $f['id'] ?>">
                <button type="submit" class="p-1 rounded text-muted-foreground hover:text-rose-400 hover:bg-muted transition-colors" title="Xóa câu hỏi FAQ này">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                </button>
              </form>
            </div>

            <form action="<?= admin_url('content/faq') ?>" method="POST" class="space-y-3">
              <input type="hidden" name="id" value="<?= $f['id'] ?>">

              <div>
                <label for="faqQuestion_<?= $f['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Câu hỏi</label>
                <input type="text" id="faqQuestion_<?= $f['id'] ?>" name="question" autocomplete="off" value="<?= htmlspecialchars($f['question']) ?>" class="input-elegant w-full px-3 py-2 rounded-sm text-xs font-semibold">
              </div>

              <div>
                <label for="faqAnswer_<?= $f['id'] ?>" class="block text-[11px] uppercase tracking-widest text-muted-foreground mb-1">Câu trả lời chi tiết</label>
                <textarea id="faqAnswer_<?= $f['id'] ?>" name="answer" rows="3" autocomplete="off" class="input-elegant w-full p-2.5 rounded-sm text-xs leading-relaxed"><?= htmlspecialchars($f['answer']) ?></textarea>
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
    <?php endif; ?>
  </div>
</div>

<!-- Modal Thêm Đánh giá Testimonial mới -->
<div id="createTestimonialModal" class="modal-overlay">
  <div class="relative w-full max-w-lg bg-card border border-border/40 rounded-sm p-6 sm:p-8 shadow-2xl animate-scale-in my-auto">
    <button onclick="closeCreateTestimonialModal()" type="button" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>

    <h3 class="font-heading text-xl text-foreground mb-4">Thêm Đánh giá Khách hàng mới</h3>

    <form action="<?= admin_url('content/testimonial/create') ?>" method="POST" class="space-y-4">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="createTestimonialName" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Tên khách hàng *</label>
          <input type="text" id="createTestimonialName" name="name" required autocomplete="off" placeholder="Anh Nguyễn Văn A" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm font-medium">
        </div>

        <div>
          <label for="createTestimonialRole" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Chức danh / Công ty</label>
          <input type="text" id="createTestimonialRole" name="role" autocomplete="off" placeholder="CEO / Doanh nhân" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="createTestimonialPackageTag" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Tag Gói tiệc</label>
          <input type="text" id="createTestimonialPackageTag" name="package_tag" autocomplete="off" value="Gói Signature Pairing" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm">
        </div>

        <div>
          <label for="createTestimonialRating" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Số sao đánh giá (1-5)</label>
          <input type="number" id="createTestimonialRating" name="rating" autocomplete="off" min="1" max="5" value="5" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm font-mono">
        </div>
      </div>

      <div>
        <label for="createTestimonialContent" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Nội dung đánh giá *</label>
        <textarea id="createTestimonialContent" name="content" rows="3" required autocomplete="off" placeholder="Trải nghiệm tuyệt vời, không gian riêng tư đẳng cấp..." class="input-elegant w-full p-3 rounded-sm text-sm leading-relaxed"></textarea>
      </div>

      <div>
        <label for="createTestimonialAvatar" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Avatar Ảnh đại diện</label>
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 rounded border border-border/60 bg-muted/30 overflow-hidden shrink-0 flex items-center justify-center relative">
            <img id="preview_createTestimonialAvatar" src="" onclick="openAdminImageLightbox(this.src)" title="Bấm để xem ảnh phóng to" class="w-full h-full object-cover cursor-pointer hover:opacity-80 transition-opacity hidden" alt="Preview">
            <span class="preview-placeholder text-[9px] text-muted-foreground font-mono uppercase text-center px-1">No img</span>
          </div>
          <div class="flex-1 space-y-1.5">
            <input type="text" id="createTestimonialAvatar" name="avatar" autocomplete="off" placeholder="URL hoặc chọn từ máy..." class="input-elegant w-full px-3.5 py-2 rounded-sm text-xs font-medium" oninput="updateImagePreview(this, 'preview_createTestimonialAvatar')">
            <div class="flex items-center gap-2">
              <label class="px-2.5 py-1 rounded bg-muted hover:bg-muted/80 border border-border/50 text-[11px] text-foreground font-medium cursor-pointer inline-flex items-center gap-1.5 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>
                <span>Tải ảnh từ máy</span>
                <input type="file" accept="image/*" class="sr-only" onchange="handleAdminImageUpload(this, 'createTestimonialAvatar', 'preview_createTestimonialAvatar')">
              </label>
              <span class="upload-status text-[11px] text-muted-foreground italic"></span>
            </div>
          </div>
        </div>
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

    <form action="<?= admin_url('content/faq/create') ?>" method="POST" class="space-y-4">
      <div>
        <label for="createFaqQuestion" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Câu hỏi *</label>
        <input type="text" id="createFaqQuestion" name="question" required autocomplete="off" placeholder="Nhà hàng có chỗ đỗ xe ô tô không?" class="input-elegant w-full px-3 py-2.5 rounded-sm text-sm font-semibold">
      </div>

      <div>
        <label for="createFaqAnswer" class="block text-xs uppercase tracking-widest text-muted-foreground mb-1">Câu trả lời chi tiết *</label>
        <textarea id="createFaqAnswer" name="answer" rows="4" required autocomplete="off" placeholder="Có, Amis du Vin có bãi đỗ xe ô tô miễn phí ngay trước sảnh..." class="input-elegant w-full p-3 rounded-sm text-sm leading-relaxed"></textarea>
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

function addMenuItemRow(pairingId) {
  const container = document.getElementById('menuItemsContainer_' + pairingId);
  if (!container) return;

  const count = container.querySelectorAll('.menu-item-row').length + 1;
  const div = document.createElement('div');
  div.className = 'menu-item-row bg-muted/20 border border-border/40 p-2.5 rounded-sm space-y-2 animate-fade-in';
  div.innerHTML = `
    <div class="flex items-center justify-between text-[10px] text-muted-foreground uppercase tracking-widest font-mono">
      <span>Món #<span class="item-number">${count}</span></span>
      <button type="button" onclick="removeMenuItemRow(this)" class="text-muted-foreground hover:text-rose-400 p-0.5 transition-colors" title="Xóa món này">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-3.5 h-3.5"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
      </button>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
      <div>
        <label class="block text-[10px] text-muted-foreground mb-0.5">Tên món ăn</label>
        <input type="text" name="courses[]" autocomplete="off" placeholder="VD: Món chính — Thăn bò Úc áp chảo" class="input-elegant w-full px-2.5 py-1.5 rounded-sm text-xs font-medium">
      </div>
      <div>
        <label class="block text-[10px] text-muted-foreground mb-0.5">Rượu Vang đi kèm</label>
        <input type="text" name="wines[]" autocomplete="off" placeholder="VD: Syrah" class="input-elegant w-full px-2.5 py-1.5 rounded-sm text-xs font-mono text-[var(--gold)]">
      </div>
    </div>
  `;
  container.appendChild(div);
  reindexMenuItems(container);
}

function removeMenuItemRow(btn) {
  const row = btn.closest('.menu-item-row');
  if (row) {
    const container = row.parentElement;
    if (container.querySelectorAll('.menu-item-row').length > 1) {
      row.remove();
      reindexMenuItems(container);
    } else {
      row.querySelectorAll('input').forEach(input => input.value = '');
    }
  }
}

function reindexMenuItems(container) {
  container.querySelectorAll('.menu-item-row').forEach((row, idx) => {
    const numEl = row.querySelector('.item-number');
    if (numEl) numEl.textContent = idx + 1;
  });
}
</script>

<?php
$adminContent = ob_get_clean();
require __DIR__ . '/../_layout/admin_master.php';
?>
