<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;
use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;

class Account extends BaseView
{
    public static function render($data = null)
    {
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];

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
                <?php if (isset($_SESSION['js_error'])): ?>
                    <div class="alert-custom">
                        <?php echo $_SESSION['js_error']; ?>
                    </div>
                    <?php unset($_SESSION['js_error']); ?>
                <?php endif; ?>

                <?php
                Notification::render();
                NotificationHelper::unset();
                ?>
                <div class="container" id="container">
                    <div class="form-container sign-up">
                        <form action="/home-register" method="post">
                            <input type="hidden" name="method" value="POST" id="">
                            <h1>Tạo tài khoản</h1>
                            <div class="w-100">
                                <input name="username" type="text" placeholder="Tên"
                                    class="<?= isset($errors['username']) ? 'input-error' : '' ?>"
                                    value="<?= $_POST['username'] ?? '' ?>">
                                <?php if (isset($errors['username'])): ?>
                                    <span style="color:red;"><?= $errors['username'] ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="w-100">
                                <input name="email" type="text" placeholder="Email"
                                    class="<?= isset($errors['email']) ? 'input-error' : '' ?>"
                                    value="<?= $_POST['email'] ?? '' ?>">
                                <?php if (isset($errors['email'])): ?>
                                    <span style="color:red;"><?= $errors['email'] ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="w-100">
                                <input name="password" type="password" placeholder="Password"
                                    class="<?= isset($errors['password']) ? 'input-error' : '' ?>">
                                <?php if (isset($errors['password'])): ?>
                                    <span style="color:red;"><?= $errors['password'] ?></span>
                                <?php endif; ?>
                            </div>


                            <a href="/">Quay về trang chủ</a>
                            <button type="submit" id="home-register" class="button">Đăng ký</button>
                        </form>
                    </div>
                    <div class="form-container sign-in">
                        <form action="/home-login" method="post">
                            <input type="hidden" name="method" value="POST" id="">
                            <h1>Đăng nhập</h1>
                            <div class="w-100">
                                <input name="username" type="text" placeholder="Tên"
                                    class="<?= isset($errors['usernamelogin']) ? 'input-error' : '' ?>"
                                    value="<?= $_POST['username'] ?? '' ?>">
                                <?php if (isset($errors['usernamelogin'])): ?>
                                    <span style="color:red;"><?= $errors['usernamelogin'] ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="w-100">
                                <input name="password" type="password" placeholder="Password"
                                    class="<?= isset($errors['passwordlogin']) ? 'input-error' : '' ?>">
                                <?php if (isset($errors['passwordlogin'])): ?>
                                    <span style="color:red;"><?= $errors['passwordlogin'] ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="checkbox">
                                <div class="input-checkbox">
                                    <input name="remember" type="checkbox" name id>
                                    <label>Ghi nhớ mật khẩu</label>
                                </div>
                                <a href="/ForgotPassword">Bạn
                                    quên mật khẩu?</a>
                            </div>
                            <a href="/">Quay về trang chủ</a>
                            <button type="submit" class="button">Đăng nhập</button>

                        </form>
                    </div>
                    <div class="toggle-container">
                        <div class="toggle">
                            <div class="toggle-panel toggle-left">
                                <button class="hidden" id="login">Đăng nhập</button>
                            </div>
                            <div class="toggle-panel toggle-right">
                                <button class="hidden" id="register">Đăng ký</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="/public/assets/Client/Js/login.js"></script>
        </body>
        </html>
        <?php
        unset($_SESSION['errors']);
    }
}
?>