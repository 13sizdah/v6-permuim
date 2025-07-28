# 🐧 راهنمای نصب روی سرور اوبنتو

## 📋 **پیش‌نیازها**

### **حداقل مشخصات سرور:**
- **CPU:** 2 هسته
- **RAM:** 4GB
- **Storage:** 20GB SSD
- **OS:** Ubuntu 20.04 LTS یا بالاتر

## 🔧 **مراحل نصب**

### **مرحله 1: به‌روزرسانی سیستم**
```bash
sudo apt update && sudo apt upgrade -y
```

### **مرحله 2: نصب LAMP Stack**
```bash
# نصب Apache
sudo apt install apache2 -y

# نصب MySQL
sudo apt install mysql-server -y

# نصب PHP
sudo apt install php php-mysql php-curl php-json php-mbstring php-xml php-zip -y

# نصب PHP Extensions مورد نیاز
sudo apt install php-soap php-gd php-imagick -y
```

### **مرحله 3: تنظیم MySQL**
```bash
# اجرای تنظیمات امنیتی MySQL
sudo mysql_secure_installation

# ورود به MySQL
sudo mysql

# ایجاد دیتابیس
CREATE DATABASE telegram_bot_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# ایجاد کاربر
CREATE USER 'bot_user'@'localhost' IDENTIFIED BY 'YOUR_SECURE_PASSWORD';
GRANT ALL PRIVILEGES ON telegram_bot_db.* TO 'bot_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### **مرحله 4: تنظیم Apache**
```bash
# فعال‌سازی mod_rewrite
sudo a2enmod rewrite

# تنظیم مجوزهای پوشه
sudo chown -R www-data:www-data /var/www/html
sudo chmod -R 755 /var/www/html

# راه‌اندازی مجدد Apache
sudo systemctl restart apache2
```

### **مرحله 5: آپلود فایل‌ها**
```bash
# انتقال فایل‌ها به سرور
scp -r /path/to/your/bot user@your-server:/var/www/html/

# یا استفاده از Git
cd /var/www/html
git clone https://github.com/your-repo/telegram-bot.git
```

### **مرحله 6: تنظیم مجوزها**
```bash
# تنظیم مجوزهای فایل‌ها
sudo chown -R www-data:www-data /var/www/html/
sudo chmod -R 755 /var/www/html/
sudo chmod -R 777 /var/www/html/data/
sudo chmod -R 777 /var/www/html/logs/
```

### **مرحله 7: اجرای Schema دیتابیس**
```bash
# اجرای فایل schema
mysql -u bot_user -p telegram_bot_db < /var/www/html/database_schema.sql
```

### **مرحله 8: تنظیم SSL (HTTPS)**
```bash
# نصب Certbot
sudo apt install certbot python3-certbot-apache -y

# دریافت گواهی SSL
sudo certbot --apache -d your-domain.com
```

### **مرحله 9: تنظیم Cron Jobs**
```bash
# باز کردن crontab
crontab -e

# اضافه کردن job برای پاکسازی لاگ‌ها
0 2 * * * find /var/www/html/logs/ -name "*.log" -mtime +7 -delete

# اضافه کردن job برای پشتیبان‌گیری
0 3 * * * mysqldump -u bot_user -p telegram_bot_db > /backup/db_$(date +\%Y\%m\%d).sql
```

## 🔒 **تنظیمات امنیتی**

### **1. فایروال (UFW)**
```bash
# نصب UFW
sudo apt install ufw -y

# فعال‌سازی فایروال
sudo ufw enable

# باز کردن پورت‌های مورد نیاز
sudo ufw allow 22    # SSH
sudo ufw allow 80    # HTTP
sudo ufw allow 443   # HTTPS
```

### **2. تنظیمات Apache امن**
```bash
# ایجاد فایل تنظیمات امنیتی
sudo nano /etc/apache2/conf-available/security.conf

# اضافه کردن هدرهای امنیتی
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"
Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
```

### **3. تنظیمات PHP امن**
```bash
# ویرایش php.ini
sudo nano /etc/php/7.4/apache2/php.ini

# تنظیمات امنیتی
expose_php = Off
allow_url_fopen = Off
max_execution_time = 30
memory_limit = 256M
file_uploads = On
upload_max_filesize = 10M
post_max_size = 10M
```

## 📊 **مانیتورینگ**

### **1. نصب ابزارهای مانیتورینگ**
```bash
# نصب htop
sudo apt install htop -y

# نصب iotop
sudo apt install iotop -y

# نصب nethogs
sudo apt install nethogs -y
```

### **2. تنظیم Log Rotation**
```bash
# ایجاد فایل logrotate
sudo nano /etc/logrotate.d/telegram-bot

# محتوای فایل
/var/www/html/logs/*.log {
    daily
    missingok
    rotate 7
    compress
    delaycompress
    notifempty
    create 644 www-data www-data
}
```

## 🚀 **تست عملکرد**

### **1. تست اتصال دیتابیس**
```
http://your-domain.com/test_database.php
```

### **2. تست ربات**
```
http://your-domain.com/test_bot_without_json.php
```

### **3. تست مهاجرت**
```
http://your-domain.com/migrate_to_database.php?token=YOUR_SECURE_TOKEN
```

## 📈 **بهینه‌سازی عملکرد**

### **1. تنظیمات MySQL**
```sql
-- تنظیمات my.cnf
[mysqld]
innodb_buffer_pool_size = 1G
innodb_log_file_size = 256M
innodb_flush_log_at_trx_commit = 2
query_cache_size = 128M
query_cache_type = 1
```

### **2. تنظیمات Apache**
```apache
# تنظیمات MPM
<IfModule mpm_prefork_module>
    StartServers          5
    MinSpareServers       5
    MaxSpareServers      10
    MaxRequestWorkers    150
    MaxConnectionsPerChild   0
</IfModule>
```

### **3. فعال‌سازی Gzip**
```bash
sudo a2enmod deflate
sudo systemctl restart apache2
```

## 🔧 **عیب‌یابی**

### **مشکلات رایج:**

1. **خطای اتصال دیتابیس:**
   ```bash
   sudo systemctl status mysql
   sudo journalctl -u mysql
   ```

2. **خطای Apache:**
   ```bash
   sudo systemctl status apache2
   sudo tail -f /var/log/apache2/error.log
   ```

3. **خطای PHP:**
   ```bash
   sudo tail -f /var/log/apache2/error.log
   ```

## 📞 **پشتیبانی**

### **لاگ‌های مهم:**
- `/var/log/apache2/access.log`
- `/var/log/apache2/error.log`
- `/var/log/mysql/error.log`
- `/var/www/html/logs/`

### **دستورات مفید:**
```bash
# بررسی وضعیت سرویس‌ها
sudo systemctl status apache2 mysql

# بررسی فضای دیسک
df -h

# بررسی استفاده از RAM
free -h

# بررسی پروسه‌ها
ps aux | grep php
```

---

**نکته:** این راهنما برای سرور اوبنتو 20.04 LTS نوشته شده است. 