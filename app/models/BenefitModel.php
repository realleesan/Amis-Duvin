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
}
