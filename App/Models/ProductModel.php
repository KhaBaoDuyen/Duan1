<?php

namespace App\Models;

class ProductModel extends BaseModel
{
    private $connection;
    private $db;
    protected $table = 'products';
    protected $id = 'id';

    public function getAllProduct()
    {
        return $this->getAllProducts();
    }

    public function getOneProduct($id)
    {
        return $this->getOne($id);
    }


    public function createProduct($data)
    {
        return $this->create($data);
    }
    public function updateProduct($id, $data)
    {

        return $this->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->delete($id);
    }


    public function getAllProductByStatus()
    {
        return $this->getAllByStatus();
    }

    /*      public function getOneProductByCategogy($categogy)
     {
         $sql = "SELECT * FROM $this->table WHERE product_id=?  LIMIT 1";
         $conn = $this->_conn->MySQLi();
         $stmt = $conn->prepare($sql);

         $stmt->bind_param('s', $id);
         $stmt->execute();
         return $stmt->get_result()->fetch_assoc();

     } */


    public function getOneProductByCategory($category)
    {
        $sql = "SELECT * FROM $this->table WHERE id_categogy=? LIMIT 1";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $category);  // Sử dụng kiểu dữ liệu đúng ('s' cho string)
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getOneProductByName($name)
    {
        return $this->getOneByName($name);
    }

    public function getOneProductByStatus($id)
    {
        return $this->getOneByStatus($id);
    }

    public function getAllProductJoinCategory()
    {
        return $this->getAllProductJoinCategories();
    }
    public function getAllProductByCategoryAndStatus($id)
    {
        $result = [];
        try {
            $sql = "SELECT products.*, categories.name AS category_name 
    FROM products
    INNER JOIN categories ON products.id_categogy = categories.id 
    WHERE products.id_categogy = ? 
    AND products.status = " . self::STATUS_ENABLE . " 
    AND categories.status = " . self::STATUS_ENABLE;
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy dữ liệu theo category và status: ' . $th->getMessage());
            return $result;
        }
    }

    public function countTotalProduct()
    {
        return $this->countTotalByStatus();
    }

    public function countProductByCategogy()
    {
        $result = [];
        try {
            $sql = "SELECT categories.id, categories.name, COUNT(products.id) AS product_count
            FROM categories
            LEFT JOIN products ON categories.id = products.id_categogy
            GROUP BY categories.id, categories.name;";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }


    //----------------[ SEARCH ]----------------
    public static function searchByKeywordProduct($keyword)
    {
        $db = (new Database())->Pdo();
        $stmt = $db->prepare("
        SELECT 
            products.*, categories.name AS category_name
        FROM 
            products
        LEFT JOIN categories ON categories.id = products.id_categogy
        WHERE 
            products.name LIKE :keyword 
            OR products.short_description LIKE :keyword 
            OR categories.name LIKE :keyword
    ");

        $stmt->execute(['keyword' => '%' . $keyword . '%']);

        // Trả về kết quả
        return $stmt->fetchAll();
    }
    public function countProductByCategory()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS count,categories.name FROM products INNER JOIN categories ON products.id_categogy=categories.id\n"

            . "GROUP BY products.id_categogy;";
                    $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
}
