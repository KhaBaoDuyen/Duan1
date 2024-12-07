<?php

namespace App\Views\Client\Pages\Cart;

use App\Views\BaseView;

class Checkout extends BaseView
{
   public static function render($data = null)
   {
      $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
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
                                    <?= isset($item['product_variant']) && isset($item['variant_name'])
                                       ? 'Loại: ' . htmlspecialchars($item['variant_name'])
                                       : '' ?>
                                 </span></td>

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
                  <div class="form-group">
                     <label for="name">Tên</label>
                     <input type="text" placeholder="Vui lòng nhập tên người nhận" name="name" class="<?= isset($errors['name']) ? 'input-error' : '' ?>"
                        value="<?= $_POST['name'] ?? '' ?>">
                     <?php if (isset($errors['name'])): ?>
                        <span style="color:red;"><?= $errors['name'] ?></span>
                     <?php endif; ?>
                  </div>

                  <div class="form-group">
                     <label for="phone">Số điện thoại</label>
                     <input type="text" placeholder="Vui lòng nhập số điện thoại" name="phone"
                        value="<?= $_POST['phone'] ?? '' ?>"  class="<?= isset($errors['phone']) ? 'input-error' : '' ?>">
                     <?php if (isset($errors['phone'])): ?>
                        <span style="color:red;"><?= $errors['phone'] ?></span>
                     <?php endif; ?>
                  </div>

                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="text" placeholder="Vui lòng nhập địa chỉ email" name="email" class="<?= isset($errors['email']) ? 'input-error' : '' ?>"
                        value="<?= $_POST['email'] ?? '' ?>">
                     <?php if (isset($errors['email'])): ?>
                        <span style="color:red;"><?= $errors['email'] ?></span>
                     <?php endif; ?>
                  </div>

                  <div class="form-group">
                     <label for="address">Địa chỉ</label>
                     <input type="text" placeholder="Vui lòng nhập địa chỉ" name="address" class="<?= isset($errors['address']) ? 'input-error' : '' ?>"
                        value="<?= $_POST['address'] ?? '' ?>">
                     <?php if (isset($errors['address'])): ?>
                        <span style="color:red;"><?= $errors['address'] ?></span>
                     <?php endif; ?>
                  </div>

                  <div class="form-group">
                     <label for="note">Ghi chú</label>
                     <textarea placeholder="Ghi chú" name="note"><?= $_POST['note'] ?? '' ?></textarea>
                     <?php if (isset($errors['note'])): ?>
                        <span style="color:red;"><?= $errors['note'] ?></span>
                     <?php endif; ?>
                  </div>
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
     <?php
                            unset($_SESSION['errors']);
                            ?>

   <?php }
} ?>