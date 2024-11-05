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
        Header::render();
        Cart::render();
        Footer::render();
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