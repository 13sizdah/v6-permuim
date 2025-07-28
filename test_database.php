<?php
/**
 * Database Connection Test
 * Test MySQL connection and basic operations
 */

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

// Include configuration
require_once 'secure_config.php';

echo "<!DOCTYPE html>
<html lang='fa' dir='rtl'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>تست اتصال دیتابیس</title>
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
        <h1>🔧 تست اتصال دیتابیس MySQL</h1>";

try {
    // Load configuration
    $config = include('secure_config.php');
    
    echo "<h2>📋 اطلاعات اتصال:</h2>
    <ul>
        <li>Host: {$config['DB_HOST']}</li>
        <li>Database: {$config['DB_NAME']}</li>
        <li>User: {$config['DB_USER']}</li>
        <li>Password: " . (empty($config['DB_PASS']) ? 'خالی' : 'تنظیم شده') . "</li>
    </ul>";
    
    // Test connection
    echo "<h2>🔌 تست اتصال:</h2>";
    
    $dsn = "mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']};charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
    ];
    
    $pdo = new PDO($dsn, $config['DB_USER'], $config['DB_PASS'], $options);
    echo "<p class='success'>✅ اتصال به دیتابیس موفق بود!</p>";
    
    // Test basic operations
    echo "<h2>🧪 تست عملیات پایه:</h2>";
    
    // Test query
    $stmt = $pdo->query("SELECT VERSION() as version");
    $version = $stmt->fetch();
    echo "<p class='info'>📊 نسخه MySQL: {$version['version']}</p>";
    
    // Check tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll();
    
    echo "<h3>📋 جداول موجود:</h3><ul>";
    foreach ($tables as $table) {
        $tableName = array_values($table)[0];
        echo "<li>{$tableName}</li>";
    }
    echo "</ul>";
    
    // Test insert/select
    echo "<h3>🧪 تست درج و انتخاب:</h3>";
    
    // Create test table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS test_table (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Insert test data
    $stmt = $pdo->prepare("INSERT INTO test_table (name) VALUES (?)");
    $testName = "تست فارسی " . date('Y-m-d H:i:s');
    $stmt->execute([$testName]);
    
    echo "<p class='success'>✅ درج داده موفق بود</p>";
    
    // Select test data
    $stmt = $pdo->query("SELECT * FROM test_table ORDER BY id DESC LIMIT 5");
    $results = $stmt->fetchAll();
    
    echo "<h4>📊 آخرین رکوردها:</h4><ul>";
    foreach ($results as $row) {
        echo "<li>ID: {$row['id']} - نام: {$row['name']} - تاریخ: {$row['created_at']}</li>";
    }
    echo "</ul>";
    
    // Test Unicode support
    echo "<h3>🌐 تست پشتیبانی از یونیکد:</h3>";
    $unicodeTest = "تست فارسی: سلام دنیا! 🚀";
    $stmt = $pdo->prepare("INSERT INTO test_table (name) VALUES (?)");
    $stmt->execute([$unicodeTest]);
    echo "<p class='success'>✅ تست یونیکد موفق بود</p>";
    
    // Performance test
    echo "<h3>⚡ تست عملکرد:</h3>";
    $start = microtime(true);
    
    for ($i = 0; $i < 100; $i++) {
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM test_table");
        $stmt->execute();
        $stmt->fetch();
    }
    
    $end = microtime(true);
    $time = ($end - $start) * 1000; // Convert to milliseconds
    
    echo "<p class='info'>⏱️ زمان 100 کوئری: {$time} میلی‌ثانیه</p>";
    
    // Clean up test data
    $pdo->exec("DELETE FROM test_table WHERE name LIKE 'تست%'");
    echo "<p class='success'>🧹 پاکسازی داده‌های تست</p>";
    
    echo "<h2>🎉 تمام تست‌ها موفق بودند!</h2>
    <p>دیتابیس آماده مهاجرت است.</p>";
    
} catch (PDOException $e) {
    echo "<h2>❌ خطا در اتصال دیتابیس:</h2>
    <p class='error'>خطا: " . $e->getMessage() . "</p>
    
    <h3>🔧 راه‌حل‌های پیشنهادی:</h3>
    <ul>
        <li>اطمینان حاصل کنید که MySQL نصب و فعال است</li>
        <li>اطلاعات اتصال را در secure_config.php بررسی کنید</li>
        <li>دیتابیس telegram_bot_db را ایجاد کنید</li>
        <li>فایل database_schema.sql را اجرا کنید</li>
    </ul>";
    
    error_log("Database connection test failed: " . $e->getMessage());
}

echo "</div></body></html>";
?> 