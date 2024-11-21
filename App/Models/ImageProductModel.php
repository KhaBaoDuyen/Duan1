<?php 
namespace App\Models;

class ImageProductModel extends BaseModel
{
    protected $table = 'images_product';
    protected $id = 'id';


    
   public function getAllImagesByProduct($id)
   {
       $sql = "SELECT * FROM $this->table WHERE id_product=?";
        $conn = $this->_conn->MySQLi();
       $stmt = $conn->prepare($sql);
       $stmt->bind_param('s', $id);
       $stmt->execute();
       return $stmt->get_result()->fetch_all(MYSQLI_ASSOC );
    }
}

