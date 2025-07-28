<?php
// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Include secure configuration
require_once("../confing.php");

// Input validation function
function validatePaymentInput($input, $type = 'string', $max_length = 100) {
    if (empty($input)) {
        return false;
    }
    
    $input = trim($input);
    
    if (strlen($input) > $max_length) {
        return false;
    }
    
    switch ($type) {
        case 'int':
            return is_numeric($input) && $input > 0;
        case 'amount':
            return is_numeric($input) && $input >= 1000 && $input <= 1000000;
        case 'url':
            return filter_var($input, FILTER_VALIDATE_URL);
        case 'string':
        default:
            return true;
    }
}

// Validate and sanitize input parameters
$callback_url = isset($_GET['callback']) ? validatePaymentInput($_GET['callback'], 'url') : false;
$amount = isset($_GET['amount']) ? validatePaymentInput($_GET['amount'], 'amount') : false;
$group_id = isset($_GET['gpid']) ? validatePaymentInput($_GET['gpid'], 'int') : false;

// Check if all required parameters are valid
if (!$callback_url || !$amount || !$group_id) {
    http_response_code(400);
    echo 'Invalid parameters provided';
    exit;
}

// Load secure configuration
$config = include('../secure_config.php');

// Payment configuration
$MerchantID = $config['MERCHANT_ID'] ?? 'YOUR_ZARINPAL_MERCHANT_ID';
$Description = $config['PAYMENT_DESCRIPTION'] ?? 'خرید ربات مدیریت گروه';
$Email = $config['PAYMENT_EMAIL'] ?? 'your-email@domain.com';
$Mobile = $config['PAYMENT_MOBILE'] ?? '09123456789';

// Validate amount ranges
$valid_amounts = [5000, 10000, 20000, 30000];
if (!in_array($amount, $valid_amounts)) {
    http_response_code(400);
    echo 'Invalid amount specified';
    exit;
}

// Create payment session data
$payment_data = [
    'amount' => $amount,
    'group_id' => $group_id,
    'callback_url' => $callback_url,
    'timestamp' => time(),
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
];

// Store payment session securely
$session_file = "sessions/payment_" . uniqid() . ".json";
$session_dir = dirname($session_file);
if (!is_dir($session_dir)) {
    mkdir($session_dir, 0755, true);
}

if (file_put_contents($session_file, json_encode($payment_data), LOCK_EX) === false) {
    http_response_code(500);
    echo 'Failed to create payment session';
    exit;
}

// Initialize ZarinPal payment
try {
    $client = new SoapClient('https://de.zarinpal.com/pg/services/WebGate/wsdl', [
        'encoding' => 'UTF-8',
        'connection_timeout' => 30,
        'features' => SOAP_SINGLE_ELEMENT_ARRAYS
    ]);

    $result = $client->PaymentRequest([
        'MerchantID' => $MerchantID,
        'Amount' => $amount,
        'Description' => $Description,
        'Email' => $Email,
        'Mobile' => $Mobile,
        'CallbackURL' => $callback_url,
    ]);

    if ($result->Status == 100) {
        // Store authority for verification
        $authority_file = "authorities/" . $result->Authority . ".json";
        $authority_dir = dirname($authority_file);
        if (!is_dir($authority_dir)) {
            mkdir($authority_dir, 0755, true);
        }
        
        $authority_data = [
            'authority' => $result->Authority,
            'amount' => $amount,
            'group_id' => $group_id,
            'session_file' => $session_file,
            'timestamp' => time()
        ];
        
        file_put_contents($authority_file, json_encode($authority_data), LOCK_EX);
        
        // Redirect to payment gateway
        header('Location: https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
        exit;
    } else {
        // Log payment error
        error_log("ZarinPal payment error: Status " . $result->Status);
        
        http_response_code(500);
        echo 'Payment initialization failed. Error code: ' . $result->Status;
        exit;
    }
} catch (Exception $e) {
    // Log exception
    error_log("Payment exception: " . $e->getMessage());
    
    http_response_code(500);
    echo 'Payment service temporarily unavailable';
    exit;
}
?>