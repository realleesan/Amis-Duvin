<?php

namespace App\Services;

class ValidationService
{
    public static function validateBooking(array $data): array
    {
        $errors = [];

        $name = trim($data['name'] ?? $data['full_name'] ?? '');
        if (mb_strlen($name) < 2) {
            $errors['name'] = 'Vui lòng nhập họ tên (tối thiểu 2 ký tự)';
        }

        $phone = trim($data['phone'] ?? '');
        if (!preg_match('/^0\d{9}$/', $phone)) {
            $errors['phone'] = 'Số điện thoại phải đúng 10 số tại Việt Nam (bắt đầu bằng số 0)';
        }

        $email = trim($data['email'] ?? '');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Địa chỉ Email không hợp lệ';
        }

        $participants = (int)($data['participants'] ?? 0);
        if ($participants < 1) {
            $errors['participants'] = 'Số lượng người tham gia tối thiểu là 1 người';
        } elseif ($participants > 24) {
            $errors['participants'] = 'Số lượng khách mỗi ca không vượt quá 24 người';
        }

        $date = trim($data['date'] ?? $data['booking_date'] ?? '');
        if (empty($date)) {
            $errors['date'] = 'Vui lòng chọn ngày đặt tiệc';
        } else {
            $dateStr = $date;
            if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $date, $m)) {
                $dateStr = sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
            }

            $minAdvanceDays = 5;
            $minAllowedTimestamp = strtotime("+{$minAdvanceDays} days 00:00:00");
            $inputTimestamp = strtotime($dateStr);

            if (!$inputTimestamp || $inputTimestamp < $minAllowedTimestamp) {
                $errors['date'] = "Theo quy định, Quý khách cần đặt tiệc trước ít nhất {$minAdvanceDays} ngày (từ ngày " . date('d/m/Y', $minAllowedTimestamp) . " trở đi).";
            }
        }

        $slot = trim($data['slot'] ?? $data['time_slot'] ?? '');
        if (empty($slot)) {
            $errors['slot'] = 'Vui lòng chọn ca phục vụ (Ca 1 hoặc Ca 2)';
        }

        return $errors;
    }
}
