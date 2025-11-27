<?php
require_once __DIR__ . '/../db_connect.php';
session_start();
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === '' || $password === '') {
        $errors[] = 'Enter username and password';
    } else {
        $stmt = $conn->prepare("SELECT id, password_hash, full_name FROM admins WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
            if (password_verify($password, $row['password_hash'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_name'] = $row['full_name'] ?? $username;
                header('Location: /admin/dashboard.php');
                exit;
            } else {
                $errors[] = 'Invalid credentials';
            }
        } else {
            $errors[] = 'Invalid credentials';
        }
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Login</title>
<link href="/frontend/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container" style="max-width:420px; margin-top:80px;">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title mb-4">Admin Login</h4>
      <?php foreach($errors as $e): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($e); ?></div>
      <?php endforeach; ?>
      <form method="post" novalidate>
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input name="username" class="form-control" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control">
        </div>
        <button class="btn btn-primary w-100">Login</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>
