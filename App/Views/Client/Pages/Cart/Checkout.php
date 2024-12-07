<?php

namespace App\Views\Client\Pages\Cart;

use App\Views\BaseView;

class Checkout extends BaseView
{
   public static function render($data = null)
   {
      ?>
      <div class="checkout-page col-10 m-auto" id="checkout">
         <form action="/order" method="post" class="container container_checkout m-auto">
            <input type="hidden" name="method" value="POST">

            <div class="content-right col-12 mb-3">
               <div class="content1">

                  <table>
                     <thead class="text-center">
                        <tr>
                           <th></th>
                           <th colspan="2">Sản phẩm</th>
                           <th>Loại</th>
                           <th>Đơn giá</th>
                           <th>Số lượng</th>
                           <th>Thành tiền</th>
                        </tr>
                     </thead>
                     <tbody class="text-center">

                        <?php $counter = 1; ?>
                        <?php
                        $total = 0;
                        foreach ($data as $item) {
                           $total_price = $item['product_price'] * $item['quantity'];
                           $total += $total_price;
                           ?>
                           <tr>
                              <td><?= $counter++ ?></td>
                              <td width="10%" class="p-2">
                                 <img width="100%" src="/public/uploads/products/<?= $item['product_image'] ?>"
                                    alt="Ảnh sản phẩm">
                              </td>
                              <td width="230px" class="p-1"><span><?= $item['product_name'] ?></span>
                              </td>
                              <td> <span class="text-muted">
                                    <?php if (isset($item['product_variant']) && !empty($item['product_variant'])) { ?>
                                       Loại: <?= $item['variant_name'] ?>
                                    <?php } ?></span></td>

                              <td><?= number_format($item['product_price'], 0, ',', '.') ?>đ</td>
                              <td><?= $item['quantity'] ?? 0 ?></td>
                              <td><?= number_format($item['product_price'] * $item['quantity'], 0, ',', '.') ?>đ</td>
                           </tr>
                        <?php } ?>

                     </tbody>

                  </table>



               </div>

            </div>
            <div class="content-left col-12 row m-auto">
               <h3>Địa chỉ nhận hàng</h3>
               <div class="col-6">
                  <label for>Tên</label>
                  <input type=" text" placeholder="Vui lòng nhập tên người nhận" name="name">
                  <label for>Số điện thoại</label>
                  <input type="text" placeholder="Vui lòng nhập số điện thoại" name="phone">
                  <label for>Email</label>
                  <input type="text" placeholder="Vui lòng nhập địa chỉ email" name="email">
                  <label for>Địa chỉ</label>
                  <input type="text" placeholder="Vui lòng nhập địa chỉ" name="address">
                  <label for>Ghi chú</label>
                  <textarea placeholder="Ghi chú"></textarea>
               </div>

               <div class="payment-method col-6 d-flex flex-column justify-content-between">
                  <div class="">
                     <label for="payment-method">Phương thức thanh toán :</label>
                     <div class="mb-1">
                        <label><input type="radio" alt="cod" name="iCheck" class="iCheck iradio_flat-blue" value="1" checked>
                           Thanh
                           toán
                           khi nhận hàng
                        </label>
                     </div>
                     <div class="mb-1">
                        <label><input type="radio" alt="cod" name="iCheck" class="iCheck iradio_flat-blue" value="2"> Ví <img
                              src="/public/assets/Client/image/icon/OIP.jpg" alt="">

                        </label>
                     </div>

                  </div>
                  <div class="thanhtoan">
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="total_check d-flex justify-content-start align-items-center">
                           <h5><b>Tổng tiền:</b></h5>
                           <h5 class="ms-2"><?= number_format($total, 0, ',', '.') ?> đ</h5>
                           <input type="hidden" name="total" value="<?= $total ?>">
                        </div>
                        <button class="btn btn-primary" name="redirect">Thanh toán</button>
                     </div>
                  </div>
               </div>

            </div>

         </form>

      </div>


   <?php }
} ?>