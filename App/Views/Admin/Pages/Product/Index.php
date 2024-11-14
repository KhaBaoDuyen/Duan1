<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class Index extends BaseView
{
    public static function render($data = null)
    {
?>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Sản phẩm</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                </ol>
            </div>
            <div class="row">
                <!-- DataTable with Hover -->
                <div class="col-lg-12">
                    <div class="card mb-4">
                           <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
                            <div class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <div style=" width: 350px !important;" class="  dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="navbar-search"  action="/admin/SearchProducts" method="get">
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
                        <?php
                        if (is_array($data['products']) && count($data['products']) > 0) :
                        ?>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Giảm giá</th>
                                            <th>Ảnh</th>
                                            <th>Danh mục</th>
                                            <th>Trạng thái</th>
                                            <th>Khác</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($data['products'] as $item) :
                                        ?>
                                            <tr>
                                                <td><?= $item['id'] ?></td>
                                                <td><?= $item['name'] ?></td>
                                                <td><?= number_format($item['price'] ?? 0, 0, ',', '.') ?> </td>
                                                <td>
                                                    <?php if (isset($item['discount_price']) && $item['discount_price'] > 0) { ?>
                                                        <span class="badge p-2 badge-danger">
                                                            Đang giảm
                                                        </span>
                                                    <?php } else { ?>
                                                        <span class="badge p-2 badge-success">
                                                            Không giảm
                                                        </span>
                                                    <?php } ?>
                                                </td>


                                                <td>
                                                    <img class="img_all" width="40px" height="40px"
                                                        class="image" src="/public/uploads/products/<?= $item['image'] ?>" alt="Product Image" height="100%">
                                                </td>
                                                <td><?= $item['category_name'] ?></td>
                                                <td><?= ($item['status'] == 1) ? 'Hiển thị' : 'Ẩn' ?></td>
                                                <td>
                                                    <a href="/admin/products/<?= $item['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                                                    <form action="/admin/products/<?= $item['id'] ?>" method="post"
                                                        style="display: inline-block;"
                                                        onsubmit="return confirm('Bạn có chắc chắn xóa danh mục <?= $item['name'] ?>?')">
                                                        <input type="hidden" name="method" value="DELETE">
                                                        <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                                    </form>
                                            </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        else :
                        ?>
                            <h4 class="text-center text-danger">Không có dữ liệu</h4>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>

       

        </div>
        <!---Container Fluid-->
<?php
    }
}
?>