<?php

namespace App\Controllers\Admin;

use Core\BaseController;
use App\Services\AuthService;
use App\Models\BookingModel;
use App\Services\GoogleSheetsService;

class AdminBookingController extends BaseController
{
    public function index(): void
    {
        AuthService::requireRole(['admin', 'cskh']);

        $bookingModel = new BookingModel();
        $bookings = $bookingModel->getAllBookings();

        // Optional filtering
        $statusFilter = $_GET['status'] ?? '';
        $dateFilter = $_GET['date'] ?? '';

        if ($statusFilter !== '') {
            $bookings = array_filter($bookings, fn($b) => ($b['deposit_status'] ?? '') === $statusFilter);
        }

        if ($dateFilter !== '') {
            $normalizedDate = $dateFilter;
            if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $dateFilter, $m)) {
                $normalizedDate = sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
            }
            $bookings = array_filter($bookings, fn($b) => ($b['booking_date'] ?? '') === $normalizedDate);
        }

        $user = AuthService::user();
        $message = $_GET['msg'] ?? null;
        $error = $_GET['err'] ?? null;

        require __DIR__ . '/../../views/admin/bookings/index.php';
    }

    public function update(): void
    {
        AuthService::requireRole(['admin', 'cskh']);

        $id = (int)($_POST['id'] ?? 0);
        $depositStatus = trim($_POST['deposit_status'] ?? 'Chờ xác nhận');
        $notes = isset($_POST['notes']) ? trim($_POST['notes']) : null;

        $bookingModel = new BookingModel();
        $booking = $bookingModel->getBookingById($id);

        if (!$booking) {
            header('Location: /admin/bookings?err=' . urlencode('Đơn đặt tiệc không tồn tại!'));
            exit;
        }

        $bookingModel->updateStatus($id, $depositStatus, $notes);

        // Auto-sync updated lead status to Google Sheets (Option 1)
        $booking['deposit_status'] = $depositStatus;
        if ($notes !== null) $booking['notes'] = $notes;

        $sheetsService = new GoogleSheetsService();
        $syncRes = $sheetsService->syncBookingLead($booking);

        $msg = 'Đã cập nhật trạng thái đơn thành công!';
        if ($syncRes['success']) {
            $msg .= ' và đồng bộ thành công sang Google Sheets.';
        }

        header('Location: /admin/bookings?msg=' . urlencode($msg));
        exit;
    }

    public function manualCreate(): void
    {
        AuthService::requireRole(['admin', 'cskh']);

        $fullName = trim($_POST['full_name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $participants = (int)($_POST['participants'] ?? 0);
        $bookingDate = trim($_POST['booking_date'] ?? '');
        $timeSlot = trim($_POST['time_slot'] ?? '');
        $notes = trim($_POST['notes'] ?? '');
        $depositStatus = trim($_POST['deposit_status'] ?? 'Chờ xác nhận');

        if (empty($fullName) || empty($phone) || empty($bookingDate) || empty($timeSlot) || $participants <= 0) {
            header('Location: /admin/bookings?err=' . urlencode('Vui lòng điền đầy đủ các thông tin bắt buộc.'));
            exit;
        }

        if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $bookingDate, $m)) {
            $bookingDate = sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
        }

        // 5-day notice check (Within 5 days from today: Today -> Today + 5 days)
        $todayTimestamp = strtotime(date('Y-m-d'));
        $maxAllowedTimestamp = strtotime(date('Y-m-d', strtotime('+5 days')));
        $chosenTimestamp = strtotime($bookingDate);

        if (!$chosenTimestamp || $chosenTimestamp < $todayTimestamp || $chosenTimestamp > $maxAllowedTimestamp) {
            header('Location: /admin/bookings?err=' . urlencode('Theo quy định, chỉ có thể đặt tiệc trong vòng 05 ngày tới (từ ' . date('d/m/Y', $todayTimestamp) . ' đến ' . date('d/m/Y', $maxAllowedTimestamp) . ').'));
            exit;
        }

        // Capacity check
        $bookingModel = new BookingModel();
        $capacity = $bookingModel->checkSlotCapacity($bookingDate, $timeSlot, $participants);
        if (!$capacity['allowed']) {
            header('Location: /admin/bookings?err=' . urlencode($capacity['message']));
            exit;
        }

        $db = $bookingModel->getDb();
        if ($db) {
            $stmt = $db->prepare(
                "INSERT INTO bookings (full_name, phone, email, participants, booking_date, time_slot, notes, deposit_status, status)
                 VALUES (:full_name, :phone, :email, :participants, :booking_date, :time_slot, :notes, :deposit_status, 'confirmed')"
            );
            $stmt->execute([
                'full_name' => $fullName,
                'phone' => $phone,
                'email' => $email,
                'participants' => $participants,
                'booking_date' => $bookingDate,
                'time_slot' => $timeSlot,
                'notes' => $notes ? "[CSKH Nhập tay] " . $notes : "[CSKH Nhập tay]",
                'deposit_status' => $depositStatus
            ]);
            $leadId = $db->lastInsertId();

            if ($leadId) {
                $booking = $bookingModel->getBookingById((int)$leadId);
                if ($booking) {
                    $sheetsService = new GoogleSheetsService();
                    $sheetsService->syncBookingLead($booking);
                }
                header('Location: /admin/bookings?msg=' . urlencode('Đã tạo đơn nhập tay thành công & đồng bộ Google Sheets!'));
                exit;
            }
        }

        header('Location: /admin/bookings?err=' . urlencode('Lỗi tạo đơn tiệc mới.'));
        exit;
    }

    public function syncSheets(): void
    {
        AuthService::requireRole(['admin', 'cskh']);

        $id = (int)($_POST['id'] ?? 0);
        $bookingModel = new BookingModel();
        $booking = $bookingModel->getBookingById($id);

        if (!$booking) {
            header('Location: /admin/bookings?err=' . urlencode('Đơn không tồn tại.'));
            exit;
        }

        $sheetsService = new GoogleSheetsService();
        $res = $sheetsService->syncBookingLead($booking);

        if ($res['success']) {
            header('Location: /admin/bookings?msg=' . urlencode('Đã đẩy dữ liệu thành công sang Google Sheets.'));
        } else {
            header('Location: /admin/bookings?err=' . urlencode($res['message'] ?? 'Lỗi đồng bộ Google Sheets.'));
        }
        exit;
    }
}
