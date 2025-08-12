<?php
session_start(); // Always at the very top

$db = require '../db.php';

if (!$db) {
    die("Database connection failed. Please try again later.");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check login & role
if (empty($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php'); // redirect to login
    exit;
}

$username = $_SESSION['username'];

if (isset($_POST['submit'])) {

    // Types
    $typeStmt = $db->query("SELECT * FROM types ORDER BY name");
    $allTypes = $typeStmt->fetchAll(PDO::FETCH_ASSOC);

    // Episodes
    $episodeStmt = $db->query("SELECT * FROM episodes ORDER BY name");
    $allEpisodes = $episodeStmt->fetchAll(PDO::FETCH_ASSOC);

    // Statuses
    $statusStmt = $db->query("SELECT * FROM statuses ORDER BY name");
    $allStatuses = $statusStmt->fetchAll(PDO::FETCH_ASSOC);

    $airedStmt = $db->query("SELECT * FROM aired ORDER BY name");
    $allAired = $airedStmt->fetchAll(PDO::FETCH_ASSOC);

    // Premiered (season/year)
    $premieredStmt = $db->query("SELECT * FROM premiered ORDER BY name");
    $allPremiered = $premieredStmt->fetchAll(PDO::FETCH_ASSOC);

    // Broadcasts
    $broadcastStmt = $db->query("SELECT * FROM broadcasts ORDER BY name");
    $allBroadcasts = $broadcastStmt->fetchAll(PDO::FETCH_ASSOC);

    // Producers
    $producersStmt = $db->query("SELECT * FROM producers ORDER BY name");
    $allProducers = $producersStmt->fetchAll(PDO::FETCH_ASSOC);

    // Licensors
    $licensorsStmt = $db->query("SELECT * FROM licensors ORDER BY name");
    $allLicensors = $licensorsStmt->fetchAll(PDO::FETCH_ASSOC);

    // Studios
    $studiosStmt = $db->query("SELECT * FROM studios ORDER BY name");
    $allStudios = $studiosStmt->fetchAll(PDO::FETCH_ASSOC);

    // Sources
    $sourcesStmt = $db->query("SELECT * FROM sources ORDER BY name");
    $allSources = $sourcesStmt->fetchAll(PDO::FETCH_ASSOC);

    // Genres
    $genreStmt = $db->query("SELECT * FROM genres ORDER BY name");
    $allGenres = $genreStmt->fetchAll(PDO::FETCH_ASSOC);

    // Themes
    $themeStmt = $db->query("SELECT * FROM themes ORDER BY name");
    $allThemes = $themeStmt->fetchAll(PDO::FETCH_ASSOC);

    // Demographics
    $demoStmt = $db->query("SELECT * FROM demographics ORDER BY name");
    $allDemographics = $demoStmt->fetchAll(PDO::FETCH_ASSOC);

    // Durations
    $durationStmt = $db->query("SELECT * FROM durations ORDER BY name");
    $allDurations = $durationStmt->fetchAll(PDO::FETCH_ASSOC);

    // Ratings
    $ratingStmt = $db->query("SELECT * FROM ratings ORDER BY name");
    $allRatings = $ratingStmt->fetchAll(PDO::FETCH_ASSOC);

    ///////////////////////////////////////////////////

    $title = $_POST['title'];
        $slug = preg_replace('/[^a-z0-9\-]/', '', strtolower(str_replace(' ', '-', $_POST['slug'])));
        $content = $_POST['content'];
        $score = $_POST['score'];
        $alt_titles = $_POST['alt_titles'] ?? '';
        $information = $_POST['information'] ?? '';
        $premiered = null;
      


        function extractValue($key, $text) {
            if (preg_match('/^' . preg_quote($key, '/') . ':\s*(.+)$/mi', $text, $matches)) {
                    return trim($matches[1]);
                }
                return null;
            }

            $type = extractValue("Type", $information);
            $episodes = extractValue("Episodes", $information);
            $status = extractValue("Status", $information);
            $aired = extractValue("Aired", $information);
            $broadcast = extractValue("Broadcast", $information);
            $producers = extractValue("Producers", $information);
            $licensors = extractValue("Licensors", $information);
            $studios = extractValue("Studios", $information);
            $source = extractValue("Source", $information);
            $themes = extractValue("Themes", $information);
            $duration = extractValue("Duration", $information);
            $rating = extractValue("Rating", $information);

        if (preg_match('/^Premiered:\s*(.+)$/mi', $information, $matches)) {
            $premiered = trim($matches[1]);
        }


        if (!empty($_FILES["image"]["name"])) {
            $targetDir = __DIR__ . '/../uploads/';
            $imageName = basename($_FILES["image"]["name"]);
            $targetFile = $targetDir . $imageName;
            $imagePath = "uploads/" . $imageName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                try {

                    // Insert into posts
                    $stmt = $db->prepare("INSERT INTO posts (title, slug, image_path, content, score, alt_titles, information, premiered, type, episodes, status, aired, broadcast, producers, licensors, studios, source, duration, rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                    ");
                    $stmt->execute([
                        $title, $slug, $imagePath, $content, $score, $alt_titles, $information, $premiered,
                        $type, $episodes, $status, $aired, $broadcast, $producers, $licensors,
                        $studios, $source, $duration, $rating, 
                    ]);


                    $post_id = $db->lastInsertId();

                    // -----------------------
                    // 1. TYPE
                    $types = [];
                    if (preg_match('/^Type:\s*(.+)$/mi', $information, $matches)) {
                        $type_line = $matches[1]; // e.g., "TV"
                        $types = array_map('trim', explode(',', $type_line));
                    }

                    foreach ($types as $type) {
                        if ($type === '') continue;

                        $stmt = $db->prepare("SELECT id FROM types WHERE name = ?");
                        $stmt->execute([$type]);
                        $type_id = $stmt->fetchColumn();

                        if (!$type_id) {
                            $stmt = $db->prepare("INSERT INTO types (name) VALUES (?)");
                            $stmt->execute([$type]);
                            $type_id = $db->lastInsertId();
                        }

                        $stmt = $db->prepare("INSERT IGNORE INTO post_types (post_id, type_id) VALUES (?, ?)");
                        $stmt->execute([$post_id, $type_id]);
                    }

                    // 2. EPISODES
                    $episodes = [];
                    if (preg_match('/^Episodes:\s*(.+)$/mi', $information, $matches)) {
                        $episodes_line = $matches[1]; // e.g., "24"
                        $episodes = array_map('trim', explode(',', $episodes_line));
                    }

                    foreach ($episodes as $episode) {
                        if ($episode === '') continue;

                        $stmt = $db->prepare("SELECT id FROM episodes WHERE name = ?");
                        $stmt->execute([$episode]);
                        $episode_id = $stmt->fetchColumn();

                        if (!$episode_id) {
                            $stmt = $db->prepare("INSERT INTO episodes (name) VALUES (?)");
                            $stmt->execute([$episode]);
                            $episode_id = $db->lastInsertId();
                        }

                        $stmt = $db->prepare("INSERT IGNORE INTO post_episodes (post_id, episode_id) VALUES (?, ?)");
                        $stmt->execute([$post_id, $episode_id]);
                    }

                    // 3. STATUS
                    $statuses = [];
                    if (preg_match('/^Status:\s*(.+)$/mi', $information, $matches)) {
                        $status_line = $matches[1];
                        $statuses = array_map('trim', explode(',', $status_line));
                    }

                    foreach ($statuses as $status) {
                        if ($status === '') continue;

                        $stmt = $db->prepare("SELECT id FROM statuses WHERE name = ?");
                        $stmt->execute([$status]);
                        $status_id = $stmt->fetchColumn();

                        if (!$status_id) {
                            $stmt = $db->prepare("INSERT INTO statuses (name) VALUES (?)");
                            $stmt->execute([$status]);
                            $status_id = $db->lastInsertId();
                        }

                        $stmt = $db->prepare("INSERT IGNORE INTO post_statuses (post_id, status_id) VALUES (?, ?)");
                        $stmt->execute([$post_id, $status_id]);
                    }

                    if (preg_match('/^Aired:\s*(.+)$/mi', $information, $matches)) {
                        $aired_line = trim($matches[1]); // e.g. "Jan 10, 2015 to Jun 20, 2015"

                        if ($aired_line !== '') {
                            // Insert or fetch from `aired` table
                            $stmt = $db->prepare("SELECT id FROM aired WHERE name = ?");
                            $stmt->execute([$aired_line]);
                            $aired_id = $stmt->fetchColumn();

                            if (!$aired_id) {
                                $stmt = $db->prepare("INSERT INTO aired (name) VALUES (?)");
                                $stmt->execute([$aired_line]);
                                $aired_id = $db->lastInsertId();
                            }

                            // Connect post to aired entry
                            $stmt = $db->prepare("INSERT IGNORE INTO post_aired (post_id, aired_id) VALUES (?, ?)");
                            $stmt->execute([$post_id, $aired_id]);
                        }
                    }


                    // 5. PREMIERED
                    $premiereds = [];
                    if (preg_match('/^Premiered:\s*(.+)$/mi', $information, $matches)) {
                        $premiered_line = $matches[1];
                        $premiereds = array_map('trim', explode(',', $premiered_line));
                    }

                    foreach ($premiereds as $premiered) {
                        if ($premiered === '') continue;

                        $stmt = $db->prepare("SELECT id FROM premiered WHERE name = ?");
                        $stmt->execute([$premiered]);
                        $premiered_id = $stmt->fetchColumn();

                        if (!$premiered_id) {
                            $stmt = $db->prepare("INSERT INTO premiered (name) VALUES (?)");
                            $stmt->execute([$premiered]);
                            $premiered_id = $db->lastInsertId();
                        }

                        $stmt = $db->prepare("INSERT IGNORE INTO post_premiered (post_id, premiered_id) VALUES (?, ?)");
                        $stmt->execute([$post_id, $premiered_id]);
                    }

                    // 6. BROADCAST
                    $broadcasts = [];
                    if (preg_match('/^Broadcast:\s*(.+)$/mi', $information, $matches)) {
                        $broadcast_line = $matches[1];
                        $broadcasts = array_map('trim', explode(',', $broadcast_line));
                    }

                    foreach ($broadcasts as $broadcast) {
                        if ($broadcast === '') continue;

                        $stmt = $db->prepare("SELECT id FROM broadcasts WHERE name = ?");
                        $stmt->execute([$broadcast]);
                        $broadcast_id = $stmt->fetchColumn();

                        if (!$broadcast_id) {
                            $stmt = $db->prepare("INSERT INTO broadcasts (name) VALUES (?)");
                            $stmt->execute([$broadcast]);
                            $broadcast_id = $db->lastInsertId();
                        }

                        $stmt = $db->prepare("INSERT IGNORE INTO post_broadcasts (post_id, broadcast_id) VALUES (?, ?)");
                        $stmt->execute([$post_id, $broadcast_id]);
                    }

                    // 7. PRODUCERS
                    $producers = [];
                    if (preg_match('/^Producers:\s*(.+)$/mi', $information, $matches)) {
                        $producers_line = $matches[1];
                        $producers = array_map('trim', explode(',', $producers_line));
                    }

                    foreach ($producers as $producer) {
                        if ($producer === '') continue;

                        $stmt = $db->prepare("SELECT id FROM producers WHERE name = ?");
                        $stmt->execute([$producer]);
                        $producer_id = $stmt->fetchColumn();

                        if (!$producer_id) {
                            $stmt = $db->prepare("INSERT INTO producers (name) VALUES (?)");
                            $stmt->execute([$producer]);
                            $producer_id = $db->lastInsertId();
                        }

                        $stmt = $db->prepare("INSERT IGNORE INTO post_producers (post_id, producer_id) VALUES (?, ?)");
                        $stmt->execute([$post_id, $producer_id]);
                    }

                    // 8. LICENSORS
                    $licensors = [];
                    if (preg_match('/^Licensors:\s*(.+)$/mi', $information, $matches)) {
                        $licensors_line = $matches[1];
                        $licensors = array_map('trim', explode(',', $licensors_line));
                    }

                    foreach ($licensors as $licensor) {
                        if ($licensor === '') continue;

                        $stmt = $db->prepare("SELECT id FROM licensors WHERE name = ?");
                        $stmt->execute([$licensor]);
                        $licensor_id = $stmt->fetchColumn();

                        if (!$licensor_id) {
                            $stmt = $db->prepare("INSERT INTO licensors (name) VALUES (?)");
                            $stmt->execute([$licensor]);
                            $licensor_id = $db->lastInsertId();
                        }

                        $stmt = $db->prepare("INSERT IGNORE INTO post_licensors (post_id, licensor_id) VALUES (?, ?)");
                        $stmt->execute([$post_id, $licensor_id]);
                    }

                    // 9. STUDIOS
                    $studios = [];
                    if (preg_match('/^Studios:\s*(.+)$/mi', $information, $matches)) {
                        $studios_line = $matches[1];
                        $studios = array_map('trim', explode(',', $studios_line));
                    }

                    foreach ($studios as $studio) {
                        if ($studio === '') continue;

                        $stmt = $db->prepare("SELECT id FROM studios WHERE name = ?");
                        $stmt->execute([$studio]);
                        $studio_id = $stmt->fetchColumn();

                        if (!$studio_id) {
                            $stmt = $db->prepare("INSERT INTO studios (name) VALUES (?)");
                            $stmt->execute([$studio]);
                            $studio_id = $db->lastInsertId();
                        }

                        $stmt = $db->prepare("INSERT IGNORE INTO post_studios (post_id, studio_id) VALUES (?, ?)");
                        $stmt->execute([$post_id, $studio_id]);
                    }

                    // 10. SOURCE
                    $sources = [];
                    if (preg_match('/^Source:\s*(.+)$/mi', $information, $matches)) {
                        $source_line = $matches[1];
                        $sources = array_map('trim', explode(',', $source_line));
                    }

                    foreach ($sources as $source) {
                        if ($source === '') continue;

                        $stmt = $db->prepare("SELECT id FROM sources WHERE name = ?");
                        $stmt->execute([$source]);
                        $source_id = $stmt->fetchColumn();

                        if (!$source_id) {
                            $stmt = $db->prepare("INSERT INTO sources (name) VALUES (?)");
                            $stmt->execute([$source]);
                            $source_id = $db->lastInsertId();
                        }

                        $stmt = $db->prepare("INSERT IGNORE INTO post_sources (post_id, source_id) VALUES (?, ?)");
                        $stmt->execute([$post_id, $source_id]);
                    }

                    // 11. GENRES
                    $genres = [];
                    if (preg_match('/^Genres?:\s*(.+)$/mi', $information, $matches)) {
                        $genres_line = $matches[1]; // e.g., "Action, Comedy"
                        $genres = array_map('trim', explode(',', $genres_line));
                    }

                    foreach ($genres as $genreName) {
                        if ($genreName === '') continue;

                        $stmt = $db->prepare("SELECT id FROM genres WHERE name = ?");
                        $stmt->execute([$genreName]);
                        $genre_id = $stmt->fetchColumn();

                        if (!$genre_id) {
                            $stmt = $db->prepare("INSERT INTO genres (name) VALUES (?)");
                            $stmt->execute([$genreName]);
                            $genre_id = $db->lastInsertId();
                        }

                        $stmt = $db->prepare("INSERT IGNORE INTO post_genres (post_id, genre_id) VALUES (?, ?)");
                        $stmt->execute([$post_id, $genre_id]);
                    }

                    // 12. THEMES (your example)
                    $themes = [];
                    if (preg_match('/^Themes?:\s*(.+)$/mi', $information, $matches)) {
                        $themes_line = $matches[1]; // e.g., "Gore, Childcare"
                        $themes = array_map('trim', explode(',', $themes_line));
                    }

                    foreach ($themes as $theme) {
                        if ($theme === '') continue;

                        $stmt = $db->prepare("SELECT id FROM themes WHERE name = ?");
                        $stmt->execute([$theme]);
                        $theme_id = $stmt->fetchColumn();

                        if (!$theme_id) {
                            $stmt = $db->prepare("INSERT INTO themes (name) VALUES (?)");
                            $stmt->execute([$theme]);
                            $theme_id = $db->lastInsertId();
                        }

                        $stmt = $db->prepare("INSERT IGNORE INTO post_themes (post_id, theme_id) VALUES (?, ?)");
                        $stmt->execute([$post_id, $theme_id]);
                    }

                    // 13. DEMOS
                    // ✅ AUTO-PARSE DEMOGRAPHICS
                    $demographics = [];
                    if (preg_match('/^Demographics?:\s*(.+)$/mi', $information, $matches)) {
                        $demographics_line = $matches[1]; // e.g., "Shounen, Josei"
                        $demographics = array_map('trim', explode(',', $demographics_line));
                    }

                    foreach ($demographics as $demographic) {
                        if ($demographic === '') continue;

                        // Check if demographic exists
                        $stmt = $db->prepare("SELECT id FROM demographics WHERE name = ?");
                        $stmt->execute([$demographic]);
                        $demographics_id = $stmt->fetchColumn();

                        // If not exist, insert it
                        if (!$demographics_id) {
                            $stmt = $db->prepare("INSERT INTO demographics (name) VALUES (?)");
                            $stmt->execute([$demographic]);
                            $demographics_id = $db->lastInsertId();
                        }

                        // Link post and demographic
                        $stmt = $db->prepare("INSERT IGNORE INTO post_demographics (post_id, demographic_id) VALUES (?, ?)");
                        $stmt->execute([$post_id, $demographics_id]);
                    }

                    // 14. Duration
                    $durations = [];
                    if (preg_match('/^Durations?:\s*(.+)$/mi', $information, $matches)) {
                        $durations_line = $matches[1];
                        $durations = array_map('trim', explode(',', $durations_line));
                    }

                    foreach ($durations as $duration) {
                        if ($duration === '') continue;

                        $stmt = $db->prepare("SELECT id FROM durations WHERE name = ?");
                        $stmt->execute([$duration]);
                        $duration_id = $stmt->fetchColumn();

                        if (!$duration_id) {
                            $stmt = $db->prepare("INSERT INTO durations (name) VALUES (?)");
                            $stmt->execute([$duration]);
                            $duration_id = $db->lastInsertId();
                        }

                        $stmt = $db->prepare("INSERT IGNORE INTO post_durations(post_id, duration_id) VALUES (?, ?)");
                        $stmt->execute([$post_id, $duration_id]);
                    }

                    // 15. Rating
                    if (preg_match('/^Rating:\s*(.+)$/mi', $information, $matches)) {
                        $rating_line = $matches[1];
                        $rating_list = array_map('trim', explode(',', $rating_line));

                        foreach ($rating_list as $rating_name) {
                            if ($rating_name === '') continue;

                            // Check if rating exists
                            $stmt = $db->prepare("SELECT id FROM ratings WHERE name = ?");
                            $stmt->execute([$rating_name]);
                            $rating_id = $stmt->fetchColumn();

                            // Insert if it doesn't exist
                            if (!$rating_id) {
                                $stmt = $db->prepare("INSERT INTO ratings (name) VALUES (?)");
                                $stmt->execute([$rating_name]);
                                $rating_id = $db->lastInsertId();
                            }

                            // Link to post
                            $stmt = $db->prepare("INSERT IGNORE INTO post_ratings (post_id, rating_id) VALUES (?, ?)");
                            $stmt->execute([$post_id, $rating_id]);
                        }
                    }          
                    


                    $links_raw = trim($_POST['download_links'] ?? '');
                    $override_raw = trim($_POST['episode_overrides'] ?? '');
                    $overrides = [];

                    // Process overrides into a map like [7 => "7.5"]
                    if ($override_raw !== '') {
                        foreach (explode("\n", $override_raw) as $line) {
                            $parts = explode('|', trim($line));
                            if (count($parts) === 2) {
                                [$pos, $label] = $parts;
                                $overrides[(int)$pos] = $label;
                            }
                        }
                    }

                    $resolutionBlocks = preg_split('/\R{2,}/', $links_raw); // Blocks separated by empty lines
                    $resolutions = ['240p', '360p', '480p', '720p', '1080p'];
                    $sqlParts = [];

                    foreach ($resolutionBlocks as $i => $block) {
                        $blockLinks = array_filter(array_map('trim', explode("\n", $block)));
                        $resolution = $resolutions[$i] ?? "res_$i";

                        foreach ($blockLinks as $index => $link) {
                            if ($link === '') continue;

                            // If there's an override at this index, add the override episode
                            if (isset($overrides[$index])) {
                                $sqlParts[] = "(" 
                                    . $db->quote($overrides[$index]) . ", "
                                    . $db->quote($resolution) . ", "
                                    . $db->quote($link) . ", "
                                    . $db->quote($post_id) 
                                    . ")";
                            }

                            // Always insert the standard episode number too
                            $episodeNum = $index + 1;
                            $sqlParts[] = "(" 
                                . $db->quote($episodeNum) . ", "
                                . $db->quote($resolution) . ", "
                                . $db->quote($link) . ", "
                                . $db->quote($post_id) 
                                . ")";
                        }
                    }

                    if (!empty($sqlParts)) {
                        $sql = "INSERT INTO download_links (episode_number, resolution, url, post_id) VALUES " . implode(",\n", $sqlParts);
                        $db->exec($sql);
                    }


                    $input = trim($_POST['batch_input'] ?? '');
                
                    if ($post_id && $input !== '') {
                        $lines = preg_split('/\s+/', $input);
                        $platform = '';
                        $platformLinks = [];
                        $resolutions = ['240p', '360p', '480p', '720p', '1080p'];

                        foreach ($lines as $line) {
                            if (!filter_var($line, FILTER_VALIDATE_URL)) {
                                $platform = strtolower(trim($line));
                                if (!isset($platformLinks[$platform])) {
                                    $platformLinks[$platform] = [];
                                }
                            } else {
                                if ($platform === '') {
                                    $platform = 'default';
                                    $platformLinks[$platform] = [];
                                }
                                $platformLinks[$platform][] = $line;
                            }
                        }

                        $stmt = $db->prepare("INSERT INTO download_batch (platform, resolution, url, post_id) VALUES (?, ?, ?, ?)");
                        if (!$stmt) {
                            die("Prepare failed: " . implode(" | ", $db->errorInfo()));
                        }

                        foreach ($platformLinks as $platform => $links) {
                            foreach ($links as $index => $url) {
                                $resolution = $resolutions[$index] ?? 'unknown';
                                $params = [$platform, $resolution, $url, $post_id];

                                if (count($params) !== 4) {
                                    die("Param count mismatch: " . print_r($params, true));
                                }

                                $stmt->execute($params);
                            }
                        }


                        echo "<p style='color:green;'>Batch download links inserted.</p>";
                    }

        

                    echo "<p style='color:green;'>Post saved and genres auto-parsed!</p>";
                } catch (PDOException $e) {
                    echo "<p style='color:red;'>Database error: " . $e->getMessage() . "</p>";
                }
            } else {
                echo "<p style='color:red;'>Image upload failed.</p>";
            }
        } else {
            echo "<p style='color:red;'>No image selected.</p>";
        }




    ////////////////////////////////////////////////////////

    
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="/themes/style.css">
</head>
<body>
<div class="container">
    <!-- Show form -->
<button onclick="history.back()" style="padding: 6px 12px; margin-bottom: 10px;">← Back</button>

    <h2>Add Post</h2>


    <form method="post" enctype="multipart/form-data">
        <input name="title" placeholder="Title" required><br><br>
        <input name="slug" placeholder="Slug" required><br><br>
        <input type="file" name="image" accept="image/*"><br><br>
        <input type="number" name="score" step="0.01" placeholder="Score" required onblur="formatScore(this)"><br><br>
        <textarea name="content" rows="5" placeholder="Content" required></textarea><br><br>

        <label for="alt_titles">Alternative Titles</label><br>
        <textarea name="alt_titles" id="alt_titles" rows="5" cols="30" placeholder="Synonyms: ...&#10;Japanese: ...&#10;English: ..."></textarea><br>
        <label for="information">Information</label><br>
        <textarea name="information" id="information" rows="5" cols="30" placeholder="Type: TV&#10;Episodes: 13&#10;Status: Finished Airing&#10;..."></textarea><br><br>



            <!-- all your other fields -->
            <label for="download_input">download by batch</label><br>
            <textarea name="batch_input" rows="10"></textarea><br>
            





            <label for="download_links">Paste download links grouped by resolution (one link per line, empty line between resolutions):</label><br>
            <textarea name="download_links" rows="5" cols="30" placeholder="One link per line. Leave an empty line between resolution groups."></textarea><br>


            <label>Episode Overrides (Format: position|label):</label><br>
            <small>Example: 7|7.5 inserts "Episode 7.5" before Episode 8</small><br>
            <textarea name="episode_overrides" rows="5" cols="30"></textarea><br><br>

            <input type="submit" name="submit" value="Submit">


       

        <script>
function formatScore(input) {
    let value = parseFloat(input.value);
    if (!isNaN(value)) {
        input.value = value.toFixed(2);
    }
}
</script>


        
    </form>
    <?php
        if (isset($finalEpisodes)) {
            echo "<h3>Processed Episodes:</h3><ul>";
            foreach ($finalEpisodes as $ep) {
                echo "<li>Episode {$ep['label']} - <a href=\"{$ep['link']}\" target=\"_blank\">{$ep['link']}</a>";
                if (isset($ep['note'])) echo " <strong>{$ep['note']}</strong>";
                echo "</li>";
            }
            echo "</ul>";
        }
    ?>
    <br>

</div>
<!-- admin.php -->





</body>
</html>
