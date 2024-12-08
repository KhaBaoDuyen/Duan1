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

                        <div>
                            <label for="price0-100k" class="d-flex  ">
                                <input type="checkbox" id="price0-100k" name="priceMin[]" value="0" class="price-checkbox"
                                    <?php echo (in_array('0', $priceMin)) ? 'checked' : ''; ?>>
                                <p>0đ - 100,000đ</p>
                            </label>
                        </div>

                        <div>
                            <label for="price100k-500k" class="d-flex  ">
                                <input type="checkbox" id="price100k-500k" name="priceMin[]" value="100000" class="price-checkbox"
                                    <?php echo (in_array('100000', $priceMin)) ? 'checked' : ''; ?>>
                                <p>100,000đ - 500,000đ</p>
                            </label>
                        </div>

                        <div>
                            <label for="price500k-1M" class="d-flex  ">
                                <input type="checkbox" id="price500k-1M" name="priceMin[]" value="500000" class="price-checkbox"
                                    <?php echo (in_array('500000', $priceMin)) ? 'checked' : ''; ?>>
                                <p>500,000đ - 1,000,000đ</p>
                            </label>
                        </div>

                        <div>
                            <label for="price1M-3M" class="d-flex  ">
                                <input type="checkbox" id="price1M-3M" name="priceMin[]" value="1000000" class="price-checkbox"
                                    <?php echo (in_array('1000000', $priceMin)) ? 'checked' : ''; ?>>
                                <p>1,000,000đ - 3,000,000đ</p>
                            </label>
                        </div>

                        <div>
                            <label for="price3M-5M" class="d-flex  ">
                                <input type="checkbox" id="price3M-5M" name="priceMin[]" value="3000000" class="price-checkbox"
                                    <?php echo (in_array('3000000', $priceMin)) ? 'checked' : ''; ?>>
                                <p>3,000,000đ - 5,000,000đ</p>
                            </label>
                        </div>


                    </div>
                </form>
            </div>

            </div>

        </aside>

<?php
    }
}
?>