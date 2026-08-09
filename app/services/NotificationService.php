<?php

namespace App\Services;

use App\Models\NotificationModel;

class NotificationService
{
    public static function notifyBooking(string $title, string $content, ?string $actionUrl = null, ?array $user = null): bool
    {
        return (new NotificationModel())->createNotification('booking', $title, $content, $actionUrl, $user);
    }

    public static function notifyContent(string $title, string $content, ?string $actionUrl = null, ?array $user = null): bool
    {
        return (new NotificationModel())->createNotification('content', $title, $content, $actionUrl, $user);
    }

    public static function notifyUser(string $title, string $content, ?string $actionUrl = null, ?array $user = null): bool
    {
        return (new NotificationModel())->createNotification('user', $title, $content, $actionUrl, $user);
    }

    public static function notifySystem(string $title, string $content, ?string $actionUrl = null, ?array $user = null): bool
    {
        return (new NotificationModel())->createNotification('system', $title, $content, $actionUrl, $user);
    }
}
