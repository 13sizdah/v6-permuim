-- Database Schema for Telegram Bot
-- Created for improved security and performance

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNIQUE NOT NULL,
    username VARCHAR(32),
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    is_admin BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_username (username)
);

-- Groups table
CREATE TABLE groups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chat_id BIGINT UNIQUE NOT NULL,
    title VARCHAR(255),
    username VARCHAR(32),
    type ENUM('group', 'supergroup', 'channel') NOT NULL,
    member_count INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    added_by BIGINT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_chat_id (chat_id),
    INDEX idx_username (username),
    INDEX idx_is_active (is_active),
    FOREIGN KEY (added_by) REFERENCES users(user_id) ON DELETE SET NULL
);

-- Group settings table
CREATE TABLE group_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT NOT NULL,
    setting_key VARCHAR(50) NOT NULL,
    setting_value TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_group_setting (group_id, setting_key),
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE,
    INDEX idx_group_id (group_id),
    INDEX idx_setting_key (setting_key)
);

-- Group locks table
CREATE TABLE group_locks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT NOT NULL,
    lock_type ENUM('text', 'photo', 'video', 'audio', 'voice', 'document', 'sticker', 'gif', 'location', 'contact', 'game', 'video_note', 'link', 'url', 'username', 'tag', 'edit', 'fosh', 'bot', 'forward', 'tgservic', 'reply', 'cmd', 'join', 'tabchi', 'group', 'mute_all') NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_group_lock (group_id, lock_type),
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE,
    INDEX idx_group_id (group_id),
    INDEX idx_lock_type (lock_type),
    INDEX idx_is_active (is_active)
);

-- Filtered words table
CREATE TABLE filtered_words (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT NOT NULL,
    word VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE,
    INDEX idx_group_id (group_id),
    INDEX idx_word (word)
);

-- Silent users table
CREATE TABLE silent_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT NOT NULL,
    user_id BIGINT NOT NULL,
    reason TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    UNIQUE KEY unique_silent_user (group_id, user_id),
    INDEX idx_group_id (group_id),
    INDEX idx_user_id (user_id)
);

-- Tabchi users table
CREATE TABLE tabchi_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT NOT NULL,
    user_id BIGINT NOT NULL,
    reason TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    UNIQUE KEY unique_tabchi_user (group_id, user_id),
    INDEX idx_group_id (group_id),
    INDEX idx_user_id (user_id)
);

-- Payments table
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT NOT NULL,
    user_id BIGINT NOT NULL,
    amount INT NOT NULL,
    currency VARCHAR(3) DEFAULT 'IRR',
    authority VARCHAR(100),
    ref_id VARCHAR(100),
    status ENUM('pending', 'completed', 'failed', 'cancelled') DEFAULT 'pending',
    gateway VARCHAR(20) DEFAULT 'zarinpal',
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    INDEX idx_group_id (group_id),
    INDEX idx_user_id (user_id),
    INDEX idx_status (status),
    INDEX idx_authority (authority),
    INDEX idx_created_at (created_at)
);

-- Subscriptions table
CREATE TABLE subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT NOT NULL,
    user_id BIGINT NOT NULL,
    payment_id INT,
    start_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    end_date TIMESTAMP NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (payment_id) REFERENCES payments(id) ON DELETE SET NULL,
    INDEX idx_group_id (group_id),
    INDEX idx_user_id (user_id),
    INDEX idx_end_date (end_date),
    INDEX idx_is_active (is_active)
);

-- Logs table
CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT,
    user_id BIGINT,
    action VARCHAR(50) NOT NULL,
    details TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE SET NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL,
    INDEX idx_group_id (group_id),
    INDEX idx_user_id (user_id),
    INDEX idx_action (action),
    INDEX idx_created_at (created_at)
);

-- Bot settings table
CREATE TABLE bot_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(50) UNIQUE NOT NULL,
    setting_value TEXT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_setting_key (setting_key)
);

-- Insert default bot settings
INSERT INTO bot_settings (setting_key, setting_value, description) VALUES
('start_message', 'به ربات خوش آمدید!', 'پیام شروع ربات'),
('free_days', '7', 'تعداد روزهای رایگان'),
('channel_username', '13sizdah', 'یوزرنیم کانال'),
('support_group', 'https://t.me/USER', 'لینک گروه پشتیبانی'),
('payment_email', 'your-email@domain.com', 'ایمیل پرداخت'),
('payment_mobile', '09123456789', 'شماره موبایل پرداخت'),
('merchant_id', 'YOUR_ZARINPAL_MERCHANT_ID', 'مریچنت زرین‌پال'),
('bot_name', 'تست', 'نام ربات'),
('web_url', 'https://domain.ir/folder/', 'آدرس وب‌سایت');

-- Create views for easier queries
CREATE VIEW active_groups AS
SELECT g.*, 
       COUNT(DISTINCT sw.user_id) as silent_count,
       COUNT(DISTINCT tw.user_id) as tabchi_count,
       COUNT(DISTINCT fw.word) as filter_count
FROM groups g
LEFT JOIN silent_users sw ON g.id = sw.group_id
LEFT JOIN tabchi_users tw ON g.id = tw.group_id
LEFT JOIN filtered_words fw ON g.id = fw.group_id
WHERE g.is_active = TRUE
GROUP BY g.id;

CREATE VIEW group_statistics AS
SELECT 
    g.id,
    g.chat_id,
    g.title,
    g.member_count,
    s.end_date as subscription_end,
    s.is_active as subscription_active,
    COUNT(DISTINCT l.id) as lock_count,
    COUNT(DISTINCT fw.word) as filter_word_count,
    COUNT(DISTINCT sw.user_id) as silent_user_count,
    COUNT(DISTINCT tw.user_id) as tabchi_user_count
FROM groups g
LEFT JOIN subscriptions s ON g.id = s.group_id AND s.is_active = TRUE
LEFT JOIN group_locks l ON g.id = l.group_id AND l.is_active = TRUE
LEFT JOIN filtered_words fw ON g.id = fw.group_id
LEFT JOIN silent_users sw ON g.id = sw.group_id
LEFT JOIN tabchi_users tw ON g.id = tw.group_id
GROUP BY g.id;

-- Create indexes for better performance
CREATE INDEX idx_payments_group_status ON payments(group_id, status);
CREATE INDEX idx_subscriptions_end_date ON subscriptions(end_date);
CREATE INDEX idx_logs_action_date ON logs(action, created_at);
CREATE INDEX idx_group_settings_key_value ON group_settings(setting_key, setting_value(100)); 