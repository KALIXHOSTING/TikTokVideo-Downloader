<?php
// Function to execute yt-dlp and get video info
function getVideoInfo($url) {
    $command = "yt-dlp -j " . escapeshellarg($url);
    $output = shell_exec($command);
    return json_decode($output, true);
}

// Function to get direct download URL
function getDirectDownloadUrl($url) {
    $command = "yt-dlp -g " . escapeshellarg($url);
    return trim(shell_exec($command));
}

$error = '';
$videoInfo = null;
$directUrl = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'] ?? '';
    if (!empty($url)) {
        try {
            $videoInfo = getVideoInfo($url);
            $directUrl = getDirectDownloadUrl($url);
        } catch (Exception $e) {
            $error = "An error occurred: " . $e->getMessage();
        }
    } else {
        $error = "Please enter a valid TikTok video URL.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TikTok Video Downloader</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Pacifico', cursive;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 600px;
        }
        .fancy-title {
            font-size: 2.5rem;
            color: #ff4d4d;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4 fancy-title">TikTok Video Downloader</h1>
        
        <form method="POST" class="mb-4">
            <div class="input-group">
                <input type="text" name="url" class="form-control" placeholder="Enter TikTok video URL" required>
                <button type="submit" class="btn btn-primary">Get Download Link</button>
            </div>
        </form>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if ($videoInfo && $directUrl): ?>
            <div class="card">
                <img src="<?php echo htmlspecialchars($videoInfo['thumbnail']); ?>" class="card-img-top" alt="Video Thumbnail">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($videoInfo['title']); ?></h5>
                    <p class="card-text">Duration: <?php echo gmdate("i:s", $videoInfo['duration']); ?></p>
                    <!-- Download link triggers download.php script with the video URL -->
                    <a href="download.php?url=<?php echo urlencode($directUrl); ?>&title=<?php echo urlencode($videoInfo['title']); ?>&ext=<?php echo urlencode($videoInfo['ext']); ?>" class="btn btn-success">Download Video</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
