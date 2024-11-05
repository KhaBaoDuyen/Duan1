<?php

namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class Index extends BaseView
{
    public static function render($data = null)
    {
        ?>
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
                                    <li class="breadcrumb-item active" aria-current="page">Danh sách tài khoản</li>
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
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Danh sách tài khoản</h5>
                                <?php
                                if (count($data)):
                                    ?>
                                    <div class="table-responsive">
                                        <table id="" class="table table-striped ">
                                            <thead style="">
                                                <tr style="background:black;" class="th_table">
                                                    <th>ID</th>
                                                    <th width="40px">Avatar</th>
                                                    <th>Tên đăng nhập</th>
                                                    <th>Họ và tên </th>
                                                    <th>Email</th>
                                                    <th>Số điẹn thoại </th>
                                                    <th>Loại tại khoản </th>
                                                    <th>Trạng thái</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($data as $item):
                                                    ?>
                                                    <tr>
                                                        <td><?= $item['user_id'] ?></td>
                                                        <td width="10">     <?php if ($item['avatar']): ?>
                                    <img src="<?= APP_URL ?>/public/uploads/users/<?= $item['avatar'] ?>" alt="user" width="100"
                                       class="rounded-circle">
                                 <?php else: ?>
                                    <img src="<?= APP_URL ?>/public/assets/client/images/User/bc7a0c399990de122f1b6e09d00e6c4c.jpg" alt="user" width="100"
                                       class="rounded-circle">
                                 <?php endif; ?>
                                                        </td>
                                                        <td><?= $item['username'] ?></td>
                                                        <td><?= $item['name'] ?></td>
                                                        <td><?= $item['email'] ?></td>
                                                        <td><?= $item['phone'] ?></td>
                                                        <td>
                                                            <?= $item['role'] == 1 ? 'Quản trị' : 'Người dùng' ?>
                                                        </td>

                                                        <td><?= ($item['status'] == 1) ? 'Hiển thị' : 'Ẩn' ?></td>
                                                        <td>
                                                            <a href="/admin/users/<?= $item['user_id'] ?>"
                                                                class="btn btn-primary ">Sửa</a>
                                                            <form action="/admin/users/<?= $item['user_id'] ?>" method="post"
                                                                style="display: inline-block;" onsubmit="return confirm('Xác nhận xóa ?')">
                                                                <input type="hidden" name="method" value="DELETE" id="">
                                                                <button type="submit" class="btn btn-danger text-white">Xoá</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                else:

                                    ?>
                                    <h4 class="text-center text-danger">Không có dữ liệu</h4>
                                    <?php
                                endif;

                                ?>
                            </div>
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
