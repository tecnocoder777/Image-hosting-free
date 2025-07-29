<?php
if ($_FILES['file']) {
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file = $_FILES['file'];
    $filename = uniqid() . "_" . basename($file["name"]);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $url = "https://" . $_SERVER['HTTP_HOST'] . "/uploads/" . $filename;
        echo "<p>Uploaded successfully:</p><a href='$url' target='_blank'>$url</a><br><img src='$url'>";
    } else {
        echo "Upload failed.";
    }
}
?>