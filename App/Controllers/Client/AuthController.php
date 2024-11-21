<?php

namespace App\Controllers\Client;

use App\Helpers\AuthHelper;
use App\Helpers\NotificationHelper;
use App\Validation\AuthValidation;
use App\Views\Client\Pages\Auth\ForgotPassword;
use App\Views\Client\Pages\Auth\Account;
use App\Views\Client\Pages\Auth\Profile;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Layouts\Footer;
use App\Models\UserModel;
use App\Views\Client\Pages\Auth\Resetpassword;
class AuthController
{
   public static function Account()
   {
      Account::render();
   }

   // thuc hien  ForgotPassword giao dien 
   public static function ForgotPassword()
   {
      ForgotPassword::render();
   }

   // ------------- LOGOUT ----------------
   public static function Logout()
   {
      AuthHelper::logout();
      NotificationHelper::success('logout', 'Đăng xuất thành công');
      header('Location:/');
   }
   // ------------- PROFILE ----------------
   public static function profile()
   {
      Header::render();
      Profile::render();
      // Footer::render();
   }

   public static function Resetpassword()
   {
      Resetpassword::render();
   }

}