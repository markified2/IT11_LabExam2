<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAN Exam Web Application</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header class="site-header">
            <div class="site-brand">
                <h1>LAN Exam Web Application</h1>
            </div>
            <nav class="site-nav">
                <?php if (isset($_SESSION['username'])): ?>
                    <a class="btn btn-ghost" href="chat.php">Chat</a>
                    <a class="btn btn-danger" href="logout.php">Logout</a>
                <?php else: ?>
                    <a class="btn btn-primary" href="login.php">Login</a>
                    <a class="btn btn-accent" href="register.php">Register</a>
                <?php endif; ?>
            </nav>
        </header>

        <main class="main">
            <section class="card welcome-section">
                <h2>Welcome to the Laboratory Exam</h2>
                <p>This application demonstrates:</p>
                <ul>
                    <li>User Registration</li>
                    <li>User Login</li>
                    <li>Simple Messaging System</li>
                    <li>LAN Connectivity</li>
                    <?php if (file_exists('ssl')): ?>
                        <li>HTTPS Implementation (Bonus)</li>
                    <?php endif; ?>
                </ul>
            </section>

            <aside class="side">
                <div class="card">
                    <?php if (isset($_SESSION['username'])): ?>
                        <p class="small">Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
                        <a class="btn btn-primary" href="chat.php">Go to Chat</a>
                        <a class="btn btn-ghost" href="logout.php">Logout</a>
                    <?php else: ?>
                        <a class="btn btn-primary" href="login.php">Login</a>
                        <a class="btn btn-accent" href="register.php">Register</a>
                    <?php endif; ?>
                </div>
            </aside>
        </main>

        <footer class="site-footer">
        </footer>
    </div>
</body>

</html>