<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\WorkshopModel;

class WorkshopController extends BaseController
{
    public function store(): void
    {
        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

        $name = trim($input['name'] ?? '');
        $phone = trim($input['phone'] ?? '');
        $email = trim($input['email'] ?? '');
        $workshopId = (int)($input['workshop_id'] ?? 0);

        if (mb_strlen($name) < 2 || !preg_match('/^0\d{9}$/', $phone) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->json(['success' => false, 'message' => 'Vui lòng kiểm tra lại thông tin nhập'], 422);
            return;
        }

        $workshopModel = new WorkshopModel();
        $res = $workshopModel->registerParticipant([
            'workshop_id'  => $workshopId,
            'full_name'    => sanitize($name),
            'phone'        => sanitize($phone),
            'email'        => sanitize($email),
            'participants' => (int)($input['participants'] ?? 1),
            'notes'        => sanitize($input['notes'] ?? ''),
        ]);

        $this->json([
            'success' => true,
            'message' => 'Đăng ký workshop thành công!'
        ]);
    }
}
