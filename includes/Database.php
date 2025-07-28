<?php
/**
 * Database Class for Telegram Bot
 * Secure database operations with prepared statements
 */

class Database {
    private $pdo;
    private static $instance = null;
    
    private function __construct() {
        $config = include('../secure_config.php');
        
        try {
            $dsn = "mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
            ];
            
            $this->pdo = new PDO($dsn, $config['DB_USER'], $config['DB_PASS'], $options);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new Exception("Database connection failed");
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Get PDO instance
     */
    public function getPDO() {
        return $this->pdo;
    }
    
    /**
     * Execute a query with parameters
     */
    public function query($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Database query failed: " . $e->getMessage());
            throw new Exception("Database query failed");
        }
    }
    
    /**
     * Fetch single row
     */
    public function fetchOne($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }
    
    /**
     * Fetch all rows
     */
    public function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }
    
    /**
     * Insert data and return last insert ID
     */
    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $this->query($sql, $data);
        
        return $this->pdo->lastInsertId();
    }
    
    /**
     * Update data
     */
    public function update($table, $data, $where, $whereParams = []) {
        $setParts = [];
        foreach (array_keys($data) as $column) {
            $setParts[] = "{$column} = :{$column}";
        }
        $setClause = implode(', ', $setParts);
        
        $sql = "UPDATE {$table} SET {$setClause} WHERE {$where}";
        $params = array_merge($data, $whereParams);
        
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
    
    /**
     * Delete data
     */
    public function delete($table, $where, $params = []) {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
    
    /**
     * User operations
     */
    public function getUser($userId) {
        return $this->fetchOne("SELECT * FROM users WHERE user_id = ?", [$userId]);
    }
    
    public function createUser($userId, $username = null, $firstName = null, $lastName = null) {
        $data = [
            'user_id' => $userId,
            'username' => $username,
            'first_name' => $firstName,
            'last_name' => $lastName
        ];
        
        return $this->insert('users', $data);
    }
    
    public function updateUser($userId, $data) {
        return $this->update('users', $data, 'user_id = ?', [$userId]);
    }
    
    /**
     * Group operations
     */
    public function getGroup($chatId) {
        return $this->fetchOne("SELECT * FROM groups WHERE chat_id = ?", [$chatId]);
    }
    
    public function createGroup($chatId, $title, $username = null, $type = 'group', $addedBy = null) {
        $data = [
            'chat_id' => $chatId,
            'title' => $title,
            'username' => $username,
            'type' => $type,
            'added_by' => $addedBy
        ];
        
        return $this->insert('groups', $data);
    }
    
    public function updateGroup($chatId, $data) {
        return $this->update('groups', $data, 'chat_id = ?', [$chatId]);
    }
    
    public function getActiveGroups() {
        return $this->fetchAll("SELECT * FROM active_groups");
    }
    
    /**
     * Group settings operations
     */
    public function getGroupSetting($groupId, $key) {
        return $this->fetchOne(
            "SELECT setting_value FROM group_settings WHERE group_id = ? AND setting_key = ?",
            [$groupId, $key]
        );
    }
    
    public function setGroupSetting($groupId, $key, $value) {
        $data = [
            'group_id' => $groupId,
            'setting_key' => $key,
            'setting_value' => $value
        ];
        
        try {
            return $this->insert('group_settings', $data);
        } catch (Exception $e) {
            // Update if exists
            return $this->update('group_settings', ['setting_value' => $value], 
                'group_id = ? AND setting_key = ?', [$groupId, $key]);
        }
    }
    
    public function getGroupSettings($groupId) {
        $settings = $this->fetchAll(
            "SELECT setting_key, setting_value FROM group_settings WHERE group_id = ?",
            [$groupId]
        );
        
        $result = [];
        foreach ($settings as $setting) {
            $result[$setting['setting_key']] = $setting['setting_value'];
        }
        
        return $result;
    }
    
    /**
     * Group locks operations
     */
    public function getGroupLocks($groupId) {
        $locks = $this->fetchAll(
            "SELECT lock_type FROM group_locks WHERE group_id = ? AND is_active = 1",
            [$groupId]
        );
        
        $result = [];
        foreach ($locks as $lock) {
            $result[$lock['lock_type']] = true;
        }
        
        return $result;
    }
    
    public function setGroupLock($groupId, $lockType, $active = true) {
        $data = [
            'group_id' => $groupId,
            'lock_type' => $lockType,
            'is_active' => $active
        ];
        
        try {
            return $this->insert('group_locks', $data);
        } catch (Exception $e) {
            // Update if exists
            return $this->update('group_locks', ['is_active' => $active], 
                'group_id = ? AND lock_type = ?', [$groupId, $lockType]);
        }
    }
    
    /**
     * Filtered words operations
     */
    public function getFilteredWords($groupId) {
        $words = $this->fetchAll(
            "SELECT word FROM filtered_words WHERE group_id = ?",
            [$groupId]
        );
        
        $result = [];
        foreach ($words as $word) {
            $result[] = $word['word'];
        }
        
        return $result;
    }
    
    public function addFilteredWord($groupId, $word) {
        $data = [
            'group_id' => $groupId,
            'word' => $word
        ];
        
        return $this->insert('filtered_words', $data);
    }
    
    public function removeFilteredWord($groupId, $word) {
        return $this->delete('filtered_words', 'group_id = ? AND word = ?', [$groupId, $word]);
    }
    
    public function clearFilteredWords($groupId) {
        return $this->delete('filtered_words', 'group_id = ?', [$groupId]);
    }
    
    /**
     * Silent users operations
     */
    public function getSilentUsers($groupId) {
        $users = $this->fetchAll(
            "SELECT user_id FROM silent_users WHERE group_id = ?",
            [$groupId]
        );
        
        $result = [];
        foreach ($users as $user) {
            $result[] = $user['user_id'];
        }
        
        return $result;
    }
    
    public function addSilentUser($groupId, $userId, $reason = null) {
        $data = [
            'group_id' => $groupId,
            'user_id' => $userId,
            'reason' => $reason
        ];
        
        return $this->insert('silent_users', $data);
    }
    
    public function removeSilentUser($groupId, $userId) {
        return $this->delete('silent_users', 'group_id = ? AND user_id = ?', [$groupId, $userId]);
    }
    
    public function clearSilentUsers($groupId) {
        return $this->delete('silent_users', 'group_id = ?', [$groupId]);
    }
    
    /**
     * Tabchi users operations
     */
    public function getTabchiUsers($groupId) {
        $users = $this->fetchAll(
            "SELECT user_id FROM tabchi_users WHERE group_id = ?",
            [$groupId]
        );
        
        $result = [];
        foreach ($users as $user) {
            $result[] = $user['user_id'];
        }
        
        return $result;
    }
    
    public function addTabchiUser($groupId, $userId, $reason = null) {
        $data = [
            'group_id' => $groupId,
            'user_id' => $userId,
            'reason' => $reason
        ];
        
        return $this->insert('tabchi_users', $data);
    }
    
    /**
     * Payment operations
     */
    public function createPayment($groupId, $userId, $amount, $authority = null) {
        $data = [
            'group_id' => $groupId,
            'user_id' => $userId,
            'amount' => $amount,
            'authority' => $authority,
            'status' => 'pending'
        ];
        
        return $this->insert('payments', $data);
    }
    
    public function updatePayment($paymentId, $data) {
        return $this->update('payments', $data, 'id = ?', [$paymentId]);
    }
    
    public function getPaymentByAuthority($authority) {
        return $this->fetchOne(
            "SELECT * FROM payments WHERE authority = ?",
            [$authority]
        );
    }
    
    /**
     * Subscription operations
     */
    public function createSubscription($groupId, $userId, $endDate, $paymentId = null) {
        $data = [
            'group_id' => $groupId,
            'user_id' => $userId,
            'payment_id' => $paymentId,
            'end_date' => $endDate,
            'is_active' => true
        ];
        
        return $this->insert('subscriptions', $data);
    }
    
    public function getActiveSubscription($groupId) {
        return $this->fetchOne(
            "SELECT * FROM subscriptions WHERE group_id = ? AND is_active = 1 AND end_date > NOW()",
            [$groupId]
        );
    }
    
    public function updateSubscription($subscriptionId, $data) {
        return $this->update('subscriptions', $data, 'id = ?', [$subscriptionId]);
    }
    
    /**
     * Logging operations
     */
    public function log($action, $details = null, $groupId = null, $userId = null) {
        $data = [
            'action' => $action,
            'details' => $details,
            'group_id' => $groupId,
            'user_id' => $userId,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
        ];
        
        return $this->insert('logs', $data);
    }
    
    /**
     * Bot settings operations
     */
    public function getBotSetting($key) {
        $setting = $this->fetchOne(
            "SELECT setting_value FROM bot_settings WHERE setting_key = ?",
            [$key]
        );
        
        return $setting ? $setting['setting_value'] : null;
    }
    
    public function setBotSetting($key, $value, $description = null) {
        $data = [
            'setting_key' => $key,
            'setting_value' => $value,
            'description' => $description
        ];
        
        try {
            return $this->insert('bot_settings', $data);
        } catch (Exception $e) {
            // Update if exists
            return $this->update('bot_settings', ['setting_value' => $value], 
                'setting_key = ?', [$key]);
        }
    }
    
    /**
     * Statistics
     */
    public function getGroupStatistics($groupId) {
        return $this->fetchOne(
            "SELECT * FROM group_statistics WHERE id = ?",
            [$groupId]
        );
    }
    
    public function getTotalGroups() {
        $result = $this->fetchOne("SELECT COUNT(*) as count FROM groups WHERE is_active = 1");
        return $result['count'];
    }
    
    public function getTotalUsers() {
        $result = $this->fetchOne("SELECT COUNT(*) as count FROM users");
        return $result['count'];
    }
    
    public function getTotalPayments() {
        $result = $this->fetchOne("SELECT COUNT(*) as count FROM payments WHERE status = 'completed'");
        return $result['count'];
    }
    
    /**
     * Migration helper
     */
    public function migrateFromJson($jsonFile, $groupId) {
        if (!file_exists($jsonFile)) {
            return false;
        }
        
        $data = json_decode(file_get_contents($jsonFile), true);
        if (!$data) {
            return false;
        }
        
        // Migrate settings
        if (isset($data['information'])) {
            foreach ($data['information'] as $key => $value) {
                $this->setGroupSetting($groupId, $key, $value);
            }
        }
        
        // Migrate locks
        if (isset($data['lock'])) {
            foreach ($data['lock'] as $lockType => $value) {
                $this->setGroupLock($groupId, $lockType, $value === '| فعال | ✅');
            }
        }
        
        // Migrate filter words
        if (isset($data['filterlist']) && is_array($data['filterlist'])) {
            foreach ($data['filterlist'] as $word) {
                $this->addFilteredWord($groupId, $word);
            }
        }
        
        // Migrate silent users
        if (isset($data['silentlist']) && is_array($data['silentlist'])) {
            foreach ($data['silentlist'] as $userId) {
                $this->addSilentUser($groupId, $userId);
            }
        }
        
        // Migrate tabchi users
        if (isset($data['tabchilist']) && is_array($data['tabchilist'])) {
            foreach ($data['tabchilist'] as $userId) {
                $this->addTabchiUser($groupId, $userId);
            }
        }
        
        return true;
    }
}
?> 