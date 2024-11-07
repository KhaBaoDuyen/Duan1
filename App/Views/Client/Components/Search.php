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
                <a class="card ">
                    <div class="box_image">
                        <img class="image" src="<?= htmlspecialchars($item['image']) ?>" alt="" height="100%">
                        <img class="image_hover" src="<?= htmlspecialchars($item['image_product_url']) ?>" alt="image_hover">
                    </div>

                    <div class="title">
                        <div class="price">
                            <span><?= htmlspecialchars($item['price']) ?> vnd</span>
                            <?php if (isset($item['discount_price']) && !empty($item['discount_price'])): ?>
                                <span class="price_sales"> <?= htmlspecialchars($item['discount_price']) ?> </span>
                            <?php endif; ?>
                        </div>
                        <h4 class="name_product"><?= htmlspecialchars($item['name']) ?></h4>
                        <p class="content"><?= htmlspecialchars($item['short_description']) ?></p>
                    </div>
                    <?php
                    $discount_percentage = round((($item['price'] - $item['discount_price']) / $item['price']) * 100, 2);
                    ?>
                    <?php if (isset($item['discount_price']) && !empty($item['discount_price'])): ?>
                        <div class="sale">
                            -<?= $discount_percentage ?>%
                        </div>
                    <?php endif; ?>
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