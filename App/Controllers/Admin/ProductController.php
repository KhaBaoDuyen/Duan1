<?php

namespace App\Controllers\Admin;

use App\Helpers\FileUploadHelper;
use App\Helpers\NotificationHelper;
use App\Validation\AuthValidation;
use App\Validation\ProductValidation;
use App\Models\CategoryModel;
use App\Models\ImageProductModel;
use App\Models\VariantProductModel;
use App\Models\ProductModel;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
// use App\Views\Admin\Pages\Product\Category as ProductCategory;
use App\Views\Admin\Pages\Product\Shop;
use App\Views\Admin\Pages\Product\Index;
use App\Views\Admin\Pages\Product\Create;
use App\Views\Admin\Pages\Product\Search;
use App\Views\Admin\Pages\Product\Edit;
use App\Views\Admin\Pages\Product\Detail;

class ProductController
{

    public static function Index()
    {
        $products = new ProductModel();
        $data['products'] = $products->getAllProductJoinCategory();

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }



    //------------ [ CREATE ]-------------

    public static function create()
    {
        $categogy = new CategoryModel();
        $data = $categogy->getAllCategoryByStatus();


        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Create::render($data);
        Footer::render();
    }


    //------------ [ STORE ]-------------

    public static function store()
    {
        $is_valid = ProductValidation::create();
        if (!$is_valid) {
            NotificationHelper::error('store', 'Thêm thất bại. Thông tin không hợp lệ.');
            header("Location: /admin/products/create");
            exit;
        }
        $product = new ProductModel();
        $is_exist = $product->getOneProductByName($_POST['name']);
        if ($is_exist) {
            NotificationHelper::error('store', 'Tên sản phẩm đã tồn tại');
            header('Location: /admin/products/create');
            exit;
        }

        $variants = $_POST['variant'] ?? null;
        $variant = isset($variants) && $variants != null ? json_encode($variants) : null;

        $images = $_FILES['images'] ?? null;
        if (isset($images) && $images != null) {
            $is_upload = ProductValidation::image();

            if (!$is_upload) {
                NotificationHelper::error('store', 'Vui lòng chọn hình ảnh sản phẩm.');
                header("Location: /admin/products/create");
                exit;
            }
        } else {
            NotificationHelper::error('store', 'Vui lòng chọn hình ảnh sản phẩm.');
            header("Location: /admin/products/create");
            exit;
        }

        $data = [
            'name' => $_POST['name'] ?? '',
            'price' => $_POST['price'] ?? 0,
            'status' => $_POST['status'] ?? 0,
            'discount_price' => !empty($_POST['discount_price']) ? (int) $_POST['discount_price'] : 0,
            'id_categogy' => $_POST['id_categogy'] ?? null,
            'date' => date('Y-m-d H:i:s'),
            'description' => $_POST['description'] ?? '',
            'short_description' => $_POST['short_description'] ?? '',
            'variant' => $variant,
        ];

        if (!empty($_POST['start_time'])) {
            $data['start_time'] = (new \DateTime($_POST['start_time']))->format('Y-m-d H:i:s');
        }

        if (!empty($_POST['end_time'])) {
            $data['end_time'] = (new \DateTime($_POST['end_time']))->format('Y-m-d H:i:s');
        }

        if (isset($is_upload)) {
            $imageNames = json_decode($is_upload, true); // Giải mã JSON từ hàm image()

            $data['image'] = $imageNames['image'] ?? '';
            $data['images'] = isset($imageNames['images']) ? json_encode($imageNames['images']) : ''; // Ảnh phụ
        }

        $result = $product->createProduct($data);
        if ($result) {
            NotificationHelper::success('product', 'Thêm sản phẩm thành công');
            header('Location: /admin/Product');
        } else {
            NotificationHelper::error('product', 'Thêm sản phẩm thất bại');
            header("Location: /admin/products/create");
        }

        exit;
    }

    // hiển thị giao diện form sửa
    public static function edit($id)
    {
        $category = new CategoryModel();
        $data['category'] = $category->getAllCategory();

        $product = new ProductModel();
        $data['product'] = $product->getOneProduct($id);

        $Arr_variant = [];
        $images = [];

        if ($data['product'] && isset($data['product']) && !empty($data['product'])) {
            if (isset($data['product']['variant']) && !empty($data['product']['variant'])) {
                $Arr_variant = json_decode($data['product']['variant'], true);
            }
        }
        if ($data['product'] && isset($data['product']) && !empty($data['product'])) {
            if (isset($data['product']['images']) && !empty($data['product']['images'])) {
                $images = json_decode($data['product']['images'], true);
            }
        }

        $data['Arr_variant'] = $Arr_variant;
        $data['images'] = $images;

        if ($data['product']) {
            Header::render();
            Notification::render();
            Edit::render($data);
            Footer::render();
        } else {
            NotificationHelper::error('product', 'Không có sản phẩm này');
            header('location: /admin/products');
        }
    }



    // xử lý chức năng sửa (cập nhật)
    public static function update(int $id)
    {
        $is_valid = ProductValidation::update($id);
        $product = new ProductModel();
        $current_product = $product->getOneProduct($id);
        if (!$is_valid) {
            NotificationHelper::error('update', 'Cập nhật thất bại');
            header("Location: /admin/products/$id");
            exit;
        }
        $is_exist = $product->getOneProductByName($_POST['name']);
        if (!$is_exist) {
            NotificationHelper::error('update', 'Tên sản phẩm đã tồn tại');
            header("Location: /admin/products/$id");
            exit;
        }

        $variants = $_POST['variant'];
$variant = isset($variants) && $variants != null ? json_encode($variants, JSON_UNESCAPED_UNICODE) : $current_product['variant'];
        $data = [
            'name' => $_POST['name'] ?? '',
            'price' => $_POST['price'] ?? 0,
            'status' => $_POST['status'] ?? 0,
            'discount_price' => !empty($_POST['discount_price']) ? (int) $_POST['discount_price'] : 0,
            'id_categogy' => $_POST['id_categogy'] ?? null,
            'date' => date('Y-m-d H:i:s'),
            'description' => $_POST['description'] ?? '',
            'short_description' => $_POST['short_description'] ?? '',
            'variant' => $variant,
        ];

        if (!empty($_POST['start_time'])) {
            $data['start_time'] = (new \DateTime($_POST['start_time']))->format('Y-m-d H:i:s');
        }

        if (!empty($_POST['end_time'])) {
            $data['end_time'] = (new \DateTime($_POST['end_time']))->format('Y-m-d H:i:s');
        }

        $allowed_types = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
        $is_upload_main_image = isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK;
        $is_upload_sub_images = isset($_FILES['images']) && count($_FILES['images']['name']) > 0;

        $imageNames = [
            'image' => $current_product['image'] ?? '',
            'images' => json_decode($current_product['images'], true) ?? []
        ];

        // Xử lý ảnh chính
        if ($is_upload_main_image) {
            $mainImageType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            if (in_array($mainImageType, $allowed_types)) {
                $mainImageName = date('YmdHis') . '_main.' . $mainImageType;
                $mainImagePath = 'public/uploads/products/' . $mainImageName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $mainImagePath)) {
                    $imageNames['image'] = $mainImageName;
                } else {
                    NotificationHelper::error('move_upload', 'Không thể lưu ảnh chính.');
                }
            } else {
                NotificationHelper::error('invalid_main_image', 'Ảnh chính không hợp lệ.');
            }
        }

        $imageNames['images'] = is_array($imageNames['images']) ? $imageNames['images'] : json_decode($imageNames['images'], true);
        // Xử lý ảnh phụ
        if ($is_upload_sub_images) {
            $newSubImages = [];
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                    $subImageType = strtolower(pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION));
                    if (in_array($subImageType, $allowed_types)) {
                        $subImageName = date('YmdHis') . '_sub_' . $key . '.' . $subImageType;
                        $subImagePath = 'public/uploads/products/' . $subImageName;
                        if (move_uploaded_file($tmp_name, $subImagePath)) {
                            $newSubImages[] = $subImageName;
                        } else {
                            NotificationHelper::error('move_upload_sub', 'Không thể lưu ảnh phụ thứ ' . $key);
                        }
                    } else {
                        NotificationHelper::error('invalid_sub_image', 'Ảnh phụ thứ ' . $key . ' không hợp lệ.');
                    }
                }
            }

            // Gộp ảnh phụ mới vào danh sách cũ
            $imageNames['images'] = array_merge($imageNames['images'], $newSubImages);
        }

        // Xử lý ảnh xóa
        $removedImages = !empty($_POST['removedImages']) ? json_decode($_POST['removedImages'], true) : [];
        $removedImages = is_array($removedImages) ? $removedImages : [];
        $subImageArray = is_array($imageNames['images']) ? $imageNames['images'] : [];

        foreach ($removedImages as $removedImage) {
            $key = array_search($removedImage, $subImageArray);
            if ($key !== false) {
                $filePath = 'public/uploads/products/' . $removedImage;
                if (file_exists($filePath)) {
                    unlink($filePath); // Xóa file trên server
                }
                unset($subImageArray[$key]); // Loại bỏ ảnh đã xóa khỏi mảng
            }
        }

        $imageNames['images'] = array_values($subImageArray); // Đảm bảo mảng không có khóa bị bỏ trống
        $data['image'] = $imageNames['image'];
        $data['images'] = json_encode($imageNames['images']);
        $result = $product->update($id, $data);

        if ($result) {
            NotificationHelper::success('update', 'Cập nhật thành công');
            header('location: /admin/Product');
            exit;
        } else {
            NotificationHelper::error('update', 'Cập nhật thất bại');
            // header('location: /admin/Product');
        }
    }

    // thực hiện xoá
    public static function delete($id)
    {
        $product = new ProductModel();
        $result = $product->delete($id);

        if ($result) {
            NotificationHelper::success('product', 'Xoá thành công');
        } else {
            NotificationHelper::error('product', 'Xoá thất bại !');
        }
        header('location: /admin/Product');
    }


    public static function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $product = new ProductModel();
        $products = $product->searchByKeywordProduct($keyword);
        $allproduct = $product->getAllProductJoinCategory();

        $data = [
            'keyword' => $keyword,
            'products' => $products,
            'allproduct' => $allproduct
        ];
        Header::render();
        Search::render($data);
        Footer::render();
    }
}
