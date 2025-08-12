<?php
require 'db.php';

$id = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;

if ($id && in_array($action, ['publish', 'unpublish'])) {
    $is_published = ($action === 'publish') ? 1 : 0;

    $stmt = $db->prepare("UPDATE posts SET is_published = ? WHERE id = ?");
    $stmt->execute([$is_published, $id]);
}

// Redirect back to dashboard
header("Location: edit_post_dashboard.php");
exit;
