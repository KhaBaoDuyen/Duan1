<?php
namespace App\Helpers;

use App\Models\UserModel;

class AuthHelper
{
   public static function register($data)
   {
       $user = new UserModel();
       $is_exist = $user->getOneUserByUsername($data['username']);

       if ($is_exist) {
           NotificationHelper::error('exist_register', 'Tên đăng nhập đã tồn tại');
           return false;
       }

       $result = $user->createUser($data);

       if ($result) {
           NotificationHelper::success('register', 'Đăng ký thành công');
           return true;
       }
       NotificationHelper::error('register', 'Đăng ký thất bại');
       return false;
   }
   // --------------- LOGIN ---------------
   public static function login($data)
    {
        $user = new UserModel();
        $is_exist = $user->getOneUserByUsername($data['username']);

        if (!$is_exist) {
            echo 'Tên tài khoản không tồn tại';
            return false;
        }

        if (!password_verify($data['password'], $is_exist['password'])) {
            echo 'Mật khẩu sai';
            return false;
        }

        if ($is_exist['status'] == 0) {
            echo 'Tài khoản đã bị khóa';
            return false;
        }

        if ($data['remember']) {
            self::updateCookie($is_exist['id']);
        } else {
            self::updateSession($is_exist['id']);
        }
        NotificationHelper::success('login', 'Đăng nhập thành công');
        return true;
    }

   // ----------- LẤY LẠI MẬT KHẨU -------
   public static function ForgotPassword($data)
   {
      $user = new UserModel();
      $result = $user->getOneUserByUsername($data['username']);
      return $result;
   }

   public static function ResetPassword($data)
   {
      $user = new UserModel();
      $result = $user->updateUserByUsernameAndEmail($data);
      return $result;
   }
   // ----------- UPDATE SESSION AND COOKIE -------
   public static function updateCookie($id)
   {

      $user = new UserModel();
      $result = $user->getOneUser($id);
      if ($result) {
         // chuyển array thành string để lưu vào cookie user 
         $user_data = json_encode($result);
         // lưu cookie 
         setcookie('user', $user_data, time() + 3600 * 24 * 30 * 12, '/');
      }
   }
   public static function updateSession($id)
   {

      $user = new UserModel();
      $result = $user->getOneUser($id);
      if ($result) {
         $_SESSION['user'] = $result;
         // echo 'update session';
      }
   }
   // ----------- CHECK LOGIN -------
   public static function checkLogin()
   {
      if (isset($_COOKIE['user'])) {
         $user = $_COOKIE['user'];
         $user_data = json_decode($user, true);
         $_SESSION['user'] = $user_data;
         return true;
      } elseif (isset($_SESSION['user'])) {
         return true;
      } else {
         return false;
      }
   }
   // ----------- ĐĂNG XUẤT -------
   public static function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        if (isset($_COOKIE['user'])) {
            setcookie('user', '', time() - 3600 * 24 * 30 * 12, '/');
        }
    }


   // ----------- EDIT -------
   public static function edit($id): bool
    {
        if (!self::checklogin()) {
            NotificationHelper::error('login', 'Vui lòng đăng nhập để xem thông tin');
            return false;
        }

        $data = $_SESSION['user'];
        $user_id = $data['id'];

        if ($user_id != $id) {
            NotificationHelper::error('user_id', 'Không có quyền xem thông tin tài khoản này');
            return false;
        }
        return true;
    }
   //------------------UPDATE-----------------
   public static function update($id, $data)
   {
      $user = new UserModel();
      $result = $user->update($id, $data);
      if (!$result) {
         NotificationHelper::error('update', 'Cập nhật thông tin thất bại');
         return false;
      }

      if ($_SESSION['user']) {
         self::updateSession($id);
      }
      if ($_COOKIE['user']) {
         self::updateCookie($id);
      }
      NotificationHelper::success('update', 'Cập nhật thông tin thành công');
      return true;
   }
   //------ BẮT TÀI KHOẢN ĐĂNG NHẬP
   /* public static function middleware()
   {
      // var_dump($_SERVER['REQUEST_URI']);
      $admin = explode('/', $_SERVER['REQUEST_URI']);
      // var_dump($admin);
      $admin = $admin[1];
      if ($admin == 'admin') {
         //    if (!isset($_SESSION['username']) || $_SESSION['username']['role'] != 1) {
         //       NotificationHelper::error('admin', 'Tài khoản này không có quyền truy cập tranh quan trị!!');
         //       header('location: /Account');
         //       exit();
         //    }    
         if (!isset($_SESSION['user'])) {
            NotificationHelper::error('admin', 'Bạn phải đăng nhập ');
            header('location: /Account');
            exit;
         }
         if ($_SESSION['user']['role'] != 1) {
            NotificationHelper::error('admin', 'Tài khoản này không có quyền truy cập trang quản trị!!');
            header('location: /Account');
            exit;
         }

      } */
   }






?> -->