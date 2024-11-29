<?php

namespace App\Validation;

use App\Helpers\NotificationHelper;

class ContactValidation
{
    public static function contact(): bool
    {
        $is_valid = true;
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Vui lòng không để trống tên');
            $is_valid = false;
        }
        if (!isset($_POST['ho']) || $_POST['ho'] === '') {
            NotificationHelper::error('ho', 'Vui lòng không để trống họ ');
            $is_valid = false;
        }
        if (!isset($_POST['email']) || $_POST['email'] === '') {
            NotificationHelper::error('email', 'Vui lòng nhập email ');
            $is_valid = false;
        }
        if (!isset($_POST['phone']) || $_POST['phone'] === '') {
            NotificationHelper::error('phone', 'Vui lòng nhập số điện thoại ');
            $is_valid = false;
        }
        if (!isset($_POST['message']) || $_POST['message'] === '') {
            NotificationHelper::error('message', 'Vui lòng nhập thông tin ');
            $is_valid = false;
        }

        return $is_valid;
    }
}
