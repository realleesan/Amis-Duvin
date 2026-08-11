<?php

namespace App\Controllers\Admin;

use Core\BaseController;
use App\Services\AuthService;

class AdminUploadController extends BaseController
{
    public function uploadImage(): void
    {
        // Clear any previous buffered output to guarantee clean JSON response
        if (ob_get_length()) {
            ob_clean();
        }

        header('Content-Type: application/json; charset=utf-8');

        if (!AuthService::check()) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.']);
            exit;
        }

        $file = $_FILES['image'] ?? $_FILES['file'] ?? null;
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Chưa chọn tệp ảnh hoặc có lỗi khi tải lên.']);
            exit;
        }

        // Max 10MB
        if ($file['size'] > 10 * 1024 * 1024) {
            http_response_code(422);
            echo json_encode(['success' => false, 'message' => 'Dung lượng ảnh tối đa cho phép là 10MB.']);
            exit;
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $allowedExtensions, true)) {
            http_response_code(422);
            echo json_encode(['success' => false, 'message' => 'Định dạng tệp không hỗ trợ. Vui lòng chọn ảnh JPG, PNG, WEBP, GIF hoặc SVG.']);
            exit;
        }

        // Target Directory: uploads/YYYY/MM/
        $yearMonth = date('Y/m');
        $basePath = defined('BASE_PATH') ? BASE_PATH : dirname(__DIR__, 3);
        $uploadDir = $basePath . '/uploads/' . $yearMonth;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = 'img_' . uniqid() . '_' . bin2hex(random_bytes(4)) . '.' . $extension;
        $targetPath = $uploadDir . '/' . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $publicUrl = '/uploads/' . $yearMonth . '/' . $fileName;
            echo json_encode([
                'success' => true,
                'url' => $publicUrl,
                'message' => 'Tải ảnh lên thiết bị thành công!'
            ]);
            exit;
        }

        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Không thể lưu tệp ảnh lên máy chủ. Vui lòng kiểm tra quyền thư mục uploads.']);
        exit;
    }
}
