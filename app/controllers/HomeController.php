<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\WorkshopModel;
use App\Models\PairingModel;
use App\Models\TestimonialModel;

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

        $this->view('home/index', [
            'title' => 'Amis du Vin — Nghệ thuật Thưởng thức Vang & Food Pairing',
            'workshops' => $workshops,
            'featuredWorkshops' => $featuredWorkshops,
            'topicWorkshops' => $topicWorkshops,
            'pairings' => $pairings,
            'testimonials' => $testimonials
        ]);
    }
}
