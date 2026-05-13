<?php
include 'db.php';

$pid = isset($_POST['pid']) ? mysqli_real_escape_string($con, $_POST['pid']) : '';
$out = [];

// Fetch existing images
$sql = "SELECT * FROM `product` WHERE `pid` = '$pid';";
$res = mysqli_query($con, $sql);
if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $out = json_decode($row['imgs_link'], true) ?? [];
}

// Create directory if not exists
$uploadDirectory = "../storage/" . $pid . "/";
if (!file_exists($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true);
}

// Handle image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];

    if ($image['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($image['name']);
        $targetPath = $uploadDirectory . $imageName;

        if (move_uploaded_file($image['tmp_name'], $targetPath)) {
            $out[] = $imageName; // Add new image to array

            // Update database
            $jsonImages = mysqli_real_escape_string($con, json_encode($out));
            $updateSql = "UPDATE `product` SET `imgs_link` = '$jsonImages' WHERE `pid` = '$pid';";
            mysqli_query($con, $updateSql);

            echo 'Image uploaded successfully!';
        } else {
            echo 'Error moving the uploaded file.';
        }
    } else {
        echo 'Error uploading the image.';
    }
} else {
    echo 'No image uploaded.';
}
?>