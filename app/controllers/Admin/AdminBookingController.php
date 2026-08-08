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
            $bookings = array_filter($bookings, fn($b) => ($b['booking_date'] ?? '') === $dateFilter);
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
