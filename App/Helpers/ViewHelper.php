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

      $product_id_arr = array_column($view_data, 'product_id');

//       echo'<pre>';
// var_dump($view_data);
      // ktr product_id có tồn tại chưa 
      if (in_array($id, $product_id_arr)) {
         foreach ($view_data as $key => $value) {
            if ($view_data[$key]['product_id'] == $id) {
               if ($view_data[$key]['time'] < time() - 60 * 5) {
                  $view++;
               }

               $view_data[$key]['time'] = time();
            }
         }
      } else {
         // nếu chưa có cookies
         $product_array[] = [
            'product_id' => $id,
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