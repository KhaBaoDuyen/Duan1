<?php

namespace App\Views\Client\Pages\Cart;

use App\Views\BaseView;
use App\Views\Client\Components\Menu as ComponentsMenu;
class History extends BaseView
{
  public static function render($data = null)
  {
    ?>
   <main class="p-2 profile d-flex justify-content-center align-items-center ">
      <section class="sec_profile d-flex col-10 p-3 ">
            <?php
            ComponentsMenu::render();
            ?>

       <article class="sec_historycart_right col-9 d-flex flex-column bg-white p-4">
            <h2 class="mt-3">Lịch sử mua hàng</h2>
            <table class="table mt-3">
               <thead>
                  <tr>
                     <th class="p-1">Mã đơn hàng</th>
                     <th>Ngày mua</th>
                     <th>Tổng tiền</th>
                     <th>Trạng thái</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>#001</td>
                     <td>01/11/2024</td>
                     <td>500.000 VNĐ</td>
                     <td>Đã giao</td>
                  </tr>
                  <tr>
                     <td>#002</td>
                     <td>15/10/2024</td>
                     <td>300.000 VNĐ</td>
                     <td>Đang xử lý</td>
                  </tr>
                  <tr>
                     <td>#003</td>
                     <td>20/09/2024</td>
                     <td>750.000 VNĐ</td>
                     <td>Đã giao</td>
                  </tr>
                  <tr>
                     <td>#004</td>
                     <td>20/09/2024</td>
                     <td>650.000 VNĐ</td>
                     <td>Đã Hủy</td>
                  </tr>
               </tbody>
            </table>
         </article>
      </section>

   </main>

  <?php }
} ?>