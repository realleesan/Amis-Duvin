<?php

namespace App\Controllers\Admin;

use Core\BaseController;
use App\Services\AuthService;
use App\Models\UserModel;

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
            header('Location: /admin/users?err=' . urlencode('Vui lòng điền đầy đủ các thông tin bắt buộc.'));
            exit;
        }

        $userModel = new UserModel();
        $existing = $userModel->findByUsername($username);

        if ($existing) {
            header('Location: /admin/users?err=' . urlencode('Tên đăng nhập đã tồn tại trên hệ thống.'));
            exit;
        }

        $success = $userModel->createUser($username, $password, $fullName, $role);

        if ($success) {
            header('Location: /admin/users?msg=' . urlencode('Đã tạo tài khoản nhân sự mới thành công!'));
        } else {
            header('Location: /admin/users?err=' . urlencode('Lỗi tạo tài khoản mới.'));
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
            header('Location: /admin/users?err=' . urlencode('Thông tin không hợp lệ.'));
            exit;
        }

        $userModel = new UserModel();
        $userModel->updateUser($id, $fullName, $role);

        if (!empty($newPassword)) {
            $userModel->updatePassword($id, $newPassword);
        }

        header('Location: /admin/users?msg=' . urlencode('Đã cập nhật thông tin tài khoản thành công!'));
        exit;
    }
}
