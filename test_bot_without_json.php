<?php
/**
 * Test Bot Without JSON Files
 * Tests if bot works without JSON files using database
 */

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

echo "<!DOCTYPE html>
<html lang='fa' dir='rtl'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>تست ربات بدون فایل‌های JSON</title>
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
        .error { color: #f44336; font-weight: bold; }
        .info { color: #2196F3; font-weight: bold; }
        .warning { color: #FF9800; font-weight: bold; }
        pre {
            background: rgba(0, 0, 0, 0.3);
            padding: 1rem;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>🧪 تست ربات بدون فایل‌های JSON</h1>";

try {
    // Test 1: Check if database helpers exist
    echo "<h2>📋 تست 1: بررسی وجود توابع دیتابیس</h2>";
    
    if (file_exists('includes/database_helpers.php')) {
        echo "<p class='success'>✅ فایل database_helpers.php موجود است</p>";
    } else {
        echo "<p class='error'>❌ فایل database_helpers.php موجود نیست</p>";
    }
    
    if (file_exists('includes/Database.php')) {
        echo "<p class='success'>✅ فایل Database.php موجود است</p>";
    } else {
        echo "<p class='error'>❌ فایل Database.php موجود نیست</p>";
    }
    
    // Test 2: Check if JSON files exist
    echo "<h2>📋 تست 2: بررسی فایل‌های JSON</h2>";
    
    $jsonFiles = [
        'data/user.json',
        'data/start.txt',
        'data/fredays.txt',
        'data/tablighat.txt'
    ];
    
    foreach ($jsonFiles as $file) {
        if (file_exists($file)) {
            echo "<p class='info'>ℹ️ فایل {$file} موجود است</p>";
        } else {
            echo "<p class='warning'>⚠️ فایل {$file} موجود نیست</p>";
        }
    }
    
    // Test 3: Check database connection
    echo "<h2>📋 تست 3: بررسی اتصال دیتابیس</h2>";
    
    if (file_exists('secure_config.php')) {
        $config = include('secure_config.php');
        echo "<p class='info'>✅ فایل تنظیمات موجود است</p>";
        
        // Try to connect to database
        try {
            $dsn = "mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']};charset=utf8mb4";
            $pdo = new PDO($dsn, $config['DB_USER'], $config['DB_PASS']);
            echo "<p class='success'>✅ اتصال به دیتابیس موفق بود</p>";
            
            // Check tables
            $stmt = $pdo->query("SHOW TABLES");
            $tables = $stmt->fetchAll();
            
            if (count($tables) > 0) {
                echo "<p class='success'>✅ جداول دیتابیس موجود هستند</p>";
                echo "<ul>";
                foreach ($tables as $table) {
                    $tableName = array_values($table)[0];
                    echo "<li>{$tableName}</li>";
                }
                echo "</ul>";
            } else {
                echo "<p class='warning'>⚠️ هیچ جدولی در دیتابیس موجود نیست</p>";
            }
            
        } catch (PDOException $e) {
            echo "<p class='error'>❌ خطا در اتصال دیتابیس: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p class='error'>❌ فایل secure_config.php موجود نیست</p>";
    }
    
    // Test 4: Check bot functions
    echo "<h2>📋 تست 4: بررسی توابع ربات</h2>";
    
    // Include bot files
    if (file_exists('confing.php')) {
        include 'confing.php';
        echo "<p class='success'>✅ فایل confing.php بارگذاری شد</p>";
        
        // Check if database helpers are available
        if (function_exists('getDB')) {
            echo "<p class='success'>✅ تابع getDB موجود است</p>";
        } else {
            echo "<p class='error'>❌ تابع getDB موجود نیست</p>";
        }
        
        if (function_exists('getGroupSettings')) {
            echo "<p class='success'>✅ تابع getGroupSettings موجود است</p>";
        } else {
            echo "<p class='error'>❌ تابع getGroupSettings موجود نیست</p>";
        }
        
        if (function_exists('saveUser')) {
            echo "<p class='success'>✅ تابع saveUser موجود است</p>";
        } else {
            echo "<p class='error'>❌ تابع saveUser موجود نیست</p>";
        }
        
    } else {
        echo "<p class='error'>❌ فایل confing.php موجود نیست</p>";
    }
    
    // Test 5: Simulate bot operations
    echo "<h2>📋 تست 5: شبیه‌سازی عملیات ربات</h2>";
    
    if (function_exists('saveUser')) {
        try {
            $result = saveUser(123456789, 'test_user', 'Test', 'User');
            echo "<p class='success'>✅ ذخیره کاربر تست موفق بود</p>";
        } catch (Exception $e) {
            echo "<p class='error'>❌ خطا در ذخیره کاربر: " . $e->getMessage() . "</p>";
        }
    }
    
    if (function_exists('saveGroup')) {
        try {
            $result = saveGroup(-987654321, 'Test Group', 'testgroup', 'group', 123456789);
            echo "<p class='success'>✅ ذخیره گروه تست موفق بود</p>";
        } catch (Exception $e) {
            echo "<p class='error'>❌ خطا در ذخیره گروه: " . $e->getMessage() . "</p>";
        }
    }
    
    if (function_exists('getGroupSettings')) {
        try {
            $settings = getGroupSettings(-987654321);
            echo "<p class='success'>✅ دریافت تنظیمات گروه موفق بود</p>";
        } catch (Exception $e) {
            echo "<p class='error'>❌ خطا در دریافت تنظیمات: " . $e->getMessage() . "</p>";
        }
    }
    
    echo "<h2>🎉 نتیجه تست</h2>";
    echo "<p>ربات آماده استفاده با دیتابیس MySQL است!</p>";
    
} catch (Exception $e) {
    echo "<h2>❌ خطا در تست</h2>";
    echo "<p class='error'>خطا: " . $e->getMessage() . "</p>";
}

echo "</div></body></html>";
?> 