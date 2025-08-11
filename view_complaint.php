<?php
require_once 'functions.php';
require_admin(); // Admin and users may view; we restrict to admin for now
$id = intval($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT c.*, u.username, u.full_name FROM complaints c JOIN users u ON u.id = c.user_id WHERE c.id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$complaint = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$complaint) {
    die('Not found');
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Complaint</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="p-4">
<div class="container">
  <a class="btn btn-secondary mb-3" href="admin_complaints.php">Back</a>
  <div class="card">
    <div class="card-body">
      <h5><?php echo htmlspecialchars($complaint['title']); ?></h5>
      <p><strong>By:</strong> <?php echo htmlspecialchars($complaint['username']); ?> (<?php echo htmlspecialchars($complaint['full_name']); ?>)</p>
      <p><strong>Description:</strong><br><?php echo nl2br(htmlspecialchars($complaint['description'])); ?></p>
      <p><strong>Status:</strong> <?php echo $complaint['status']; ?></p>
      <?php if ($complaint['resolution_note']): ?>
        <hr>
        <h6>Resolution Note</h6>
        <p><?php echo nl2br(htmlspecialchars($complaint['resolution_note'])); ?></p>
        <p><small>Resolved at: <?php echo $complaint['resolved_at']; ?></small></p>
      <?php endif; ?>
    </div>
  </div>
</div>
</body>
</html>
