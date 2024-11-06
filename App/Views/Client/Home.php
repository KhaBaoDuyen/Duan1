<?php

namespace App\Views\Client;

use App\Views\BaseView;

class Home extends BaseView
{
    public static function render($data = null)
    {
?>

<section class="section_one d-flex">
   <!-- Thẻ Chứa Slideshow -->
   <div class="d-flex col-10 m-auto section_one_slide">
      <div class="slide col-7">
         <div class="slide_banner" id="slider1">
            <img class="slide-image" src="/public/assets/Client/image/main/01pyixtjzfd0eibvn3d99o3832.jpg" alt="" width="100%" height="100%" class="p-1">
            <div class="btn_slide d-flex p-2">
               <button onclick="prevSlide('slider1')" class="material-symbols-outlined">arrow_back_ios</button>
               <button onclick="nextSlide('slider1')" class="material-symbols-outlined">arrow_forward_ios</button>
            </div>
         </div>
      </div>

      <div class="box_img col-5">
         <img class="p-1" src="/public/assets/Client/image/main/1721200384nowfree-3-846x250.jpg" alt="" width="100%">
         <img class="p-1" src="/public/assets/Client/image/main/z5959425286316_684c8469eb26dcb2112174d898c1cc71.jpg" alt="" width="100%" height="100%">
      </div>
   </div>
</section>

<main class="col-10 m-auto">
   <section class="flash">
      <div class="box_title d-flex align-items-center justify-content-between p-3">
         <h3>Flash Deals</h3>
         <a href="">Xem tất cả</a>
      </div>
      <div class="flash_box d-flex">
         <?php
         if (isset($data) && isset($data['products']) ):
         ?>
         <?php
         foreach ($data['products'] as $item):
            if (isset($item['discount_price']) && !empty($item['discount_price'])):
         ?>
         <a class="card col-2 ">
            <div class="box_image">
               <img class="image" src="<?= $item['image'] ?>" alt="" height="100%">
               <img class="image_hover" src="<?= $item['image_product_url'] ?>" alt="image_hover">
            </div>

            <div class="title">
               <div class="price">
                  <span><?= $item['price'] ?> vnd</span>
                  <?php if (isset($item['discount_price']) && !empty($item['discount_price'])): ?>
                     <span class="price_sales"> <?= $item['discount_price'] ?></span>
                  <?php endif; ?>
               </div>
               <h4 class="name_product"><?= $item['name'] ?></h4>
               <p class="content"><?= $item['short_description'] ?></p>
            </div>
            <?php
            if (isset($item['discount_price']) && $item['discount_price'] < $item['price'] && $item['price'] > 0):
               $discount_percentage = round((($item['price'] - $item['discount_price']) / $item['price']) * 100, 2);
            ?>
            <div class="sale">
               -<?= $discount_percentage ?>%
            </div>
            <?php endif; ?>
         </a>
         <?php endif; ?>
         <?php endforeach; ?>
         <?php endif; ?>
      </div>
      <div class="box_btn">
         <button class="btn-left"><span class="material-symbols-outlined">arrow_back_ios</span></button>
         <button class="btn-right"><span class="material-symbols-outlined">arrow_forward_ios</span></button>
      </div>
   </section>

   <section class="row-cols-3 d-flex">
      <div class="col-4 col-md-1 col-lg-4 rounded-3 p-2 mt-3  img-box">
         <img class="rounded-3" height="100%" src="/public/assets/Client/image/main/9e416f930e4e557bf47c5ff0c08cac43.jpg" alt="" width="100%">
      </div>
      <div class="col-4 col-md-1 col-lg-4 rounded-3 p-2 mt-3 img-box ">
         <img class="rounded-3" height="100%" src="/public/assets/Client/image/main/25b9622615589d19cae8d3ec3cb80ed2.jpg" alt="" width="100%">
      </div>
      <div class="col-4 col-md-1 col-lg-4 rounded-3 p-2 mt-3  img-box">
         <img class="rounded-3" height="100%" src="/public/assets/Client/image/main/box3.jpg" alt="" width="100%">
      </div>
   </section>

   <section class="brand">
      <div class="box_title d-flex align-items-center justify-content-between ">
         <h3>Thương hiệu </h3>
         <a href="">Xem tất cả</a>
      </div>
      <div class="d-flex box_category justify-content-center align-items-center">
         <div class="col-4 box_category_left">
            <div class="slide_banner" id="slider2">
               <img class="slide-image" src="/public/assets/Client/image/category/1bdca5d0dd3ce9c02ee514d9039b07bc.jpg" alt="" width="100%" height="100%" class="p-1">
               <div class="btn_slide d-flex p-2 justify-content-between">
                  <button onclick="prevSlide('slider2')" class="material-symbols-outlined">arrow_back_ios</button>
                  <button onclick="nextSlide('slider2')" class="material-symbols-outlined">arrow_forward_ios</button>
               </div>
            </div>

         </div>

         <div class="box_img col-5">
            <img class="p-1" src="/public/assets/Client/image/main/1721200384nowfree-3-846x250.jpg" alt="" width="100%">
            <img class="p-1" src="/public/assets/Client/image/main/z5959425286316_684c8469eb26dcb2112174d898c1cc71.jpg" alt=""
               width="100%" height="100%">
         </div>
      </div>
   </section>
   <main class="col-10 m-auto">
      <section class="flash">
         <div class="box_title d-flex align-items-center justify-content-between p-3">
            <h3>Flash Deals</h3>
            <a href="">Xem tất cả</a>
         </div>
         <div class="flash_box d-flex">

            <a class="card col-2">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price">2.566.00 đ</div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

            <a class="card col-2">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price">2.566.00 đ</div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

            <a class="card col-2">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price">2.566.00 đ</div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

            <a class="card col-2">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price">2.566.00 đ</div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

            <a class="card col-2">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price">2.566.00 đ</div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

            <a class="card col-2">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price">2.566.00 đ</div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

            <a class="card col-2">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price">2.566.00 đ</div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

            <a class="card col-2">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price">2.566.00 đ</div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

            <a class="card col-2">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price">2.566.00 đ</div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

            <a class="card col-2">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price">2.566.00 đ</div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>


         </div>
         <div class="box_btn">
            <button class="btn-left"><span class="material-symbols-outlined">
                  arrow_back_ios
               </span></button>
            <button class="btn-right"><span class="material-symbols-outlined">
                  arrow_forward_ios
               </span></button>
         </div>
      </section>

      <section class="row-cols-3 d-flex">
         <div class="col-4 col-md-1 col-lg-4 rounded-3 p-2 mt-3  img-box"><img class="rounded-3" height="100%"
               src="/public/assets/Client/image/main/9e416f930e4e557bf47c5ff0c08cac43.jpg" alt="" width="100%"></div>
         <div class="col-4 col-md-1 col-lg-4 rounded-3 p-2 mt-3 img-box "><img class="rounded-3" height="100%"
               src="/public/assets/Client/image/main/25b9622615589d19cae8d3ec3cb80ed2.jpg"
               alt="" width="100%"></div>
         <div class="col-4 col-md-1 col-lg-4 rounded-3 p-2 mt-3  img-box"><img class="rounded-3" height="100%"
               src="/public/assets/Client/image/main/box3.jpg" alt="" width="100%"></div>
      </section>

      <section class="brand ">
         <div class="box_title d-flex align-items-center justify-content-between ">
            <h3>Thương hiệu </h3>
            <a href="">Xem tất cả</a>
         </div>
         <div class="d-flex box_category justify-content-center align-items-center">
            <div class="col-4 box_category_left">
               <div class="slide_banner" id="slider2">
                  <img class="slide-image" src="/public/assets/Client/image/category/1bdca5d0dd3ce9c02ee514d9039b07bc.jpg" alt=""
                     width="100%" height="100%" class="p-1">
                  <div class="btn_slide d-flex p-2 justify-content-between">
                     <button onclick="prevSlide('slider2')" class="material-symbols-outlined">arrow_back_ios</button>
                     <button onclick="nextSlide('slider2')" class="material-symbols-outlined">arrow_forward_ios</button>
                  </div>
               </div>

            </div>

            <div class="col-8  box_category_right p-2">

               <ul class="flash_box slider_box_right">
                  <li class="col-3 m-1">
                     <div class="card_category">
                        <a href="#" class="">
                           <img src="/public/assets/Client/image/category/3117f65e6e8aa3eff770862933bf49b7.jpg" alt="" width="100%"
                              height="100%">
                           <div class="name_brand">
                              <h2>Nội cảnh</h2>
                           </div>
                        </a>
                     </div>
                     <div class="card_category">
                        <a href="#" class="">
                           <img
                              src="/public/assets/Client/image/category/yves-saint-laurent-y-eau-de-parfum-1_42ad04f05afa4c8a9fe801822f2b87e5_master.jpg"
                              alt="" width="100%" height="100%">
                           <div class="name_brand">
                              <h2>Thủy sinh</h2>
                           </div>
                        </a>
                     </div>
                  </li>
                  <!-- Các li khác tương tự -->
                  <li class="col-3 m-1">
                     <div class="card_category">
                        <a href="" class="">
                           <img src="/public/assets/Client/image/category/OIP (1).jpg" alt="" width="100%" height="100%">
                           <div class="name_brand">
                              <h2>ngoại cảnh</h2>
                           </div>
                        </a>
                     </div>
                     <div class="card_category">
                        <a href="" class="">
                           <img src="/public/assets/Client/image/category/d35eda6159bf0044cde4add2dd8cdc76.jpg" alt="" width="100%"
                              height="100%">
                           <div class="name_brand">
                              <h2>để bàn</h2>
                           </div>
                        </a>
                     </div>
                  </li>
                  <li class="col-3 m-1">
                     <div class="card_category">
                        <a href="" class="">
                           <img src="/public/assets/Client/image/category/8bc13449ed8021f801f034a65429b818.jpg" alt="" width="100%"
                              height="100%">
                           <div class="name_brand">
                              <h2>thân leo</h2>
                           </div>
                        </a>
                     </div>
                     <div class="card_category">
                        <a href="" class="">
                           <img src="/public/assets/Client/image/category/9bc8b27677b7aedc64c8d1d82b6609e9.jpg" alt="" width="100%"
                              height="100%">
                           <div class="name_brand">
                              <h2>hoa</h2>
                           </div>
                        </a>
                     </div>
                  </li>
                  <li class="col-3 m-1">
                     <div class="card_category">
                        <a href="" class="">
                           <img src="/public/assets/Client/image/category/7b3f83a3628ec18f1886be3fbdcc6309.jpg" alt="" width="100%"
                              height="100%">
                           <div class="name_brand">
                              <h2>nhiệt đới</h2>
                           </div>
                        </a>
                     </div>
                     <div class="card_category">
                        <a href="" class="">
                           <img src="/public/assets/Client/image/category/7d30574b5ce0d5b6bfa86160ae597338.jpg" alt="" width="100%"
                              height="100%">
                           <div class="name_brand">
                              <h2>bonsai</h2>
                           </div>
                        </a>
                     </div>
                  </li>
                  <li class="col-3 m-1">
                     <div class="card_category">
                        <a href="" class="">
                           <img src="/public/assets/Client/image/category/c45fb80e24be3a412b4be205221e0d41.jpg" alt="" width="100%"
                              height="100%">
                           <div class="name_brand">
                              <h2>chịu hạn</h2>
                           </div>
                        </a>
                     </div>
                     <div class="card_category">
                        <a href="" class="">
                           <img src="/public/assets/Client/image/category/26865f14301f0a1b131f8b10b94567b3.jpg" alt="" width="100%"
                              height="100%">
                           <div class="name_brand">
                              <h2>tán rộng</h2>
                           </div>
                        </a>
                     </div>
                  </li>
               </ul>
               <div class="box_btn_category">
                  <button class="btn-left"><span class="material-symbols-outlined">arrow_back_ios</span></button>
                  <button class="btn-right"><span class="material-symbols-outlined">arrow_forward_ios</span></button>
               </div>
            </div>

         </div>

         </div>
      </section>

      <section class="all_product">
         <div class="box_title d-flex align-items-center justify-content-between p-3">
            <h3>Sản phẩm</h3>
            <a href="">Xem tất cả</a>
         </div>

         <div class="row  box_card col-12">
            <a class="card ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

            <a class="card ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

            <a class="card">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

            <a class="card ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

            <a class="card ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

            <a class="card ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

            <a class="card  ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

            <a class="card  ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

            <a class="card  ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

            <a class="card  ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

            <a class="card  ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

            <a class="card  ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

            <a class="card  ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

            <a class="card  ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <!-- <div class="sale">
                  -12%
               </div> -->
            </a>

            <a class="card  ">
               <div class="box_image">
                  <img class="image"
                     src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg"
                     alt="" height="100%">
                  <img class="image_hover"
                     src="/public/assets/Client/image/products/narciso-rodriguez-x-hasakigiay-chung-nhan-dai-ly-chinh-hang1714041486_img_385x385_622873_fit_center.jpg"
                     alt="">
               </div>

               <div class="title">
                  <div class="price"><span>2.566.00 đ </span> <span class="price_sales"> 2.257.080</span> </div>
                  <h4 class="name_product">Narciso Rodriguez</h4>
                  <p class="content">Nước Hoa Nữ Narciso Rodriguez For Her EDP 30ml</p>

               </div>
               <div class="sale">
                  -12%
               </div>
            </a>

         </div>


         <div class="title_all_product">
            <a class="" href=""> Xem thêm</a>
         </div>
      </section>
   </main>


<?php }
}?>
