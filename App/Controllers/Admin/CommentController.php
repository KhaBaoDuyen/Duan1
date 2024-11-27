<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Comment;
use App\Models\CommentModel;
use App\Validation\CommentValidation;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Pages\Comment\Edit;
use App\Views\Admin\Pages\Comment\Index;

class CommentController
{

    // hiển thị danh sách
    public static function index()
    {
        $comment = new CommentModel();
        $data = $comment->getAllCommentJoinProductAndUser();
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }





    // hiển thị giao diện form sửa
    public static function edit(int $id)
    {
        // khởi tạo đối tượng model
        $comment = new CommentModel();
        $data = $comment->getOneCommentJoinProductAndUser($id);

        if (!$data) {
            NotificationHelper::error('comment', 'Không tìm thấy comment');
            header('location: /admin/comments');
            exit;
        }
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Edit::render($data);
        Footer::render();
    }
    // xử lý chức năng sửa (cập nhật)




    public static function update(int $id)
    {
        $is_valid = true;
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Không để trống trạng thái');
            $is_valid = false;
        }

        if ($is_valid) {
            $data = [
                'status' => $_POST['status']
            ];

            $comment = new CommentModel();
          
            
            $result = $comment->updateComment($id,$data);
            // echo "<pre>";
            // print_r($result);
            // die;
            if ($result) {
                // echo 'Thành công';
                NotificationHelper::success('comment', 'Cập nhật thành công');
            } else {
                NotificationHelper::error('comment', 'Cập nhật thất bại');
            }
            header('location: /admin/comments');
        } else {
            // chuyển hướng đến trang sửa
            header("location: /admin/comments/$id");
        }
    }


    // thực hiện xoá
    public static function delete(int $id)
    {
        $comment = new CommentModel();
        $result = $comment->deleteComment($id);
        if ($result) {
            // echo 'Xoá thành công';
            NotificationHelper::success('comment', 'Xoá thành công');
        } else {
            NotificationHelper::error('comment', 'Xoá thất bại');
        }

        header('location: /admin/comments');
    }
}
