<?php
require_once 'functions.php';
require_admin();

$users = [];
$res = $conn->query("SELECT id,username,full_name,role,created_at FROM users ORDER BY created_at DESC");
while ($row = $res->fetch_assoc()) $users[] = $row;
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Users</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<link rel="stylesheet" href="assets/css/admin_users.css">
<body class="p-4">
<div class="container">
  <a class="btn btn-secondary mb-3" href="admin_dashboard.php">Back</a>
  <a class="btn btn-primary mb-3 ms-2" href="admin_create_user.php">Create User</a>
  <table class="table table-striped">
    <thead><tr><th>ID</th><th>Username</th><th>Name</th><th>Role</th><th>Created</th></tr></thead>
    <tbody>
    <?php foreach($users as $u): ?>
      <tr>
        <td><?php echo $u['id']; ?></td>
        <td><?php echo htmlspecialchars($u['username']); ?></td>
        <td><?php echo htmlspecialchars($u['full_name']); ?></td>
        <td><?php echo $u['role']; ?></td>
        <td><?php echo $u['created_at']; ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
