<?php

namespace App\Views\Admin\Pages\Order;

use App\Views\BaseView;

class index extends BaseView
{
    public static function render($data = null)
    {
?>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Đơn hàng</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Email</th>
                                        <th>Giá</th>
                                        <th>Địa chỉ</th>
                                        <th>Người dùng</th>
                                        <th>Trạng thái</th>
                                        <th>Khác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Udin Wayang</td>
                                        <td>Nasi Padang</td>
                                        <td>Nasi Padang</td>
                                        <td>Nasi Padang</td>
                                        <td>
                                            <img class="img_all" width="40px" height="40px" src="/public/uploads/users/20240801230858.jpg" alt="img">
                                        </td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-warning">Sửa</a>
                                            <a href="#" class="btn btn-sm btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Udin Wayang</td>
                                        <td>Nasi Padang</td>
                                        <td>Nasi Padang</td>
                                        <td>Nasi Padang</td>
                                        <td>
                                            <img width="40px" height="40px" src="/public/uploads/users/20240801230858.jpg" alt="img">
                                        </td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-warning">Sửa</a>
                                            <a href="#" class="btn btn-sm btn-danger">Xóa</a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer"></div>
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
        <!---Container Fluid-->
        </div>

<?php
    }
}
