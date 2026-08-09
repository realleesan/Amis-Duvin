<?php

namespace App\Models;

use Core\BaseModel;

class SeoModel extends BaseModel
{
    protected string $table = 'seo_settings';

    public function getSeoSettings(): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = 1 LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch();

        if ($res) {
            return $res;
        }

        return [
            'id' => 1,
            'meta_title' => 'Amis du Vin — Không gian Tiệc riêng tư & Tinh hoa ẩm thực Rượu vang',
            'meta_description' => 'Amis du Vin — Không gian Tiệc riêng tư & Tinh hoa ẩm thực Rượu vang tại Hà Nội. Trải nghiệm Food & Wine Pairing và Workshop rượu vang tinh tế.',
            'meta_keywords' => 'Amis du Vin, Rượu vang Hà Nội, Tiệc riêng tư, Food and Wine Pairing, Sommelier Alex Thịnh, Workshop rượu vang',
            'og_image' => 'https://media.base44.com/images/public/6a623336361c483b3f15558c/1d3f75363_generated_b7d85214.png/v1/fill/w_1171,h_927,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/1d3f75363_generated_b7d85214.webp',
            'canonical_url' => 'https://amis.duvin.vn/'
        ];
    }

    public function updateSeoSettings(string $metaTitle, string $metaDescription, string $metaKeywords, string $ogImage, string $canonicalUrl): bool
    {
        $sql = "INSERT INTO {$this->table} (id, meta_title, meta_description, meta_keywords, og_image, canonical_url)
                VALUES (1, :meta_title, :meta_description, :meta_keywords, :og_image, :canonical_url)
                ON DUPLICATE KEY UPDATE 
                meta_title = VALUES(meta_title),
                meta_description = VALUES(meta_description),
                meta_keywords = VALUES(meta_keywords),
                og_image = VALUES(og_image),
                canonical_url = VALUES(canonical_url)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'meta_title' => $metaTitle,
            'meta_description' => $metaDescription,
            'meta_keywords' => $metaKeywords,
            'og_image' => $ogImage,
            'canonical_url' => $canonicalUrl
        ]);
    }
}
