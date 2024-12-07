<?php

namespace App\Validation;

use App\Helpers\NotificationHelper;

class CartValidation
{
public static function order(): bool
{
    $is_valid = true;
    $errors = [];

    if (!isset($_POST['name']) || $_POST['name'] === '') {
        $errors['name'] = "Tên người nhận không được để trống.";
        $is_valid = false;
    }

    if (!isset($_POST['phone']) || $_POST['phone'] === '') {
        $errors['phone'] = "Số điện thoại không được để trống.";
        $is_valid = false;
    }

    if (!isset($_POST['email']) || $_POST['email'] === '') {
        $errors['email'] = "Địa chỉ email không được để trống.";
        $is_valid = false;
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Địa chỉ email không hợp lệ.";
        $is_valid = false;
    }

    if (!isset($_POST['address']) || $_POST['address'] === '') {
        $errors['address'] = "Địa chỉ không được để trống.";
        $is_valid = false;
    }



    if (!$is_valid) {
        $_SESSION['errors'] = $errors;
    }

    return $is_valid;
}

}
?>