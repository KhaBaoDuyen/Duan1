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
    // hiển thị danh sách
    public static function index()
    {
        $product = new ProductModel();
        $products = $product->getAllProduct();

        $category = new CategoryModel();
        $categories = $category->getAllByStatus();

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
        // echo ('<pre>');
//   var_dump($countCategoryProduct);
// die;
        $data = [
            'products' => $products,
            'categories' => $categories,
            'count_product' => $count_product['total'],
            'count_category' => $count_category['total'],
            'total_comment' => $total_comment['total'],

        ];

        Header::render();
        Index::render($data);
        Footer::render();
    }

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

        $Arr_variant = [];
        $images = [];

        if ($data['product'] && isset($data['product']) && !empty($data['product'])) {
            if (isset($data['product']['variant']) && !empty($data['product']['variant'])) {
                $Arr_variant = json_decode($data['product']['variant'], true);
            }
        }
        ;
        if ($data['product'] && isset($data['product']) && !empty($data['product'])) {
            if (isset($data['product']['images']) && !empty($data['product']['images'])) {
                $images = json_decode($data['product']['images'], true);
            }
        }
        $data['Arr_variant'] = $Arr_variant;
        $data['images'] = $images;
        Header::render();
        // Notification::render();
        // NotificationHelper::unset();
        Detail::render($data);
        Footer::render();
    }



    //-------SP THEO DANH MỤC--------------
    public static function getProductByCategory($id)
    {
        $product = new ProductModel();
        $products = $product->getAllProductByCategoryAndStatus($id);

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
        $data = [
            'products' => $products,
            'categories' => $categories,
            'count_product' => $count_product['total'],
            'count_category' => $count_category['total'],
            'total_comment' => $total_comment['total'],
            'countCategoryProduct' => $countCategoryProduct
        ];

        // echo"<pre>";
        // var_dump($data['products']);
        // var_dump($data['categories']);

        Header::render();
        ProductCategory::render($data);
        Footer::render();
    }
    // --------- ĐẾm số lượng ----------------
    // public static function countProductByCategory($id)
    // {
    //     $product = new ProductModel();
    //     $count = $product->countProductByCategory($id);
    //     echo $count;
    // }

}
