<?php

namespace Core;

abstract class BaseController
{
    /**
     * Render view template wrapped in master layout
     */
    protected function view(string $viewPath, array $data = [], string $layout = '_layout/master'): void
    {
        extract($data);

        // Capture view content
        ob_start();
        $viewFile = __DIR__ . '/../app/views/' . $viewPath . '.php';
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            die("View [{$viewPath}] not found at {$viewFile}");
        }
        $content = ob_get_clean();

        // Render master layout if specified
        if ($layout) {
            $layoutFile = __DIR__ . '/../app/views/' . $layout . '.php';
            if (file_exists($layoutFile)) {
                require $layoutFile;
            } else {
                echo $content;
            }
        } else {
            echo $content;
        }
    }

    /**
     * Return JSON response
     */
    protected function json(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Redirect to URL
     */
    protected function redirect(string $url): void
    {
        header("Location: " . $url);
        exit;
    }
}
