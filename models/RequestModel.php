<?php
require_once(__DIR__ . '/database.php');

/* Get all requests */
function getAllRequests() {
    $conn = getConnection();

    $sql = "SELECT * FROM content_requests ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

/* Update request status */
function updateRequestStatus($id, $status) {
    $conn = getConnection();

    $id = mysqli_real_escape_string($conn, $id);
    $status = mysqli_real_escape_string($conn, $status);

    $sql = "UPDATE content_requests
            SET status = '$status'
            WHERE id = '$id'";

    return mysqli_query($conn, $sql);
}
?>