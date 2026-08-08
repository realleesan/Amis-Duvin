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

    public function getAllUsers(): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->query("SELECT id, username, full_name, role, created_at FROM {$this->table} ORDER BY id ASC");
        return $stmt->fetchAll() ?: [];
    }

    public function createUser(string $username, string $password, string $fullName, string $role): bool
    {
        if (!$this->db) return false;
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (username, password_hash, full_name, role) VALUES (:username, :hash, :full_name, :role)");
        return $stmt->execute([
            'username' => $username,
            'hash' => $hash,
            'full_name' => $fullName,
            'role' => $role
        ]);
    }

    public function updateUser(int $id, string $fullName, string $role): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare("UPDATE {$this->table} SET full_name = :full_name, role = :role WHERE id = :id");
        return $stmt->execute([
            'full_name' => $fullName,
            'role' => $role,
            'id' => $id
        ]);
    }

    public function updatePassword(int $userId, string $newPassword): bool
    {
        if (!$this->db) return false;
        $hash = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("UPDATE {$this->table} SET password_hash = :hash WHERE id = :id");
        return $stmt->execute(['hash' => $hash, 'id' => $userId]);
    }
}
