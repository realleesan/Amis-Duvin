<?php

namespace App\Models;

use Core\BaseModel;

class FaqModel extends BaseModel
{
    protected string $table = 'faqs';

    public function getActiveFaqs(): array
    {
        if (!$this->db) return [];
        $sql = "SELECT * FROM {$this->table}
                WHERE status = 'active'
                ORDER BY sort_order ASC, id ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}
