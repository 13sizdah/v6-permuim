<?php
/**
 * Fix All JSON File References
 * Automatically updates all PHP files to use database instead of JSON files
 */

// Security check
if (!isset($_GET['token']) || $_GET['token'] !== 'YOUR_SECURE_TOKEN') {
    die('Unauthorized access');
}

echo "🔄 شروع به‌روزرسانی تمام فایل‌های PHP...\n\n";

// List of files to update
$filesToUpdate = [
    'plugin/upmsgcheck.php',
    'plugin/tools.php',
    'plugin/start.php',
    'plugin/settings.php',
    'plugin/plusmsgcheck.php',
    'plugin/plus.php',
    'plugin/panelplus.php',
    'plugin/panel.php',
    'plugin/msgcheck.php',
    'plugin/lock.php'
];

$totalFiles = count($filesToUpdate);
$updatedFiles = 0;

foreach ($filesToUpdate as $file) {
    if (!file_exists($file)) {
        echo "⚠️ فایل {$file} موجود نیست\n";
        continue;
    }
    
    echo "📝 به‌روزرسانی {$file}...\n";
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Replace JSON file operations with database operations
    
    // 1. Replace file_get_contents with database functions
    $content = preg_replace(
        '/file_get_contents\("data\/([^"]+)\.json"\)/',
        'getGroupSettings($1)',
        $content
    );
    
    // 2. Replace json_decode with database functions
    $content = preg_replace(
        '/json_decode\(file_get_contents\("data\/([^"]+)\.json"\),true\)/',
        'getGroupSettings($1)',
        $content
    );
    
    // 3. Replace user.json operations
    $content = preg_replace(
        '/json_decode\(file_get_contents\("data\/user\.json"\),true\)/',
        'getAllUsers()',
        $content
    );
    
    // 4. Replace file_put_contents with database functions
    $content = preg_replace(
        '/file_put_contents\("data\/([^"]+)\.json",\$settings\)/',
        'saveSettingsToDatabase($1, $settings)',
        $content
    );
    
    // 5. Replace user.json file_put_contents
    $content = preg_replace(
        '/file_put_contents\("data\/user\.json",\$user\)/',
        'saveUserToDatabase($user)',
        $content
    );
    
    // 6. Replace settings array operations
    $content = preg_replace(
        '/\$settings\["information"\]\["([^"]+)"\]\s*=\s*([^;]+);/',
        'setGroupSetting($chat_id, "$1", $2);',
        $content
    );
    
    // 7. Replace lock operations
    $content = preg_replace(
        '/\$settings\["lock"\]\["([^"]+)"\]\s*=\s*([^;]+);/',
        'setGroupLock($chat_id, "$1", $2);',
        $content
    );
    
    // 8. Replace filterlist operations
    $content = preg_replace(
        '/\$settings\["filterlist"\]\[\]\s*=\s*"([^"]+)";/',
        'addFilteredWord($chat_id, "$1");',
        $content
    );
    
    // 9. Replace silentlist operations
    $content = preg_replace(
        '/\$settings\["silentlist"\]\[\]\s*=\s*([^;]+);/',
        'addSilentUser($chat_id, $1);',
        $content
    );
    
    // 10. Replace tabchilist operations
    $content = preg_replace(
        '/\$settings\["tabchilist"\]\[\]\s*=\s*([^;]+);/',
        'addTabchiUser($chat_id, $1);',
        $content
    );
    
    // Save updated content
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "✅ فایل {$file} به‌روزرسانی شد\n";
        $updatedFiles++;
    } else {
        echo "ℹ️ فایل {$file} تغییری نداشت\n";
    }
}

// Create helper functions for backward compatibility
$helperFunctions = '<?php
/**
 * Database Helper Functions for Backward Compatibility
 */

// Save settings to database
function saveSettingsToDatabase($chatId, $settings) {
    $db = getDB();
    $group = $db->getGroup($chatId);
    
    if (!$group) {
        return false;
    }
    
    // Save information settings
    if (isset($settings["information"])) {
        foreach ($settings["information"] as $key => $value) {
            $db->setGroupSetting($group["id"], $key, $value);
        }
    }
    
    // Save lock settings
    if (isset($settings["lock"])) {
        foreach ($settings["lock"] as $lockType => $active) {
            $db->setGroupLock($group["id"], $lockType, $active);
        }
    }
    
    // Save filterlist
    if (isset($settings["filterlist"]) && is_array($settings["filterlist"])) {
        foreach ($settings["filterlist"] as $word) {
            $db->addFilteredWord($group["id"], $word);
        }
    }
    
    // Save silentlist
    if (isset($settings["silentlist"]) && is_array($settings["silentlist"])) {
        foreach ($settings["silentlist"] as $userId) {
            $db->addSilentUser($group["id"], $userId);
        }
    }
    
    // Save tabchilist
    if (isset($settings["tabchilist"]) && is_array($settings["tabchilist"])) {
        foreach ($settings["tabchilist"] as $userId) {
            $db->addTabchiUser($group["id"], $userId);
        }
    }
    
    return true;
}

// Save user to database
function saveUserToDatabase($user) {
    $db = getDB();
    
    if (isset($user["userlist"]) && is_array($user["userlist"])) {
        foreach ($user["userlist"] as $userId) {
            $db->createUser($userId);
        }
    }
    
    if (isset($user["grouplist"]) && is_array($user["grouplist"])) {
        foreach ($user["grouplist"] as $chatId) {
            $db->createGroup($chatId, "Group $chatId");
        }
    }
    
    return true;
}

// Get settings from database (backward compatibility)
function getSettingsFromDatabase($chatId) {
    return getGroupSettings($chatId);
}

// Save settings to database (backward compatibility)
function saveSettingsToDatabase($chatId, $settings) {
    return saveSettingsToDatabase($chatId, $settings);
}
?>';

file_put_contents('includes/database_compatibility.php', $helperFunctions);
echo "✅ فایل database_compatibility.php ایجاد شد\n";

echo "\n🎉 به‌روزرسانی تکمیل شد!\n";
echo "📊 آمار:\n";
echo "- کل فایل‌ها: {$totalFiles}\n";
echo "- فایل‌های به‌روزرسانی شده: {$updatedFiles}\n";
echo "- فایل‌های بدون تغییر: " . ($totalFiles - $updatedFiles) . "\n";

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>به‌روزرسانی فایل‌های PHP</title>
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
        .warning { color: #FF9800; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 به‌روزرسانی فایل‌های PHP</h1>
        <p>تمام فایل‌های PHP برای استفاده از دیتابیس به‌روزرسانی شدند.</p>
        
        <h2>✅ فایل‌های به‌روزرسانی شده:</h2>
        <ul>
            <li>plugin/upmsgcheck.php</li>
            <li>plugin/tools.php</li>
            <li>plugin/start.php</li>
            <li>plugin/settings.php</li>
            <li>plugin/plusmsgcheck.php</li>
            <li>plugin/plus.php</li>
            <li>plugin/panelplus.php</li>
            <li>plugin/panel.php</li>
            <li>plugin/msgcheck.php</li>
            <li>plugin/lock.php</li>
        </ul>
        
        <h2>📊 آمار:</h2>
        <ul>
            <li>کل فایل‌ها: <?php echo $totalFiles; ?></li>
            <li>فایل‌های به‌روزرسانی شده: <?php echo $updatedFiles; ?></li>
            <li>فایل‌های بدون تغییر: <?php echo ($totalFiles - $updatedFiles); ?></li>
        </ul>
        
        <h2>⚠️ نکات مهم:</h2>
        <ul>
            <li>قبل از استفاده، دیتابیس MySQL را ایجاد کنید</li>
            <li>فایل database_schema.sql را اجرا کنید</li>
            <li>عملکرد ربات را تست کنید</li>
            <li>فایل‌های JSON قدیمی را پس از اطمینان حذف کنید</li>
        </ul>
    </div>
</body>
</html> 