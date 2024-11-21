<?php

namespace App\Views\Client\Pages\Cart;

use App\Views\BaseView;

class Checkout extends BaseView
{
   public static function render($data = null)
   {
      ?>
   <div class="checkout-page">
            <div class="container">
                <div class="content-left">
                    <h1>THANH TOÁN</h1>
                    <form action>
                        <label for>Tên</label>
                        <input type="text" placeholder="Ten">
                        <label for>Số điện thoại</label>
                        <input type="text" placeholder="So dien thoai">
                        <label for>Địa chỉ</label>
                        <input type="text" placeholder="Dia chi">
                        <label for>Ghi chú</label>
                        <textarea placeholder="Ghi chu"></textarea>
                        <div class="zalopay">
                            <label for>Phương thức thanh toán khác:</label>
                            <img
                                src="/public/assets/Client/image/about/snapedit_1730640628539.jpeg"
                                alt>
                        </div>
                    </form>
                </div>
                <div class="content-right">
                    <div class="content1">
                        <h1>Thành tiền</h1>
                    <table>
                        <tr>
                            <th>Tổng tiền sản phẩm</th>
                            <td>170000</td>
                        </tr>
                        <tr>
                            <th>Tổng tiền giao hàng</th>
                            <td>30000</td>
                        </tr>
                        <tr>
                            <th>Tổng tiền</th>
                            <td>200000</td>
                        </tr>
                    </table>
                    <button>Thanh toán</button>
                    </div>
                </div>
            </div>
        </div>

<?php }} ?>