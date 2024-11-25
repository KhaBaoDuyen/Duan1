<?php

namespace App\Views\Client\Components;

use App\Views\BaseView;

class Category extends BaseView
{
  public static function render($data = null)
  {
?>


    <aside class="col-3">
      <h4 class="title_brand">Danh mục </h4>

      <div class="brand m-auto">
        <?php
        foreach ($data as $item):
        ?>
          <a href="/product/categories/<?= $item['id'] ?>" class="brand_title d-flex  justify-content-between align-content-center">
            <h5 class="col-10"><?= $item['name'] ?></h5>
            <p class="count_product col-2">(30)</p>
          </a>
        <?php endforeach; ?>

      </div>

    </aside>

<?php
  }
}
?>