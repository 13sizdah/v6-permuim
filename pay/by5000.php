<?php
// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Include secure configuration
require_once("../confing.php");

// Input validation function
function validatePaymentCallback($input, $type = 'string', $max_length = 100) {
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
        case 'authority':
            return preg_match('/^[A-Za-z0-9]{36}$/', $input);
        case 'status':
            return in_array($input, ['OK', 'NOK']);
        case 'string':
        default:
            return true;
    }
}

// Validate callback parameters
$authority = isset($_GET['Authority']) ? validatePaymentCallback($_GET['Authority'], 'authority') : false;
$status = isset($_GET['Status']) ? validatePaymentCallback($_GET['Status'], 'status') : false;
$group = isset($_GET['gpid']) ? validatePaymentCallback($_GET['gpid'], 'int') : false;
$amount = isset($_GET['amount']) ? validatePaymentCallback($_GET['amount'], 'int') : false;

// Check if all required parameters are valid
if (!$authority || !$status || !$group || !$amount) {
    http_response_code(400);
    echo 'Invalid callback parameters';
    exit;
}

// Load authority data
$authority_file = "authorities/" . $authority . ".json";
if (!file_exists($authority_file)) {
    http_response_code(400);
    echo 'Invalid payment authority';
    exit;
}

$authority_data = json_decode(file_get_contents($authority_file), true);
if (!$authority_data || $authority_data['group_id'] != $group || $authority_data['amount'] != $amount) {
    http_response_code(400);
    echo 'Payment data mismatch';
    exit;
}

// Check if payment is already processed
if (isset($authority_data['processed']) && $authority_data['processed']) {
    echo file_get_contents("payComplete30.html");
    exit;
}

// Load secure configuration
$config = include('../secure_config.php');

if ($status === 'OK') {
    // Verify payment with ZarinPal
    try {
        $client = new SoapClient('https://de.zarinpal.com/pg/services/WebGate/wsdl', [
            'encoding' => 'UTF-8',
            'connection_timeout' => 30,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS
        ]);

        $result = $client->PaymentVerification([
            'MerchantID' => $config['MERCHANT_ID'] ?? 'YOUR_ZARINPAL_MERCHANT_ID',
            'Authority' => $authority,
            'Amount' => $amount
        ]);

        if ($result->Status == 100) {
            // Payment verified successfully
            $ref_id = $result->RefID;
            
            // Load group settings
            $group_file = "../data/$group.json";
            if (file_exists($group_file)) {
                $gpFile = json_decode(file_get_contents($group_file), true);
                if ($gpFile) {
                    $settings = json_decode(file_get_contents($group_file), true);
                    
                    // Calculate subscription duration based on amount
                    $duration_map = [
                        5000 => 30,   // 30 days
                        10000 => 60,  // 60 days
                        20000 => 90,  // 90 days
                        30000 => 180  // 180 days
                    ];
                    
                    $days = $duration_map[$amount] ?? 30;
                    $expire_date = date('Y-m-d H:i:s', strtotime("+$days days"));
                    
                    // Update group settings
                    $settings['information']['charge'] = date('Y-m-d H:i:s');
                    $settings['information']['expire'] = $expire_date;
                    $settings['information']['added'] = true;
                    $settings['information']['dataadded'] = date('Y-m-d H:i:s');
                    
                    // Save updated settings
                    if (file_put_contents($group_file, json_encode($settings, JSON_PRETTY_PRINT), LOCK_EX) !== false) {
                        // Mark payment as processed
                        $authority_data['processed'] = true;
                        $authority_data['ref_id'] = $ref_id;
                        $authority_data['processed_at'] = date('Y-m-d H:i:s');
                        file_put_contents($authority_file, json_encode($authority_data, JSON_PRETTY_PRINT), LOCK_EX);
                        
                        // Log successful payment
                        error_log("Payment successful: Authority=$authority, RefID=$ref_id, Group=$group, Amount=$amount");
                        
                        echo file_get_contents("payComplete30.html");
                    } else {
                        error_log("Failed to save group settings: Group=$group");
                        echo file_get_contents("paysend.html");
                    }
                } else {
                    error_log("Invalid group file format: Group=$group");
                    echo file_get_contents("paysend.html");
                }
            } else {
                error_log("Group file not found: Group=$group");
                echo file_get_contents("paysend.html");
            }
        } else {
            // Payment verification failed
            error_log("Payment verification failed: Authority=$authority, Status=" . $result->Status);
            echo file_get_contents("payment.html");
        }
    } catch (Exception $e) {
        error_log("Payment verification exception: " . $e->getMessage());
        echo file_get_contents("payment.html");
    }
} else {
    // Payment was cancelled or failed
    error_log("Payment cancelled/failed: Authority=$authority, Status=$status");
    echo file_get_contents("payment.html");
}
?>
