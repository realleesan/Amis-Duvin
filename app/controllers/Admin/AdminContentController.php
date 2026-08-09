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

class AdminContentController extends BaseController
{
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

        header('Location: ' . admin_url('content') . '?msg=' . urlencode('Đã cập nhật Section Hero thành công!'));
        exit;
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

        header('Location: ' . admin_url('content') . '?msg=' . urlencode('Đã cập nhật Section Giới thiệu Dịch vụ thành công!'));
        exit;
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
        $menuItems = trim($_POST['menu_items'] ?? '');

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

        header('Location: ' . admin_url('content') . '?msg=' . urlencode('Đã cập nhật Gói tiệc Pairing thành công!'));
        exit;
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

        header('Location: ' . admin_url('content') . '?msg=' . urlencode('Đã cập nhật Lợi ích cốt lõi thành công!'));
        exit;
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
            header('Location: ' . admin_url('content') . '?err=' . urlencode('Vui lòng nhập tên khách hàng và nội dung đánh giá.'));
            exit;
        }

        $db = (new TestimonialModel())->getDb();
        if ($db) {
            $stmt = $db->prepare("INSERT INTO testimonials (name, role, package_tag, rating, content, avatar) VALUES (:name, :role, :package_tag, :rating, :content, :avatar)");
            $stmt->execute([
                'name' => $name,
                'role' => $role,
                'package_tag' => $packageTag,
                'rating' => $rating,
                'content' => $content,
                'avatar' => $avatar
            ]);
        }

        header('Location: ' . admin_url('content') . '?msg=' . urlencode('Đã thêm Đánh giá mới thành công!'));
        exit;
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

        $db = (new TestimonialModel())->getDb();
        if ($db && $id > 0) {
            $stmt = $db->prepare("UPDATE testimonials SET name = :name, role = :role, package_tag = :package_tag, rating = :rating, content = :content, avatar = :avatar WHERE id = :id");
            $stmt->execute([
                'name' => $name,
                'role' => $role,
                'package_tag' => $packageTag,
                'rating' => $rating,
                'content' => $content,
                'avatar' => $avatar,
                'id' => $id
            ]);
        }

        header('Location: ' . admin_url('content') . '?msg=' . urlencode('Đã cập nhật Đánh giá khách hàng thành công!'));
        exit;
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

        header('Location: ' . admin_url('content') . '?msg=' . urlencode('Đã xóa Đánh giá khách hàng thành công!'));
        exit;
    }

    // FAQ CRUD
    public function createFaq(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $question = trim($_POST['question'] ?? '');
        $answer = trim($_POST['answer'] ?? '');

        if (empty($question) || empty($answer)) {
            header('Location: ' . admin_url('content') . '?err=' . urlencode('Vui lòng nhập cả câu hỏi và câu trả lời FAQ.'));
            exit;
        }

        $db = (new FaqModel())->getDb();
        if ($db) {
            $stmt = $db->prepare("INSERT INTO faqs (question, answer, status) VALUES (:question, :answer, 'active')");
            $stmt->execute([
                'question' => $question,
                'answer' => $answer
            ]);
        }

        header('Location: ' . admin_url('content') . '?msg=' . urlencode('Đã thêm Câu hỏi FAQ mới thành công!'));
        exit;
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

        header('Location: ' . admin_url('content') . '?msg=' . urlencode('Đã cập nhật câu hỏi FAQ thành công!'));
        exit;
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

        header('Location: ' . admin_url('content') . '?msg=' . urlencode('Đã xóa câu hỏi FAQ thành công!'));
        exit;
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

        header('Location: ' . admin_url('content') . '?msg=' . urlencode('Đã cập nhật cấu hình SEO & Meta Tags thành công!'));
        exit;
    }
}
