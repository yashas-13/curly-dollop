<?php
require 'config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!empty($_FILES['file']['name'])) {
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $filename = uniqid() . '_' . basename($_FILES['file']['name']);
    $targetFile = $uploadDir . $filename;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        $stmt = $db->prepare('INSERT INTO files(user_id, filename, original_name) VALUES (?, ?, ?)');
        $stmt->execute([$_SESSION['user_id'], $filename, $_FILES['file']['name']]);
    }
}
header('Location: index.php');
?>
