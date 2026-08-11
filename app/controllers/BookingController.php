<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\BookingModel;
use App\Services\ValidationService;
use App\Services\NotificationService;

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
        if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $bookingDate, $m)) {
            $bookingDate = sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
        }
        $timeSlot = sanitize($input['slot'] ?? $input['time_slot']);
        $participants = (int)$input['participants'];

        // Capacity check
        $capCheck = $bookingModel->checkSlotCapacity($bookingDate, $timeSlot, $participants);
        if (!$capCheck['allowed']) {
            $this->json(['success' => false, 'message' => $capCheck['message']], 422);
            return;
        }

        $fullName = sanitize($input['name'] ?? $input['full_name']);
        $phone = sanitize($input['phone']);
        $email = sanitize($input['email']);
        $notes = sanitize($input['notes'] ?? '');

        $id = $bookingModel->create([
            'full_name'    => $fullName,
            'phone'        => $phone,
            'email'        => $email,
            'participants' => $participants,
            'booking_date' => $bookingDate,
            'time_slot'    => $timeSlot,
            'notes'        => $notes
        ]);

        if ($id) {
            // Trigger Notification & Audit Log
            $formattedDate = date('d/m/Y', strtotime($bookingDate));
            NotificationService::notifyBooking(
                "Đơn tiệc mới từ Khách hàng: {$fullName}",
                "Khách hàng {$fullName} ({$phone}) vừa đặt tiệc ngày {$formattedDate} - {$timeSlot} ({$participants} khách).",
                admin_url('bookings') . "?date={$bookingDate}"
            );

            $this->json([
                'success' => true,
                'message' => 'Đặt tiệc thành công! Bộ phận CSKH Amis Duvin sẽ liên hệ xác nhận trong thời gian sớm nhất.',
                'booking_id' => $id
            ]);
            return;
        }

        $this->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.'], 500);
    }
}
