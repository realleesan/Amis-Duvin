<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\WorkshopModel;
use App\Models\PairingModel;

class HomeController extends BaseController
{
    public function index(): void
    {
        $workshopModel = new WorkshopModel();
        $workshops = $workshopModel->getActiveWorkshops();

        $pairingModel = new PairingModel();
        $pairings = $pairingModel->getActivePairings();

        $this->view('home/index', [
            'title' => 'Amis du Vin — Nghệ thuật Thưởng thức Vang & Food Pairing',
            'workshops' => $workshops,
            'pairings' => $pairings
        ]);
    }
}
