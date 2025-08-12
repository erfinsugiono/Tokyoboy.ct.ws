<?php
$db = require '../db.php';
$demographic = $_GET['name'] ?? '';

$stmt = $db->prepare("
    SELECT p.* FROM posts p
    JOIN post_demographics pd ON p.id = pd.post_id
    JOIN demographics d ON pd.demographic_id = d.id
    WHERE d.name = ?
");
$stmt->execute([$demographic]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Demographic: <?= htmlspecialchars($demographic) ?></title>
  <link rel="stylesheet" href="/themes/style.css">
</head>
<body>

  <div class="header">
    <h1><a href="index.php">My Blog Title</a></h1>
    <p>Anime by Demographic</p>
    <nav>
      <ul class="nav-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">List Anime</a></li>
        <li><a href="#">Genre</a></li>
      </ul>
    </nav>
  </div>

  <div class="container">
    <h2>Posts in Demographic: <?= htmlspecialchars($demographic) ?></h2>
        <?php foreach ($posts as $post): ?>
          <div class="post-preview">
            <h2><a href="/post.php?anime=<?= urlencode($post['slug']) ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
			<img src="/<?= htmlspecialchars($post['image_path']) ?>" width="200">
            <p><?= htmlspecialchars(substr($post['content'], 0, 150)) ?>...</p>
          </div>
        <?php endforeach; ?>
  </div>

  <div class="footer">
    &copy; <?= date('Y') ?> My Blog. All rights reserved.
  </div>

</body>
</html>
