<?php

namespace App\Models;

use Core\BaseModel;

class AnalyticsModel extends BaseModel
{
    public function recordPageview(string $ip, ?string $userAgent, string $deviceType = 'desktop', string $pagePath = '/'): bool
    {
        if (!$this->db) return false;

        $stmt = $this->db->prepare(
            "INSERT INTO analytics_pageviews (ip_address, user_agent, device_type, page_path)
             VALUES (:ip, :ua, :device, :path)"
        );

        return $stmt->execute([
            'ip' => substr($ip, 0, 45),
            'ua' => $userAgent ? substr($userAgent, 0, 255) : null,
            'device' => in_array($deviceType, ['desktop', 'mobile', 'tablet'], true) ? $deviceType : 'desktop',
            'path' => substr($pagePath, 0, 255)
        ]);
    }

    public function recordClick(string $elementKey, string $elementLabel, string $pagePath = '/'): bool
    {
        if (!$this->db) return false;

        $stmt = $this->db->prepare(
            "INSERT INTO analytics_clicks (element_key, element_label, page_path)
             VALUES (:key, :label, :path)"
        );

        return $stmt->execute([
            'key' => substr($elementKey, 0, 100),
            'label' => substr($elementLabel, 0, 255),
            'path' => substr($pagePath, 0, 255)
        ]);
    }

    public function getPageviewSummary(): array
    {
        if (!$this->db) {
            return ['today' => 0, 'week' => 0, 'month' => 0, 'year' => 0, 'total' => 0];
        }

        $today = (int)$this->db->query("SELECT COUNT(*) FROM analytics_pageviews WHERE DATE(viewed_at) = CURRENT_DATE()")->fetchColumn();
        $week = (int)$this->db->query("SELECT COUNT(*) FROM analytics_pageviews WHERE YEARWEEK(viewed_at, 1) = YEARWEEK(CURRENT_DATE(), 1)")->fetchColumn();
        $month = (int)$this->db->query("SELECT COUNT(*) FROM analytics_pageviews WHERE YEAR(viewed_at) = YEAR(CURRENT_DATE()) AND MONTH(viewed_at) = MONTH(CURRENT_DATE())")->fetchColumn();
        $year = (int)$this->db->query("SELECT COUNT(*) FROM analytics_pageviews WHERE YEAR(viewed_at) = YEAR(CURRENT_DATE())")->fetchColumn();
        $total = (int)$this->db->query("SELECT COUNT(*) FROM analytics_pageviews")->fetchColumn();

        return [
            'today' => $today,
            'week'  => $week,
            'month' => $month,
            'year'  => $year,
            'total' => $total
        ];
    }

    public function getDailyTrend(int $days = 7): array
    {
        if (!$this->db) return [];

        $stmt = $this->db->prepare(
            "SELECT DATE(viewed_at) as view_date, COUNT(*) as total_views, COUNT(DISTINCT ip_address) as unique_ips
             FROM analytics_pageviews
             WHERE viewed_at >= DATE_SUB(CURRENT_DATE(), INTERVAL :days DAY)
             GROUP BY DATE(viewed_at)
             ORDER BY view_date ASC"
        );
        $stmt->bindValue(':days', $days - 1, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTopClickedElements(int $limit = 10): array
    {
        if (!$this->db) return [];

        $stmt = $this->db->prepare(
            "SELECT element_key, element_label, COUNT(*) as click_count, MAX(clicked_at) as last_clicked
             FROM analytics_clicks
             GROUP BY element_key, element_label
             ORDER BY click_count DESC, last_clicked DESC
             LIMIT :limit"
        );
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
