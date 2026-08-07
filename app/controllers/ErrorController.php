<?php

namespace App\Controllers;

use Core\BaseController;

class ErrorController extends BaseController
{
    public function notFound(): void
    {
        http_response_code(404);
        $this->view('errors/404', ['title' => '404 - Trang không tìm thấy']);
    }

    public function serverError(): void
    {
        http_response_code(500);
        $this->view('errors/500', ['title' => '500 - Lỗi máy chủ']);
    }
}
