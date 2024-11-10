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
                                        <td><?= number_format($item['price'] ?? 0, 0, ',', '.') ?> VND</td>
                                        <td><?= number_format($item['discount_price'] ?? 0, 0, ',', '.') ?> VND</td>
                                        <!-- Hiển thị hình ảnh -->
                                        <td>
                                        <img class="img_all" width="40px" height="40px" 
                                         class="image" src="<?= $item['image'] ?>" alt="Product Image" height="100%">
                                        </td>
                                        <td><?= $item['category_name'] ?></td>
                                        <td><?= ($item['status'] == 1) ? 'Hiển thị' : 'Ẩn' ?></td>
                                        <td>
                                            <a href="/admin/products/<?= $item['id'] ?>/edit" class="btn btn-sm btn-warning">Sửa</a>
                                            <a href="/admin/products/<?= $item['id'] ?>/delete" class="btn btn-sm btn-danger" 
                                               onclick="return confirm('Bạn có chắc chắn muốn xoá sản phẩm này?')">Xóa</a>
                                        </td>
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
<?php
    }
}
?>