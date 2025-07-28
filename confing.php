<?php
// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('Strict-Transport-Security: max-age=31536000; includeSubDomains');

// Error handling
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'logs/error.log');

// Security settings
ini_set('expose_php', 'Off');
ini_set('allow_url_fopen', 'Off');
ini_set('max_execution_time', 30);
ini_set('max_input_time', 30);
ini_set('memory_limit', '128M');
ini_set('file_uploads', 'Off');
ini_set('post_max_size', '1M');

// Disable dangerous functions
ini_set('disable_functions', 'exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source,eval,file,file_get_contents,file_put_contents,fclose,fopen,fwrite,mkdir,rmdir,unlink,glob,echo,die,exit,print,scandir');

// Timezone
date_default_timezone_set('Asia/Tehran');
ignore_user_abort(true);

// Load configuration from environment or secure file
function getSecureConfig($key, $default = null) {
    // Try environment variable first
    $env_value = getenv('BOT_' . strtoupper($key));
    if ($env_value !== false) {
        return $env_value;
    }
    
    // Try secure config file
    $config_file = __DIR__ . '/secure_config.php';
    if (file_exists($config_file)) {
        $config = include $config_file;
        return isset($config[$key]) ? $config[$key] : $default;
    }
    
    return $default;
}

// Secure configuration
define('API_KEY', getSecureConfig('API_KEY', 'TOKEN')); // توکن خود را اینجا وارد کنید
define('MERCHANT_ID', getSecureConfig('MERCHANT_ID', 'مریچنت'));
define('PAYMENT_EMAIL', getSecureConfig('PAYMENT_EMAIL', 'ایمیل'));
define('PAYMENT_MOBILE', getSecureConfig('PAYMENT_MOBILE', 'شماره تماس'));

// Input validation function
function validateInput($input, $type = 'string', $max_length = 1000) {
    if (empty($input)) {
        return false;
    }
    
    $input = trim($input);
    
    if (strlen($input) > $max_length) {
        return false;
    }
    
    switch ($type) {
        case 'int':
            return is_numeric($input) && $input >= 0;
        case 'chat_id':
            return preg_match('/^-?\d+$/', $input);
        case 'user_id':
            return preg_match('/^\d+$/', $input);
        case 'username':
            return preg_match('/^[a-zA-Z0-9_]{5,32}$/', $input);
        case 'string':
        default:
            return true;
    }
}

// Secure file operations
function secureFileGetContents($filename) {
    if (!file_exists($filename)) {
        return false;
    }
    
    $content = file_get_contents($filename);
    if ($content === false) {
        return false;
    }
    
    return $content;
}

function secureFilePutContents($filename, $data) {
    $dir = dirname($filename);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    
    return file_put_contents($filename, $data, LOCK_EX);
}

// Secure JSON operations
function secureJsonDecode($json_string) {
    if (empty($json_string)) {
        return null;
    }
    
    $data = json_decode($json_string, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('JSON decode error: ' . json_last_error_msg());
        return null;
    }
    
    return $data;
}

//-----------------------------------------------------------------------------------------
//فانکشن botevoobot :
function botevoobot($method, $data) {
    if (empty($method) || empty($data)) {
        return false;
    }
    
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    
    $result = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($result === false || $http_code !== 200) {
        error_log("Telegram API error: HTTP $http_code");
        return false;
    }
    
    return $result;
}

//-----------------------------------------------------------------------------------------
//متغیر ها :
$Dev = array("00000000","0000000000","0000000000"); // آیدی مدیر
@$usernamebot = "Testbot"; // آیدی بوت
@$idbot = "00000000"; // آیدی عددی توکن بوت
@$channel = "13sizdah"; // آدرس کانال
@$idchannel ="-100100000095"; // آیدی چنل
@$nemechannel = "Danial";  // Name Channel
@$web = "https://domain.ir/folder/"; // آدرس مسیر اصلی ربات
@$linkgrop = "https://t.me/USER"; // گروه پشتیبانی
@$botnamef="تست";//نام ربات
@$token = API_KEY;

//----------------------------------------------------------------------------------------------
// Secure data loading
@$adsbot6 = secureFileGetContents('data/tablighat.txt') ?: '';
@$startbot6 = secureFileGetContents('data/start.txt') ?: '';
@$freedays = secureFileGetContents('data/fredays.txt') ?: '';

//-----------------------------------------------------------------------------------------------
// Secure input processing
$raw_input = file_get_contents('php://input');
if (empty($raw_input)) {
    exit('No input received');
}

$update = secureJsonDecode($raw_input);
if ($update === null) {
    exit('Invalid JSON input');
}

// Validate and sanitize input
@$message = $update->message ?? null;
@$from_id = isset($message->from->id) ? validateInput($message->from->id, 'user_id') : null;
@$chat_id = isset($message->chat->id) ? validateInput($message->chat->id, 'chat_id') : null;
@$message_id = isset($message->message_id) ? validateInput($message->message_id, 'int') : null;
@$first_name = isset($message->from->first_name) ? validateInput($message->from->first_name, 'string', 100) : null;
@$last_name = isset($message->from->last_name) ? validateInput($message->from->last_name, 'string', 100) : null;
@$username = isset($message->from->username) ? validateInput($message->from->username, 'username') : null;
@$textmassage = isset($message->text) ? validateInput($message->text, 'string', 4096) : null;

// Callback query validation
@$firstname = isset($update->callback_query->from->first_name) ? validateInput($update->callback_query->from->first_name, 'string', 100) : null;
@$usernames = isset($update->callback_query->from->username) ? validateInput($update->callback_query->from->username, 'username') : null;
@$chatid = isset($update->callback_query->message->chat->id) ? validateInput($update->callback_query->message->chat->id, 'chat_id') : null;
@$fromid = isset($update->callback_query->from->id) ? validateInput($update->callback_query->from->id, 'user_id') : null;
@$membercall = isset($update->callback_query->id) ? validateInput($update->callback_query->id, 'string') : null;
@$reply = isset($update->message->reply_to_message->forward_from->id) ? validateInput($update->message->reply_to_message->forward_from->id, 'user_id') : null;

//------------------------------------------------------------------------
@$data = isset($update->callback_query->data) ? validateInput($update->callback_query->data, 'string', 64) : null;
@$messageid = isset($update->callback_query->message->message_id) ? validateInput($update->callback_query->message->message_id, 'int') : null;
@$tc = isset($update->message->chat->type) ? validateInput($update->message->chat->type, 'string', 20) : null;
@$gpname = isset($update->callback_query->message->chat->title) ? validateInput($update->callback_query->message->chat->title, 'string', 255) : null;
@$namegroup = isset($update->message->chat->title) ? validateInput($update->message->chat->title, 'string', 255) : null;
@$text = isset($update->inline_qurey->qurey) ? validateInput($update->inline_qurey->qurey, 'string', 64) : null;

//------------------------------------------------------------------------
@$newchatmemberid = isset($update->message->new_chat_member->id) ? validateInput($update->message->new_chat_member->id, 'user_id') : null;
@$newchatmemberu = isset($update->message->new_chat_member->username) ? validateInput($update->message->new_chat_member->username, 'username') : null;
@$rt = $update->message->reply_to_message ?? null;
@$replyid = isset($update->message->reply_to_message->message_id) ? validateInput($update->message->reply_to_message->message_id, 'int') : null;
@$tedadmsg = isset($update->message->message_id) ? validateInput($update->message->message_id, 'int') : null;
@$edit = isset($update->edited_message->text) ? validateInput($update->edited_message->text, 'string', 4096) : null;
@$re_id = isset($update->message->reply_to_message->from->id) ? validateInput($update->message->reply_to_message->from->id, 'user_id') : null;
@$re_user = isset($update->message->reply_to_message->from->username) ? validateInput($update->message->reply_to_message->from->username, 'username') : null;
@$re_name = isset($update->message->reply_to_message->from->first_name) ? validateInput($update->message->reply_to_message->from->first_name, 'string', 100) : null;
@$re_msgid = isset($update->message->reply_to_message->message_id) ? validateInput($update->message->reply_to_message->message_id, 'int') : null;
@$re_chatid = isset($update->message->reply_to_message->chat->id) ? validateInput($update->message->reply_to_message->chat->id, 'chat_id') : null;
@$message_edit_id = isset($update->edited_message->message_id) ? validateInput($update->edited_message->message_id, 'int') : null;
@$chat_edit_id = isset($update->edited_message->chat->id) ? validateInput($update->edited_message->chat->id, 'chat_id') : null;
@$edit_for_id = isset($update->edited_message->from->id) ? validateInput($update->edited_message->from->id, 'user_id') : null;
@$edit_chatid = isset($update->callback_query->edited_message->chat->id) ? validateInput($update->callback_query->edited_message->chat->id, 'chat_id') : null;
@$caption = isset($update->message->caption) ? validateInput($update->message->caption, 'string', 1024) : null;

//------------------------------------------------------------------------
// Secure API calls with validation
function getChatMemberStatus($chat_id, $user_id) {
    if (!validateInput($chat_id, 'chat_id') || !validateInput($user_id, 'user_id')) {
        return null;
    }
    
    $url = "https://api.telegram.org/bot" . API_KEY . "/getChatMember?chat_id=$chat_id&user_id=$user_id";
    $response = file_get_contents($url);
    
    if ($response === false) {
        return null;
    }
    
    $data = secureJsonDecode($response);
    return $data['result']['status'] ?? null;
}

@$status = getChatMemberStatus($chat_id, $from_id);
@$statusrt = getChatMemberStatus($chat_id, $re_id);
@$statusq = getChatMemberStatus($chatid, $fromid);
@$you = getChatMemberStatus($chat_edit_id, $edit_for_id);

// Channel membership check
function getChannelMemberStatus($channel, $user_id) {
    if (!validateInput($user_id, 'user_id')) {
        return null;
    }
    
    $url = "https://api.telegram.org/bot" . API_KEY . "/getChatMember?chat_id=@" . $channel . "&user_id=$user_id";
    $response = file_get_contents($url);
    
    if ($response === false) {
        return null;
    }
    
    $data = secureJsonDecode($response);
    return $data->result->status ?? null;
}

@$tch = getChannelMemberStatus($channel, $from_id);
@$tchq = getChannelMemberStatus($channel, $fromid);

//-----------------------------------------------------------------------------------------
// Secure settings loading
@$settings = secureJsonDecode(secureFileGetContents("data/$chat_id.json")) ?: array();
@$settings2 = secureJsonDecode(secureFileGetContents("data/$chatid.json")) ?: array();
@$editgetsettings = secureJsonDecode(secureFileGetContents("data/$chat_edit_id.json")) ?: array();
@$user = secureJsonDecode(secureFileGetContents("data/user.json")) ?: array();
@$filterget = $settings["filterlist"] ?? array();

//=========================================================================
//فانکشن ها :
function SendMessage($chat_id, $text) {
    if (!validateInput($chat_id, 'chat_id') || !validateInput($text, 'string', 4096)) {
        return false;
    }
    
    return botevoobot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'MarkDown'
    ]);
}

function Forward($berekoja, $azchejaei, $kodompayam) {
    if (!validateInput($berekoja, 'chat_id') || !validateInput($azchejaei, 'chat_id') || !validateInput($kodompayam, 'int')) {
        return false;
    }
    
    return botevoobot('ForwardMessage', [
        'chat_id' => $berekoja,
        'from_chat_id' => $azchejaei,
        'message_id' => $kodompayam
    ]);
}

function getUserProfilePhotos($token, $from_id) {
    if (!validateInput($from_id, 'user_id')) {
        return null;
    }
    
    $url = 'https://api.telegram.org/bot' . $token . '/getUserProfilePhotos?user_id=' . $from_id;
    $result = file_get_contents($url);
    
    if ($result === false) {
        return null;
    }
    
    $data = secureJsonDecode($result);
    return $data->result ?? null;
}

function check_filter($str) {
    global $filterget;
    
    if (!is_array($filterget) || empty($str)) {
        return false;
    }
    
    foreach ($filterget as $d) {
        if (mb_strpos($str, $d) !== false) {
            return true;
        }
    }
    
    return false;
}

function vmsTehranDate() {
    $tehran = new DateTimeZone("Asia/Tehran");
    $london = new DateTimeZone("Europe/London");
    $dateDiff = new DateTime("now", $london);
    $timeOffset = $tehran->getOffset($dateDiff);
    $newtime = time() + $timeOffset;
    return Date("H:i:s", $newtime);
}

//=========================================================================
// dokmezer
@$inlinebutton = json_encode([
    'inline_keyboard' => [
        [
            ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"]
        ],
    ]
]);

// Secure cryptocurrency data fetching
function getCryptoData($crypto) {
    $url = "https://www.tgju.org/profile/crypto-$crypto";
    $data = file_get_contents($url);
    
    if ($data === false) {
        return 'N/A';
    }
    
    preg_match_all('#<td class="text-left">(.*?)</td>#', $data, $matches);
    return $matches[1][0] ?? 'N/A';
}

$bitcoin = getCryptoData('bitcoin');
$ethereum = getCryptoData('ethereum');
$litecoin = getCryptoData('litecoin');
$tron = getCryptoData('tron');
$tether = getCryptoData('tether');
$dogecoin = getCryptoData('dogecoin');

@$arzdigitalk = json_encode([
    'inline_keyboard' => [
        [
            ['text' => "$bitcoin", 'callback_data' => "dhcnjsdbcjhsd"], ['text' => "قیمت بیت کوین:", 'callback_data' => "jnjknbjhb"]
        ],
        [
            ['text' => "$ethereum", 'callback_data' => "dhcnjsdbcjhsd"], ['text' => "قیمت اتریوم", 'callback_data' => "jnjknbjhb"]
        ],
        [
            ['text' => "$litecoin", 'callback_data' => "dhcnjsdbcjhsd"], ['text' => "قیمت لایت کوین", 'callback_data' => "jnjknbjhb"]
        ],
        [
            ['text' => "$tron", 'callback_data' => "dhcnjsdbcjhsd"], ['text' => "قیمت ترون:", 'callback_data' => "jnjknbjhb"]
        ],
        [
            ['text' => "$dogecoin", 'callback_data' => "dhcnjsdbcjhsd"], ['text' => "قیمت دوج کوین:", 'callback_data' => "jnjknbjhb"]
        ],
        [
            ['text' => "💵 قیمت تتر : $tether  ", 'callback_data' => "dhcnjsdbcjhsd"]
        ],
    ]
]);
?>