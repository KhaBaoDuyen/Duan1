<?php

namespace App\Views\Admin\Pages\Contact;

use App\Views\BaseView;

class Edit extends BaseView
{
  public static function render($data = null)
  {
    ?>

    <div class="row">
      <div class="col-lg-6 m-auto">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Sửa phản hồi</h6>
          </div>
          <div class="card-body">
            <?php
            // Lấy lỗi từ session
            $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
            ?>
            <form class="form-horizontal" action="/admin/contact/<?= $data['id'] ?>" method="POST"
              enctype="multipart/form-data">
              <input type="hidden" name="method" id="" value="PUT">

              <div class="form-group">
                <label for="firstname">Họ</label>
                <input type="text" class="form-control" value="<?= $data['firstname'] ?>" name="firstname" id="firstname"
                  aria-describedby="categogylHelp" readonly>
                <?php if (isset($errors['firstname'])): ?>
                  <span style="color:red;"><?= $errors['firstname'] ?></span>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="lastname">Ten</label>
                <input type="text" class="form-control" value="<?= $data['lastname'] ?>" name="lastname" id="lastname"
                  aria-describedby="categogylHelp" readonly>
                <?php if (isset($errors['lastname'])): ?>
                  <span style="color:red;"><?= $errors['lastname'] ?></span>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" value="<?= $data['email'] ?>" name="email" id="email"
                  aria-describedby="categogylHelp" readonly>
                <?php if (isset($errors['email'])): ?>
                  <span style="color:red;"><?= $errors['email'] ?></span>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" class="form-control" value="<?= $data['phone'] ?>" name="phone" id="phone"
                  aria-describedby="categogylHelp" readonly>
                <?php if (isset($errors['phone'])): ?>
                  <span style="color:red;"><?= $errors['phone'] ?></span>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="name">Nội dung phản hồi</label>
                <input type="text" class="form-control" value="<?= $data['message'] ?>" name="message" id="message"
                  aria-describedby="categogylHelp" readonly>
                <?php if (isset($errors['message'])): ?>
                  <span style="color:red;"><?= $errors['name'] ?></span>
                <?php endif; ?>
              </div>


              <div class="form-group">
                <label for="exampleInputPassword1">Chọn trạng thái:</label>
                <div class="custom-file">
                  <select class="select2 form-control shadow-none" style="width: 100%; height:36px;" id="status"
                    name="status" value="<?= $data['status'] ?>">
                    <option value="1" <?= ($data['status'] == 1 ? 'selected' : '') ?>>Chưa phản hồi</option>
                    <option value="0" <?= ($data['status'] == 0 ? 'selected' : '') ?>>Đã phản hồi</option>
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
