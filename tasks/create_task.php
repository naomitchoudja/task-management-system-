<?php
// tasks/create_task.php
require_once '../config/database.php';
require_once '../includes/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId      = $_SESSION['user_id'];
    $title       = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status      = $_POST['status'] ?? 'pending';

    if ($title === '') {
        header('Location: ../pages/create_task.php?error=Title is required');
        exit;
    }

    if (!in_array($status, ['pending', 'completed'], true)) {
        $status = 'pending';
    }

    $stmt = $pdo->prepare("
        INSERT INTO tasks (user_id, title, description, status)
        VALUES (:user_id, :title, :description, :status)
    ");
    $stmt->execute([
        'user_id'     => $userId,
        'title'       => $title,
        'description' => $description,
        'status'      => $status,
    ]);

    header('Location: ../pages/dashboard.php');
    exit;
} else {
    header('Location: ../pages/create_task.php');
    exit;
}
