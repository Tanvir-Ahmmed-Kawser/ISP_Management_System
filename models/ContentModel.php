<?php

require_once(__DIR__ . '/database.php');
function addContent($title, $desc, $file, $cat, $user) {
    $conn = getConnection();

    $sql = "INSERT INTO contents
    (title, description, file_path, category_id, uploader_id)
    VALUES
    ('" . mysqli_real_escape_string($conn, $title) . "',
     '" . mysqli_real_escape_string($conn, $desc) . "',
     '" . mysqli_real_escape_string($conn, $file) . "',
     '" . mysqli_real_escape_string($conn, $cat) . "',
     '" . mysqli_real_escape_string($conn, $user) . "')";

    return mysqli_query($conn, $sql);
}


function getAllContents($search = '', $category = '') {
    $conn = getConnection();

    $sql = "SELECT * FROM contents WHERE 1=1";

    // Search by title
    if ($search != '') {
        $search = mysqli_real_escape_string($conn, $search);
        $sql .= " AND title LIKE '%$search%'";
    }

    // Filter by category_id
    if ($category != '') {
        $category = mysqli_real_escape_string($conn, $category);
        $sql .= " AND category_id = '$category'";
    }

    $sql .= " ORDER BY id DESC";

    $result = mysqli_query($conn, $sql);

    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        // Create readable category names manually
        switch ($row['category_id']) {
            case 1:
                $row['category_name'] = 'Movies';
                break;
            case 2:
                $row['category_name'] = 'Software';
                break;
            case 3:
                $row['category_name'] = 'TV Series';
                break;
            case 4:
                $row['category_name'] = 'Games';
                break;
            case 5:
                $row['category_name'] = 'Music';
                break;
            case 6:
                $row['category_name'] = 'E-Books';
                break;
            default:
                $row['category_name'] = 'Unknown';
        }

        // Show uploader ID since users table may not exist
        $row['uploader_name'] = 'User ID: ' . $row['uploader_id'];

        // Ensure download_count exists
        if (!isset($row['download_count'])) {
            $row['download_count'] = 0;
        }

        $data[] = $row;
    }

    return $data;
}

function getContentById($id) {
    $conn = getConnection();
    $id = mysqli_real_escape_string($conn, $id);
    $result = mysqli_query($conn, "SELECT * FROM contents WHERE id='$id'");
    return mysqli_fetch_assoc($result);
}

function incrementDownloadCount($id) {
    $conn = getConnection();
    $id = mysqli_real_escape_string($conn, $id);
    return mysqli_query($conn, "UPDATE contents SET download_count = download_count + 1 WHERE id='$id'");
}
//new function to increment upload count for a user
function incrementUserUploadCount($user_id) {
    $conn = getConnection();
    $user_id = mysqli_real_escape_string($conn, $user_id);

    // If there is no `users` table, nothing to do.
    $tbl = mysqli_query($conn, "SHOW TABLES LIKE 'users'");
    if (!$tbl || mysqli_num_rows($tbl) == 0) {
        return false;
    }

    // Ensure the column exists; add it if missing.
    $col = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'upload_count'");
    if ($col && mysqli_num_rows($col) == 0) {
        mysqli_query($conn, "ALTER TABLE users ADD COLUMN upload_count INT NOT NULL DEFAULT 0");
    }

    return mysqli_query($conn, "UPDATE users SET upload_count = upload_count + 1 WHERE id='$user_id'");
}

/* DELETE CONTENT */
function deleteContent($id) {
    $conn = getConnection();

    $id = mysqli_real_escape_string($conn, $id);

    $result = mysqli_query($conn, "SELECT file_path FROM contents WHERE id='$id'");

    if ($row = mysqli_fetch_assoc($result)) {
        $file = __DIR__ . '/../uploads/' . $row['file_path'];

        if (file_exists($file)) {
            unlink($file);
        }
    }

    return mysqli_query($conn, "DELETE FROM contents WHERE id='$id'");
}
?>