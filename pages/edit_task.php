<link rel="stylesheet" href="/task-management-system/styles.css">
<?php
// pages/edit_task.php
require_once '../config/database.php';
require_once '../includes/auth_check.php';
include_once '../includes/header.php';

$userId = $_SESSION['user_id'];
$taskId = $_GET['id'] ?? null;

if (!$taskId || !ctype_digit($taskId)) {
    echo "<p>Invalid task ID.</p>";
    include_once '../includes/footer.php';
    exit;
}

// Ensure task belongs to logged-in user
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id AND user_id = :user_id");
$stmt->execute(['id' => $taskId, 'user_id' => $userId]);
$task = $stmt->fetch();

if (!$task) {
    echo "<p>Task not found or you do not have permission to edit it.</p>";
    include_once '../includes/footer.php';
    exit;
}
?>

<h2>Edit Task</h2>

<form action="../tasks/update_task.php" method="post">
    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">

    <label>Title:</label><br>
    <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="40"><?php echo htmlspecialchars($task['description']); ?></textarea><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option value="pending"   <?php if ($task['status'] === 'pending')   echo 'selected'; ?>>Pending</option>
        <option value="completed" <?php if ($task['status'] === 'completed') echo 'selected'; ?>>Completed</option>
    </select><br><br>

    <button type="submit">Update Task</button>
</form>

<p><a href="dashboard.php">Back to Dashboard</a></p>
<?php include_once '../includes/footer.php'; ?>
