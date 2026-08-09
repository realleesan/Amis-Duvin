<?php

namespace App\Controllers\Admin;

use Core\BaseController;
use App\Services\AuthService;
use App\Models\BookingModel;
use App\Models\WorkshopModel;
use App\Models\UserModel;
use App\Models\NotificationModel;
use App\Services\NotificationService;

class TrashController extends BaseController
{
    public function index(): void
    {
        AuthService::requireRole(['admin']);

        $bookingModel = new BookingModel();
        $workshopModel = new WorkshopModel();
        $userModel = new UserModel();
        $notificationModel = new NotificationModel();

        $type = $_GET['type'] ?? 'bookings';
        if (!in_array($type, ['bookings', 'workshops', 'users', 'notifications'], true)) {
            $type = 'bookings';
        }

        $counts = [
            'bookings' => $bookingModel->getTrashCount(),
            'workshops' => $workshopModel->getTrashRegistrationsCount(),
            'users' => $userModel->getTrashCount(),
            'notifications' => $notificationModel->getTrashCount()
        ];

        $items = match($type) {
            'workshops' => $workshopModel->getTrashRegistrations(),
            'users' => $userModel->getTrashUsers(),
            'notifications' => $notificationModel->getTrashNotifications(),
            default => $bookingModel->getTrashBookings()
        };

        $user = AuthService::user();
        $activeNav = 'trash';
        $message = $_GET['msg'] ?? null;
        $error = $_GET['err'] ?? null;

        require __DIR__ . '/../../views/admin/trash/index.php';
    }

    public function restore(): void
    {
        AuthService::requireRole(['admin']);

        $type = $_POST['type'] ?? '';
        $id = (int)($_POST['id'] ?? 0);

        if ($id <= 0) {
            header('Location: ' . admin_url('trash') . '?err=' . urlencode('ID không hợp lệ.'));
            exit;
        }

        $currentUser = AuthService::user();
        $success = false;
        $label = '';

        switch ($type) {
            case 'bookings':
                $success = (new BookingModel())->restore($id);
                $label = "đơn đặt tiệc LEAD-" . str_pad((string)$id, 5, '0', STR_PAD_LEFT);
                break;
            case 'workshops':
                $success = (new WorkshopModel())->restoreRegistration($id);
                $label = "đăng ký Workshop WS-" . str_pad((string)$id, 4, '0', STR_PAD_LEFT);
                break;
            case 'users':
                $success = (new UserModel())->restore($id);
                $label = "tài khoản người dùng #{$id}";
                break;
            case 'notifications':
                $success = (new NotificationModel())->restore($id);
                $label = "thông báo #{$id}";
                break;
        }

        if ($success) {
            NotificationService::notifySystem(
                "Khôi phục dữ liệu từ Thùng rác",
                "Quản trị viên {$currentUser['full_name']} đã khôi phục {$label}.",
                admin_url('trash') . "?type={$type}",
                $currentUser
            );
            header('Location: ' . admin_url('trash') . "?type={$type}&msg=" . urlencode("Đã khôi phục {$label} thành công!"));
        } else {
            header('Location: ' . admin_url('trash') . "?type={$type}&err=" . urlencode("Không thể khôi phục mục đã chọn."));
        }
        exit;
    }

    public function forceDelete(): void
    {
        AuthService::requireRole(['admin']);

        $type = $_POST['type'] ?? '';
        $id = (int)($_POST['id'] ?? 0);

        if ($id <= 0) {
            header('Location: ' . admin_url('trash') . '?err=' . urlencode('ID không hợp lệ.'));
            exit;
        }

        $currentUser = AuthService::user();
        $success = false;
        $label = '';

        switch ($type) {
            case 'bookings':
                $success = (new BookingModel())->hardDelete($id);
                $label = "đơn đặt tiệc LEAD-" . str_pad((string)$id, 5, '0', STR_PAD_LEFT);
                break;
            case 'workshops':
                $success = (new WorkshopModel())->hardDeleteRegistration($id);
                $label = "đăng ký Workshop WS-" . str_pad((string)$id, 4, '0', STR_PAD_LEFT);
                break;
            case 'users':
                // Prevent self permanent deletion
                if ($id === (int)$currentUser['id']) {
                    header('Location: ' . admin_url('trash') . "?type=users&err=" . urlencode("Không thể xóa vĩnh viễn tài khoản của chính bạn."));
                    exit;
                }
                $success = (new UserModel())->hardDelete($id);
                $label = "tài khoản người dùng #{$id}";
                break;
            case 'notifications':
                $success = (new NotificationModel())->hardDelete($id);
                $label = "thông báo #{$id}";
                break;
        }

        if ($success) {
            NotificationService::notifySystem(
                "Xóa vĩnh viễn dữ liệu",
                "Quản trị viên {$currentUser['full_name']} đã xóa vĩnh viễn {$label} khỏi hệ thống.",
                admin_url('trash') . "?type={$type}",
                $currentUser
            );
            header('Location: ' . admin_url('trash') . "?type={$type}&msg=" . urlencode("Đã xóa vĩnh viễn {$label} khỏi hệ thống!"));
        } else {
            header('Location: ' . admin_url('trash') . "?type={$type}&err=" . urlencode("Xóa vĩnh viễn thất bại."));
        }
        exit;
    }

    public function bulkRestore(): void
    {
        AuthService::requireRole(['admin']);

        $type = $_POST['type'] ?? '';
        $ids = $_POST['ids'] ?? [];
        if (!is_array($ids) || empty($ids)) {
            header('Location: ' . admin_url('trash') . "?type={$type}&err=" . urlencode("Vui lòng chọn ít nhất 1 mục để khôi phục."));
            exit;
        }

        $count = count($ids);
        $currentUser = AuthService::user();

        switch ($type) {
            case 'bookings':
                (new BookingModel())->bulkRestore($ids);
                break;
            case 'workshops':
                (new WorkshopModel())->bulkRestoreRegistrations($ids);
                break;
            case 'users':
                (new UserModel())->bulkRestore($ids);
                break;
            case 'notifications':
                (new NotificationModel())->bulkRestore($ids);
                break;
        }

        NotificationService::notifySystem(
            "Khôi phục dữ liệu hàng loạt",
            "Quản trị viên {$currentUser['full_name']} đã khôi phục hàng loạt ({$count} mục) trong Thùng rác.",
            admin_url('trash') . "?type={$type}",
            $currentUser
        );

        header('Location: ' . admin_url('trash') . "?type={$type}&msg=" . urlencode("Đã khôi phục {$count} mục được chọn thành công!"));
        exit;
    }

    public function bulkForceDelete(): void
    {
        AuthService::requireRole(['admin']);

        $type = $_POST['type'] ?? '';
        $ids = $_POST['ids'] ?? [];
        if (!is_array($ids) || empty($ids)) {
            header('Location: ' . admin_url('trash') . "?type={$type}&err=" . urlencode("Vui lòng chọn ít nhất 1 mục để xóa vĩnh viễn."));
            exit;
        }

        $currentUser = AuthService::user();

        switch ($type) {
            case 'bookings':
                (new BookingModel())->bulkHardDelete($ids);
                break;
            case 'workshops':
                (new WorkshopModel())->bulkHardDeleteRegistrations($ids);
                break;
            case 'users':
                (new UserModel())->bulkHardDelete($ids, (int)$currentUser['id']);
                break;
            case 'notifications':
                (new NotificationModel())->bulkHardDelete($ids);
                break;
        }

        $count = count($ids);
        NotificationService::notifySystem(
            "Xóa vĩnh viễn dữ liệu hàng loạt",
            "Quản trị viên {$currentUser['full_name']} đã xóa vĩnh viễn hàng loạt ({$count} mục) khỏi hệ thống.",
            admin_url('trash') . "?type={$type}",
            $currentUser
        );

        header('Location: ' . admin_url('trash') . "?type={$type}&msg=" . urlencode("Đã xóa vĩnh viễn {$count} mục được chọn khỏi hệ thống!"));
        exit;
    }
}
