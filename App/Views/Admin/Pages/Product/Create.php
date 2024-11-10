<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class Create extends BaseView
{
    public static function render($data = null)
    {
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
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Form Thêm Sản phẩm</h6>
                        </div>
                        <div class="card-body">
                            <form action="/admin/Products" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="method" value="post">
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Giá sản phẩm</label>
                                    <input type="number" class="form-control" name="price" id="price" required>
                                </div>
                                <div class="form-group">
                                    <label for="discount_price">Giảm giá</label>
                                    <input type="number" class="form-control" name="discount_price" id="discount_price">
                                </div>

                                <!-- Ảnh sản phẩm (Ảnh chính của sản phẩm) -->
                                <div class="form-group">
                                    <label for="image">Ảnh chính sản phẩm</label>
                                    <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
                                </div>

                                <!-- Ảnh hover (Ảnh hiển thị khi hover) -->
                                <!-- <div class="form-group">
                                    <label for="hover_image">Ảnh hiển thị khi hover</label>
                                    <input type="file" class="form-control" name="hover_image" id="hover_image" accept="image/*" required>
                                </div> -->

                                <!-- Danh mục sản phẩm -->
                                <div class="form-group">
                                    <label for="id_categogy">Danh mục sản phẩm</label>
                                    <select class="form-control" name="id_categogy" id="id_categogy" required>
                                        <option value="">Chọn danh mục</option>
                                        <?php
                                        // Kiểm tra xem danh mục có dữ liệu không
                                        if (!empty($data['categories'])) {
                                            // Lặp qua các danh mục và hiển thị các option
                                            foreach ($data['categories'] as $category) {
                                                echo "<option value='{$category['id']}'>{$category['name']}</option>";
                                            }
                                        } else {
                                            echo "<option value=''>Không có danh mục nào</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="date">Thời gian thêm</label>
                                    <input type="date" class="form-control" name="date" id="date">
                                </div>

                                <div class="form-group">
                                    <label for="short_description">Mô tả ngắn</label>
                                    <textarea class="form-control" name="short_description" id="short_description" rows="1" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô tả dài</label>
                                    <textarea class="form-control" name="description" id="description" rows="2" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="start_time">Thời gian bắt đầu</label>
                                    <input type="datetime-local" class="form-control" name="start_time" id="start_time">
                                </div>
                                <div class="form-group">
                                    <label for="end_time">Thời gian kết thúc</label>
                                    <input type="datetime-local" class="form-control" name="end_time" id="end_time">
                                </div>

                                <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Form Add Product -->
            </div>
        </div>
        <!-- End Page Content -->
        <?php
    }
}