<?php
namespace App\Validation;

use App\Helpers\NotificationHelper;

class CommentValidation
{
   public static function createClient(): bool
   {
      $is_valid = true;
        if (!isset($_POST['content']) || $_POST['content'] === '') {
         NotificationHelper::error('content', 'Không để trống tên');
         $is_valid = false;
      }
        if (!isset($_POST['product_id']) || $_POST['product_id'] === '') {
         NotificationHelper::error('product', 'Không để trống mã sản phẩm ');
         $is_valid = false;
      }
        if (!isset($_POST['user_id']) || $_POST['user_id'] === '') {
         NotificationHelper::error('user', 'Không để trống mã người dùng ');
         $is_valid = false;
      }
    
      return $is_valid;
   }


 public static function updateClient($id)
    {
     $is_valid = true;
        if (!isset($_POST['content']) || $_POST['content'] === '') {
         NotificationHelper::error('content', 'Không để trống tên');
         $is_valid = false;
      }
      return $is_valid;
    }

}

?>