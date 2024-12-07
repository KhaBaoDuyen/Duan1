<?php

namespace App\Models;

class OrderModel extends BaseModel
{
    protected $table = 'order_details';
    protected $id = 'id';

    public function getAllOrder_details()
    {
        return $this->getAll();
    }

    public function getOrderById($id)
    {
        return $this->getOne($id);
    }

    public function updateOrder_details($id, $data)
    {
        return $this->update($id, $data);
    }

    public function getOneOrder_details($id)
    {
        return $this->getOne($id);
    }

    public function deleteOrder_detail($id)
    {
        return $this->delete($id);
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

    function getAllByOrderdetail()
    {
        // Truy vấn SQL
        $sql = "SELECT 
                p.name AS product_name, 
                o.address, 
                o.pay, 
                o.name AS user_name,
                od.id, 
                od.price, 
                od.date, 
                od.status
            FROM 
                order_details od 
            JOIN 
                products p ON od.id_product = p.id 
            JOIN 
                orders o ON od.id_order = o.id;";

        // Kết nối cơ sở dữ liệu
        $conn = $this->_conn->MySQLi();

        // Chuẩn bị câu lệnh
        $stmt = $conn->prepare($sql);

        // Thực thi câu lệnh
        $stmt->execute();

        // Lấy kết quả
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC); // Lấy tất cả các dòng dưới dạng mảng kết hợp

        // Đóng câu lệnh và kết nối
        $stmt->close();
        $conn->close();

        // Trả về dữ liệu
        return $data;
    }

    function getOneByOrderdetail($id)
    {
        // Truy vấn SQL với điều kiện WHERE để chỉ lấy một đơn hàng
        $sql = "SELECT 
                p.name AS product_name, 
                o.phone, 
                o.email,
                o.address, 
                o.pay, 
                o.name AS user_name,
                od.id,
                od.quantity, 
                od.price, 
                od.date, 
                od.variant_key, 
                od.status
            FROM 
                order_details od 
            JOIN 
                products p ON od.id_product = p.id 
            JOIN 
                orders o ON od.id_order = o.id
            WHERE 
                od.id = ?;"; // Điều kiện lấy theo id_order

        // Kết nối cơ sở dữ liệu
        $conn = $this->_conn->MySQLi();

        // Chuẩn bị câu lệnh
        $stmt = $conn->prepare($sql);

        // Gắn tham số cho câu truy vấn
        $stmt->bind_param('i', $id); // 'i' cho kiểu số nguyên (id_order)

        // Thực thi câu lệnh
        $stmt->execute();

        // Lấy kết quả
        $result = $stmt->get_result();
        $data = $result->fetch_assoc(); // Lấy một dòng dữ liệu dưới dạng mảng kết hợp

        // Đóng câu lệnh và kết nối
        $stmt->close();
        $conn->close();
        return $data;
    }


    public function searchByKeywordOrder_detail($keyword)
    {
        $db = (new Database())->Pdo();
        $stmt = $db->prepare("
        SELECT 
                p.name AS product_name, 
                o.address, 
                o.pay, 
                o.name AS user_name,
                od.id,
                od.price, 
                od.date, 
                od.status
            FROM 
                order_details od 
            JOIN 
                products p ON od.id_product = p.id 
            JOIN 
                orders o ON od.id_order = o.id
        WHERE o.name LIKE :keyword
    ");

        $stmt->execute(['keyword' => '%' . $keyword . '%']);

        // Trả về kết quả
        return $stmt->fetchAll();
    }
}
