<?php
require_once 'functions.php';
require_admin();

$id = intval($_GET['id'] ?? 0);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = trim($_POST['note'] ?? '');
    $status = 'resolved';
    $now = date('Y-m-d H:i:s');
    $admin_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("UPDATE complaints SET status=?, resolution_note=?, resolved_at=?, assigned_to=? WHERE id=?");
    $stmt->bind_param('ssssi', $status, $note, $now, $admin_id, $id);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_complaints.php');
    exit;
}

// fetch complaint
$stmt = $conn->prepare("SELECT * FROM complaints WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$complaint = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$complaint) die('Not found');
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Resolve</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="p-4">
<div class="container">
  <a class="btn btn-secondary mb-3" href="admin_complaints.php">Back</a>
  <h4>Resolve Complaint #<?php echo $complaint['id']; ?></h4>
  <div class="card p-3 mb-3">
    <h5><?php echo htmlspecialchars($complaint['title']); ?></h5>
    <p><?php echo nl2br(htmlspecialchars($complaint['description'])); ?></p>
  </div>
  <form method="post">
    <div class="mb-3">
      <label>Resolution Note</label>
      <textarea name="note" class="form-control" rows="4" required></textarea>
    </div>
    <button class="btn btn-success">Mark as Resolved</button>
  </form>
</div>
</body>
</html>
