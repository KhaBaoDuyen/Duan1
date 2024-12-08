<?php

namespace App\Views\Client\Pages\Cart;

use App\Views\BaseView;
use App\Views\Client\Components\Menu as ComponentsMenu;

class History extends BaseView
{
   public static function render($data = null)
   {
      ?>
      <main class="d-flex justify-content-center align-items-center">
         <div class="sec_historycart_right col-10 d-flex flex-column p-4">
            <h4 class="mt-3">Lịch sử mua hàng</h4>
            <?php
            if ($data) {
               // Khởi tạo một mảng để lưu các đơn hàng đã hiển thị
               $current_order_id = null;
               $order_items = [];

               foreach ($data as $history) {
                  // Kiểm tra xem đơn hàng có thay đổi hay không
                  if ($current_order_id != $history['order_id']) {
                     // Nếu có đơn hàng cũ thì hiển thị và bắt đầu nhóm sản phẩm cho đơn hàng mới
                     if ($current_order_id !== null) {
                        ?>
                        <!-- Hiển thị thông tin đơn hàng cũ -->
                        <div class="bg-white d-flex flex-column nowrap w-100 p-3 mb-3">
                           <div class="d-flex w-100 justify-content-between align-items-center text-muted">
                              <p><?= $order_items[0]['date'] ?></p>
                              <div class="d-flex justify-content-center align-items-center">
                                 <span class="p-3 status" style=" color: var(--color-price);">
                                    <?php
                                    if ($order_items[0]['status'] == 1) {
                                       echo "Đang chờ xử lý";
                                    } elseif ($order_items[0]['status'] == 2) {
                                       echo "Đang xử lý";
                                    } elseif ($order_items[0]['status'] == 3) {
                                       echo "Đang vận chuyển";
                                    } elseif ($order_items[0]['status'] == 4) {
                                       echo "Đã được giao";
                                    } elseif ($order_items[0]['status'] == 0) {
                                       echo "Đã hủy";
                                    } else {
                                       echo "Trạng thái không xác định";
                                    }
                                    ?>
                                 </span>

                                 <form action="/history" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="method" value="PUT">
                                    <input type="hidden" name="status" value="0">
                                    <input type="hidden" name="id_order" value="<?= $order_items[0]['order_id'] ?>">

                                    <?php if ($order_items[0]['status'] != 0): ?>
                                       <button type="submit" class="btn btn-danger">Hủy Đơn</button>
                                    <?php endif; ?>
                                 </form>

                              </div>
                           </div>



                           <div class="address-info">
                              <h6 class="text-uppercase"><strong>Địa chỉ nhận hàng</strong></h6>
                              <span><strong><?= $order_items[0]['username'] ?></strong></span><br>
                              <span class="text-muted"><?= $order_items[0]['phone'] ?></span><br>
                              <span class="text-muted"><?= $order_items[0]['address'] ?></span><br>
                           </div>
                           <?php foreach ($order_items as $item) { ?>
                              <div class="historyCart d-flex row w-100  align-items-center p-2 ">
                                 <img src="/public/uploads/products/<?= $item['image'] ?>" alt="anh san pham" width="" class="col-1">
                                 <div class="title_all_products d-flex col-9">
                                    <div>
                                       <span><?= $item['name'] ?></span><br>
                                       <span class="text-muted"><?= $item['variant_key'] ?></span> <br>
                                       <span>x<?= $item['quantity'] ?></span>
                                    </div>
                                 </div>
                                 <p class="col-2 text-end"><?= number_format($item['price'], 0, ',', '.') ?> đ</p>
                              </div>
                           <?php } ?>
                           <div class="w-100 ">
                              <div class="totalHistory text-right ms-auto d-flex justify-content-between align-items-center p-2">
                                 <p class="text-muted"><?php
                                 if ($order_items[0]['pay'] == 1) {
                                    echo "Thanh toán khi nhận hàng";
                                 } elseif ($order_items[0]['pay'] == 2) {
                                    echo "Thanh toán Vnpay";
                                 }
                                 ?></p>
                                 <div class="d-flex justify-content-center align-items-center">
                                    <p class="me-2">Thành tiền:</p>
                                    <h4><?= number_format($order_items[0]['total'], 0, ',', '.') ?>đ</h4>
                                 </div>
                              </div>
                           </div>

                        </div>
                        <?php
                     }
                     // Cập nhật lại thông tin đơn hàng hiện tại và nhóm sản phẩm cho đơn hàng đó
                     $current_order_id = $history['order_id'];
                     $order_items = []; // Reset mảng sản phẩm
      
                     // Thêm sản phẩm đầu tiên của đơn hàng mới
                     $order_items[] = $history;
                  } else {
                     // Nếu là sản phẩm tiếp theo của cùng một đơn hàng
                     $order_items[] = $history;
                  }
               }

               // Hiển thị đơn hàng cuối cùng
               if (!empty($order_items)) {
                  ?>
                  <div class="bg-white d-flex flex-column nowrap w-100 p-3 mb-3">
                     <div class="d-flex w-100 justify-content-between align-items-center text-muted">
                        <p><?= $order_items[0]['date'] ?></p>
                        <div class="d-flex justify-content-center align-items-center">
                           <span class="p-3 status" style=" color: var(--color-price);">
                              <?php
                              if ($order_items[0]['status'] == 1) {
                                 echo "Đang chờ xử lý";
                              } elseif ($order_items[0]['status'] == 2) {
                                 echo "Đang xử lý";
                              } elseif ($order_items[0]['status'] == 3) {
                                 echo "Đang vận chuyển";
                              } elseif ($order_items[0]['status'] == 4) {
                                 echo "Đã được giao";
                              } elseif ($order_items[0]['status'] == 0) {
                                 echo "Đã hủy";
                              } else {
                                 echo "Trạng thái không xác định";
                              }
                              ?>
                           </span>

                           <form action="/history" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="method" value="PUT">
                              <input type="hidden" name="status" value="0">
                              <input type="hidden" name="id_order" value="<?= $order_items[0]['order_id'] ?>">

                              <?php if ($order_items[0]['status'] != 0): ?>
                                 <button type="submit" class="btn btn-danger">Hủy Đơn</button>
                              <?php endif; ?>
                           </form>

                        </div>
                     </div>



                     <div class="address-info d-flex">
                        <h6 class="text-uppercase"><strong>Địa chỉ nhận hàng</strong></h6>
                        
                           <span><strong><?= $order_items[0]['username'] ?></strong></span><br>
                           <span class="text-muted"><?= $order_items[0]['phone'] ?></span><br>
                           <span class="text-muted"><?= $order_items[0]['address'] ?></span><br>
                        
                     </div>
                     <?php foreach ($order_items as $item) { ?>
                        <div class="historyCart d-flex row w-100  align-items-center p-2 ">
                           <img src="/public/uploads/products/<?= $item['image'] ?>" alt="anh san pham" width="" class="col-1">
                           <div class="title_all_products d-flex col-9">
                              <div>
                                 <span><?= $item['name'] ?></span><br>
                                 <span class="text-muted"><?= $item['variant_key'] ?></span> <br>
                                 <span>x<?= $item['quantity'] ?></span>
                              </div>
                           </div>
                           <p class="col-2 text-end"><?= number_format($item['price'], 0, ',', '.') ?> đ</p>
                        </div>
                     <?php } ?>
                     <div class="w-100 ">
                        <div class="totalHistory text-right ms-auto d-flex justify-content-between align-items-center p-2">
                           <p class="text-muted"><?php
                           if ($order_items[0]['pay'] == 1) {
                              echo "Thanh toán khi nhận hàng";
                           } elseif ($order_items[0]['pay'] == 2) {
                              echo "Thanh toán Vnpay";
                           }
                           ?></p>
                           <div class="d-flex justify-content-center align-items-center">
                              <p class="me-2">Thành tiền:</p>
                              <h4><?= number_format($order_items[0]['total'], 0, ',', '.') ?>đ</h4>
                           </div>
                        </div>
                     </div>

                  </div>
                  <?php
               }
            }
            ?>
         </div>
      </main>




   <?php }
} ?>