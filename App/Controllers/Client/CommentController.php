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
    {
        $product_id = $_POST['product_id'];
        $is_valid = CommentValidation::createClient();
        if (!$is_valid) {
            NotificationHelper::error('store', 'Thêm thất bại thông tin thất bại');
            header("Location:/product/$product_id");
        } else {
            header("Location:/product/$product_id");
        }

        $data = [
            'content' => $_POST['content'],
            'product_id' => $_POST['product_id'],
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

        if (isset($_POST['product_id']) && $_POST['product_id']) {
            $product_id = $_POST['product_id'];
            header("Location:/product/$product_id");
        } else {
            $product_id = $_POST['product_id'];
            header("Location:/product/$product_id");

        }
    }
    // ------- EDIT ------------------
/* 
    // xử lý chức năng sửa (cập nhật)
    public static function update($id)
    {
         $is_valid = CommentValidation::updateClient($id);
               if (!$is_valid) {
            NotificationHelper::error('update', 'Thêm thất bại thông tin thất bại');
            if (isset($_POST['product_id']) && $_POST['product_id']) {
                $product_id = $_POST['product_id'];
                header("Location:/product/$product_id");
            }else{
                $product_id = $_POST['product_id'];
                 header("Location:/product/$product_id");
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

           if (isset($_POST['product_id']) && $_POST['product_id']) {
                $product_id = $_POST['product_id'];
                header("Location:/product/$product_id");
            }else{
                $product_id = $_POST['product_id'];
                 header("Location:/product/$product_id");
}
              
    }

    // thực hiện xoá
    public static function delete($id)
    {
        $product = new CommentModel();
        $result = $product->deleteComment($id);
        if ($result) {
            // echo 'Xoá thành công';
            NotificationHelper::success('product', 'Xoá thành công');
        } else {
            NotificationHelper::error('product', 'Xoá thất bại');
        }
            if (isset($_POST['product_id']) && $_POST['product_id']) {
                $product_id = $_POST['product_id'];
                header("Location:/product/$product_id");
            }else{
                $product_id = $_POST['product_id'];
                 header("Location:/product/$product_id");
    }
} */
}


