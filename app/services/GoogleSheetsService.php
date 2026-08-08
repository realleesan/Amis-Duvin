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
}
