<?php

namespace App\Controllers\Client;

use App\Helpers\AuthHelper;
use App\Helpers\ViewHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\ProductHelper;
use App\Models\Category;
use App\Models\CategoryModel;
use App\Models\Comment;
use App\Models\CommentModel;
use App\Models\ImageProductModel;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\UserModel;
// use App\Views\Client\Components\Category;
use App\Views\Admin\Pages\Order\index as OrderIndex;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Product\Categories as ProductCategory;
use App\Views\Client\Pages\Product\Shop;
use App\Views\Client\Pages\Product\Index;
use App\Views\Client\Pages\Product\Edit;
use App\Views\Client\Pages\Product\Detail;


class ProductController
{
    protected $productModel;
    protected $categoryModel;
    public function __construct()
    {
        $this->productModel = new ProductModel();
    }
    /* private static function filterProductsByPrice($products, $priceMinArray, $priceMaxArray)
    {
        $filteredProducts = [];

        foreach ($products as $item) {
            $price = $item['price'];

            // Kiểm tra xem sản phẩm có thuộc một trong các khoảng giá không
            foreach ($priceMinArray as $key => $priceMin) {
                $priceMax = $priceMaxArray[$key]; // lấy priceMax tương ứng

                if ($price >= $priceMin && $price <= $priceMax) {
                    $filteredProducts[] = $item;
                    break; // Nếu sản phẩm đã nằm trong một khoảng giá, không cần kiểm tra thêm
                }
            }
        }

        return $filteredProducts;
    } */
    // hiển thị danh sách
    public static function index()
    {
        $product = new ProductModel();
        $products = $product->getAllProduct();

        // $category = new CategoryModel();
        // $categories = $category->getAllCategoryByStatus();
        $category = new CategoryModel();
        $categories = $category->getAllByStatus();

        $itemsPerPage = 16;  // Số lượng sản phẩm trên mỗi trang
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;  // Lấy trang hiện tại từ URL (mặc định là 1)
        $totalProducts = count($products);  // Tổng số sản phẩm
        $totalPages = ceil($totalProducts / $itemsPerPage);  // Tính tổng số trang
    
        // Tính chỉ số bắt đầu của các sản phẩm cần hiển thị
        $startIndex = ($currentPage - 1) * $itemsPerPage;
        $products = array_slice($products, $startIndex, $itemsPerPage);  // Cắt mảng sản phẩm để chỉ hiển thị 8 sản phẩm

        $count_product = $product->countTotalProduct();
        $count_category = $category->countCategory();
        $countCategoryProduct = $product->countProductByCategogy();

        $comment = new CommentModel;
        $total_comment = $comment->countCommentByStatus();

        foreach ($categories as &$categoryItem) {
            $categoryItem['countCategoryProduct'] = 0; // Mặc định 0 nếu không có sản phẩm
            foreach ($countCategoryProduct as $countItem) {
                if ($categoryItem['id'] === $countItem['id']) {
                    $categoryItem['countCategoryProduct'] = $countItem['product_count'];
                    break;
                }
            }
        }
        // Lấy giá trị priceMin và priceMax từ URL
        // Xử lý giá trị priceMin
        $priceMinArray = isset($_GET['priceMin']) ? $_GET['priceMin'] : [];
        $priceMaxArray = [];
        
        foreach ($priceMinArray as $priceMin) {
            switch ($priceMin) {
                case '0':
                    $priceMaxArray[] = 100000;
                    break;
                case '100000':
                    $priceMaxArray[] = 500000;
                    break;
                case '500000':
                    $priceMaxArray[] = 1000000;
                    break;
                case '1000000':
                    $priceMaxArray[] = 3000000;
                    break;
                case '3000000':
                    $priceMaxArray[] = 5000000;
                    break;
            }
        }
        

        // Debug giá trị priceMin và priceMax
        /* var_dump($priceMinArray, $priceMaxArray); */

        // Nếu có các giá trị priceMin và priceMax, thì lọc theo khoảng giá
        if (!empty($priceMinArray) && !empty($priceMaxArray)) {
            $products = self::filterProductsByPrice($products, $priceMinArray, $priceMaxArray);
        }
        // Kiểm tra kiểu sắp xếp (tăng dần hoặc giảm dần)
        $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : '';

        // Sắp xếp sản phẩm nếu có
        if ($sortOrder) {
            $products = self::sortProducts($products, $sortOrder);
        }

        // echo ('<pre>');
//   var_dump($countCategoryProduct);
// die;
        $data = [
            'products' => $products,
            'categories' => $categories,
            'count_product' => $count_product['total'],
            'count_category' => $count_category['total'],
            'currentPage' => $currentPage,
        'totalPages' => $totalPages,
            'total_comment' => $total_comment['total'],

        ];

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }

    // Sắp xếp sản phẩm
    /* private static function sortProducts($products, $sortOrder)
    {
        usort($products, function ($a, $b) use ($sortOrder) {
            if ($sortOrder === 'asc') {
                return $a['price'] <=> $b['price']; // Tăng dần
            } elseif ($sortOrder === 'desc') {
                return $b['price'] <=> $a['price']; // Giảm dần
            }
            return 0; // Nếu không có sắp xếp, giữ nguyên
        });
        return $products;
    } */


    public static function Detail($id)
    {


        $comment = new CommentModel();
        $data['comments'] = $comment->get5CommentNewestByProductAndStatus($id);

        $product = new ProductModel();
        $data['product'] = $product->getOneProductByStatus($id);
        if (!$data['product']) {
            NotificationHelper::error('product_detail', 'Sản phẩm không tồn tại');
            header("location: /shop");
        }
        //var_dump($data['comments']);
        $Arr_variant = [];
        $images = [];

        if ($data['product'] && isset($data['product']) && !empty($data['product'])) {
            if (isset($data['product']['variant']) && !empty($data['product']['variant'])) {
                $Arr_variant = json_decode($data['product']['variant'], true);
            }
        };

        if ($data['product'] && isset($data['product']) && !empty($data['product'])) {
            if (isset($data['product']['images']) && !empty($data['product']['images'])) {
                $images = json_decode($data['product']['images'], true);
            }
        }
        $data['Arr_variant'] = $Arr_variant;
        $data['images'] = $images;
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Detail::render($data);
        Footer::render();
    }



    //-------SP THEO DANH MỤC--------------
    public static function getProductByCategory($id)
    {
        $product = new ProductModel();
        $products = $product->getAllProductByCategoryAndStatus($id); // Lấy tất cả sản phẩm trong danh mục
    
        $category = new CategoryModel();
        $categories = $category->getAllCategoryByStatus();
        $count_product = $product->countTotalProduct();
        $count_category = $category->countCategory();
        $countCategoryProduct = $product->countProductByCategogy();

        $comment = new CommentModel;
        $total_comment = $comment->countCommentByStatus();

        foreach ($categories as &$categoryItem) {
            $categoryItem['countCategoryProduct'] = 0; // Mặc định 0 nếu không có sản phẩm
            foreach ($countCategoryProduct as $countItem) {
                if ($categoryItem['id'] === $countItem['id']) {
                    $categoryItem['countCategoryProduct'] = $countItem['product_count'];
                    break;
                }
            }
        }
        
    
        // Lấy giá trị priceMin từ URL
        $priceMinArray = isset($_GET['priceMin']) ? $_GET['priceMin'] : [];
        $priceMaxArray = [];
    
        // Chuyển đổi các giá trị priceMin thành các priceMax tương ứng
        foreach ($priceMinArray as $priceMin) {
            switch ($priceMin) {
                case '0':
                    $priceMaxArray[] = 100000;
                    break;
                case '100000':
                    $priceMaxArray[] = 500000;
                    break;
                case '500000':
                    $priceMaxArray[] = 1000000;
                    break;
                case '1000000':
                    $priceMaxArray[] = 3000000;
                    break;
                case '3000000':
                    $priceMaxArray[] = 5000000;
                    break;
            }
        }
    
        // Lọc các sản phẩm theo giá nếu có giá trị lọc
        if (!empty($priceMinArray) && !empty($priceMaxArray)) {
            $products = self::filterProductsByPrice($products, $priceMinArray, $priceMaxArray);
        }
    
        // Kiểm tra nếu không có sản phẩm nào phù hợp với lọc giá
        if (empty($products)) {
            $noProductsMessage = "Không có sản phẩm trong tầm giá này.";
        }
    
        // Dữ liệu truyền vào view
        $data = [
            'products' => $products,
            'categories' => $categories,
            'noProductsMessage' => isset($noProductsMessage) ? $noProductsMessage : null,
            'priceMin' => $priceMinArray,
            'count_product' => $count_product['total'],
            'count_category' => $count_category['total'],
            'total_comment' => $total_comment['total'],
            'countCategoryProduct' => $countCategoryProduct
        ];
    
        Header::render();
        ProductCategory::render($data);
        Footer::render();
    }
    

    private static function filterProductsByPrice($products, $priceMinArray, $priceMaxArray)
    {
        $filteredProducts = [];
    
        foreach ($products as $item) {
            $price = $item['price'];
    
            // Kiểm tra xem sản phẩm có thuộc một trong các khoảng giá không
            foreach ($priceMinArray as $key => $priceMin) {
                $priceMax = $priceMaxArray[$key]; // lấy priceMax tương ứng
    
                if ($price >= $priceMin && $price <= $priceMax) {
                    $filteredProducts[] = $item;
                    break; // Nếu sản phẩm đã nằm trong một khoảng giá, không cần kiểm tra thêm
                }
            }
        }
    
        return $filteredProducts;
    }
    
    
    
    

    // Sắp xếp sản phẩm
    private static function sortProducts($products, $sortOrder)
    {
        usort($products, function ($a, $b) use ($sortOrder) {
            if ($sortOrder === 'asc') {
                return $a['price'] <=> $b['price']; // Tăng dần
            } elseif ($sortOrder === 'desc') {
                return $b['price'] <=> $a['price']; // Giảm dần
            }
            return 0; // Nếu không có sắp xếp, giữ nguyên
        });
        return $products;
    }
}
