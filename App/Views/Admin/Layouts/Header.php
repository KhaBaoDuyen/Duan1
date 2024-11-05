<?php

namespace App\Views\Admin\Layouts;

use App\Views\BaseView;

class Header extends BaseView
{
    public static function render($data = null)
    {

        ?>
        <!DOCTYPE html>
        <html dir="ltr" lang="en">

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!-- Tell the browser to be responsive to screen width -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Admin</title>
            <!-- Favicon icon -->
            <link rel="stylesheet" href="/public/assets/client/images/logo/logo.png">
            <!-- CSS -->
            <link href="<?= APP_URL ?>/public/assets/admin/libs/flot/css/float-chart.css" rel="stylesheet">
            <link rel="stylesheet" type="text/css"
                href="<?= APP_URL ?>/public/assets/admin/extra-libs/multicheck/multicheck.css">
            <link href="<?= APP_URL ?>/public/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.css"
                rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
                integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

            <link rel="stylesheet" type="text/css"
                href="<?= APP_URL ?>/public/assets/admin/libs/select2/dist/css/select2.min.css">
            <link rel="stylesheet" type="text/css"
                href="<?= APP_URL ?>/public/assets/admin/libs/jquery-minicolors/jquery.minicolors.css">
            <link rel="stylesheet" type="text/css"
                href="<?= APP_URL ?>/public/assets/admin/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
            <link rel="stylesheet" type="text/css" href="<?= APP_URL ?>/public/assets/admin/libs/quill/dist/quill.snow.css">

            <!-- Custom CSS -->
            <link href="<?= APP_URL ?>/public/assets/admin/dist/css/style.min.css" rel="stylesheet">
            <link href="<?= APP_URL ?>/public/assets/admin/dist/css/main.css" rel="stylesheet">
            <link rel="stylesheet"
                href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        </head>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <body>

            <!-- ============================================================== -->
            <!-- Main wrapper - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
                data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
                <!-- ============================================================== -->
                <!-- Topbar header - style you can find in pages.scss -->
                <!-- ============================================================== -->
                <header class="topbar" data-navbarbg="skin5">
                    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                        <div class="navbar-header" data-logobg="skin5">

                            <!-- ============================================================== -->
                            <!-- Logo -->
                            <!-- ============================================================== -->
                            <a class="navbar-brand" href="/admin"
                                style="display:flex; float:start; justify-content:center; align-items:center">
                                <!-- Logo icon -->
                                <img src="<?= APP_URL ?>/public/assets/admin/images/logo.png" alt="homepage" class="light-logo"
                                    width=20% />
                                <p class="logo-text"> BaoDuyen</p>
                            </a>
                            <!-- ============================================================== -->
                            <!-- End Logo -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- Toggle which is visible on mobile only -->
                            <!-- ============================================================== -->
                            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                                    class="ti-menu ti-close"></i></a>
                        </div>
                        <!-- ============================================================== -->
                        <!-- End Logo -->
                        <!-- ============================================================== -->
                        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                            <!-- ============================================================== -->
                            <!-- toggle and nav items -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav float-start me-auto">
                                <li class="nav-item d-none d-lg-block"><a
                                        class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                        data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                                <!-- ============================================================== -->
                            </ul>
                            <!-- ============================================================== -->
                            <!-- Right side toggle and nav items -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav float-end">
                                <!-- ============================================================== -->
                                <!-- User profile and search -->
                                <!-- ============================================================== -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic d-flex align-items-center"
                                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <?php if (isset($_SESSION['user'])):
                                            $user = $_SESSION['user'];
                                            ?>
                                            <?php if ($user['avatar']): ?>
                                                <h5 class="p-2">Tên :<?= $user['name'] ?></h5>
                                                <img src="<?= APP_URL ?>/public/uploads/users/<?= $user['avatar'] ?>" alt="user"
                                                    width="40" class="rounded-circle">
                                            <?php else: ?>
                                                <img src="<?= APP_URL ?>/public/assets/client/images/User/bc7a0c399990de122f1b6e09d00e6c4c.jpg"
                                                    alt="user" width="40" class="rounded-circle">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end user-dd animated"
                                        aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="/logout"><i class="fa fa-power-off me-1 ms-1"></i> Đăng
                                            xuất</a>
                                    </ul>
                                </li>
                                <!-- ============================================================== -->
                                <!-- User profile and search -->
                                <!-- ============================================================== -->
                            </ul>
                        </div>
                    </nav>
                </header>
                <!-- ============================================================== -->
                <!-- End Topbar header -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Left Sidebar - style you can find in sidebar.scss  -->
                <!-- ============================================================== -->
                <aside class="left-sidebar" data-sidebarbg="skin5" style="height:100%;">
                    <!-- Sidebar scroll-->
                    <div class="scroll-sidebar">
                        <!-- Sidebar navigation-->
                        <nav class="sidebar-nav">
                            <ul id="sidebarnav" class="pt-4">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin"
                                        aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                            class="hide-menu">Thống kê</span></a>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                        aria-expanded="false"><i class="fa-solid fa-list" style="color: #ffffff;"></i> <span
                                            class="hide-menu">Danh mục </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level">
                                        <li class="sidebar-item">
                                            <a href="/admin/categories" class="sidebar-link"><i
                                                    class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách
                                                </span></a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="/admin/categories/create" class="sidebar-link"><i
                                                    class="mdi mdi-note-plus"></i><span class="hide-menu"> Thêm mới </span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                        aria-expanded="false"><i class="fa fa-box"></i><span class="hide-menu">Sản phẩm
                                        </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level">
                                        <li class="sidebar-item">
                                            <a href="/admin/Product" class="sidebar-link"><i
                                                    class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách
                                                </span></a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="/admin/products/create" class="sidebar-link"><i
                                                    class="mdi mdi-note-plus"></i><span class="hide-menu"> Thêm mới </span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                        aria-expanded="false"><span class="material-symbols-outlined" style="color: #ffffff;">
                                            contacts_product
                                        </span><span class="hide-menu">Người dùng
                                        </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level">
                                        <li class="sidebar-item">
                                            <a href="/admin/users" class="sidebar-link"><i
                                                    class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách
                                                </span></a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="/admin/users/create" class="sidebar-link"><i
                                                    class="mdi mdi-note-plus"></i><span class="hide-menu"> Thêm mới </span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                        aria-expanded="false"><i class="fa-solid fa-comment" style="color: #ffffff;"></i><span
                                            class="hide-menu">Bình luận
                                        </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level">
                                        <li class="sidebar-item">
                                            <a href="/admin/comments" class="sidebar-link"><i
                                                    class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách
                                                </span></a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- <li class="sidebar-item p-3">
                                    <a href="https://github.com/wrappixel/matrix-admin-lite" target="_blank"
                                        class="w-100 btn btn-cyan d-flex align-items-center text-white"><i
                                            class="mdi mdi-cloud-download font-20 me-2"></i>Theme</a>
                                </li> -->
                            </ul>
                        </nav>
                        <!-- End Sidebar navigation -->
                    </div>
                    <!-- End Sidebar scroll-->
                </aside>
                <!-- ============================================================== -->
                <!-- End Left Sidebar - style you can find in sidebar.scss  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->

                <?php

    }
}

?>