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
use App\Views\Admin\Pages\Order\index as OrderIndex;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Product\Category as ProductCategory;
use App\Views\Client\Pages\Product\Shop;
use App\Views\Client\Pages\Product\Index;
use App\Views\Client\Pages\Product\Detail;


class ProductController
{
    protected $productModel;
    protected $categoryModel;
    public function __construct()
    {
        // index product
        $this->productModel = new  ProductModel();
    }
    // hiển thị danh sách
    public static function index()
    {
        Header::render();
        Index::render();
        Footer::render();
    }
 
    public static function detail($id)
    {
        $product = new ProductModel();
        $image = new ImageProductModel();
        $data['products'] = $product->getOneProductByStatus($id);
        $data['images_product'] = $image->getAllImagesByProduct($id);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Detail::render($data);
        Footer::render();
    }

}
