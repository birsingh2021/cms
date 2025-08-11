<?php
require_once 'functions.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assign_id'])) {
    // assign or update status via posted fields (not required)
}

$q = "SELECT c.*, u.username as reported_by, ua.username AS assigned_username
      FROM complaints c
      JOIN users u ON u.id = c.user_id
      LEFT JOIN users ua ON ua.id = c.assigned_to
      ORDER BY c.created_at DESC";
$res = $conn->query($q);
$complaints = [];
while ($r = $res->fetch_assoc()) $complaints[] = $r;
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Complaints</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/admin_complaints.css">
</head>
<body class="p-4">
<div class="container">
  <a class="btn btn-secondary mb-3" href="admin_dashboard.php">Back</a>
  <table class="table table-bordered">
    <thead><tr><th>ID</th><th>Title</th><th>Reported By</th><th>Status</th><th>Created</th><th>Actions</th></tr></thead>
    <tbody>
    <?php foreach($complaints as $c): ?>
      <tr>
        <td><?php echo $c['id']; ?></td>
        <td><?php echo htmlspecialchars($c['title']); ?></td>
        <td><?php echo htmlspecialchars($c['reported_by']); ?></td>
        <td><?php echo $c['status']; ?></td>
        <td><?php echo $c['created_at']; ?></td>
        <td>
          <a class="btn btn-sm btn-info" href="view_complaint.php?id=<?php echo $c['id']; ?>">View</a>
          <?php if ($c['status'] !== 'resolved' && $c['status'] !== 'confirmed'): ?>
            <a class="btn btn-sm btn-success" href="resolve_complaint.php?id=<?php echo $c['id']; ?>">Resolve</a>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
