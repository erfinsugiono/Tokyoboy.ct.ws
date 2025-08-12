<?php
$db = require '../db.php';

$theme = $_GET['name'] ?? '';
if (!$theme) die("No theme provided.");

$stmt = $db->prepare("
    SELECT p.* FROM posts p
    JOIN post_themes pt ON p.id = pt.post_id
    JOIN themes t ON pt.theme_id = t.id
    WHERE t.name = ?
");
$stmt->execute([$theme]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Theme: <?= htmlspecialchars($theme) ?></title>
    <link rel="stylesheet" href="/themes/style.css"> <!-- adjust path if needed -->
</head>
<body>
    <div class="header">
        <h1><a href="/">My Blog Title</a></h1>
        <p>Posts by Theme</p>
    </div>

    <div class="container">
        <h1>Theme: <?= htmlspecialchars($theme) ?></h1>
        
        <?php foreach ($posts as $post): ?>
			<div class="post-preview">
				<h2><a href="/post.php?anime=<?= urlencode($post['slug']) ?>"><?= htmlspecialchars($post['title']) ?>"></a></h2>
				<img src="/<?= htmlspecialchars($post['image_path']) ?>" width="200">
                 <p><?= htmlspecialchars(substr($post['content'], 0, 150)) ?>...</p>
			</div>
        <?php endforeach; ?>
        
    </div>
</body>
</html>
