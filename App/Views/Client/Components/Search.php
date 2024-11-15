<?php

namespace App\Views\Client\Components;

use App\Views\BaseView;

class Search extends BaseView
{
public static function render($data = null)
{
    ?>

    <?php
    if (isset($data['keyword']) && $data['keyword'] !== '') {
        echo '<div class="d-flex col-10 p-3 m-auto"><h5 >Kết quả tìm kiếm</h5>: ' . htmlspecialchars($data['keyword']) . '</div>';
    } else {
        echo "Không có từ khóa tìm kiếm nào được nhập.";
    }
    ?>

    <div class="row box_card col-10 p-3 m-auto">
        <?php
        if (isset($data) && isset($data['products']) && !empty($data['products'])):
            foreach ($data['products'] as $item): ?>
                     <a class="card" href="/product/<?= $item['id']?>" >
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
                          <span><?= number_format(  $item['price'], 0, ',', '.')  ?> vnd</span>
                              <?php if (isset($item['discount_price']) && !empty($item['discount_price'])): ?>
                                 <span class="price_sales"> <?= number_format($item['discount_price'] , 0, ',', '.') ?> vnd</span>
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
            <div class="col-12">
                <p style="width: max-content;" class="text-danger">Không tìm thấy sản phẩm nào với từ khóa tìm kiếm của bạn.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php
}
}
?>