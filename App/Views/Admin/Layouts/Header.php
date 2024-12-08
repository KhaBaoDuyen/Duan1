<?php

namespace App\Views\Admin\Layouts;

use App\Views\BaseView;

class Header extends BaseView
{

    public static function render($data = null)
    {
        $isLoggedIn = isset($_SESSION['user']);
        $userName = $isLoggedIn ? $_SESSION['user']['username'] : null;
        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="icon" type="image/png" href="/public/assets/Client/image/icon/Logo2.png">
            <title>BLOOM</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

            <link href="/public/assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <link href="/public/assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
            <link href="/public/assets/admin/css/ruang-admin.min.css" rel="stylesheet">
            <link href="/public/assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">

       <!--  Chart.js -->
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        </head>


        <body id="page-top">
            <div id="wrapper">
                <!-- Sidebar -->
                <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" style="
">
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                        <div class="sidebar-brand-icon">
                            <img src="/public/assets/admin/img/logo/logo2.png">
                        </div>
                        <!-- <div class="sidebar-brand-text mx-3">RuangAdmin</div> -->
                    </a>
                    <hr class="sidebar-divider my-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
                            aria-expanded="true" aria-controls="collapseProduct">
                            <i class='bx bxs-cart-alt'></i>
                            <span>Quản lý sản phẩm</span>
                        </a>
                        <div id="collapseProduct" class="collapse" aria-labelledby="headingProduct"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Sản phẩm</h6>
                                <a class="collapse-item" href="/admin/Product">Danh sách</a>
                                <a class="collapse-item" href="/admin/products/create">Thêm mới</a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
                            aria-expanded="true" aria-controls="collapseCategory">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Quản lý danh mục</span>
                        </a>
                        <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh mục</h6>
                                <a class="collapse-item" href="/admin/categories">Danh sách</a>
                                <a class="collapse-item" href="/admin/categories/create">Thêm mới</a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
                            aria-expanded="true" aria-controls="collapseUser">
                            <i class='bx bxs-user-circle'></i>
                            <span>Quản lý tài khoản</span>
                        </a>
                        <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Tài khoản</h6>
                                <a class="collapse-item" href="/admin/users"> Danh sách</a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder"
                            aria-expanded="true" aria-controls="collapseOrder">
                            <i class='bx bxs-cart-add'></i>
                            <span>Quản lý hóa đơn</span>
                        </a>
                        <div id="collapseOrder" class="collapse" aria-labelledby="headingOrder" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Đơn hàng</h6>
                                <a class="collapse-item" href="/admin/order">Danh sách</a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseComment"
                            aria-expanded="true" aria-controls="collapseComment">
                            <i class='bx bx-message-dots'></i>
                            <span>Quản lý bình luận</span>
                        </a>
                        <div id="collapseComment" class="collapse" aria-labelledby="headingComment"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Bình luận</h6>
                                <a class="collapse-item" href="/admin/comments">Danh sách</a>
                               
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmail"
                            aria-expanded="true" aria-controls="collapseEmail">
                            <i class='bx bx-message-dots'></i>
                            <span>Quản lý email</span>
                        </a>
                        <div id="collapseEmail" class="collapse" aria-labelledby="headingEmail"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Bình luận</h6>
                                <a class="collapse-item" href="/admin/contact">Danh sách</a>
                            </div>
                        </div>
                    </li>


                    <hr class="sidebar-divider">
                    <!-- <div class="version" id="version-ruangadmin"></div> -->
                </ul>
                <!-- Sidebar -->
                <div id="content-wrapper" class="d-flex flex-column">
                    <div id="content">
                        <!-- TopBar -->
                        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top" id="navbar-expand"
                            style="">
                            <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>
                            <ul class="navbar-nav ml-auto">

                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bell fa-fw"></i>
                                        <span class="badge badge-danger badge-counter">3+</span>
                                    </a>
                                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="alertsDropdown">
                                        <h6 class="dropdown-header">
                                            Alerts Center
                                        </h6>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-primary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">December 12, 2019</div>
                                                <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-success">
                                                    <i class="fas fa-donate text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">December 7, 2019</div>
                                                $290.29 has been deposited into your account!
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-warning">
                                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">December 2, 2019</div>
                                                Spending Alert: We've noticed unusually high spending for your account.
                                            </div>
                                        </a>
                                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-envelope fa-fw"></i>
                                        <span class="badge badge-warning badge-counter">2</span>
                                    </a>
                                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="messagesDropdown">
                                        <h6 class="dropdown-header">
                                            Message Center
                                        </h6>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle" src="img/man.png" style="max-width: 60px" alt="">
                                                <div class="status-indicator bg-success"></div>
                                            </div>
                                            <div class="font-weight-bold">
                                                <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                                    problem I've been
                                                    having.</div>
                                                <div class="small text-gray-500">Udin Cilok · 58m</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle" src="img/girl.png" style="max-width: 60px" alt="">
                                                <div class="status-indicator bg-default"></div>
                                            </div>
                                            <div>
                                                <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                                    told me that people
                                                    say this to all dogs, even if they aren't good...</div>
                                                <div class="small text-gray-500">Jaenab · 2w</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-tasks fa-fw"></i>
                                        <span class="badge badge-success badge-counter">3</span>
                                    </a>
                                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="messagesDropdown">
                                        <h6 class="dropdown-header">
                                            Task
                                        </h6>
                                        <a class="dropdown-item align-items-center" href="#">
                                            <div class="mb-3">
                                                <div class="small text-gray-500">Design Button
                                                    <div class="small float-right"><b>50%</b></div>
                                                </div>
                                                <div class="progress" style="height: 12px;">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item align-items-center" href="#">
                                            <div class="mb-3">
                                                <div class="small text-gray-500">Make Beautiful Transitions
                                                    <div class="small float-right"><b>30%</b></div>
                                                </div>
                                                <div class="progress" style="height: 12px;">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 30%"
                                                        aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item align-items-center" href="#">
                                            <div class="mb-3">
                                                <div class="small text-gray-500">Create Pie Chart
                                                    <div class="small float-right"><b>75%</b></div>
                                                </div>
                                                <div class="progress" style="height: 12px;">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 75%"
                                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item text-center small text-gray-500" href="#">View All Taks</a>
                                    </div>
                                </li>
                                <div class="topbar-divider d-none d-sm-block"></div>
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php if ($isLoggedIn): ?>

                                            <?php $avatar = $_SESSION['user']['avatar'] ?? 'usermacdinh.png'; ?>
                                            <img class="img-profile rounded-circle" src="/public/uploads/users/<?= $avatar ?>"
                                                style="max-width: 60px">
                                            <span
                                                class="ml-2 d-none d-lg-inline text-white small"><?php echo htmlspecialchars($_SESSION['user']['username'] ?? ''); ?></span>

                                        </a>
                                    <?php else: ?>
                                        <img class="img-profile rounded-circle" src="/public/uploads/users/usermacdinh.png"
                                            style="max-width: 60px">
                                        <span class="ml-2 d-none d-lg-inline text-white small">Usename</span>
                                    <?php endif; ?>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/admin/logout">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <!-- Topbar -->
                        <?php
    }
}
?>