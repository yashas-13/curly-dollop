<?php
require 'config.php';

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $stmt = $db->prepare('INSERT INTO users(username, password) VALUES (?, ?)');
    try {
        $stmt->execute([
            $_POST['username'],
            password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);
        header('Location: login.php');
        exit;
    } catch (Exception $e) {
        $error = 'Username already taken.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
<h2>Register</h2>
<?php if (!empty($error)) echo '<div class="alert alert-danger">'.$error.'</div>'; ?>
<form method="post">
  <div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" name="username" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
  <a href="login.php" class="btn btn-link">Login</a>
</form>
</body>
</html>
