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
use App\Views\Client\Pages\Cart\Thanks;

require_once('App/Controllers/vnpay_php/config.php');

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
      // echo '<pre>';
      // print_r($_POST);
      // echo '</pre>';

      $pay = $_POST['iCheck'];
      $orderModel = new OrderModel();
      $data = [
         'name' => $_POST['name'],
         'email' => $_POST['email'],
         'phone' => $_POST['phone'],
         'address' => $_POST['address'],
         'total' => $_POST['total'],
         'id_user' => $_SESSION['user']['id'],
         'pay' => $pay,
      ];

      // echo '<pre>';
      // print_r($data);
      // echo '</pre>';
      // die;
      $_SESSION['order_details'] = $data;
      $id_order = $orderModel->createOrder($data);
      if ($pay == 1 || $pay == 2) {
         // echo '<pre>';
         // print_r($_SESSION['checkout']);
         // die;
         // echo '</pre>';

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


            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
         }
      }
      $_SESSION['order'] = $id_order;

      if ($pay == 1) {
         echo "thanh toan tien mat";
         $result = $orderModel->createOrderDetail($data);
         if (isset($result) && $result) {

            header('Location: /thank');
            die();

         } else {
            echo "Không thể thêm đơn hàng.";
         }

      } elseif ($pay == 2) {
         echo "thanh toan qua ngan hang";
         error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
         date_default_timezone_set('Asia/Ho_Chi_Minh');

         $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
         $vnp_Returnurl = "http://127.0.0.1:8080/thank";
         $vnp_TmnCode = "93C1R7BU";//Mã website tại VNPAY 
         $vnp_HashSecret = "PRLPKSJKMOK3KXJD0QBQENKE03EE6AIT"; //Chuỗi bí mật
         $startTime = date("YmdHis");
         $expire = date('YmdHis', strtotime('+5 minutes', strtotime($startTime)));


         $vnp_TxnRef = $id_order; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này   sang VNPAY
         $vnp_OrderInfo = 'Thanh toan don hang ';
         $vnp_OrderType = 'Thanh toan vnpay';
         $vnp_Amount = $_POST['total'] * 100;
         $vnp_Locale = 'vn';
         $vnp_BankCode = 'NCB';
         $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
         //Add Params of 2.0.1 Version
         $vnp_ExpireDate = $expire;
         $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate,
         );

         if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
         }

         //var_dump($inputData);
         ksort($inputData);
         $query = "";
         $i = 0;
         $hashdata = "";
         foreach ($inputData as $key => $value) {
            if ($i == 1) {
               $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
               $hashdata .= urlencode($key) . "=" . urlencode($value);
               $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
         }

         $vnp_Url = $vnp_Url . "?" . $query;
         if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
         }
         $returnData = array(
            'code' => '00'
            ,
            'message' => 'success'
            ,
            'data' => $vnp_Url
         );
         if (isset($_POST['redirect'])) {
            $_SESSION['order'] = $id_order;
            header('Location: ' . $vnp_Url);
            $result = $orderModel->createOrderDetail($data);

            die();
         } else {
            echo json_encode($returnData);
         }
         // vui lòng tham khảo thêm tại code demo

      } else {
         echo "thanh toan loi";
      }

      // if (isset($result) && $result) {
      //    echo "Thêm  đơn hàng thành công.";

      // } else {
      //    echo "Không thể thêm đơn hàng.";
      // }
   }


   public static function thank()
   {
      // echo "<pre>";
      // print_r( $_SESSION['order_details']);
      // print_r($_SESSION['order']);
      // print_r($_SESSION['user']);
      // print_r($_SESSION['checkout']);
      // die;
      $orderModel = new OrderModel();

      if (isset($_GET['vnp_Amount'])) {
         $data = [
            'id_order' => $_SESSION['order'],
            'cardtype' => $_GET['vnp_CardType'],
            'banktranno' => $_GET['vnp_BankTranNo'],
            'bankcode' => $_GET['vnp_BankCode'],
            'paydate' => $_GET['vnp_PayDate'],
         ];
         // echo '<pre>';
         // var_dump($_SESSION['user']['id'], $_SESSION['order']);
         // echo '</pre>';
         // die;
         $orderModel->createOrderByVnpay($data);
         $bill = $orderModel->getLastBillByVnpay($_SESSION['user']['id'], $_SESSION['order']);
         // echo "<pre>";
         // print_r($bill);
         // die;
      } else {
         // $orderModel->createOrderByVnpay($data);
         $bill = $orderModel->getLastOrder($_SESSION['user']['id'], $_SESSION['order']);
      }


      $data = [
         'bill' => $bill,
         'order' => $_SESSION['checkout'],
         'id_order' => $_SESSION['order']
      ];

      Header::render();
      Thanks::render($data);
      Footer::render();
      //  echo "<pre>";
//       print_r($bill);
//       // // print_r($data['order']);
//       die;
   }


}
