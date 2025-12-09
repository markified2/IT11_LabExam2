<?php
include 'config.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $success = "Registration successful! You can now login.";
        header("refresh:2;url=login.php");
    } else {
        if ($conn->errno == 1062) {
            $error = "Username already exists!";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register - Exam App</title>
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
                <a class="btn btn-primary" href="login.php">Login</a>
            </nav>
        </header>

        <main class="main" style="grid-template-columns:1fr;">
            <section class="card form-container">
                <h2>User Registration</h2>

                <?php if ($error): ?>
                    <div class="alert alert-error"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
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

                    <button type="submit" class="btn btn-accent">Register</button>
                </form>

                <p class="small">Already have an account? <a href="login.php">Login here</a></p>
            </section>
        </main>

        <footer class="site-footer"></footer>
    </div>
</body>

</html>