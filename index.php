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
        <header>
            <h1>LAN Exam Web Application</h1>
            <p class="subtitle">Network Traffic Analysis Laboratory</p>
            <div class="server-info">
                <p><strong>Server IP:</strong> <?php echo $_SERVER['SERVER_ADDR'] ?? 'Localhost'; ?></p>
                <p><strong>Your IP:</strong> <?php echo $_SERVER['REMOTE_ADDR']; ?></p>
                <p><strong>Port:</strong> 80 (HTTP) / 443 (HTTPS)</p>
            </div>
        </header>

        <div class="main-content">
            <div class="welcome-section">
                <h2>Welcome to the Laboratory Exam</h2>
                <p>This application demonstrates:</p>
                <ul>
                    <li>User Registration (plain text passwords)</li>
                    <li> User Login</li>
                    <li> Simple Messaging System</li>
                    <li> LAN Connectivity</li>
                    <li> Wireshark Traffic Analysis</li>
                    <?php if(file_exists('ssl')): ?>
                    <li> HTTPS Implementation (Bonus)</li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="auth-buttons">
                <?php if(isset($_SESSION['username'])): ?>
                    <p>Welcome, <strong><?php echo $_SESSION['username']; ?></strong>!</p>
                    <a href="chat.php" class="btn btn-chat">Go to Chat</a>
                    <a href="logout.php" class="btn btn-logout">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-login">Login</a>
                    <a href="register.php" class="btn btn-register">Register</a>
                <?php endif; ?>
            </div>

            <div class="instructions">
                <h3> Wireshark Analysis Instructions:</h3>
                <ol>
                    <li>Filter by HTTP: <code>http</code></li>
                    <li>Filter by IP: <code>ip.addr == YOUR_SERVER_IP</code></li>
                    <li>Observe POST requests for login/registration</li>
                    <li>Examine form data in packet details</li>
                </ol>
            </div>
        </div>

        <footer>
            <p>Laboratory Exam - Network Traffic Analysis</p>
        </footer>
    </div>
</body>
</html>