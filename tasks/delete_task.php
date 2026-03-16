<?php
// tasks/delete_task.php
require_once '../config/database.php';
require_once '../includes/auth_check.php';

$userId = $_SESSION['user_id'];
$taskId = $_GET['id'] ?? null;

if ($taskId && ctype_digit($taskId)) {
    // Delete only if task belongs to user
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'id'      => $taskId,
        'user_id' => $userId,
    ]);
}

header('Location: ../pages/dashboard.php');
exit;
