<?php

namespace App\Models;

use App\Helpers\NotificationHelper;
use App\Interfaces\CrudInterface;
use Exception;

abstract class BaseModel implements CrudInterface
{
    protected $_conn;
    protected $table;
    protected $id;
    protected $id_categlogies;
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;


    public function __construct()
    {
        $this->_conn = new Database();
    }

    public function getAll()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getAllProducts()
    {
        $result = [];
        try {
            $sql = "SELECT *  FROM $this->table";

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getOne(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE $this->id=?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    //    public function create(array $data)
    //     {
    //         try {
    //             $sql = "INSERT INTO $this->table(";
    //             foreach ($data as $key => $value) {
    //                 $sql .= "$key, ";
    //             }
    //             // INSERT INTO $this->table (name, description, status, 
    //             $sql = rtrim($sql, ", ");
    //             // INSERT INTO $this->table (name, description, status
    //             $sql .=   " ) VALUES (";
    //             // INSERT INTO $this->table (name, description, status) VALUES (
    //             foreach ($data as $key => $value) {
    //                 $sql .= "'$value', ";
    //             }
    //             // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1', 
    //             $sql = rtrim($sql, ", ");
    //             // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1'
    //             $sql .= ")";
    //             // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1')
    //             $conn = $this->_conn->MySQLi();
    //             $stmt = $conn->prepare($sql);

    //             return $stmt->execute();

    //         } catch (\Throwable $th) {
    //             error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
    //             return false;
    //         }
    //     }

    public function create(array $data)
    {
        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = implode(", ", array_fill(0, count($data), '?'));

            $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param(str_repeat('s', count($data)), ...array_values($data)); // Giả sử tất cả các giá trị đều là chuỗi

            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }

    public function update(int $id, array $data)
    {
        try {
            $sql = "UPDATE $this->table SET ";
            foreach ($data as $key => $value) {
                $sql .= "$key = '$value', ";
            }
            $sql = rtrim($sql, ", ");

            $sql .= " WHERE $this->id=$id";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi xóa dữ liệu: ' . $th->getMessage());
            return false;
        }
    }


    public function delete(int $id): bool
    {
        try {
            $sql = "
            DELETE FROM $this->table WHERE $this->id=$id ";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            // trả về số hàng dữ liệu bị ảnh hưởng
            return $stmt->affected_rows;
        } catch (\Throwable $th) {
            error_log('Lỗi khi xóa dữ liệu: ' . $th->getMessage());
            return false;
        }
    }

    public function getAllByStatus()
    {
        $sql = "SELECT * FROM $this->table WHERE status = " . self::STATUS_ENABLE . " ";
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllByProductStatus()
    {
        $sql = "SELECT * FROM $this->table WHERE status = " . self::STATUS_ENABLE . "   LIMIT 15";
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOneByName($name)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE name=?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('s', $name);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy danh mục bằng tên  dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getAllProductByStatus()
    {

        return $this->getAllByStatus();
    }

    public function getOneByStatus(int $id)
    {

        $sql = "SELECT products.*, categories.name AS name_categogy
            FROM products
            LEFT JOIN categories ON products.id_categogy = categories.id
            WHERE products.id = ? AND products.status = " . self::STATUS_ENABLE;
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getOneProductByStatus($id)
    {
        return $this->getOneByStatus($id);
    }

    // đếm số lượng cho Client
    public function countTotalByStatus()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS total FROM $this->table WHERE status = 1 ";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi Thống kê chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    // đếm số lượng 
    public function countTotalProduct()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS total FROM $this->table where categories_id=?";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi Thoóng kê chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function countTotal()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS total FROM $this->table";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi Thống kê chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getAllProductJoinCategories()
    {
        $sql = "SELECT products.*, categories.name AS category_name 
                FROM products
                INNER JOIN categories ON products.id_categogy = categories.id ORDER BY products.id DESC";
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteCategogy(int $id): bool
    {
        try {
            $conn = $this->_conn->MySQLi();

            // Kiểm tra xem có sản phẩm nào thuộc danh mục này không
            $sql = "SELECT COUNT(*) as product_count FROM products WHERE id_categogy = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $productCount = $result->fetch_assoc()['product_count'];

            // Nếu có sản phẩm, cập nhật danh mục của chúng thành id 23
            if ($productCount > 0) {
                $idCategory = 29;
                $sqlUpdate = "UPDATE products SET id_categogy = ? WHERE id_categogy = ?;";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bind_param('ii', $idCategory, $id);
                $stmtUpdate->execute();
            }

            // Xóa danh mục
            $sqlDeleteCategory = "DELETE FROM $this->table WHERE $this->id = ?";
            $stmtDelete = $conn->prepare($sqlDeleteCategory);
            $stmtDelete->bind_param('i', $id);
            $stmtDelete->execute();

            return $stmtDelete->affected_rows > 0;
        } catch (\Throwable $th) {
            error_log('Lỗi khi xóa dữ liệu: ' . $th->getMessage());
            return false;
        }
    }

}
