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
}
