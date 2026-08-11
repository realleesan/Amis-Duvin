<?php

namespace App\Services;

use App\Models\UserModel;

class AuthService
{
    private static function startSecureSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params([
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
            session_start();
        }
    }

    public static function attempt(string $username, string $password): array
    {
        $userModel = new UserModel();
        $user = $userModel->findByUsername(trim($username));

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return ['success' => false, 'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác!'];
        }

        self::startSecureSession();

        // Regenerate Session ID to prevent Session Fixation attacks
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['last_activity'] = time();

        return ['success' => true, 'user' => $user];
    }

    public static function logout(): void
    {
        self::startSecureSession();
        unset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['user_role'], $_SESSION['full_name'], $_SESSION['last_activity']);
        session_destroy();
    }

    public static function check(): bool
    {
        self::startSecureSession();

        if (empty($_SESSION['user_id']) || empty($_SESSION['user_role']) || empty($_SESSION['username'])) {
            return false;
        }

        // Idle Session Timeout Check (Default 2 hours = 7200 seconds)
        $timeout = (int)env('SESSION_LIFETIME', 7200);
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
            self::logout();
            return false;
        }

        // Update last activity timestamp on active requests
        $_SESSION['last_activity'] = time();
        return true;
    }

    public static function user(): ?array
    {
        if (!self::check()) return null;
        return [
            'id' => $_SESSION['user_id'] ?? null,
            'username' => $_SESSION['username'] ?? '',
            'role' => $_SESSION['user_role'] ?? $_SESSION['role'] ?? 'guest',
            'full_name' => $_SESSION['full_name'] ?? 'Quản trị viên'
        ];
    }

    public static function requireAuth(): void
    {
        if (!self::check()) {
            header('Location: ' . admin_url('login') . '?error=' . urlencode('Phiên đăng nhập đã hết hạn hoặc không hợp lệ. Vui lòng đăng nhập lại.'));
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
