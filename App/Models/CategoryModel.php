<?php

namespace App\Models;

class CategoryModel extends BaseModel
{
    protected $table = 'categories';
    protected $id = 'id';

    public function getAllCategory()
    {
        return $this->getAll();
    }
    public function getOneCategory($id)
    {
        return $this->getOne($id);
    }

    public function createCategory($data)
    {
        return $this->create($data);
    }
    public function updateCategory($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->delete($id);
    }
    public function getAllCategoryByStatus()
    {
        return $this->getAllByStatus();
    }
    public function getOneCategoryByName($name)
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

    //--------------------SEARCH------------------------

    public function searchByKeywordCategogy($keyword)
    {
        $db = (new Database())->Pdo();
        $stmt = $db->prepare("
         SELECT * 
    FROM $this->table 
    WHERE name LIKE :keyword 
    ");

        $stmt->execute(['keyword' => '%' . $keyword . '%']);

        // Trả về kết quả
        return $stmt->fetchAll();
    }


    public function countTotalCategogy()
    {
        return $this->countTotal();
    }
}
