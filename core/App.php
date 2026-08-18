<?php

namespace Core;

class App
{
    public function run(): void
    {
        // Load helpers early for env() helper
        require_once __DIR__ . '/helpers.php';

        // Error reporting configuration
        $debug = filter_var(env('APP_DEBUG', false), FILTER_VALIDATE_BOOLEAN);
        if ($debug) {
            ini_set('display_errors', '1');
            ini_set('display_startup_errors', '1');
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', '0');
            ini_set('display_startup_errors', '0');
            error_reporting(0);
        }

        // Start session if not active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Register autoloader with Linux case-sensitivity support
        spl_autoload_register(function ($class) {
            $baseDir = __DIR__ . '/../';

            // Core namespace
            if (str_starts_with($class, 'Core\\')) {
                $rel = substr($class, 5);
                $file = $baseDir . 'core/' . str_replace('\\', '/', $rel) . '.php';
                if (file_exists($file)) {
                    require_once $file;
                    return;
                }
            }

            // App namespace (supports lowercase subdirectories like app/controllers, app/models, etc. on Linux)
            if (str_starts_with($class, 'App\\')) {
                $rel = substr($class, 4);
                $parts = explode('\\', $rel);

                // 1. Try exact path
                $file = $baseDir . 'app/' . implode('/', $parts) . '.php';
                if (file_exists($file)) {
                    require_once $file;
                    return;
                }

                // 2. Try lowercase first folder (e.g. app/controllers/... or app/models/...)
                if (!empty($parts)) {
                    $partsLower = $parts;
                    $partsLower[0] = strtolower($partsLower[0]);
                    $fileLower = $baseDir . 'app/' . implode('/', $partsLower) . '.php';
                    if (file_exists($fileLower)) {
                        require_once $fileLower;
                        return;
                    }
                }
            }

            // Fallback for general classes
            $file = $baseDir . str_replace('\\', '/', $class) . '.php';
            if (file_exists($file)) {
                require_once $file;
            }
        });

        // Load routes
        require_once __DIR__ . '/../config/routes.php';

        // Dispatch request with Exception handling
        try {
            $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
            $uri = $_SERVER['REQUEST_URI'] ?? '/';
            Router::dispatch($method, $uri);
        } catch (\Throwable $e) {
            if ($debug) {
                echo "<div style='font-family:monospace;padding:20px;background:#1a1a1a;color:#f87171;border:1px solid #dc2626;margin:20px;border-radius:8px;'>";
                echo "<h2 style='margin-top:0;'>Application Exception: " . htmlspecialchars($e->getMessage()) . "</h2>";
                echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . ":" . $e->getLine() . "</p>";
                echo "<pre style='background:#111;padding:12px;overflow:auto;color:#e5e7eb;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
                echo "</div>";
            } else {
                http_response_code(500);
                $errorView = __DIR__ . '/../app/views/errors/500.php';
                if (file_exists($errorView)) {
                    require $errorView;
                } else {
                    echo "500 Internal Server Error";
                }
            }
        }
    }
}

