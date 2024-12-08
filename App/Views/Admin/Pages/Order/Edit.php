<?php

namespace App\Views\Admin\Pages\Order;

use App\Views\BaseView;

class Edit extends BaseView
{
  public static function render($data = null, $return = null)
  {
?>

    <div class="row p-1">
      <div class="col-lg-4 ">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h4>
          </div>
          <div class="card-body">
            <?php
            // Lấy lỗi từ session
            $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
            ?>
            <form class="form-horizontal row" action="/admin/order/<?= $data['id'] ?>" method="POST"
              enctype="multipart/form-data">
              <input type="hidden" name="method" id="" value="PUT">

              <div class="form-group col-12">
                <label for="name">Người dùng</label>
                <input type="text" class="form-control" value="<?= $data['user_name'] ?>" name="user_name" id="user_name"
                  aria-describedby="categogylHelp" readonly>
                <?php if (isset($errors['user_name'])): ?>
                  <span style="color:red;"><?= $errors['user_name'] ?></span>
                <?php endif; ?>
              </div>


              <div class="form-group col-6">
                <label for="email">Email</label>
                <input type="text" class="form-control" value="<?= $data['email'] ?>" name="email" id="email"
                  aria-describedby="categogylHelp" readonly>
                <?php if (isset($errors['email'])): ?>
                  <span style="color:red;"><?= $errors['email'] ?></span>
                <?php endif; ?>
              </div>

              <div class="form-group col-6">
                <label for="phone">Số điện thoại</label>
                <input type="text" class="form-control" value="<?= $data['phone'] ?>" name="phone" id="phone"
                  aria-describedby="categogylHelp" readonly>
                <?php if (isset($errors['phone'])): ?>
                  <span style="color:red;"><?= $errors['phone'] ?></span>
                <?php endif; ?>
              </div>


              <div class="form-group col-6">
                <label for="total_price">Tổng giá</label>
                <input type="text" class="form-control" value="<?= number_format($data['total_price'], 0, ',', '.') ?>đ" name="total_price" id="total_price"
                  aria-describedby="categogylHelp" readonly>
                <?php if (isset($errors['total_price'])): ?>
                  <span style="color:red;"><?= $errors['total_price'] ?></span>
                <?php endif; ?>
              </div>


              <div class="form-group col-6">
                <label for="pay">Phương thức thanh toán</label>
                <input type="text" class="form-control" value="<?= $data['pay'] == 1 ? 'Thanh toán khi nhận hàng' : 'VNpay' ?>" name="pay" id="pay"
                  aria-describedby="categogylHelp" readonly>
                <?php if (isset($errors['pay'])): ?>
                  <span style="color:red;"><?= $errors['pay'] ?></span>
                <?php endif; ?>
              </div>

              <div class="form-group col-6">
                <label for="address">Địa chỉ</label>
                <input type="text" class="form-control" value="<?= $data['address'] ?>" name="address" id="address"
                  aria-describedby="categogylHelp" readonly>
                <?php if (isset($errors['address'])): ?>
                  <span style="color:red;"><?= $errors['address'] ?></span>
                <?php endif; ?>
              </div>

              <div class="form-group col-6">
                <label for="email">Ghi chú</label>
                <input type="text" class="form-control" value="<?= $data['email'] ?>" name="email" id="email"
                  aria-describedby="categogylHelp" readonly>
                <?php if (isset($errors['email'])): ?>
                  <span style="color:red;"><?= $errors['email'] ?></span>
                <?php endif; ?>
              </div>


              <div class="form-group col-12">
                <label for="exampleInputPassword1">Chọn trạng thái:</label>
                <div class="custom-file">
                  <select class="select2 form-control shadow-none" style="width: 100%; height:36px;" id="status"
                    name="status" value="<?= $data['status'] ?>">
                    <option value="1" <?= ($data['status'] == 1 ? 'selected' : '') ?>>Chờ xử lý</option>
                    <option value="2" <?= ($data['status'] == 2 ? 'selected' : '') ?>>Đang xử lý</option>
                    <option value="3" <?= ($data['status'] == 3 ? 'selected' : '') ?>>Đang vận chuyển</option>
                    <option value="4" <?= ($data['status'] == 4 ? 'selected' : '') ?>>Đã hoàn thành</option>
                  </select>
                  <?php if (isset($errors['status'])): ?>
                    <span style="color:red;"><?= $errors['status'] ?></span>
                  <?php endif; ?>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
            <?php
            unset($_SESSION['errors']);
            ?>
          </div>
        </div>
      </div>
      <!--Row-->
      <!-- Danh sach san pham -->
      <?php if (isset($return)): ?>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h4>
          </div>
          <div class="card-body">
            <form class="row" action="">
              
                <?php foreach ($return as $item): ?>

                  <div class="form-group col-4">
                    <label for="product_name">Tên sản phẩm</label>
                    <input type="text" class="form-control" value="<?= $item['product_name'] ?>" name="product_name" id="product_name"
                      aria-describedby="categogylHelp" readonly>
                    <?php if (isset($errors['product_name'])): ?>
                      <span style="color:red;"><?= $errors['product_name'] ?></span>
                    <?php endif; ?>
                  </div>

                  <div class="form-group col-2">
                    <label for="quantity">Số lượng</label>
                    <input type="text" class="form-control" value="<?= $item['quantity'] ?>" name="quantity" id="quantity"
                      aria-describedby="categogylHelp" readonly>
                    <?php if (isset($errors['quantity'])): ?>
                      <span style="color:red;"><?= $errors['quantity'] ?></span>
                    <?php endif; ?>
                  </div>

                  <div class="form-group col-2">
                    <label for="date">Thời gian</label>
                    <input type="text" class="form-control" value="<?= $item['date'] ?>" name="date" id="date"
                      aria-describedby="categogylHelp" readonly>
                    <?php if (isset($errors['date'])): ?>
                      <span style="color:red;"><?= $errors['date'] ?></span>
                    <?php endif; ?>
                  </div>

                  <div class="form-group col-2">
                    <label for="product_price">Giá</label>
                    <input type="text" class="form-control" value="<?= number_format($item['product_price'], 0, ',', '.') ?>đ" name="product_price" id="product_price"
                      aria-describedby="categogylHelp" readonly>
                    <?php if (isset($errors['product_price'])): ?>
                      <span style="color:red;"><?= $errors['product_price'] ?></span>
                    <?php endif; ?>
                  </div>

                  <div class="form-group col-2">
                    <label for="variant_key">Loại</label>
                    <input type="text" class="form-control" value="<?= $item['variant_key'] ?: 'Không có' ?>" name="variant_key" id="variant_key"
                      aria-describedby="categogylHelp" readonly>
                    <?php if (isset($errors['variant_key'])): ?>
                      <span style="color:red;"><?= $errors['product_privariant_keyce'] ?></span>
                    <?php endif; ?>
                  </div>

                <?php endforeach; ?>
              
            </form>
          </div>
        </div>
      </div>
      <?php else: ?>
                <p>Không có sản phẩm nào trong đơn hàng này.</p>
              <?php endif; ?>

      <!-- Modal Logout -->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to logout?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
              <a href="login.html" class="btn btn-primary">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
  }
}
