<?php

namespace App\Views\Admin\Pages\Comment;

use App\Views\BaseView;

class Index extends BaseView
{
    public static function render($data = null)
    {
?>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Bình luận</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bình luận</li>
                </ol>
            </div>
            <div class="row">
                <!-- DataTable with Hover -->
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách bình luận</h6>
                        </div>
                                <?php
                                if (count($data)) :
                                ?>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Người dùng</th>
                                        <th>Sản Phẩm</th>
                                        <th>Nội dung</th>
                                        <th>Ngày</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $stt=0;
                                            foreach ($data as $item) :
                                                $stt++;
                                                ?>
                                                <tr>
                                                <td>
                                                    <?= $stt ?></td>

                                                    <td>
                                                        <a href="/admin/users/<?=$item['id_user']?>"><?= $item['username'] ?></a>
                                                    </td>

                                                    <td>
                                                    <a href="/admin/products/<?=$item['product_id']?>"><?= $item['product_name'] ?></a>
                                                   </td>

                                                    <td><?= $item['content'] ?></td>
                                                    <td><?= $item['date'] ?></td>
                                                    <td><?= ($item['status'] == 1) ? 'Hiển thị' : 'Ẩn' ?></td>
                                                    <td>
                                                    <a href="/admin/comments/<?= $item['id'] ?>" class="btn btn-primary ">Sửa</a>
                                                        <form action="/admin/comments/<?= $item['id'] ?>" method="post" style="display: inline-block;" onsubmit="return confirm('Chắc chưa?')">
                                                            <input type="hidden" name="method" value="DELETE" id="">
                                                            <button type="submit" class="btn btn-danger text-white">Xoá</button>
                                                        </form>
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
        </div>
        <!-- Page level plugins -->
<?php
    }
}
