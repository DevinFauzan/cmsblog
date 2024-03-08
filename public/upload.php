<?php
error_log("Received image upload request");
header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
// Only these origins are allowed to upload images
$accepted_origins = array("http://localhost");

// Set the upload folder
$imageFolder = "/storage/media";

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // same-origin requests won't set an origin. If the origin is set, it must be valid.
    if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
    } else {
        header("HTTP/1.1 403 Origin Denied");
        exit();
    }
}

// Don't attempt to process the upload on an OPTIONS request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    exit();
}

reset($_FILES);
$temp = current($_FILES);
if (is_uploaded_file($temp['tmp_name'])) {
    // Sanitize input
    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
        header("HTTP/1.1 400 Invalid file name.");
        exit();
    }

    // Verify extension
    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "jpeg", "png"))) {
        header("HTTP/1.1 400 Invalid extension.");
        exit();
    }

    // Accept upload if there was no origin, or if it is an accepted origin
    $filetowrite = $imageFolder . $temp['name'];
    if (move_uploaded_file($temp['tmp_name'], $filetowrite)) {
        // Determine the base URL
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https://" : "http://";
        $baseurl = $protocol . $_SERVER["HTTP_HOST"] . rtrim(dirname($_SERVER['REQUEST_URI']), "/") . "/";

        // Respond to the successful upload with JSON.
        // Use a location key to specify the path to the saved image resource.
        $response = ['location' => $baseurl . $filetowrite];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit(); // Add exit to stop script execution after sending the response
    } else {
        header("HTTP/1.1 400 Upload failed.");
        exit();
    }
} else {
    // Notify editor that the upload failed
    header("HTTP/1.1 500 Server Error");
    exit();
}
?>
