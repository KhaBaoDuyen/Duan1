<?php

namespace App\Controllers\Admin;
use App\Helpers\FileUploadHelper;
use App\Helpers\NotificationHelper;
use App\Validation\AuthValidation;
use App\Validation\ProductValidation;
use App\Models\CategoryModel;
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
 /*    public static function Index()
    {
        $products = new ProductModel();
        $data = $products->getAllProductJoinCategory();
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render();
        Footer::render();
    } */




   public static function Index()
{
    // Khởi tạo đối tượng ProductModel
    $products = new ProductModel();

    // Lấy tất cả sản phẩm kèm theo danh mục
    $data['products'] = $products->getAllProductJoinCategory();

    // Render header, thông báo, footer
    Header::render();
    Notification::render();
    NotificationHelper::unset();

    // Render trang danh sách sản phẩm và truyền dữ liệu vào view
    Index::render($data); // Giả sử Index::render nhận vào tham số $data
    Footer::render();
}










    //------------ [ CREATE ]-------------

    public static function create()
{
    // Lấy tất cả danh mục từ cơ sở dữ liệu
    $categories = new CategoryModel();
    $categoriesData = $categories->getAllCategory();  // Lấy tất cả các danh mục

    // Lấy tất cả sản phẩm cùng với danh mục
    $products = new ProductModel();
    $productsData = $products->getAllProductJoinCategory();  // Lấy sản phẩm với thông tin danh mục

    // Truyền dữ liệu vào view
    Header::render();
    Notification::render();
    NotificationHelper::unset();
    Create::render([
        'categories' => $categoriesData,  // Truyền danh mục vào view
        'products' => $productsData  // Truyền sản phẩm vào view nếu cần
    ]);
    Footer::render();
}




/*    public static function create()
    {
        $categories = new CategoryModel();
        $data = $categories->getAllCategory();
        $data = $categories->getAllProductJoinCategory();
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Create::render();
        Footer::render();
    } */


    //------------ [ STORE ]-------------




// Xử lý thêm sản phẩm mới



public function store()
    {
        // Kiểm tra nếu phương thức là POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product = new ProductModel();

            // Lấy dữ liệu từ form
            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'discount_price' => $_POST['discount_price'] ?? 0,
                'id_categogy' => $_POST['id_categogy'],
                'short_description' => $_POST['short_description'],
                'description' => $_POST['description'],
                'status' => $_POST['status'],
                'start_time' => $_POST['start_time'] ?? null,
                'end_time' => $_POST['end_time'] ?? null,
                'date' => $_POST['date'] ?? date('Y-m-d')
            ];

            // Xử lý upload ảnh chính
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $imagePath = FileUploadHelper::upload($_FILES['image'], 'uploads/products');
                $data['image'] = $imagePath;
            }

            // Thêm sản phẩm vào cơ sở dữ liệu
            if ($product->create($data)) {
                header("Location: /admin/Products"); // Điều hướng về danh sách sản phẩm sau khi thêm thành công
                exit();
            } else {
                echo "Lỗi: Không thể thêm sản phẩm!";
            }
        }
    }


/*    public static function store()

    {
        $is_valid = true;
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Không để trống tên');
            $is_valid = false;
        }
        if (!isset($_POST['price']) || $_POST['price'] === '') {
            NotificationHelper::error('price', 'Không để trống giá tiền');
            $is_valid = false;
        }
        if (!isset($_POST['discount_price']) || $_POST['discount_price'] === '') {
            NotificationHelper::error('discount_price', 'Không để trống giá giảm');
            $is_valid = false;
        }
        if (!isset($_POST['category_id']) || $_POST['category_id'] === '') {
            NotificationHelper::error('category_id', 'Không để trống loại sản phẩm');
            $is_valid = false;
        }
        if (!isset($_POST['is_featured']) || $_POST['is_featured'] === '') {
            NotificationHelper::error('is_featured', 'Không để trống sản phẩm nổi bật');
            $is_valid = false;
        }
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Không để trống trạng thái');
            $is_valid = false;
        }

        if ($is_valid) {
            // khởi tạo đối tượng model
            $product = new ProductModel();

            $is_exist = $product->getOneProductByName($_POST['name']);

            if ($is_exist) {
                NotificationHelper::error('name', 'Tên sản phẩm đã tồn tại');
                // chuyển hướng đến trang thêm
                header('location: /admin/product/create');
            } else {

                if (file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {

                    // nơi lưu trữ hình ảnh (trong source code)
                    $target_dir = "public/uploads/products/";

                    // lấy kiểu file (đuôi file)
                    $imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));

                    // thay đổi tên file thành dạng năm tháng ngày giờ phút giây
                    $nameImage = date('YmdHmi') . '.' . $imageFileType;

                    // đường dẫn đầy đủ để di chuyển file đến
                    $target_file = $target_dir . $nameImage;

                    // nếu upload thành công => lưu vào database
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        // echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

                    } else {
                        $nameImage = '';
                        NotificationHelper::error('upload_file', 'Upload file thất bại');
                    }
                }

                // mảng dữ liệu để lưu trữ vào database, lưu ý các key phải trùng với tên cột trong database
                $data = [
                    'name' => $_POST['name'],
                    'image' => $nameImage,
                    'description' => $_POST['description'],
                    'price' => $_POST['price'],
                    'discount_price' => $_POST['discount_price'],
                    'is_featured' => $_POST['is_featured'],
                    'status' => $_POST['status'],
                    // 'view' => $_POST['view'],
                    'category_id' => $_POST['category_id']

                ];

                // thực hiện thêm 
                $result = $product->createProduct($data);

                // kiểm tra kết quả
                if ($result) {
                    // echo 'Thêm thành công';
                    NotificationHelper::success('product', 'Thêm thành công');
                } else {
                    // echo 'Thất bại';
                    NotificationHelper::error('product', 'Thêm thất bại');
                }
                // chuyển hướng đến trang danh sách
                header('location: /admin/products');
            }
        } else {
            // chuyển hướng đến trang thêm
            header('location: /admin/products/create');
        }
    } */


    // hiển thị chi tiết
    public static function show()
    {
    }


    // hiển thị giao diện form sửa
    public static function edit($id)
    {
        // khởi tạo đối tượng model
        $category = new CategoryModel();
        $data['category'] = $category->getAllCategory();

        $product = new ProductModel();
        $data['product'] = $product->getOneProduct($id);

        // var_dump($data);
        if ($data['product']) {
            Header::render();
            Notification::render();
            NotificationHelper::unset();
            // hiển thị form sửa
            Edit::render($data);
            Footer::render();
        } else {
            NotificationHelper::error('product', 'Không có sản phẩm này');
            header('location: /admin/products');
        }
    }


    // xử lý chức năng sửa (cập nhật)
    public static function update($id)
    {
        $is_valid = true;
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Không để trống tên');
            $is_valid = false;
        }
        if (!isset($_POST['price']) || $_POST['price'] === '') {
            NotificationHelper::error('price', 'Không để trống giá tiền');
            $is_valid = false;
        }
        if (!isset($_POST['discount_price']) || $_POST['discount_price'] === '') {
            NotificationHelper::error('discount_price', 'Không để trống giá giảm');
            $is_valid = false;
        }
        if (!isset($_POST['category_id']) || $_POST['category_id'] === '') {
            NotificationHelper::error('category_id', 'Không để trống loại sản phẩm');
            $is_valid = false;
        }
        if (!isset($_POST['is_featured']) || $_POST['is_featured'] === '') {
            NotificationHelper::error('is_featured', 'Không để trống sản phẩm nổi bật');
            $is_valid = false;
        }
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Không để trống trạng thái');
            $is_valid = false;
        }

        if ($is_valid) {

            // khởi tạo đối tượng model
            $product = new ProductModel();

            $is_exist = $product->getOneProductByName($_POST['name']);

            if ($is_exist && $is_exist['id'] != $id) {
                NotificationHelper::error('name', 'Tên sản phẩm đã tồn tại');
                // chuyển hướng đến trang sửa
                header("location: /admin/products/$id");
            } else {

                if (file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {

                    // nơi lưu trữ hình ảnh (trong source code)
                    $target_dir = "public/uploads/products/";

                    // lấy kiểu file (đuôi file)
                    $imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));

                    // thay đổi tên file thành dạng năm tháng ngày giờ phút giây
                    $nameImage = date('YmdHmi') . '.' . $imageFileType;

                    // đường dẫn đầy đủ để di chuyển file đến
                    $target_file = $target_dir . $nameImage;

                    // nếu upload thành công => lưu vào database
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        // echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

                    } else {
                        $nameImage = '';
                        NotificationHelper::error('upload_file', 'Upload file thất bại');
                    }
                    // mảng dữ liệu để lưu trữ vào database, lưu ý các key phải trùng với tên cột trong database
                    $data = [
                        'name' => $_POST['name'],
                        'image' => $nameImage,
                        'description' => $_POST['description'],
                        'price' => $_POST['price'],
                        'discount_price' => $_POST['discount_price'],
                        'is_featured' => $_POST['is_featured'],
                        'status' => $_POST['status'],
                        // 'view' => $_POST['view'],
                        'category_id' => $_POST['category_id']

                    ];
                } else {
                    $data = [
                        'name' => $_POST['name'],
                        // 'image' => $nameImage,
                        'description' => $_POST['description'],
                        'price' => $_POST['price'],
                        'discount_price' => $_POST['discount_price'],
                        'is_featured' => $_POST['is_featured'],
                        'status' => $_POST['status'],
                        // 'view' => $_POST['view'],
                        'category_id' => $_POST['category_id']

                    ];
                }

                $product = new ProductModel();
                $result = $product->updateProduct($id, $data);

                if ($result) {
                    NotificationHelper::success('product', 'Cập nhật thành công');
                } else {
                    NotificationHelper::success('product', 'Cập nhật thất bại');
                }
                header('location: /admin/products');
            }
        } else {
            // chuyển hướng đến trang sửa
            header("location: /admin/products/$id");
        }
    }
    // thực hiện xoá
    public static function delete($id)
    {
        $product = new ProductModel();
        $result = $product->deleteProduct($id);
        if ($result) {
            // echo 'Xoá thành công';
            NotificationHelper::success('product', 'Xoá thành công');
        } else {
            NotificationHelper::error('product', 'Xoá thất bại');
        }


        header('location: /admin/products');
    }
 */
  public static function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $product = new ProductModel();
        $products = $product->searchByKeyword($keyword);

        $product = $product->getAllProduct();

        $data = [
            'keyword' => $keyword,
            'products' => $products,
            'allproduct' => $product
        ];
        Header::render();
        Search::render($data);
        Footer::render();
    }

}


