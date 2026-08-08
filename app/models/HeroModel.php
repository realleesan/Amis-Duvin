<?php

namespace App\Models;

use Core\BaseModel;

class HeroModel extends BaseModel
{
    protected string $table = 'hero_settings';

    public function getHeroSettings(): array
    {
        if (!$this->db) return [];
        $sql = "SELECT * FROM {$this->table} ORDER BY id ASC LIMIT 1";
        $stmt = $this->db->query($sql);
        $res = $stmt->fetch();
        return $res ?: [];
    }
}
