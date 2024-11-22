<?php

namespace App\Views\Admin;

use App\Views\BaseView;

class Home extends BaseView
{
    public static function render($data = null)
    {
?>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
            <div class="row mb-3">
                <!-- Sản phẩm Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Sản phẩm</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['total_product'] ?></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                        <span>Since last month</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Danh Mục Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Danh Mục</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['total_category'] ?></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                        <span>Since last year</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-cart fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tài khoản Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Tài khoản</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $data['total_user'] ?></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Bình luận Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Bình luận</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['total_comment'] ?></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                        <span>Since yesterday</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-1">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="product_by_category"></canvas> <!-- Đổi ID -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biểu đồ hình tròn -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Sản phẩm đã bán</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tháng <i class="fas fa-chevron-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Chọn khoảng thời gian</div>
                                    <a class="dropdown-item" href="#">Hôm nay</a>
                                    <a class="dropdown-item" href="#">Tuần</a>
                                    <a class="dropdown-item active" href="#">Tháng</a>
                                    <a class="dropdown-item" href="#">Năm nay</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Nội dung biểu đồ hình tròn -->
                        </div>
                    </div>
                </div>

                <!-- Ví dụ hóa đơn -->
                <div class="col-xl-8 col-lg-7 mb-4">
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Hóa đơn</h6>
                            <a class="m-0 float-right btn btn-danger btn-sm" href="#">Xem thêm <i class="fas fa-chevron-right"></i></a>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID Đơn hàng</th>
                                        <th>Khách hàng</th>
                                        <th>Sản phẩm</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Nội dung bảng -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tin nhắn từ khách hàng -->
                <div class="col-xl-4 col-lg-5 ">
                    <div class="card">
                        <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-light">Tin nhắn từ khách hàng</h6>
                        </div>
                        <div>
                            <!-- Nội dung tin nhắn -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Đăng xuất -->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelLogout">Ôi không!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Bạn có chắc chắn muốn đăng xuất không?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Hủy</button>
                            ...
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function productByCategoryChart() {
                    var php_data = <?= json_encode($data['product_by_catgory']) ?>;
                    console.log(php_data); // Kiểm tra dữ liệu
                    var label=[];
                    var data = [];

for(let i of php_data){
    console.log(i);
    label.push(i.name);
    data.push(i.count);
    
}
console.log(label);
console.log(data);


                    const ctx = document.getElementById('product_by_category'); // Đổi ID

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: label, // Thay đổi theo dữ liệu của bạn
                            datasets: [{
                                label: 'Loại sản phẩm',
                                data: data, // Thay đổi theo dữ liệu của bạn
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
                productByCategoryChart(); // Gọi hàm đúng tên
            </script>

<?php
    }
}
?>
