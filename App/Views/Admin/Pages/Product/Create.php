<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class Create extends BaseView
{
    public static function render($data = null)
    {
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
?>

        <!-- Page Content -->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Thêm Sản phẩm</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm Sản phẩm</li>
                </ol>
            </div>

            <div class="row">
                <!-- Form Add Product -->
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Form Thêm Sản phẩm</h6>
                        </div>
                        <div class="card-body">
                            <form action="/admin/products" method="POST" enctype="multipart/form-data"
                                class="d-flex justify-content-between col-12">
                                <input type="hidden" name="method" value="POST">
                                <div class="col-7 row">

                                    <div class="form-group col-12">
                                        <label for="name">Tên sản phẩm</label>
                                        <input type="text"
                                            class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" name="name"
                                            id="name">
                                        <?php if (isset($errors['name'])): ?>
                                            <span style="color:red;"><?= $errors['name'] ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="price">Giá sản phẩm</label>
                                        <input type="number" class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>" name="price" id="price">
                                        <?php if (isset($errors['price'])): ?>
                                            <span style="color:red;"><?= $errors['price'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="discount_price">Giảm giá</label>
                                        <input type="number" class="form-control <?= isset($errors['discount_price']) ? 'is-invalid' : '' ?>" name="discount_price" id="discount_price">
                                        <?php if (isset($errors['discount_price'])): ?>
                                            <span style="color:red;"><?= $errors['discount_price'] ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="id_categogy">Danh mục sản phẩm</label>
                                        <select class="form-control <?= isset($errors['categogy']) ? 'is-invalid' : '' ?>"
                                            name="id_categogy"
                                            id="id_categogy">
                                            <option value="">Chọn danh mục</option>
                                            <?php
                                            if (!empty($data)) {
                                                foreach ($data as $category) {
                                                    $selected = (isset($_POST['id_categogy']) && $_POST['id_categogy'] == $category['id']) ? 'selected' : '';
                                                    echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
                                                }
                                            } else {
                                                echo "<option value=''>Không có danh mục nào</option>";
                                            }
                                            ?>
                                        </select>
                                        <?php if (isset($errors['categogy'])): ?>
                                            <span style="color:red;"><?= $errors['categogy'] ?></span>
                                        <?php endif; ?>
                                    </div>


                                    <div class="form-group col-6">
                                        <label for="status">Trạng thái</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1">Hiển thị</option>
                                            <option value="0">Ẩn</option>
                                        </select>
                                    </div>
                                    <input type="hidden" class="form-control" name="date" id="date">
                                    <div class="form-group col-12">
                                        <label for="short_description">Mô tả ngắn</label>
                                        <textarea class="form-control <?= isset($errors['short_description']) ? 'is-invalid' : '' ?>" name="short_description" id="short_description"
                                            rows="1"></textarea>
                                        <?php if (isset($errors['short_description'])): ?>
                                            <span style="color:red;"><?= $errors['short_description'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group  col-12">
                                        <label for="description">Mô tả dài</label>
                                        <textarea class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>" name="description" id="description" rows="2"></textarea>
                                        <?php if (isset($errors['description'])): ?>
                                            <span style="color:red;"><?= $errors['description'] ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="start_time">Thời gian bắt đầu</label>
                                        <input type="datetime-local" class="form-control" name="start_time" id="start_time">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="end_time">Thời gian kết thúc</label>
                                        <input type="datetime-local" class="form-control <?= isset($errors['end_time']) ? 'is-invalid' : '' ?>" name="end_time" id="end_time">
                                        <?php if (isset($errors['end_time'])): ?>
                                            <span style="color:red;"><?= $errors['end_time'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                                </div>

                                <div class=" col-5">
                                    <div class="form-group col-12">
                                        <label for="image">Ảnh chính sản phẩm</label>
                                        <input type="file" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>" name="image" id="image" accept="image/*">
                                        <?php if (isset($errors['image'])): ?>
                                            <span style="color:red;"><?= $errors['image'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="d-flex align-content-between justify-content-between col-12">
                                            <label for="image">Chi tiết ảnh </label>
                                            <a href="javascript:void(0)" onclick="createImage()" class="ml-2 btn btn-primary"
                                                id="add-more-images">Thêm ảnh</a>
                                        </div>
                                        <div id="additional-images">
                                            <div
                                                class="image-group d-flex row align-items-baseline justify-content-between m-1 p-1 border rounded">
                                                <input type="file" class="form-control image_product col-10" name="images[]"
                                                    multiple>
                                                <a href="javascript:void(0)" class="btn btn-danger delete-image"
                                                    onclick="deleteImage(this)">Xóa</a>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group col-12 group_variant ">
                                        <div class="d-flex align-content-between justify-content-between col-12">
                                            <label for="image">Biến thể</label><a href="javascript:void(0)"
                                                onclick="createVariant()" class="ml-2 btn btn-primary "
                                                id="add-more-images">Thêm biến thể</a>
                                        </div>

                                        <div id="additional-variants">
                                            <div class="variant-group row align-items-center m-1 p-1 border rounded">
                                                <div class="col-5">
                                                    <input type="text" class="form-control" name="variant[][nameVariant]"
                                                        placeholder="Tên biến thể">
                                                </div>
                                                <div class="col-5">
                                                    <input type="text" class="form-control" name="variant[][priceVariant]"
                                                        placeholder="Giá ">
                                                </div>
                                                <div class="col-2 text-end">
                                                    <a href="javascript:void(0)" class="btn btn-danger delete-image"
                                                        onclick="deleteVariant(this)">
                                                        <i class="bi bi-trash"></i> Xóa
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>




                                </div>

                            </form>
                            <?php
                            unset($_SESSION['errors']);
                            ?>
                        </div>
                    </div>
                </div>
                <!-- End Form Add Product -->
            </div>
        </div>

<?php
    }
}
