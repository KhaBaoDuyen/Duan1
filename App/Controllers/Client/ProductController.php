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
        // index product
        $this->productModel = new ProductModel();
    }
    // hiển thị danh sách
    public static function index()
    {
        $product = new ProductModel();
        $products = $product->getAllProduct();

        $category = new CategoryModel();
        $categories = $category->getAllByStatus();

        $data = [
            'products' => $products,
            'categories' => $categories,
        ];

        Header::render();
        Index::render($data);
        Footer::render();
    }

    public static function Detail($id)
    {
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

        $data = [
            'products' => $products,
            'categories' => $categories,
        ];

        // echo"<pre>";
        // var_dump($data['products']);
        // var_dump($data['categories']);

        Header::render();
        ProductCategory::render($data);
        Footer::render();
    }
    // --------- LỌC SP THEO GIÁ ----------------
   public static function getProductByCategoryAndPriceAds($id)
    {
        $product = new ProductModel();
        $products = $product->getAllProductByCategoryAndStatus($id);
          
        
        $category = new CategoryModel();
        $categories = $category->getAllCategoryByStatus();

        $data = [
            'products' => $products,
            'categories' => $categories,
        ];

        // echo"<pre>";
        // var_dump($data['products']);
        // var_dump($data['categories']);

        Header::render();
        ProductCategory::render($data);
        Footer::render();
    }
}
