<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $postId = intval($_POST['post_id']);
    $input = trim($_POST['batch_input']);

    // Clean and parse input
    $lines = array_filter(array_map('trim', explode("\n", $input)));

    $platform = '';
    $platformLinks = [];
    $resolutions = ['240p', '360p', '480p', '720p', '1080p'];

    foreach ($lines as $line) {
        if (!filter_var($line, FILTER_VALIDATE_URL)) {
            // Line is a platform name
            $platform = strtolower(trim($line));
            if (!isset($platformLinks[$platform])) {
                $platformLinks[$platform] = [];
            }
        } else {
            if ($platform !== '') {
                $platformLinks[$platform][] = $line;
            }
        }
    }

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=your_db", "username", "password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Clear existing links for the post (optional, to avoid duplicates)
        $pdo->prepare("DELETE FROM download_batch WHERE post_id = ?")->execute([$postId]);

        $stmt = $pdo->prepare("INSERT INTO download_batch (platform, resolution, url, post_id) VALUES (?, ?, ?, ?)");

        foreach ($platformLinks as $platform => $links) {
            foreach ($links as $index => $url) {
                $resolution = $resolutions[$index] ?? 'unknown';
                $stmt->execute([$platform, $resolution, $url, $postId]);
            }
        }

        echo "<p style='color: green;'>Batch links inserted successfully!</p>";

    } catch (PDOException $e) {
        echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>

<form action="download_batch.php" method="POST">
    <textarea name="batch_input" rows="20" cols="100" placeholder="Paste your batch links here (with platform names above each group)"></textarea><br>
    <input type="hidden" name="post_id" value="<?= isset($_GET['post_id']) ? htmlspecialchars($_GET['post_id']) : 0 ?>">
    <button type="submit" name="submit">Upload Batch</button>
</form>
