
<?php
// pages/dashboard.php
require_once '../config/database.php';
require_once '../includes/auth_check.php';
include_once '../includes/header.php';

$userId = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];

// Search
$search = trim($_GET['search'] ?? '');
$query = "SELECT * FROM tasks WHERE user_id = :user_id";
$params = ['user_id' => $userId];

if ($search !== '') {
    $query .= " AND (title LIKE :search OR description LIKE :search)";
    $params['search'] = '%' . $search . '%';
}

$query .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$tasks = $stmt->fetchAll();

// Simple stats
$statsStmt = $pdo->prepare("
    SELECT 
        COUNT(*) AS total,
        SUM(status = 'pending') AS pending,
        SUM(status = 'completed') AS completed
    FROM tasks
    WHERE user_id = ?
");
$statsStmt->execute([$userId]);
$stats = $statsStmt->fetch();
?>
<div class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($userName); ?></h2>

<h3>Dashboard Statistics</h3>
<ul>
    <li><strong>Total tasks:</strong> <?php echo $stats['total'] ?? 0; ?></li>
    <li><strong>Pending:</strong> <?php echo $stats['pending'] ?? 0; ?></li>
    <li><strong>Completed:</strong> <?php echo $stats['completed'] ?? 0; ?></li>
</ul>

<form method="get" action="dashboard.php">
    <label><strong>Search tasks:</strong></label>
    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Search</button>
</form>

<p><a href="create_task.php">Create New Task</a></p>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    <?php if ($tasks): ?>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?php echo htmlspecialchars($task['title']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($task['description'])); ?></td>
                <td><?php echo htmlspecialchars($task['status']); ?></td>
                <td><?php echo htmlspecialchars($task['created_at']); ?></td>
                <td>
                    <a href="edit_task.php?id=<?php echo $task['id']; ?>">Edit</a> |
                    <a href="../tasks/delete_task.php?id=<?php echo $task['id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this task?');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="5">No tasks found.</td></tr>
    <?php endif; ?>
</table>
</div>

<?php include_once '../includes/footer.php'; ?>
