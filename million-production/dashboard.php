<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
echo "Welcome, " . $_SESSION['admin'];
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h1>Welcome, <?= $_SESSION['admin'] ?>!</h1>
    <ul>
        <li><a href="users.php">Manage Users</a></li>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="million-production.php">Add Post</a></li>
        <li><a href="edit_post_dashboard.php">Edit Post</a></li>
    </ul>
</body>
</html>