<?php
$pdo = require '../db.php';
$stmt = $pdo->query("SELECT * FROM themes ORDER BY name ASC");
$themes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Themes</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <h1>Themes</h1>
    <ul>
        <?php foreach ($themes as $theme): ?>
            <li>
                <a href="/theme.php?name=<?= urlencode($theme['name']) ?>">
                    <?= htmlspecialchars($theme['name']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
