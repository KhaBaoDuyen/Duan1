<?php

namespace App\Views\Client\Pages\Cart;

use App\Views\BaseView;

class Cart extends BaseView
{
    public static function render($data = null)
    {
        $isLoggedIn = isset($_SESSION['user']);

?>

<main class="col-10 cart m-auto" style="height: auto;">
   <?php if (!$isLoggedIn):
            ?>
   <h2 class="login-notice">Vui lòng đăng nhập để thêm sản phẩm</h2>
   <?php else: ?>
   <form action="/cart" method="post" enctype="multipart/form-data">
      <input type="hidden" name="method" value="PUT">

      <div class="mt-3 d-flex justify-content-between">
         <h1>Giỏ hàng của bạn</h1>
         <button type="submit" class="btn btn-outline-success">Cập nhật</button>
      </div>
      <hr>
      <div class="row justify-content-between">
         <div class="cart1">
            <table class="table">
               <thead>
                  <tr>
                
                     <th>Stt</th>
                     <th>Ảnh</th>
                     <th width="100px">Tên sản phẩm</th>
                     <th>Phân loại</th>
                     <th>Giá</th>
                     <th>Số lượng</th>
                     <th>Thành tiền</th>
                     <th>Xoá</th>
                  </tr>
               </thead>
               <tbody id="cartItems">
                  <?php if (isset($data)): ?>
                  <?php $counter = 1; ?>
                  <?php foreach ($data as $item): ?>

                  <tr>
                     
                     <td><?= $counter++ ?></td>
                     <td><img src="/public/uploads/products/<?= $item['product_image'] ?>" alt="Lỗi ảnh" height="100%">
                     </td>
                     <td width="20%"><?= $item['product_name'] ?? '' ?></td>
                     <td width="10%"><?= $item['variant_name'] ?? '' ?></td>
                     <td class="price">
                        <?php if (isset($item['variant_price']) && !empty($item['variant_price'])) { ?>
                        <?= number_format($item['variant_price'], 0, ',', '.') ?>đ
                        <?php } elseif (!isset($item['variant_price'])) { ?>
                        <?= number_format($item['product_discount_price'], 0, ',', '.') ?>đ

                        <?php } else { ?>
                        <?= number_format($item['price'], 0, ',', '.') ?>đ

                        <?php } ?>

                     </td>
                     <td class="quantity">
                        <div class="quantity-control">
                           <input type="button" value="-" onclick="TinhTien(this, -1)">
                           <input type="number"
                              name="cart[<?= $item['id_product'] ?>][<?= $item['variant_key'] ?>][quantity]"
                              value="<?= $item['quantity'] ?>" min="1">
                           <input type="button" value="+" onclick="TinhTien(this, 1)">
                        </div>
                     </td>
                     <td class="item-total">
                        <?php if (isset($item['variant_price']) && !empty($item['variant_price'])) { ?>
                        <?= number_format($item['variant_price'] * $item['quantity'], 0, ',', '.') ?>đ
                        <?php } elseif (!isset($item['variant_price'])) { ?>
                        <?= number_format($item['product_discount_price'] * $item['quantity'], 0, ',', '.') ?>đ

                        <?php } else { ?>
                        <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ

                        <?php } ?>
                     </td>
   </form>
   <td>
      <form action="/cart/<?= $item['id_product'] ?>" method="POST" style="display: inline-block;"
         onsubmit="return confirm('Bạn có chắc chắn xóa sản phẩm <?= $item['product_name'] ?? 'Sản phẩm' ?>?')">
         <input type="hidden" name="method" value="DELETE">
         <input type="hidden" name="selected_variant" value="<?= $item['variant_key'] ?>">
         <input type="hidden" name="id_product" value="<?= $item['id_product'] ?>">
         <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
      </form>


   </td>
   </tr>


   <?php endforeach; ?>
   <?php else: ?>
   <tr>
      <td colspan="8" class="text-center">Giỏ hàng của bạn đang trống.</td>
   </tr>
   <?php endif; ?>
   </tbody>
   </table>
   <div class=" box_Cart p-3 ">
      <form action="/checkout" method="POST" id="order">
         <input type="hidden" name="method" value="POST">
         <a href="/checkout" class="checkout">MUA HÀNG</a>
      </form>

   </div>
   </div>
   </div>

   <?php endif; ?>
</main>



<?php
    }
}
?>