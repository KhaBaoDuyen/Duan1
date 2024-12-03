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
            $last_id = $conn->insert_id;
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



} ?>