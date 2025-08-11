<?php
require_once 'functions.php';
require_login();

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM complaints WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$complaints = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>User Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/user_dashboard.css">
<style>
/* paste the above CSS here */
</style>

</head>
<body class="p-4">
<nav class="navbar bg-light mb-4">
  <div class="container-fluid">
    <span class="navbar-brand">Welcome, <?php echo htmlspecialchars($_SESSION['full_name'] ?? $_SESSION['username']); ?></span>
    <div>
      <a class="btn btn-primary me-2" href="book_complaint.php">Book Complaint</a>
      <a class="btn btn-danger" href="logout.php">Logout</a>
    </div>
  </div>
</nav>

<div class="container">
  <h5>Your Complaints</h5>
  <table class="table">
    <thead><tr><th>ID</th><th>Title</th><th>Status</th><th>Created</th><th>Action</th></tr></thead>
    <tbody>
    <?php foreach($complaints as $c): ?>
      <tr>
        <td><?php echo $c['id']; ?></td>
        <td><?php echo htmlspecialchars($c['title']); ?></td>
        <td><?php echo $c['status']; ?></td>
        <td><?php echo $c['created_at']; ?></td>
        <td>
          <a class="btn btn-sm btn-info" href="view_complaint_user.php?id=<?php echo $c['id']; ?>">View</a>
          <?php if ($c['status'] === 'resolved'): ?>
            <a class="btn btn-sm btn-success" href="confirm_resolution.php?id=<?php echo $c['id']; ?>">Confirm</a>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
