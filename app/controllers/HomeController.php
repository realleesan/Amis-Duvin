<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\WorkshopModel;
use App\Models\PairingModel;
use App\Models\TestimonialModel;
use App\Models\FaqModel;
use App\Models\BenefitModel;
use App\Models\HeroModel;
use App\Models\ServiceIntroModel;
use App\Models\SeoModel;
use App\Models\AnalyticsModel;

class HomeController extends BaseController
{
    public function index(): void
    {
        // Record Traffic Pageview
        try {
            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
            $deviceType = 'desktop';
            if (preg_match('/(android|bb\d+|meego).+mobile|avail|blackberry|iemobile|mobi|opera mini|phone|tablet|ipad/i', $ua)) {
                $deviceType = preg_match('/tablet|ipad/i', $ua) ? 'tablet' : 'mobile';
            }
            (new AnalyticsModel())->recordPageview($ip, $ua, $deviceType, '/');
        } catch (\Throwable $e) {}

        $workshopModel = new WorkshopModel();
        $workshops = $workshopModel->getActiveWorkshops();
        $featuredWorkshops = $workshopModel->getFeaturedWorkshops();
        $topicWorkshops = $workshopModel->getTopicWorkshops();

        $pairingModel = new PairingModel();
        $pairings = $pairingModel->getActivePairings();

        $testimonialModel = new TestimonialModel();
        $testimonials = $testimonialModel->getActiveTestimonials();

        $faqModel = new FaqModel();
        $faqs = $faqModel->getActiveFaqs();

        $benefitModel = new BenefitModel();
        $benefits = $benefitModel->getActiveBenefits();

        $heroModel = new HeroModel();
        $hero = $heroModel->getHeroSettings();

        $serviceIntroModel = new ServiceIntroModel();
        $serviceIntro = $serviceIntroModel->getServiceIntroSettings();

        $seoModel = new SeoModel();
        $seo = $seoModel->getSeoSettings();

        $this->view('home/index', [
            'title' => $seo['meta_title'] ?? 'Amis du Vin — Nghệ thuật Thưởng thức Vang & Food Pairing',
            'seo' => $seo,
            'workshops' => $workshops,
            'featuredWorkshops' => $featuredWorkshops,
            'topicWorkshops' => $topicWorkshops,
            'pairings' => $pairings,
            'testimonials' => $testimonials,
            'faqs' => $faqs,
            'benefits' => $benefits,
            'hero' => $hero,
            'serviceIntro' => $serviceIntro
        ]);
    }

    public function under18(): void
    {
        require __DIR__ . '/../views/home/under_18.php';
    }
}
