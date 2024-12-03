<?php

namespace App\Validation;

use App\Helpers\NotificationHelper;

class ProductValidation
{
    public static function create(): bool
    {
        $is_valid = true;
        $errors = [];
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            $errors['name'] = "Tên sản phẩm  không được để trống.";
            $is_valid = false;
        }

        if (!isset($_POST['price']) || $_POST['price'] === '') {
            $errors['price'] = 'Không để trống giá tiền';
            $is_valid = false;
        } elseif ((int) $_POST['price'] <= 0) {
            $errors['price'] = 'Giá tiền phải lớn hơn 0';
            $is_valid = false;
        }

        if (isset($_POST['discount_price']) && $_POST['discount_price'] !== '') {
            if ((int) $_POST['discount_price'] < 0) {
                $errors['discount_price'] = 'Giá tiền giảm phải lớn hơn hoặc  0';
                $is_valid = false;
            } elseif ((int) $_POST['discount_price'] > (int) $_POST['price']) {
                $errors['discount_price'] = 'Giá giảm phải nhỏ hơn  giá gốc';
                $is_valid = false;
            }
        }

        if (!isset($_POST['id_categogy']) || $_POST['id_categogy'] === '') {
            $errors['categogy'] = 'Vui lòng chọn loại sản phẩm';
            $is_valid = false;
        }
        if (!isset($_POST['short_description']) || $_POST['short_description'] === '') {
            $errors['short_description'] = 'Vui lòng nhập mô tả ngắn';
            $is_valid = false;
        }
        if (!isset($_POST['description']) || $_POST['description'] === '') {
            $errors['description'] = 'Vui lòng nhập mô tả ';
            $is_valid = false;
        }
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== 0 || $_FILES['image']['tmp_name'] === '') {
            $errors['image'] = 'Vui lòng chọn ảnh sản phẩm  ';
            $is_valid = false;
        }

    


        if (!$is_valid) {
            $_SESSION['errors'] = $errors;
        }

        return $is_valid;
    }

    public static function image()
    {
        $target_dir = 'public/uploads/products/';
        $imageNames = [];


        if (isset($_FILES['image']) && file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
            $imageFileType = strtolower(pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
            if (!in_array($imageFileType, $allowed_types)) {
                NotificationHelper::error('type_upload', 'Chỉ nhận file ảnh JPG, PNG, JPEG, GIF, WEBP');
                return false;
            }

            $mainImageName = date('YmdHmi') . '_main.' . $imageFileType;
            $mainImagePath = $target_dir . $mainImageName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $mainImagePath)) {
                $imageNames['image'] = $mainImageName;
            } else {
                NotificationHelper::error('move_uploaded', 'Không thể tải file ảnh chính vào thư mục lưu trữ.');
            }
        }

        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $subImages = [];
            foreach ($_FILES['images']['name'] as $key => $name) {
                if (!empty($_FILES['images']['tmp_name'][$key]) && $_FILES['images']['error'][$key] == 0) {
                    $imageFileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                    $allowed_types = ['jpg', 'png', 'jpeg', 'gif', 'webp'];

                    if (!in_array($imageFileType, $allowed_types)) {
                        NotificationHelper::error('type_upload', 'Chỉ nhận file ảnh JPG, PNG, JPEG, GIF, WEBP');
                        continue;
                    }

                    $subImageName = date('YmdHmi') . '_sub_' . $key . '.' . $imageFileType;
                    $subImagePath = $target_dir . $subImageName;
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $subImagePath)) {
                        $subImages[] = $subImageName;
                    } else {
                        NotificationHelper::error('move_uploaded', 'Không thể tải file ảnh phụ vào thư mục lưu trữ.');
                    }
                }
            }

            if (!empty($subImages)) {
                $imageNames['images'] = $subImages;
            }
        }

        return !empty($imageNames) ? json_encode($imageNames) : false;
    }

    public static function update($id): bool
    {
        $is_valid = true;
        $errors = [];

        if (!isset($_POST['name']) || $_POST['name'] === '') {
            $errors['name'] = "Tên sản phẩm không được để trống.";
            $is_valid = false;
        }
        if (!isset($_POST['price']) || $_POST['price'] === '') {
            $errors['price'] = 'Không để trống giá tiền';
            $is_valid = false;
        } elseif ((int) $_POST['price'] <= 0) {
            $errors['price'] = 'Giá tiền phải lớn hơn 0';
            $is_valid = false;
        }
        if (isset($_POST['discount_price']) && $_POST['discount_price'] !== '') {
            if ((int) $_POST['discount_price'] < 0) {
                $errors['discount_price'] = 'Giá tiền giảm phải lớn hơn hoặc bằng 0';
                $is_valid = false;
            } elseif ((int) $_POST['discount_price'] >= (int) $_POST['price']) {
                $errors['discount_price'] = 'Giá giảm phải nhỏ hơn  giá gốc';
                $is_valid = false;
            }
        }

        if (!isset($_POST['id_categogy']) || $_POST['id_categogy'] === '') {
            $errors['categogy'] = 'Vui lòng chọn loại sản phẩm';
            $is_valid = false;
        }
        if (!isset($_POST['short_description']) || $_POST['short_description'] === '') {
            $errors['short_description'] = 'Vui lòng nhập mô tả ngắn';
            $is_valid = false;
        }
        if (!isset($_POST['description']) || $_POST['description'] === '') {
            $errors['description'] = 'Vui lòng nhập mô tả';
            $is_valid = false;
        }

        // if (isset($_POST['end_time']) && $_POST['end_time'] !== '') {
        //     if (!isset($_POST['start_time']) || $_POST['start_time'] === '') {
        //         $errors['end_time'] = 'Không được chọn thời gian kết thúc khi chưa chọn thời gian bắt đầu';
        //         $is_valid = false;
        //     } elseif (strtotime($_POST['end_time']) <= strtotime($_POST['start_time'])) {
        //         $errors['end_time'] = 'Thời gian kết thúc phải sau thời gian bắt đầu';
        //         $is_valid = false;
        //     }
        // }


        if (!$is_valid) {
            $_SESSION['errors'] = $errors;
        }

        return $is_valid;
    }
}
