<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\AnalyticsModel;

class AnalyticsController extends BaseController
{
    public function trackPageview(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $pagePath = trim($_POST['path'] ?? '/');

        $deviceType = 'desktop';
        if (preg_match('/(android|bb\d+|meego).+mobile|avail|blackberry|iemobile|mobi|opera mini|phone|tablet|ipad/i', $userAgent)) {
            $deviceType = preg_match('/tablet|ipad/i', $userAgent) ? 'tablet' : 'mobile';
        }

        $model = new AnalyticsModel();
        $res = $model->recordPageview($ip, $userAgent, $deviceType, $pagePath);

        echo json_encode(['success' => $res]);
        exit;
    }

    public function trackClick(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $elementKey = trim($_POST['element_key'] ?? '');
        $elementLabel = trim($_POST['element_label'] ?? '');
        $pagePath = trim($_POST['path'] ?? '/');

        if (empty($elementKey) || empty($elementLabel)) {
            echo json_encode(['success' => false, 'message' => 'Missing parameters']);
            exit;
        }

        $model = new AnalyticsModel();
        $res = $model->recordClick($elementKey, $elementLabel, $pagePath);

        echo json_encode(['success' => $res]);
        exit;
    }
}
