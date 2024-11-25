<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class Edit extends BaseView
{
  public static function render($data = null)
  {
    $product = $data['product'];
    $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];

    ?>
    <!-- Page Content -->
    <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sửa Sản phẩm</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Sửa Sản phẩm</li>
        </ol>
      </div>

      <div class="row">
        <!-- Form Edit Product -->
        <div class="col-lg-12">
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Form Sửa Sản phẩm</h6>
            </div>
            <div class="card-body">
              <form action="/admin/products/<?= $product['id'] ?>" method="POST" enctype="multipart/form-data"
                class="d-flex justify-content-between  col-12" id="productForm">

                <div class=" row container">
                  <input type="hidden" name="method" value="PUT">
                  <div class=" col-12">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" name="name"
                      id="name" value="<?= $product['name'] ?>">
                    <?php if (isset($errors['name'])): ?>
                      <span style="color:red;"><?= $errors['name'] ?></span>
                    <?php endif; ?>
                  </div>
                  <div class=" col-6">
                    <label for="price">Giá sản phẩm</label>
                    <input type="number" class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>"
                      name="price" id="price" value="<?= $product['price'] ?>">
                    <?php if (isset($errors['price'])): ?>
                      <span style="color:red;"><?= $errors['price'] ?></span>
                    <?php endif; ?>
                  </div>
                  <div class=" col-6">
                    <label for="discount_price">Giảm giá</label>
                    <input type="number" class="form-control <?= isset($errors['discount_price']) ? 'is-invalid' : '' ?>"
                      name="discount_price" id="discount_price" value="<?= $product['discount_price'] ?>">
                    <?php if (isset($errors['discount_price'])): ?>
                      <span style="color:red;"><?= $errors['discount_price'] ?></span>
                    <?php endif; ?>
                  </div>

                  <div class=" col-6">
                    <label for="id_categogy">Danh mục sản phẩm</label>
                    <select class="form-control <?= isset($errors['categogy']) ? 'is-invalid' : '' ?>" name="id_categogy"
                      id="id_categogy" required>
                      <?php
                      if (!empty($data['category'])) {
                        foreach ($data['category'] as $category) {
                          $selected = ($category['id'] == $product['id_categogy']) ? 'selected' : '';
                          echo "<option value='{$category['id']}' {$selected}>{$category['name']}</option>";
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

                  <div class=" col-6">
                    <label for="status">Trạng thái</label>
                    <select class="form-control" name="status" id="status">
                      <option value="1" <?= ($product['status'] == 1) ? 'selected' : '' ?>>Hiển thị</option>
                      <option value="0" <?= ($product['status'] == 0) ? 'selected' : '' ?>>Ẩn</option>
                    </select>
                  </div>
                  <input type="hidden" class="form-control" name="date" id="date">
                  <div class=" col-12">
                    <label for="short_description">Mô tả ngắn</label>
                    <textarea class="form-control <?= isset($errors['short_description']) ? 'is-invalid' : '' ?>"
                      name="short_description" id="short_description"
                      rows="1"><?= $product['short_description'] ?></textarea>
                    <?php if (isset($errors['short_description'])): ?>
                      <span style="color:red;"><?= $errors['short_description'] ?></span>
                    <?php endif; ?>
                  </div>
                  <div class="  col-12">
                    <label for="description">Mô tả dài</label>
                    <textarea style="min-height:200px;" class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>"
                      name="description" id="description" rows="2"><?= $product['description'] ?></textarea>
                    <?php if (isset($errors['description'])): ?>
                      <span style="color:red;"><?= $errors['description'] ?></span>
                    <?php endif; ?>
                  </div>

                  <div class="col-6">
                    <button type="submit" class="btn btn-primary ms-3 mt-2">Cập nhật sản phẩm</button>
                  </div>
                </div>

                <div class="row container">
                  <div class="col-12 m-auto">
                    <!-- Ảnh chính sản phẩm -->
                    <div class=" col-12 mb-1">
                      <label for="image">Ảnh chính sản phẩm</label>
                      <img src="/public/uploads/products/<?= $product['image'] ?>" alt="Ảnh chính" class="img-fluid "
                        style="max-width: 20%;">
                      <input type="file" class="form-control image_product col-10" name="image" accept="image/*">
                    </div>

                    <!-- Ảnh chi tiết (phụ) -->
                    <div class=" col-12">
                      <div class="d-flex align-content-between justify-content-between col-12">
                        <label for="image">Chi tiết ảnh</label>
                        <a href="javascript:void(0)" onclick="createImage()" class="ml-2 btn btn-primary"
                          id="add-more-images">Thêm ảnh</a>
                      </div>

                      <div id="additional-images">
                        <input type="hidden" name="removedImages" id="removedImages" value="POST">
                        <?php
                        if (isset($data['images']) && !empty($data['images'])) {
                          if (is_string($data['images'])) {
                            $images = json_decode($data['images'], true);
                            if (!is_array($images)) {
                              $images = [];
                            }
                          } else {
                            $images = is_array($data['images']) ? $data['images'] : [];
                          }
                          if (!empty($images)) {
                            foreach ($images as $key => $images) {
                              ?>
                              <div class="image-group d-flex align-items-center justify-content-between mb-3">
                                <div class="text-center" style="overflow: hidden; max-width:5rem; max-height: 5rem;">
                                  <img src="/public/uploads/products/<?= htmlspecialchars($images) ?>" alt="Image [<?= $key ?>]"
                                    class="img-fluid" style="max-width: 100%;">
                                </div>
                                <div class="d-flex row align-items-baseline justify-content-between m-1 p-1 border rounded">
                                  <input type="file" class="form-control image_product col-10" name="images[]" multiple>
                                  <a href="javascript:void(0)" class="btn btn-danger delete-image" onclick="deleteImage(this)"
                                    data-image-name="<?= htmlspecialchars($images) ?>">Xóa</a>
                                </div>
                              </div>
                              <?php
                            }
                          } else {
                            echo "<p>Dữ liệu ảnh không hợp lệ.</p>";
                          }
                        } else {
                          echo "<p>Không có ảnh chi tiết.</p>";
                        }
                        ?>
                      </div>
                    </div>
                  </div>

                  <div class=" <?= isset($errors['description']) ? 'is-invalid' : '' ?>col-12 m-auto group_variant">
                    <div class="d-flex align-content-between justify-content-between col-12 mb-1">
                      <label for="image">Biến thể</label>
                      <a href="javascript:void(0)" onclick="createVariant()" class="ml-2 btn btn-primary"
                        id="add-more-images">Thêm biến thể</a>
                    </div>

                    <div id="additional-variants">
                      <?php if (isset($data['Arr_variant'])) { ?>
                        <?php foreach ($data['Arr_variant'] as $key => $variant) { ?>
                          <div class="variant-group row align-items-center m-1 p-1 border rounded">
                            <div class="col-5">
                              <input type="text" class="form-control" name="variant[<?= $key ?>][nameVariant]"
                                placeholder="Tên biến thể" value="<?= $variant['nameVariant'] ?? '' ?>">
                            </div>
                            <div class="col-5">
                              <input type="text" class="form-control" name="variant[<?= $key ?>][priceVariant]"
                                placeholder="Giá" value="<?= $variant['priceVariant'] ?? '' ?>">
                            </div>
                            <div class="col-2 text-end">
                              <a href="javascript:void(0)" class="btn btn-danger delete-image" onclick="deleteVariant(this)">
                                <i class="bi bi-trash"></i> Xóa
                              </a>
                            </div>
                          </div>
                        <?php } ?>
                      <?php } else { ?>
                        <p>Không có biến thể.</p>
                      <?php } ?>
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
        <!-- End Form Edit Product -->
      </div>
    </div>

    <?php
  }
}
?>