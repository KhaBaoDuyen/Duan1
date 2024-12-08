<?php

namespace App\Models;

class OrderModel extends BaseModel
{
    protected $table = 'orders';
    protected $id = 'id';

    public function getAllOrder()
    {
        return $this->getAll();
    }

    public function getOrderById($id)
    {
        return $this->getOne($id);
    }

    public function updateOrder($id, $data)
    {
        return $this->update($id, $data);
    }

    public function getOneOrder($id)
    {
        return $this->getOne($id);
    }

    public function createOrder($data)
    {
        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = implode(", ", array_fill(0, count($data), '?'));


            $sql = "INSERT INTO orders ($columns) VALUES ($placeholders)";
            $conn = $this->_conn->MySQLi();
            if ($conn->connect_error) {
                error_log('Connection failed: ' . $conn->connect_error);
                return false;
            }
            // $last_id = $conn->insert_id;

            $stmt = $conn->prepare($sql);

            $stmt->bind_param(str_repeat('s', count($data)), ...array_values($data)); // Giả sử tất cả các giá trị đều là chuỗi
            if ($stmt->execute()) {
                return $conn->insert_id; //  trả về ìd vauwf tạo
            } else {
                return false; // Nếu thực thi thất bại, trả về false
            }
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }
    public function createOrderDetail($data)
    {

        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = implode(", ", array_fill(0, count($data), '?'));

            $sql = "INSERT INTO order_details ($columns) VALUES ($placeholders)";
            $conn = $this->_conn->MySQLi();
            if ($conn->connect_error) {
                error_log('Connection failed: ' . $conn->connect_error);
                return false;
            }
            $last_id = $conn->insert_id;
            $stmt = $conn->prepare($sql);

            $stmt->bind_param(str_repeat('s', count($data)), ...array_values($data)); // Giả sử tất cả các giá trị đều là chuỗi
            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }

    public function createOrderByVnpay($data)
    {

        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = implode(", ", array_fill(0, count($data), '?'));

            $sql = "INSERT INTO tbl_vnpay  ($columns) VALUES ($placeholders)";
            $conn = $this->_conn->MySQLi();
            if ($conn->connect_error) {
                error_log('Connection failed: ' . $conn->connect_error);
                return false;
            }
            $last_id = $conn->insert_id;
            $stmt = $conn->prepare($sql);

            $stmt->bind_param(str_repeat('s', count($data)), ...array_values($data)); // Giả sử tất cả các giá trị đều là chuỗi
            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }

    public function getLastBillByVnpay($id_user, $id_order)
    {
        $result = [];
        try {
            $sql = "SELECT 
                    orders.*, 
                    order_details.*, 
                    tbl_vnpay.* 
                FROM  orders
                JOIN   order_details ON orders.id = order_details.id_order
                JOIN   tbl_vnpay ON orders.id = tbl_vnpay.id_order
                WHERE  orders.id_user = $id_user  AND orders.id = $id_order";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy thông tin đơn hàng: ' . $th->getMessage());
            return $result;
        }
    }


    public function getLastOrder($id_user, $id_order)
    {
        $result = [];
        try {
            $sql = "SELECT orders.*, order_details.* 
                FROM orders
                JOIN order_details ON orders.id = order_details.id_order
                WHERE orders.id_user = $id_user AND orders.id = $id_order";

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy thông tin đơn hàng: ' . $th->getMessage());
            return $result;
        }
    }

// -------------------[ HISTORY ]----------------------------------------
    public function getAllOrderHitory($id_user)
    {
        $result = [];
        try {
            $sql = "SELECT orders.id AS order_id, 
       orders.name AS username, 
       orders.address, 
       orders.phone, 
       orders.pay,
       order_details.date, 
       orders.status, 
       orders.total, 
       order_details.id_product, 
       order_details.quantity, 
       order_details.variant_key, 
       products.name, 
       products.image, 
       order_details.price
FROM orders 
LEFT JOIN order_details ON orders.id = order_details.id_order 
LEFT JOIN tbl_vnpay ON orders.id = tbl_vnpay.id_order 
LEFT JOIN products ON products.id = order_details.id_product 
WHERE orders.id_user = 2
ORDER BY orders.id DESC, order_details.id_product;
";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function updateHistory($status, $id)
    {
      try {
         $sql = "UPDATE {$this->table} SET status = ? WHERE id = ?";
         $conn = $this->_conn->MySQLi();
         $stmt = $conn->prepare($sql);

         if (!$stmt) {
            throw new \Exception("Lỗi chuẩn bị SQL: " . $conn->error);
         }

         $updatedAt = date('Y-m-d H:i:s');
         $stmt->bind_param("si", $status, $id);


         return $stmt->execute();
      } catch (\Throwable $th) {
         error_log("Lỗi khi cập nhật dữ liệu: " . $th->getMessage());
         return false;
      }
   
    }

    public function countTotalOrder()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS total FROM orders ";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi Thống kê chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
}