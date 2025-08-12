<?php
require 'db.php'; // connects to DB using $db (PDO)

$limit = 25; // posts per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Step 1: Get total number of posts
$stmt = $db->query("SELECT COUNT(*) as total FROM posts");
$total_posts = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
$total_pages = ceil($total_posts / $limit);

// Step 2: Get posts for current page
$stmt = $db->prepare("SELECT * FROM posts ORDER BY created_at DESC LIMIT :start, :limit");
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Posts Dashboard</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        img { max-height: 80px; }
        .pagination { margin-top: 20px; }
        .pagination a {
            padding: 8px 12px;
            margin: 0 4px;
            text-decoration: none;
            background: #f0f0f0;
            color: #333;
            border-radius: 4px;
        }
        .pagination a.active {
            font-weight: bold;
            background: #333;
            color: #fff;
        }
        .action-btns a {
            margin-right: 10px;
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
<button onclick="history.back()" style="padding: 6px 12px; margin-bottom: 10px;">← Back</button>

<h2>List of Post</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Thumbnail</th>
        <th>Title</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($posts as $row): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><img src="<?= htmlspecialchars($row['image_path']) ?>" width="60" height="80"></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= $row['created_at'] ?></td>
        <td class="action-btns">
            <a href="edit_post.php?id=<?= $row['id'] ?>">Edit</a>

            <?php if (isset($row['is_published']) && $row['is_published']): ?>
                <a href="toggle_publish.php?id=<?= $row['id'] ?>&action=unpublish">Unpublish</a>
            <?php else: ?>
                <a href="toggle_publish.php?id=<?= $row['id'] ?>&action=publish">Publish</a>
            <?php endif; ?>


            <a href="delete_post.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this post?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>

</body>
</html>
