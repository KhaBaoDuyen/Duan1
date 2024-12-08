<?php

namespace App\Views\Admin\Pages\Category;

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
            <h6 class="m-0 font-weight-bold text-primary">Thêm Danh mục</h6>
          </div>
          <div class="card-body">
            <?php
            // Lấy lỗi từ session
            $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
            ?>
            <form class="form-horizontal" action="/admin/categories/<?= $data['id'] ?>" method="POST"
              enctype="multipart/form-data">
             
              <input type="hidden" name="method" id="" value="PUT">
              <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" class="form-control" value="<?= $data['name'] ?>" name="name" id="name"
                  aria-describedby="categogylHelp" placeholder=" Nhập tên danh mục ...">
                <?php if (isset($errors['name'])): ?>
                  <span style="color:red;"><?= $errors['name'] ?></span>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Chọn ảnh danh mục:</label> 
                 <img width="200px" src="/public/uploads/categogies/<?= $data['image'] ?>" alt="" name="image">
                <div class="custom-file">
                  <input type="file" class="custom-file-input " id="" name="image">
                  <label class="custom-file-label" for="customFile">Chọn ảnh...</label>
                  <?php if (isset($errors['image'])): ?>
                    <span style="color:red;"><?= $errors['image'] ?></span>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Chọn trạng thái:</label>
                <div class="custom-file">
                  <select class="select2 form-control shadow-none" style="width: 100%; height:36px;" id="status"
                    name="status" value="<?= $data['status'] ?>">
                    <option value="1" <?= ($data['status'] == 1 ? 'selected' : '') ?>>Hiển thị</option>
                    <option value="0" <?= ($data['status'] == 0 ? 'selected' : '') ?>>Ẩn</option>

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
