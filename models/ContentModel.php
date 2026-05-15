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

/*
 * VIEW ALL CONTENTS
 * This version does NOT use categories or users tables.
 * It works even if only the contents table exists.
 */
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