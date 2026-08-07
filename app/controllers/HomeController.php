<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\WorkshopModel;

class HomeController extends BaseController
{
    public function index(): void
    {
        $workshopModel = new WorkshopModel();
        $workshops = $workshopModel->getActiveWorkshops();

        $this->view('home/index', [
            'title' => 'Amis du Vin — Nghệ thuật Thưởng thức Vang & Food Pairing',
            'workshops' => $workshops
        ]);
    }
}
