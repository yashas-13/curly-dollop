<?php
// Configuration
session_start();

// Path to SQLite database file
$dbFile = __DIR__ . '/data.sqlite';

try {
    $db = new PDO('sqlite:' . $dbFile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Could not connect to database: ' . $e->getMessage());
}
?>
