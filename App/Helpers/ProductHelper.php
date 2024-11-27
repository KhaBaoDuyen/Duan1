<?php
namespace App\Helpers;

use App\Models\ProductModel;

class ProductHelper
{
   public static function register($data)
   {

      $product = new ProductModel();
      $is_exist = $product->getOneProduct($data['name']);
      if ($is_exist) {
         NotificationHelper::error('register', 'Tên đăng nhập  đã tồn tại');
         return false;
      } else {
         $result = $product->createProduct($data);

         // kiểm tra kết quả
         if ($result) {
            NotificationHelper::success('register', 'Đăng ký thành công');
            return true;
            //   header('location: /Account');
         } else {
            NotificationHelper::error('register', 'Đăng ký thất bại');
            return false;
            //   header('location: /Account');
         }
      }
   }
   // --------------- LOGIN ---------------
   public static function login($data)
   {
      //KIỂM TRA TỒN TẠI USERNAME TRONG DÂTABASE
// => nếu không trả về false , thông báo 
      $product = new ProductModel();
      // BẮT LỖI TỒN TẠI USERNAME
      $is_exist = $product->getOneProductByProductname($data['productname']);
      if (!$is_exist) {
         NotificationHelper::error('login', 'Tên đăng nhập không tồn tại');
         return false;
      }
      // => nếu có : kiểm ra xem pasword có trùng không => nếu không : trả về flase
// password người dùng nhập $data['pasword'];
// pasword trong csdl $is_exist['pasword'];
      if (!password_verify($data['password'], $is_exist['password'])) {
         NotificationHelper::error('login', 'Mật khẩu không đúng');
         return false;
      }
      // => nếu có : kiểm tra status ==1 => nếu không trả về flase 
// trangj thasi  trong csdl $is_exist['status'];
      if ($is_exist['status'] != 1) {
         NotificationHelper::error('status', 'Tài khoản đã bị khóa');
         return false;
      }
      // => nếu có : ktr remember, lưu section/cookie => trả về true, thông báo thành công
      $_SESSION['product'] = $is_exist;
      if ($data['remember']) {
         // lưu cookie
      } else {
         // lưu section

      }
      return true;
   }

   // ----------- LẤY LẠI MẬT KHẨU -------
   public static function ForgotPassword($data)
   {
      $product = new ProductModel();
      $result = $product->getOneProductByProductname($data['productname']);
      return $result;
   }

   public static function ResetPassword($data)
   {
      $product = new ProductModel();
      $result = $product->updateProductByProductnameAndEmail($data);
      return $result;
   }
   // ----------- UPDATE SESSION AND COOKIE -------
   public static function updateCookie($id)
   {

      $product = new ProductModel();
      $result = $product->getOneProduct($id);
      if ($result) {
         // chuyển array thành string để lưu vào cookie product 
         $product_data = json_encode($result);
         // lưu cookie 
         setcookie('product', $product_data, time() + 3600 * 24 * 30 * 12, '/');
      }
   }
   public static function updateSession($id)
   {

      $product = new ProductModel();
      $result = $product->getOneProduct($id);
      if ($result) {
         $_SESSION['product'] = $result;
         // echo 'update session';
      }
   }
   // ----------- CHECK LOGIN -------
   public static function checkLogin()
   {
      if (isset($_COOKIE['product'])) {
         $product = $_COOKIE['product'];
         $product_data = json_decode($product, true);
         $_SESSION['product'] = $product_data;
         return true;
      } elseif (isset($_SESSION['product'])) {
         return true;
      } else {
         return false;
      }
   }
   // ----------- ĐĂNG XUẤT -------
   public static function logout()
   {
      unset($_SESSION['product']);
      if (isset($_COOKIE['product'])) {
         setcookie('product', '', time() - 3600 * 24 * 30 * 12, '/');
      }
      NotificationHelper::success('logout', 'Đăng xuất thành công');
      header('location: /');
   }
   // ----------- EDIT -------
   public static function profile($id): bool
   {
      if (!self::checkLogin()) {
         NotificationHelper::error('login', 'Bạn phải đăng nhập để thực hiện chức năng này');
         return false;
      }
      $data = $_SESSION['product'];
      $id_product = $data['id_product'];

      if (isset($_COOKIE['product'])) {
         self::updateCookie($id_product);
      }

      self::updateSession($id_product);

      if ($id_product != $id) {
         NotificationHelper::error('id_product', 'Lỗi không có quyên xem thông tin tài khoảng này ');
         return false;
      }
      return true;
   }
   //------------------UPDATE-----------------
   public static function update($id, $data)
   {
      $product = new ProductModel();
      $result = $product->update($id, $data);
      if (!$result) {
         NotificationHelper::error('update', 'Cập nhật thông tin thất bại');
         return false;
      }

      if ($_SESSION['product']) {
         self::updateSession($id);
      }
      if ($_COOKIE['product']) {
         self::updateCookie($id);
      }
      NotificationHelper::success('update', 'Cập nhật thông tin thành công');
      return true;
   }
   //------ BẮT TÀI KHOẢN ĐĂNG NHẬP
   public static function middleware()
   {
      // var_dump($_SERVER['REQUEST_URI']);
      $admin = explode('/', $_SERVER['REQUEST_URI']);
      // var_dump($admin);
      $admin = $admin[1];
      if ($admin == 'admin') {
         //    if (!isset($_SESSION['productname']) || $_SESSION['productname']['role'] != 1) {
         //       NotificationHelper::error('admin', 'Tài khoản này không có quyền truy cập tranh quan trị!!');
         //       header('location: /Account');
         //       exit();
         //    }    
         if (!isset($_SESSION['product'])) {
            NotificationHelper::error('admin', 'Bạn phải đăng nhập ');
            header('location: /Account');
            exit;
         }
         if ($_SESSION['product']['role'] != 1) {
            NotificationHelper::error('admin', 'Tài khoản này không có quyền truy cập trang quản trị!!');
            header('location: /Account');
            exit;
         }

      }
   }




}

?>