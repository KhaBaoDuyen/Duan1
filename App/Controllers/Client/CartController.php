<?php
namespace App\Controllers\Client;

use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Cart\History;
use App\Views\Client\Pages\Cart\Cart;
use App\Views\Client\Pages\Cart\Checkout;

class CartController
{
    public static function index()
    {

        $data = $_SESSION['cart'];
        // if(isset($_SESSION[`cart`])) { 
        //     $data = $_SESSION['cart'];
        //     var_dump($data);
        //     // var_dump($data);
        //     die();
        // }
        Header::render();
        Cart::render($data);
        Footer::render();
    }

    public static function add_to_card() {
        $data = [
            'id_product' => $_GET['id_product'],
            'quantity' => $_GET['product_quantity'],
            'name' => $_GET['product_name'],
        ];
        $_SESSION['cart'][] = $data; 
        header('Location: /cart');  
    }

    public static function checkout()
    {
        Header::render();
        Checkout::render();
        Footer::render();
    }

    public static function history()
    {
        Header::render();
        History::render();
        Footer::render();
    }
   

}
?>