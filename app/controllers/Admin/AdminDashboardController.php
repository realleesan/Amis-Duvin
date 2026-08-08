<?php

namespace App\Controllers\Admin;

use Core\BaseController;
use App\Services\AuthService;
use App\Models\BookingModel;
use App\Models\WorkshopModel;

class AdminDashboardController extends BaseController
{
    public function index(): void
    {
        AuthService::requireAuth();

        $bookingModel = new BookingModel();
        $allBookings = $bookingModel->getAllBookings();

        $workshopModel = new WorkshopModel();
        $allWorkshops = $workshopModel->getAllWorkshops();

        $totalBookings = count($allBookings);
        $pendingBookings = count(array_filter($allBookings, fn($b) => ($b['deposit_status'] ?? '') === 'Chờ xác nhận'));
        $confirmedBookings = count(array_filter($allBookings, fn($b) => ($b['deposit_status'] ?? '') === 'Đã chốt cọc 30%'));
        $totalGuests = array_sum(array_column($allBookings, 'participants'));

        $user = AuthService::user();

        require __DIR__ . '/../../views/admin/dashboard.php';
    }
}
