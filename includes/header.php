<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Management System</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
<nav>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="/task_management_system/pages/dashboard.php">Dashboard</a> |
        <a href="/task_management_system/pages/create_task.php">Create Task</a> |
        <a href="/task_management_system/auth/logout.php">Logout</a>
    <?php else: ?>
        <a href="/task_management_system/pages/login.php">Login</a> |
        <a href="/task_management_system/pages/register.php">Register</a>
    <?php endif; ?>
</nav>
<hr>
