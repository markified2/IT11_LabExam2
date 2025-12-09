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
    <style>
        .chat-container {
            max-height: 500px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }
        
        .message {
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: white;
            border-left: 4px solid #007bff;
        }
        
        .message .user {
            font-weight: bold;
            color: #007bff;
        }
        
        .message .time {
            font-size: 0.8em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="chat-header">
            <h2>Simple Messaging System</h2>
            <p>Welcome, <strong><?php echo $username; ?></strong> | <a href="logout.php">Logout</a></p>
        </div>
        
        <div class="chat-container" id="chat-box">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="message">
                        <span class="user"><?php echo htmlspecialchars($row['username']); ?>:</span>
                        <span><?php echo htmlspecialchars($row['message']); ?></span>
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
                <button type="submit" class="btn btn-send">Send Message</button>
            </form>
        </div>
        
        <div class="wireshark-tips">
            <h3>🔍 Wireshark Analysis Tips:</h3>
            <ul>
                <li>Filter for HTTP POST requests: <code>http.request.method == POST</code></li>
                <li>Follow HTTP stream to see raw data</li>
                <li>Compare unencrypted vs encrypted (HTTPS) traffic</li>
                <li>Note the content-length and content-type headers</li>
            </ul>
        </div>
        
        <a href="index.php" class="btn btn-back">Back to Home</a>
    </div>
    
    <script>
        document.getElementById('chat-box').scrollTop = document.getElementById('chat-box').scrollHeight;
    </script>
</body>
</html>