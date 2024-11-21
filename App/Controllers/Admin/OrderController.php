<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Validation\AuthValidation;
use App\Validation\ProductValidation;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
// use App\Views\Admin\Pages\Product\Category as ProductCategory;
use App\Views\Admin\Pages\Order\Shop;
use App\Views\Admin\Pages\Order\Index;
use App\Views\Admin\Pages\Order\Create;
use App\Views\Admin\Pages\Order\Edit;
use App\Views\Admin\Pages\Order\Detail;

class OrderController
{
    public static function Index()
    {
       /*  $products = new ProductModel();
        $data = $products->getAllProductJoinCategory(); */
        Header::render();
        /* Notification::render();
        NotificationHelper::unset(); */
        Index::render();
        Footer::render();
    }
    //------------ [ CREATE ]-------------
   /* public static function create()
    {
        $categories = new CategoryModel();
        $data = $categories->getAllCategory();
        $data = $categories->getAllProductJoinCategory();
        Header::render();
       Notification::render();
        NotificationHelper::unset();
        Create::render();
        Footer::render();
    } */
    //------------ [ STORE ]-------------
     /* public static function store()
    {
        $is_valid = ProductValidation::create();
        if ($is_valid) {
            $product = new ProductModel();
            $is_exist = $product->getOneProductByName($_POST['name']);
        } else {
            NotificationHelper::error('store', 'Thêm thất bại thông tin thất bại');
            header("Location:/admin/products/create");
            exit;
        }
        if ($is_exist) {
            NotificationHelper::error('store', 'Tên sản phẩm đã tồn tại');
            // chuyển hướng đến trang thêm
            header('location: /admin/products/create');
            exit;
        }
        $data = [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'discount_price' => $_POST['discount_price'],
            'is_featured' => $_POST['is_featured'],
            'category_id' => $_POST['categories_id'],
            'status' => $_POST['status'],
        ];

        $is_upload = ProductValidation::image();
        if ($is_upload) {
            $data['image'] = $is_upload;
        }
        // var_dump($data);
        $result = $product->createProduct($data);
        if ($result) {
            NotificationHelper::success('product', 'Thêm thành công');
            header('location: /admin/Product');
        } else {
            NotificationHelper::error('product', 'Thêm thất bại');
            exit;
        }
    }

    // ------------ EDIT ------------------
    public static function edit($id)
    {
        $category = new CategoryModel();
        $data['category'] = $category->getAllCategory();

        $product = new ProductModel();
        $data['product'] = $product->getOneProduct($id);

        // var_dump($data);
        if ($data['product']) {
            Header::render();
            Notification::render();
            NotificationHelper::unset();
            Edit::render($data);
            Footer::render();
        } else {
            NotificationHelper::error('product', 'Không có sản phẩm này');
            header('location: /admin/products');
        }
    }

    // xử lý chức năng sửa (cập nhật)
    public static function update($id)
    {
        $is_valid = ProductValidation::update($id);
        if ($is_valid) {
            $product = new ProductModel();
            $is_exist = $product->getOneProductByName($_POST['name']);
        } else {
            NotificationHelper::error('store', 'Cập nhật thông tin thất bại');
            header("Location:/admin/products/$id");
            exit;
        }

        $data = [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'discount_price' => $_POST['discount_price'],
            'is_featured' => $_POST['is_featured'],
            'category_id' => $_POST['categories_id'],
            'status' => $_POST['status'],
        ];

        // ktr update hình ảnh 
        $is_upload = ProductValidation::image();
        if ($is_upload) {
            $data['image'] = $is_upload;
        }
        $product = new ProductModel();
        $result = $product->updateProduct($id, $data);

        if ($result) {
            NotificationHelper::success('product', 'Cập nhật thành công');
            //  header('Location:/admin/products');
        } else {
            NotificationHelper::success('product', 'Cập nhật thất bại');
            header("location: /admin/products/$id");
        }

        if ($result) {
            header("Location:/admin/Product");
        }

    }

    // thực hiện xoá
    public static function delete($id)
    {
        $product = new ProductModel();
        $result = $product->deleteProduct($id);
        if ($result) {
            // echo 'Xoá thành công';
            NotificationHelper::success('product', 'Xoá thành công');
        } else {
            NotificationHelper::error('product', 'Xoá thất bại');
        }
        header('location: /admin/Product');
    }
 */

}


