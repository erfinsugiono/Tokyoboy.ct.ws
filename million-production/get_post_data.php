<?php
require 'db.php';

if (!isset($_GET['post_id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Post ID missing']);
    exit;
}

$post_id = intval($_GET['post_id']);
$stmt = $db->prepare("SELECT DISTINCT resolution FROM download_links WHERE post_id = ?");
$stmt->execute([$post_id]);
$resolutions = $stmt->fetchAll(PDO::FETCH_COLUMN);

$data = [];

foreach ($resolutions as $res) {
    $stmt = $db->prepare("SELECT id, episode_number, url FROM download_links WHERE post_id = ? AND resolution = ? ORDER BY episode_number ASC");
    $stmt->execute([$post_id, $res]);
    $data[$res] = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

header('Content-Type: application/json');
echo json_encode($data);
