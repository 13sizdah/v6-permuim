<?php
/**
 * Secure Configuration File
 * This file contains sensitive configuration data
 * Make sure this file is not accessible via web
 */

return [
    'API_KEY' => 'YOUR_BOT_TOKEN_HERE', // توکن ربات خود را اینجا وارد کنید
    'MERCHANT_ID' => 'YOUR_ZARINPAL_MERCHANT_ID', // مریچنت زرین پال
    'PAYMENT_EMAIL' => 'your-email@domain.com', // ایمیل برای پرداخت
    'PAYMENT_MOBILE' => '09123456789', // شماره موبایل برای پرداخت
    
    // Admin user IDs
    'ADMIN_IDS' => [
        '00000000',
        '0000000000', 
        '0000000000'
    ],
    
    // Bot settings
    'BOT_USERNAME' => 'Testbot',
    'BOT_ID' => '00000000',
    'CHANNEL' => 'danial',
    'CHANNEL_ID' => '-100100000095',
    'CHANNEL_NAME' => 'فکت وب',
    'WEB_URL' => 'https://domain.ir/folder/',
    'SUPPORT_GROUP' => 'https://t.me/USER',
    'BOT_NAME' => 'تست',
    
    // Security settings
    'MAX_MESSAGE_LENGTH' => 4096,
    'MAX_USERNAME_LENGTH' => 32,
    'MAX_CHAT_TITLE_LENGTH' => 255,
    'MAX_CALLBACK_DATA_LENGTH' => 64,
    
    // Rate limiting
    'RATE_LIMIT_PER_MINUTE' => 60,
    'RATE_LIMIT_PER_HOUR' => 1000,
    
    // File permissions
    'DATA_DIR_PERMISSIONS' => 0755,
    'FILE_PERMISSIONS' => 0644,
    
    // Logging
    'LOG_LEVEL' => 'ERROR', // DEBUG, INFO, WARNING, ERROR
    'LOG_FILE' => 'logs/bot.log',
    'ERROR_LOG_FILE' => 'logs/error.log',
    
    // Cache settings
    'CACHE_ENABLED' => true,
    'CACHE_DURATION' => 300, // 5 minutes
    
    // Database settings
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'telegram_bot_db',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    
    // Payment settings
    'PAYMENT_GATEWAY' => 'zarinpal',
    'PAYMENT_CURRENCY' => 'IRR',
    'PAYMENT_DESCRIPTION' => 'خرید ربات مدیریت گروه',
    
    // Telegram API settings
    'TELEGRAM_API_TIMEOUT' => 30,
    'TELEGRAM_API_RETRY_COUNT' => 3,
    'TELEGRAM_API_RETRY_DELAY' => 1,
    
    // Security headers
    'SECURITY_HEADERS' => [
        'X-Content-Type-Options' => 'nosniff',
        'X-Frame-Options' => 'DENY',
        'X-XSS-Protection' => '1; mode=block',
        'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
        'Content-Security-Policy' => "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline';"
    ]
];
?> 