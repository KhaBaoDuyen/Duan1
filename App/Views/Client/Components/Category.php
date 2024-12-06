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
    <form action="" method="GET">
        <div class="price-options">
<div class="filter-header d-flex justify-content-between align-items-center" style="width: 90%; ">
    <h4 class="filter-title" style="color: var(--pri-color); font-family: var(--font-family); font-size: 2rem;">
        Lọc theo giá:
    </h4>
    <div>
        <button type="submit" class="btn btn-primary custom-btn">Lọc</button>
    </div>
</div>



            <label for="price0-100k">
                <input type="checkbox" name="priceMin[]" value="0" class="price-checkbox" 
                    <?php echo (in_array('0', $priceMin)) ? 'checked' : ''; ?>>
                0 VND - 100,000 VND
            </label><br>

            <label for="price100k-500k">
                <input type="checkbox" name="priceMin[]" value="100000" class="price-checkbox" 
                    <?php echo (in_array('100000', $priceMin)) ? 'checked' : ''; ?>>
                100,000 VND - 500,000 VND
            </label><br>

            <label for="price500k-1M">
                <input type="checkbox" name="priceMin[]" value="500000" class="price-checkbox" 
                    <?php echo (in_array('500000', $priceMin)) ? 'checked' : ''; ?>>
                500,000 VND - 1,000,000 VND
            </label><br>

            <label for="price1M-3M">
                <input type="checkbox" name="priceMin[]" value="1000000" class="price-checkbox" 
                    <?php echo (in_array('1000000', $priceMin)) ? 'checked' : ''; ?>>
                1,000,000 VND - 3,000,000 VND
            </label><br>

            <label for="price3M-5M">
                <input type="checkbox" name="priceMin[]" value="3000000" class="price-checkbox" 
                    <?php echo (in_array('3000000', $priceMin)) ? 'checked' : ''; ?>>
                3,000,000 VND - 5,000,000 VND
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
