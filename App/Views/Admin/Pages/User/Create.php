<?php

namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class Create extends BaseView
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
                                    <li class="breadcrumb-item active" aria-current="page">Thêm tài khoản</li>
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
                            <form class="form-horizontal" action="/admin/users" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Thêm tài khoản</h4>
                                    <input type="hidden" name="method" id="" value="POST">
                                    <div class="form-group">
                                        <label for="name">Tên đăng nhập *</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Nhập tên loại sản phẩm..." name="username" >
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Họ và tên*</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Nhập tên loại sản phẩm..." name="name" >
                                    </div>
                                    <div class="form-group">
                                        <label for="avatar">Avatar</label>
                                        <input type="file" class="form-control" id="avatar" placeholder="Chọn hình ảnh..."
                                            name="avatar">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Email</label>
                                        <input type="text" class="form-control" id="price" placeholder="Nhập email..."
                                            name="email" >
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Mật khẩu</label>
                                        <input type="text" class="form-control" id="price" placeholder="Nhập mật khẩu..."
                                            name="password" >
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Nhập lại mật khẩu</label>
                                        <input type="text" class="form-control" id="price" placeholder="Nhập lại mật khẩu..."
                                            name="re_password" >
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Số điện thoại *</label>
                                        <textarea class="form-control" id="description" placeholder="Nhập số điện thoại ..."
                                            name="phone" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_featured">Chức vụ</label>
                                        <select class="select2 form-select shadow-none" id="is_featured" name="role"
                                            >
                                            <option value="" selected disabled>Vui lòng chọn...</option>
                                            <option value="1">Tài khoản Admin</option>
                                            <option value="0">Tài khoản người dùng </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Trạng thái*</label>
                                        <select class="select2 form-select shadow-none" id="status" name="status" >
                                            <option value="" selected disabled>Vui lòng chọn...</option>
                                            <option value="1">Hiển thị</option>
                                            <option value="0">Ẩn</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="reset" class="btn btn-danger text-white">Làm lại</button>
                                        <button type="submit" class="btn btn-primary">Thêm</button>
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
