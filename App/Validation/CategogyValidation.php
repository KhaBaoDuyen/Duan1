<?php
namespace App\Validation;

use App\Helpers\NotificationHelper;

class CategogyValidation
{
   public static function create(): bool
   {
      $is_valid = true;
      // TÊN DAnh MỤC
      if (!isset($_POST['name']) || $_POST['name'] === '') {
         NotificationHelper::error('name', 'Tên danh mục không được để trống ');
         $is_valid = false;
      }
      //  TRẠNG THÁI
      if (!isset($_POST['status']) || $_POST['status'] === '') {
         NotificationHelper::error('status', 'Không được để trống ');
         $is_valid = false;
      }
      return $is_valid;
   }

   public static function avatar()
   {
      if (!file_exists($_FILES['avatar']['tmp_name']) || !is_uploaded_file($_FILES['avatar']['tmp_name'])) {
         return false;
      }
      // nơi lưu trữ hình ảnh (trong source code)
      $target_dir = 'public/uploads/users/';
      $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
      $imageFileType = strtolower(pathinfo(basename($_FILES['avatar']['name']), PATHINFO_EXTENSION));

      // lấy kiểu file (đuôi file)
      $allowed_types = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
      if (!in_array($imageFileType, $allowed_types)) {
         NotificationHelper::error('type_upload', 'Chỉ nhận file ảnh JPG, PNG, JPEG, GIF, WEBP');
         return false;
      }
      // thay đổi tên file thành dạng năm tháng ngày giờ phút giây
      $nameImage = date('YmdHmi') . '.' . $imageFileType;
      // đường dẫn đầy đủ để di chuyển file đến
      $target_file = $target_dir . $nameImage;

      // Di chuyển file
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
         // echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

      } else {
         $nameImage = '';
         NotificationHelper::error('upload_file', 'Upload file thất bại');
      }

      return $nameImage;
   }

}

?>