<?php
include 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: chat.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
                <a class="btn btn-accent" href="register.php">Register</a>
            </nav>
        </header>

        <main class="main" style="grid-template-columns:1fr;">
            <section class="card form-container">
                <h2>User Login</h2>

                <?php if ($error): ?>
                    <div class="alert alert-error"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>

                <p class="small">Don't have an account? <a href="register.php">Register here</a></p>
            </section>
        </main>

        <footer class="site-footer"></footer>
    </div>
</body>

</html>