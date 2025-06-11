<?php
require 'config.php';
// allow larger uploads up to 1GB if possible
@ini_set('upload_max_filesize', '1024M');
@ini_set('post_max_size', '1024M');

// 1GB size limit in bytes
$maxSize = 1073741824;
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!empty($_FILES['file']['name'])) {
    if ($_FILES['file']['size'] > $maxSize) {
        $_SESSION['upload_error'] = 'File exceeds 1GB size limit.';
    } elseif ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $filename = uniqid() . '_' . basename($_FILES['file']['name']);
        $targetFile = $uploadDir . $filename;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            $stmt = $db->prepare('INSERT INTO files(user_id, filename, original_name, size) VALUES (?, ?, ?, ?)');
            $stmt->execute([
                $_SESSION['user_id'],
                $filename,
                $_FILES['file']['name'],
                $_FILES['file']['size']
            ]);
        }
    }
}
header('Location: index.php');
?>
