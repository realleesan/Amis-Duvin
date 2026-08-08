<?php

namespace App\Models;

use Core\BaseModel;

class UserModel extends BaseModel
{
    protected string $table = 'users';

    public function findByUsername(string $username): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function findById(int $id): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare("SELECT id, username, full_name, role, created_at FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function updatePassword(int $userId, string $newPassword): bool
    {
        if (!$this->db) return false;
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE {$this->table} SET password_hash = :hash WHERE id = :id");
        return $stmt->execute(['hash' => $hash, 'id' => $userId]);
    }
}
