<?php

namespace App\Views\Admin;

use App\Views\BaseView;

class Home extends BaseView
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
                        <h4 class="page-title">Thống kê dữ liệu</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
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
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="/admin/users">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><span class="material-symbols-outlined">
                                            group
                                        </span> <?= $data['total_user'] ?></h1>
                                    <h6 class="text-white">Người dùng </h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="/admin/categories">
                            <div class="card card-hover">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white"><span class="material-symbols-outlined">
                                            category
                                        </span></i><?= $data['total_categogy'] ?></h1>
                                    <h6 class="text-white">Loại sản phẩm </h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="/admin/Product">
                            <div class="card card-hover">
                                <div class="box bg-warning text-center">
                                    <h1 class="font-light text-white"><i
                                            class="mdi mdi-collage"></i><?= $data['total_product'] ?>
                                    </h1>
                                    <h6 class="text-white">Sản phẩm</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="/admin/comments">
                            <div class="card card-hover">
                                <div class="box bg-danger text-center">
                                    <h1 class="font-light text-white"><span class="material-symbols-outlined">
                                            comment
                                        </span></i><?= $data['total_comment'] ?></h1>
                                    <h6 class="text-white">Bình luận</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4>Thống kê theo loại sản phẩm </h4>
                                <div>
                                    <canvas id="product_by_categ"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4>Thống kê theo loại lượt xem nhiều nhất</h4>
                                <div>
                                    <canvas id="product_by_view"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Script for first chart -->
            <script>
                function productByCategogyChart() {
                    var php_data = <?= json_encode($data['product_by_categ']) ?>;
                    console.log(php_data);
                    var labels = [];
                    var data = [];

                    for (let i of php_data) {
                        console.log(i);
                        labels.push(i.name);
                        data.push(i.count);
                    }

                    console.log(labels);
                    console.log(data);

                    const ctx1 = document.getElementById('product_by_categ');

                    new Chart(ctx1, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Số lượng sản phẩm',
                                data: data,
                                borderWidth: 1
                            }]
                        },
                        // options: {
                        //   scales: {
                        //     y: {
                        //       beginAtZero: true
                        //     }
                        //   }
                        // }
                    });
                }


                // View 
                function productByView() {
                    var php_data = <?= json_encode($data['product_by_view']) ?>;
                    console.log(php_data);
                    var labels = [];
                    var data = [];

                    for (let i of php_data) {
                        console.log(i);
                        labels.push(i.name);
                        data.push(i.view);
                    }

                    console.log(labels);
                    console.log(data);

                    const ctx1 = document.getElementById('product_by_view');

                    new Chart(ctx1, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Số lượt xem',
                                data: data,
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


                productByCategogyChart();
                productByView();

            </script>

            <!-- Script for second chart -->

            <?php

    }
}

?>