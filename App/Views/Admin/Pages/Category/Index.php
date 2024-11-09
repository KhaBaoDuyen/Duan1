<?php

namespace App\Views\Admin\Pages\Category;

use App\Views\BaseView;

class Index extends BaseView
{
    public static function render($data = null)
    {
        ?>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Danh mục</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
                </ol>
            </div>
            <div class="row">
                <!-- DataTable with Hover -->
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách danh mục</h6>
                            <div class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <div style=" width: 350px !important;" class="  dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="navbar-search"  action="/admin/SearchCategogy" method="get">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-1 small"
                                                placeholder="Nhập từ khóa tìm kiếm ?" aria-label="Search"
                                                aria-describedby="basic-addon2"  id="input" class="input" name="keyword" type="keyword"  style="border-color: #3f51b5;">
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

                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th width="25%">Danh mục</th>
                                        <th class="">Image</th>
                                        <th>Trạng thái</th>
                                        <th>Khác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($data)): ?>
                                        <?php foreach ($data as $categogy): ?>
                                            <tr>
                                                <td><?= $categogy['id'] ?></td>
                                                <td><?= $categogy['name'] ?></td>
                                                <td style="overflow: hidden;" width="150px" height="150px"><img width="100%"
                                                        height="100%" src="/public/uploads/categogies/<?= $categogy['image'] ?>" alt="">
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge p-2 <?= $categogy['status'] == 1 ? 'badge-success' : 'badge-danger' ?>">
                                                        <?= $categogy['status'] == 1 ? 'Hiển thị' : 'Ẩn' ?>
                                                    </span>
                                                </td>

                                                <td>
                                                    <a href="/admin/categories/<?= $categogy['id'] ?>"
                                                        class="btn btn-sm btn-warning">Sửa</a>
                                                    <form action="/admin/categories/<?= $categogy['id'] ?>" method="post"
                                                        style="display: inline-block;"
                                                        onsubmit="return confirm('Bạn có chắc chắn xóa danh mục <?= $categogy['name'] ?>?')">
                                                        <input type="hidden" name="method" value="DELETE">
                                                        <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                                    </form>
                                                </td>

                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

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
        <!-- Page level plugins -->

        <?php
    }
}
