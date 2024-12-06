<?php

namespace App\Controllers\Client;

use App\Models\BaseModel;
use App\Models\ProductModel;
use App\Models\CartModel;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Cart\History;
use App\Views\Client\Pages\Cart\Cart;
use App\Views\Client\Pages\Cart\Checkout;
use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;

class CartController
{
    protected $productModel;
    public function __construct()
    {
        // $this->loadModel('ProductModel');
        $this->productModel = new ProductModel;

    }
    public static function index()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (isset($_SESSION['user']['id'])) {
            $cartModel = new CartModel();
            $data = $cartModel->getAllCartByUserId($_SESSION['user']['id']);
            Header::render();
            Notification::render();
            NotificationHelper::unset();
            Cart::render($data);
            Footer::render();

            $_SESSION['checkout'] = [];
            // $id_user = $_SESSION['user']['id'];
            $_SESSION['checkout'] = $data;
            echo "</pre>";
            print_r($_SESSION['checkout']);

        } else {
            Header::render();
            Notification::render();
            NotificationHelper::unset();
            Cart::render();
            Footer::render();
        }

        // $_SESSION['Checkout'] = [];
        // $id_user = $_SESSION['user']['id'];

        // $idUser = $id_user;
        // $id_product = $_POST['id_product'];
        // $image = $_POST['image'];
        // $name = $_POST['name'];
        // $price = $_POST['price'];
        // $quantity = $_POST['quantity'];
        // $variantKey = $_POST['selected_variant'] ?? null;

        // $itemCart = array($id_product, $idUser, $image, $name, $price, $quantity, $variantKey);
        // $_SESSION['Checkout'] = $itemCart;
        // echo "<pre>";
        // var_dump($_SESSION['Checkout']);
        // echo "</pre>";
        // die(); 

    }


    public function store($id)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION['user']['id'])) {
            header("Location: /cart");
            exit;
        }

        $products = new ProductModel();
        $product = $products->getOneProductByStatus($id);

        $variantKey = $_POST['selected_variant'] ?? null;
        $quantity = $_POST['product_quantity'] ?? 1;

        $Arr_variant = [];
        if (!empty($product['variant'])) {
            $Arr_variant = json_decode($product['variant'], true);
        }
        $variant = $Arr_variant[$variantKey] ?? null;
        $price = $product['price'];
        if ($variant) {
            $price = $variant['priceVariant'];
        } elseif (isset($product['discount_price']) && !empty($product['discount_price'])) {
            $price = $product['discount_price'];
        }

        // $data = [
        //     'id' => $product['id'],
        //     'name' => $product['name'],
        //     'image' => $product['image'],
        //     'variant_name' => $variant['nameVariant'] ?? '',
        //     'price' => $price,
        //     'quantity' => $quantity,
        // ];
        // $_SESSION['checkout'] = $data;
        $id_user = $_SESSION['user']['id'];
        $cartModel = new CartModel();

        $setCart = $cartModel->getCartItem($id_user, $id, $variantKey);

        if (!$setCart && !$variantKey) {
            $setCart = $cartModel->getCartItemByProductId($id_user, $id);
        }

        if ($setCart) {
            $newQuantity = $setCart['quantity'] + $quantity;
            $cartModel->updateCartItem($setCart['id'], $newQuantity);
        } else {

            $data = [
                'id_user' => $id_user,
                'id_product' => $id,
                'variant_key' => $variantKey,
                'quantity' => $quantity,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];

            $result = $cartModel->createCart($data);
            if ($result) {
                NotificationHelper::success('cart_shopping', 'Thêm thành công');
                header("location: /product/$id");
                exit;
            } else {
                NotificationHelper::error('cart_shopping', 'Thêm giỏ hàng thất bại.');
            }
        }
        // echo "<pre>";
        // var_dump($_SESSION);
        // die;
        header("location: /product/$id");
    }


    public static function delete($id)
    {
        echo __METHOD__;
        $variantKey = $_POST['selected_variant'] ?? null;
        $id_product = $_POST['id_product'] ?? $id;

        if (isset($_SESSION['user']['id'])) {
            $id_user = $_SESSION['user']['id'];
            $cartModel = new CartModel();

            if ($variantKey) {
                $delete = $cartModel->deleteCartItemVariant($id_user, $id_product, $variantKey);
            } else {
                $delete = $cartModel->deleteCartItem($id_user, $id_product);
            }
        }
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        header("Location: /cart");
        exit;
    }

    public static function update()
    {
        echo "<pre>";
        print_r($_POST);

        if (isset($_SESSION['user']['id'])) {
            $id_user = $_SESSION['user']['id'];
            $cartModel = new CartModel();
            if (isset($_POST['cart']) && is_array($_POST['cart'])) {
                foreach ($_POST['cart'] as $productId => $variants) {
                    foreach ($variants as $variantKey => $details) {
                        $quantity = $details['quantity'];
                        $setCart = $cartModel->getCartItem($id_user, $productId, $variantKey);

                        // Nếu không có biến thể và có sản phẩm cùng ID thì lấy sản phẩm đó
                        if (!$setCart && !$variantKey) {
                            $setCart = $cartModel->getCartItemByProductId($id_user, $productId);
                        }
                        if ($setCart) {
                            $cartModel->updateCartItem($setCart['id'], $quantity);
                        }
                    }
                }
            }
        }
    }


    public static function history()
    {
        Header::render();
        History::render();
        Footer::render();
    }



}
