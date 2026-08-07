<?php

namespace App\Models;

use Core\BaseModel;

class PairingModel extends BaseModel
{
    protected string $table = 'pairings';

    public function getActivePairings(): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE status = 'active' ORDER BY sort_order ASC, id ASC");
        $results = $stmt->fetchAll();

        foreach ($results as &$item) {
            if (isset($item['menu_items']) && is_string($item['menu_items'])) {
                $item['menu_items'] = json_decode($item['menu_items'], true) ?? [];
            }
        }
        return $results;
    }

    public function findBySlug(string $slug): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE slug = :slug AND status = 'active' LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $result = $stmt->fetch();
        if ($result && isset($result['menu_items']) && is_string($result['menu_items'])) {
            $result['menu_items'] = json_decode($result['menu_items'], true) ?? [];
        }
        return $result ?: null;
    }
}
