<?php
// auth/login.php
require_once '../config/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' && $password === '') {
        header('Location: ../pages/login.php?error=All fields are required');
        exit;
    }

    $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: ../pages/dashboard.php'); 
        exit;
    } else {
        header('Location: ../pages/login.php?error=Invalid credentials');
        exit;
    }
} else {
    header('Location: ../pages/login.php');
    exit;
}
