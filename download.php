<?php
if (isset($_GET['url']) && isset($_GET['title']) && isset($_GET['ext'])) {
    $videoUrl = $_GET['url'];
    $videoTitle = $_GET['title'];
    $videoExt = $_GET['ext'];

    // Initialize cURL session to download the file
    $ch = curl_init($videoUrl);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the data instead of printing it
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow any redirects
    curl_setopt($ch, CURLOPT_HEADER, false);        // Don't include the header in the output

    // Execute the cURL request
    $videoData = curl_exec($ch);

    // Check if any errors occurred during the cURL request
    if (curl_errno($ch)) {
        echo "Error: " . curl_error($ch);
        curl_close($ch);
        exit;
    }

    // Get content type and file size from the headers
    $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    $contentLength = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

    // Close the cURL session
    curl_close($ch);

    // Set headers to force file download
    header('Content-Description: File Transfer');
    header('Content-Type: ' . $contentType);
    header('Content-Disposition: attachment; filename="' . $videoTitle . '.' . $videoExt . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . $contentLength);

    // Output the video data to the browser
    echo $videoData;
    exit;
} else {
    echo "Invalid request. URL, title, or file extension not provided.";
}
