<?php

namespace App\Validation;

use App\Helpers\NotificationHelper;

class CategogyValidation
{
   public static function create(): bool
   {
      $is_valid = true;
      $errors = [];

      // Kiểm tra tên danh mục
      if (empty($_POST["name"])) {
         $errors['name'] = "Tên danh mục không được để trống.";
         $is_valid = false;
      } else {
         $name = $_POST["name"];
         if (strlen($name) < 5) {
            $errors['name'] = "Tên danh mục phải có ít nhất 5 ký tự.";
            $is_valid = false;
         }
      }

      if (!isset($_POST['status']) || $_POST['status'] === '') {
         $errors['status'] = 'Không được để trống trạng thái';
         $is_valid = false;
      }

      if (isset($_FILES['image']) && $_FILES['image']['error'] !== 0) {
         $errors['image'] = 'Không được để trống ảnh';
         $is_valid = false;
      }

      // Lưu lỗi vào session
      if (!$is_valid) {
         $_SESSION['errors'] = $errors;
      }

      return $is_valid;
   }

   public static function update($id): bool
   {
      $is_valid = true;
      $errors = [];

      // Kiểm tra tên danh mục
      if (empty($_POST["name"])) {
         $errors['name'] = "Tên danh mục không được để trống.";
         $is_valid = false;
      } else {
         $name = $_POST["name"];
         if (strlen($name) < 5) {
            $errors['name'] = "Tên danh mục phải có ít nhất 5 ký tự.";
            $is_valid = false;
         }
      }

      // Kiểm tra trạng thái
      if (!isset($_POST['status']) || $_POST['status'] === '') {
         $errors['status'] = 'Không được để trống trạng thái';
         $is_valid = false;
      }

      // Kiểm tra ảnh
      if (isset($_FILES['image']) && $_FILES['image']['error'] !== 0) {
         $errors['image'] = 'Không được để trống ảnh';
         $is_valid = false;
      }

      // Lưu lỗi vào session nếu có
      if (!$is_valid) {
         $_SESSION['errors'] = $errors;
      }

      return $is_valid;
   }


   public static function image()
   {
      if (!isset($_FILES['image']) || !file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
         return false;
      }

      $target_dir = 'public/uploads/categogies/';
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $imageFileType = strtolower(pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION));

      $allowed_types = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
      if (!in_array($imageFileType, $allowed_types)) {
         NotificationHelper::error('type_upload', 'Chỉ nhận file ảnh JPG, PNG, JPEG, GIF, WEBP');
         return false;
      }

      $nameImage = date('YmdHmi') . '.' . $imageFileType;
      $target_file = $target_dir . $nameImage;

      // Di chuyển file
      if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
         NotificationHelper::error('move_uploaded', 'Không thể tải file vào thư mục đã lưu trữ ');
         return false;
      }

      return $nameImage;
   }

   public static function delete()
   {
      $is_valid = true;

      if (empty($_POST["id"]) && $_POST['id'] == 23) {
         $is_valid = false;
      }

      return $is_valid;
   }
}
