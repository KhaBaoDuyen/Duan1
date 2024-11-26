<?php

namespace App\Views\Client\Components;

use App\Views\BaseView;

class Menu extends BaseView
{
   public static function render($data = null)
   {
      ?>
      <aside class="sec_profile_left col-3 ">

         <div class="box_logo">
            <div class="logo"><img src="/public/assets/Client/image/icon/Logo2.png" alt>
            </div>
            <h3 class="mt-3">BLOOM</h3>
         </div>

         <ul class="menu">
            <li> <span class="material-symbols-outlined">
                  manage_accounts
               </span><a href="/user/<?= $_SESSION['user']['id'] ?>">Trang cá
                  nhân</a> </li>
            <li> <span class="material-symbols-outlined">
                  alarm
               </span><a href="/reminders">Lời nhắc</a> </li>

            <li><span class="material-symbols-outlined">
                  deployed_code_history
               </span> <a href="/history">Đơn hàng của
                  tôi</a> </li>
            <li><span class="material-symbols-outlined">
                  logout
               </span> <a href="/logout">Đăng
                  xuất</a>
            </li>

         </ul>
      </aside>
   <?php }
} ?>