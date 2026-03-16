<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        header {
            background: #2d89ef;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 32px;
        }
        h1 {
            margin-top: 0;
        }
        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            margin-top: 32px;
        }
        .feature {
            flex: 1 1 220px;
            background: #eaf1fb;
            border-radius: 6px;
            padding: 20px;
            text-align: center;
        }
        .actions {
            margin-top: 40px;
            text-align: center;
        }
        .actions a {
            display: inline-block;
            margin: 0 12px;
            padding: 12px 28px;
            background: #2d89ef;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }
        .actions a:hover {
            background: #1761a0;
        }
        footer {
            text-align: center;
            color: #888;
            margin-top: 60px;
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include_once 'includes/header.php'; ?>
    <header>
        <h1>Task Management System</h1>
        <p>Organize, track, and manage your tasks efficiently</p> 
    </header>
    <div class="container">
        <h2>Welcome!</h2> 
        <p>
            This Task Management System helps you stay productive by allowing you to create, assign, and monitor tasks with ease.
        </p>
        <div class="features">
            <div class="feature">
                <h3>Create Tasks</h3>
                <p>Add new tasks and set deadlines.</p>
            </div>
            <div class="feature">
                <h3>Assign & Track</h3>
                <p>Assign tasks to team members and monitor progress.</p>
            </div>
            <div class="feature">
                <h3>Notifications</h3>
                <p>Get notified about upcoming deadlines and updates.</p>
            </div>
        </div>
        <div class="actions">
            <a href="pages/login.php">Login</a>
            <a href="pages/register.php">Register</a>
        </div>
    </div>
    <?php include_once 'includes/footer.php'; ?>
</body>
</html>