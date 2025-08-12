<?php
$db = require '../db.php';
$genreName = $_GET['name'] ?? '';

$stmt = $db->prepare("
    SELECT p.* FROM posts p
    JOIN post_genres pg ON p.id = pg.post_id
    JOIN genres g ON g.id = pg.genre_id
    WHERE g.name = ?
");
$stmt->execute([$genreName]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Genre: <?= htmlspecialchars($genreName) ?></title>
    <link rel="stylesheet" href="/themes/style.css">
</head>
<body>
    <h1>Genre: <?= htmlspecialchars($genreName) ?></h1>
    <?php foreach ($posts as $post): ?>
        <div class="post-preview">
            <h2><a href="/post.php?anime=<?= urlencode($post['slug']) ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
            <img src="/<?= htmlspecialchars($post['image_path']) ?>" width="200">
            <p><?= htmlspecialchars(substr($post['content'], 0, 150)) ?>...</p>
        </div>
    <?php endforeach; ?>
</body>
</html>
