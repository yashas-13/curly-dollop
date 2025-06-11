<?php
require 'config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!empty($_POST['content'])) {
    $stmt = $db->prepare('INSERT INTO messages(user_id, content) VALUES (?, ?)');
    $stmt->execute([$_SESSION['user_id'], $_POST['content']]);
}
header('Location: index.php');
?>
