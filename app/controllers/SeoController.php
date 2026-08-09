<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\SeoModel;
use App\Models\PairingModel;
use App\Models\WorkshopModel;

class SeoController extends BaseController
{
    public function robots(): void
    {
        header('Content-Type: text/plain; charset=UTF-8');
        echo "User-agent: *\n";
        echo "Allow: /\n";
        echo "Disallow: /admin\n";
        echo "Disallow: /admin/\n";
        echo "\n";
        echo "Sitemap: https://amis.duvin.vn/sitemap.xml\n";
        exit;
    }

    public function sitemap(): void
    {
        header('Content-Type: application/xml; charset=UTF-8');

        $seoModel = new SeoModel();
        $seo = $seoModel->getSeoSettings();
        $baseUrl = rtrim($seo['canonical_url'] ?? 'https://amis.duvin.vn/', '/');

        $pairingModel = new PairingModel();
        $pairings = $pairingModel->getActivePairings();

        $workshopModel = new WorkshopModel();
        $workshops = $workshopModel->getActiveWorkshops();

        $today = date('Y-m-d');

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Homepage
        echo '  <url>' . "\n";
        echo '    <loc>' . htmlspecialchars($baseUrl) . '/</loc>' . "\n";
        echo '    <lastmod>' . $today . '</lastmod>' . "\n";
        echo '    <changefreq>daily</changefreq>' . "\n";
        echo '    <priority>1.0</priority>' . "\n";
        echo '  </url>' . "\n";

        // Under 18 Notice Page
        echo '  <url>' . "\n";
        echo '    <loc>' . htmlspecialchars($baseUrl) . '/under-18</loc>' . "\n";
        echo '    <lastmod>' . $today . '</lastmod>' . "\n";
        echo '    <changefreq>monthly</changefreq>' . "\n";
        echo '    <priority>0.3</priority>' . "\n";
        echo '  </url>' . "\n";

        echo '</urlset>' . "\n";
        exit;
    }
}
