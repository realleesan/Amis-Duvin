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

    public function createPairing(array $data): bool|string
    {
        if (!$this->db) return false;

        $slug = $data['slug'] ?? '';
        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['title'] ?? ''), '-'));
        }

        $stmt = $this->db->prepare(
            "INSERT INTO pairings (slug, title, level, subtitle, price, price_text, duration, capacity, image, menu_items, sort_order, status)
             VALUES (:slug, :title, :level, :subtitle, :price, :price_text, :duration, :capacity, :image, :menu_items, :sort_order, 'active')"
        );

        $success = $stmt->execute([
            'slug' => $slug,
            'title' => $data['title'],
            'level' => $data['level'] ?? 'Standard Level',
            'subtitle' => $data['subtitle'] ?? '',
            'price' => $data['price'] ?? 1500000,
            'price_text' => $data['price_text'] ?? 'Từ 1.500.000đ/khách',
            'duration' => $data['duration'] ?? '2.5 giờ',
            'capacity' => $data['capacity'] ?? '8–20 khách',
            'image' => $data['image'] ?? '',
            'menu_items' => is_array($data['menu_items'] ?? null) ? json_encode($data['menu_items'], JSON_UNESCAPED_UNICODE) : ($data['menu_items'] ?? '[]'),
            'sort_order' => (int)($data['sort_order'] ?? 0)
        ]);

        return $success ? $this->db->lastInsertId() : false;
    }

    public function deletePairing(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare("DELETE FROM pairings WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
