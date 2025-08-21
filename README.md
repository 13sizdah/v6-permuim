# 🌐 راهنمای نصب روی هاست سی‌پنل

## 📋 **پیش‌نیازها**

### **حداقل مشخصات هاست:**
- **پلن:** Business یا بالاتر
- **PHP:** 7.4 یا بالاتر
- **MySQL:** 5.7 یا بالاتر
- **SSL:** رایگان یا پولی
- **SSH:** در صورت نیاز

## 🔧 **مراحل نصب**

### **مرحله 1: ورود به سی‌پنل**
```
https://your-domain.com/cpanel
```

### **مرحله 2: ایجاد دیتابیس MySQL**
1. **MySQL Databases** را باز کنید
2. **Create New Database** کلیک کنید
3. نام دیتابیس: `telegram_bot_db`
4. **Create Database** کلیک کنید

### **مرحله 3: ایجاد کاربر دیتابیس**
1. **Add New User** کلیک کنید
2. نام کاربر: `bot_user`
3. رمز عبور: `YOUR_SECURE_PASSWORD`
4. **Create User** کلیک کنید

### **مرحله 4: اتصال کاربر به دیتابیس**
1. **Add User To Database** کلیک کنید
2. کاربر و دیتابیس را انتخاب کنید
3. **ALL PRIVILEGES** را انتخاب کنید
4. **Add User To Database** کلیک کنید

### **مرحله 5: آپلود فایل‌ها**
1. **File Manager** را باز کنید
2. به پوشه `public_html` بروید
3. فایل‌های ربات را آپلود کنید

### **مرحله 6: تنظیم مجوزها**
```bash
# در File Manager
data/ -> 777
logs/ -> 777
includes/ -> 755
```

### **مرحله 7: اجرای Schema دیتابیس**
1. **phpMyAdmin** را باز کنید
2. دیتابیس `telegram_bot_db` را انتخاب کنید
3. فایل `database_schema.sql` را import کنید

### **مرحله 8: تنظیم SSL**
1. **SSL/TLS** را باز کنید
2. **Install SSL** کلیک کنید
3. گواهی رایگان یا پولی را نصب کنید

## ⚙️ **تنظیمات PHP**

### **1. تنظیمات PHP در سی‌پنل**
1. **PHP Selector** را باز کنید
2. نسخه PHP را به 7.4 یا بالاتر تغییر دهید
3. **Extensions** مورد نیاز را فعال کنید:
   - `mysql`
   - `curl`
   - `json`
   - `mbstring`
   - `xml`
   - `zip`
   - `soap`
   - `gd`

### **2. تنظیمات php.ini**
```ini
; امنیت
expose_php = Off
allow_url_fopen = Off

; عملکرد
max_execution_time = 30
memory_limit = 256M
upload_max_filesize = 10M
post_max_size = 10M

; خطاها
display_errors = Off
log_errors = On
error_log = /home/user/public_html/logs/error.log
```

## 🔒 **تنظیمات امنیتی**

### **1. فایل .htaccess**
```apache
# امنیت
<Files "secure_config.php">
    Order allow,deny
    Deny from all
</Files>

<Files "*.json">
    Order allow,deny
    Deny from all
</Files>

# محافظت از پوشه‌ها
<Directory "data">
    Order allow,deny
    Deny from all
</Directory>

<Directory "logs">
    Order allow,deny
    Deny from all
</Directory>

# هدرهای امنیتی
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"
Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
```

### **2. فایل robots.txt**
```txt
User-agent: *
Disallow: /data/
Disallow: /logs/
Disallow: /includes/
Disallow: /secure_config.php
```

## 📊 **مانیتورینگ**

### **1. لاگ‌های سی‌پنل**
- **Error Logs:** `/home/user/public_html/logs/`
- **Access Logs:** در سی‌پنل قابل مشاهده
- **MySQL Logs:** در phpMyAdmin

### **2. ابزارهای مانیتورینگ**
1. **Resource Usage** - بررسی منابع
2. **Bandwidth** - بررسی ترافیک
3. **Disk Usage** - بررسی فضای دیسک

## 🚀 **تست عملکرد**

### **1. تست اتصال دیتابیس**
```
https://your-domain.com/test_database.php
```

### **2. تست ربات**
```
https://your-domain.com/test_bot_without_json.php
```

### **3. تست مهاجرت**
```
https://your-domain.com/migrate_to_database.php?token=YOUR_SECURE_TOKEN
```

## 📈 **بهینه‌سازی**

### **1. فعال‌سازی Gzip**
```apache
# در .htaccess
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/xml
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE application/xml
    AddOutputFilterByType DEFLATE application/xhtml+xml
    AddOutputFilterByType DEFLATE application/rss+xml
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/x-javascript
</IfModule>
```

### **2. تنظیمات Cache**
```apache
# در .htaccess
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType image/png "access plus 1 month"
    ExpiresByType image/jpg "access plus 1 month"
    ExpiresByType image/jpeg "access plus 1 month"
    ExpiresByType image/gif "access plus 1 month"
</IfModule>
```

## 🔧 **عیب‌یابی**

### **مشکلات رایج:**

1. **خطای اتصال دیتابیس:**
   - بررسی اطلاعات اتصال در `secure_config.php`
   - بررسی مجوزهای کاربر دیتابیس
   - بررسی محدودیت‌های هاست

2. **خطای PHP:**
   - بررسی نسخه PHP
   - بررسی Extensions
   - بررسی لاگ‌های خطا

3. **خطای آپلود فایل:**
   - بررسی مجوزهای پوشه‌ها
   - بررسی محدودیت‌های هاست
   - بررسی تنظیمات PHP


---

**نکته:** این راهنما برای هاست‌های سی‌پنل استاندارد نوشته شده است. 
