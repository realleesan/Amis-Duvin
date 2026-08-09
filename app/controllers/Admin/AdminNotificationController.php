<?php

namespace App\Controllers\Admin;

use Core\BaseController;
use App\Services\AuthService;
use App\Models\NotificationModel;

class AdminNotificationController extends BaseController
{
    public function index(): void
    {
        AuthService::requireAuth();

        $typeFilter = $_GET['type'] ?? '';
        $statusFilter = $_GET['status'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $limit = 15;
        $offset = ($page - 1) * $limit;

        $notifModel = new NotificationModel();
        $notifications = $notifModel->getFilteredNotifications($typeFilter, $statusFilter, $limit, $offset);
        $totalItems = $notifModel->getTotalCount($typeFilter, $statusFilter);
        $totalPages = max(1, (int)ceil($totalItems / $limit));

        $user = AuthService::user();
        $unreadCount = $notifModel->getUnreadCount();

        require __DIR__ . '/../../views/admin/notifications/index.php';
    }

    public function getUnreadApi(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        if (!AuthService::check()) {
            echo json_encode(['success' => false, 'unread_count' => 0, 'items' => []]);
            exit;
        }

        $notifModel = new NotificationModel();
        $items = $notifModel->getRecentNotifications(7);
        $unreadCount = $notifModel->getUnreadCount();

        echo json_encode([
            'success' => true,
            'unread_count' => $unreadCount,
            'items' => $items
        ]);
        exit;
    }

    public function markAsReadApi(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        if (!AuthService::check()) {
            echo json_encode(['success' => false]);
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        $notifModel = new NotificationModel();
        $res = $notifModel->markAsRead($id);

        echo json_encode(['success' => $res, 'unread_count' => $notifModel->getUnreadCount()]);
        exit;
    }

    public function markAllAsReadApi(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        if (!AuthService::check()) {
            echo json_encode(['success' => false]);
            exit;
        }

        $notifModel = new NotificationModel();
        $res = $notifModel->markAllAsRead();

        echo json_encode(['success' => $res, 'unread_count' => 0]);
        exit;
    }
}
