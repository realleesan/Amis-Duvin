<?php

namespace App\Controllers\Admin;

use Core\BaseController;
use App\Services\AuthService;

class AuthController extends BaseController
{
    public function showLogin(): void
    {
        if (AuthService::check()) {
            header('Location: ' . admin_url());
            exit;
        }

        $error = $_GET['error'] ?? null;
        require __DIR__ . '/../../views/admin/auth/login.php';
    }

    public function login(): void
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $res = AuthService::attempt($username, $password);

        if ($res['success']) {
            header('Location: ' . admin_url());
            exit;
        }

        header('Location: ' . admin_url('login') . '?error=' . urlencode($res['message']));
        exit;
    }

    public function logout(): void
    {
        AuthService::logout();
        header('Location: ' . admin_url('login'));
        exit;
    }
}
