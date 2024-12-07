<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ini_set('log_errors', TRUE); 
ini_set('error_log', './logs/php/php-errors.log');
ini_set('memory_limit', '256M');


use App\Route;
use App\Helpers\AuthHelper;

require_once 'vendor/autoload.php';
require_once('App/Controllers/vnpay_php/config.php');


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
require_once 'config.php';
//  Gọi đến middleware;
AuthHelper::middleware(); 
// exit();


// ********************************** CLIENT ********************************
// ------- HEADER--------
Route::get('/', 'App\Controllers\Client\HomeController@index');
Route::get('/contact', 'App\Controllers\Client\HomeController@contact');
Route::post('/sendmailcontact', 'App\Controllers\Client\HomeController@sendmailContact');
Route::get('/about', 'App\Controllers\Client\HomeController@about');
Route::get('/Search', 'App\Controllers\Client\HomeController@search');

//---------------------------[ TÀI KHOẢN ]---------------------------
Route::get('/Account', 'App\Controllers\Client\AuthController@Account');

//--------------------------[ BÌNH LUẬN ]-------------------------------
Route::post('/comments', 'App\Controllers\Client\CommentController@store');
Route::put('/comments/{id}', 'App\Controllers\Client\CommentController@update');
Route::delete('/comments/{id}', 'App\Controllers\Client\CommentController@delete');

Route::get('/logout', 'App\Controllers\Client\AuthController@logout');

Route::get('/user', 'App\Controllers\Client\AuthController@profile');

//hiển thị thông tin tài khoản
Route::get('/user/{id}', 'App\Controllers\Client\AuthController@edit');
Route::put('/user/{id}', 'App\Controllers\Client\AuthController@update');

//Chức năng quên mật khẩu
Route::post('/sendmail', 'App\Controllers\Client\Sendmail@send_otp');
Route::get('/ForgotPassword', 'App\Controllers\Client\AuthController@ForgotPassword');
Route::get('/Resetpassword', 'App\Controllers\Client\AuthController@Resetpassword');
Route::post('/forgot-password', 'App\Controllers\Client\AuthController@forgotPasswordAction');
Route::put('/reset-password', 'App\Controllers\Client\AuthController@resetPasswordAction');

//-----------------------[ ĐĂNG KÝ ]--------------------------
Route::post('/home-register', 'App\Controllers\Client\AuthController@registerAction');

//-----------------------[ ĐĂNG Nhập ]--------------------------
Route::post('/home-login', 'App\Controllers\Client\AuthController@loginAction');

//-----------------------[ SẢN PHẨM ]--------------------------------
Route::get('/shop', 'App\Controllers\Client\ProductController@index'); 
Route::get('/product/{id}', 'App\Controllers\Client\ProductController@detail');

//----------------------[ SP THEO DANH MỤC ]-----------------------
Route::get('/product/categories/{id}', 'App\Controllers\Client\ProductController@getProductByCategory');

Route::get('/product/parent/{id}','App\Controllers\Client\ProductController@showSubCategories');

//-----------------------[ GIỎ HÀNG ]--------------------------------
Route::get('/cart', 'App\Controllers\Client\CartController@index'); 

Route::post('/cart/{id}', 'App\Controllers\Client\CartController@store'); 
Route::put('/cart', 'App\Controllers\Client\CartController@update');
Route::delete('/cart/{id}', 'App\Controllers\Client\CartController@delete'); 

Route::post('/checkout', 'App\Controllers\Client\CartController@muangay'); 

Route::get('/history', 'App\Controllers\Client\CartController@history'); 
Route::put('/history', 'App\Controllers\Client\CartController@updateHistory');
Route::post('/history/{id}', 'App\Controllers\Client\CartController@updateHistory');

//------------------------[ THANH TOÁN ]-------------------------
Route::get('/checkout', 'App\Controllers\Client\OrderController@checkout'); 

Route::get('/thank', 'App\Controllers\Client\OrderController@thank'); 

Route::post('/order', 'App\Controllers\Client\OrderController@store'); 

//*************MOMO**************

Route::post('/momo', 'App\Controllers\Client\PayMomo@createPayment');



//-----------------------[ KỸ THUAT TRỒNG CÂY ]--------------------------------
Route::get('/blog',  'App\Controllers\Client\HomeController@instruction'); 

//--------------------------[ NHẮC NHỞ  ]-------------------------------
Route::get('/reminders',  'App\Controllers\Client\ReminderController@index'); 


Route::post('/reminder', 'App\Controllers\Client\ReminderController@store');
Route::put('/reminder/{id}', 'App\Controllers\Client\ReminderController@update');
Route::delete('/reminder/{id}', 'App\Controllers\Client\ReminderController@delete'); 

// **************************** ADMIN ********************************

Route::get('/admin', 'App\Controllers\Admin\HomeController@index');

//---------------------------[ SẢN PHẨM ]--------------------------------
Route::get('/admin/Product', 'App\Controllers\Admin\ProductController@Index');

Route::get('/admin/products/create', 'App\Controllers\Admin\ProductController@create');
Route::post('/admin/products', 'App\Controllers\Admin\ProductController@store');


Route::get('/admin/products/{id}', 'App\Controllers\Admin\ProductController@edit');
Route::put('/admin/products/{id}', 'App\Controllers\Admin\ProductController@update');

Route::delete('/admin/products/{id}', 'App\Controllers\Admin\ProductController@delete'); 

Route::get('/admin/SearchProducts', 'App\Controllers\Admin\ProductController@search');

//--------------------------[ DANH MỤC ]--------------------------
Route::get('/admin/categories', 'App\Controllers\Admin\CategoryController@Index');

Route::get('/admin/categories/create', 'App\Controllers\Admin\CategoryController@create');
Route::post('/admin/categories', 'App\Controllers\Admin\CategoryController@store');

Route::get('/admin/categories/{id}', 'App\Controllers\Admin\CategoryController@edit');
Route::put('/admin/categories/{id}', 'App\Controllers\Admin\CategoryController@update'); 
Route::delete('/admin/categories/{id}', 'App\Controllers\Admin\CategoryController@delete');

Route::get('/admin/SearchCategogy', 'App\Controllers\Admin\CategoryController@search');

//---------------------------[ TÀI KHOẢN ]---------------------------
Route::get('/admin/users', 'App\Controllers\Admin\UserController@Index');

Route::get('/admin/SearchUsers', 'App\Controllers\Admin\UserController@search');

Route::get('/admin/users/{id}', 'App\Controllers\Admin\UserController@edit');
Route::put('/admin/users/{id}', 'App\Controllers\Admin\UserController@update');

Route::delete('/admin/users/{id}', 'App\Controllers\Admin\UserController@delete'); 

Route::get('/admin/logout', 'App\Controllers\Admin\UserController@logout');

//--------------------------[ ĐƠN HÀNG ]-------------------------------
Route::get('/admin/order', 'App\Controllers\Admin\OrderController@Index');
Route::get('/admin/order/{id}', 'App\Controllers\Admin\OrderController@Edit');
Route::put('/admin/order/{id}', 'App\Controllers\Admin\OrderController@update');
Route::delete('/admin/order/{id}', 'App\Controllers\Admin\OrderController@delete');
Route::get('/admin/searchOrder', 'App\Controllers\Admin\OrderController@searchOrder');
/* Route::get('/admin/comments/{id}', 'App\Controllers\Admin\CommentController@edit');
Route::put('/admin/comments/{id}', 'App\Controllers\Admin\CommentController@update');

Route::delete('/admin/comments/{id}', 'App\Controllers\Admin\CommentController@delete'); */


//--------------------------[ BÌNH LUẬN ]-------------------------------

// GET /comments (lấy danh sách bình luận)
Route::get('/admin/comments', 'App\Controllers\Admin\CommentController@index');

// GET /comments/create (hiển thị form thêm bình luận)
Route::get('/admin/comments/create', 'App\Controllers\Admin\CommentController@create');

// POST /comments (tạo mới một bình luận)
Route::post('/admin/comments', 'App\Controllers\Admin\CommentController@store');

// GET /comments/{id} (lấy chi tiết bình luận với id cụ thể)
Route::get('/admin/comments/{id}', 'App\Controllers\Admin\CommentController@edit');

// PUT /comments/{id} (update bình luận với id cụ thể)
Route::put('/admin/comments/{id}', 'App\Controllers\Admin\CommentController@update');

// DELETE /comments/{id} (delete bình luận với id cụ thể)
Route::delete('/admin/comments/{id}', 'App\Controllers\Admin\CommentController@delete');

//--------------------------[ QUẢN LÝ EMAIl ]-------------------------------
Route::get('/admin/contact', 'App\Controllers\Admin\ContactController@index');
Route::get('/admin/contact/{id}', 'App\Controllers\Admin\ContactController@edit');
Route::put('/admin/contact/{id}', 'App\Controllers\Admin\ContactController@update');
Route::delete('/admin/contact/{id}', 'App\Controllers\Admin\ContactController@delete');
Route::get('/admin/search', 'App\Controllers\Admin\ContactController@search');


/* Route::get('/admin/comments', 'App\Controllers\Admin\CommentController@Index');

/* Route::get('/admin/comments/{id}', 'App\Controllers\Admin\CommentController@edit');
Route::put('/admin/comments/{id}', 'App\Controllers\Admin\CommentController@update');

Route::delete('/admin/comments/{id}', 'App\Controllers\Admin\CommentController@delete'); */ 


 //------------------[ BẮT TÀI KHOẢN ĐĂNG NHẬP ]------------------
Route::dispatch($_SERVER['REQUEST_URI']);