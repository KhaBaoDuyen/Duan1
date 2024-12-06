<?php

namespace App\Controllers\Admin;

use App\Helpers\AuthHelper;
use App\Views\Admin\Components\Notification;
use App\Helpers\NotificationHelper;
use App\Models\ContactModel;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Pages\Contact\index;
use App\Views\Admin\Pages\Contact\Edit;
use App\Views\Admin\Pages\Contact\Search;
use App\Views\Admin\Layouts\Footer;

class ContactController
{

    function index()
    {
        $contact = new ContactModel();
        $data = $contact->getAllContact();
        /* var_dump($data); */
        Notification::render();
        NotificationHelper::unset();
        Header::render();
        index::render($data);
        Footer::render();
    }

    function  edit($id){
        $contact = new ContactModel();
        $data = $contact->getOneContact($id);
        Header::render();
        Edit::render($data);
        Footer::render();
    }

    function update($id){
        $status = $_POST['status'];

        $data = [
            'status' => $status
        ];
        if($data){
            $contact= new ContactModel();
            $return = $contact->updateContact($id,$data);
            if($return){
                NotificationHelper::success('update','Cập nhật trạng thái thành công!');
                header('Location: /admin/contact');
                exit();
            }else{
                NotificationHelper::error('update','Cập nhật trạng thái thất bại!');
                var_dump($return);
            }
        }
    }

    function delete($id){
        $contact= new ContactModel();
        $return = $contact->deleteContact($id);
        if($return){
            NotificationHelper::success('delete','Xóa thành công!');
            header('Location: /admin/contact');
        }else{
            NotificationHelper::error('delete','Xóa thất bại!');
            header('Location: /admin/contact');
        }
    }

    public static function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $contact = new ContactModel();
        $contacts = $contact->searchByKeywordContact($keyword);
        $contactall = $contact->getAllContact();

        $data = [
            'keyword' => $keyword,
            'contacts' => $contacts,
            'contactall' => $contactall
        ];
        Header::render();
        Search::render($data);
        Footer::render();
    }
}
