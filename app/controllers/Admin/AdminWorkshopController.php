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
        $activeTab = $_GET['tab'] ?? 'registrations';

        $workshopModel = new WorkshopModel();
        $registrations = $workshopModel->getAllRegistrations($statusFilter, $workshopFilter);
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
}
