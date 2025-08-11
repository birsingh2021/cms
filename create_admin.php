<?php
require_once 'config.php';
$username = 'admin';
$password = 'Admin@123'; // change
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (username,password,full_name,role) VALUES (?,?,?,?)");
$full = 'Administrator';
$role = 'admin';
$stmt->bind_param('ssss', $username, $hash, $full, $role);
if ($stmt->execute()) echo "Admin created. username: $username password: $password\n";
else echo "Error: ".$stmt->error;
