<?php
// tasks/update_task.php
require_once '../config/database.php';
require_once '../includes/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId      = $_SESSION['user_id'];
    $taskId      = $_POST['id'] ?? null;
    $title       = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status      = $_POST['status'] ?? 'pending';

    if (!$taskId || !ctype_digit($taskId)) {
        header('Location: ../pages/dashboard.php');
        exit;
    }

    if ($title === '') {
        header('Location: ../pages/edit_task.php?id=' . urlencode($taskId) . '&error=Title is required');
        exit;
    }

    if (!in_array($status, ['pending', 'completed'], true)) {
        $status = 'pending';
    }

    // Update only if task belongs to user
    $stmt = $pdo->prepare("
        UPDATE tasks
        SET title = :title, description = :description, status = :status
        WHERE id = :id AND user_id = :user_id
    ");
    $stmt->execute([
        'title'       => $title,
        'description' => $description,
        'status'      => $status,
        'id'          => $taskId, 
        'user_id'     => $userId,
    ]);

    header('Location: ../pages/dashboard.php');
    exit;
} else {
    header('Location: ../pages/dashboard.php');
    exit;
}
