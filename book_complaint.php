<?php
require_once 'functions.php';
require_login();

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $desc = trim($_POST['description'] ?? '');
    if ($title && $desc) {
        $stmt = $conn->prepare("INSERT INTO complaints (user_id,title,description) VALUES (?,?,?)");
        $stmt->bind_param('iss', $_SESSION['user_id'], $title, $desc);
        if ($stmt->execute()) {
            $msg = 'Complaint booked successfully.';
        } else {
            $msg = 'Error: '.$stmt->error;
        }
        $stmt->close();
    } else {
        $msg = 'Fill title & description';
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Book Complaint</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script>
function validateForm() {
  const t = document.querySelector('[name=title]').value.trim();
  const d = document.querySelector('[name=description]').value.trim();
  if (!t || !d) { alert('Fill all fields'); return false; }
  return true;
}
</script>
</head>
<body class="p-4">
<div class="container">
  <a class="btn btn-secondary mb-3" href="user_dashboard.php">Back</a>
  <?php if($msg): ?><div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
  <form method="post" onsubmit="return validateForm();" class="card p-3">
    <div class="mb-3"><label>Title</label><input name="title" class="form-control" required></div>
    <div class="mb-3"><label>Description</label><textarea name="description" class="form-control" rows="5" required></textarea></div>
    <button class="btn btn-primary">Submit Complaint</button>
  </form>
</div>
</body>
</html>
