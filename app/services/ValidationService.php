<?php

namespace App\Services;

class ValidationService
{
    public static function validateBooking(array $data): array
    {
        $errors = [];

        $name = trim($data['name'] ?? '');
        if (mb_strlen($name) < 2) {
            $errors['name'] = 'Vui lòng nhập họ tên (tối thiểu 2 ký tự)';
        }

        $phone = trim($data['phone'] ?? '');
        if (!preg_match('/^0\d{9}$/', $phone)) {
            $errors['phone'] = 'Số điện thoại phải đúng 10 số (bắt đầu bằng 0)';
        }

        $email = trim($data['email'] ?? '');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không hợp lệ';
        }

        $participants = (int)($data['participants'] ?? 0);
        if ($participants < 1) {
            $errors['participants'] = 'Tối thiểu 1 người tham gia';
        }

        if (empty($data['date'])) {
            $errors['date'] = 'Vui lòng chọn ngày';
        }

        if (empty($data['slot'])) {
            $errors['slot'] = 'Vui lòng chọn khung giờ';
        }

        return $errors;
    }
}
