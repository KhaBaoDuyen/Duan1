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
                  <img class="slide-image" src="/public/assets/Client/image/main/01pyixtjzfd0eibvn3d99o3832.jpg" alt=""
                     width="100%" height="100%" class="p-1">
                  <div class="btn_slide d-flex p-2">
                     <button onclick="prevSlide('slider1')" class="material-symbols-outlined">arrow_back_ios</button>
                     <button onclick="nextSlide('slider1')" class="material-symbols-outlined">arrow_forward_ios</button>
                  </div>
               </div>
            </div>

            <div class="box_img col-5">
               <img class="p-1" src="/public/assets/Client/image/main/1721200384nowfree-3-846x250.jpg" alt="" width="100%">
               <img class="p-1" src="/public/assets/Client/image/main/z5959425286316_684c8469eb26dcb2112174d898c1cc71.jpg"
                  alt="" width="100%" height="100%">
            </div>
         </div>
      </section>

      <main class="col-10 m-auto">
         <section class="flash">
            <div class="box_title d-flex align-items-center justify-content-between p-3">
               <h3>Flash Deals</h3>
            </div>
            <div class="flash_box d-flex">
               <?php if (isset($data) && isset($data['products'])): ?>
                  <?php foreach ($data['products'] as $item): ?>
                     <?php

                     if (!empty($item['discount_price'])):
                     ?>
                        <a href="/product/<?= $item['id'] ?>" class="card col-2">
                           <div class="box_image">
                              <?php
                              // giải mã thành mảng
                              if (isset($item['images']) && is_string($item['images'])) {
                                 $item['images'] = json_decode($item['images'], true);
                              }

                              // Kiểm tra xem mảng  giải mã chưa
                            if (isset($item['images'][0])) {
                              $imageHover = $item['images'][0];
                           } else {
                              $imageHover = 'usermacdinh.png';
                           }
                              ?>


                              <img class="image" src="/public/uploads/products/<?= $item['image'] ?>" alt="" height="100%">
                              <img class="image_hover" src="/public/uploads/products/<?= $imageHover ?>" alt="image_hover" height="100%">
                           </div>


                           <div class="title">
                              <div class="price">
                                 <?php if (isset($item['discount_price']) && !empty($item['discount_price'])) { ?>
                                    <span><?= number_format($item['discount_price'], 0, ',', '.') ?>đ</span>
                                    <span class="price_sales"><?= number_format($item['price'], 0, ',', '.') ?> đ</span>
                                 <?php } else { ?>
                                    <span><?= number_format($item['price'], 0, ',', '.') ?>đ</span>
                                 <?php }  ?>
                              </div>
                              <h4 class="name_product"><?= $item['name'] ?></h4>
                              <p class="content"><?= $item['short_description'] ?>vnd</p>
                           </div>

                           <?php
                           $discount_percentage = round((($item['price'] - $item['discount_price']) / $item['price']) * 100);
                           ?>
                           <div class="sale">
                              -<?= $discount_percentage ?>%
                           </div>
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
               <img class="rounded-3" height="100%"
                  src="/public/assets/Client/image/main/9e416f930e4e557bf47c5ff0c08cac43.jpg" alt="" width="100%">
            </div>
            <div class="col-4 col-md-1 col-lg-4 rounded-3 p-2 mt-3 img-box ">
               <img class="rounded-3" height="100%"
                  src="/public/assets/Client/image/main/25b9622615589d19cae8d3ec3cb80ed2.jpg" alt="" width="100%">
            </div>
            <div class="col-4 col-md-1 col-lg-4 rounded-3 p-2 mt-3  img-box">
               <img class="rounded-3" height="100%" src="/public/assets/Client/image/main/box3.jpg" alt="" width="100%">
            </div>
         </section>

         <section class="brand">
            <div class="box_title d-flex align-items-center justify-content-between ">
               <h3>Danh mục </h3>

            </div>
            <div class="d-flex box_category justify-content-center align-items-center">
               <div class="col-4 box_category_left">
                  <div class="slide_banner" id="slider2">
                     <img class="slide-image" src="/public/assets/Client/image/category/1bdca5d0dd3ce9c02ee514d9039b07bc.jpg"
                        alt="" width="100%" height="100%" class="p-1">
                     <div class="btn_slide d-flex p-2 justify-content-between">
                        <button onclick="prevSlide('slider2')" class="material-symbols-outlined">arrow_back_ios</button>
                        <button onclick="nextSlide('slider2')" class="material-symbols-outlined">arrow_forward_ios</button>
                     </div>
                  </div>
               </div>

               <div class="col-8  box_category_right p-2">
                  <div class="flash_box slider_box_right">
                     <ul class="category-list d-flex">
                        <?php foreach ($data['categogy'] as $category):
                           if ($category['id'] % 2 == 0): ?>
                              <li class="m-1 col-3">
                                 <div class="card_category">
                                    <a href="/product/categories/<?= $category['id'] ?>">
                                       <img src="public/uploads/categogies/<?= $category['image']; ?>" alt="" width="100%"
                                          height="100%">
                                       <div class="name_brand">
                                          <h2><?= $category['name']; ?></h2>
                                       </div>
                                    </a>
                                 </div>
                              </li>
                           <?php endif; ?>
                        <?php
                        endforeach; ?>
                     </ul>
                     <ul class="category-list d-flex">
                        <?php foreach ($data['categogy'] as $category):
                           if ($category['id'] % 2 != 0): ?>
                              <li class="m-1 col-3">
                                 <div class="card_category">
                                    <a href="/product/categories/<?= $category['id'] ?>">
                                       <img src="/public/uploads/categogies/<?= $category['image']; ?>" alt="" width="100%"
                                          height="100%">
                                       <div class="name_brand">
                                          <h2><?= $category['name']; ?></h2>
                                       </div>
                                    </a>
                                 </div>
                              </li>
                           <?php endif; ?>
                        <?php
                        endforeach; ?>
                     </ul>
                  </div>
                  <div class="box_btn_category">
                     <button class="btn-left material-symbols-outlined">arrow_back_ios</button>
                     <button class=" btn-right material-symbols-outlined">arrow_forward_ios</button>
                  </div>
               </div>
            </div>
         </section>

         <section class="all_product">
            <div class="box_title d-flex align-items-center justify-content-between p-3">
               <h3>Sản phẩm</h3>
               <a href="/shop">Xem tất cả</a>
            </div>
            <div class=" box_card col-12">
               <?php
               if (isset($data) && isset($data['products']) && $data['products']):
                  $productsLimit = array_slice($data['products'], 0, 20);
               ?>
                  <?php foreach ($productsLimit as $item): ?>
                     <a class="card" href="/product/<?= $item['id'] ?>">
                        <div class="box_image">
                           <?php
                           // giải mã thành mảng
                           if (isset($item['images']) && is_string($item['images'])) {
                              $item['images'] = json_decode($item['images'], true);
                           }

                           // Kiểm tra xem mảng  giải mã chưa
                           if (isset($item['images'][0])) {
                              $imageHover = $item['images'][0];
                           } else {
                              $imageHover = 'usermacdinh.png';
                           }
                           ?>


                           <img class="image" src="/public/uploads/products/<?= $item['image'] ?>" alt="" height="100%">
                           <img class="image_hover" src="/public/uploads/products/<?= $imageHover ?>" alt="image_hover">
                        </div>

                        <div class="title">
                           <div class="price">
                                  <?php if (isset($item['discount_price']) && !empty($item['discount_price'])){ ?>
                                    <span><?= number_format($item['discount_price'], 0, ',', '.') ?>đ</span>
                                    <span class="price_sales"><?= number_format($item['price'], 0, ',', '.') ?> đ</span>
                                 <?php } else{ ?>
                                    <span><?= number_format($item['price'], 0, ',', '.')?>đ</span>
                                 <?php }  ?>

                           </div>
                           <h4 class="name_product"><?= $item['name'] ?></h4>
                           <p class="content"><?= $item['short_description'] ?></p>
                        </div>

                        <?php
                        if (isset($item['discount_price']) && $item['discount_price'] > 0 && isset($item['price']) && $item['price'] > 0) {
                           $discount_percentage = round((($item['price'] - $item['discount_price']) / $item['price']) * 100);
                        ?>
                           <div class="sale">
                              -<?= $discount_percentage ?>%
                           </div>
                        <?php } ?>

                     </a>
                  <?php endforeach; ?>
               <?php endif; ?>
            </div>


            <div class="title_all_product">
               <a href="/shop"> Xem thêm</a>
            </div>
         </section>
      </main>

<?php
   }
}
?>