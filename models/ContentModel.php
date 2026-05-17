<?php
require_once(__DIR__ . '/database.php');

function addContent($title, $desc, $file, $cat, $user) {
    $conn = getConnection();

    $sql = "INSERT INTO contents
    (title, description, file_path, category_id, uploader_id)
    VALUES
    ('" . mysqli_real_escape_string($conn, $title) . "', '" . mysqli_real_escape_string($conn, $desc) . "', '" . mysqli_real_escape_string($conn, $file) . "', '" . mysqli_real_escape_string($conn, $cat) . "', '" . mysqli_real_escape_string($conn, $user) . "')";

    return mysqli_query($conn, $sql);
}
?>