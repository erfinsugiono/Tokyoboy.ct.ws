<?php
session_start();

$db = require '../db.php';

if (!$db) {
    die("Database connection failed. Please try again later.");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->execute([$_POST['username'], $_POST['password']]);
    $user = $stmt->fetch();

    if ($user) {
        // Store session data
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // 'admin' or 'user'
        $_SESSION['logged_in'] = true;

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: dashboard.php");
        } else {
            header("Location: user-dashboard.php");
        }
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="post">
        Username: <input name="username"><br>
        Password: <input type="password" name="password"><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
