<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;
use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;

class Resetpassword extends BaseView
{
    public static function render($data = null)
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <img src="" alt="">
            <title>BLOOM</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="/public/assets/Client/scss/Client/index.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
            <link rel="icon" type="image/png" href="/public/assets/Client/image/icon/Logo2.png">
        </head>

        <body>
            <div class="Page-login">
            <?php 
                 Notification::render();
                 NotificationHelper::unset();
                ?>
                <div class="container">

                    <div class="form-container sign-in">
                        <?php
                        Notification::render();
                        NotificationHelper::unset();
                        ?>
                        <form action="/reset-password" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="method" value="PUT" id="">
                            <h1>Mật khẩu mới</h1>
                            <input name="otp" type="text" placeholder="Nhập mã otp">
                            <input name="password" type="password" placeholder="Mật khẩu mới">

                            <div class="checkbox">
                                <!-- <div class="input-checkbox">
                            <input type="checkbox" name id>
                            <label>Ghi nhớ mật khẩu</label>
                        </div> -->
                                <a href="/Account">Quay về</a>
                            </div>
                            <button type="submit" class="button">Lưu</button>
                        </form>
                    </div>
                    <div class="toggle-container">
                        <div class="toggle">
                        </div>
                    </div>
                </div>
            </div>

    <?php
    }
}
    ?>