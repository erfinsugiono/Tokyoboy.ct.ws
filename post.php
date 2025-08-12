<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// echo "Debug: Script started.<br>";

$pdo = require 'db.php';

if (!$pdo) {
    die("Could not connect to the database.");
}

// echo "Debug: DB connected.<br>";

$slug = $_GET['anime'] ?? '';
// echo "Debug: Got slug: $slug<br>";

if (!$slug) {
    die("No slug provided.");
}

try {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE slug = ?");
    $stmt->execute([$slug]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        die("Post not found.");
    }

    // ✅ Corrected: use $pdo instead of $db
    $typeStmt = $pdo->prepare("
        SELECT t.name 
        FROM post_types pg
        JOIN types t ON pg.type_id = t.id
        WHERE pg.post_id = ?
    ");
    $typeStmt->execute([$post['id']]);
    $types = $typeStmt->fetchAll(PDO::FETCH_COLUMN);


    $episodeStmt = $pdo->prepare("
    SELECT e.name
    FROM post_episodes pe
    JOIN episodes e ON pe.episode_id = e.id
    WHERE pe.post_id = ?
    ");
    $episodeStmt->execute([$post['id']]);
    $episodes = $episodeStmt->fetchAll(PDO::FETCH_COLUMN);


    // ✅ Corrected: use $pdo instead of $db
    $statusStmt = $pdo->prepare("
        SELECT s.name 
        FROM post_statuses ps
        JOIN statuses s ON ps.status_id = s.id
        WHERE ps.post_id = ?
    ");
    $statusStmt->execute([$post['id']]);
    $status = $statusStmt->fetchColumn();



    $airedStmt = $pdo->prepare("
        SELECT s.name
        FROM post_aired pa
        JOIN aired s ON pa.aired_id = s.id
        WHERE pa.post_id = ?
    ");
    $airedStmt->execute([$post['id']]);
    $airedData = $airedStmt->fetch(PDO::FETCH_ASSOC); // Use fetch instead of fetchAll


    $premieredStmt = $pdo->prepare("
        SELECT p.name 
        FROM post_premiered pp
        JOIN premiered p ON pp.premiered_id = p.id
        WHERE pp.post_id = ?
    ");

    $premieredStmt->execute([$post['id']]);
    $premiered = $premieredStmt->fetchAll(PDO::FETCH_COLUMN);


    $broadcastStmt = $pdo->prepare("
        SELECT b.name 
        FROM post_broadcasts pb
        JOIN broadcasts b ON pb.broadcast_id = b.id
        WHERE pb.post_id = ?
    ");

    $broadcastStmt->execute([$post['id']]);
    $broadcasts = $broadcastStmt->fetchAll(PDO::FETCH_COLUMN);


    $producerStmt = $pdo->prepare("
        SELECT p.name 
        FROM post_producers pp
        JOIN producers p ON pp.producer_id = p.id
        WHERE pp.post_id = ?
    ");
    $producerStmt->execute([$post['id']]);
    $producers = $producerStmt->fetchAll(PDO::FETCH_COLUMN);



    $licensorStmt = $pdo->prepare("
        SELECT l.name 
        FROM post_licensors pl
        JOIN licensors l ON pl.licensor_id = l.id
        WHERE pl.post_id = ?
    ");

    $licensorStmt->execute([$post['id']]);
    $licensors = $licensorStmt->fetchAll(PDO::FETCH_COLUMN);


    $studioStmt = $pdo->prepare("
        SELECT s.name 
        FROM post_studios ps
        JOIN studios s ON ps.studio_id = s.id
        WHERE ps.post_id = ?
    ");

    $studioStmt->execute([$post['id']]);
    $studios = $studioStmt->fetchAll(PDO::FETCH_COLUMN);


    $sourceStmt = $pdo->prepare("
        SELECT s.name 
        FROM post_sources ps
        JOIN sources s ON ps.source_id = s.id
        WHERE ps.post_id = ?
    ");

    $sourceStmt->execute([$post['id']]);
    $sources = $sourceStmt->fetchAll(PDO::FETCH_COLUMN);


    // ✅ Corrected: use $pdo instead of $db
    $genreStmt = $pdo->prepare("
        SELECT g.name 
        FROM post_genres pg
        JOIN genres g ON pg.genre_id = g.id
        WHERE pg.post_id = ?
    ");

    $genreStmt->execute([$post['id']]);
    $genres = $genreStmt->fetchAll(PDO::FETCH_COLUMN);

    // Get themes
    $themeStmt = $pdo->prepare("
        SELECT t.name
        FROM post_themes pt
        JOIN themes t ON pt.theme_id = t.id
        WHERE pt.post_id = ?
    ");

    $themeStmt->execute([$post['id']]);
    $themes = $themeStmt->fetchAll(PDO::FETCH_COLUMN);


    // Get demographics
    $demoStmt = $pdo->prepare("
        SELECT d.name
        FROM post_demographics pd
        JOIN demographics d ON pd.demographic_id = d.id
        WHERE pd.post_id = ?
    ");
    $demoStmt->execute([$post['id']]);
    $demographics = $demoStmt->fetchAll(PDO::FETCH_COLUMN);

    $studioStmt = $pdo->prepare("
        SELECT s.name 
        FROM post_studios ps
        JOIN studios s ON ps.studio_id = s.id
        WHERE ps.post_id = ?
    ");

    $studioStmt->execute([$post['id']]);
    $studios = $studioStmt->fetchAll(PDO::FETCH_COLUMN);


    $sourceStmt = $pdo->prepare("
        SELECT s.name 
        FROM post_sources ps
        JOIN sources s ON ps.source_id = s.id
        WHERE ps.post_id = ?
    ");


    $durationStmt = $pdo->prepare("
        SELECT d.name
        FROM post_durations pd
        JOIN durations d ON pd.duration_id = d.id
        WHERE pd.post_id = ?
    ");
    $durationStmt->execute([$post['id']]);
    $durations = $durationStmt->fetchAll(PDO::FETCH_COLUMN);

    $ratingStmt = $pdo->prepare("
        SELECT r.name 
        FROM post_ratings pr
        JOIN ratings r ON pr.rating_id = r.id
        WHERE pr.post_id = ?
    ");

    $ratingStmt->execute([$post['id']]);
    $ratings = $ratingStmt->fetchAll(PDO::FETCH_COLUMN);







    $linkStmt = $pdo->prepare("
        SELECT episode_number, resolution, url
        FROM download_links
        WHERE post_id = ?
        ORDER BY resolution, episode_number
    ");
    $linkStmt->execute([$post['id']]);
    $rawLinks = $linkStmt->fetchAll(PDO::FETCH_ASSOC);



    // Group links by resolution
    $downloadLinks = [];

    foreach ($rawLinks as $link) {
        $res = $link['resolution'];
        $epNum = $link['episode_number'];
        $url = $link['url'];

        if (!isset($downloadLinks[$res])) {
            $downloadLinks[$res] = [];
        }

        $downloadLinks[$res][$epNum] = $url;
    }


    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- rest of HTML continues -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $post ? htmlspecialchars($post['title']) : 'Post Not Found' ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="overlay">
  <div class="header">
    <h1><a href="index.php">TOKYOBOY</a></h1>
     <p>feature akan di update di masa mendatang

    <nav>
      <ul class="nav-menu">
        <li><a href="index.php">Home</a></li>
       
        <li><a href="#">List Anime</a></li>
        <li><a href="#">Genre</a></li>
      </ul>
    </nav>
  </div>

  <div class="container">
    <?php if ($post): ?>
      <article class="article">
            <h1 class="article-title"><?= htmlspecialchars($post['title']) ?></h1>
                <div class="article-meta">
                Posted on <?= date('F j, Y', strtotime($post['created_at'])) ?>
                </div>
      <div class="article-body">
        <div class="article-body-flex">
          <div class="post-left-column">
          <?php if (!empty($post['image_path'])): ?>
            <div class="post-image-wrap">
              <img src="<?= htmlspecialchars($post['image_path']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
            <div class="anime-details">
          <?php if (!empty($post['alt_titles'])): ?>
              <h3 class="tight-section-title">Alternative Titles</h3>
              <hr class="tight-section-hr" />
                <?php
                   $alt = htmlspecialchars($post['alt_titles']); // escape HTML for safety
                   $alt = preg_replace('/^(Synonyms:|Japanese:|English:)/mi', '<strong>$1</strong>', $alt); // make labels bold
                   $alt = nl2br($alt); // convert newlines to <br>
                ?>
              <div class="alt-titles"><?php echo $alt; ?></div>

    <?php endif; ?> 

      <?php if (!empty($post['information']) || !empty($genres)): ?>
        <h3 class="tight-heading">Information</h3>
        <div class="tight-section-hr"></div>
        <div class="information-block">

          <?php
            $info = '';

                  // ✅ Type
              if (!empty($types)) {
                  $typeLinks = array_map(function($type) {
                      $url = 'type.php?name=' . urlencode($type);
                      return '<a href="' . $url . '" class="type-badge">' . htmlspecialchars($type) . '</a>';
                  }, $types); // ✅ use $types (array)
                  $typeLine = '<strong>Type:</strong> ' . implode(', ', $typeLinks);
                  $info .= $typeLine;
              }


              // Rendering (corrected)
              if (!empty($episodes)) {
                  $episodeLinks = array_map(function($ep) {
                      return '<span class="episode-badge">' . htmlspecialchars($ep) . '</span>';
                  }, $episodes); // ✅ Use $episodes directly
                  $episodeLine = '<br><strong>Episodes:</strong> ' . implode(', ', $episodeLinks);
                  $info .= $episodeLine;
              }

              // ✅ Status
              if (!empty($status)) {
                  $statusLinks = array_map(function($status) {
                      return '<span class="status-badge">' . htmlspecialchars($status) . '</span>';
                  }, [$status]);
                  $statusLine = '<br><strong>Status:</strong> ' . implode(', ', $statusLinks);
                  $info .= $statusLine;
              }

              // DISPLAY the aired info
              if (!empty($airedData['name'])) {
                  $aired = $airedData['name'];

                  $airedLinks = '<span class="aired-badge">' . htmlspecialchars($aired) . '</span>';
                  $airedLine = '<br><strong>Aired:</strong> ' . $airedLinks;
                  $info .= $airedLine;
              }

              // ✅ Premiered
              if (!empty($premiered)) {
                  $premieredLinks = array_map(function($prem) {
                      $url = 'premiered.php?name=' . urlencode($prem);
                      return '<a href="' . $url . '" class="premiered-badge">' . htmlspecialchars($prem) . '</a>';
                  }, $premiered);
                  $premieredLine = '<br><strong>Premiered:</strong> ' . implode(', ', $premieredLinks);
                  $info .= $premieredLine;
              }

              // ✅ Broadcast
              if (!empty($broadcasts)) {
                  $broadcastLinks = array_map(function($bcast) {
                      return '<span class="broadcast-badge">' . htmlspecialchars($bcast) . '</span>';
                  }, $broadcasts);

                  $broadcastLine = '<br><strong>Broadcast:</strong> ' . implode(', ', $broadcastLinks);
                  $info .= $broadcastLine;
              }

              // ✅ Producers
              if (!empty($producers)) {
                  $producerLinks = array_map(function($prod) {
                      $url = 'producer.php?name=' . urlencode($prod);
                      return '<a href="' . $url . '" class="producer-badge">' . htmlspecialchars($prod) . '</a>';
                  }, $producers);
                  $producerLine = '<br><strong>Producers:</strong> ' . implode(', ', $producerLinks);
                  $info .= $producerLine;
              }

              // ✅ Licensors
              if (!empty($licensors)) {
                  $licensorLinks = array_map(function($lic) {
                      $url = 'licensor.php?name=' . urlencode($lic);
                      return '<a href="' . $url . '" class="licensor-badge">' . htmlspecialchars($lic) . '</a>';
                  }, $licensors);
                  $licensorLine = '<br><strong>Licensors:</strong> ' . implode(', ', $licensorLinks);
                  $info .= $licensorLine;
              }

              // ✅ Studios
              if (!empty($studios)) {
                  $studioLinks = array_map(function($studio) {
                      $url = 'studio.php?name=' . urlencode($studio);
                      return '<a href="' . $url . '" class="studio-badge">' . htmlspecialchars($studio) . '</a>';
                  }, $studios);
                  $studioLine = '<br><strong>Studios:</strong> ' . implode(', ', $studioLinks);
                  $info .= $studioLine;
              }

              // ✅ Source
              if (!empty($source)) {
                  $sourceLinks = array_map(function($src) {
                      $url = 'source.php?name=' . urlencode($src);
                      return '<a href="' . $url . '" class="source-badge">' . htmlspecialchars($src) . '</a>';
                  }, [$source]);
                  $sourceLine = '<br><strong>Source:</strong> ' . implode(', ', $sourceLinks);
                  $info .= $sourceLine;
              }

              // ✅ Genres
              if (!empty($genres)) {
                  $genreLinks = array_map(function($genre) {
                      $url = 'genre.php?name=' . urlencode($genre);
                      return '<a href="' . $url . '" class="genre-badge">' . htmlspecialchars($genre) . '</a>';
                  }, $genres);
                  $genreLine = '<br><strong>Genres:</strong> ' . implode(', ', $genreLinks);
                  $info .= $genreLine;
              }

              // ✅ Themes
              if (!empty($themes)) {
                  $themeLinks = array_map(function($theme) {
                      $url = 'theme.php?name=' . urlencode($theme);
                      return '<a href="' . $url . '" class="theme-badge">' . htmlspecialchars($theme) . '</a>';
                  }, $themes);
                  $themeLine = '<br><strong>Themes:</strong> ' . implode(', ', $themeLinks);
                  $info .= $themeLine;
              }

              // ✅ Demographics
              if (!empty($demographics)) {
                  $demoLinks = array_map(function($demo) {
                      $url = 'demographic.php?name=' . urlencode($demo);
                      return '<a href="' . $url . '" class="demo-badge">' . htmlspecialchars($demo) . '</a>';
                  }, $demographics);
                  $demoLine = '<br><strong>Demographic:</strong> ' . implode(', ', $demoLinks);
                  $info .= $demoLine;
              }

                     // ✅ Duration
              if (!empty($durations)) {
                  $durationLinks = array_map(function($dur) {
                      return '<span class="duration-badge">' . htmlspecialchars($dur) . '</span>';
                  }, $durations);
                  $durationLine = '<br><strong>Duration:</strong> ' . implode(', ', $durationLinks);
                  $info .= $durationLine;
              }

              // ✅ Rating
              if (!empty($ratings)) {
                  $ratingLinks = array_map(function($rat) {
                      return '<span class="rating-badge">' . htmlspecialchars($rat) . '</span>';
                  }, $ratings);
                  $ratingLine = '<br><strong>Rating:</strong> ' . implode(', ', $ratingLinks);
                  $info .= $ratingLine;
              }


              echo $info;
          ?>

        </div>
      <?php endif; ?>

            </div> <!---- anime-details --->
            </div> <!---- post-image-wrap --->
          </div> <!---- post-left-column --->
        </div> <!---- article-body-flex --->


        <div class="post-right-column">
        <div class="post-synopsis-text">Synopsis</div>
        <hr class="tight-section-hr" />
          <div class="post-text-content">
              <?= nl2br(htmlspecialchars($post['content'])) ?>
            </div>
              <hr class="tight-section-hr" />            
              <div class="tight-section-title" style="margin-top: 1rem;">Download Links
              </div>
                <?php
                $postId = intval($post['id']);
                $query = $pdo->prepare("SELECT * FROM download_batch WHERE post_id = ? ORDER BY platform, FIELD(resolution, '240p','360p','480p','720p','1080p')");
                $query->execute([$postId]);
                $batchLinks = $query->fetchAll(PDO::FETCH_ASSOC);

                // Organize links as [resolution][platform] = url
                $organizedLinks = [];
                $allPlatforms = [];

                foreach ($batchLinks as $link) {
                    $res = $link['resolution'];
                    $platform = $link['platform'];
                    $url = $link['url'];
                    $organizedLinks[$res][$platform] = $url;

                    if (!in_array($platform, $allPlatforms)) {
                        $allPlatforms[] = $platform;
                    }
                }
                ?>
                <?php
                $query2 = $pdo->prepare("SELECT * FROM download_links WHERE post_id = ?");
                $query2->execute([$postId]);
                $rows = $query2->fetchAll(PDO::FETCH_ASSOC);

                $downloadLinks = [];
                foreach ($rows as $row) {
                    $res = $row['resolution'];
                    $ep = $row['episode_number'];
                    $url = $row['url'];
                    $downloadLinks[$res][$ep] = $url;
                }
                ?>
             
                <?php if (!empty($organizedLinks)): ?>
                    <button class="collapsible">Download by Batch</button>
                    <div class="content">
                        <div class="batch-wrapper">
                            <div class="batch-table">
                                <!-- Header -->
                                <div class="batch-header">
                                    <?php foreach ($allPlatforms as $platform): ?>
                                        <div class="batch-cell title"><?= ucfirst($platform) ?></div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Rows -->
                                <?php foreach (['240p', '360p', '480p', '720p', '1080p'] as $res): ?>
                                    <div class="batch-row">
                                        <?php foreach ($allPlatforms as $platform): ?>
                                            <div class="batch-cell">
                                                <?php if (!empty($organizedLinks[$res][$platform])): ?>
                                                    <a href="<?= htmlspecialchars($organizedLinks[$res][$platform]) ?>" target="_blank">
                                                        <?= htmlspecialchars($res) ?>
                                                    </a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>



             <?php
              $resolutionOrder = ['240p', '360p', '480p', '720p', '1080p'];
              uksort($downloadLinks, function($a, $b) use ($resolutionOrder) {
                  return array_search($a, $resolutionOrder) <=> array_search($b, $resolutionOrder);
              });
              ?>

              <?php if (!empty($downloadLinks)): ?>
                  <?php foreach ($downloadLinks as $quality => $links): ?>
                      <button class="collapsible"><?= htmlspecialchars($quality) ?> Downloads</button>
                      <div class="content">
                          <?php 
                              // Sort episodes numerically so 7.5 appears between 7 and 8
                              uksort($links, function($a, $b) {
                                  return (float)$a <=> (float)$b;
                              });
                          ?>
                          <?php foreach ($links as $ep => $url): ?>
                              <div class="download-item">
                                  <a href="<?= htmlspecialchars($url) ?>" class="download-link" target="_blank">
                                      Episode <?= htmlspecialchars($ep) ?>
                                  </a>
                              </div> <!--- download-item --->
                          <?php endforeach; ?>
                      </div> <!--- content --->
                  <?php endforeach; ?>
              <?php else: ?>
                <p>No download links available.</p>
              <?php endif; ?>
      
          </div> <!--- post-right-column --->
        </div> <!--- Article-body --->
   
<?php endif; ?>
            

          </div>
        </article>
      <?php else: ?>
      <p>Post not found.</p>
      <?php endif; ?>
  <div class="footer">
    &copy; <?= date('Y') ?> TOKYOBOY
  </div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const coll = document.querySelectorAll(".collapsible");
    coll.forEach(button => {
      button.addEventListener("click", function () {
        this.classList.toggle("active");
        const content = this.nextElementSibling;
        if (content.style.display === "block") {
          content.style.display = "none";
        } else {
          content.style.display = "block";
        }
      });
    });
  });
</script>


</div>

</body>
</html>