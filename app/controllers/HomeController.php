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

class HomeController extends BaseController
{
    public function index(): void
    {
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
