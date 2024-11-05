<?php

namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class Edit extends BaseView
{
    public static function render($data = null)
    {
        ?>

        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">QUẢN LÝ TÀI KHOẢN</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa tài khoản</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form class="form-horizontal" action="/admin/users/<?= $data['user_id'] ?>" method="POST"
                                enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Chỉnh sửa tài khoản</h4>
                                <input type="hidden" name="method" id="" value="PUT">
                                    <div align="center" class="form-group">
                                        <label for="image">Ảnh đại diện</label> </br>
                                        <img src="<?= APP_URL ?>/public/uploads/users/<?= $data['avatar'] ?>" alt=""
                                            width="200px">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tên đăng nhập *</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Nhập tên loại sản phẩm..." name="username"
                                            value="<?= $data['username'] ?>" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Họ và tên*</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Nhập tên loại sản phẩm..." name="name" value="<?= $data['name'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="avatar">Avatar</label>
                                        <input type="file" class="form-control" id="avatar" placeholder="Chọn hình ảnh..."
                                            name="avatar">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="price" placeholder="Nhập email..."
                                            name="email" value="<?= $data['email'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Số điện thoại *</label>
                                        <input class="form-control" id="description" placeholder="Nhập số điện thoại ..."
                                            name="phone" value="<?= $data['phone'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Chức vụ</label>
                                        <select class="select2 form-select shadow-none" id="role" name="role">
                                            <option value="" selected disabled>Vui lòng chọn...</option>
                                            <option value="1" <?= ($data['role'] == 1 ? 'selected' : '') ?>>Admin</option>
                                            <option value="0" <?= ($data['role'] == 0 ? 'selected' : '') ?>>Người dùng</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Trạng thái*</label>
                                        <select class="select2 form-select shadow-none" id="status" name="status">
                                            <option value="" selected disabled>Vui lòng chọn...</option>
                                            <option value="1" <?= ($data['status'] == 1 ? 'selected' : '') ?>>Hiển thị</option>
                                            <option value="0" <?= ($data['status'] == 0 ? 'selected' : '') ?>>Ẩn</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="reset" class="btn btn-danger text-white" name="">Làm lại</button>
                                        <button type="submit" class="btn btn-primary" name="">Cập nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->

            <?php
    }
}
