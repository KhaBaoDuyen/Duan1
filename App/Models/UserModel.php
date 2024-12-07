<?php

namespace App\Models;

use App\Helpers\NotificationHelper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


/* require 'PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/PHPMailer-master/src/SMTP.php'; */

//Load Composer's autoloader
require 'vendor/autoload.php';

class UserModel extends BaseModel
{
    protected $table = 'user';
    protected $id = 'id';

    public function getAllUser()
    {
        return $this->getAll();
    }

    public function getOneUser($id)
    {
        return $this->getOne($id);
    }

    public function createUser($data)
    {
        return $this->create($data);
    }

    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }

    public function getAllUserByStatus()
    {
        return $this->getAllByStatus();
    }

    public function login($username)
    {
        $sql = "SELECT * FROM $this->table WHERE username=? LIMIT 1";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param('s', $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getOneUserByUsername($username)
    {
        $sql = "SELECT * FROM $this->table WHERE username=? LIMIT 1";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param('s', $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function getOneUserByEmail($email)
    {
        $sql = "SELECT * FROM $this->table WHERE email=? LIMIT 1";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param('s', $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateUserByUsernameAndEmail(array $data)
    {
        try {
            $username = $data['username'];
            $email = $data['email'];
            $password = $data['password'];

            $sql = "UPDATE $this->table SET password='$password' WHERE username='$username' AND email='$email'";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi cập nhật dữ liệu: ', $th->getMessage());
            NotificationHelper::error('updateUserByUsernameAndEmail', 'Lỗi khi thực hiện cập nhật dữ liệu');
            return false;
        }
    }

    public function getOneUserByName($name)
    {
        return $this->getOneByName($name);
    }

    public function countTotalUser()
    {
        return $this->countTotal();
    }


    //---------------SEARCH------------------------------
    public function searchByKeywordUser($keyword)
    {
        $db = (new Database())->Pdo();
        $stmt = $db->prepare("
         SELECT * 
    FROM $this->table 
    WHERE name LIKE :keyword  OR username LIKE :keyword 
    ");

        $stmt->execute(['keyword' => '%' . $keyword . '%']);

        // Trả về kết quả
        return $stmt->fetchAll();
    }


    /* public function countTotalCategogy()
    {
        return $this->countTotal();
    }
    public function countTotalUser()
    {
        return $this->countTotal();
    } */



    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM $this->table WHERE email=? LIMIT 1";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param('s', $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }


    public function generateOTP($email)
    {
        $email = $_POST['email'];
        // Tạo mã OTP ngẫu nhiên 6 chữ số
        $otp = rand(100000, 999999);

        // Thiết lập thời gian hết hạn (hiện tại + 30 phút)
        $expiryTime = date("Y-m-d H:i:s", strtotime('+30 minutes'));

        $sql = "UPDATE $this->table SET otp = ?, otp_expiry=? WHERE email = ?";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            error_log('SQL prepare error: ' . $conn->error);
            return false;
        }

        $stmt->bind_param('iss', $otp, $expiryTime, $email);

        if ($stmt->execute()) {
            return [
                'otp' => $otp,
                'expiry_time' => $expiryTime
            ];
        } else {
            error_log('Error executing SQL: ' . $stmt->error);  // Log lỗi thực thi câu lệnh
            return false;
        }
    }


    public static function sendmail(array $data)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $email = $data['email'];
        $otp = $data['otp'];

        try {
            //Server settings
            /*  $mail->SMTPDebug = SMTP::DEBUG_SERVER;     */                  //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'Quynhctppc08873@gmail.com';                     //gmail của người gửi
            $mail->Password   = 'benvlqjevebyolau';                               //mật khẩu smtp

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('Quynhctppc08873@gmail.com', 'BLOOM');
            $mail->addAddress($email, 'Quynh');     //người nhận

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'MA XAC NHAN';
            $mail->Body    = 'Mã OTP của bạn là: <b> ' . $otp . ' </b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
            echo 'Message has been sent';
            return true; // Trả về true nếu gửi thành công
            /* header('Location: /Resetpassword'); */
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false; // Trả về false nếu có lỗi
        }
    }

    public function updatebyOtp(array $data)
    {
        try {
            $otp = $data['otp'];
            $password = $data['password'];  // Lấy mật khẩu từ mảng $data đã mã hóa trước

            $sql = "UPDATE $this->table SET password=? WHERE otp=?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $password, $otp);  // Truyền mật khẩu và OTP vào câu truy vấn
            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi cập nhật dữ liệu: ' . $th->getMessage());
            NotificationHelper::error('updateUserByUsernameAndEmail', 'Lỗi khi thực hiện cập nhật dữ liệu');
            return false;
        }
    }

    public function getOneUserByOtp($otp)
    {
        $sql = "SELECT * FROM $this->table WHERE otp=? LIMIT 1";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param('i', $otp);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }


    public static function sendmailContact()
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $name = $_POST['name'];
        $ho = $_POST['ho'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        try {
            //Server settings
            /*  $mail->SMTPDebug = SMTP::DEBUG_SERVER;     */                  //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'Quynhctppc08873@gmail.com';                     //gmail của người gửi
            $mail->Password   = 'benvlqjevebyolau';                               //mật khẩu smtp

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('Quynhctppc08873@gmail.com', 'BLOOM');
            $mail->addAddress($email, 'Quynh');     //người nhận

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'BLOOM XIN KÍNH CHÀO QUÝ KHÁCH!';
            $mail->Body    = '
            <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #3cb371;
            color: #ffffff;
            text-align: center;
            padding: 20px 10px;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            color: #333333;
            line-height: 1.6;
        }
        .email-body h2 {
            color: #3cb371;
            margin-top: 0;
        }
        .email-body p {
            margin: 10px 0;
        }
        .email-body .info-box {
            background-color: #f9f9f9;
            border-left: 4px solid #3cb371;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .email-footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #666666;
        }
        .button {
            display: inline-block;
            background-color: #3cb371;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
            font-size: 16px;
        }
        .image-container {
            text-align: center;
            margin: 20px 0;
        }
        .image-container img {
            max-width: 80%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>Chúng tôi ở đây để giúp bạn!</h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <h2>Xin chào ' . $ho . ' ' . $name . ',</h2>
            <p>Cảm ơn bạn đã liên hệ với đội ngũ hỗ trợ của BLOOM. Chúng tôi đã nhận được yêu cầu :' . $message . '
             của bạn hãy trả lời đến mail này để được hỗ trợ nhé!.</p>

            <div class="image-container">
                <img src="https://example.com/your-support-image.png" alt="Hình minh họa hỗ trợ khách hàng">
            </div>

            <p>Nếu cần hỗ trợ khẩn cấp, bạn có thể liên hệ với chúng tôi qua số hotline <strong>1900 1234</strong> hoặc email <strong>support@bloom.com</strong>.</p>
            <a href="https://yourwebsite.com/contact" class="button">Liên hệ ngay</a>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>Cảm ơn bạn đã tin tưởng BLOOM 🌿</p>
            <p>Đội ngũ hỗ trợ khách hàng của chúng tôi luôn sẵn sàng giúp bạn!</p>
        </div>
    </div>
</body>
</html>

            ';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
            echo 'Message has been sent';
            return true; // Trả về true nếu gửi thành công
            /* header('Location: /Resetpassword'); */
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false; // Trả về false nếu có lỗi
        }
    }
}
