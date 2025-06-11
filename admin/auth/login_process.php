<?php
session_start();
require_once '../includes/db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Get user from database
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if (password_verify($password, $user['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $user['username'];
        header('Location: ../');
        exit();
    } else {
        $_SESSION['error'] = 'Incorrect password.';
    }
} else {
    $_SESSION['error'] = 'User not found.';
}

header('Location: login.php');
exit();
