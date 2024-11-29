<?php

namespace App\Views\Client;

use App\Views\BaseView;

class Contact extends BaseView
{
    public static function render($data = null)
    {
?>
      <section class="bannercontact ">
         <div class="box_banner col-10 m-auto d-flex justify-content-center">
         
               <div class="title_banner row text-center col-6 justify-content-end align-content-end">
                  <h1>Liên hệ với chúng tôi</h1>
          
                  <p>Hãy để chúng tôi biết về tình trạng của sản phẩm, cần hỗ trợ gì, hoặc có thể cần thông tin thêm về chúng tôi. Vui lòng điền đầy đủ thông tin và gửi cho chúng tôi thông qua email hoặc điện thoại.</p>
               </div>
           
            
         </div>
      </section>
      <main class="col-10 contact m-auto">

         <div class="row d-flex justify-content-between p-3 m-auto"><div
               class="row col-6">
               <!-- <div class="row" style="display: flex; justify-content:space-around;"> -->
               <div class=" col-3 m-1 contact1 align-content-center justify-content-center">
                  <div class="imgcontact d-flex  justify-content-center mt-2">
                      <img src="/public/assets/Client/image/contact/call_60dp_FFFFFF_FILL0_wght400_GRAD0_opsz48.png" width="20%" alt="">
                      <h2 style="color: var(--text-color-light);">whatsapp</h2>
                      <h5 style="color: var(--text-color-light);">0987&nbsp;654&nbsp;321</h5>
                  
                  </div>

               </div>
               
               <div class=" col-3 m-1 contact1 align-content-center justify-content-center">
                  <div class="imgcontact d-flex justify-content-center mt-2">
                     <img src="/public/assets/Client/image/contact/whatsapp.png" width="20%" alt="">
                     <h2 style="color: var(--text-color-light);">Phone</h2>
                     <h5 style="color: var(--text-color-light);">0987&nbsp;654&nbsp;321</h5>
                 
                 </div>
               </div>
               <!-- </div> -->

               <!-- <div class="row" style="display: flex; justify-content:space-around; margin-top: 10px;"> -->
               <div class=" col-3 m-1 contact1 align-content-center justify-content-center">
                  <div class="imgcontact d-flex justify-content-center mt-2">
                     <img src="/public/assets/Client/image/contact/mail_60dp_FFFFFF_FILL0_wght400_GRAD0_opsz48.png" width="20%" alt="">
                     <h2 style="color: var(--text-color-light);">Email</h2>
                     <h5 style="color: var(--text-color-light);">FPT@Poly.shop</h5>
                 
                 </div>
               </div>
               <div class=" col-3 m-1 contact1 align-content-center justify-content-center">
                  <div class="imgcontact d-flex justify-content-center mt-2">
                     <img src="/public/assets/Client/image/contact/storefront_60dp_FFFFFF_FILL0_wght400_GRAD0_opsz48.png" width="20%" alt="">
                     <h2 style="color: var(--text-color-light);">Địa chỉ</h2>
                     <h5 style="color: var(--text-color-light); ">Đ số 22, Thới Thạnh,Cần Thơ</h5>
                 
                 </div>
               </div>
               <!-- </div> -->
               <div class="mt-5">
                  <iframe
                     src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.420495048509!2d105.75336184389498!3d9.982081464731522!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a08906415c355f%3A0x416815a99ebd841e!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1730446830891!5m2!1svi!2s"
                     width="95%" height="300px" style="border:0;"
                     allowfullscreen
                     loading="lazy"
                     referrerpolicy="no-referrer-when-downgrade"></iframe>
               </div>
            </div>

            <div class="col-6"
               >
               <div class="aqua-box  information">
                  <h3 style="float: left;">Thông tin liên hệ</h3><br><br>
                  <p style="float: left;">Bạn có những thắc mắc hãy liên hệ với
                     chúng tôi và nhập thông tin dưới đây.</p><br> <br>
                  <div class="contact-box">
                     <form action="/sendmailcontact" method="post"  enctype="multipart/form-data" class="row">
                     <input type="hidden" name="method" value="POST" id="">
                        <div class="col-6">
                           <label style="font-size: 20px;" for="name">Tên:</label><br>
                           <input type="text" id="name" name="name" placeholder="Vui lòng nhập Tên....."><br><br>
                        </div>
                        <div class="col-6">
                           <label style="font-size: 20px;" for="name">Họ:</label><br>
                           <input type="text" id="ho" name="ho" placeholder="Vui lòng nhập họ...."><br><br>
                        </div>

                        <div>
                           <label style="font-size: 20px;" for="email">Email:</label><br>
                           <input type="email" id="email" name="email" placeholder="Vui lòng nhập email...."><br><br>
                        </div>

                        <div>
                           <label style="font-size: 20px;" for="phone">Số điện thoại:</label><br>
                           <input type="text" id="phone" name="phone" placeholder="Vui lòng nhập số điện thoại...."><br><br>
                        </div>

                     
                        <label style="font-size: 20px;" for="message">Tin nhắn:</label><br>
                        <textarea id="message" name="message"
                           rows="4"  placeholder="Vui lòng nội dung bạn thắc mắc....."></textarea><br><br>
                 

                      <div class="inputsubmit d-flex justify-content-center ">
                        <input width="30%"  type="submit" value="Gửi">
                    
                      </div>  
                     </form>
                  </div>
               </div>
            </div>

         </div>

      </main>


<?php }
}?>
