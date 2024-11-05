<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\CategoryModel;
use App\Validation\CategogyValidation;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Category\Create;
use App\Views\Admin\Pages\Category\Edit;
use App\Views\Admin\Pages\Category\Index;

class CategoryController
{

    // hiển thị danh sách
    public static function index()
    {
        $categories = new CategoryModel();
        $data = $categories->getAllCategory();
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }

    //--------------CREATE--------------------
    // hiển thị giao diện form thêm
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
        if (!$is_valid) {
            NotificationHelper::error('store', 'Thêm thất bại thông tin thất bại');
            header("Location:/admin/categories/create");
            exit;
        }
        $name = $_POST['name'];
        $status = $_POST['status'];

        $categogy = new CategoryModel();
        $is_exist = $categogy->getOneCategoryByName($name);

        if ($is_exist) {
            NotificationHelper::error('store', 'Tên loại sản phẩm đã tồn tại');
            header("Location:/admin/categories/create");
            exit;
        }

        // thujw hiện thêm
        $data = [
            'name' => $name,
            'status' => $status,
        ];
        $result = $categogy->createCategory($data);
        if ($result) {
            NotificationHelper::success('store', 'Thêm mới thành công');
            header("Location:/admin/categories");
            exit;
        } else {
            NotificationHelper::error('store', 'Thêm mới thất bại');
            header("Location:/admin/categories/create");
            exit;
        }
    }

    //--------------EDIT--------------------
    // hiển thị giao diện form sửa
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
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Không để trống tên');
            $is_valid = false;
        }
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Không để trống trạng thái');
            $is_valid = false;
        }

        if ($is_valid) {

            // khởi tạo đối tượng model
            $category = new CategoryModel();

            $is_exist = $category->getOneCategoryByName($_POST['name']);

            if ($is_exist && $is_exist['category_id '] != $id) {
                NotificationHelper::error('name', 'Tên loại sản phẩm đã tồn tại');
         //       chuyển hướng đến trang sửa
                header("location: /admin/categories/$id");
            } else {

                $data = [
                    'name' => $_POST['name'],
                    'status' => $_POST['status']
                ];
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

    // thực hiện xoá
    public static function delete(int $id)
    {
        $category = new CategoryModel();
        $result = $category->deleteCategory($id);
        if ($result) {
            // echo 'Xoá thành công';
            NotificationHelper::success('category', 'Xoá thành công');
        } else {
            NotificationHelper::error('category', 'Xoá thất bại');
        }

        header('location: /admin/categories');
    }

}
