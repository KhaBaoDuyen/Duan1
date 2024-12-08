<?php

namespace App\Views\Admin\Pages\Order;

use App\Views\BaseView;

class Index extends BaseView
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
                            <div class="nav-item dropdown no-arrow">
                                <div style=" width: 350px !important;"
                                    class=""
                                    aria-labelledby="searchDropdown">
                                    <form class="navbar-search" action="/admin/searchOrder" method="get">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-1 small"
                                                placeholder="Nhập từ khóa tìm kiếm ?" aria-label="Search"
                                                aria-describedby="basic-addon2" id="input" class="input" name="keyword"
                                                type="keyword" style="border-color: #3f51b5;">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Người dùng</th>
                                        <th>Giá</th>
                                        <th>Địa chỉ</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Trạng thái</th>
                                        <th>Khác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($data)): ?>
                                        <?php foreach ($data as $order): ?>
                                            <tr>
                                                <td><?= $order['id'] ?></td>
                                                <td><?= $order['name'] ?></td>
                                                <td><?= number_format ($order['total'],0, ',','.') ?>đ</td>
                                                <td><?= $order['address'] ?></td>
                                                <td>
                                                    <span
                                                        class="badge p-2 <?= $order['pay'] == 1 ? 'badge-danger' : 'badge-success' ?>">
                                                        <?= $order['pay'] == 1 ? 'Thanh toán khi nhận hàng' : 'VNpay' ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge p-2 
                                         <?php
                                            switch ($order['status']) {
                                                case 1:
                                                    echo 'badge-danger'; // Chờ xử lý
                                                    break;
                                                case 2:
                                                    echo 'badge-warning'; // Đang xử lý
                                                    break;
                                                case 3:
                                                    echo 'badge-info'; // Đang vận chuyển
                                                    break;
                                                case 4:
                                                    echo 'badge-success'; // Đã hoàn thành
                                                    break;
                                                default:
                                                    echo 'badge-secondary'; // Trạng thái không xác định
                                            }
                                        ?>">
                                                        <?php
                                                        switch ($order['status']) {
                                                            case 1:
                                                                echo 'Chờ xử lý';
                                                                break;
                                                            case 2:
                                                                echo 'Đang xử lý';
                                                                break;
                                                            case 3:
                                                                echo 'Đang vận chuyển';
                                                                break;
                                                            case 4:
                                                                echo 'Đã hoàn thành';
                                                                break;
                                                            default:
                                                                echo 'Không xác định';
                                                        }
                                                        ?>
                                                    </span>
                                                </td>

                                                <td style="display: flex;">
                                                    <a style="margin-right: 5px;" href="/admin/order/<?= $order['id']?>" class="btn btn-sm btn-warning">Sửa</a>
                                                    <form action="/admin/order/<?= $order['id'] ?>" method="post">
                                                        <input type="hidden" name="method" value="DELETE">
                                                        <button   type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                                    </form>
                                                </td>
                                            </tr>


                                        <?php endforeach; ?>
                                    <?php endif; ?>
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
