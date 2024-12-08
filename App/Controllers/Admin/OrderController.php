<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Validation\AuthValidation;
use App\Validation\ProductValidation;
use App\Models\OrderModel;
use App\Models\OrdersModel;
use App\Models\ProductModel;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
// use App\Views\Admin\Pages\Product\Category as ProductCategory;
use App\Views\Admin\Pages\Order\Shop;
use App\Views\Admin\Pages\Order\Index;
use App\Views\Admin\Pages\Order\Edit;
use App\Views\Admin\Pages\Order\Search;

class OrderController
{
    public static function Index()
    {
        $order = new OrderModel();
        $data = $order->getAllByOrder();
        /* var_dump($data); */
        Header::render();
        Index::render($data);
        Footer::render();
    }

    function edit($id)
    {
        $order = new OrderModel();
        $data = $order->getOneByOrderdetail($id);
        $return = $order->getAllBy_Orderdetail_JoinId_Order($id);
        Header::render();
        Edit::render($data, $return);
        Footer::render();
    }

    function update($id)
    {
        $status = $_POST['status'];

        $data = [
            'status' => $status
        ];
        if ($data) {
            $order = new OrderModel();
            $return = $order->updateOrder_details($id, $data);
            if ($return) {
                NotificationHelper::success('update', 'Cập nhật trạng thái thành công!');
                header('Location: /admin/order');
                exit();
            } else {
                NotificationHelper::error('update', 'Cập nhật trạng thái thất bại!');
                var_dump($return);
            }
        }
    }

    function delete($id)
    {
        $order = new OrderModel();
        $return = $order->deleteOrder_detail($id);
        if ($return) {
            NotificationHelper::success('delete', 'Xóa thành công!');
            header('Location: /admin/order');
        } else {
            NotificationHelper::error('delete', 'Xóa thất bại!');
            header('Location: /admin/order');
        }
    }

    function searchOrder()
    {
        $keyword = $_GET['keyword'] ?? '';
        $order = new OrderModel();
        $ordersearch = $order->searchByKeywordOrder_detail($keyword);
        $orderall = $order->getAllByOrder();

        $data = [
            'keyword' => $keyword,
            'ordersearch' => $ordersearch,
            'orderall' => $orderall
        ];
        Header::render();
        Search::render($data);
        Footer::render();
    }
 
}
