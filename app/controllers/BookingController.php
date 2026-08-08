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
        
        $bookingDate = sanitize($input['date'] ?? $input['booking_date']);
        $timeSlot = sanitize($input['slot'] ?? $input['time_slot']);
        $participants = (int)$input['participants'];

        // Capacity check
        $capCheck = $bookingModel->checkSlotCapacity($bookingDate, $timeSlot, $participants);
        if (!$capCheck['allowed']) {
            $this->json(['success' => false, 'message' => $capCheck['message']], 422);
            return;
        }

        $id = $bookingModel->create([
            'full_name'    => sanitize($input['name'] ?? $input['full_name']),
            'phone'        => sanitize($input['phone']),
            'email'        => sanitize($input['email']),
            'participants' => $participants,
            'booking_date' => $bookingDate,
            'time_slot'    => $timeSlot,
            'notes'        => sanitize($input['notes'] ?? ''),
        ]);

        $this->json([
            'success' => true,
            'message' => 'Đăng ký đặt tiệc thành công! CSKH Amis du Vin sẽ liên hệ trong vòng 2 giờ làm việc để chốt thực đơn và hướng dẫn cọc.',
            'id'      => $id ?: rand(100, 999)
        ]);
    }
}
