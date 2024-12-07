<?php

namespace App\Views\Admin\Pages\Contact;

use App\Views\BaseView;

class index extends BaseView
{
    public static function render($data = null)
    {
        ?>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Quản lý danh sách phản hồi của người dùng</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
                </ol>
            </div>
            <div class="row">
                <!-- DataTable with Hover -->
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách phản hồi</h6>
                            <div class="nav-item dropdown no-arrow">
                                <div style=" width: 350px !important;"
                                    class=""
                                    aria-labelledby="searchDropdown">
                                    <form class="navbar-search" action="/admin/search" method="get">
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

                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th >Họ tên</th>
                                        <th >Email</th>
                                        <th >Số điện thoại</th>
                                        <th >Nội dung phản hồi</th>
                                        <th>Trạng thái</th>
                                        <th>Khác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($data)): ?>
                                        <?php foreach ($data as $contact):

                                             ?>
                                            
                                            <tr>
                                                <td><?= $contact['id'] ?></td>
                                                <td><?= $contact['name'] ?></td>
                                                <td><?= $contact['email']?></td>
                                                <td><?= $contact['phone']?></td>
                                                <td><?= $contact['message']?></td>
                                                <td>
                                                    <span
                                                        class="badge p-2 <?= $contact['status'] == 1 ? 'badge-danger' : 'badge-success' ?>">
                                                        <?= $contact['status'] == 1 ? 'Chưa phản hồi' : 'Đã phản hồi' ?>
                                                    </span>
                                                </td>

                                                <td style="display: flex;">
                                                    <a style="margin-right: 5px;" href="/admin/contact/<?= $contact['id'] ?>"
                                                        class="btn btn-sm btn-warning">Sửa</a>
                                                    <form action="/admin/contact/<?= $contact['id'] ?>" method="post">
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
        </div>
        </div>
        <?php
    }
}
