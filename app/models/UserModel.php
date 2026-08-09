<?php

namespace App\Models;

use Core\BaseModel;

class UserModel extends BaseModel
{
    protected string $table = 'users';

    public function findByUsername(string $username): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = :username AND deleted_at IS NULL LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function findById(int $id, bool $includeDeleted = false): ?array
    {
        if (!$this->db) return null;
        $sql = "SELECT id, username, full_name, role, created_at FROM {$this->table} WHERE id = :id";
        if (!$includeDeleted) {
            $sql .= " AND deleted_at IS NULL";
        }
        $sql .= " LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function getAllUsers(): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->query("SELECT id, username, full_name, role, created_at FROM {$this->table} WHERE deleted_at IS NULL ORDER BY id ASC");
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
        $stmt = $this->db->prepare("UPDATE {$this->table} SET full_name = :full_name, role = :role WHERE id = :id AND deleted_at IS NULL");
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
        $stmt = $this->db->prepare("UPDATE {$this->table} SET password_hash = :hash WHERE id = :id AND deleted_at IS NULL");
        return $stmt->execute(['hash' => $hash, 'id' => $userId]);
    }

    public function softDelete(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare("UPDATE {$this->table} SET deleted_at = NOW() WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function restore(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare("UPDATE {$this->table} SET deleted_at = NULL WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function hardDelete(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getTrashUsers(): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->query("SELECT id, username, full_name, role, created_at, deleted_at FROM {$this->table} WHERE deleted_at IS NOT NULL ORDER BY deleted_at DESC");
        return $stmt->fetchAll() ?: [];
    }

    public function getTrashCount(): int
    {
        if (!$this->db) return 0;
        $stmt = $this->db->query("SELECT COUNT(*) FROM {$this->table} WHERE deleted_at IS NOT NULL");
        return (int)$stmt->fetchColumn();
    }
}
