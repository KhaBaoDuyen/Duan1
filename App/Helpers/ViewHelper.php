<?php
namespace App\Helpers;
use App\Models\ProductModel;

class ViewHelper
{

   public static function cookieView($id, $view)
   {
      if (isset($_COOKIE['view'])) {
         $view_data = json_decode($_COOKIE['view'], true);
      } else {
         $view_data = [];
      }

      $id_product_arr = array_column($view_data, 'id_product');

//       echo'<pre>';
// var_dump($view_data);
      // ktr id_product có tồn tại chưa 
      if (in_array($id, $id_product_arr)) {
         foreach ($view_data as $key => $value) {
            if ($view_data[$key]['id_product'] == $id) {
               if ($view_data[$key]['time'] < time() - 60 * 5) {
                  $view++;
               }

               $view_data[$key]['time'] = time();
            }
         }
      } else {
         // nếu chưa có cookies
         $product_array[] = [
            'id_product' => $id,
            'time' => time()
         ];
         $view++;

         $view_data[] = $product_array;
      }
      $product_data = json_encode($view_data);

      setcookie('view', $product_data, time() + 3600 * 24 * 30 * 12, '/');

      return self::updateView($id,$view);
   }

   public static function updateView($id,$view){
$product = new ProductModel();
$data=[
    'view' => $view
];
$result = $product -> updateProduct($id, $data);
}
}
?>