<?php
namespace App\Views\Client\Components;

use App\Helpers\NotificationHelper;
use App\Views\BaseView;

class Notification extends BaseView
{
    public static function render($data = null)
    {
        // Hiển thị thông báo thành công
        if (isset($_SESSION['success'])) :
            foreach ($_SESSION['success'] as $key => $value) :
        ?>
                <h4 style="color:green;"><?= $value ?></h4>
        <?php
            endforeach;
            // Xóa thông báo thành công sau khi hiển thị
            unset($_SESSION['success']);
        endif;

        // Hiển thị thông báo lỗi
        if (isset($_SESSION['error'])) :
            foreach ($_SESSION['error'] as $key => $value) :
        ?>
                <h4 style="color:red"><?= $value ?></h4>
        <?php
            endforeach;
            // Xóa thông báo lỗi sau khi hiển thị
            unset($_SESSION['error']);
        endif;
    }
}

?>