<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Contact;
use App\Views\Client\Pages\Blogs\Instruction;
use App\Views\Client\About;
use App\Views\Client\Layouts\Header;

class HomeController
{
    // hiển thị danh sách
    public static function index()
    {
        Notification::render();
        NotificationHelper::unset();
        Header::render();
        Home::render();
        Footer::render();
    }
    public static function contact()
    {
        Header::render();
        Contact::render();
        Footer::render();
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


}
