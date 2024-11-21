<?php
namespace App\Validation;

use App\Helpers\NotificationHelper;

class ProductValidation
{
   public static function create(): bool
   {
      $is_valid = true;
      if (!isset($_POST['name']) || $_POST['name'] === '') {
         NotificationHelper::error('name', 'Không để trống tên');
         $is_valid = false;
      }
      if (!isset($_POST['price']) || $_POST['price'] === '') {
         NotificationHelper::error('price', 'Không để trống giá tiền');
         $is_valid = false;
      } elseif ((int) $_POST['price'] <= 0) {
         NotificationHelper::error('price', 'Giá tiền phải lớnn hơn 0');
         $is_valid = false;
      }
      if (!isset($_POST['discount_price']) || $_POST['discount_price'] === '') {
         NotificationHelper::error('discount_price', 'Không để trống giá giảm');
         $is_valid = false;
      } elseif ((int) $_POST['discount_price'] <= 0) {
         NotificationHelper::error('discount_price', 'Giá tiền giảm phải lớn hơn 0 hoặc bằng 0');
         $is_valid = false;
      } elseif ((int) $_POST['discount_price'] >= $_POST['price']) {
         NotificationHelper::error('discount_price', 'Giá giảm phải nhỏ hơn hoặc bằng  giá tiền');
         $is_valid = false;
      }
      if (!isset($_POST['categories_id']) || $_POST['categories_id'] === '') {
         NotificationHelper::error('categories_id', 'Không để trống loại sản phẩm');
         $is_valid = false;
      }
      if (!isset($_POST['is_featured']) || $_POST['is_featured'] === '') {
         NotificationHelper::error('is_featured', 'Không để trống sản phẩm nổi bật');
         $is_valid = false;
      }
      if (!isset($_POST['status']) || $_POST['status'] === '') {
         NotificationHelper::error('status', 'Không để trống trạng thái');
         $is_valid = false;
      }
      return $is_valid;
   }
   public static function image()
   {
      if (!isset($_FILES['image']) || !file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
         return false;
      }

      $target_dir = 'public/uploads/products/';
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $imageFileType = strtolower(pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION));

      // Kiểm tra loại file
      $allowed_types = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
      if (!in_array($imageFileType, $allowed_types)) {
         NotificationHelper::error('type_upload', 'Chỉ nhận file ảnh JPG, PNG, JPEG, GIF, WEBP');
         return false;
      }

      // Thay đổi tên ảnh
      $nameImage = date('YmdHmi') . '.' . $imageFileType;
      $target_file = $target_dir . $nameImage;

      // Di chuyển file
      if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
         NotificationHelper::error('move_uploaded', 'Không thể tải file vào thư mục đã lưu trữ ');
         return false;
      }

      return $nameImage;
   }

   public static function update($id)
   {
      $is_valid = true;
      if (!isset($_POST['name']) || $_POST['name'] === '') {
         NotificationHelper::error('name', 'Không để trống tên');
         $is_valid = false;
      }
      if (!isset($_POST['price']) || $_POST['price'] === '') {
         NotificationHelper::error('price', 'Không để trống giá tiền');
         $is_valid = false;
      } elseif ((int) $_POST['price'] <= 0) {
         NotificationHelper::error('price', 'Giá tiền phải lớnn hơn 0');
         $is_valid = false;
      }

     if (!isset($_POST['discount_price']) || $_POST['discount_price'] === '') {
         NotificationHelper::error('discount_price', 'Không để trống giá giảm');
         $is_valid = false;
      } elseif ((int) $_POST['discount_price'] <= 0) {
         NotificationHelper::error('discount_price', 'Giá tiền giảm phải lớn hơn 0 hoặc bằng 0');
         $is_valid = false;
      } elseif ((int) $_POST['discount_price'] >= $_POST['price']) {
         NotificationHelper::error('discount_price', 'Giá giảm phải nhỏ hơn hoặc bằng  giá tiền');
         $is_valid = false;
      }

      if (!isset($_POST['categories_id']) || $_POST['categories_id'] === '') {
         NotificationHelper::error('categories_id', 'Không để trống loại sản phẩm');
         $is_valid = false;
      }
      if (!isset($_POST['is_featured']) || $_POST['is_featured'] === '') {
         NotificationHelper::error('is_featured', 'Không để trống sản phẩm nổi bật');
         $is_valid = false;
      }
      if (!isset($_POST['status']) || $_POST['status'] === '') {
         NotificationHelper::error('status', 'Không để trống trạng thái');
         $is_valid = false;
      }
      return $is_valid;
   }

}

?>