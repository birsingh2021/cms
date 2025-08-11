<?php
// functions.php
require_once 'config.php';

function is_logged_in() {
    return !empty($_SESSION['user_id']);
}

function is_admin() {
    return (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: index.php');
        exit;
    }
}

function require_admin() {
    if (!is_admin()) {
        header('Location: index.php');
        exit;
    }
}

function get_user_by_id($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT id,username,full_name,role FROM users WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $res;
}
