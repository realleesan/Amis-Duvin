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
  `image` VARCHAR(255) NULL,
  `status` ENUM('active', 'inactive', 'full') DEFAULT 'active',
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

-- Seed dữ liệu mẫu cho Workshops
INSERT INTO `workshops` (`slug`, `title`, `level`, `price`, `duration`, `schedule`, `location`, `max_participants`, `current_participants`, `wines_count`, `image`) VALUES
('nhap-mon-nếm-thử-vang', 'Nhập môn Nếm thử Vang', 'Cơ bản', 1200000.00, '2.5 giờ', 'Thứ 7 hàng tuần, 15:00 - 17:30', 'Amis du Vin Cellar — Q.3, TP.HCM', 12, 8, 5, '/assets/images/workshop-1.jpg'),
('chieu-sau-vang-bordeaux', 'Chiều sâu Vang Bordeaux & Burgundy', 'Nâng cao', 2500000.00, '3.0 giờ', 'Chủ nhật cuối tháng, 18:00 - 21:00', 'Amis du Vin Private Room — Q.1, TP.HCM', 8, 5, 6, '/assets/images/workshop-2.jpg'),
('nghe-thuat-pairing', 'Nghệ thuật Phối vị Wine & Cheese', 'Chuyên đề', 1800000.00, '2.5 giờ', 'Thứ 6 hai tuần/lần, 18:30 - 21:00', 'Amis du Vin Cellar — Q.3, TP.HCM', 10, 6, 5, '/assets/images/workshop-3.jpg');
