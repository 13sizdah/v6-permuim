<?php
/**
 * Database Helper Functions
 * Lightweight wrappers around Database class for common bot operations
 */

require_once __DIR__ . '/Database.php';

// Get shared Database instance
function getDB() {
    return Database::getInstance();
}

// Users
function getUserData($userId) {
    return getDB()->getUser($userId);
}

function saveUser($userId, $username = null, $firstName = null, $lastName = null) {
    $db = getDB();
    $existing = $db->getUser($userId);
    if (!$existing) {
        return $db->createUser($userId, $username, $firstName, $lastName);
    }
    $updates = [];
    if ($username) { $updates['username'] = $username; }
    if ($firstName) { $updates['first_name'] = $firstName; }
    if ($lastName) { $updates['last_name'] = $lastName; }
    if (!empty($updates)) {
        $db->updateUser($userId, $updates);
    }
    return $existing['id'] ?? null;
}

// Groups
function getGroupData($chatId) {
    return getDB()->getGroup($chatId);
}

function saveGroup($chatId, $title, $username = null, $type = 'group', $addedBy = null) {
    $db = getDB();
    $existing = $db->getGroup($chatId);
    if (!$existing) {
        return $db->createGroup($chatId, $title, $username, $type, $addedBy);
    }
    $updates = [ 'title' => $title ];
    if ($username !== null) { $updates['username'] = $username; }
    if ($type !== null) { $updates['type'] = $type; }
    if ($addedBy !== null) { $updates['added_by'] = $addedBy; }
    $db->updateGroup($chatId, $updates);
    return $existing['id'] ?? null;
}

// Group settings
function getGroupSetting($groupId, $key) {
    $db = getDB();
    $row = $db->getGroupSetting($groupId, $key);
    if (is_array($row) && array_key_exists('setting_value', $row)) {
        return $row['setting_value'];
    }
    return $row;
}

function setGroupSetting($groupId, $key, $value) {
    return getDB()->setGroupSetting($groupId, $key, $value);
}

function getGroupSettings($groupId) {
    return getDB()->getGroupSettings($groupId);
}