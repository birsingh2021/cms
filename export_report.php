<?php
require_once 'functions.php';
require_admin();

$today = date('Y-m-d');
$start = $today . ' 00:00:00';
$end   = $today . ' 23:59:59';

// fetch complaints for today
$stmt = $conn->prepare("SELECT c.id, c.title, c.description, c.status, c.created_at, c.resolved_at, c.confirmed_at, u.username, u.full_name
  FROM complaints c
  JOIN users u ON u.id = c.user_id
  WHERE c.created_at BETWEEN ? AND ?
  ORDER BY c.created_at ASC");
$stmt->bind_param('ss', $start, $end);
$stmt->execute();
$rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=complaints_' . $today . '.csv');

$out = fopen('php://output', 'w');
fputcsv($out, ['ID','Title','Description','Status','Created At','Resolved At','Confirmed At','Username','Full Name']);
foreach ($rows as $r) {
    fputcsv($out, [
        $r['id'],
        $r['title'],
        $r['description'],
        $r['status'],
        $r['created_at'],
        $r['resolved_at'],
        $r['confirmed_at'],
        $r['username'],
        $r['full_name']
    ]);
}
fclose($out);
exit;
