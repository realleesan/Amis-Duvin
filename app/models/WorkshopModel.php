<?php

namespace App\Models;

use Core\BaseModel;

class WorkshopModel extends BaseModel
{
    protected string $table = 'workshops';

    public function getActiveWorkshops(): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->query("SELECT * FROM workshops WHERE status != 'inactive' ORDER BY id ASC");
        return $stmt->fetchAll();
    }

    public function getAllWorkshops(): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->query("SELECT * FROM workshops ORDER BY id ASC");
        return $stmt->fetchAll() ?: [];
    }

    public function getFeaturedWorkshops(): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->query("SELECT * FROM workshops WHERE is_featured = 1 AND status != 'inactive' ORDER BY id ASC");
        return $stmt->fetchAll();
    }

    public function getTopicWorkshops(): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->query("SELECT * FROM workshops WHERE is_featured = 0 AND status != 'inactive' ORDER BY id ASC");
        return $stmt->fetchAll();
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
