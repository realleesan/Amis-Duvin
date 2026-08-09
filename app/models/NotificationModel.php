<?php

namespace App\Models;

use Core\BaseModel;

class NotificationModel extends BaseModel
{
    protected string $table = 'notifications';

    public function createNotification(string $type, string $title, string $content, ?string $actionUrl = null, ?array $user = null): bool
    {
        if (!$this->db) return false;

        $userId = $user['id'] ?? null;
        $userName = $user['full_name'] ?? ($user['username'] ?? 'Hệ thống');

        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (user_id, user_name, type, title, content, action_url)
             VALUES (:user_id, :user_name, :type, :title, :content, :action_url)"
        );

        return $stmt->execute([
            'user_id' => $userId,
            'user_name' => $userName,
            'type' => $type,
            'title' => $title,
            'content' => $content,
            'action_url' => $actionUrl
        ]);
    }

    public function getRecentNotifications(int $limit = 10): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY id DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUnreadCount(): int
    {
        if (!$this->db) return 0;
        $stmt = $this->db->query("SELECT COUNT(*) FROM {$this->table} WHERE is_read = 0");
        return (int)$stmt->fetchColumn();
    }

    public function markAsRead(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare("UPDATE {$this->table} SET is_read = 1 WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function markAllAsRead(): bool
    {
        if (!$this->db) return false;
        return (bool)$this->db->exec("UPDATE {$this->table} SET is_read = 1 WHERE is_read = 0");
    }

    public function getFilteredNotifications(string $type = '', string $readStatus = '', int $limit = 20, int $offset = 0): array
    {
        if (!$this->db) return [];

        $where = [];
        $params = [];

        if ($type !== '') {
            $where[] = "type = :type";
            $params['type'] = $type;
        }

        if ($readStatus === 'unread') {
            $where[] = "is_read = 0";
        } elseif ($readStatus === 'read') {
            $where[] = "is_read = 1";
        }

        $whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

        $stmt = $this->db->prepare("SELECT * FROM {$this->table} {$whereClause} ORDER BY id DESC LIMIT :limit OFFSET :offset");
        foreach ($params as $k => $v) {
            $stmt->bindValue(":{$k}", $v);
        }
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getTotalCount(string $type = '', string $readStatus = ''): int
    {
        if (!$this->db) return 0;

        $where = [];
        $params = [];

        if ($type !== '') {
            $where[] = "type = :type";
            $params['type'] = $type;
        }

        if ($readStatus === 'unread') {
            $where[] = "is_read = 0";
        } elseif ($readStatus === 'read') {
            $where[] = "is_read = 1";
        }

        $whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} {$whereClause}");
        $stmt->execute($params);
        return (int)$stmt->fetchColumn();
    }
}
