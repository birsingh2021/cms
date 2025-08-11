<?php
require_once 'functions.php';
require_admin();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"><title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body class="p-4">
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container-fluid">
    <a class="navbar-brand">Admin</a>
    <div class="d-flex">
      <a class="btn btn-outline-primary me-2" href="admin_users.php">Manage Users</a>
      <a class="btn btn-outline-secondary me-2" href="admin_complaints.php">View Complaints</a>
      <a class="btn btn-outline-success" href="export_report.php">Export Today's Report</a>
      <a class="btn btn-danger ms-3" href="logout.php">Logout</a>
    </div>
  </div>
</nav>

<div class="container">
  <h4>Welcome, <?php echo htmlspecialchars($_SESSION['full_name'] ?? $_SESSION['username']); ?></h4>
  <p>Use the menu to manage users and complaints.</p>
</div>
</body>
</html>
