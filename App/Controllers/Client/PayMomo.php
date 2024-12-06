<?php
namespace App\Controllers\Client;

class PayMomo
{
    private $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    private $partnerCode = 'MOMOBKUN20180529';
    private $accessKey = 'klm05TvNBzhg7h7j';
    private $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function createPayment()
    {
        // Gán giá trị mặc định cho các tham số
        $amount = "10000";  // Số tiền thanh toán
        $orderInfo = "Thanh toán qua MoMo";  // Thông tin đơn hàng
        $redirectUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";  // URL chuyển hướng sau khi thanh toán thành công
        $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";  // URL callback khi có thông tin IPN
        $extraData = "";  // Dữ liệu bổ sung

        $orderId = time() . "";  // Mã đơn hàng duy nhất
        $requestId = time() . "";  // Mã yêu cầu duy nhất
        $requestType = "captureWallet";  // Loại yêu cầu thanh toán (captureWallet)

        // Tạo dữ liệu để gửi đến MoMo API
        $data = array(
            'partnerCode' => $this->partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
        );

        // Tạo chữ ký HMAC SHA256
        $rawHash = "accessKey=" . $this->accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $this->partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $this->secretKey);
        $data['signature'] = $signature;

        $result = $this->execPostRequest($this->endpoint, json_encode($data));
        $jsonResult = json_decode($result, true); // decode json

        // Debug thông tin trả về từ MoMo
        var_dump($jsonResult); // Xem chi tiết kết quả trả về từ MoMo

        // Kiểm tra kết quả trả về và chuyển hướng
        if (isset($jsonResult['payUrl'])) {
            header('Location: ' . $jsonResult['payUrl']);
            exit;
        } else {
            echo "Không thể tạo liên kết thanh toán. Vui lòng kiểm tra lại.";
            exit;
        }
    }
}
?>



