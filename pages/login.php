<!-- pages/login.html -->
<link rel="stylesheet" href="/task-management-system/styles.css">
<?php include_once '../includes/header.php'; ?>
<h2>Login</h2>

<?php if (isset($_GET['error'])): ?>
    <p style="color:green;"><?php echo htmlspecialchars($_GET['error']); ?></p>
<?php endif; ?>

<form action="../auth/login.php" method="post">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>
<?php include_once '../includes/footer.php'; ?>
