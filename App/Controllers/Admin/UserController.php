<?php

namespace App\Controllers\Admin;

use App\Helpers\AuthHelper;
use App\Helpers\NotificationHelper;
use App\Models\UserModel;
use App\Validation\AuthValidation;
use App\Validation\UserValidation;
use App\Models\CategoryModel;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
// use App\Views\Admin\Pages\User\Category as UserCategory;
use App\Views\Admin\Pages\User\Shop;
use App\Views\Admin\Pages\User\Index;
use App\Views\Admin\Pages\User\Search;
use App\Views\Admin\Pages\User\Edit;
use App\Views\Admin\Pages\User\Detail;

class UserController
{
    public static function Index()
    {
        $products = new UserModel();
        $data = $products->getAllUser();

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }

    // ------- EDIT ------------------

    public static function edit($id)
    {
        $user = new UserModel();
        $data = $user->getOneUser($id);

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Edit::render($data);
        Footer::render();
    }


    public static function update($id)
    {
        $is_valid = UserValidation::update($id);
        if (!$is_valid) {
            NotificationHelper::error('update_user', 'Cập nhật thông tin thất bại');
            header("Location:/admin/users/$id");
            exit;
        }
        $data = [
            'username' => $_POST['username'],
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'role' => $_POST['role'],
            'status' => $_POST['status'],
        ];
        var_dump($data);
        // ktr update hình ảnh 
        $is_upload = UserValidation::avatar();
        if ($is_upload) {
            $data['avatar'] = $is_upload;
        }
        $product = new UserModel();
        $result = $product->updateUser($id, $data);

        if ($result) {
            NotificationHelper::success('user', 'Cập nhật thành công');
            header('Location: /admin/users');
        } else {
            NotificationHelper::success('user', 'Cập nhật thất bại');
            header("Location: /admin/users/$id");
            exit();
        }
    }

    // thực hiện xoá
    public static function delete($id)
    {
        $user = new UserModel();
        $result = $user->deleteUser($id);
        if ($result) {
            // echo 'Xoá thành công';
            NotificationHelper::success('user', 'Xoá thành công');
        } else {
            NotificationHelper::error('user', 'Xoá thất bại');
        }
        header('location: /admin/users');
    }

    //--------------- SEARCH----------------
    public static function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $user = new UserModel();

        $users = $user->searchByKeywordUser($keyword);
        $user = $user->getAllUser();

        $data = [
            'keyword' => $keyword,
            'users' => $users,
            'alluser' => $user
        ];

        // var_dump($data['keyword']);
        // var_dump($data['users']);

        Header::render();
        Search::render($data);
        Footer::render();
    }

   // ------------- LOGOUT ----------------
  public static function logout()
{
    AuthHelper::logout();
    NotificationHelper::success('logout', 'Đăng xuất thành công');
    header('Location: /');
    exit;
}

}
