<?php

namespace Core;

class App
{
    public function run(): void
    {
        // Start session if not active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Register autoloader for App, Core, and Config namespaces
        spl_autoload_register(function ($class) {
            $prefix = '';
            $baseDir = __DIR__ . '/../';

            if (str_starts_with($class, 'Core\\')) {
                $file = $baseDir . 'core/' . str_replace('\\', '/', substr($class, 5)) . '.php';
            } elseif (str_starts_with($class, 'App\\')) {
                $file = $baseDir . 'app/' . str_replace('\\', '/', substr($class, 4)) . '.php';
            } else {
                $file = $baseDir . str_replace('\\', '/', $class) . '.php';
            }

            if (file_exists($file)) {
                require_once $file;
            }
        });

        // Load helpers
        require_once __DIR__ . '/helpers.php';

        // Load routes
        require_once __DIR__ . '/../config/routes.php';

        // Dispatch request
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        Router::dispatch($method, $uri);
    }
}
