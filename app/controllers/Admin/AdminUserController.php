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
        $db = $userModel->getDb();
        $users = [];

        if ($db) {
            $stmt = $db->query("SELECT id, username, full_name, role, created_at FROM users ORDER BY id ASC");
            $users = $stmt->fetchAll() ?: [];
        }

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

        $db = $userModel->getDb();
        if ($db) {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $db->prepare("INSERT INTO users (username, password_hash, full_name, role) VALUES (:username, :hash, :full_name, :role)");
            $stmt->execute([
                'username' => $username,
                'hash' => $hash,
                'full_name' => $fullName,
                'role' => $role
            ]);
        }

        header('Location: /admin/users?msg=' . urlencode('Đã tạo tài khoản nhân sự mới thành công!'));
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
        $db = $userModel->getDb();

        if ($db) {
            $stmt = $db->prepare("UPDATE users SET full_name = :full_name, role = :role WHERE id = :id");
            $stmt->execute([
                'full_name' => $fullName,
                'role' => $role,
                'id' => $id
            ]);

            if (!empty($newPassword)) {
                $userModel->updatePassword($id, $newPassword);
            }
        }

        header('Location: /admin/users?msg=' . urlencode('Đã cập nhật thông tin tài khoản thành công!'));
        exit;
    }
}
