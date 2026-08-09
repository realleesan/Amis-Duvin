<?php

namespace App\Controllers\Admin;

use Core\BaseController;
use App\Services\AuthService;
use App\Models\UserModel;
use App\Services\NotificationService;

class AdminUserController extends BaseController
{
    public function index(): void
    {
        AuthService::requireRole(['admin']);

        $userModel = new UserModel();
        $users = $userModel->getAllUsers();

        $user = AuthService::user();
        $msg = $_GET['msg'] ?? null;
        $err = $_GET['err'] ?? null;

        require __DIR__ . '/../../views/admin/users/index.php';
    }

    public function create(): void
    {
        AuthService::requireRole(['admin']);

        $username = trim($_POST['username'] ?? '');
        $fullName = trim($_POST['full_name'] ?? '');
        $password = $_POST['password'] ?? '';
        $role = trim($_POST['role'] ?? 'cskh');

        if (empty($username) || empty($fullName) || empty($password)) {
            header('Location: ' . admin_url('users') . '?err=' . urlencode('Vui lòng điền đầy đủ các thông tin bắt buộc.'));
            exit;
        }

        $userModel = new UserModel();
        $existing = $userModel->findByUsername($username);

        if ($existing) {
            header('Location: ' . admin_url('users') . '?err=' . urlencode('Tên đăng nhập đã tồn tại trên hệ thống.'));
            exit;
        }

        $success = $userModel->createUser($username, $password, $fullName, $role);

        if ($success) {
            $currentUser = AuthService::user();
            NotificationService::notifyUser(
                "Tạo tài khoản nhân sự mới: {$fullName}",
                "Admin {$currentUser['full_name']} vừa tạo tài khoản '{$username}' (Vai trò: {$role}).",
                admin_url('users'),
                $currentUser
            );
            header('Location: ' . admin_url('users') . '?msg=' . urlencode('Đã tạo tài khoản nhân sự mới thành công!'));
        } else {
            header('Location: ' . admin_url('users') . '?err=' . urlencode('Lỗi tạo tài khoản mới.'));
        }
        exit;
    }

    public function update(): void
    {
        AuthService::requireRole(['admin']);

        $id = (int)($_POST['id'] ?? 0);
        $fullName = trim($_POST['full_name'] ?? '');
        $role = trim($_POST['role'] ?? 'cskh');
        $newPassword = $_POST['new_password'] ?? '';

        if ($id <= 0 || empty($fullName)) {
            header('Location: ' . admin_url('users') . '?err=' . urlencode('Thông tin không hợp lệ.'));
            exit;
        }

        $userModel = new UserModel();
        $userModel->updateUser($id, $fullName, $role);

        if (!empty($newPassword)) {
            $userModel->updatePassword($id, $newPassword);
        }

        $currentUser = AuthService::user();
        NotificationService::notifyUser(
            "Cập nhật tài khoản #{$id} ({$fullName})",
            "Admin {$currentUser['full_name']} vừa cập nhật thông tin/mật khẩu cho nhân sự {$fullName}.",
            admin_url('users'),
            $currentUser
        );

        header('Location: ' . admin_url('users') . '?msg=' . urlencode('Đã cập nhật thông tin tài khoản thành công!'));
        exit;
    }

    public function delete(): void
    {
        AuthService::requireRole(['admin']);

        $id = (int)($_POST['id'] ?? 0);
        $currentUser = AuthService::user();

        if ($id <= 0) {
            header('Location: ' . admin_url('users') . '?err=' . urlencode('ID tài khoản không hợp lệ.'));
            exit;
        }

        if ($id === (int)$currentUser['id']) {
            header('Location: ' . admin_url('users') . '?err=' . urlencode('Bạn không thể tự xóa tài khoản của chính mình.'));
            exit;
        }

        $userModel = new UserModel();
        $targetUser = $userModel->findById($id);

        if (!$targetUser) {
            header('Location: ' . admin_url('users') . '?err=' . urlencode('Tài khoản không tồn tại.'));
            exit;
        }

        $userModel->softDelete($id);

        NotificationService::notifyUser(
            "Xóa tạm tài khoản nhân sự",
            "Quản trị viên {$currentUser['full_name']} vừa đưa tài khoản '{$targetUser['username']}' ({$targetUser['full_name']}) vào thùng rác.",
            admin_url('trash') . "?type=users",
            $currentUser
        );

        header('Location: ' . admin_url('users') . '?msg=' . urlencode("Đã đưa tài khoản '{$targetUser['username']}' vào thùng rác!"));
        exit;
    }

    public function bulkDelete(): void
    {
        AuthService::requireRole(['admin']);

        $ids = $_POST['ids'] ?? [];
        if (!is_array($ids) || empty($ids)) {
            header('Location: ' . admin_url('users') . '?err=' . urlencode('Vui lòng chọn ít nhất 1 tài khoản để xóa.'));
            exit;
        }

        $currentUser = AuthService::user();
        (new UserModel())->bulkSoftDelete($ids, (int)$currentUser['id']);

        $count = count($ids);
        NotificationService::notifyUser(
            "Xóa tạm tài khoản nhân sự hàng loạt",
            "Quản trị viên {$currentUser['full_name']} vừa chuyển {$count} tài khoản nhân sự vào thùng rác.",
            admin_url('trash') . "?type=users",
            $currentUser
        );

        header('Location: ' . admin_url('users') . '?msg=' . urlencode("Đã chuyển {$count} tài khoản được chọn vào thùng rác thành công!"));
        exit;
    }
}
