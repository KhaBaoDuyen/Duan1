<?php

namespace App\Controllers\Client;

use App\Models\ReminderModel;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Pages\Reminder\index;
use App\Helpers\NotificationHelper;

class ReminderController
{
   public static function index()
   {
      $userId = $_SESSION['user']['id'];
      $reminder = new ReminderModel();
      $data = $reminder->getAllReminder($userId);
      // var_dump($data);
      // die;
      Header::render();
      index::render($data);
      Footer::render();
   }
   public static function store()
   {
      if (!isset($_SESSION['user']['id'])) {
         // Người dùng chưa đăng nhập
         $_SESSION['notification'] = ['type' => 'error', 'message' => 'Vui lòng đăng nhập để sử dụng dịch vụ'];
         header("Location: {$_SERVER['HTTP_REFERER']}");
         exit();
      }

      // Lấy user_id từ session
      $id_user = $_SESSION['user']['id'];
      // echo "<pre>";
      // var_dump($_POST); 
      // var_dump($user_id); 
      // die;
      //     echo "<pre>";
      //     var_dump($_POST); /
      //     var_dump($user_id); 
      //     die;
      $reminder = new ReminderModel();
      $data = [
         'title' => $_POST['title'],
         'description' => $_POST['description'],
         'reminder_date' => $_POST['reminder_date'],
         'id_user' => $id_user,
      ];

      $result = $reminder->create($data);

      if ($result) {
         $_SESSION['notification'] = ['type' => 'success', 'message' => 'Thêm thành công'];
      } else {
         $_SESSION['notification'] = ['type' => 'error', 'message' => 'Thêm thất bại'];
      }

      header("Location: {$_SERVER['HTTP_REFERER']}");
      exit();
   }

public static function update(int $id)
{
    $is_valid = true;
    $errors = [];

    if (!isset($_POST['reminder_date']) || $_POST['reminder_date'] === '') {
        $errors['reminder_date'] = 'Không được để trống';
        $is_valid = false;
    }
    if (!$is_valid) {
        $_SESSION['errors'] = $errors;
        header("location: /reminders");
        exit; 
    }

    $id_user = $_SESSION['user']['id'];
    $reminder = new ReminderModel();

    $data = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'reminder_date' => $_POST['reminder_date'],
        'id_user' => $id_user,
        'status' => $_POST['status'],
    ];
    $result = $reminder->updateReminder($id, $data);
    if ($result) {
        NotificationHelper::success('update', 'Cập nhật thành công');
    } else {
        NotificationHelper::error('update', 'Cập nhật thất bại');
    }
    header('location: /reminders');
    exit; 
}

public static function delete(int $id){
    $reminder = new ReminderModel();
    $result = $reminder->delete($id);
    if($result){
        NotificationHelper::success('delete', 'Xóa thành công');
    } else {
        NotificationHelper::error('delete', 'Xóa thất bại');
    }
    header('location: /reminders');}
}
