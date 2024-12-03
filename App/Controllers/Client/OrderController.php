<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;
use App\Views\Client\Components\Search;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\UserModel;
use App\Views\Client\Pages\Cart\Checkout;
use App\Views\Client\Contact;
use App\Views\Client\Pages\Blogs\Instruction;
use App\Views\Client\About;
use App\Views\Client\Layouts\Header;

class OrderController
{

   public static function checkout()
   {
      //  echo "</pre>";
//       print_r($_SESSION['checkout']);
      $data = $_SESSION['checkout'];

      Header::render();
      Checkout::render($data);
      Footer::render();
   }

   public static function store()
   {
      print_r(__METHOD__);
      echo '<pre>';
      print_r($_POST);
      echo '</pre>';


      if (empty($_SESSION['checkout'])) {
         echo "Giỏ hàng trống. Không thể tạo đơn hàng.";
         return;
      }
        
      $orderModel = new OrderModel();
      $data = [
         'name' => $_POST['name'],
         'email' => $_POST['email'],
         'phone' => $_POST['phone'],
         'address' => $_POST['address'],
         'total' => $_POST['total'],
         'id_user' => $_SESSION['user']['id'],
         'pay' => $_POST['iCheck'],
      ];

      $id_order = $orderModel->createOrder($data);

      echo '<pre>';
      print_r($_SESSION['checkout']);
      echo '</pre>';

      foreach ($_SESSION['checkout'] as $i => $item) {
         if (isset($item['variant_name']) && isset($item['variant_price'])) {
            $price = $item['variant_price'];
         } elseif (isset($item['product_discount_price'])) {
            $price = $item['product_discount_price'];
         } elseif (isset($item['product_price'])) {
            $price = $item['product_price'];
         } else {
            echo "Lỗi: Không tìm thấy giá cho sản phẩm tại chỉ mục $i.";
            continue;
         }

         $data = [
            'id_order' => $id_order,
            'id_product' => $item['id_product'],
            'quantity' => $item['quantity'],
            'price' => $price,
            'variant_key' => $item['variant_name'] ?? '',
         ];

         echo '<pre>';
         print_r($data);
         echo '</pre>';
         $result = $orderModel->createOrderDetail($data);

         if (!$result) {
            echo "Lỗi khi thêm  đơn hàng tại chỉ mục $i.";
            break;
         }
      }

      if (isset($result) && $result) {
         echo "Thêm  đơn hàng thành công.";
      } else {
         echo "Không thể thêm đơn hàng.";
      }
   }

}
?>