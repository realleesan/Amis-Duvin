<?php

namespace App\Controllers\Admin;

use Core\BaseController;
use App\Services\AuthService;
use App\Models\BookingModel;
use App\Services\GoogleSheetsService;
use App\Services\NotificationService;

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
            header('Location: ' . admin_url('bookings') . '?err=' . urlencode('Đơn đặt tiệc không tồn tại!'));
            exit;
        }

        $bookingModel->updateStatus($id, $depositStatus, $notes);

        $currentUser = AuthService::user();
        NotificationService::notifyBooking(
            "Cập nhật đơn tiệc #{$id}",
            "Nhân sự {$currentUser['full_name']} vừa cập nhật trạng thái cọc thành: '{$depositStatus}'.",
            admin_url('bookings') . "?date={$booking['booking_date']}",
            $currentUser
        );

        // Auto-sync updated lead status to Google Sheets (Option 1)
        $booking['deposit_status'] = $depositStatus;
        if ($notes !== null) $booking['notes'] = $notes;

        $sheetsService = new GoogleSheetsService();
        $syncRes = $sheetsService->syncBookingLead($booking);

        $msg = 'Đã cập nhật trạng thái đơn thành công!';
        if ($syncRes['success']) {
            $msg .= ' và đồng bộ thành công sang Google Sheets.';
        }

        header('Location: ' . admin_url('bookings') . '?msg=' . urlencode($msg));
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
            header('Location: ' . admin_url('bookings') . '?err=' . urlencode('Vui lòng điền đầy đủ các thông tin bắt buộc.'));
            exit;
        }

        if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $bookingDate, $m)) {
            $bookingDate = sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
        }

        // Advance notice check (At least 5 days in advance)
        $minAdvanceDays = 5;
        $minAllowedTimestamp = strtotime("+{$minAdvanceDays} days 00:00:00");
        $chosenTimestamp = strtotime($bookingDate);

        if (!$chosenTimestamp || $chosenTimestamp < $minAllowedTimestamp) {
            header('Location: ' . admin_url('bookings') . '?err=' . urlencode("Theo quy định, chỉ có thể đặt tiệc trước ít nhất {$minAdvanceDays} ngày (từ ngày " . date('d/m/Y', $minAllowedTimestamp) . " trở đi)."));
            exit;
        }

        // Capacity check
        $bookingModel = new BookingModel();
        $capacity = $bookingModel->checkSlotCapacity($bookingDate, $timeSlot, $participants);
        if (!$capacity['allowed']) {
            header('Location: ' . admin_url('bookings') . '?err=' . urlencode($capacity['message']));
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
                $currentUser = AuthService::user();
                NotificationService::notifyBooking(
                    "Đơn tiệc nhập tay mới (Hotline)",
                    "Nhân sự {$currentUser['full_name']} vừa nhập tay đơn tiệc cho khách {$fullName} ({$phone}) ngày {$bookingDate}.",
                    admin_url('bookings') . "?date={$bookingDate}",
                    $currentUser
                );

                $booking = $bookingModel->getBookingById((int)$leadId);
                if ($booking) {
                    $sheetsService = new GoogleSheetsService();
                    $sheetsService->syncBookingLead($booking);
                }
                header('Location: ' . admin_url('bookings') . '?msg=' . urlencode('Đã tạo đơn nhập tay thành công & đồng bộ Google Sheets!'));
                exit;
            }
        }

        header('Location: ' . admin_url('bookings') . '?err=' . urlencode('Lỗi tạo đơn tiệc mới.'));
        exit;
    }

    public function syncSheets(): void
    {
        AuthService::requireRole(['admin', 'cskh']);

        $id = (int)($_POST['id'] ?? 0);
        $bookingModel = new BookingModel();
        $booking = $bookingModel->getBookingById($id);

        if (!$booking) {
            header('Location: ' . admin_url('bookings') . '?err=' . urlencode('Đơn không tồn tại.'));
            exit;
        }

        $currentUser = AuthService::user();
        $sheetsService = new GoogleSheetsService();
        $res = $sheetsService->syncBookingLead($booking);

        if ($res['success']) {
            NotificationService::notifySystem(
                "Đồng bộ Google Sheets",
                "Nhân sự {$currentUser['full_name']} vừa đẩy dữ liệu đơn #{$id} ({$booking['full_name']}) sang Sheets.",
                admin_url('bookings'),
                $currentUser
            );
            header('Location: ' . admin_url('bookings') . '?msg=' . urlencode('Đã đẩy dữ liệu thành công sang Google Sheets.'));
        } else {
            NotificationService::notifySystem(
                "Lỗi đồng bộ Google Sheets",
                "Thất bại khi đẩy đơn #{$id} sang Sheets: " . ($res['message'] ?? ''),
                admin_url('bookings'),
                $currentUser
            );
            header('Location: ' . admin_url('bookings') . '?err=' . urlencode($res['message'] ?? 'Lỗi đồng bộ Google Sheets.'));
        }
        exit;
    }

    public function delete(): void
    {
        AuthService::requireRole(['admin']);

        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            (new BookingModel())->softDelete($id);
            $currentUser = AuthService::user();
            NotificationService::notifySystem(
                "Xóa tạm đơn đặt tiệc",
                "Quản trị viên {$currentUser['full_name']} vừa đưa đơn tiệc LEAD-" . str_pad((string)$id, 5, '0', STR_PAD_LEFT) . " vào thùng rác.",
                admin_url('trash') . "?type=bookings",
                $currentUser
            );
            header('Location: ' . admin_url('bookings') . '?msg=' . urlencode('Đã đưa đơn đặt tiệc vào thùng rác thành công!'));
            exit;
        }
        header('Location: ' . admin_url('bookings') . '?err=' . urlencode('Lỗi khi xóa đơn đặt tiệc.'));
        exit;
    }

    public function bulkDelete(): void
    {
        AuthService::requireRole(['admin']);

        $ids = $_POST['ids'] ?? [];
        if (!is_array($ids) || empty($ids)) {
            header('Location: ' . admin_url('bookings') . '?err=' . urlencode('Vui lòng chọn ít nhất 1 đơn tiệc để xóa.'));
            exit;
        }

        $count = count($ids);
        (new BookingModel())->bulkSoftDelete($ids);

        $currentUser = AuthService::user();
        NotificationService::notifySystem(
            "Xóa tạm đơn tiệc hàng loạt",
            "Quản trị viên {$currentUser['full_name']} vừa chuyển {$count} đơn tiệc vào thùng rác.",
            admin_url('trash') . "?type=bookings",
            $currentUser
        );

        header('Location: ' . admin_url('bookings') . '?msg=' . urlencode("Đã chuyển {$count} đơn tiệc được chọn vào thùng rác thành công!"));
        exit;
    }

    public function bulkSyncSheets(): void
    {
        AuthService::requireRole(['admin', 'cskh']);

        $ids = $_POST['ids'] ?? [];
        if (!is_array($ids) || empty($ids)) {
            header('Location: ' . admin_url('bookings') . '?err=' . urlencode('Vui lòng chọn ít nhất 1 đơn tiệc để đồng bộ Google Sheets.'));
            exit;
        }

        $bookingModel = new BookingModel();
        $sheetsService = new GoogleSheetsService();
        $successCount = 0;

        foreach ($ids as $id) {
            $booking = $bookingModel->getBookingById((int)$id);
            if ($booking) {
                $res = $sheetsService->syncBookingLead($booking);
                if ($res['success']) {
                    $successCount++;
                }
            }
        }

        $currentUser = AuthService::user();
        NotificationService::notifySystem(
            "Đồng bộ Google Sheets hàng loạt",
            "Nhân sự {$currentUser['full_name']} vừa đồng bộ {$successCount}/" . count($ids) . " đơn tiệc sang Google Sheets.",
            admin_url('bookings'),
            $currentUser
        );

        header('Location: ' . admin_url('bookings') . '?msg=' . urlencode("Đã đồng bộ thành công {$successCount}/" . count($ids) . " đơn tiệc sang Google Sheets!"));
        exit;
    }

    public function resyncAllSheets(): void
    {
        AuthService::requireRole(['admin', 'cskh']);

        $bookingModel = new BookingModel();
        $bookings = $bookingModel->getAllBookings();

        $sheetsService = new GoogleSheetsService();
        $res = $sheetsService->resyncAllBookings($bookings);

        $currentUser = AuthService::user();
        if ($res['success']) {
            NotificationService::notifySystem(
                "Đồng bộ lại toàn bộ Google Sheets Đặt tiệc",
                "Nhân sự {$currentUser['full_name']} vừa làm sạch & tống toàn bộ " . count($bookings) . " đơn tiệc sang Google Sheets.",
                admin_url('bookings'),
                $currentUser
            );
            header('Location: ' . admin_url('bookings') . '?msg=' . urlencode("Đã xóa dữ liệu cũ & làm mới toàn bộ " . count($bookings) . " đơn tiệc trên Google Sheets thành công!"));
        } else {
            header('Location: ' . admin_url('bookings') . '?err=' . urlencode($res['message'] ?? 'Lỗi đồng bộ Google Sheets.'));
        }
        exit;
    }
}
