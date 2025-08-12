<?php
// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

require_once("../confing.php");
require_once("../includes/database_helpers.php");

function vinput($value, $type) {
    if (!isset($value)) return false;
    $value = trim($value);
    switch ($type) {
        case 'int': return ctype_digit($value) && (int)$value > 0 ? (int)$value : false;
        case 'authority': return preg_match('/^[A-Za-z0-9]{36}$/', $value) ? $value : false;
        case 'status': return in_array($value, ['OK','NOK']) ? $value : false;
        default: return $value;
    }
}

$MerchantID = getSecureConfig('MERCHANT_ID', 'YOUR_ZARINPAL_MERCHANT_ID');
$Amount = 10000;
$Authority = vinput($_GET['Authority'] ?? null, 'authority');
$group = vinput($_GET['gpid'] ?? null, 'int');
$status = vinput($_GET['Status'] ?? null, 'status');

if (!$Authority || !$group || !$status) {
    http_response_code(400);
    echo file_get_contents("payment.html");
    exit;
}

if ($status === 'OK') {
    try {
        $client = new SoapClient('https://de.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
        $result = $client->PaymentVerification([
            'MerchantID' => $MerchantID,
            'Authority' => $Authority,
            'Amount' => $Amount,
        ]);

        if ($result->Status == 100) {
            date_default_timezone_set('Asia/Tehran');

            // Determine starting point for expiry extension
            $currentExpire = getGroupSetting($group, 'expire');
            $baseTime = $currentExpire && strtotime($currentExpire) > time()
                ? strtotime($currentExpire)
                : time();
            $next_date = date('Y-m-d', strtotime('+60 days', $baseTime));
            setGroupSetting($group, 'expire', $next_date);

            echo file_get_contents("payComplete30.html");
        } else {
            echo file_get_contents("paysend.html");
        }
    } catch (Exception $e) {
        error_log('ZarinPal verify error: ' . $e->getMessage());
        echo file_get_contents("paysend.html");
    }
} else {
    echo file_get_contents("payment.html");
}
?>
