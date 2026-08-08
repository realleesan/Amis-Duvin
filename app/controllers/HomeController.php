<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\WorkshopModel;
use App\Models\PairingModel;
use App\Models\TestimonialModel;
use App\Models\FaqModel;
use App\Models\BenefitModel;
use App\Models\HeroModel;

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

        $this->view('home/index', [
            'title' => 'Amis du Vin — Nghệ thuật Thưởng thức Vang & Food Pairing',
            'workshops' => $workshops,
            'featuredWorkshops' => $featuredWorkshops,
            'topicWorkshops' => $topicWorkshops,
            'pairings' => $pairings,
            'testimonials' => $testimonials,
            'faqs' => $faqs,
            'benefits' => $benefits,
            'hero' => $hero
        ]);
    }
}
