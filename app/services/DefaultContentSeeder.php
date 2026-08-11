<?php

namespace App\Services;

use Core\Database;
use PDO;

class DefaultContentSeeder
{
    public static function reset(string $section): array
    {
        $db = Database::getInstance();
        if (!$db) {
            return ['success' => false, 'message' => 'Lỗi kết nối cơ sở dữ liệu.'];
        }

        switch ($section) {
            case 'hero':
                self::resetHero($db);
                return ['success' => true, 'message' => 'Đã khôi phục dữ liệu mẫu gốc cho Banner Hero!'];

            case 'service_intro':
                self::resetServiceIntro($db);
                return ['success' => true, 'message' => 'Đã khôi phục dữ liệu mẫu gốc cho Giới thiệu dịch vụ!'];

            case 'benefits':
                self::resetBenefits($db);
                return ['success' => true, 'message' => 'Đã khôi phục dữ liệu mẫu gốc cho Lợi ích dịch vụ!'];

            case 'testimonials':
                self::resetTestimonials($db);
                return ['success' => true, 'message' => 'Đã khôi phục dữ liệu mẫu gốc cho Đánh giá khách hàng!'];

            case 'pairings':
                self::resetPairings($db);
                return ['success' => true, 'message' => 'Đã khôi phục dữ liệu mẫu gốc cho Các Gói Tiệc Wine Pairing!'];

            case 'workshops':
                self::resetWorkshops($db);
                return ['success' => true, 'message' => 'Đã khôi phục dữ liệu mẫu gốc cho Các Gói Workshop Vang!'];

            case 'faqs':
                self::resetFaqs($db);
                return ['success' => true, 'message' => 'Đã khôi phục dữ liệu mẫu gốc cho Câu hỏi thường gặp (FAQ)!'];

            case 'all':
                self::resetHero($db);
                self::resetServiceIntro($db);
                self::resetBenefits($db);
                self::resetTestimonials($db);
                self::resetPairings($db);
                self::resetWorkshops($db);
                self::resetFaqs($db);
                return ['success' => true, 'message' => 'Đã khôi phục TOÀN BỘ dữ liệu mẫu chuẩn cho Landing Page!'];

            default:
                return ['success' => false, 'message' => 'Mục khôi phục không hợp lệ.'];
        }
    }

    public static function resetHero(PDO $db): void
    {
        $db->exec("DELETE FROM hero_settings");
        $h = array (
  'id' => 1,
  'tagline' => 'Rượu vang & những người bạn',
  'title_main' => 'Không gian Tiệc riêng tư',
  'title_sub' => '& Tinh hoa ẩm thực Rượu vang',
  'description' => 'Trải nghiệm tiệc riêng tư kết hợp ẩm thực và rượu vang tinh tế, trọn vẹn văn hoá vang tại Hà Nội.',
  'bg_image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/1d3f75363_generated_b7d85214.png/v1/fill/w_1171,h_927,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/1d3f75363_generated_b7d85214.webp',
  'updated_at' => '2026-08-08 16:48:09',
);
        $stmt = $db->prepare(
            "INSERT INTO hero_settings (id, tagline, title_main, title_sub, description, bg_image) 
             VALUES (1, :tagline, :title_main, :title_sub, :description, :bg_image)"
        );
        $stmt->execute([
            'tagline' => $h['tagline'] ?? '',
            'title_main' => $h['title_main'] ?? '',
            'title_sub' => $h['title_sub'] ?? '',
            'description' => $h['description'] ?? '',
            'bg_image' => $h['bg_image'] ?? ''
        ]);
    }

    public static function resetServiceIntro(PDO $db): void
    {
        $db->exec("DELETE FROM service_intro_settings");
        $s = array (
  'id' => 1,
  'tagline' => 'Dịch vụ tiệc riêng Amis Duvin',
  'title_main' => 'Không gian Tiệc riêng tư',
  'title_sub' => '& Tinh hoa ẩm thực Rượu vang',
  'description' => 'Khái quát về mô hình tiệc riêng tư (Private Party) — sự kết hợp đỉnh cao giữa văn hóa rượu vang hảo hạng và nghệ thuật ẩm thực tinh tế (Food & Wine Pairing), mang đến không gian biệt lập, đẳng cấp cho các buổi tiếp khách, kỷ niệm hay giao lưu doanh nhân.',
  'highlight_note' => 'Bốn trải nghiệm kết hợp ẩm thực và rượu vang, từ tinh hoa tiêu chuẩn đến đỉnh cao thượng lưu.',
  'card_tag' => 'Private Party Experience',
  'card_title' => 'Không gian Biệt lập & Đẳng cấp',
  'card_subtitle' => 'Thiết kế thực đơn riêng bởi Chef & Sommelier chuyên nghiệp.',
  'card_image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/4f229480d_generated_ffd34238.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/4f229480d_generated_ffd34238.webp',
  'updated_at' => '2026-08-08 18:22:32',
);
        $stmt = $db->prepare(
            "INSERT INTO service_intro_settings (id, tagline, title_main, title_sub, description, highlight_note, card_tag, card_title, card_subtitle, card_image) 
             VALUES (1, :tagline, :title_main, :title_sub, :description, :highlight_note, :card_tag, :card_title, :card_subtitle, :card_image)"
        );
        $stmt->execute([
            'tagline' => $s['tagline'] ?? '',
            'title_main' => $s['title_main'] ?? '',
            'title_sub' => $s['title_sub'] ?? '',
            'description' => $s['description'] ?? '',
            'highlight_note' => $s['highlight_note'] ?? '',
            'card_tag' => $s['card_tag'] ?? '',
            'card_title' => $s['card_title'] ?? '',
            'card_subtitle' => $s['card_subtitle'] ?? '',
            'card_image' => $s['card_image'] ?? $s['bg_image'] ?? ''
        ]);
    }

    public static function resetBenefits(PDO $db): void
    {
        $db->exec("DELETE FROM benefits");
        $benefits = array (
  0 => 
  array (
    'id' => 1,
    'title' => 'Hiểu vang dễ dàng',
    'description' => 'Kiến thức rượu vang được truyền đạt gần gũi, thực tế — ai cũng tự tin thưởng thức và chọn vang cho mọi dịp.',
    'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wine w-6 h-6"><path d="M8 22h8"></path><path d="M7 10h10"></path><path d="M12 15v7"></path><path d="M12 15a5 5 0 0 0 5-5c0-2-.5-4-2-8H9c-1.5 4-2 6-2 8a5 5 0 0 0 5 5Z"></path></svg>',
    'sort_order' => 1,
    'status' => 'active',
    'created_at' => '2026-08-08 16:34:44',
  ),
  1 => 
  array (
    'id' => 2,
    'title' => 'Trải nghiệm cùng chuyên gia',
    'description' => 'Được dẫn dắt trực tiếp bởi Sommelier Alex Thịnh với hơn 24 năm kinh nghiệm tại các nhà hàng, khách sạn 5 sao.',
    'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-6 h-6"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
    'sort_order' => 2,
    'status' => 'active',
    'created_at' => '2026-08-08 16:34:44',
  ),
  2 => 
  array (
    'id' => 3,
    'title' => 'Kết nối trong không gian thân mật',
    'description' => 'Không gian nhỏ, ấm cúng — nơi mỗi buổi tiệc trở thành câu chuyện kết nối giữa người, vang và ẩm thực.',
    'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-6 h-6"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>',
    'sort_order' => 3,
    'status' => 'active',
    'created_at' => '2026-08-08 16:34:44',
  ),
);
        $stmt = $db->prepare(
            "INSERT INTO benefits (id, title, description, icon_svg, sort_order, status) 
             VALUES (:id, :title, :description, :icon_svg, :sort_order, :status)"
        );
        foreach ($benefits as $b) {
            $stmt->execute([
                'id' => $b['id'],
                'title' => $b['title'],
                'description' => $b['description'],
                'icon_svg' => $b['icon_svg'],
                'sort_order' => $b['sort_order'],
                'status' => $b['status'] ?? 'active'
            ]);
        }
    }

    public static function resetTestimonials(PDO $db): void
    {
        $db->exec("DELETE FROM testimonials");
        $testimonials = array (
  0 => 
  array (
    'id' => 1,
    'pairing_id' => 1,
    'name' => 'Anh Trần Tuấn Minh',
    'avatar' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/0c749a039_generated_image.png/v1/fill/w_56,h_56,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/0c749a039_generated_image.webp',
    'avatar_initials' => NULL,
    'role' => 'CEO · Công ty Đầu tư',
    'package_tag' => 'Gói Signature Pairing',
    'rating' => 5,
    'content' => 'Bữa tiệc hoàn hảo đến từng chi tiết. Sommelier Alex Thịnh kể chuyện vang cuốn hút, khách hàng đối tác của tôi rất ấn tượng.',
    'sort_order' => 1,
    'status' => 'active',
    'created_at' => '2026-08-07 17:39:42',
  ),
  1 => 
  array (
    'id' => 2,
    'pairing_id' => 2,
    'name' => 'Chị Lê Hoàng Yến',
    'avatar' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/054117747_generated_image.png/v1/fill/w_56,h_56,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/054117747_generated_image.webp',
    'avatar_initials' => NULL,
    'role' => 'Giám đốc Marketing',
    'package_tag' => 'Gói Gourmet Selection',
    'rating' => 5,
    'content' => 'Không gian nhỏ, riêng tư, ấm cúng. Pairing rượu và món ăn tinh tế — một trải nghiệm văn hoá đúng nghĩa.',
    'sort_order' => 2,
    'status' => 'active',
    'created_at' => '2026-08-07 17:39:42',
  ),
  2 => 
  array (
    'id' => 3,
    'pairing_id' => NULL,
    'name' => 'Anh Phạm Đức Anh',
    'avatar' => NULL,
    'avatar_initials' => 'ĐA',
    'role' => 'Doanh nhân',
    'package_tag' => 'Workshop Wine & Food Romance',
    'rating' => 5,
    'content' => 'Tôi không rành vang nhưng được hướng dẫn rất gần gũi. Ra về tự tin chọn vang cho bữa tiệc gia đình.',
    'sort_order' => 3,
    'status' => 'active',
    'created_at' => '2026-08-07 17:39:42',
  ),
  3 => 
  array (
    'id' => 4,
    'pairing_id' => 3,
    'name' => 'Chị Vũ Thu Hà',
    'avatar' => NULL,
    'avatar_initials' => 'TH',
    'role' => 'Chủ Spa cao cấp',
    'package_tag' => 'Gói Private Cellar',
    'rating' => 5,
    'content' => 'Dịch vụ chu đáo, khách hàng VIP của tôi đều hài lòng. Sẽ quay lại cho các dịp kỷ niệm quan trọng.',
    'sort_order' => 4,
    'status' => 'active',
    'created_at' => '2026-08-07 17:39:42',
  ),
  4 => 
  array (
    'id' => 5,
    'pairing_id' => 4,
    'name' => 'Anh Nguyễn Quốc Bảo',
    'avatar' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/c14ed7531_generated_image.png/v1/fill/w_56,h_56,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/c14ed7531_generated_image.webp',
    'avatar_initials' => NULL,
    'role' => 'Nhà đầu tư',
    'package_tag' => 'Amis Duvin Gala Night',
    'rating' => 5,
    'content' => 'Đẳng cấp và tinh tế. Đêm Gala thật sự vượt mong đợi — điểm đến xứng đáng cho giới doanh nhân.',
    'sort_order' => 5,
    'status' => 'active',
    'created_at' => '2026-08-07 17:39:42',
  ),
);
        $stmt = $db->prepare(
            "INSERT INTO testimonials (id, pairing_id, name, avatar, avatar_initials, role, package_tag, rating, content, sort_order, status) 
             VALUES (:id, :pairing_id, :name, :avatar, :avatar_initials, :role, :package_tag, :rating, :content, :sort_order, :status)"
        );
        foreach ($testimonials as $t) {
            $stmt->execute([
                'id' => $t['id'],
                'pairing_id' => $t['pairing_id'] ?? null,
                'name' => $t['name'],
                'avatar' => $t['avatar'] ?? null,
                'avatar_initials' => $t['avatar_initials'] ?? null,
                'role' => $t['role'] ?? '',
                'package_tag' => $t['package_tag'] ?? '',
                'rating' => $t['rating'] ?? 5,
                'content' => $t['content'],
                'sort_order' => $t['sort_order'],
                'status' => $t['status'] ?? 'active'
            ]);
        }
    }

    public static function resetPairings(PDO $db): void
    {
        $db->exec("DELETE FROM pairings");
        $pairings = array (
  0 => 
  array (
    'id' => 1,
    'slug' => 'signature-pairing',
    'title' => 'Signature Pairing',
    'level' => 'Standard Level',
    'subtitle' => 'Sự kết hợp kinh điển giữa rượu vang và các món ngon đặc trưng, mở đầu hành trình thưởng thức tinh tế.',
    'price' => '1500000.00',
    'price_text' => 'Từ 1.500.000đ/khách',
    'duration' => '2.5 giờ',
    'capacity' => '8–20 khách',
    'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/e6d25f6b5_generated_78290a91.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/e6d25f6b5_generated_78290a91.webp',
    'menu_items' => '[{"course":"Khởi vị — Carpaccio bò, parmigiano","wine":"Pinot Noir"},{"course":"Món chính — Ngừ sốt tiêu, bơ thảo mộc","wine":"Cabernet Sauvignon"},{"course":"Tráng miệng — Tart chocolate đen","wine":"Port Tawny"}]',
    'sort_order' => 1,
    'status' => 'active',
    'created_at' => '2026-08-07 17:18:44',
  ),
  1 => 
  array (
    'id' => 2,
    'slug' => 'gourmet-selection',
    'title' => 'Gourmet Selection',
    'level' => 'Standard Level',
    'subtitle' => 'Bộ sưu tập món cao cấp được thiết kế riêng, kết hợp hoàn hảo cùng những dòng vang thượng hạng.',
    'price' => '2000000.00',
    'price_text' => 'Từ 2.000.000đ/khách',
    'duration' => '3 giờ',
    'capacity' => '8–20 khách',
    'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/4f229480d_generated_ffd34238.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/4f229480d_generated_ffd34238.webp',
    'menu_items' => '[{"course":"Khởi vị — Sashimi cá hồi Na Uy","wine":"Chardonnay"},{"course":"Món chính — Bò bít tết Wagyu","wine":"Malbec"},{"course":"Tráng miệng — Crème brûlée vani","wine":"Sauternes"}]',
    'sort_order' => 2,
    'status' => 'active',
    'created_at' => '2026-08-07 17:18:44',
  ),
  2 => 
  array (
    'id' => 3,
    'slug' => 'private-cellar',
    'title' => 'Private Cellar',
    'level' => 'Premium Level',
    'subtitle' => 'Trải nghiệm thử rượu độc quyền trong hầm rượu riêng, dành cho những người sành vang đích thực.',
    'price' => '3500000.00',
    'price_text' => 'Từ 3.500.000đ/khách',
    'duration' => '3.5 giờ',
    'capacity' => '6–12 khách',
    'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/0a280a9c0_generated_bbd5d622.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/0a280a9c0_generated_bbd5d622.webp',
    'menu_items' => '[{"course":"Nếm thử 5 dòng vang hầm riêng","wine":"Vertical Tasting"},{"course":"Phô mai nhập khẩu & pâté","wine":"Bordeaux Grand Cru"},{"course":"Món chính — Thỏ nấu rượu vang","wine":"Burgundy Pinot"}]',
    'sort_order' => 3,
    'status' => 'active',
    'created_at' => '2026-08-07 17:18:44',
  ),
  3 => 
  array (
    'id' => 4,
    'slug' => 'amis-du-vin-gala-night',
    'title' => 'Amis Duvin Gala Night',
    'level' => 'Premium Level',
    'subtitle' => 'Đêm tiệc thượng lưu tráng lệ với thực đơn Sommelier thiết kế, không gian riêng tư đẳng cấp.',
    'price' => '5000000.00',
    'price_text' => 'Từ 5.000.000đ/khách',
    'duration' => '4 giờ',
    'capacity' => '15–40 khách',
    'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/af384a896_generated_47deb67b.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/af384a896_generated_47deb67b.webp',
    'menu_items' => '[{"course":"Aperitif & lộ trình vang 7 món","wine":"Champagne"},{"course":"Món chính — Cừu nướng thảo mộc","wine":"Barolo Riserva"},{"course":"Tráng miệng — Soufflé chocolate","wine":"Tokaji Aszú"}]',
    'sort_order' => 4,
    'status' => 'active',
    'created_at' => '2026-08-07 17:18:44',
  ),
);
        $stmt = $db->prepare(
            "INSERT INTO pairings (id, slug, title, level, subtitle, price, price_text, duration, capacity, image, menu_items, sort_order, status) 
             VALUES (:id, :slug, :title, :level, :subtitle, :price, :price_text, :duration, :capacity, :image, :menu_items, :sort_order, :status)"
        );
        foreach ($pairings as $p) {
            $stmt->execute([
                'id' => $p['id'],
                'slug' => $p['slug'],
                'title' => $p['title'],
                'level' => $p['level'],
                'subtitle' => $p['subtitle'],
                'price' => $p['price'],
                'price_text' => $p['price_text'],
                'duration' => $p['duration'],
                'capacity' => $p['capacity'],
                'image' => $p['image'],
                'menu_items' => $p['menu_items'],
                'sort_order' => $p['sort_order'],
                'status' => $p['status'] ?? 'active'
            ]);
        }
    }

    public static function resetWorkshops(PDO $db): void
    {
        $db->exec("DELETE FROM workshops");
        $workshops = array (
  0 => 
  array (
    'id' => 1,
    'slug' => 'the-first-sip',
    'title' => 'The First Sip',
    'level' => 'Cơ bản',
    'price' => '1000000.00',
    'duration' => '2.0 giờ',
    'schedule' => 'Thứ 6, 14/08/2026 · 10h – 12h',
    'location' => 'Amis Duvin Cellar — Q.3, TP.HCM',
    'max_participants' => 12,
    'current_participants' => 22,
    'wines_count' => 5,
    'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/2ff99e699_image.png/v1/fill/w_370,h_458,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/2ff99e699_image.webp',
    'description' => 'Ly vang đầu tiên — khởi đầu hành trình cảm nhận rượu vang: lịch sử, phân loại và bước thử nếm cơ bản dành cho người mới bắt đầu.',
    'status' => 'full',
    'is_featured' => 1,
    'created_at' => '2026-08-08 02:17:05',
  ),
  1 => 
  array (
    'id' => 2,
    'slug' => 'the-art-of-taste',
    'title' => 'The Art of Taste',
    'level' => 'Nâng cao',
    'price' => '1200000.00',
    'duration' => '2.0 giờ',
    'schedule' => '28/08/2026 · 19h – 21h',
    'location' => 'Amis Duvin Cellar — Q.3, TP.HCM',
    'max_participants' => 12,
    'current_participants' => 16,
    'wines_count' => 5,
    'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/ef11c3040_image.png/v1/fill/w_370,h_458,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/ef11c3040_image.webp',
    'description' => 'Khai phá giác quan: kỹ thuật nhìn, ngửi, nếm và cách diễn giải hương vị rượu vang như một chuyên gia thực thụ.',
    'status' => 'full',
    'is_featured' => 1,
    'created_at' => '2026-08-08 02:17:05',
  ),
  2 => 
  array (
    'id' => 3,
    'slug' => 'wine-food-romance',
    'title' => 'Wine & Food Romance',
    'level' => 'Chuyên đề',
    'price' => '1500000.00',
    'duration' => '2.0 giờ',
    'schedule' => '11/09/2026 · 19h – 21h',
    'location' => 'Amis Duvin Cellar — Q.3, TP.HCM',
    'max_participants' => 12,
    'current_participants' => 12,
    'wines_count' => 5,
    'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/ff4488a83_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/ff4488a83_image.webp',
    'description' => 'Nghệ thuật kết đôi ẩm thực và vang tinh tế: khám phá nguyên lý phối vị kinh điển giữa các món ngon và những dòng vang quyến rũ.',
    'status' => 'full',
    'is_featured' => 0,
    'created_at' => '2026-08-08 02:17:05',
  ),
  3 => 
  array (
    'id' => 4,
    'slug' => 'around-the-wine-world',
    'title' => 'Around the Wine World',
    'level' => 'Khám phá',
    'price' => '1800000.00',
    'duration' => '2.0 giờ',
    'schedule' => '25/09/2026 · 19h – 21h',
    'location' => 'Amis Duvin Cellar — Q.3, TP.HCM',
    'max_participants' => 12,
    'current_participants' => 13,
    'wines_count' => 6,
    'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/4e47aee24_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/4e47aee24_image.webp',
    'description' => 'Hành trình du ngoạn các vùng vang danh tiếng nhất thế giới: từ Bordeaux, Tuscany đến Napa Valley và Nam Bán Cầu.',
    'status' => 'full',
    'is_featured' => 0,
    'created_at' => '2026-08-08 02:17:05',
  ),
  4 => 
  array (
    'id' => 5,
    'slug' => 'wine-art',
    'title' => 'Wine & Art',
    'level' => 'Cảm nhận',
    'price' => '1000000.00',
    'duration' => '2.0 giờ',
    'schedule' => '09/10/2026 · 19h – 21h',
    'location' => 'Amis Duvin Cellar — Q.3, TP.HCM',
    'max_participants' => 12,
    'current_participants' => 7,
    'wines_count' => 5,
    'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/0d495c825_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/0d495c825_image.webp',
    'description' => 'Sự hòa quyện đỉnh cao giữa nghệ thuật hội họa, âm nhạc cổ điển và cảm xúc thăng hoa bên những ly vang hảo hạng.',
    'status' => 'active',
    'is_featured' => 0,
    'created_at' => '2026-08-08 02:17:05',
  ),
  5 => 
  array (
    'id' => 6,
    'slug' => 'wine-business',
    'title' => 'Wine & Business',
    'level' => 'Ngoại giao',
    'price' => '2000000.00',
    'duration' => '2.0 giờ',
    'schedule' => '23/10/2026 · 19h – 21h',
    'location' => 'Amis Duvin Cellar — Q.3, TP.HCM',
    'max_participants' => 12,
    'current_participants' => 12,
    'wines_count' => 6,
    'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/2a054bd36_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/2a054bd36_image.webp',
    'description' => 'Văn hóa vang trong giao tế thương gia: quy tắc ứng xử, nghệ thuật chọn vang và làm chủ bàn tiệc ngoại giao đẳng cấp.',
    'status' => 'full',
    'is_featured' => 0,
    'created_at' => '2026-08-08 02:17:05',
  ),
  6 => 
  array (
    'id' => 7,
    'slug' => 'wine-fine-living',
    'title' => 'Wine & Fine Living',
    'level' => 'Thưởng thức',
    'price' => '1500000.00',
    'duration' => '2.0 giờ',
    'schedule' => '06/11/2026 · 19h – 21h',
    'location' => 'Amis Duvin Cellar — Q.3, TP.HCM',
    'max_participants' => 12,
    'current_participants' => 3,
    'wines_count' => 5,
    'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/2a054bd36_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/2a054bd36_image.webp',
    'description' => 'Phong cách sống nghệ sĩ và nghệ thuật thưởng vang thượng lưu: từ hầm vang cá nhân đến trải nghiệm Fine Dining độc bản.',
    'status' => 'active',
    'is_featured' => 0,
    'created_at' => '2026-08-08 02:17:05',
  ),
  7 => 
  array (
    'id' => 8,
    'slug' => 'amis-du-vin-gala',
    'title' => 'Amis Duvin Gala',
    'level' => 'Thượng lưu',
    'price' => '2000000.00',
    'duration' => '4.0 giờ',
    'schedule' => '20/11/2026 · 18h – 22h',
    'location' => 'Amis Duvin Cellar — Q.3, TP.HCM',
    'max_participants' => 20,
    'current_participants' => 6,
    'wines_count' => 7,
    'image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/f807fd6b1_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/f807fd6b1_image.webp',
    'description' => 'Đêm tiệc Gala thượng lưu tráng lệ quy tụ các dòng vang hầm hiếm có cùng thực đơn Sommelier thiết kế riêng.',
    'status' => 'active',
    'is_featured' => 0,
    'created_at' => '2026-08-08 02:17:05',
  ),
);
        $stmt = $db->prepare(
            "INSERT INTO workshops (id, slug, title, level, price, duration, schedule, location, max_participants, current_participants, wines_count, image, description, status, is_featured) 
             VALUES (:id, :slug, :title, :level, :price, :duration, :schedule, :location, :max_participants, :current_participants, :wines_count, :image, :description, :status, :is_featured)"
        );
        foreach ($workshops as $ws) {
            $stmt->execute([
                'id' => $ws['id'],
                'slug' => $ws['slug'],
                'title' => $ws['title'],
                'level' => $ws['level'],
                'price' => $ws['price'],
                'duration' => $ws['duration'],
                'schedule' => $ws['schedule'],
                'location' => $ws['location'],
                'max_participants' => $ws['max_participants'],
                'current_participants' => $ws['current_participants'],
                'wines_count' => $ws['wines_count'],
                'image' => $ws['image'],
                'description' => $ws['description'],
                'status' => $ws['status'] ?? 'active',
                'is_featured' => $ws['is_featured'] ?? 0
            ]);
        }
    }

    public static function resetFaqs(PDO $db): void
    {
        $db->exec("DELETE FROM faqs");
        $faqs = array (
  0 => 
  array (
    'id' => 1,
    'question' => 'Amis Duvin có phục vụ tiệc riêng tư theo yêu cầu không?',
    'answer' => 'Có. Chúng tôi thiết kế thực đơn và lựa chọn rượu vang riêng cho từng bữa tiệc, phù hợp sở thích, ngân sách và dịp lễ của Quý khách.',
    'sort_order' => 1,
    'status' => 'active',
    'created_at' => '2026-08-08 16:23:37',
  ),
  1 => 
  array (
    'id' => 2,
    'question' => 'Mỗi buổi tiệc phục vụ tối đa bao nhiêu khách?',
    'answer' => 'Không gian ấm cúng tối ưu cho nhóm từ 8 đến 30 khách. Với quy mô lớn hơn, vui lòng liên hệ để chúng tôi bố trí riêng.',
    'sort_order' => 2,
    'status' => 'active',
    'created_at' => '2026-08-08 16:23:37',
  ),
  2 => 
  array (
    'id' => 3,
    'question' => 'Tôi cần đặt trước bao lâu?',
    'answer' => 'Khuyến nghị đặt trước 3–5 ngày để Sommelier và Bếp chuẩn bị thực đơn tốt nhất. Các gói Premium nên đặt trước 1–2 tuần.',
    'sort_order' => 3,
    'status' => 'active',
    'created_at' => '2026-08-08 16:23:37',
  ),
  3 => 
  array (
    'id' => 4,
    'question' => 'Chưa hiểu về rượu vang, có tham gia được không?',
    'answer' => 'Tuyệt đối được. Trải nghiệm dành cho mọi trình độ — Sommelier hướng dẫn từ cơ bản, giúp Quý khách tự tin thưởng thức.',
    'sort_order' => 4,
    'status' => 'active',
    'created_at' => '2026-08-08 16:23:37',
  ),
  4 => 
  array (
    'id' => 5,
    'question' => 'Chi phí bao gồm những gì?',
    'answer' => 'Đã bao gồm thực đơn ẩm thực, rượu vang pairing, không gian riêng và sự hướng dẫn trực tiếp của Sommelier trong suốt bữa tiệc.',
    'sort_order' => 5,
    'status' => 'active',
    'created_at' => '2026-08-08 16:23:37',
  ),
  5 => 
  array (
    'id' => 6,
    'question' => 'Có hỗ trợ khách ăn chay hoặc dị ứng không?',
    'answer' => 'Có. Vui lòng ghi chú yêu cầu đặc biệt khi đặt tiệc, bếp sẽ chuẩn bị thực đơn thay thế phù hợp.',
    'sort_order' => 6,
    'status' => 'active',
    'created_at' => '2026-08-08 16:23:37',
  ),
  6 => 
  array (
    'id' => 7,
    'question' => 'Chính sách hoàn/hủy đặt tiệc thế nào?',
    'answer' => 'Hoàn 100% nếu hủy trước 72 giờ. Trong vòng 72 giờ, giữ 50% chi phí. Chi tiết xem tại mục chính sách cạnh Form đặt tiệc.',
    'sort_order' => 7,
    'status' => 'active',
    'created_at' => '2026-08-08 16:23:37',
  ),
);
        $stmt = $db->prepare(
            "INSERT INTO faqs (id, question, answer, sort_order, status) 
             VALUES (:id, :question, :answer, :sort_order, :status)"
        );
        foreach ($faqs as $f) {
            $stmt->execute([
                'id' => $f['id'],
                'question' => $f['question'],
                'answer' => $f['answer'],
                'sort_order' => $f['sort_order'],
                'status' => $f['status'] ?? 'active'
            ]);
        }
    }
}