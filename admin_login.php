<?php
session_start();

// Hardcoded credentials
$admin_user = "admin";
$admin_pass = "admin123";

// Get submitted values
$username = $_POST['username'];
$password = $_POST['password'];

// Check
if ($username === $admin_user && $password === $admin_pass) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "<script>alert('Invalid credentials!'); window.location.href='admin_login.html';</script>";
}
?>