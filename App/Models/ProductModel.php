<?php

namespace App\Models;

class ProductModel extends BaseModel
{
    protected $table = 'product';
    protected $id = 'product_id';

    public function getAllProduct()
    {
        return $this->getAll();
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

    public function getOneProductByCategogy($categogy)
    {
        $sql = "SELECT * FROM $this->table WHERE product_id=?  LIMIT 1";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param('s', $id);
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
        // $this->_conn = new Database();
        $sql = "SELECT product.*, category.name AS category_name 
                FROM product INNER JOIN category  ON product.category_id = category.categories_id";
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllProductByCategoryAndStatus($id)
    {
        $result = [];
        try {
            $sql = "SELECT product.*, category.name AS category_name 
    FROM product 
    INNER JOIN category ON product.category_id = category.categories_id 
    WHERE product.category_id = ? 
    AND product.status = " . self::STATUS_ENABLE . " 
    AND category.status = " . self::STATUS_ENABLE;
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
        return $this->countTotal();
    }


    public function countProductByCategogy()
    {
        $result = [];
        try {
            $sql = "SELECT count(*) AS count,category.name FROM product inner JOIN category on product.category_id= category.categories_id GROUP by product.category_id;";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function countProductByView()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS count, product.name, product.view FROM product GROUP BY product.product_id, product.name, product.view ORDER BY count DESC LIMIT 5;";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
}
