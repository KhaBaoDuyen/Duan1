<?php

namespace App\Views\Client\Components;

use App\Views\BaseView;

class Category extends BaseView
{
  public static function render($data = null)
  {
    $priceMin = isset($_GET['priceMin']) ? $_GET['priceMin'] : [];
?>

<aside class="col-3">
    <h4 class="title_brand">Danh mục </h4>
    <div class="brand m-auto">
        <?php
        foreach ($data as $item):
        ?>
            <a href="/product/categories/<?= $item['id'] ?>" class="brand_title d-flex justify-content-between align-content-center">
                <h5 class="col-10"><?= $item['name'] ?></h5>
                <p class="count_product col-2">(<?= $item['countCategoryProduct'] ?>)</p>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="price-filter brand m-auto">
    <form method="GET" action="" id="price-filter-form">
    <div class="filter-price">
        <h4 style="color: var(--pri-color); font-family: var(--font-family); font-size: 2rem;" >Lọc theo giá</h4>
        <label>
            <input type="checkbox" name="priceMin[]" value="0" 
                <?= (isset($_GET['priceMin']) && in_array('0', $_GET['priceMin'])) ? 'checked' : ''; ?>
                onchange="this.form.submit()"> Dưới 100,000 VND
        </label><br>
        <label>
            <input type="checkbox" name="priceMin[]" value="100000" 
                <?= (isset($_GET['priceMin']) && in_array('100000', $_GET['priceMin'])) ? 'checked' : ''; ?>
                onchange="this.form.submit()"> 100,000 VND - 500,000 VND
        </label><br>
        <label>
            <input type="checkbox" name="priceMin[]" value="500000" 
                <?= (isset($_GET['priceMin']) && in_array('500000', $_GET['priceMin'])) ? 'checked' : ''; ?>
                onchange="this.form.submit()"> 500,000 VND - 1,000,000 VND
        </label><br>
        <label>
            <input type="checkbox" name="priceMin[]" value="1000000" 
                <?= (isset($_GET['priceMin']) && in_array('1000000', $_GET['priceMin'])) ? 'checked' : ''; ?>
                onchange="this.form.submit()"> 1,000,000 VND - 3,000,000 VND
        </label><br>
        <label>
            <input type="checkbox" name="priceMin[]" value="3000000" 
                <?= (isset($_GET['priceMin']) && in_array('3000000', $_GET['priceMin'])) ? 'checked' : ''; ?>
                onchange="this.form.submit()"> Trên 3,000,000 VND
        </label><br>
    </div>
</form>

</div>

</div>

</aside>

    <?php
  }
}
?>
