<?php

namespace App\Controllers\Admin;

use Core\BaseController;
use App\Services\AuthService;
use App\Models\HeroModel;
use App\Models\ServiceIntroModel;
use App\Models\PairingModel;
use App\Models\TestimonialModel;
use App\Models\FaqModel;
use App\Models\BenefitModel;
use App\Models\WorkshopModel;
use App\Models\SeoModel;
use App\Services\NotificationService;

class AdminContentController extends BaseController
{
    private function redirectWithSection(string $message, string $type = 'msg'): void
    {
        $sec = $_POST['sec'] ?? 'all';
        header('Location: ' . admin_url('content') . '?sec=' . urlencode($sec) . '&' . $type . '=' . urlencode($message));
        exit;
    }

    public function index(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $heroModel = new HeroModel();
        $hero = $heroModel->getHeroSettings();

        $serviceIntroModel = new ServiceIntroModel();
        $serviceIntro = $serviceIntroModel->getServiceIntroSettings();

        $pairingModel = new PairingModel();
        $pairings = $pairingModel->getActivePairings();

        $testimonialModel = new TestimonialModel();
        $testimonials = $testimonialModel->getActiveTestimonials();

        $faqModel = new FaqModel();
        $faqs = $faqModel->getActiveFaqs();

        $benefitModel = new BenefitModel();
        $benefits = $benefitModel->getActiveBenefits();

        $workshopModel = new WorkshopModel();
        $workshops = $workshopModel->getAllWorkshops();

        $seoModel = new SeoModel();
        $seo = $seoModel->getSeoSettings();

        $user = AuthService::user();
        $activeSection = $_GET['sec'] ?? 'all';
        $msg = $_GET['msg'] ?? null;
        $err = $_GET['err'] ?? null;

        require __DIR__ . '/../../views/admin/content/index.php';
    }

    public function updateHero(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $tagline = trim($_POST['tagline'] ?? '');
        $titleMain = trim($_POST['title_main'] ?? '');
        $titleSub = trim($_POST['title_sub'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $bgImage = trim($_POST['bg_image'] ?? '');

        $db = (new HeroModel())->getDb();
        if ($db) {
            $stmt = $db->prepare("UPDATE hero_settings SET tagline = :tagline, title_main = :title_main, title_sub = :title_sub, description = :description, bg_image = :bg_image WHERE id = 1");
            $stmt->execute([
                'tagline' => $tagline,
                'title_main' => $titleMain,
                'title_sub' => $titleSub,
                'description' => $description,
                'bg_image' => $bgImage
            ]);
        }

        $currentUser = AuthService::user();
        NotificationService::notifyContent(
            "Cập nhật Section Hero",
            "Nhân sự {$currentUser['full_name']} vừa cập nhật tiêu đề/slogan của Banner Hero.",
            admin_url('content'),
            $currentUser
        );

        $this->redirectWithSection('Đã cập nhật Section Hero thành công!');
    }

    public function updateServiceIntro(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $tagline = trim($_POST['tagline'] ?? '');
        $titleMain = trim($_POST['title_main'] ?? '');
        $titleSub = trim($_POST['title_sub'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $highlightNote = trim($_POST['highlight_note'] ?? '');
        $cardTag = trim($_POST['card_tag'] ?? '');
        $cardTitle = trim($_POST['card_title'] ?? '');
        $cardSubtitle = trim($_POST['card_subtitle'] ?? '');
        $cardImage = trim($_POST['card_image'] ?? '');

        $db = (new ServiceIntroModel())->getDb();
        if ($db) {
            $stmt = $db->prepare("UPDATE service_intro_settings SET tagline = :tagline, title_main = :title_main, title_sub = :title_sub, description = :description, highlight_note = :highlight_note, card_tag = :card_tag, card_title = :card_title, card_subtitle = :card_subtitle, card_image = :card_image WHERE id = 1");
            $stmt->execute([
                'tagline' => $tagline,
                'title_main' => $titleMain,
                'title_sub' => $titleSub,
                'description' => $description,
                'highlight_note' => $highlightNote,
                'card_tag' => $cardTag,
                'card_title' => $cardTitle,
                'card_subtitle' => $cardSubtitle,
                'card_image' => $cardImage
            ]);
        }

        $this->redirectWithSection('Đã cập nhật Section Giới thiệu Dịch vụ thành công!');
    }

    public function updatePairing(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $id = (int)($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $subtitle = trim($_POST['subtitle'] ?? '');
        $priceText = trim($_POST['price_text'] ?? '');
        $level = trim($_POST['level'] ?? '');
        $image = trim($_POST['image'] ?? '');

        // Support new structured courses and wines per section
        $sections = ['khai_vi' => 'Khai vị', 'mon_chinh' => 'Món chính', 'trang_mieng' => 'Tráng miệng'];
        $menuItems = [
            'khai_vi' => ['items' => [], 'wines' => []],
            'mon_chinh' => ['items' => [], 'wines' => []],
            'trang_mieng' => ['items' => [], 'wines' => []]
        ];
        $hasNewFormat = false;
        foreach ($sections as $key => $label) {
            $courses = $_POST["courses_{$key}"] ?? null;
            $wines = $_POST["wines_{$key}"] ?? null;
            if (is_array($courses)) {
                $hasNewFormat = true;
                foreach ($courses as $idx => $course) {
                    $c = trim($course);
                    $w = trim($wines[$idx] ?? '');
                    if ($c !== '' || $w !== '') {
                        $menuItems[$key]['items'][] = $c;
                        if ($w !== '') {
                            $menuItems[$key]['wines'][] = $w;
                        }
                    }
                }
            }
        }
        if (!$hasNewFormat) {
            $courses = $_POST['courses'] ?? null;
            $wines = $_POST['wines'] ?? null;
            if (is_array($courses)) {
                $menuItemsArr = [];
                foreach ($courses as $idx => $course) {
                    $c = trim($course);
                    $w = trim($wines[$idx] ?? '');
                    if ($c !== '' || $w !== '') {
                        $menuItemsArr[] = ['course' => $c, 'wine' => $w];
                    }
                }
                $menuItems = $menuItemsArr;
            } else {
                $menuItems = trim($_POST['menu_items'] ?? '');
            }
        } else {
            $menuItems = json_encode($menuItems, JSON_UNESCAPED_UNICODE);
        }

        $db = (new PairingModel())->getDb();
        if ($db && $id > 0) {
            $stmt = $db->prepare("UPDATE pairings SET title = :title, subtitle = :subtitle, price_text = :price_text, level = :level, image = :image, menu_items = :menu_items WHERE id = :id");
            $stmt->execute([
                'title' => $title,
                'subtitle' => $subtitle,
                'price_text' => $priceText,
                'level' => $level,
                'image' => $image,
                'menu_items' => $menuItems,
                'id' => $id
            ]);
        }

        $currentUser = AuthService::user();
        NotificationService::notifyContent(
            "Cập nhật Gói tiệc Pairing #{$id}",
            "Nhân sự {$currentUser['full_name']} vừa cập nhật thông tin/thực đơn gói tiệc '{$title}'.",
            admin_url('content'),
            $currentUser
        );

        $this->redirectWithSection('Đã cập nhật Gói tiệc Pairing thành công!');
    }

    public function updateBenefit(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $id = (int)($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        $db = (new BenefitModel())->getDb();
        if ($db && $id > 0) {
            $stmt = $db->prepare("UPDATE benefits SET title = :title, description = :description WHERE id = :id");
            $stmt->execute([
                'title' => $title,
                'description' => $description,
                'id' => $id
            ]);
        }

        $this->redirectWithSection('Đã cập nhật Lợi ích cốt lõi thành công!');
    }

    // Testimonials CRUD
    public function createTestimonial(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $name = trim($_POST['name'] ?? '');
        $role = trim($_POST['role'] ?? '');
        $packageTag = trim($_POST['package_tag'] ?? 'Gói Signature Pairing');
        $rating = (int)($_POST['rating'] ?? 5);
        $content = trim($_POST['content'] ?? '');
        $avatar = trim($_POST['avatar'] ?? '');

        if (empty($name) || empty($content)) {
            $this->redirectWithSection('Vui lòng nhập tên khách hàng và nội dung đánh giá.', 'err');
        }

        // Auto-link pairing_id from pairings table
        $pairingId = null;
        if (!empty($packageTag)) {
            $pairings = (new PairingModel())->getActivePairings();
            foreach ($pairings as $p) {
                if ($packageTag === 'Gói ' . $p['title'] || $packageTag === $p['title']) {
                    $pairingId = (int)$p['id'];
                    break;
                }
            }
        }

        $db = (new TestimonialModel())->getDb();
        if ($db) {
            $stmt = $db->prepare("INSERT INTO testimonials (pairing_id, name, role, package_tag, rating, content, avatar) VALUES (:pairing_id, :name, :role, :package_tag, :rating, :content, :avatar)");
            $stmt->execute([
                'pairing_id' => $pairingId,
                'name' => $name,
                'role' => $role,
                'package_tag' => $packageTag,
                'rating' => $rating,
                'content' => $content,
                'avatar' => $avatar
            ]);
        }

        $this->redirectWithSection('Đã thêm Đánh giá mới thành công!');
    }

    public function updateTestimonial(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $id = (int)($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $role = trim($_POST['role'] ?? '');
        $packageTag = trim($_POST['package_tag'] ?? 'Gói Signature Pairing');
        $rating = (int)($_POST['rating'] ?? 5);
        $content = trim($_POST['content'] ?? $_POST['quote'] ?? '');
        $avatar = trim($_POST['avatar'] ?? '');

        // Auto-link pairing_id from pairings table
        $pairingId = null;
        if (!empty($packageTag)) {
            $pairings = (new PairingModel())->getActivePairings();
            foreach ($pairings as $p) {
                if ($packageTag === 'Gói ' . $p['title'] || $packageTag === $p['title']) {
                    $pairingId = (int)$p['id'];
                    break;
                }
            }
        }

        $db = (new TestimonialModel())->getDb();
        if ($db && $id > 0) {
            $stmt = $db->prepare("UPDATE testimonials SET pairing_id = :pairing_id, name = :name, role = :role, package_tag = :package_tag, rating = :rating, content = :content, avatar = :avatar WHERE id = :id");
            $stmt->execute([
                'pairing_id' => $pairingId,
                'name' => $name,
                'role' => $role,
                'package_tag' => $packageTag,
                'rating' => $rating,
                'content' => $content,
                'avatar' => $avatar,
                'id' => $id
            ]);
        }

        $this->redirectWithSection('Đã cập nhật Đánh giá khách hàng thành công!');
    }

    public function deleteTestimonial(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $id = (int)($_POST['id'] ?? 0);
        $db = (new TestimonialModel())->getDb();
        if ($db && $id > 0) {
            $stmt = $db->prepare("DELETE FROM testimonials WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }

        $this->redirectWithSection('Đã xóa Đánh giá khách hàng thành công!');
    }

    // FAQ CRUD
    public function createFaq(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $question = trim($_POST['question'] ?? '');
        $answer = trim($_POST['answer'] ?? '');

        if (empty($question) || empty($answer)) {
            $this->redirectWithSection('Vui lòng nhập cả câu hỏi và câu trả lời FAQ.', 'err');
        }

        $db = (new FaqModel())->getDb();
        if ($db) {
            $stmt = $db->prepare("INSERT INTO faqs (question, answer, status) VALUES (:question, :answer, 'active')");
            $stmt->execute([
                'question' => $question,
                'answer' => $answer
            ]);
        }

        $this->redirectWithSection('Đã thêm Câu hỏi FAQ mới thành công!');
    }

    public function updateFaq(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $id = (int)($_POST['id'] ?? 0);
        $question = trim($_POST['question'] ?? '');
        $answer = trim($_POST['answer'] ?? '');

        $db = (new FaqModel())->getDb();
        if ($db && $id > 0) {
            $stmt = $db->prepare("UPDATE faqs SET question = :question, answer = :answer WHERE id = :id");
            $stmt->execute([
                'question' => $question,
                'answer' => $answer,
                'id' => $id
            ]);
        }

        $this->redirectWithSection('Đã cập nhật câu hỏi FAQ thành công!');
    }

    public function deleteFaq(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $id = (int)($_POST['id'] ?? 0);
        $db = (new FaqModel())->getDb();
        if ($db && $id > 0) {
            $stmt = $db->prepare("DELETE FROM faqs WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }

        $this->redirectWithSection('Đã xóa câu hỏi FAQ thành công!');
    }

    public function updateSeo(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $metaTitle = trim($_POST['meta_title'] ?? '');
        $metaDescription = trim($_POST['meta_description'] ?? '');
        $metaKeywords = trim($_POST['meta_keywords'] ?? '');
        $ogImage = trim($_POST['og_image'] ?? '');
        $canonicalUrl = trim($_POST['canonical_url'] ?? '');

        $seoModel = new SeoModel();
        $seoModel->updateSeoSettings($metaTitle, $metaDescription, $metaKeywords, $ogImage, $canonicalUrl);

        $this->redirectWithSection('Đã cập nhật cấu hình SEO & Meta Tags thành công!');
    }

    public function updateWorkshop(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $id = (int)($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $price = (float)($_POST['price'] ?? 0);

        if ($id <= 0 || empty($title) || $price <= 0) {
            $this->redirectWithSection('Vui lòng nhập thông tin Workshop hợp lệ.', 'err');
        }

        $data = [
            'title' => $title,
            'level' => trim($_POST['level'] ?? 'Standard Level'),
            'price' => $price,
            'duration' => trim($_POST['duration'] ?? '2.5 giờ'),
            'schedule' => trim($_POST['schedule'] ?? ''),
            'location' => trim($_POST['location'] ?? 'Hầm rượu Amis Duvin'),
            'max_participants' => max(1, (int)($_POST['max_participants'] ?? 12)),
            'wines_count' => (int)($_POST['wines_count'] ?? 5),
            'image' => trim($_POST['image'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'status' => trim($_POST['status'] ?? 'active'),
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0
        ];

        $workshopModel = new WorkshopModel();
        $success = $workshopModel->updateWorkshopPackage($id, $data);

        if ($success) {
            $currentUser = AuthService::user();
            NotificationService::notifyContent(
                "Cập nhật Gói Workshop #{$id}",
                "Nhân sự {$currentUser['full_name']} vừa chỉnh sửa thông tin gói Workshop '{$title}' từ trang Quản lý Nội dung.",
                admin_url('content'),
                $currentUser
            );
            $this->redirectWithSection('Đã cập nhật thông tin Workshop thành công!');
        }

        $this->redirectWithSection('Lỗi cập nhật Workshop.', 'err');
    }

    public function createBenefit(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (empty($title) || empty($description)) {
            header('Location: ' . admin_url('content') . '?sec=benefits&err=' . urlencode('Vui lòng nhập cả tiêu đề và nội dung diễn giải lợi ích.'));
            exit;
        }

        $benefitModel = new BenefitModel();
        $benefitModel->createBenefit([
            'title' => $title,
            'description' => $description
        ]);

        header('Location: ' . admin_url('content') . '?sec=benefits&msg=' . urlencode('Đã thêm Lợi ích cốt lõi mới thành công!'));
        exit;
    }

    public function deleteBenefit(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            (new BenefitModel())->deleteBenefit($id);
        }

        header('Location: ' . admin_url('content') . '?sec=benefits&msg=' . urlencode('Đã xóa Lợi ích cốt lõi thành công!'));
        exit;
    }

    public function createPairing(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $title = trim($_POST['title'] ?? '');
        $level = trim($_POST['level'] ?? 'Standard Level');
        $subtitle = trim($_POST['subtitle'] ?? '');
        $priceText = trim($_POST['price_text'] ?? 'Từ 1.500.000đ/khách');
        $image = trim($_POST['image'] ?? '');

        $sections = ['khai_vi' => 'Khai vị', 'mon_chinh' => 'Món chính', 'trang_mieng' => 'Tráng miệng'];
        $menuItems = [
            'khai_vi' => ['items' => [], 'wines' => []],
            'mon_chinh' => ['items' => [], 'wines' => []],
            'trang_mieng' => ['items' => [], 'wines' => []]
        ];
        $menuItemsArr = [];
        $hasNewFormat = false;
        foreach ($sections as $key => $label) {
            $courses = $_POST["courses_{$key}"] ?? null;
            $wines = $_POST["wines_{$key}"] ?? null;
            if (is_array($courses)) {
                $hasNewFormat = true;
                foreach ($courses as $idx => $course) {
                    $c = trim($course);
                    $w = trim($wines[$idx] ?? '');
                    if ($c !== '' || $w !== '') {
                        $menuItems[$key]['items'][] = $c;
                        if ($w !== '') {
                            $menuItems[$key]['wines'][] = $w;
                        }
                    }
                }
            }
        }
        if (!$hasNewFormat) {
            $courses = $_POST['courses'] ?? null;
            $wines = $_POST['wines'] ?? null;
            if (is_array($courses)) {
                foreach ($courses as $idx => $course) {
                    $c = trim($course);
                    $w = trim($wines[$idx] ?? '');
                    if ($c !== '' || $w !== '') {
                        $menuItemsArr[] = ['course' => $c, 'wine' => $w];
                    }
                }
            }
        }

        if (empty($title) || empty($subtitle)) {
            header('Location: ' . admin_url('content') . '?sec=pairings&err=' . urlencode('Vui lòng nhập tên gói tiệc và mô tả tóm tắt.'));
            exit;
        }

        $pairingModel = new PairingModel();
        $finalMenuItems = $hasNewFormat ? json_encode($menuItems, JSON_UNESCAPED_UNICODE) : $menuItemsArr;
        $pairingModel->createPairing([
            'title' => $title,
            'level' => $level,
            'subtitle' => $subtitle,
            'price_text' => $priceText,
            'image' => $image,
            'menu_items' => $finalMenuItems
        ]);

        $currentUser = AuthService::user();
        NotificationService::notifyContent(
            "Tạo Gói tiệc Pairing mới: {$title}",
            "Nhân sự {$currentUser['full_name']} vừa tạo mới gói tiệc Food & Wine Pairing '{$title}'.",
            admin_url('content') . '?sec=pairings',
            $currentUser
        );

        header('Location: ' . admin_url('content') . '?sec=pairings&msg=' . urlencode('Đã thêm Gói tiệc Pairing mới thành công!'));
        exit;
    }

    public function deletePairing(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            (new PairingModel())->deletePairing($id);
        }

        header('Location: ' . admin_url('content') . '?sec=pairings&msg=' . urlencode('Đã xóa Gói tiệc Pairing thành công!'));
        exit;
    }

    public function createWorkshop(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $title = trim($_POST['title'] ?? '');
        $price = (float)($_POST['price'] ?? 0);

        if (empty($title) || $price <= 0) {
            header('Location: ' . admin_url('content') . '?sec=workshops&err=' . urlencode('Vui lòng nhập tên Workshop và giá vé hợp lệ.'));
            exit;
        }

        $slug = trim($_POST['slug'] ?? '');
        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        }

        $data = [
            'slug' => $slug,
            'title' => $title,
            'level' => trim($_POST['level'] ?? 'Standard Level'),
            'price' => $price,
            'duration' => trim($_POST['duration'] ?? '2.5 giờ'),
            'schedule' => trim($_POST['schedule'] ?? 'Thứ 7 hàng tuần (15:00 - 17:30)'),
            'location' => trim($_POST['location'] ?? 'Hầm rượu riêng Amis Duvin'),
            'max_participants' => max(1, (int)($_POST['max_participants'] ?? 12)),
            'wines_count' => (int)($_POST['wines_count'] ?? 5),
            'image' => trim($_POST['image'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'status' => trim($_POST['status'] ?? 'active'),
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0
        ];

        $workshopModel = new WorkshopModel();
        $workshopModel->createWorkshopPackage($data);

        $currentUser = AuthService::user();
        NotificationService::notifyContent(
            "Tạo Gói Workshop mới: {$title}",
            "Nhân sự {$currentUser['full_name']} vừa tạo thêm gói Workshop mới '{$title}'.",
            admin_url('content') . '?sec=workshops',
            $currentUser
        );

        header('Location: ' . admin_url('content') . '?sec=workshops&msg=' . urlencode('Đã tạo Gói Workshop mới thành công!'));
        exit;
    }

    public function deleteWorkshop(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            (new WorkshopModel())->deleteWorkshopPackage($id);
        }

        header('Location: ' . admin_url('content') . '?sec=workshops&msg=' . urlencode('Đã xóa Gói Workshop thành công!'));
        exit;
    }

    public function resetSection(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $section = trim($_POST['section'] ?? 'all');
        $res = \App\Services\DefaultContentSeeder::reset($section);

        $currentUser = AuthService::user();
        if ($res['success']) {
            NotificationService::notifyContent(
                "Khôi phục dữ liệu gốc",
                "Nhân sự {$currentUser['full_name']} vừa khôi phục lại dữ liệu mẫu ban đầu cho phần: '{$section}'.",
                admin_url('content') . "?sec={$section}",
                $currentUser
            );
            header('Location: ' . admin_url('content') . '?sec=' . urlencode($section) . '&msg=' . urlencode($res['message']));
        } else {
            header('Location: ' . admin_url('content') . '?sec=' . urlencode($section) . '&err=' . urlencode($res['message']));
        }
        exit;
    }
}
