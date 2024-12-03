<?php
namespace App\Models;

use App\Helpers\NotificationHelper;

class CartModel extends BaseModel
{
   protected $table = 'cart';
   protected $id = 'id';

   public function getAllCart()
   {
      return $this->getAll();
   }

   /**
    * Thêm sản phẩm vào giỏ hàng
    */
   public function createCart(array $data)
   {
      try {
         $columns = implode(", ", array_keys($data));
         $placeholders = implode(", ", array_fill(0, count($data), "?"));
         $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";

         $conn = $this->_conn->MySQLi();
         $stmt = $conn->prepare($sql);

         if (!$stmt) {
            throw new \Exception("Lỗi chuẩn bị SQL: " . $conn->error);
         }

         $types = str_repeat('s', count($data));
         $stmt->bind_param($types, ...array_values($data));

         return $stmt->execute();
      } catch (\Throwable $th) {
         error_log("Lỗi khi thêm dữ liệu: " . $th->getMessage());
         return false;
      }
   }

   public function getAllCartByUserId($id)
   {
      $result = [];
      try {
         $sql = "SELECT cart.*, 
                     user.username AS user_name, 
                     products.name AS product_name, 
                     products.price AS product_price, 
                     products.discount_price AS product_discount_price, 
                     products.image AS product_image, 
                     products.variant AS product_variant
              FROM cart 
              JOIN user ON cart.id_user = user.id 
              JOIN products ON cart.id_product = products.id
              WHERE cart.id_user = ?";

         $conn = $this->_conn->MySQLi();
         $stmt = $conn->prepare($sql);

         if (!$stmt) {
            throw new \Exception("Lỗi chuẩn bị SQL: " . $conn->error);
         }

         $stmt->bind_param('i', $id);
         $stmt->execute();
         $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

         // Giải mã mảng variant JSON
         foreach ($result as &$item) {
            $variants = json_decode($item['product_variant'], true);
            $variantKey = $item['variant_key'];

            if (isset($variants[$variantKey])) {
               $variant = $variants[$variantKey];
               $item['variant_name'] = $variant['nameVariant'] ?? '';
               $item['variant_price'] = $variant['priceVariant'] ?? $item['product_price'];
            }
         }

         return $result;
      } catch (\Throwable $th) {
         error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
         return $result;
      }
   }

   // Lssy sp theo id người dùng và id sản phẩm
   public function getCartItemByProductId($userId, $productId)
   {
      $sql = "SELECT * FROM cart WHERE id_user = ? AND id_product = ? AND variant_key IS NULL";
      $conn = $this->_conn->MySQLi();
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('ii', $userId, $productId);
      $stmt->execute();
      return $stmt->get_result()->fetch_assoc();
   }


   //  Lấy sản phẩm trong giỏ hàng theo id người dùng id sản phẩm và variantKey
   public function getCartItem($id_user, $id_product, $variantKey)
   {
      try {
         $sql = "SELECT * FROM $this->table
                    WHERE id_user = ? AND id_product = ? AND variant_key = ?";
         $conn = $this->_conn->MySQLi();
         $stmt = $conn->prepare($sql);

         if (!$stmt) {
            throw new \Exception("Lỗi chuẩn bị SQL: " . $conn->error);
         }

         $stmt->bind_param("iis", $id_user, $id_product, $variantKey);
         $stmt->execute();
         $result = $stmt->get_result();

         return $result->fetch_assoc(); // Trả về dòng dữ liệu hoặc null nếu không có
      } catch (\Throwable $th) {
         error_log("Lỗi khi lấy dữ liệu: " . $th->getMessage());
         return null;
      }
   }

   // Cập nhật số lượng sản phẩm trong giỏ hàng
   public function updateCartItem($id, $quantity)
   {
      try {
         $sql = "UPDATE {$this->table} SET quantity = ?, updated_at = ? WHERE id = ?";
         $conn = $this->_conn->MySQLi();
         $stmt = $conn->prepare($sql);

         if (!$stmt) {
            throw new \Exception("Lỗi chuẩn bị SQL: " . $conn->error);
         }

         $updatedAt = date('Y-m-d H:i:s');
         $stmt->bind_param("isi", $quantity, $updatedAt, $id);

         return $stmt->execute();
      } catch (\Throwable $th) {
         error_log("Lỗi khi cập nhật dữ liệu: " . $th->getMessage());
         return false;
      }
   }

   // xóa giỏ hàng theo biến thể
   public function deleteCartItemVariant($id_user, $id_product, $variantKey)
   {
      try {
         $sql = "DELETE FROM $this->table WHERE id_user = ? AND id_product = ? AND variant_key = ?";
         $conn = $this->_conn->MySQLi();
         $stmt = $conn->prepare($sql);

         if (!$stmt) {
            throw new \Exception("Lỗi chuẩn bị SQL: " . $conn->error);
         }

         $stmt->bind_param("iis", $id_user, $id_product, $variantKey);
         return $stmt->execute();
      } catch (\Throwable $th) {
         error_log("Lỗi khi xóa dữ liệu: " . $th->getMessage());
         return false;
      }
   }

   //  xóa giỏ hàng theo sản phẩm
   public function deleteCartItem($id_user, $id_product)
   {
      try {
         // Xóa sản phẩm theo id_user và id_product
         $sql = "DELETE FROM {$this->table} WHERE id_user = ? AND id_product = ?";
         $conn = $this->_conn->MySQLi();
         $stmt = $conn->prepare($sql);

         if (!$stmt) {
            throw new \Exception("Lỗi chuẩn bị SQL: " . $conn->error);
         }

         $stmt->bind_param("ii", $id_user, $id_product);
         return $stmt->execute();
      } catch (\Throwable $th) {
         error_log("Lỗi khi xóa dữ liệu: " . $th->getMessage());
         return false;
      }
   }

   public function countTotalCartQuatity()
   {
      $result = $this->countTotalCart();
      return isset($result['totalQuantity']) ? (int) $result['totalQuantity'] : 0;
   }
}
