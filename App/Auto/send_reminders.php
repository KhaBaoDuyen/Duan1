<?php
// require __DIR__ . './vendor/autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$pdo = new PDO('mysql:host=localhost;dbname=webbancayvahoa', 'root', 'mysql');

$query = "SELECT reminders.*, user.email, user.username
FROM reminders
JOIN user ON reminders.id_user = user.id
 WHERE HOUR(reminder_date) = HOUR(CURTIME()) AND MINUTE(reminder_date) = MINUTE(CURTIME()) AND reminders.status = 1";

$stmt = $pdo->query($query);
$reminders = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($reminders as $reminder) {
    $mail = new PHPMailer(true);

    try {
        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'Quynhctppc08873@gmail.com';
        $mail->Password = 'benvlqjevebyolau';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Cài đặt người gửi và người nhận
        $mail->setFrom('Duyenktbpc08750@gmail.com', 'BLOOM');
        $mail->addAddress($reminder['email']);

        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];

        // Nội dung email
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $mail->Subject = 'Nhắc nhở tưới cây';

        // Template email nhúng trực tiếp trong PHP
        $emailTemplate = '
      <!DOCTYPE html>
      <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Document</title>
      </head>
      <body class="p-5">
          <div class="box_maill" style="
                  border-radius: 11px;
                  display: flex;
                  justify-content: center;
                  align-items: center;
                  margin: 0 auto;
                  width: max-content;
                  padding: 10px 15px;
                  border-radius: 15px;
                  background: #e0ecff;
                  box-shadow:  20px 20px 60px #ccd1d9,
                               -20px -20px 60px #ffffff;
                  ">
              <div>
                  <h2 class="text-center" style="color: #008a1e; text-align: center;">Hệ thống nhắc nhở tưới cây</h2>
                  <div class="message m-auto">
                      <p>Chào bạn, ' . $reminder['username'] . '</p>
                      <p>Bây giờ là:  ' . $reminder['reminder_date'] . '</p>
                      <p>Hệ thống nhắc nhở tưới cây xin thông báo rằng đã đến giờ tưới cây của bạn! 🌿🌿🌿<br>
                          Hãy dành chút thời gian chăm sóc cây trồng để chúng luôn tươi tốt và khỏe mạnh.</p>
                      <p><strong>Lời nhắc từ chúng tôi:</strong> ' . $reminder['description'] . '</p>

                      <!-- Căn giữa ảnh -->
                      <div style="text-align: center;">
                          <img src="cid:tree_image" alt="Your Image" width="50%" style="display: block; margin: 0 auto;">
                      </div>

                      <p>Nếu bạn đã tưới cây hoặc không cần nhắc nhở nữa, bạn có thể bỏ qua email này.</p>
                      <p>Cảm ơn bạn đã tin tưởng sử dụng dịch vụ của chúng tôi. Chúc bạn một ngày xanh mát và vui vẻ!</p>
                  </div>

                  <!-- Phần chân trang -->
                  <div class="footer" style="
                      color: #888;
                      font-size: 12px;
                      text-align: center;
                      margin-top: 30px;">
                      <p>Đây là email tự động, vui lòng không trả lời.</p>
                  </div>
              </div>
          </div>
      </body>
      </html>';

        $mail->addEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . 'd:/hoctap/hocki4/BLOCK2/MONDUAN/testautocron/image-removebg-preview.png', 'tree_image');
        $emailTemplate = str_replace('d:/hoctap/hocki4/BLOCK2/MONDUAN/testautocron/image-removebg-preview.png', 'cid:tree_image', $emailTemplate);

        // Nội dung email đã được thay thế
        $mail->Body = $emailTemplate;

        // Gửi email
        $mail->send();
    } catch (Exception $e) {
        echo "Error sending email: " . $mail->ErrorInfo;
    }
}
?>