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

    public function getWorkshopById(int $id): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare("SELECT * FROM workshops WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
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
            // Increment participant count & update status if full
            $stmtUpdate = $this->db->prepare(
                "UPDATE workshops SET current_participants = current_participants + :p WHERE id = :wid"
            );
            $stmtUpdate->execute(['p' => $data['participants'], 'wid' => $data['workshop_id']]);

            // Auto status check
            $ws = $this->getWorkshopById((int)$data['workshop_id']);
            if ($ws && $ws['current_participants'] >= $ws['max_participants'] && $ws['status'] === 'active') {
                $this->db->prepare("UPDATE workshops SET status = 'full' WHERE id = :wid")->execute(['wid' => $data['workshop_id']]);
            }
        }

        return $success ? $this->db->lastInsertId() : false;
    }

    public function getAllRegistrations(string $statusFilter = '', string $workshopFilter = ''): array
    {
        if (!$this->db) return [];

        $where = [];
        $params = [];

        if ($statusFilter !== '') {
            $where[] = "r.status = :status";
            $params['status'] = $statusFilter;
        }

        if ($workshopFilter !== '') {
            $where[] = "r.workshop_id = :wid";
            $params['wid'] = (int)$workshopFilter;
        }

        $whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

        $sql = "SELECT r.*, w.title as workshop_title, w.price as workshop_price
                FROM workshop_registrations r
                LEFT JOIN workshops w ON r.workshop_id = w.id
                {$whereClause}
                ORDER BY r.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getRegistrationById(int $id): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare(
            "SELECT r.*, w.title as workshop_title
             FROM workshop_registrations r
             LEFT JOIN workshops w ON r.workshop_id = w.id
             WHERE r.id = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function updateRegistrationStatus(int $id, string $status, ?string $notes = null): bool
    {
        if (!$this->db) return false;

        $params = ['id' => $id, 'status' => $status];
        $setNotes = '';
        if ($notes !== null) {
            $setNotes = ', notes = :notes';
            $params['notes'] = $notes;
        }

        $stmt = $this->db->prepare("UPDATE workshop_registrations SET status = :status {$setNotes} WHERE id = :id");
        return $stmt->execute($params);
    }

    public function createWorkshopPackage(array $data): bool|string
    {
        if (!$this->db) return false;

        $stmt = $this->db->prepare(
            "INSERT INTO workshops (slug, title, level, price, duration, schedule, location, max_participants, current_participants, wines_count, image, description, status, is_featured)
             VALUES (:slug, :title, :level, :price, :duration, :schedule, :location, :max_participants, 0, :wines_count, :image, :description, :status, :is_featured)"
        );

        $success = $stmt->execute([
            'slug' => $data['slug'],
            'title' => $data['title'],
            'level' => $data['level'] ?? 'Standard Level',
            'price' => $data['price'],
            'duration' => $data['duration'] ?? '2 giờ',
            'schedule' => $data['schedule'],
            'location' => $data['location'],
            'max_participants' => $data['max_participants'] ?? 12,
            'wines_count' => $data['wines_count'] ?? 5,
            'image' => $data['image'] ?? '',
            'description' => $data['description'] ?? '',
            'status' => $data['status'] ?? 'active',
            'is_featured' => $data['is_featured'] ?? 0
        ]);

        return $success ? $this->db->lastInsertId() : false;
    }

    public function updateWorkshopPackage(int $id, array $data): bool
    {
        if (!$this->db) return false;

        $stmt = $this->db->prepare(
            "UPDATE workshops
             SET title = :title, level = :level, price = :price, duration = :duration,
                 schedule = :schedule, location = :location, max_participants = :max_participants,
                 wines_count = :wines_count, image = :image, description = :description,
                 status = :status, is_featured = :is_featured
             WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'level' => $data['level'],
            'price' => $data['price'],
            'duration' => $data['duration'],
            'schedule' => $data['schedule'],
            'location' => $data['location'],
            'max_participants' => $data['max_participants'],
            'wines_count' => $data['wines_count'],
            'image' => $data['image'],
            'description' => $data['description'],
            'status' => $data['status'],
            'is_featured' => $data['is_featured']
        ]);
    }
}
