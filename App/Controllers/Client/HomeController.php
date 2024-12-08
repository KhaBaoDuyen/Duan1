<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Models\ContactModel;
use App\Views\Client\Components\Notification;
use App\Views\Client\Components\Search;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\UserModel;
use App\Validation\ContactValidation;
use App\Views\Client\Contact;
use App\Views\Client\Pages\Blogs\Instruction;
use App\Views\Client\About;
use App\Views\Client\Layouts\Header;
use App\Models\OrderModel;
class HomeController
{
    // hiển thị danh sách
    public static function index()
    {
        $product = new ProductModel();
        $data['products'] = $product->getAllByProductStatus();

        $user = new UserModel();
        $data['user'] = $user->getAllUser();

        $categogy = new CategoryModel();
        $data['categogy'] = $categogy->getAllCategoryByStatus();

     

        Notification::render();
        NotificationHelper::unset();
        Header::render();
        Home::render($data);
        Footer::render();
    }
    public static function contact()
    {
        Notification::render();
        NotificationHelper::unset();
        Header::render();
        Contact::render();
        Footer::render();
    }
    public static function sendmailContact()
    {
        $is_value = ContactValidation::contact();
        if (!$is_value) {
            NotificationHelper::error('contact_valid', 'Vui lòng nhập đầy đủ thông tin!');
            header('location: /contact');
            exit();
        }
        $name = $_POST['ho'] . ' ' . $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $data = [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'message' => $message,
        ];
        $contact = new ContactModel();
        $resunl = $contact->createContact($data);
        if ($resunl) {
            $mail = new UserModel();
            $sendmail = $mail->sendmailContact();
            NotificationHelper::success('sendmail_fail', 'Gửi email thành công !');
            header('location: /contact');
            exit();
        } else {
            NotificationHelper::error('sendmail_fail', 'Gửi email thất bại!');
            /* header('location: /contact'); */
            var_dump($data);
        }
    }
    public static function instruction()
    {
        Header::render();
        Instruction::render();
        Footer::render();
    }
    public static function about()
    {
        Header::render();
        About::render();
        Footer::render();
    }
    public static function Search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $products = ProductModel::searchByKeywordProduct($keyword);
        Header::render();
        Search::render(['keyword' => $keyword, 'products' => $products]);
        Footer::render();
    }
}
