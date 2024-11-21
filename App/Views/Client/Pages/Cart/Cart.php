<?php

namespace App\Views\Client\Pages\Cart;

use App\Views\BaseView;

class Cart extends BaseView { 
    public static function render($data = null)
    
    {
        
?>

      <main class="col-10 cart m-auto" style="height: auto;">
        <div class="mt-3"><h1>Giỏ hàng của bạn </h1></div><hr>
        <div class="row justify-content-center">
         <div class="col-8 cart1">
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Phân loại</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody id="cartItems">
                    <?php
                    foreach($data as $item) { ?>
                            <tr>
                        <td>1</td>
                        <td>
                            <img src="/public/assets/Client/image/products/facebook-dynamic-nuoc-hoa-nu-narciso-rodriguez-for-her-edp-30ml-1711530320_img_385x385_622873_fit_center.jpg" alt="">
                        </td>
                        <td><?= $item['name'] ?></td>
                        <td>
                            <select style="border: 1px solid white;">
                                <option value="10cm">10 cm</option>
                                <option value="20cm">20 cm</option>
                                <option value="30cm">30 cm</option>
                            </select>
                        </td>
                        <td class="price">10,000 VNĐ</td>
                        <td class="quantity-control" style="height: 92px;">
                            <input type="button" value="-" onclick="TinhTien(this, -1)">
                            <input type="number" value="<?= $item['quantity'] ?>" min="1" readonly>
                            <input type="button" value="+" onclick="TinhTien(this, 1)">
                        </td>
                        <td class="item-total">10,000 VNĐ</td>
                    </tr>
                    <?php }
                    ?>
                    
                  
                </tbody>
            </table>
        </div>
        
            <div class="col-3 d-flex justify-content-end " style="background-color:rgb(255, 255, 255); height: 499px">
                <div class="total m-4 justify-content-center">
                    <h2>Tóm Tắt</h2>
                    <p>Mã giảm giá: <strong>JKSS</strong></p>
                    <p>Phí ship: <strong><strike>50,000 VNĐ</strike> Miễn Phí</strong></p>
                    <p>Thêm Voucher:</p>
                    <input type="text" id="voucherCode" placeholder="Nhập mã voucher" style="width: 250px; margin-right: 10px;">
                    <button onclick="Voucher()" class="btn btn-primary mt-3" style="background-color: #07503d; color: white; " >Áp dụng</button>
                    <p id="voucherMessage" style="color: red;"></p> <!-- Phần tử hiển thị thông báo -->
                    <hr>
                    <p>Tổng Tiền: <strong id="grandTotal">50,000 VNĐ</strong></p>
                    <a href="/checkout" class="btn btn-primary" style="background-color: #07503d; color: white;">Đặt Hàng</a>
                </div>
            </div>
        </div>
    </main>

<?php 
    }}
    ?>