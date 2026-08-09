<?php

if (!function_exists('sanitize')) {
    function sanitize(string $data): string {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string {
        return '/' . ltrim($path, '/');
    }
}

if (!function_exists('url')) {
    function url(string $path = ''): string {
        return '/' . ltrim($path, '/');
    }
}

if (!function_exists('admin_url')) {
    function admin_url(string $path = ''): string {
        $slug = env('ADMIN_SLUG', 'adv-cms-2026-x89k2');
        return '/' . $slug . ($path ? '/' . ltrim($path, '/') : '');
    }
}

if (!function_exists('env')) {
    function env(string $key, $default = null) {
        static $envVars = null;
        if ($envVars === null) {
            $envVars = [];
            $envFile = __DIR__ . '/../.env';
            if (!file_exists($envFile)) {
                $envFile = __DIR__ . '/../.env.example';
            }
            if (file_exists($envFile)) {
                $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    if (str_starts_with(trim($line), '#')) continue;
                    if (str_contains($line, '=')) {
                        [$k, $v] = explode('=', $line, 2);
                        $envVars[trim($k)] = trim($v, " \"'");
                    }
                }
            }
        }
        return $envVars[$key] ?? $default;
    }
}
