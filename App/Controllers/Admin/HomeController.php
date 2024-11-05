<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Home;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;

class HomeController
{
    // hiển thị thống kê
    public static function index()
    {
$user = new UserModel;
$total_user=$user->countTotalUser();

$product = new ProductModel;
$total_product=$product->countTotalProduct();
$product_by_categ=$product ->countProductByCategogy();
$product_by_view=$product -> countProductByView();

$categogy = new CategoryModel;
$total_categogy=$categogy->countTotalCategogy();


$comment = new CommentModel;
$total_comment=$comment->countTotalComment();

$data=[
 'total_user'=>$total_user['total'],
 'total_product'=>$total_product['total'],
 'total_categogy'=>$total_categogy['total'],
 'total_comment'=>$total_comment['total'],
'product_by_categ'=>$product_by_categ,
'product_by_view'=>$product_by_view
];

// echo"<pre>";
// var_dump($product_by_view);
        Header::render();
        Home::render($data);
        Footer::render();
    }
}
