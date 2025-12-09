<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Setup Complete</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header class="site-header">
            <div class="site-brand">
                <h1>LAN Exam Web Application</h1>
            </div>
            <nav class="site-nav"><a class="btn btn-ghost" href="index.php">Home</a></nav>
        </header>

        <main class="main" style="grid-template-columns:1fr;">
            <section class="card form-container">
                <h2>Database Setup Complete</h2>
                <p>Your database and tables have been created.</p>
                <a class="btn btn-primary" href="index.php">Go to Home</a>
            </section>
        </main>

        <footer class="site-footer"></footer>
    </div>
</body>

</html>