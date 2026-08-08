<?php

namespace App\Models;

use Core\BaseModel;

class ServiceIntroModel extends BaseModel
{
    protected string $table = 'service_intro_settings';

    public function getServiceIntroSettings(): array
    {
        if (!$this->db) return [];
        $sql = "SELECT * FROM {$this->table} ORDER BY id ASC LIMIT 1";
        $stmt = $this->db->query($sql);
        $res = $stmt->fetch();
        return $res ?: [];
    }
}
