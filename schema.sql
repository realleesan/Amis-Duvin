-- Schema CSDL MySQL cho Amis du Vin

CREATE DATABASE IF NOT EXISTS `amisduvin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `amisduvin`;

-- Bảng lưu Đơn đặt tiệc riêng
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `participants` INT NOT NULL DEFAULT 1,
  `booking_date` DATE NOT NULL,
  `time_slot` VARCHAR(50) NOT NULL,
  `notes` TEXT NULL,
  `status` ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng lưu danh sách Food & Wine Pairing
CREATE TABLE IF NOT EXISTS `pairings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `title` VARCHAR(255) NOT NULL,
  `level` VARCHAR(50) NOT NULL,
  `subtitle` TEXT NOT NULL,
  `price` DECIMAL(12, 2) NOT NULL,
  `price_text` VARCHAR(100) NOT NULL,
  `duration` VARCHAR(50) NOT NULL,
  `capacity` VARCHAR(50) NOT NULL,
  `image` VARCHAR(500) NOT NULL,
  `menu_items` JSON NOT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng lưu Đánh giá từ Khách hàng
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `pairing_id` INT NULL,
  `name` VARCHAR(100) NOT NULL,
  `avatar` VARCHAR(500) NULL,
  `avatar_initials` VARCHAR(10) NULL,
  `role` VARCHAR(100) NOT NULL,
  `package_tag` VARCHAR(100) NOT NULL,
  `rating` INT NOT NULL DEFAULT 5,
  `content` TEXT NOT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_testimonials_pairing` FOREIGN KEY (`pairing_id`) REFERENCES `pairings`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng lưu danh sách Workshops
CREATE TABLE IF NOT EXISTS `workshops` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `title` VARCHAR(255) NOT NULL,
  `level` VARCHAR(50) NOT NULL,
  `price` DECIMAL(12, 2) NOT NULL,
  `duration` VARCHAR(50) NOT NULL,
  `schedule` VARCHAR(100) NOT NULL,
  `location` VARCHAR(255) NOT NULL,
  `max_participants` INT NOT NULL DEFAULT 12,
  `current_participants` INT NOT NULL DEFAULT 0,
  `wines_count` INT NOT NULL DEFAULT 5,
  `image` VARCHAR(500) NULL,
  `description` TEXT NULL,
  `status` ENUM('active', 'inactive', 'full') DEFAULT 'active',
  `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng lưu Đăng ký tham gia Workshop
CREATE TABLE IF NOT EXISTS `workshop_registrations` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `workshop_id` INT NOT NULL,
  `full_name` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `participants` INT NOT NULL DEFAULT 1,
  `notes` TEXT NULL,
  `status` ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`workshop_id`) REFERENCES `workshops`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed dữ liệu mẫu cho Pairings
INSERT INTO `pairings` (`slug`, `title`, `level`, `subtitle`, `price`, `price_text`, `duration`, `capacity`, `image`, `menu_items`, `sort_order`) VALUES
('signature-pairing', 'Signature Pairing', 'Standard Level', 'Sự kết hợp kinh điển giữa rượu vang và các món ngon đặc trưng, mở đầu hành trình thưởng thức tinh tế.', 1500000.00, 'Từ 1.500.000đ/khách', '2.5 giờ', '8–20 khách', 'https://media.base44.com/images/public/6a623336361c483b3f15558c/e6d25f6b5_generated_78290a91.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/e6d25f6b5_generated_78290a91.webp', '[{"course":"Khởi vị — Carpaccio bò, parmigiano","wine":"Pinot Noir"},{"course":"Món chính — Ngừ sốt tiêu, bơ thảo mộc","wine":"Cabernet Sauvignon"},{"course":"Tráng miệng — Tart chocolate đen","wine":"Port Tawny"}]', 1),
('gourmet-selection', 'Gourmet Selection', 'Standard Level', 'Bộ sưu tập món cao cấp được thiết kế riêng, kết hợp hoàn hảo cùng những dòng vang thượng hạng.', 2000000.00, 'Từ 2.000.000đ/khách', '3 giờ', '8–20 khách', 'https://media.base44.com/images/public/6a623336361c483b3f15558c/4f229480d_generated_ffd34238.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/4f229480d_generated_ffd34238.webp', '[{"course":"Khởi vị — Sashimi cá hồi Na Uy","wine":"Chardonnay"},{"course":"Món chính — Bò bít tết Wagyu","wine":"Malbec"},{"course":"Tráng miệng — Crème brûlée vani","wine":"Sauternes"}]', 2),
('private-cellar', 'Private Cellar', 'Premium Level', 'Trải nghiệm thử rượu độc quyền trong hầm rượu riêng, dành cho những người sành vang đích thực.', 3500000.00, 'Từ 3.500.000đ/khách', '3.5 giờ', '6–12 khách', 'https://media.base44.com/images/public/6a623336361c483b3f15558c/0a280a9c0_generated_bbd5d622.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/0a280a9c0_generated_bbd5d622.webp', '[{"course":"Nếm thử 5 dòng vang hầm riêng","wine":"Vertical Tasting"},{"course":"Phô mai nhập khẩu & pâté","wine":"Bordeaux Grand Cru"},{"course":"Món chính — Thỏ nấu rượu vang","wine":"Burgundy Pinot"}]', 3),
('amis-du-vin-gala-night', 'Amis du Vin Gala Night', 'Premium Level', 'Đêm tiệc thượng lưu tráng lệ với thực đơn Sommelier thiết kế, không gian riêng tư đẳng cấp.', 5000000.00, 'Từ 5.000.000đ/khách', '4 giờ', '15–40 khách', 'https://media.base44.com/images/public/6a623336361c483b3f15558c/af384a896_generated_47deb67b.png/v1/fill/w_535,h_402,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/af384a896_generated_47deb67b.webp', '[{"course":"Aperitif & lộ trình vang 7 món","wine":"Champagne"},{"course":"Món chính — Cừu nướng thảo mộc","wine":"Barolo Riserva"},{"course":"Tráng miệng — Soufflé chocolate","wine":"Tokaji Aszú"}]', 4);

-- Seed dữ liệu mẫu cho Testimonials
INSERT INTO `testimonials` (`pairing_id`, `name`, `avatar`, `avatar_initials`, `role`, `package_tag`, `rating`, `content`, `sort_order`) VALUES
(1, 'Anh Trần Tuấn Minh', 'https://media.base44.com/images/public/6a623336361c483b3f15558c/0c749a039_generated_image.png/v1/fill/w_56,h_56,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/0c749a039_generated_image.webp', NULL, 'CEO · Công ty Đầu tư', 'Gói Signature Pairing', 5, 'Bữa tiệc hoàn hảo đến từng chi tiết. Sommelier Alex Thịnh kể chuyện vang cuốn hút, khách hàng đối tác của tôi rất ấn tượng.', 1),
(2, 'Chị Lê Hoàng Yến', 'https://media.base44.com/images/public/6a623336361c483b3f15558c/054117747_generated_image.png/v1/fill/w_56,h_56,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/054117747_generated_image.webp', NULL, 'Giám đốc Marketing', 'Gói Gourmet Selection', 5, 'Không gian nhỏ, riêng tư, ấm cúng. Pairing rượu và món ăn tinh tế — một trải nghiệm văn hoá đúng nghĩa.', 2),
(NULL, 'Anh Phạm Đức Anh', NULL, 'ĐA', 'Doanh nhân', 'Workshop Wine & Food Romance', 5, 'Tôi không rành vang nhưng được hướng dẫn rất gần gũi. Ra về tự tin chọn vang cho bữa tiệc gia đình.', 3),
(3, 'Chị Vũ Thu Hà', NULL, 'TH', 'Chủ Spa cao cấp', 'Gói Private Cellar', 5, 'Dịch vụ chu đáo, khách hàng VIP của tôi đều hài lòng. Sẽ quay lại cho các dịp kỷ niệm quan trọng.', 4),
(4, 'Anh Nguyễn Quốc Bảo', 'https://media.base44.com/images/public/6a623336361c483b3f15558c/c14ed7531_generated_image.png/v1/fill/w_56,h_56,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/c14ed7531_generated_image.webp', NULL, 'Nhà đầu tư', 'Amis du Vin Gala Night', 5, 'Đẳng cấp và tinh tế. Đêm Gala thật sự vượt mong đợi — điểm đến xứng đáng cho giới doanh nhân.', 5);

-- Seed dữ liệu mẫu cho Workshops
INSERT INTO `workshops` (`id`, `slug`, `title`, `level`, `price`, `duration`, `schedule`, `location`, `max_participants`, `current_participants`, `wines_count`, `image`, `status`, `is_featured`) VALUES
(1, 'the-first-sip', 'The First Sip', 'Cơ bản', 1000000.00, '2.0 giờ', 'Thứ 6, 14/08/2026 · 10h – 12h', 'Amis du Vin Cellar — Q.3, TP.HCM', 12, 9, 5, 'https://media.base44.com/images/public/6a623336361c483b3f15558c/2ff99e699_image.png/v1/fill/w_370,h_458,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/2ff99e699_image.webp', 'active', 1),
(2, 'the-art-of-taste', 'The Art of Taste', 'Nâng cao', 1200000.00, '2.0 giờ', '28/08/2026 · 19h – 21h', 'Amis du Vin Cellar — Q.3, TP.HCM', 12, 7, 5, 'https://media.base44.com/images/public/6a623336361c483b3f15558c/ef11c3040_image.png/v1/fill/w_370,h_458,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/ef11c3040_image.webp', 'active', 1),
(3, 'wine-food-romance', 'Wine & Food Romance', 'Chuyên đề', 1500000.00, '2.0 giờ', '11/09/2026 · 19h – 21h', 'Amis du Vin Cellar — Q.3, TP.HCM', 12, 10, 5, 'https://media.base44.com/images/public/6a623336361c483b3f15558c/ff4488a83_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/ff4488a83_image.webp', 'active', 0),
(4, 'around-the-wine-world', 'Around the Wine World', 'Khám phá', 1800000.00, '2.0 giờ', '25/09/2026 · 19h – 21h', 'Amis du Vin Cellar — Q.3, TP.HCM', 12, 12, 6, 'https://media.base44.com/images/public/6a623336361c483b3f15558c/4e47aee24_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/4e47aee24_image.webp', 'full', 0),
(5, 'wine-art', 'Wine & Art', 'Cảm nhận', 1000000.00, '2.0 giờ', '09/10/2026 · 19h – 21h', 'Amis du Vin Cellar — Q.3, TP.HCM', 12, 6, 5, 'https://media.base44.com/images/public/6a623336361c483b3f15558c/0d495c825_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/0d495c825_image.webp', 'active', 0),
(6, 'wine-business', 'Wine & Business', 'Ngoại giao', 2000000.00, '2.0 giờ', '23/10/2026 · 19h – 21h', 'Amis du Vin Cellar — Q.3, TP.HCM', 12, 11, 6, 'https://media.base44.com/images/public/6a623336361c483b3f15558c/2a054bd36_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/2a054bd36_image.webp', 'active', 0),
(7, 'wine-fine-living', 'Wine & Fine Living', 'Thưởng thức', 1500000.00, '2.0 giờ', '06/11/2026 · 19h – 21h', 'Amis du Vin Cellar — Q.3, TP.HCM', 12, 2, 5, 'https://media.base44.com/images/public/6a623336361c483b3f15558c/2a054bd36_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/2a054bd36_image.webp', 'active', 0),
(8, 'amis-du-vin-gala', 'Amis du Vin Gala', 'Thượng lưu', 2000000.00, '4.0 giờ', '20/11/2026 · 18h – 22h', 'Amis du Vin Cellar — Q.3, TP.HCM', 20, 5, 7, 'https://media.base44.com/images/public/6a623336361c483b3f15558c/f807fd6b1_image.png/v1/fill/w_298,h_160,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/f807fd6b1_image.webp', 'active', 0);
