<?php

namespace App\Models;

use Core\BaseModel;

class BenefitModel extends BaseModel
{
    protected string $table = 'benefits';

    public function getActiveBenefits(): array
    {
        if (!$this->db) return [];
        $sql = "SELECT * FROM {$this->table}
                WHERE status = 'active'
                ORDER BY sort_order ASC, id ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function createBenefit(array $data): bool|string
    {
        if (!$this->db) return false;
        $defaultIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-6 h-6"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>';

        $stmt = $this->db->prepare(
            "INSERT INTO benefits (title, description, icon_svg, sort_order, status)
             VALUES (:title, :description, :icon_svg, :sort_order, 'active')"
        );

        $success = $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'icon_svg' => $data['icon_svg'] ?? $defaultIcon,
            'sort_order' => (int)($data['sort_order'] ?? 0)
        ]);

        return $success ? $this->db->lastInsertId() : false;
    }

    public function deleteBenefit(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare("DELETE FROM benefits WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
