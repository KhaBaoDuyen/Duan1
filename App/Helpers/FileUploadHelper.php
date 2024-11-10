<?php
namespace App\Helpers;


class FileUploadHelper
{
    public static function upload($file, $directory)
    {
        $targetDir = __DIR__ . "/../../public/" . $directory;
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = uniqid() . "_" . basename($file["name"]);
        $targetFilePath = $targetDir . "/" . $fileName;

        // Kiểm tra và di chuyển tệp vào thư mục đích
        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            return $directory . "/" . $fileName;
        }

        return null;
    }
}








?>