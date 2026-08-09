<?php

namespace App\Services;

use Core\BaseModel;

class GoogleSheetsService extends BaseModel
{
    protected string $table = 'google_sheets_config';

    public function getConfig(): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY id ASC LIMIT 1");
        $res = $stmt->fetch();
        return $res ?: [];
    }

    public function updateConfig(string $sheetId, string $webhookUrl, bool $isActive, bool $autoSync): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare("UPDATE {$this->table} SET sheet_id = :sheet_id, webhook_url = :webhook_url, is_active = :is_active, auto_sync = :auto_sync WHERE id = 1");
        return $stmt->execute([
            'sheet_id' => trim($sheetId),
            'webhook_url' => trim($webhookUrl),
            'is_active' => $isActive ? 1 : 0,
            'auto_sync' => $autoSync ? 1 : 0
        ]);
    }

    public function syncBookingLead(array $booking): array
    {
        $config = $this->getConfig();
        if (empty($config['is_active'])) {
            return ['success' => false, 'message' => 'Tích hợp Google Sheets đang bị tắt.'];
        }

        $webhookUrl = trim($config['webhook_url'] ?? '');
        if (empty($webhookUrl)) {
            // Return simulated success status with config notification if webhook URL is not yet set
            return [
                'success' => true, 
                'message' => 'Dữ liệu đã sẵn sàng đồng bộ (Vui lòng điền Webhook URL trong cài đặt CMS để đẩy tới Google Sheets thực tế).',
                'payload' => $booking
            ];
        }

        $payload = json_encode([
            'action' => 'sync_lead',
            'sheet_id' => $config['sheet_id'],
            'lead' => [
                'lead_code' => 'LEAD-' . str_pad((string)$booking['id'], 5, '0', STR_PAD_LEFT),
                'full_name' => $booking['full_name'],
                'phone' => $booking['phone'],
                'email' => $booking['email'],
                'participants' => $booking['participants'],
                'booking_date' => date('d/m/Y', strtotime($booking['booking_date'])),
                'time_slot' => $booking['time_slot'],
                'notes' => $booking['notes'] ?? '',
                'status' => $booking['deposit_status'] ?? 'Chờ xác nhận',
                'created_at' => $booking['created_at'] ?? date('Y-m-d H:i:s')
            ]
        ], JSON_UNESCAPED_UNICODE);

        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return ['success' => false, 'message' => 'Lỗi kết nối Webhook: ' . $curlError];
        }

        return [
            'success' => $httpCode >= 200 && $httpCode < 300,
            'http_code' => $httpCode,
            'response' => $response
        ];
    }

    public function syncWorkshopRegistration(array $reg): array
    {
        $config = $this->getConfig();
        if (empty($config['is_active'])) {
            return ['success' => false, 'message' => 'Tích hợp Google Sheets đang bị tắt.'];
        }

        $webhookUrl = trim($config['webhook_url'] ?? '');
        if (empty($webhookUrl)) {
            return [
                'success' => true,
                'message' => 'Dữ liệu đã sẵn sàng đồng bộ.',
                'payload' => $reg
            ];
        }

        $payload = json_encode([
            'action' => 'sync_workshop',
            'sheet_id' => $config['sheet_id'],
            'registration' => [
                'reg_code' => 'WS-' . str_pad((string)($reg['id'] ?? 0), 4, '0', STR_PAD_LEFT),
                'workshop_title' => $reg['workshop_title'] ?? $reg['title'] ?? 'Workshop Vang',
                'full_name' => $reg['full_name'] ?? '',
                'phone' => $reg['phone'] ?? '',
                'email' => $reg['email'] ?? '',
                'participants' => $reg['participants'] ?? 1,
                'status' => match($reg['status'] ?? 'pending') {
                    'confirmed' => 'Đã chốt vé',
                    'cancelled' => 'Đã hủy',
                    default => 'Chờ xác nhận'
                },
                'notes' => $reg['notes'] ?? '',
                'created_at' => $reg['created_at'] ?? date('Y-m-d H:i:s')
            ]
        ], JSON_UNESCAPED_UNICODE);

        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return ['success' => false, 'message' => 'Lỗi kết nối Webhook: ' . $curlError];
        }

        return [
            'success' => $httpCode >= 200 && $httpCode < 300,
            'http_code' => $httpCode,
            'response' => $response
        ];
    }

    public function resyncAllBookings(array $bookings): array
    {
        $config = $this->getConfig();
        if (empty($config['is_active'])) {
            return ['success' => false, 'message' => 'Tích hợp Google Sheets đang bị tắt.'];
        }

        $webhookUrl = trim($config['webhook_url'] ?? '');
        if (empty($webhookUrl)) {
            return ['success' => false, 'message' => 'Chưa cấu hình Webhook URL.'];
        }

        $leadsPayload = [];
        foreach ($bookings as $b) {
            $leadsPayload[] = [
                'lead_code' => 'LEAD-' . str_pad((string)($b['id'] ?? 0), 5, '0', STR_PAD_LEFT),
                'full_name' => $b['full_name'] ?? '',
                'phone' => $b['phone'] ?? '',
                'email' => $b['email'] ?? '',
                'participants' => $b['participants'] ?? 1,
                'booking_date' => !empty($b['booking_date']) ? date('d/m/Y', strtotime($b['booking_date'])) : '',
                'time_slot' => $b['time_slot'] ?? '',
                'status' => $b['deposit_status'] ?? 'Chờ xác nhận',
                'notes' => $b['notes'] ?? '',
                'created_at' => !empty($b['created_at']) ? date('d/m/Y H:i', strtotime($b['created_at'])) : ''
            ];
        }

        $payload = json_encode([
            'action' => 'resync_all_bookings',
            'sheet_id' => $config['sheet_id'],
            'leads' => $leadsPayload
        ], JSON_UNESCAPED_UNICODE);

        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return ['success' => false, 'message' => 'Lỗi kết nối Webhook: ' . $curlError];
        }

        return [
            'success' => $httpCode >= 200 && $httpCode < 300,
            'http_code' => $httpCode,
            'response' => $response
        ];
    }

    public function resyncAllWorkshops(array $registrations): array
    {
        $config = $this->getConfig();
        if (empty($config['is_active'])) {
            return ['success' => false, 'message' => 'Tích hợp Google Sheets đang bị tắt.'];
        }

        $webhookUrl = trim($config['webhook_url'] ?? '');
        if (empty($webhookUrl)) {
            return ['success' => false, 'message' => 'Chưa cấu hình Webhook URL.'];
        }

        $regsPayload = [];
        foreach ($registrations as $r) {
            $regsPayload[] = [
                'reg_code' => 'WS-' . str_pad((string)($r['id'] ?? 0), 4, '0', STR_PAD_LEFT),
                'workshop_title' => $r['workshop_title'] ?? $r['title'] ?? 'Workshop Vang',
                'full_name' => $r['full_name'] ?? '',
                'phone' => $r['phone'] ?? '',
                'email' => $r['email'] ?? '',
                'participants' => $r['participants'] ?? 1,
                'status' => match($r['status'] ?? 'pending') {
                    'confirmed' => 'Đã chốt vé',
                    'cancelled' => 'Đã hủy',
                    default => 'Chờ xác nhận'
                },
                'notes' => $r['notes'] ?? '',
                'created_at' => !empty($r['created_at']) ? date('d/m/Y H:i', strtotime($r['created_at'])) : ''
            ];
        }

        $payload = json_encode([
            'action' => 'resync_all_workshops',
            'sheet_id' => $config['sheet_id'],
            'registrations' => $regsPayload
        ], JSON_UNESCAPED_UNICODE);

        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return ['success' => false, 'message' => 'Lỗi kết nối Webhook: ' . $curlError];
        }

        return [
            'success' => $httpCode >= 200 && $httpCode < 300,
            'http_code' => $httpCode,
            'response' => $response
        ];
    }
}
