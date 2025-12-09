<?php
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $message = $_POST['message'];
    $sql = "INSERT INTO messages (username, message) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $message);
    $stmt->execute();
    $stmt->close();

    header("Location: chat.php");
    exit();
}

$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chat Room - Exam App</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header class="site-header">
            <div class="site-brand">
                <h1>LAN Exam Web Application</h1>
            </div>
            <nav class="site-nav">
                <a class="btn btn-ghost" href="index.php">Home</a>
                <a class="btn btn-ghost" href="logout.php">Logout</a>
            </nav>
        </header>

        <main class="main" style="grid-template-columns:1fr;">
            <section class="card">
                <div class="chat-header">
                    <h2>Simple Messaging System</h2>
                    <p class="small">Welcome, <strong><?php echo htmlspecialchars($username); ?></strong></p>
                </div>

                <div class="chat-container" id="chat-box">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="message">
                                <div><span class="user"><?php echo htmlspecialchars($row['username']); ?></span>
                                    <span><?php echo htmlspecialchars($row['message']); ?></span>
                                </div>
                                <div class="time"><?php echo $row['created_at']; ?></div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No messages yet. Be the first to send one!</p>
                    <?php endif; ?>
                </div>

                <div class="message-form">
                    <h3>Send a Message</h3>
                    <form method="POST" action="">
                        <div class="form-group">
                            <textarea name="message" rows="3" placeholder="Type your message here..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </section>
        </main>

        <footer class="site-footer"></footer>
    </div>

    <script>
        var chatBox = document.getElementById('chat-box');
        if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
    </script>
</body>

</html>