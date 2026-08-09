<?php

namespace App\Services;

use App\Models\UserModel;

class AuthService
{
    public static function attempt(string $username, string $password): array
    {
        $userModel = new UserModel();
        $user = $userModel->findByUsername(trim($username));

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return ['success' => false, 'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác!'];
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['full_name'] = $user['full_name'];

        return ['success' => true, 'user' => $user];
    }

    public static function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['user_role'], $_SESSION['full_name']);
        session_destroy();
    }

    public static function check(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return !empty($_SESSION['user_id']);
    }

    public static function user(): ?array
    {
        if (!self::check()) return null;
        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'role' => $_SESSION['user_role'],
            'full_name' => $_SESSION['full_name']
        ];
    }

    public static function requireAuth(): void
    {
        if (!self::check()) {
            header('Location: ' . admin_url('login'));
            exit;
        }
    }

    public static function requireRole(array $allowedRoles): void
    {
        self::requireAuth();
        $user = self::user();
        if (!$user || !in_array($user['role'], $allowedRoles, true)) {
            header('Location: ' . admin_url() . '?error=' . urlencode('Bạn không có quyền truy cập chức năng này!'));
            exit;
        }
    }
}
