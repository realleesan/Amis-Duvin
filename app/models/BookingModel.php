<?php

namespace App\Models;

use Core\BaseModel;

class BookingModel extends BaseModel
{
    protected string $table = 'bookings';

    /**
     * Get busy slots for a given date
     */
    public function getBusySlotsByDate(string $date): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->prepare(
            "SELECT time_slot FROM {$this->table} WHERE booking_date = :date AND status != 'cancelled'"
        );
        $stmt->execute(['date' => $date]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * Check capacity and group limits for a date & slot
     * Rules: Max 2 groups per slot OR max 24 total participants per slot
     */
    public function checkSlotCapacity(string $date, string $slot, int $newParticipants): array
    {
        if (!$this->db) return ['allowed' => true];

        $stmt = $this->db->prepare(
            "SELECT COUNT(*) AS total_groups, COALESCE(SUM(participants), 0) AS total_participants 
             FROM {$this->table} 
             WHERE booking_date = :date AND time_slot = :slot AND status != 'cancelled'"
        );
        $stmt->execute(['date' => $date, 'slot' => $slot]);
        $res = $stmt->fetch();

        $existingGroups = (int)($res['total_groups'] ?? 0);
        $existingParticipants = (int)($res['total_participants'] ?? 0);

        if ($existingGroups >= 2) {
            return [
                'allowed' => false,
                'message' => "Khung giờ {$slot} ngày " . date('d/m/Y', strtotime($date)) . " đã nhận đủ giới hạn 02 đoàn khách. Vui lòng chọn ca khác hoặc ngày khác."
            ];
        }

        if (($existingParticipants + $newParticipants) > 24) {
            $remaining = max(0, 24 - $existingParticipants);
            return [
                'allowed' => false,
                'message' => "Khung giờ {$slot} ngày " . date('d/m/Y', strtotime($date)) . " hiện chỉ còn nhận thêm tối đa {$remaining} khách (Tổng trần 24 khách/ca)."
            ];
        }

        return ['allowed' => true];
    }

    public function getAllBookings(): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $stmt->fetchAll() ?: [];
    }

    public function getBookingById(int $id): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public function updateStatus(int $id, string $depositStatus, ?string $notes = null): bool
    {
        if (!$this->db) return false;
        $sql = "UPDATE {$this->table} SET deposit_status = :deposit_status";
        $params = ['deposit_status' => $depositStatus, 'id' => $id];

        if ($notes !== null) {
            $sql .= ", notes = :notes";
            $params['notes'] = $notes;
        }

        $sql .= " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
}
