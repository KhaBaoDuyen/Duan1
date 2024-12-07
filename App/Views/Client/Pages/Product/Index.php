<?php

namespace App\Views\Client\Pages\Product;

use App\Views\BaseView;
use App\Views\Client\Components\Category as ComponentsCategory;

class Index extends BaseView
{
   public static function render($data = null)
   {
 
      ?>

      <section class="product_banner">
         <div class="box_banner col-10 m-auto d-flex">
            <div class="product_banner_left col-8 m-0">
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
         <div class="box_total d-flex col-10 row m-auto ">
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

      <main class="col-10 m-auto d-flex">
    <?php
    ComponentsCategory::render($data['categories']);
    ?>
    <article class="col-9">
        <nav>
            <div class="tune">
                <div class="tune_icon">
                    <span class="material-symbols-outlined">tune</span>
                </div>
                <div class="tune_down">
                    <ul class="sort-list">
                        <li>
                            <form action="" method="GET">
                                <div class="sort-options">
                                    <span class="sort-option" style="color: #ff8e4d;" onclick="location.href='?sort=asc'">A-z</span>
                                    <span class="sort-option" style="color: #ff8e4d;" onclick="location.href='?sort=desc'">Z-a</span>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="all_products row">
            <?php
            if (isset($data) && isset($data['products']) && !empty($data['products'])):
                foreach ($data['products'] as $item):
                    ?>
                    <a class="card" href="/product/<?= $item['id'] ?>">
                        <div class="box_image">
                            <img class="image" src="/public/uploads/products/<?= $item['image'] ?>" alt="" height="100%">
                        </div>
                        <div class="title">
    <div class="price">
        <span><?= number_format($item['price'], 0, ',', '.') ?> VND</span>
        <?php if (isset($item['discount_price']) && !empty($item['discount_price'])): ?>
            <span class="price_sales"><?= number_format($item['discount_price'], 0, ',', '.') ?> VND</span>
        <?php endif; ?>
    </div>
    <h4 class="name_product"><?= $item['name'] ?></h4>
    <p class="content"><?= $item['short_description'] ?></p>
</div>

                        <?php
                        if (isset($item['discount_price']) && $item['discount_price'] > 0 && isset($item['price']) && $item['price'] > 0) {
                            $discount_percentage = round((($item['price'] - $item['discount_price']) / $item['price']) * 100, 2);
                            ?>
                            <div class="sale">-<?= $discount_percentage ?>%</div>
                        <?php } ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có sản phẩm nào trong tầm giá</p>
            <?php endif; ?>
        </div>

        <!-- Phân trang -->
        <div class="pagination">
            <?php if ($data['currentPage'] > 1): ?>
                <a href="?page=<?= $data['currentPage'] - 1 ?>&sort=<?= isset($_GET['sort']) ? $_GET['sort'] : '' ?>" class="prev">Trước</a>
            <?php endif; ?>

            <?php for ($page = 1; $page <= $data['totalPages']; $page++): ?>
                <a href="?page=<?= $page ?>&sort=<?= isset($_GET['sort']) ? $_GET['sort'] : '' ?>" class="<?= $page == $data['currentPage'] ? 'active' : '' ?>"><?= $page ?></a>
            <?php endfor; ?>

            <?php if ($data['currentPage'] < $data['totalPages']): ?>
                <a href="?page=<?= $data['currentPage'] + 1 ?>&sort=<?= isset($_GET['sort']) ? $_GET['sort'] : '' ?>" class="next">Tiếp</a>
            <?php endif; ?>
        </div>

    </article>
</main>



      <?php
   }
}
?>