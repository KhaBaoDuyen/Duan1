<?php

namespace App\Views\Client\Pages\Cart;

use App\Views\BaseView;
use App\Views\Client\Components\Menu as ComponentsMenu;
class Thanks extends BaseView
{
   public static function render($data = null)
   {
      ?>
      <?php if (!empty($data)): ?>
         <main class="col-10 m-auto thankyou d-flex bg-light">
            <div class="d-flex">
               <div class="col-7 d-flex flex-column">
                  <div class="">
                     <p>Cảm ơn bạn đã đặt hàng tại website của chúng tôi. <br>
                        Thông tin đơn hàng của bạn đã được gửi đến email của bạn.</p>
                     <p>Email xác nhận đã được gửi đến địa chỉ: <?= $data['bill'][0]["email"] ?></p>
                     <div class="flex-column justify-content-center align-items-center d-flex text-center box-camon ">
                        <img src="/public/assets/Client/image/icon/receipt.png" alt="">
                        <h3 class="mt-2">Thanh toán thành công </h3>
                     </div>
                     <h6>Mã đơn hàng:<?= $data["id_order"] ?? $data[''] ?></h6>
                     <h6>Ngày đặt hàng: <?= $data['bill'][0]["date"] ?></h6>
                  </div>

                  <div class="d-flex justify-content-between align-items-end">
                     <span class="col-8">
                        <p class="text-justify">
                           Xin chào, <br>
                           Đây là một thông báo xác nhận đơn hàng của khách hàng <?= $data['bill'][0]["name"] ?>
                           . Đơn hàng đã được đặt thành công và
                           sẽ sớm được giao đến địa chỉ của khách hàng. Khách hàng có thể theo dõi
                           đơn hàng của mình thông qua tài
                           khoản cá nhân hoặc liên kết được gửi qua email</p>
                     </span>
                     <a class="tieptucmuahang " href="">Tiếp tục mua hàng</a>
                  </div>
               </div>


               <div class="col-5">
                  <h3 style="color: var(--color-price);">Thông tin giao hàng </h3>
                  <table class=" bg-transparent  table-custom bg-light">
                     <thead class="">
                        <tr>
                           <th scope="row" class="">Tên người nhận:</th>
                           <td><?= $data['bill'][0]["name"] ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Địa chỉ:</th>
                           <td><?= $data['bill'][0]["address"] ?></td>
                        </tr>
                        <tr>
                           <th scope="row" width="">Vận chuyển:</th>
                           <td>Giao hàng nhanh</td>
                        </tr>
                        <tr>
                           <th scope="row" width="">Thanh toán:</th>
                           <td>
                              <?= $data['bill'][0]["pay"] == 1 ? "Thanh toán khi nhận hàng" : ($data['bill'][0]["pay"] == 2 ? "Thanh toán bằng ví VNPAY " : "") ?>

                           </td>
                        </tr>
                     <tbody class="text-left border-top mb-3">
                        <tr class="">
                           <td>Image</td>
                           <td width="45%" >Tên sản phẩm</td>
                           <td></td>
                           <td>Giá</td>
                        </tr>
                        <?php foreach ($data['order'] as $order): ?>
                           <tr>
                              <td><img width="50px" src="/public/uploads/products/<?= $order['product_image'] ?>" alt=""></td>
                              <td><?= $order['product_name'] ?><br>
                                 <div>
                                    <?= isset($order['variant_name']) ? $order['variant_name'] : "" ?>
                                 </div>
                              </td>
                              <td>x<?= $order['quantity'] ?>
                              </td>
                              <td class="price">
                                 <span>
                                    <?php if (isset($order['variant_name']) && isset($order['variant_price'])) { ?>
                                       <?= number_format($order['variant_price'], 0, ',', '.') ?>đ
                                    <?php } elseif (!isset($order['variant_price'])) { ?>
                                       <?= number_format($order['product_discount_price'], 0, ',', '.') ?>đ
                                    <?php } else { ?>
                                       <?= number_format($order['price'], 0, ',', '.') ?>đ

                                    <?php } ?>

                                 </span>
                              </td>
                           </tr>
                        <?php endforeach; ?>

                     </tbody>
                     <tfoot>
                        <tr class="" style="border-top: 2px solid var(--color-price);">
                           <th scope="row" class="" style="font-size: larger; color: var(--color-price);">Tổng đơn:</th>
                           <td class="fw-bold" style="font-size: larger; "><?= number_format($data['bill'][0]["total"], 0, ',', '.' ) ?> đ</td>
                        </tr>
                     </tfoot>
                     </thead>
                  </table>
               </div>

            </div>



         </main>
      <?php endif; ?>
   <?php }

} ?>