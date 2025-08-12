<?php
$db = require 'db.php';

$stmt = $db->prepare("SELECT * FROM posts WHERE is_published = 1 ORDER BY created_at DESC");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to truncate post content
function truncateContent($content, $slug, $limit = 850) {
    if (strlen($content) <= $limit) {
        return $content;
    }
    $truncated = substr($content, 0, $limit);
    $lastSpace = strrpos($truncated, ' ');
    $truncated = substr($truncated, 0, $lastSpace);
    $readMoreUrl = 'post.php?anime=' . urlencode($slug);
    return $truncated . '... <a href="' . $readMoreUrl . '">(click to read more)</a>';
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TOKYOYBOY</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="overlay">
    <div class="header">
      <h1><a href="index.php">TOKYOKBOY</a></h1>
        <p>feature akan di update di masa mendatang
      <nav>
        <ul class="nav-menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="anime-list.php">List Anime</a></li>
          <li><a href="#">Genre</a></li>
        </ul>
      </nav>
    </div>

    <div class="container-index">
      <div class="latest-post-index"
        <h2>Latest Posts</h2>
      </div>
      <?php foreach ($posts as $post): ?>
        <?php
        $genreStmt = $db->prepare("
            SELECT g.name 
            FROM post_genres pg
            JOIN genres g ON pg.genre_id = g.id
            WHERE pg.post_id = ?
        ");
        $genreStmt->execute([$post['id']]);
        $genres = $genreStmt->fetchAll(PDO::FETCH_COLUMN);
        ?>
        <div class="post">
            <h2>
                <a href="post.php?anime=<?= urlencode($post['slug']) ?>">
                    <?= htmlspecialchars($post['title']) ?>
                </a>
            </h2>
            <div class="post-body">
                <div class="post-image-index">
                    <?php if (!empty($post['image_path'])): ?>
                        <img src="<?= htmlspecialchars($post['image_path']) ?>" alt="Post Image">
                    <?php else: ?>
                        <p>Picture Error</p>
                    <?php endif; ?>
                </div>
                
                <div class="post-content">
                    <p><?= truncateContent($post['content'], $post['slug']) ?></p>
                    <div class="post-footer">
                        <div class="post-genre-index">
                            <?php if (!empty($genres)): ?>
                                <?php foreach ($genres as $genre): ?>
                                <a href="genre.php?name=<?= urlencode($genre) ?>" class="genre-badge-index"><?= htmlspecialchars($genre) ?></a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="post-score">
                            <strong>Score:</strong> <?= htmlspecialchars($post['score']) ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="popular-post-title">
      <h3>Popular Posts</h3>
    
      <ul class="popular-posts">
        <?php
        $popular = $db->query("SELECT title, slug FROM posts WHERE is_published = 1 ORDER BY views DESC LIMIT 5");
        while ($row = $popular->fetch()) {
            echo "<li><a href='post.php?anime=" . htmlspecialchars($row['slug']) . "'>" . htmlspecialchars($row['title']) . "</a></li>";
        }
        ?>
      </ul>
    </div>
  </div>
</body>
</html>
