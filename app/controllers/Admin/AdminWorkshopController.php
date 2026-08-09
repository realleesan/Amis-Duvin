<?php

namespace App\Controllers\Admin;

use Core\BaseController;
use App\Services\AuthService;
use App\Models\WorkshopModel;
use App\Services\NotificationService;

class AdminWorkshopController extends BaseController
{
    public function index(): void
    {
        AuthService::requireRole(['admin', 'cskh']);

        $statusFilter = $_GET['status'] ?? '';
        $workshopFilter = $_GET['workshop_id'] ?? '';
        $dateFilter = $_GET['date'] ?? '';
        $activeTab = $_GET['tab'] ?? 'registrations';

        $workshopModel = new WorkshopModel();
        $registrations = $workshopModel->getAllRegistrations($statusFilter, $workshopFilter);

        if ($dateFilter !== '') {
            $normalizedDate = $dateFilter;
            if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $dateFilter, $m)) {
                $normalizedDate = sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
            }
            $registrations = array_filter($registrations, function($r) use ($normalizedDate) {
                $createdAt = !empty($r['created_at']) ? date('Y-m-d', strtotime($r['created_at'])) : '';
                return $createdAt === $normalizedDate;
            });
        }

        $workshops = $workshopModel->getAllWorkshops();

        $user = AuthService::user();
        $message = $_GET['msg'] ?? null;
        $error = $_GET['err'] ?? null;

        require __DIR__ . '/../../views/admin/workshops/index.php';
    }

    public function updateRegistration(): void
    {
        AuthService::requireRole(['admin', 'cskh']);

        $id = (int)($_POST['id'] ?? 0);
        $status = trim($_POST['status'] ?? 'pending');
        $notes = isset($_POST['notes']) ? trim($_POST['notes']) : null;

        $workshopModel = new WorkshopModel();
        $reg = $workshopModel->getRegistrationById($id);

        if (!$reg) {
            header('Location: ' . admin_url('workshops') . '?err=' . urlencode('Đăng ký không tồn tại!'));
            exit;
        }

        $workshopModel->updateRegistrationStatus($id, $status, $notes);

        $currentUser = AuthService::user();
        $statusLabel = match($status) {
          'confirmed' => 'Đã chốt vé / Đã cọc',
          'cancelled' => 'Đã hủy',
          default => 'Chờ xác nhận'
        };

        NotificationService::notifyWorkshop(
            "Cập nhật đăng ký Workshop #{$id}",
            "Nhân sự {$currentUser['full_name']} vừa cập nhật trạng thái đơn Workshop của {$reg['full_name']} thành: '{$statusLabel}'.",
            admin_url('workshops'),
            $currentUser
        );

        header('Location: ' . admin_url('workshops') . '?msg=' . urlencode('Đã cập nhật trạng thái đăng ký thành công!'));
        exit;
    }

    public function manualCreateRegistration(): void
    {
        AuthService::requireRole(['admin', 'cskh']);

        $name = trim($_POST['full_name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $workshopId = (int)($_POST['workshop_id'] ?? 0);
        $participants = max(1, (int)($_POST['participants'] ?? 1));
        $notes = trim($_POST['notes'] ?? '');

        if (empty($name) || empty($phone) || $workshopId <= 0) {
            header('Location: ' . admin_url('workshops') . '?err=' . urlencode('Vui lòng điền đầy đủ họ tên, SĐT và chọn Workshop.'));
            exit;
        }

        $workshopModel = new WorkshopModel();
        $regId = $workshopModel->registerParticipant([
            'workshop_id'  => $workshopId,
            'full_name'    => sanitize($name),
            'phone'        => sanitize($phone),
            'email'        => sanitize($email),
            'participants' => $participants,
            'notes'        => $notes ? "[CSKH Nhập tay] " . $notes : "[CSKH Nhập tay]",
            'status'       => 'confirmed'
        ]);

        if ($regId) {
            $currentUser = AuthService::user();
            NotificationService::notifyWorkshop(
                "CSKH nhập tay đăng ký Workshop",
                "Nhân sự {$currentUser['full_name']} vừa đăng ký {$participants} chỗ Workshop cho khách {$name} ({$phone}).",
                admin_url('workshops'),
                $currentUser
            );
            header('Location: ' . admin_url('workshops') . '?msg=' . urlencode('Đã nhập tay đăng ký Workshop thành công!'));
            exit;
        }

        header('Location: ' . admin_url('workshops') . '?err=' . urlencode('Lỗi khi tạo đăng ký mới.'));
        exit;
    }

    public function createWorkshop(): void
    {
        AuthService::requireRole(['admin']);

        $title = trim($_POST['title'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        }
        $price = (float)($_POST['price'] ?? 0);

        if (empty($title) || $price <= 0) {
            header('Location: ' . admin_url('workshops') . '?tab=packages&err=' . urlencode('Vui lòng nhập tên Workshop và giá vé hợp lệ.'));
            exit;
        }

        $data = [
            'slug' => $slug,
            'title' => $title,
            'level' => trim($_POST['level'] ?? 'Standard Level'),
            'price' => $price,
            'duration' => trim($_POST['duration'] ?? '2 giờ'),
            'schedule' => trim($_POST['schedule'] ?? ''),
            'location' => trim($_POST['location'] ?? 'Amis du Vin Cellar'),
            'max_participants' => max(1, (int)($_POST['max_participants'] ?? 12)),
            'wines_count' => (int)($_POST['wines_count'] ?? 5),
            'image' => trim($_POST['image'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'status' => trim($_POST['status'] ?? 'active'),
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0
        ];

        $workshopModel = new WorkshopModel();
        $id = $workshopModel->createWorkshopPackage($data);

        if ($id) {
            $currentUser = AuthService::user();
            NotificationService::notifyContent(
                "Tạo gói Workshop mới: {$title}",
                "Admin {$currentUser['full_name']} vừa tạo thêm gói Workshop mới '{$title}' trên Landing Page.",
                admin_url('workshops') . '?tab=packages',
                $currentUser
            );
            header('Location: ' . admin_url('workshops') . '?tab=packages&msg=' . urlencode('Đã tạo gói Workshop mới thành công!'));
            exit;
        }

        header('Location: ' . admin_url('workshops') . '?tab=packages&err=' . urlencode('Lỗi tạo gói Workshop mới.'));
        exit;
    }

    public function updateWorkshop(): void
    {
        AuthService::requireRole(['admin']);

        $id = (int)($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $price = (float)($_POST['price'] ?? 0);

        if ($id <= 0 || empty($title) || $price <= 0) {
            header('Location: ' . admin_url('workshops') . '?tab=packages&err=' . urlencode('Vui lòng nhập đầy đủ các trường hợp lệ.'));
            exit;
        }

        $data = [
            'title' => $title,
            'level' => trim($_POST['level'] ?? 'Standard Level'),
            'price' => $price,
            'duration' => trim($_POST['duration'] ?? '2 giờ'),
            'schedule' => trim($_POST['schedule'] ?? ''),
            'location' => trim($_POST['location'] ?? ''),
            'max_participants' => max(1, (int)($_POST['max_participants'] ?? 12)),
            'wines_count' => (int)($_POST['wines_count'] ?? 5),
            'image' => trim($_POST['image'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'status' => trim($_POST['status'] ?? 'active'),
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0
        ];

        $workshopModel = new WorkshopModel();
        $success = $workshopModel->updateWorkshopPackage($id, $data);

        if ($success) {
            $currentUser = AuthService::user();
            NotificationService::notifyContent(
                "Cập nhật Workshop #{$id}",
                "Admin {$currentUser['full_name']} vừa chỉnh sửa thông tin gói Workshop '{$title}'.",
                admin_url('workshops') . '?tab=packages',
                $currentUser
            );
            header('Location: ' . admin_url('workshops') . '?tab=packages&msg=' . urlencode('Đã cập nhật thông tin Workshop thành công!'));
            exit;
        }

        header('Location: ' . admin_url('workshops') . '?tab=packages&err=' . urlencode('Lỗi cập nhật thông tin Workshop.'));
        exit;
    }

    public function deleteRegistration(): void
    {
        AuthService::requireRole(['admin']);

        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            (new WorkshopModel())->softDeleteRegistration($id);
            $currentUser = AuthService::user();
            NotificationService::notifySystem(
                "Xóa tạm đăng ký Workshop",
                "Quản trị viên {$currentUser['full_name']} vừa đưa đăng ký Workshop WS-" . str_pad((string)$id, 4, '0', STR_PAD_LEFT) . " vào thùng rác.",
                admin_url('trash') . "?type=workshops",
                $currentUser
            );
            header('Location: ' . admin_url('workshops') . '?tab=registrations&msg=' . urlencode('Đã đưa đơn đăng ký Workshop vào thùng rác thành công!'));
            exit;
        }
        header('Location: ' . admin_url('workshops') . '?tab=registrations&err=' . urlencode('Lỗi khi xóa đăng ký Workshop.'));
        exit;
    }

    public function bulkDeleteRegistration(): void
    {
        AuthService::requireRole(['admin']);

        $ids = $_POST['ids'] ?? [];
        if (!is_array($ids) || empty($ids)) {
            header('Location: ' . admin_url('workshops') . '?tab=registrations&err=' . urlencode('Vui lòng chọn ít nhất 1 đăng ký Workshop để xóa.'));
            exit;
        }

        $count = count($ids);
        (new WorkshopModel())->bulkSoftDeleteRegistrations($ids);

        $currentUser = AuthService::user();
        NotificationService::notifySystem(
            "Xóa tạm đăng ký Workshop hàng loạt",
            "Quản trị viên {$currentUser['full_name']} vừa chuyển {$count} đăng ký Workshop vào thùng rác.",
            admin_url('trash') . "?type=workshops",
            $currentUser
        );

        header('Location: ' . admin_url('workshops') . '?tab=registrations&msg=' . urlencode("Đã chuyển {$count} đăng ký Workshop được chọn vào thùng rác thành công!"));
        exit;
    }

    public function syncSheets(): void
    {
        AuthService::requireRole(['admin', 'cskh']);

        $id = (int)($_POST['id'] ?? 0);
        $workshopModel = new WorkshopModel();
        $reg = $workshopModel->getRegistrationById($id);

        if (!$reg) {
            header('Location: ' . admin_url('workshops') . '?tab=registrations&err=' . urlencode('Đơn đăng ký Workshop không tồn tại.'));
            exit;
        }

        $currentUser = AuthService::user();
        $sheetsService = new \App\Services\GoogleSheetsService();
        $res = $sheetsService->syncWorkshopRegistration($reg);

        if ($res['success']) {
            NotificationService::notifySystem(
                "Đồng bộ Google Sheets Workshop",
                "Nhân sự {$currentUser['full_name']} vừa đẩy đăng ký Workshop WS-" . str_pad((string)$id, 4, '0', STR_PAD_LEFT) . " ({$reg['full_name']}) sang Sheets.",
                admin_url('workshops'),
                $currentUser
            );
            header('Location: ' . admin_url('workshops') . '?tab=registrations&msg=' . urlencode('Đã đẩy dữ liệu đăng ký Workshop thành công sang Google Sheets!'));
        } else {
            NotificationService::notifySystem(
                "Lỗi đồng bộ Google Sheets",
                "Thất bại khi đẩy đăng ký Workshop WS-{$id} sang Sheets: " . ($res['message'] ?? ''),
                admin_url('workshops'),
                $currentUser
            );
            header('Location: ' . admin_url('workshops') . '?tab=registrations&err=' . urlencode($res['message'] ?? 'Lỗi đồng bộ Google Sheets.'));
        }
        exit;
    }

    public function bulkSyncSheets(): void
    {
        AuthService::requireRole(['admin', 'cskh']);

        $ids = $_POST['ids'] ?? [];
        if (!is_array($ids) || empty($ids)) {
            header('Location: ' . admin_url('workshops') . '?tab=registrations&err=' . urlencode('Vui lòng chọn ít nhất 1 đăng ký Workshop để đồng bộ Google Sheets.'));
            exit;
        }

        $workshopModel = new WorkshopModel();
        $sheetsService = new \App\Services\GoogleSheetsService();
        $successCount = 0;

        foreach ($ids as $id) {
            $reg = $workshopModel->getRegistrationById((int)$id);
            if ($reg) {
                $res = $sheetsService->syncWorkshopRegistration($reg);
                if ($res['success']) {
                    $successCount++;
                }
            }
        }

        $currentUser = AuthService::user();
        NotificationService::notifySystem(
            "Đồng bộ Google Sheets Workshop hàng loạt",
            "Nhân sự {$currentUser['full_name']} vừa đồng bộ {$successCount}/" . count($ids) . " đăng ký Workshop sang Google Sheets.",
            admin_url('workshops'),
            $currentUser
        );

        header('Location: ' . admin_url('workshops') . '?tab=registrations&msg=' . urlencode("Đã đồng bộ thành công {$successCount}/" . count($ids) . " đăng ký Workshop sang Google Sheets!"));
        exit;
    }

    public function resyncAllSheets(): void
    {
        AuthService::requireRole(['admin', 'cskh']);

        $workshopModel = new WorkshopModel();
        $registrations = $workshopModel->getAllRegistrations();

        $sheetsService = new \App\Services\GoogleSheetsService();
        $res = $sheetsService->resyncAllWorkshops($registrations);

        $currentUser = AuthService::user();
        if ($res['success']) {
            NotificationService::notifySystem(
                "Đồng bộ lại toàn bộ Google Sheets Workshop",
                "Nhân sự {$currentUser['full_name']} vừa làm sạch & tống toàn bộ " . count($registrations) . " đăng ký Workshop sang Google Sheets.",
                admin_url('workshops'),
                $currentUser
            );
            header('Location: ' . admin_url('workshops') . '?tab=registrations&msg=' . urlencode("Đã xóa dữ liệu cũ & làm mới toàn bộ " . count($registrations) . " đăng ký Workshop trên Google Sheets thành công!"));
        } else {
            header('Location: ' . admin_url('workshops') . '?tab=registrations&err=' . urlencode($res['message'] ?? 'Lỗi đồng bộ Google Sheets.'));
        }
        exit;
    }
}
