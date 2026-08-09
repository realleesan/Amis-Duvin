<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\WorkshopModel;
use App\Services\NotificationService;

class WorkshopController extends BaseController
{
    public function store(): void
    {
        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

        $name = trim($input['full_name'] ?? $input['name'] ?? '');
        $phone = trim($input['phone'] ?? '');
        $email = trim($input['email'] ?? '');
        $workshopId = (int)($input['workshop_id'] ?? 1);
        $participants = max(1, (int)($input['participants'] ?? $input['guests'] ?? 1));

        if (mb_strlen($name) < 2 || !preg_match('/^0\d{9,10}$/', $phone)) {
            $this->json(['success' => false, 'message' => 'Vui lòng kiểm tra lại họ tên và số điện thoại (10 số).'], 422);
            return;
        }

        $workshopModel = new WorkshopModel();

        $selectedWorkshops = [$workshopId > 0 ? $workshopId : 1];
        if (!empty($input['addons']) && is_array($input['addons'])) {
            foreach ($input['addons'] as $addonId) {
                $aId = (int)$addonId;
                if ($aId > 0 && !in_array($aId, $selectedWorkshops, true)) {
                    $selectedWorkshops[] = $aId;
                }
            }
        }

        $registeredCount = 0;
        $registeredTitles = [];

        foreach ($selectedWorkshops as $wId) {
            $wsDetail = $workshopModel->getWorkshopById($wId);
            $wsTitle = $wsDetail['title'] ?? "Workshop #{$wId}";

            $resId = $workshopModel->registerParticipant([
                'workshop_id'  => $wId,
                'full_name'    => sanitize($name),
                'phone'        => sanitize($phone),
                'email'        => sanitize($email),
                'participants' => $participants,
                'notes'        => sanitize($input['notes'] ?? ''),
                'status'       => 'pending'
            ]);

            if ($resId) {
                $registeredCount++;
                $registeredTitles[] = $wsTitle;

                // Auto-sync to Google Sheets
                (new \App\Services\GoogleSheetsService())->syncWorkshopRegistration([
                    'id' => is_numeric($resId) ? (int)$resId : 0,
                    'workshop_title' => $wsTitle,
                    'full_name' => sanitize($name),
                    'phone' => sanitize($phone),
                    'email' => sanitize($email),
                    'participants' => $participants,
                    'notes' => sanitize($input['notes'] ?? ''),
                    'status' => 'pending',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        if ($registeredCount > 0) {
            $titlesStr = implode(', ', $registeredTitles);
            NotificationService::notifyWorkshop(
                "Đăng ký Workshop mới: {$name}",
                "Khách hàng {$name} ({$phone}) vừa đăng ký các Workshop: [{$titlesStr}] ({$participants} vé/lớp).",
                admin_url('workshops')
            );
        }

        $this->json([
            'success' => true,
            'message' => 'Đăng ký workshop thành công!'
        ]);
    }
}
