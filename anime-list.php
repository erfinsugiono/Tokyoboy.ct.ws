<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = require __DIR__ . '/million-production/db.php';

$stmt = $db->query("SELECT id, title, slug, score FROM posts ORDER BY title ASC");
$animeList = $stmt->fetchAll(PDO::FETCH_ASSOC);

$grouped = [];
foreach ($animeList as $anime) {
    $letter = strtoupper($anime['title'][0]);
    if (!ctype_alpha($letter)) {
        $letter = '#';
    }
    $grouped[$letter][] = $anime;
}
ksort($grouped);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Anime List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="overlay">
  <div class="header">
    <h1><a href="index.php">TOKYOKBOY</a></h1>
    <p>feature akan di update di masa mendatang setelah semua anime di post</p>
    <nav>
      <ul class="nav-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="anime-list.php">List Anime</a></li>
        <li><a href="#">Genre</a></li>
      </ul>
    </nav>
  </div>

  <div class="container-index">
    <div class="latest-post-index">
      <h2>Anime List (A-Z)</h2>
    </div>

    <?php foreach ($grouped as $letter => $items): ?>
      <div class="letter-group">
        <h2><?= htmlspecialchars($letter) ?></h2>
        <ul class="anime-list">
          <?php foreach ($items as $anime): ?>
            <li>
              <a href="post.php?anime=<?= urlencode($anime['slug']) ?>">
                <?= htmlspecialchars($anime['title']) ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="popular-post-title">
    <h3>Popular Posts</h3>
    <ul class="popular-posts">
      <?php
      $popular = $db->query("SELECT title, slug FROM posts ORDER BY views DESC LIMIT 5");
      while ($row = $popular->fetch()) {
          echo "<li><a href='post.php?anime=" . htmlspecialchars($row['slug']) . "'>" . htmlspecialchars($row['title']) . "</a></li>";
      }
      ?>
    </ul>
  </div>
</div>
</body>
</html>
