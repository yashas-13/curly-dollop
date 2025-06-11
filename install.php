<?php
require 'config.php';

// Create tables if they do not exist
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE,
    password TEXT
);");

$db->exec("CREATE TABLE IF NOT EXISTS messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    content TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES users(id)
);");

$db->exec("CREATE TABLE IF NOT EXISTS files (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    filename TEXT,
    original_name TEXT,
    uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES users(id)
);");

// If there are no users, create default admin
$stmt = $db->query('SELECT COUNT(*) FROM users');
if ($stmt->fetchColumn() == 0) {
    $db->prepare('INSERT INTO users(username, password) VALUES (?, ?)')
       ->execute(['admin', password_hash('admin', PASSWORD_DEFAULT)]);
    echo "Created default admin user (username: admin, password: admin)\n";
}

echo "Installation complete.\n";
?>
