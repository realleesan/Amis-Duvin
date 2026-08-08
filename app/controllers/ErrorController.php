<?php

namespace App\Controllers;

use Core\BaseController;

class ErrorController extends BaseController
{
    public function notFound(): void
    {
        http_response_code(404);
        require __DIR__ . '/../views/errors/404.php';
    }

    public function serverError(): void
    {
        http_response_code(500);
        require __DIR__ . '/../views/errors/500.php';
    }
}
