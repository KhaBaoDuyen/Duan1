<?php

namespace App\Views\Client\Layouts;

use App\Views\BaseView;

class Footer extends BaseView
{
    public static function render($data = null)
    {
        ?>
   <footer class="col-10 m-auto">
      <div class="footer_top ">
         <div class="footer_top_icon">
            <img src="/public/assets/Client/image/icon/icon_footer_1.svg" alt="" width="100px">
            <p>Thanh toán khi nhận hàng</p>
         </div>
         <div class="footer_top_icon">
            <img src="/public/assets/Client/image/icon/icon_footer_2.svg" alt="" width="140px">
            <p>Giao hàng nhanh miễn phí </p>
         </div>
         <div class="footer_top_icon">
            <img src="/public/assets/Client/image/icon/icon_footer_3_200x200.png" alt="" width="100px">
            <p>30 ngày đổi trả miễn phí </p>
         </div>
         <div class="footer_top_icon">
            <img src="/public/assets/Client/image/icon/icon_footer_4.svg" alt="" width="100px">
            <p> Thương hiệu uy tín toàn cầu</p>
         </div>
      </div>
      <div class="footer_bottom m-auto">
         <div class="col-8 row m-auto">
            <div class="col-4">
               <Ul class="menu_footer"><a href="">Về Bloom</a>
                  <li><a href="">Giới thiệu Bloom</a></li>
                  <li><a href="">Tuyển Dụng</a></li>
                  <li><a href="">Chính sách bảo mật</a></li>
                  <li><a href="">Điều khoản sử dụng</a></li>
                  <li><a href="">Liên hệ</a></li>
               </Ul>
            </div>
            <div class="col-4">
               <Ul class="menu_footer"><a href="">Hỗ trợ khách hàng</a>
                  <li><a href="">Gửi yêu cầu hỗ trợ</a></li>
                  <li><a href="">Hướng dẫn đặt hàng</a></li>
                  <li><a href="">Phương thức vận chuyển</a></li>
                  <li><a href="">Chính sách đổi trả</a></li>
               </Ul>
            </div>
            <div class="col-4">
               <Ul class="menu_footer"><a href="">Nước Hoa</a>
                  <li><a href="">Nước Hoa Nữ </a></li>
                  <li><a href=""> Nước Hoa Nam </a></li>
                  <li><a href=""> Xịt Thơm Toàn Thân</a></li>

               </Ul>
            </div>
         </div>
      </div>
   </footer>

   <script src="/public/assets/Client/Js/slide.js"></script>
   <script src="/public/assets/Client/Js/cart.js"></script>
   <script src="/public/assets/Client/Js/login.js"></script>
</body>
</html>

        <?php

        // unset($_SESSION['success']);
        // unset($_SESSION['error']);
    }
}

?>