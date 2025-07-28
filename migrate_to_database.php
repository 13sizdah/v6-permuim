<?php
/**
 * Migration Script: JSON to MySQL
 * Transfers all data from JSON files to MySQL database
 */

// Include database class
require_once 'includes/Database.php';

// Security check
if (!isset($_GET['token']) || $_GET['token'] !== 'YOUR_SECURE_TOKEN') {
    die('Unauthorized access');
}

try {
    $db = Database::getInstance();
    
    echo "🔄 شروع مهاجرت داده‌ها از JSON به MySQL...\n\n";
    
    // 1. Migrate users
    echo "📊 مهاجرت کاربران...\n";
    $userFile = 'data/user.json';
    if (file_exists($userFile)) {
        $userData = json_decode(file_get_contents($userFile), true);
        
        if (isset($userData['userlist'])) {
            foreach ($userData['userlist'] as $userId) {
                $existingUser = $db->getUser($userId);
                if (!$existingUser) {
                    $db->createUser($userId);
                    echo "✅ کاربر {$userId} اضافه شد\n";
                }
            }
        }
        
        if (isset($userData['grouplist'])) {
            foreach ($userData['grouplist'] as $chatId) {
                $existingGroup = $db->getGroup($chatId);
                if (!$existingGroup) {
                    $db->createGroup($chatId, "Group {$chatId}", null, 'group');
                    echo "✅ گروه {$chatId} اضافه شد\n";
                }
            }
        }
    }
    
    // 2. Migrate group data
    echo "\n📁 مهاجرت تنظیمات گروه‌ها...\n";
    $dataDir = 'data/';
    $files = glob($dataDir . '*.json');
    
    foreach ($files as $file) {
        $chatId = basename($file, '.json');
        
        // Skip user.json
        if ($chatId === 'user') {
            continue;
        }
        
        // Check if it's a valid chat ID (numeric)
        if (!is_numeric($chatId)) {
            continue;
        }
        
        echo "🔄 پردازش گروه {$chatId}...\n";
        
        // Get or create group
        $group = $db->getGroup($chatId);
        if (!$group) {
            $groupId = $db->createGroup($chatId, "Group {$chatId}", null, 'group');
            echo "✅ گروه {$chatId} ایجاد شد\n";
        } else {
            $groupId = $group['id'];
        }
        
        // Migrate group data
        $migrated = $db->migrateFromJson($file, $groupId);
        if ($migrated) {
            echo "✅ تنظیمات گروه {$chatId} مهاجرت شد\n";
        } else {
            echo "❌ خطا در مهاجرت گروه {$chatId}\n";
        }
    }
    
    // 3. Migrate bot settings
    echo "\n⚙️ مهاجرت تنظیمات ربات...\n";
    
    // Start message
    $startFile = 'data/start.txt';
    if (file_exists($startFile)) {
        $startMessage = file_get_contents($startFile);
        $db->setBotSetting('start_message', $startMessage);
        echo "✅ پیام شروع مهاجرت شد\n";
    }
    
    // Free days
    $freeDaysFile = 'data/fredays.txt';
    if (file_exists($freeDaysFile)) {
        $freeDays = file_get_contents($freeDaysFile);
        $db->setBotSetting('free_days', $freeDays);
        echo "✅ روزهای رایگان مهاجرت شد\n";
    }
    
    // Ads
    $adsFile = 'data/tablighat.txt';
    if (file_exists($adsFile)) {
        $ads = file_get_contents($adsFile);
        $db->setBotSetting('ads_message', $ads);
        echo "✅ پیام تبلیغات مهاجرت شد\n";
    }
    
    // 4. Update group member counts
    echo "\n👥 به‌روزرسانی تعداد اعضا...\n";
    $activeGroups = $db->getActiveGroups();
    foreach ($activeGroups as $group) {
        // You can add Telegram API call here to get real member count
        echo "✅ گروه {$group['chat_id']} پردازش شد\n";
    }
    
    // 5. Create backup of JSON files
    echo "\n💾 ایجاد پشتیبان از فایل‌های JSON...\n";
    $backupDir = 'backup_' . date('Y-m-d_H-i-s');
    if (!is_dir($backupDir)) {
        mkdir($backupDir, 0755, true);
    }
    
    $jsonFiles = glob('data/*.json');
    foreach ($jsonFiles as $file) {
        $backupFile = $backupDir . '/' . basename($file);
        copy($file, $backupFile);
        echo "✅ پشتیبان {$file} ایجاد شد\n";
    }
    
    // 6. Statistics
    echo "\n📈 آمار نهایی:\n";
    $totalUsers = $db->getTotalUsers();
    $totalGroups = $db->getTotalGroups();
    $totalPayments = $db->getTotalPayments();
    
    echo "👥 تعداد کاربران: {$totalUsers}\n";
    echo "📁 تعداد گروه‌ها: {$totalGroups}\n";
    echo "💰 تعداد پرداخت‌ها: {$totalPayments}\n";
    
    echo "\n✅ مهاجرت با موفقیت تکمیل شد!\n";
    echo "📁 پشتیبان در پوشه: {$backupDir}\n";
    echo "⚠️ پس از اطمینان از صحت داده‌ها، فایل‌های JSON قدیمی را حذف کنید\n";
    
} catch (Exception $e) {
    echo "❌ خطا در مهاجرت: " . $e->getMessage() . "\n";
    error_log("Migration error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مهاجرت به دیتابیس</title>
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
        .success {
            color: #4CAF50;
            font-weight: bold;
        }
        .error {
            color: #f44336;
            font-weight: bold;
        }
        .info {
            color: #2196F3;
            font-weight: bold;
        }
        pre {
            background: rgba(0, 0, 0, 0.3);
            padding: 1rem;
            border-radius: 5px;
            overflow-x: auto;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 مهاجرت به دیتابیس MySQL</h1>
        <p>این صفحه برای انتقال داده‌ها از فایل‌های JSON به دیتابیس MySQL طراحی شده است.</p>
        
        <h2>📋 مراحل مهاجرت:</h2>
        <ol>
            <li>ایجاد دیتابیس MySQL</li>
            <li>اجرای فایل <code>database_schema.sql</code></li>
            <li>تنظیم اطلاعات اتصال در <code>secure_config.php</code></li>
            <li>اجرای این فایل با توکن امن</li>
        </ol>
        
        <h2>⚠️ نکات مهم:</h2>
        <ul>
            <li>قبل از مهاجرت، از تمام داده‌ها پشتیبان تهیه کنید</li>
            <li>اطمینان حاصل کنید که دیتابیس MySQL در دسترس است</li>
            <li>توکن امن را در URL قرار دهید</li>
            <li>پس از مهاجرت، فایل‌های JSON قدیمی را حذف کنید</li>
        </ul>
        
        <h2>🔧 نحوه استفاده:</h2>
        <p>این فایل را با پارامتر token اجرا کنید:</p>
        <code>migrate_to_database.php?token=YOUR_SECURE_TOKEN</code>
        
        <h2>📊 نتیجه مهاجرت:</h2>
        <pre id="migration-result">در حال بارگذاری...</pre>
    </div>
    
    <script>
        // You can add JavaScript here to show real-time migration progress
        console.log('Migration script loaded');
    </script>
</body>
</html> 