<?php

namespace App\Controllers\Client;


use App\Helpers\AuthHelper;
use App\Helpers\NotificationHelper;
use App\Validation\AuthValidation;
use App\Validation\CommentValidation;
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
// use App\Views\Client\Pages\Comment\Category as CommentCategory;
use App\Views\Client\Pages\Comment\Shop;
use App\Views\Client\Pages\Comment\Index;
use App\Views\Client\Pages\Comment\Create;
use App\Views\Client\Pages\Comment\Edit;
use App\Views\Client\Pages\Comment\Detail;

class CommentController
{
    public static function Index()
    {
        // $comment = new CommentModel();
        // $data = $comment->getAllCommentJoinCategory();
        // Header::render();
        // Notification::render();
        // NotificationHelper::unset();
        // Index::render($data);
        // Footer::render();
    }
    //------------ CREATE-------------

    // xử lý chức năng thêm
    public static function store()
    {   // Lấy dữ liệu từ form
        $id_product = $_POST['id_product'];
        $is_valid = CommentValidation::createClient();

        // Kiểm tra tính hợp lệ của dữ liệu
        if (!$is_valid) {
            NotificationHelper::error('store', 'Thêm thất bại thông tin thất bại');
            header("Location:/product/$id_product");
        } else {
            header("Location:/product/$id_product");
        }

    
        $data = [
            'content' => $_POST['content'],
            'id_product' => $_POST['id_product'],
            'id_user' => $_POST['id_user'],
        
        ];

        $comment = new CommentModel();
        $result = $comment->createComment($data);
        // var_dump($result);
        // die;
        if ($result) {
            NotificationHelper::success('product', 'Thêm thành công');
        } else {
            NotificationHelper::error('product', 'Thêm thất bại');
        }

        if (isset($_POST['id_product']) && $_POST['id_product']) {
            $id_product = $_POST['id_product'];
            header("Location:/product/$id_product");
        } else {
            $id_product = $_POST['id_product'];
            header("Location:/product/$id_product");

        }
    }
    // ------- EDIT ------------------

    // xử lý chức năng sửa (cập nhật)
    public static function update($id)
    {
         $is_valid = CommentValidation::updateClient($id);
               if (!$is_valid) {
            NotificationHelper::error('update', 'Thêm thất bại thông tin thất bại');
            if (isset($_POST['id_product']) && $_POST['id_product']) {
                $id_product = $_POST['id_product'];
                header("Location:/product/$id_product");
            }else{
                $id_product = $_POST['id_product'];
                 header("Location:/product/$id_product");
}
 }
           $data = [
            'content' => $_POST['content'],
        ];

        $coment = new CommentModel();
        $result = $coment->updateComment($id, $data);

         if ($result) {
            NotificationHelper::success('update', 'Đã sửa thành công');
        } else {
            NotificationHelper::error('update', 'Sửa thất bại');
        }

           if (isset($_POST['id_product']) && $_POST['id_product']) {
                $id_product = $_POST['id_product'];
                header("Location:/product/$id_product");
            }else{
                $id_product = $_POST['id_product'];
                 header("Location:/product/$id_product");
}
              
    }

    // thực hiện xoá
    public static function delete($id)
    {
        // Khởi tạo đối tượng CommentModel và gọi phương thức delete
        $product = new CommentModel();
        $result = $product->deleteComment($id); // Xoá bình luận với ID tương ứng
    
        // Kiểm tra kết quả xoá
        if ($result) {
            NotificationHelper::success('product', 'Xoá bình luận thành công');
        } else {
            NotificationHelper::error('product', 'Xoá bình luận thất bại');
        }
    
        // Điều hướng lại về trang sản phẩm sau khi xoá
        if (isset($_POST['id_product']) && $_POST['id_product']) {
            $id_product = $_POST['id_product'];
            header("Location:/product/$id_product"); // Điều hướng đến trang sản phẩm
        } else {
            // Nếu không có id_product, vẫn điều hướng về trang sản phẩm mặc định
            $id_product = $_POST['id_product'];
            header("Location:/product/$id_product");
        }
    }
}


