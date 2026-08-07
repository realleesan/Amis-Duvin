<?php

namespace App\Models;

use Core\BaseModel;

class WorkshopModel extends BaseModel
{
    protected string $table = 'workshops';

    public function getActiveWorkshops(): array
    {
        if (!$this->db) {
            // Static fallback data if database is not connected
            return [
                [
                    'id' => 1,
                    'slug' => 'nhap-mon-nem-thu-vang',
                    'title' => 'Nhập môn Nếm thử Vang',
                    'level' => 'Cơ bản',
                    'price' => 1200000,
                    'duration' => '2.5 giờ',
                    'schedule' => 'Thứ 7 hàng tuần, 15:00 - 17:30',
                    'location' => 'Amis du Vin Cellar — Q.3, TP.HCM',
                    'max_participants' => 12,
                    'current_participants' => 8,
                    'wines_count' => 5,
                    'image' => '/assets/images/workshop-1.jpg',
                ],
                [
                    'id' => 2,
                    'slug' => 'chieu-sau-vang-bordeaux',
                    'title' => 'Chiều sâu Vang Bordeaux & Burgundy',
                    'level' => 'Nâng cao',
                    'price' => 2500000,
                    'duration' => '3.0 giờ',
                    'schedule' => 'Chủ nhật cuối tháng, 18:00 - 21:00',
                    'location' => 'Amis du Vin Private Room — Q.1, TP.HCM',
                    'max_participants' => 8,
                    'current_participants' => 5,
                    'wines_count' => 6,
                    'image' => '/assets/images/workshop-2.jpg',
                ],
                [
                    'id' => 3,
                    'slug' => 'nghe-thuat-pairing',
                    'title' => 'Nghệ thuật Phối vị Wine & Cheese',
                    'level' => 'Chuyên đề',
                    'price' => 1800000,
                    'duration' => '2.5 giờ',
                    'schedule' => 'Thứ 6 hai tuần/lần, 18:30 - 21:00',
                    'location' => 'Amis du Vin Cellar — Q.3, TP.HCM',
                    'max_participants' => 10,
                    'current_participants' => 6,
                    'wines_count' => 5,
                    'image' => '/assets/images/workshop-3.jpg',
                ]
            ];
        }

        return $this->all();
    }

    public function registerParticipant(array $data): bool|string
    {
        if (!$this->db) return true; // Graceful mockup success if no DB

        $fields = array_keys($data);
        $columns = implode(', ', $fields);
        $placeholders = implode(', ', array_map(fn($f) => ":$f", $fields));

        $sql = "INSERT INTO workshop_registrations ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
        $success = $stmt->execute($data);

        if ($success) {
            // Increment participant count
            $stmtUpdate = $this->db->prepare(
                "UPDATE workshops SET current_participants = current_participants + :p WHERE id = :wid"
            );
            $stmtUpdate->execute(['p' => $data['participants'], 'wid' => $data['workshop_id']]);
        }

        return $success ? $this->db->lastInsertId() : false;
    }
}
