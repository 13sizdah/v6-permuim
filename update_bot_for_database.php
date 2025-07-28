<?php
/**
 * Update Bot Code for Database
 * Updates bot files to use MySQL database instead of JSON files
 */

// Security check
if (!isset($_GET['token']) || $_GET['token'] !== 'YOUR_SECURE_TOKEN') {
    die('Unauthorized access');
}

echo "🔄 شروع به‌روزرسانی کد ربات برای استفاده از دیتابیس...\n\n";

// 1. Update confing.php to include database
echo "📝 به‌روزرسانی confing.php...\n";

$confingContent = file_get_contents('confing.php');
$databaseInclude = "// Include database class\nrequire_once 'includes/Database.php';\n\n";

// Add database include after existing includes
if (strpos($confingContent, 'require_once \'includes/Database.php\'') === false) {
    $confingContent = str_replace(
        '// Include secure configuration',
        $databaseInclude . '// Include secure configuration',
        $confingContent
    );
    file_put_contents('confing.php', $confingContent);
    echo "✅ confing.php به‌روزرسانی شد\n";
} else {
    echo "ℹ️ confing.php قبلاً به‌روزرسانی شده\n";
}

// 2. Create database helper functions
echo "\n📝 ایجاد توابع کمکی دیتابیس...\n";

$databaseHelpers = '<?php
/**
 * Database Helper Functions
 * Functions to replace JSON file operations with database operations
 */

// Get database instance
function getDB() {
    return Database::getInstance();
}

// Get user data
function getUserData($userId) {
    $db = getDB();
    return $db->getUser($userId);
}

// Create or update user
function saveUser($userId, $username = null, $firstName = null, $lastName = null) {
    $db = getDB();
    $user = $db->getUser($userId);
    
    if (!$user) {
        return $db->createUser($userId, $username, $firstName, $lastName);
    } else {
        $data = [];
        if ($username) $data[\'username\'] = $username;
        if ($firstName) $data[\'first_name\'] = $firstName;
        if ($lastName) $data[\'last_name\'] = $lastName;
        
        if (!empty($data)) {
            $db->updateUser($userId, $data);
        }
        return $user[\'id\'];
    }
}

// Get group data
function getGroupData($chatId) {
    $db = getDB();
    return $db->getGroup($chatId);
}

// Create or update group
function saveGroup($chatId, $title, $username = null, $type = \'group\', $addedBy = null) {
    $db = getDB();
    $group = $db->getGroup($chatId);
    
    if (!$group) {
        return $db->createGroup($chatId, $title, $username, $type, $addedBy);
    } else {
        $data = [];
        if ($title) $data[\'title\'] = $title;
        if ($username) $data[\'username\'] = $username;
        if ($type) $data[\'type\'] = $type;
        
        if (!empty($data)) {
            $db->updateGroup($chatId, $data);
        }
        return $group[\'id\'];
    }
}

// Get group settings
function getGroupSettings($chatId) {
    $db = getDB();
    $group = $db->getGroup($chatId);
    
    if (!$group) {
        return [];
    }
    
    $settings = $db->getGroupSettings($group[\'id\']);
    $locks = $db->getGroupLocks($group[\'id\']);
    
    return [
        \'information\' => $settings,
        \'lock\' => $locks,
        \'filterlist\' => $db->getFilteredWords($group[\'id\']),
        \'silentlist\' => $db->getSilentUsers($group[\'id\']),
        \'tabchilist\' => $db->getTabchiUsers($group[\'id\'])
    ];
}

// Set group setting
function setGroupSetting($chatId, $key, $value) {
    $db = getDB();
    $group = $db->getGroup($chatId);
    
    if (!$group) {
        return false;
    }
    
    return $db->setGroupSetting($group[\'id\'], $key, $value);
}

// Set group lock
function setGroupLock($chatId, $lockType, $active = true) {
    $db = getDB();
    $group = $db->getGroup($chatId);
    
    if (!$group) {
        return false;
    }
    
    return $db->setGroupLock($group[\'id\'], $lockType, $active);
}

// Add filtered word
function addFilteredWord($chatId, $word) {
    $db = getDB();
    $group = $db->getGroup($chatId);
    
    if (!$group) {
        return false;
    }
    
    return $db->addFilteredWord($group[\'id\'], $word);
}

// Add silent user
function addSilentUser($chatId, $userId, $reason = null) {
    $db = getDB();
    $group = $db->getGroup($chatId);
    
    if (!$group) {
        return false;
    }
    
    return $db->addSilentUser($group[\'id\'], $userId, $reason);
}

// Add tabchi user
function addTabchiUser($chatId, $userId, $reason = null) {
    $db = getDB();
    $group = $db->getGroup($chatId);
    
    if (!$group) {
        return false;
    }
    
    return $db->addTabchiUser($group[\'id\'], $userId, $reason);
}

// Get bot setting
function getBotSetting($key) {
    $db = getDB();
    return $db->getBotSetting($key);
}

// Set bot setting
function setBotSetting($key, $value) {
    $db = getDB();
    return $db->setBotSetting($key, $value);
}

// Log action
function logAction($action, $details = null, $chatId = null, $userId = null) {
    $db = getDB();
    return $db->log($action, $details, $chatId, $userId);
}

// Check if user is admin
function isAdmin($userId) {
    $db = getDB();
    $user = $db->getUser($userId);
    return $user && $user[\'is_admin\'];
}

// Get all users
function getAllUsers() {
    $db = getDB();
    return $db->fetchAll("SELECT * FROM users");
}

// Get all groups
function getAllGroups() {
    $db = getDB();
    return $db->getActiveGroups();
}

// Get group statistics
function getGroupStatistics($chatId) {
    $db = getDB();
    $group = $db->getGroup($chatId);
    
    if (!$group) {
        return null;
    }
    
    return $db->getGroupStatistics($group[\'id\']);
}

// Create payment
function createPayment($chatId, $userId, $amount, $authority = null) {
    $db = getDB();
    $group = $db->getGroup($chatId);
    
    if (!$group) {
        return false;
    }
    
    return $db->createPayment($group[\'id\'], $userId, $amount, $authority);
}

// Update payment
function updatePayment($paymentId, $data) {
    $db = getDB();
    return $db->updatePayment($paymentId, $data);
}

// Get payment by authority
function getPaymentByAuthority($authority) {
    $db = getDB();
    return $db->getPaymentByAuthority($authority);
}

// Create subscription
function createSubscription($chatId, $userId, $endDate, $paymentId = null) {
    $db = getDB();
    $group = $db->getGroup($chatId);
    
    if (!$group) {
        return false;
    }
    
    return $db->createSubscription($group[\'id\'], $userId, $endDate, $paymentId);
}

// Get active subscription
function getActiveSubscription($chatId) {
    $db = getDB();
    $group = $db->getGroup($chatId);
    
    if (!$group) {
        return null;
    }
    
    return $db->getActiveSubscription($group[\'id\']);
}

// Backward compatibility functions
function getSettingsFromJson($chatId) {
    return getGroupSettings($chatId);
}

function saveSettingsToJson($chatId, $settings) {
    // This function is kept for backward compatibility
    // In the future, it should be replaced with database operations
    $db = getDB();
    $group = $db->getGroup($chatId);
    
    if (!$group) {
        return false;
    }
    
    // Save settings
    if (isset($settings[\'information\'])) {
        foreach ($settings[\'information\'] as $key => $value) {
            $db->setGroupSetting($group[\'id\'], $key, $value);
        }
    }
    
    // Save locks
    if (isset($settings[\'lock\'])) {
        foreach ($settings[\'lock\'] as $lockType => $active) {
            $db->setGroupLock($group[\'id\'], $lockType, $active);
        }
    }
    
    return true;
}
?>';

file_put_contents('includes/database_helpers.php', $databaseHelpers);
echo "✅ فایل database_helpers.php ایجاد شد\n";

// 3. Update bot.php to use database
echo "\n📝 به‌روزرسانی bot.php...\n";

$botContent = file_get_contents('bot.php');

// Add database helpers include
if (strpos($botContent, 'require_once \'includes/database_helpers.php\'') === false) {
    $botContent = str_replace(
        'include "confing.php";',
        'include "confing.php";' . "\n" . 'require_once "includes/database_helpers.php";',
        $botContent
    );
}

// Replace JSON operations with database operations
$botContent = str_replace(
    '@$user = json_decode(file_get_contents("data/user.json"),true);',
    '$user = getAllUsers();',
    $botContent
);

$botContent = str_replace(
    '@$settings = json_decode(file_get_contents("data/$chat_id.json"),true);',
    '$settings = getGroupSettings($chat_id);',
    $botContent
);

$botContent = str_replace(
    '@$settings2 = json_decode(file_get_contents("data/$chatid.json"),true);',
    '$settings2 = getGroupSettings($chatid);',
    $botContent
);

$botContent = str_replace(
    '@$editgetsettings = json_decode(file_get_contents("data/$chat_edit_id.json"),true);',
    '$editgetsettings = getGroupSettings($chat_edit_id);',
    $botContent
);

file_put_contents('bot.php', $botContent);
echo "✅ bot.php به‌روزرسانی شد\n";

// 4. Create database configuration checker
echo "\n📝 ایجاد بررسی‌کننده تنظیمات دیتابیس...\n";

$dbChecker = '<?php
/**
 * Database Configuration Checker
 * Checks if database is properly configured
 */

function checkDatabaseConfig() {
    try {
        $db = Database::getInstance();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function getDatabaseStatus() {
    $status = [
        \'connected\' => false,
        \'tables\' => [],
        \'users\' => 0,
        \'groups\' => 0,
        \'payments\' => 0
    ];
    
    try {
        $db = Database::getInstance();
        $status[\'connected\'] = true;
        
        // Check tables
        $tables = $db->fetchAll("SHOW TABLES");
        foreach ($tables as $table) {
            $status[\'tables\'][] = array_values($table)[0];
        }
        
        // Get counts
        $status[\'users\'] = $db->getTotalUsers();
        $status[\'groups\'] = $db->getTotalGroups();
        $status[\'payments\'] = $db->getTotalPayments();
        
    } catch (Exception $e) {
        $status[\'error\'] = $e->getMessage();
    }
    
    return $status;
}
?>';

file_put_contents('includes/db_checker.php', $dbChecker);
echo "✅ فایل db_checker.php ایجاد شد\n";

// 5. Create migration status file
echo "\n📝 ایجاد فایل وضعیت مهاجرت...\n";

$migrationStatus = '<?php
/**
 * Migration Status
 * Tracks migration progress and status
 */

$migrationStatus = [
    \'database_created\' => false,
    \'tables_created\' => false,
    \'data_migrated\' => false,
    \'bot_updated\' => false,
    \'tested\' => false,
    \'json_backup_created\' => false,
    \'json_files_removed\' => false
];

function updateMigrationStatus($key, $value = true) {
    global $migrationStatus;
    $migrationStatus[$key] = $value;
    
    // Save to file
    file_put_contents(\'migration_status.json\', json_encode($migrationStatus, JSON_PRETTY_PRINT));
}

function getMigrationStatus() {
    global $migrationStatus;
    
    if (file_exists(\'migration_status.json\')) {
        $migrationStatus = json_decode(file_get_contents(\'migration_status.json\'), true);
    }
    
    return $migrationStatus;
}

function isMigrationComplete() {
    $status = getMigrationStatus();
    return $status[\'database_created\'] && 
           $status[\'tables_created\'] && 
           $status[\'data_migrated\'] && 
           $status[\'bot_updated\'] && 
           $status[\'tested\'];
}
?>';

file_put_contents('includes/migration_status.php', $migrationStatus);
echo "✅ فایل migration_status.php ایجاد شد\n";

echo "\n🎉 به‌روزرسانی کد ربات تکمیل شد!\n";
echo "\n📋 مراحل بعدی:\n";
echo "1. دیتابیس MySQL را ایجاد کنید\n";
echo "2. فایل database_schema.sql را اجرا کنید\n";
echo "3. test_database.php را اجرا کنید\n";
echo "4. migrate_to_database.php را اجرا کنید\n";
echo "5. عملکرد ربات را تست کنید\n";

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>به‌روزرسانی کد ربات</title>
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            color: white;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }
        .success { color: #4CAF50; font-weight: bold; }
        .info { color: #2196F3; font-weight: bold; }
        pre {
            background: rgba(0, 0, 0, 0.3);
            padding: 1rem;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 به‌روزرسانی کد ربات برای دیتابیس</h1>
        <p>کد ربات برای استفاده از دیتابیس MySQL به‌روزرسانی شد.</p>
        
        <h2>✅ فایل‌های ایجاد/به‌روزرسانی شده:</h2>
        <ul>
            <li>includes/database_helpers.php - توابع کمکی دیتابیس</li>
            <li>includes/db_checker.php - بررسی‌کننده تنظیمات</li>
            <li>includes/migration_status.php - وضعیت مهاجرت</li>
            <li>bot.php - به‌روزرسانی شده</li>
            <li>confing.php - به‌روزرسانی شده</li>
        </ul>
        
        <h2>📋 مراحل بعدی:</h2>
        <ol>
            <li>ایجاد دیتابیس MySQL</li>
            <li>اجرای database_schema.sql</li>
            <li>تست اتصال دیتابیس</li>
            <li>مهاجرت داده‌ها</li>
            <li>تست عملکرد ربات</li>
        </ol>
        
        <h2>⚠️ نکات مهم:</h2>
        <ul>
            <li>قبل از مهاجرت، از تمام فایل‌ها پشتیبان تهیه کنید</li>
            <li>اطمینان حاصل کنید که MySQL نصب و فعال است</li>
            <li>پس از مهاجرت، عملکرد ربات را تست کنید</li>
            <li>فایل‌های JSON قدیمی را پس از اطمینان حذف کنید</li>
        </ul>
    </div>
</body>
</html> 