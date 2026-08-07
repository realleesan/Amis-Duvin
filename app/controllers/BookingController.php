<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\BookingModel;
use App\Services\ValidationService;

class BookingController extends BaseController
{
    public function getAvailability(): void
    {
        $date = sanitize($_GET['date'] ?? '');
        if (!$date) {
            $this->json(['busy' => []]);
            return;
        }

        $bookingModel = new BookingModel();
        $busySlots = $bookingModel->getBusySlotsByDate($date);

        $this->json([
            'date' => $date,
            'busy' => $busySlots
        ]);
    }

    public function store(): void
    {
        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

        $errors = ValidationService::validateBooking($input);
        if (!empty($errors)) {
            $this->json(['success' => false, 'errors' => $errors], 422);
            return;
        }

        $bookingModel = new BookingModel();
        $id = $bookingModel->create([
            'full_name'    => sanitize($input['name']),
            'phone'        => sanitize($input['phone']),
            'email'        => sanitize($input['email']),
            'participants' => (int)$input['participants'],
            'booking_date' => sanitize($input['date']),
            'time_slot'    => sanitize($input['slot']),
            'notes'        => sanitize($input['notes'] ?? ''),
        ]);

        $this->json([
            'success' => true,
            'message' => 'Đăng ký đặt tiệc thành công! CSKH Amis du Vin sẽ liên hệ trong 2 giờ.',
            'id'      => $id ?: rand(100, 999)
        ]);
    }
}
