<?php

namespace App\Models;

use Core\BaseModel;

class TestimonialModel extends BaseModel
{
    protected string $table = 'testimonials';

    public function getActiveTestimonials(): array
    {
        if (!$this->db) return [];
        $sql = "SELECT t.*, p.title AS pairing_title, p.slug AS pairing_slug 
                FROM {$this->table} t
                LEFT JOIN pairings p ON t.pairing_id = p.id
                WHERE t.status = 'active'
                ORDER BY t.sort_order ASC, t.id ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}
