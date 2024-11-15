<?php

namespace App\Views\Client\Pages\Product;

use App\Views\BaseView;
// use App\Views\Client\Components\Category;
use App\Views\Client\Components\Category as ComponentsCategory;

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

         <?php
         ComponentsCategory::render($data['categories']);
         ?>
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

               <div class="all_products row ">
                  <?php
                  if (isset($data) && isset($data['products']) && !empty($data['products'])):
                     foreach ($data['products'] as $item):
                  ?>
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
                                 $imageHover = '/public/uploads/products/usermacdinh.png';
                              }
                              ?>


                              <img class="image" src="/public/uploads/products/<?= $item['image'] ?>" alt="" height="100%">
                              <img class="image_hover" src="/public/uploads/products/<?= $imageHover ?>" alt="image_hover">
                           </div>

                           <div class="title">
                              <div class="price">
                                 <span><?= number_format($item['price'], 0, ',', '.') ?>vnd</span>
                                    
                                 <?php if (isset($item['discount_price']) && !empty($item['discount_price'])): ?>
                                    <span class="price_sales"><?= number_format( $item['discount_price'], 0, ',', '.') ?> vnd</span>
                                 <?php endif; ?>
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
                  <?php else: ?>
                     <p>Không có sản phẩm</p>
                  <?php endif; ?>
               </div>

            </div>
         </article>

      </main>

      </div>

<?php

   }
}
?>