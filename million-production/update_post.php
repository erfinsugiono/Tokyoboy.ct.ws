<?php
require 'db.php'; // gives you $db (PDO)

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request");
}

$post_id = $_POST['id'] ?? null;
if (!$post_id) {
    die("Post ID missing");
}

// === Update Basic Post Info ===
$title = $_POST['title'] ?? '';
$alt_titles = $_POST['alt_titles'] ?? '';
$slug = $_POST['slug'] ?? '';
$image_path = $_POST['image_path'] ?? '';
$information = $_POST['information'] ?? '';

$stmt = $db->prepare("UPDATE posts SET title = ?, alt_titles = ?, slug = ?, image_path = ?, information = ? WHERE id = ?");
$stmt->execute([$title, $alt_titles, $slug, $image_path, $information, $post_id]);

// === Update Download Links ===
if (isset($_POST['download_links'])) {
    foreach ($_POST['download_links'] as $id => $data) {
        $episode = $data['episode_number'] ?? '';
        $url = $data['url'] ?? '';
        $stmt = $db->prepare("UPDATE download_links SET episode_number = ?, url = ? WHERE id = ?");
        $stmt->execute([$episode, $url, $id]);
    }
}

// === Update Batch Links ===
if (isset($_POST['batch_links'])) {
    foreach ($_POST['batch_links'] as $id => $url) {
        $stmt = $db->prepare("UPDATE download_batch SET url = ? WHERE id = ?");
        $stmt->execute([$url, $id]);
    }
}

// === Update Genres (reset then insert) ===
$db->prepare("DELETE FROM post_genres WHERE post_id = ?")->execute([$post_id]);

if (!empty($_POST['genres'])) {
    foreach ($_POST['genres'] as $genre_id) {
        $stmt = $db->prepare("INSERT INTO post_genres (post_id, genre_id) VALUES (?, ?)");
        $stmt->execute([$post_id, $genre_id]);
    }
}

// === Handle Bulk Links (e.g. 240p, 360p, etc.)
$resolutions = [];
foreach ($_POST as $key => $value) {
    if (strpos($key, 'bulk_links_') === 0) {
        $res = str_replace('bulk_links_', '', $key);
        $resolutions[] = $res;
    }
}

foreach ($resolutions as $res) {
    $bulk_field = "bulk_links_" . $res;
    if (!empty($_POST[$bulk_field])) {
        $lines = explode("\n", trim($_POST[$bulk_field]));
        $ep_num = 1;
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $stmt = $db->prepare("INSERT INTO download_links (post_id, episode_number, resolution, url) VALUES (?, ?, ?, ?)");
            $stmt->execute([$post_id, $ep_num, $res, $line]);
            $ep_num++;
        }
    }
}

// === Done. Redirect back to edit or dashboard
header("Location: edit_post.php?id=" . $post_id);
exit;
