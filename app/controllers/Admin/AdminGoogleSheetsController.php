<?php

namespace App\Controllers\Admin;

use Core\BaseController;
use App\Services\AuthService;
use App\Services\GoogleSheetsService;

class AdminGoogleSheetsController extends BaseController
{
    public function index(): void
    {
        AuthService::requireRole(['admin']);

        $sheetsService = new GoogleSheetsService();
        $config = $sheetsService->getConfig();

        $user = AuthService::user();
        $msg = $_GET['msg'] ?? null;
        $err = $_GET['err'] ?? null;

        require __DIR__ . '/../../views/admin/google_sheets/index.php';
    }

    public function update(): void
    {
        AuthService::requireRole(['admin']);

        $sheetId = trim($_POST['sheet_id'] ?? '');
        $webhookUrl = trim($_POST['webhook_url'] ?? '');
        $isActive = isset($_POST['is_active']);
        $autoSync = isset($_POST['auto_sync']);

        $sheetsService = new GoogleSheetsService();
        $sheetsService->updateConfig($sheetId, $webhookUrl, $isActive, $autoSync);

        header('Location: ' . admin_url('google-sheets') . '?msg=' . urlencode('Đã cập nhật cấu hình Google Sheets thành công!'));
        exit;
    }

    public function testConnection(): void
    {
        AuthService::requireRole(['admin']);

        $sheetsService = new GoogleSheetsService();
        $res = $sheetsService->syncBookingLead([
            'id' => 99999,
            'full_name' => 'Test Lead Admin',
            'phone' => '0900000000',
            'email' => 'test@amisduvin.vn',
            'participants' => 2,
            'booking_date' => date('Y-m-d'),
            'time_slot' => 'Ca 1 (11h00 – 14h00)',
            'deposit_status' => 'Chờ xác nhận'
        ]);

        if ($res['success']) {
            header('Location: ' . admin_url('google-sheets') . '?msg=' . urlencode('Kết nối thành công! ' . ($res['message'] ?? '')));
        } else {
            header('Location: ' . admin_url('google-sheets') . '?err=' . urlencode($res['message'] ?? 'Kết nối thất bại.'));
        }
        exit;
    }
}
