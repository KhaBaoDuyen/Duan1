<?php

namespace App\Models;

use App\Helpers\NotificationHelper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
class ReminderModel extends BaseModel
{
   protected $table = 'reminders';
   protected $id = 'id';


public function getAllReminder($userId)
{
    $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE id_user = $userId";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
}

   public function create(array $data)
   {
      try {
         $sql = "INSERT INTO $this->table(";
         foreach ($data as $key => $value) {
            $sql .= "$key, ";
         }
         $sql = rtrim($sql, ", ");
         $sql .= " ) VALUES (";
         foreach ($data as $key => $value) {
            $sql .= "'$value', ";
         }
         $sql = rtrim($sql, ", ");
         // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1'
         $sql .= ")";
         // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1')
         $conn = $this->_conn->MySQLi();
         $stmt = $conn->prepare($sql);

         return $stmt->execute();
      } catch (\Throwable $th) {
         error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
         return false;
      }
   }

   public function updateReminder($id, $data)
   {
      return $this->update($id, $data);
   }



}
