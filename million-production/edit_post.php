<?php
require 'db.php';

if (!isset($_GET['id'])) die("Post ID not specified.");
$id = intval($_GET['id']);

// Fetch post
$stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$post) die("Post not found.");

// Fetch batch links
$batch_stmt = $db->prepare("SELECT * FROM download_batch WHERE post_id = ?");
$batch_stmt->execute([$id]);
$batch_links = $batch_stmt->fetchAll(PDO::FETCH_ASSOC);

// Group batch links by platform
$batch_by_platform = [];
foreach ($batch_links as $batch) {
    $platform = $batch['platform'];
    $batch_by_platform[$platform][] = $batch;
}

// Fetch genres
$stmt = $db->prepare("SELECT genre_id FROM post_genres WHERE post_id = ?");
$stmt->execute([$id]);
$selected_genres = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Fetch all genres
$all_genres = $db->query("SELECT * FROM genres");

// Fetch resolution-based links
$resolutions = ['240p', '360p', '480p', '720p'];
$download_stmt = $db->prepare("SELECT * FROM download_links WHERE post_id = ? ORDER BY resolution, episode_number + 0 ASC");
$download_stmt->execute([$id]);
$all_links = $download_stmt->fetchAll(PDO::FETCH_ASSOC);

// Group by resolution
$res_groups = [];
foreach ($all_links as $dl) {
    $res_groups[$dl['resolution']][] = $dl;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <style>
        label { display: block; margin-top: 10px; }
        input[type=text], textarea { width: 100%; padding: 8px; margin-top: 5px; }
        .bulk-container { margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; background: #f9f9f9; }
        .resolution-header { font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>

<button onclick="history.back()" style="padding: 6px 12px; margin-bottom: 10px;">← Back</button>

<h2>Edit Post: <?= htmlspecialchars($post['title']) ?></h2>

<form method="POST" action="update_post.php">
    <input type="hidden" name="id" value="<?= $id ?>">

    <label>Title</label>
    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>">

    <label>Alt Titles</label>
    <input type="text" name="alt_titles" value="<?= htmlspecialchars($post['alt_titles']) ?>">

    <label>Slug</label>
    <input type="text" name="slug" value="<?= htmlspecialchars($post['slug']) ?>">

    <label>Image Path</label>
    <input type="text" name="image_path" value="<?= htmlspecialchars($post['image_path']) ?>">

    <label>Information</label>
    <textarea name="information"><?= htmlspecialchars($post['information']) ?></textarea>

    <label>Genres</label>
    <?php while ($g = $all_genres->fetch(PDO::FETCH_ASSOC)): ?>
        <label><input type="checkbox" name="genres[]" value="<?= $g['id'] ?>" <?= in_array($g['id'], $selected_genres) ? 'checked' : '' ?>> <?= $g['name'] ?></label>
    <?php endwhile; ?>

    <h3>Episode Links (Per Resolution)</h3>
        <?php foreach ($res_groups as $res => $links): ?>
            <details class="bulk-container">
               <summary class="resolution-header">
                    <?= htmlspecialchars($res) ?>
                    <form method="POST" action="delete_resolution_now.php" style="display:inline; float:right;" onsubmit="return confirm('Delete ALL links for <?= htmlspecialchars($res) ?>?');">
                        <input type="hidden" name="post_id" value="<?= $id ?>">
                        <input type="hidden" name="resolution" value="<?= htmlspecialchars($res) ?>">
                        <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">[Remove All]</button>
                    </form>
                </summary>


                <?php foreach ($links as $i => $dl): ?>
                    <div>
                        Episode: 
                        <input type="text" name="episodes[<?= $dl['id'] ?>][episode_number]" value="<?= htmlspecialchars($dl['episode_number']) ?>" size="4"> - 
                        <input type="text" name="episodes[<?= $dl['id'] ?>][url]" value="<?= htmlspecialchars($dl['url']) ?>" style="width: 70%;">
                        <input type="hidden" name="episodes[<?= $dl['id'] ?>][resolution]" value="<?= htmlspecialchars($dl['resolution']) ?>">
                        <label><input type="checkbox" name="delete_links[]" value="<?= $dl['id'] ?>"> Delete</label>
                    </div>
                <?php endforeach; ?>

                <!-- Add new link to this resolution -->
                <div style="margin-top:10px;">
                    <input type="text" name="new_links[<?= htmlspecialchars($res) ?>][episode_number][]" placeholder="New Episode" size="4">
                    <input type="text" name="new_links[<?= htmlspecialchars($res) ?>][url][]" placeholder="New URL" style="width: 70%;">
                </div>
            </details>
        <?php endforeach; ?>


            <hr>

    <h3>Batch Links</h3>
    <?php foreach ($batch_by_platform as $platform => $list): ?>
        <details>
            <summary><?= htmlspecialchars(ucfirst($platform)) ?></summary>
            <?php foreach ($list as $b): ?>
                <?= htmlspecialchars($b['resolution']) ?>:
                <input type="text" value="<?= htmlspecialchars($b['url']) ?>" readonly><br>
            <?php endforeach; ?>
        </details>
    <?php endforeach; ?>

    <br><br>
    <button type="submit">Save Changes</button>
</form>

</body>
</html>
