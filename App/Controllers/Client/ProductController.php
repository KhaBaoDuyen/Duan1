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
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\UserModel;
// use App\Views\Client\Components\Category;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Product\Categories  as ProductCategory;
use App\Views\Client\Pages\Product\Shop;
use App\Views\Client\Pages\Product\Index;
use App\Views\Client\Pages\Product\Detail;

class ProductController
{
    // hiển thị danh sách
    public static function index()
    {
        Header::render();
        Index::render();
        Footer::render();
    }
 
    public static function Detail()
    {
        Header::render();
        Detail::render();
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



}
