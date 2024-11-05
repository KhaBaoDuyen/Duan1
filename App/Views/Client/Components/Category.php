<?php

namespace App\Views\Client\Components;

use App\Views\BaseView;

class Category extends BaseView
{
    public static function render($data = null)
    {
?>

<!-- 
         <nav id="menu-cata">
       <?php
                     if ($data):
                        ?>
            <a href="#" class="boxcata" id="boxcata">
               <div id="img-cata-sp">
                  <img src="/public/assets/client/images/cata/noithat.png" alt="" id="noi-that">
                  <img src="/public/assets/client/images/cata/noithat-mau.png" alt="" id="noi-that-mau">
               </div>
               <h5>Nội thất <br>
                  <hr>
               </h5>
            </a>

            <a href="#" class="boxcata" id="boxcata">
               <div id="img-cata-sp">
                  <img src="/public/assets/client/images/cata/ke.png" alt="" id="noi-that">
                  <img src="/public/assets/client/images/cata/ke-mau.png" alt="" id="noi-that-mau">
               </div>
               <h5>Kệ <br>
                  <hr>
               </h5>
            </a>

            <a href="#" class="boxcata" id="boxcata">
               <div id="img-cata-sp">
                  <img src="/public/assets/client/images/cata//light.png" alt="" id="noi-that">
                  <img src="/public/assets/client/images/cata/light-mau.png" alt="" id="noi-that-mau">
               </div>
               <h5>Light <br>
                  <hr>
               </h5>
            </a>

            <a href="#" class="boxcata" id="boxcata">

               <div id="img-cata-sp">
                  <img src="/public/assets/client/images/cata/tuong.png" alt="" id="noi-that">
                  <img src="/public/assets/client/images/cata/tuong-mau.png" alt="" id="noi-that-mau">
               </div>
               <h5>Tường <br>
                  <hr>
               </h5>
            </a>

            <a href="#" class="boxcata" id="boxcata">

               <div id="img-cata-sp">
                  <img src="/public/assets/client/images/cata/textile.png" alt="" id="noi-that">
                  <img src="/public/assets/client/images/cata/textile-mau.png" alt="" id="noi-that-mau">
               </div>
               <h5>Thảm <br>
                  <hr>
               </h5>
            </a>
      <?php endif; ?>

         </nav> -->
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-5">

       <aside id="cata-danhmuc" class="" style="width: max-content;">
               <div id="thuonghieu" class="thuonghieu" width="max-content">

                  <h3>Danh mục </h3>
                  <ul id="list-danhmuc" class="list-danhmuc">
                     <?php
                     foreach ($data as $item):
                        ?>
                        <li class="categ_hover"><a href="/product/categories/<?=$item['categories_id']?>"><label for="Aaron"><?= $item['name'] ?></label></a></li>
                     <?php endforeach; ?>

                  </ul>
               </div>
               <!-- <div id="phongcach" class="phongcach">
                  <label for=""> Phong Cách</label>
                  <ul id="list-danhmuc">
                     <li><input title="index" type="checkbox" name="check-thuonghieu" class="check-thuonghieu"><a
                           href=""><label for="">Tây cổ điển</label></a></li>
                     <li><input title="index" type="checkbox" name="check-thuonghieu" class="check-thuonghieu"><a
                           href=""><label for=""> Tây hiện đại</label></a></li>
                  </ul>
               </div> -->
               <hr>
               <!-- <div class="khoanggia" id="khoanggia">
                  <label for="">Giá</label>
                  <ul id="list-danhmuc">
                     <li> <input title="index" type="checkbox" name="check-thuonghieu" class="check-thuonghieu"> <a
                           href=""><label for=""> dưới < 1 triệu vnd</label></a></li>
                     <li><input title="index" type="checkbox" name="check-thuonghieu" class="check-thuonghieu"> <a href="">
                           <label for=""> 1tr - 10 triệu vnd</label></a></li>
                     <li><input title="index" type="checkbox" name="check-thuonghieu" class="check-thuonghieu"> <a
                           href=""><label for=""> trên > 10 triệu vnd</label></a></li>
                  </ul>
               </div> -->
            </aside>

</div>

<?php
    }} 
?>