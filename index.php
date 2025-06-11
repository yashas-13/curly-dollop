<?php
require 'config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch messages
$messages = $db->query('SELECT messages.content, messages.created_at, users.username FROM messages JOIN users ON messages.user_id = users.id ORDER BY messages.created_at DESC')->fetchAll(PDO::FETCH_ASSOC);

// Fetch files
$files = $db->query('SELECT files.id, files.filename, files.original_name, files.size, files.uploaded_at, users.username FROM files JOIN users ON files.user_id = users.id ORDER BY files.uploaded_at DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Team Portal</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
<a href="logout.php" class="btn btn-secondary mb-3">Logout</a>

<?php if (!empty($_SESSION['upload_error'])): ?>
  <div class="alert alert-danger">
    <?php echo htmlspecialchars($_SESSION['upload_error']); unset($_SESSION['upload_error']); ?>
  </div>
<?php endif; ?>

<h3>Post a Message</h3>
<form method="post" action="message.php" class="mb-4">
  <div class="mb-3">
    <textarea name="content" class="form-control" required></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Send</button>
</form>

<h3>Upload a File</h3>
<form method="post" action="upload.php" enctype="multipart/form-data" class="mb-4">
  <div class="mb-3">
    <input type="hidden" name="MAX_FILE_SIZE" value="1073741824">
    <input type="file" name="file" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Upload</button>
</form>

<h3>Messages</h3>
<ul class="list-group mb-4">
<?php foreach ($messages as $msg): ?>
  <li class="list-group-item">
    <strong><?php echo htmlspecialchars($msg['username']); ?>:</strong>
    <?php echo nl2br(htmlspecialchars($msg['content'])); ?>
    <br><small class="text-muted"><?php echo $msg['created_at']; ?></small>
  </li>
<?php endforeach; ?>
</ul>

<h3>Files</h3>
<ul class="list-group">
<?php foreach ($files as $file): ?>
  <li class="list-group-item">
    <a href="uploads/<?php echo urlencode($file['filename']); ?>" download>
      <?php echo htmlspecialchars($file['original_name']); ?>
    </a>
    <br><small class="text-muted">Uploaded by <?php echo htmlspecialchars($file['username']); ?> on <?php echo $file['uploaded_at']; ?> (<?php echo number_format($file['size'] / (1024 * 1024), 2); ?> MB)</small>
  </li>
<?php endforeach; ?>
</ul>
</body>
</html>
