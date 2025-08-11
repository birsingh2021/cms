<?php
require_once 'functions.php';
require_login();
$id = intval($_GET['id'] ?? 0);

// ensure belongs to user and is resolved
$stmt = $conn->prepare("SELECT id,status FROM complaints WHERE id = ? AND user_id = ?");
$stmt->bind_param('ii', $id, $_SESSION['user_id']);
$stmt->execute();
$c = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$c) die('Not found');
if ($c['status'] !== 'resolved') die('Cannot confirm unless resolved');

$now = date('Y-m-d H:i:s');
$stmt = $conn->prepare("UPDATE complaints SET status='confirmed', confirmed_at=? WHERE id = ?");
$stmt->bind_param('si', $now, $id);
$stmt->execute();
$stmt->close();
header('Location: user_dashboard.php');
exit;
