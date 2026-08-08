<?php

namespace App\Middleware;

use App\Services\AuthService;

class AuthMiddleware
{
    public static function handle(array $allowedRoles = []): void
    {
        if (empty($allowedRoles)) {
            AuthService::requireAuth();
        } else {
            AuthService::requireRole($allowedRoles);
        }
    }
}
