<!-- pages/create_task.html -->
 <link rel="stylesheet" href="/task-management-system/styles.css">
<?php
require_once '../includes/auth_check.php';
include_once '../includes/header.php';
?>
<h2>Create Task</h2>

<?php if (isset($_GET['error'])): ?>
    <p style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
<?php endif; ?>

<form action="../tasks/create_task.php" method="post">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="40"></textarea><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
    </select><br><br>

    <button type="submit">Save Task</button>
</form>

<p><a href="dashboard.php">Back to Dashboard</a></p>
<?php include_once '../includes/footer.php'; ?>
