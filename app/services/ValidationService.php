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
            $minAllowedTimestamp = strtotime(date('Y-m-d', strtotime('+5 days')));
            $inputTimestamp = strtotime($date);
            if (!$inputTimestamp || $inputTimestamp < $minAllowedTimestamp) {
                $errors['date'] = 'Theo quy định, ngày đặt tiệc phải cách thời điểm hiện tại tối thiểu 05 ngày (' . date('d/m/Y', $minAllowedTimestamp) . ')';
            }
        }

        $slot = trim($data['slot'] ?? $data['time_slot'] ?? '');
        if (empty($slot)) {
            $errors['slot'] = 'Vui lòng chọn ca phục vụ (Ca 1 hoặc Ca 2)';
        }

        return $errors;
    }
}
