<?php
require_once 'functions.php';
require_admin();

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $full_name = trim($_POST['full_name'] ?? '');
    $role = $_POST['role'] === 'admin' ? 'admin' : 'user';

    if ($username && $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username,password,full_name,role) VALUES (?,?,?,?)");
        $stmt->bind_param('ssss', $username, $hash, $full_name, $role);
        if ($stmt->execute()) {
            $msg = 'User created successfully.';
        } else {
            $msg = 'Error: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $msg = 'Fill username & password';
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Create User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="p-4">
<div class="container">
  <a class="btn btn-secondary mb-3" href="admin_users.php">Back</a>
  <?php if($msg): ?><div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
  <form method="post" class="card p-3">
    <div class="mb-3"><label>Username</label><input name="username" required class="form-control"></div>
    <div class="mb-3"><label>Password</label><input name="password" type="password" required class="form-control"></div>
    <div class="mb-3"><label>Full Name</label><input name="full_name" class="form-control"></div>
    <div class="mb-3">
      <label>Role</label>
      <select name="role" class="form-select">
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select>
    </div>
    <button class="btn btn-primary">Create</button>
  </form>
</div>
</body>
</html>
