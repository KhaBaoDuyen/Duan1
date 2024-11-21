<?php

namespace App\Views\Client\Pages\Product;

use App\Views\BaseView;
use App\Views\Client\Components\Category;

class Index extends BaseView
{
   public static function render($data = null)
   {
      ?>

   <section class="product_banner">
      <div class="box_banner col-10 m-auto d-flex">
         <div class="product_banner_left col-8  m-0">
            <div class="title">
               <p class="title_name">BLOOM</p>
               <p class="title_slogan">Hơi thở cuộc sống</p>
            </div>

         </div>
         <div class="product_banner_right col-4 ">
            <img src="/public/assets/Client/image/about/sen3.png" alt width="100%">
         </div>
      </div>
   </section>

   <section class="count m-auto">
      <div class="box_total d-flex col-10  row m-auto ">

         <div class="total_product col-3 ">
            <p class="count_number">200+</p>
            <p class="count_name"> Sản phẩm</p>
         </div>

         <div class="total_product col-3 ">
            <p class="count_number">40+</p>
            <p class="count_name"> Thương hiệu</p>
         </div>

         <div class="total_product col-3 ">
            <p class="count_number">300+</p>
            <p class="count_name"> Bình luận</p>
         </div>

         <div class="total_product col-3 ">
            <p class="count_number">1000+</p>
            <p class="count_name"> Lượt truy cập</p>
         </div>

      </div>
   </section>

   <main class=" col-10 m-auto d-flex">

      <aside class="col-3">
         <h4 class="title_brand">Danh mục </h4>

         <div class="brand m-auto">
            <a class="brand_title d-flex  justify-content-between align-content-center">
               <h5 class="col-10">Cây thủy sinh</h5>
               <p class="count_product col-2">(30)</p>
            </a>
            <a class="brand_title d-flex  justify-content-between align-content-center">
               <h5 class="col-10">Cây dẽ chăm</h5>
               <p class="count_product col-2">(30)</p>
            </a>
            <a class="brand_title d-flex  justify-content-between align-content-center">
               <h5 class="col-10">Cây phong thủy</h5>
               <p class="count_product col-2">(30)</p>
            </a>
            <a class="brand_title d-flex  justify-content-between align-content-center">
               <h5 class="col-10">Cây nhiệt đới</h5>
               <p class="count_product col-2">(30)</p>
            </a>
            <a class="brand_title d-flex  justify-content-between align-content-center">
               <h5 class="col-10">Cây ôn đới</h5>
               <p class="count_product col-2">(30)</p>
            </a>
            <a class="brand_title d-flex  justify-content-between align-content-center">
               <h5 class="col-10">Cây ngoại thất</h5>
               <p class="count_product col-2">(30)</p>
            </a>
            <a class="brand_title d-flex  justify-content-between align-content-center">
               <h5 class="col-10">Cây dạng leo</h5>
               <p class="count_product col-2">(30)</p>
            </a>
            <a class="brand_title d-flex  justify-content-between align-content-center">
               <h5 class="col-10">Cây cối đặc biệt</h5>
               <p class="count_product col-2">(30)</p>
            </a>

         </div>
      </aside>
      <article class="col-9">
         <nav>

            <div class="tune">
               <div class="tune_icon"> <span class="material-symbols-outlined"> tune </span></div>
               <div class="tune_down">
                  <li><a href>A-z</a></li>
                  <li><a href>Z-a</a></li>
               </div>
            </div>
         </nav>

         <div class="all_products row ">
            <a class="card " href="/product">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt>
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her
                     EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>
            <a class="card " href="/product">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt>
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her
                     EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>
            <a class="card " href="/product">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt>
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her
                     EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>
            <a class="card " href="/product">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt>
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her
                     EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>
            <a class="card " href="/product">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt>
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her
                     EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>
            <a class="card " href="/product">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt>
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her
                     EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>
            <a class="card " href="/product">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt>
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her
                     EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>
            <a class="card " href="/product">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt>
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her
                     EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

            <a class="card " href="/product">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt>
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her
                     EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

            <a class="card " href="/product">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt>
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her
                     EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

            <a class="card " href="/product">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt>
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her
                     EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

         </div>
      </article>

   </main>

      </div>

      <?php

   }
}
?>