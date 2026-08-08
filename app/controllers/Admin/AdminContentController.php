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

        $user = AuthService::user();
        $msg = $_GET['msg'] ?? null;

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

        header('Location: /admin/content?msg=' . urlencode('Đã cập nhật Section Hero thành công!'));
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

        header('Location: /admin/content?msg=' . urlencode('Đã cập nhật Section Giới thiệu Dịch vụ thành công!'));
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

        $db = (new PairingModel())->getDb();
        if ($db && $id > 0) {
            $stmt = $db->prepare("UPDATE pairings SET title = :title, subtitle = :subtitle, price_text = :price_text, level = :level, image = :image WHERE id = :id");
            $stmt->execute([
                'title' => $title,
                'subtitle' => $subtitle,
                'price_text' => $priceText,
                'level' => $level,
                'image' => $image,
                'id' => $id
            ]);
        }

        header('Location: /admin/content?msg=' . urlencode('Đã cập nhật Gói tiệc Pairing thành công!'));
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

        header('Location: /admin/content?msg=' . urlencode('Đã cập nhật Lợi ích cốt lõi thành công!'));
        exit;
    }

    public function updateTestimonial(): void
    {
        AuthService::requireRole(['admin', 'marketing']);

        $id = (int)($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $role = trim($_POST['role'] ?? '');
        $content = trim($_POST['content'] ?? $_POST['quote'] ?? '');
        $avatar = trim($_POST['avatar'] ?? '');

        $db = (new TestimonialModel())->getDb();
        if ($db && $id > 0) {
            $stmt = $db->prepare("UPDATE testimonials SET name = :name, role = :role, content = :content, avatar = :avatar WHERE id = :id");
            $stmt->execute([
                'name' => $name,
                'role' => $role,
                'content' => $content,
                'avatar' => $avatar,
                'id' => $id
            ]);
        }

        header('Location: /admin/content?msg=' . urlencode('Đã cập nhật Đánh giá khách hàng thành công!'));
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

        header('Location: /admin/content?msg=' . urlencode('Đã cập nhật câu hỏi FAQ thành công!'));
        exit;
    }
}
