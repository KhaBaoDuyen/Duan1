<?php

namespace App\Models;

use App\Helpers\NotificationHelper;

class CommentModel extends BaseModel
{
   protected $table = 'comments';
   protected $id = 'id';

   public function getAllComment()
   {
      return $this->getAll();
   }

   public function getOneComment($id)
   {
      return $this->getOne($id);
   }

   public function createComment($data)
   {
      return $this->create($data);
   }

   public function updateComment($id, $data)
   {
      return $this->update($id, $data);
   }

   public function deleteComment($id)
   {
      return $this->delete($id);
   }

   public function get5CommentNewestByProductAndStatus($id)
   {
      $sql = "SELECT comments.*, user.username, user.name, user.avatar
        FROM comments 
        INNER JOIN user ON comments.id_user = user.id 
        WHERE comments.id_product = ? AND comments.status = " . self::STATUS_ENABLE . "
        ORDER BY date DESC 
        LIMIT 5";
      $conn = $this->_conn->MySQLi();
      $stmt = $conn->prepare($sql);

      $stmt->bind_param('i', $id);
      $stmt->execute();
      return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
   }


   public function getAllProductJoinCategory()
   {
      $result = [];
      try {
         $sql = "SELECT products.*, categories.name AS category_name 
                FROM products INNER JOIN categories ON products.category_id = categories.id";
         $result = $this->_conn->MySQLi()->query($sql);
         return $result->fetch_all(MYSQLI_ASSOC);
      } catch (\Throwable $th) {
         error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
         NotificationHelper::error('getAllProductJoinCategory', 'Lỗi khi hiển thị tất cả dữ liệu');
         return $result;
      }
   }

   public function getAllCommentJoinProductAndUser()
   {
      $result = [];
      try {
         $sql = "SELECT comments.*, products.name AS product_name, user.username
         FROM comments INNER JOIN products ON comments.id_product=products.id
         INNER JOIN user ON comments.id_user=user.id;";
         $result = $this->_conn->MySQLi()->query($sql);
         return $result->fetch_all(MYSQLI_ASSOC);
      } catch (\Throwable $th) {
         error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
         NotificationHelper::error('getAllCommentJoinProductAndUser', 'Lỗi khi hiển thị tất cả dữ liệu');
         return $result;
      }

   }
   public function getOneCommentJoinProductAndUser(int $id)
   {
      $result = [];
      try {
          $sql = "SELECT comments.*, products.name AS product_name, user.username FROM comments 
          INNER JOIN products ON comments.id_product=products.id 
          INNER JOIN user ON comments.id_user=user.id
          WHERE comments.id=?";
          $conn = $this->_conn->MySQLi();
          $stmt = $conn->prepare($sql);

          $stmt->bind_param('i', $id);
          $stmt->execute();
          return $stmt->get_result()->fetch_assoc();
      } catch (\Throwable $th) {
          error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
          NotificationHelper::error('getOneCommentJoinProductAndUser', 'Lỗi khi hiển thị chi tiết dữ liệu');
          return $result;
      }
   }


   public function countCommentByStatus(){
    return $this->countTotalByStatus();
  }

  public function countCommentByProduct()
  {
      $result = [];
      try {
          $sql = "SELECT COUNT(*) AS count,products.name FROM comments INNER JOIN products on comments.id_product=products.id GROUP BY comments.id_product ORDER BY count DESC LIMIT 4;";
          $result = $this->_conn->MySQLi()->query($sql);
          return $result->fetch_all(MYSQLI_ASSOC);
      } catch (\Throwable $th) {
          error_log('Lỗi khi hiển thị dữ liệu: ' . $th->getMessage());
          return $result;
      }
  }
}

