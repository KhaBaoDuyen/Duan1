<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\BaseModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Validation\CategogyValidation;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Category\Create;
use App\Views\Admin\Pages\Category\Edit;
use App\Views\Admin\Pages\Category\Search;
use App\Views\Admin\Pages\Category\Index;

class CategoryController
{

    // hiển thị danh sách
    public static function index()
    {
        $categories = new CategoryModel();
        $data = $categories->getAllCategory();
        //      echo"<pre>";
        // var_dump($data);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }

    //--------------CREATE--------------------
    public static function create()
    {
        // var_dump($_SESSION);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Create::render();
        Footer::render();
    }
    // xử lý chức năng thêm
    public static function store()
    {
        $is_valid = CategogyValidation::create();
        if ($is_valid) {
            $categogies = new CategoryModel();
            $is_exist = $categogies->getOneCategoryByName($_POST['name']);
        } else {
            NotificationHelper::error('store', 'Thêm thất bại thông tin thất bại');
            header("Location:/admin/categories/create");
            exit;
        }
        if ($is_exist) {
            NotificationHelper::error('store', 'Tên danh mục đã tồn tại');
            header('location: /admin/categories/create');
            exit;
        }
        $data = [
            'name' => $_POST['name'],
            'status' => $_POST['status'],
        ];

        $is_upload = CategogyValidation::image();
        if ($is_upload) {
            $data['image'] = $is_upload;
        }

        $result = $categogies->createCategory($data);
        // var_dump($result);
        if ($result) {
            NotificationHelper::success('category', 'Thêm thành công');
            header('location: /admin/categories');
        } else {
            NotificationHelper::error('category', 'Thêm thất bại');
            header('location: /admin/categogies/create');
            // exit;
        }
    }

    //--------------EDIT--------------------
    public static function edit(int $id)
    {
        $categogy = new CategoryModel();
        $data = $categogy->getOneCategory($id);
        if ($data) {
            Header::render();
            Notification::render();
            NotificationHelper::unset();
            Edit::render($data);
            Footer::render();
        } else {
            header('location: /admin/categories');
        }
    }
    // xử lý chức năng sửa (cập nhật)
    public static function update(int $id)
    {
        $is_valid = true;
        $errors = [];
        if (empty($_POST["name"])) {
            $errors['name'] = "Tên danh mục không được để trống.";
            $is_valid = false;
        } else {
            $name = $_POST["name"];
            if (strlen($name) < 5) {
                $errors['name'] = "Tên danh mục phải có ít nhất 5 ký tự.";
                $is_valid = false;
            }
        }
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            $errors['status'] = 'Không được để trống trạng thái';
            $is_valid = false;
        }

        // Lưu lỗi vào session_start
        if (!$is_valid) {
            $_SESSION['errors'] = $errors;
        }

        if ($is_valid) {
            $category = new CategoryModel();
            $is_exist = $category->getOneCategoryByName($_POST['name']);
            if ($is_exist && $is_exist['id'] != $id) {
                NotificationHelper::error('name', 'Tên loại sản phẩm đã tồn tại');
                //       chuyển hướng đến trang sửa
                header("location: /admin/categories/$id");
            } else {

                $data = [
                    'name' => $_POST['name'],
                    'status' => $_POST['status']
                ];

                $is_upload = CategogyValidation::image();
                if ($is_upload) {
                    $data['image'] = $is_upload;
                }
            }
            $result = $category->updateCategory($id, $data);

            if ($result) {
                // echo 'Thành công';
                NotificationHelper::success('update', 'Cập nhật thành công');
            } else {
                NotificationHelper::error('update', 'Cập nhật thất bại');
            }
            header('location: /admin/categories');
            // }
        } else {
            // chuyển hướng đến trang sửa
            header("location: /admin/categories/$id");
        }
    }

    public static function delete(int $id)
    {
         $is_valid = CategogyValidation::delete();
    
    if ($is_valid) {
        $category = new CategoryModel();
        $result = $category->deleteCategory($id);

        if ($result) {
            NotificationHelper::success('category', 'Xóa danh mục thành công');
        } else {
            NotificationHelper::error('category', 'danh mục này là danh mục mặc định klhoong thể xóa !!!.');
        }
    } 
        header("Location:/admin/categories");

        var_dump($result);
        // header('location: /admin/categories');
    }
    // -------------------- SEARCH----------------
    public static function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $category = new CategoryModel();
        $categories = $category->searchByKeywordCategogy($keyword);
        $category = $category->getAllCategory();

        $data = [
            'keyword' => $keyword,
            'categories' => $categories,
            'allCategories' => $category
        ];
        Header::render();
        Search::render($data);
        Footer::render();
    }
}
