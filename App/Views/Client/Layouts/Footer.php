<?php

namespace App\Views\Client\Layouts;

use App\Views\BaseView;

class Footer extends BaseView
{
   public static function render($data = null)
   {
      $isLoggedIn = isset($_SESSION['user']);
      ?>
      <div class="reminder" id="reminder">
         <form action="/reminder" method="POST" class="mx-auto p-2 shadow-sm active" id="form" style="border-radius: 8px;"
            enctype="multipart/form-data">
            <input type="hidden" name="method" value="POST">
            <h5 class="text-center mb-2">Lên lịch nhắc nhở</h5>
            <div class="mb-2">
               <label for="title" class="form-label">Tiêu đề:</label>
               <input type="text" id="title" name="title" class="form-control" placeholder="Nhập tiêu đề">
            </div>
            <div class="mb-2">
               <label for="descriptionReminder" class="form-label">Mô tả:</label>
               <textarea id="description" name="description" class="form-control" placeholder="Nhập mô tả"></textarea>
            </div>
            <div class="mb-2">
               <label for="descriptionReminder" class="form-label">Lời nhắc sẽ được gửi về mail </label>
               <input id="user_id" name="user_id" class="form-control" type="hidden"
                  value="<?php echo htmlspecialchars($_SESSION['user']['id'] ?? ''); ?>" disabled>
               <input id="user_id" name="" class="form-control" type=""
                  value="<?php echo htmlspecialchars($_SESSION['user']['email'] ?? ''); ?>" disabled>
            </div>

            <div class="mb-2">
               <label for="reminder_date" class="form-label">Thời gian nhắc nhở:</label>
               <input type="time" id="reminder_date" name="reminder_date" class="form-control">
            </div>
            <!-- <div class="mb-2">
               <label for="repeatReminder" class="form-label">Lặp lại:</label>
               <select id="repeat_type" name="repeat_type" class="form-select">
                  <option value="none">Mỗi ngày</option>
                  <option value="weekly">1 tuần</option>
                  <option value="monthly">1 tháng</option>
               </select>
            </div> -->
            <button type="submit" class="btn btn-primary w-100">Lên lịch</button>
         </form>

         <button id="box_reminder" class="box_reminder d-flex justify-content-center align-items-center" tabindex="0">
            <span>Tạo lịch</span>
            <span class="material-symbols-outlined ms-2">event</span>
         </button>
      </div>

      <footer class=" m-auto box_footer">
         <div class=" container ">
            <div class=" footer_top">
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
                  <p> Danh mục uy tín toàn cầu</p>
               </div>
            </div>
         </div>
         <div class="footer_bottom m-auto">
            <div class="col-8 row m-auto">
               <div class="col-4">
                  <div class="box_menu_footer">
                     <a href="">Về Bloom</a>
                     <Ul class="menu_footer">
                        <li><a href="">Giới thiệu Bloom</a></li>
                        <li><a href="">Tuyển Dụng</a></li>
                        <li><a href="">Chính sách bảo mật</a></li>
                        <li><a href="">Điều khoản sử dụng</a></li>
                        <li><a href="">Liên hệ</a></li>
                     </Ul>
                  </div>
               </div>
               <div class="col-4">
                  <div class="box_menu_footer">
                     <a href="">Hỗ trợ khách hàng</a>
                     <Ul class="menu_footer">
                        <li><a href="">Gửi yêu cầu hỗ trợ</a></li>
                        <li><a href="">Hướng dẫn đặt hàng</a></li>
                        <li><a href="">Phương thức vận chuyển</a></li>
                        <li><a href="">Chính sách đổi trả</a></li>
                     </Ul>
                  </div>
               </div>
               <div class="col-4">
                  <div class="box_menu_footer">
                     <a href="">Nước Hoa</a>
                     <Ul class="menu_footer">
                        <li><a href="">Nước Hoa Nữ </a></li>
                        <li><a href=""> Nước Hoa Nam </a></li>
                        <li><a href=""> Xịt Thơm Toàn Thân</a></li>
                  </div>
                  </Ul>
               </div>
            </div>
         </div>
      </footer>
      <div id="scoll-top">
         <div id="scrollToTopBtn"><span class="material-symbols-outlined">
               keyboard_arrow_up
            </span></div>
      </div>


      <script src="/public/assets/Client/Js/slide.js"></script>
      <script src="/public/assets/Client/Js/cart.js"></script>
      <script src="/public/assets/Client/Js/login.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
      <script>
         function filterByPrice(value) {
            const sortOrder = document.getElementById('sort-order').value;
            const url = new URL(window.location.href);
            url.searchParams.set('price', value);
            url.searchParams.set('sort', sortOrder);
            window.location.href = url.toString();
         }

         function sortProducts(value) {
            const priceFilter = document.getElementById('price-filter').value;
            const url = new URL(window.location.href);
            url.searchParams.set('sort', value);
            url.searchParams.set('price', priceFilter);
            window.location.href = url.toString();
         }

      </script>

      <script>
         const priceMin = document.getElementById("priceMin");
         const priceMax = document.getElementById("priceMax");
         const priceRangeText = document.getElementById("priceRangeText");

         priceMin.oninput = function () {
            priceRangeText.innerHTML = priceMin.value + " VND - " + priceMax.value + " VND";
         }

         priceMax.oninput = function () {
            priceRangeText.innerHTML = priceMin.value + " VND - " + priceMax.value + " VND";
         }
      </script>


      <script>
         const scolltop = document.getElementById("scoll-top");
         const form = document.querySelector('#form');
         const button = document.querySelector('#box_reminder');
         form.style.display = "none";
         button.addEventListener('click', function (event) {
            event.stopPropagation();
            if (form.style.display === "none" || form.style.display === "") {
               form.style.display = "block";
            } else {
               form.style.display = "none";
            }
         });

         document.addEventListener('click', function (event) {
            if (!form.contains(event.target)) {
               form.style.display = "none";
            }
         });


         window.onscroll = function () {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
               scolltop.style.display = "block";
            } else {
               scolltop.style.display = "none";
            }
         };
         scolltop.onclick = function () {
            window.scrollTo({
               top: 0,
               behavior: "smooth"
            });
         };
      </script>
      <!-- Phuong thuc thanh toan -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="/public/assets/Client/Js/jquery.min.js"></script>
      <script src="/public/assets/Client/Js/bootstrap.min.js"></script>
      <script src="/public/assets/Client/Js/icheck.min.js"></script>

      <!-- <script>
         $(document).ready(function () {
            $('.icheck').iCheck({
               checkboxClass: 'icheckbox_flat-blue',
               radioClass: 'iradio_flat-blue'
            });
         });
      </script> -->

      </body>

      </html>

      <?php

      // unset($_SESSION['success']);
      // unset($_SESSION['error']);
   }
}

?>