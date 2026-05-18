<?php

include('db.php');

function addRequest($title, $category, $message){

    global $conn;

    $status = "pending";

    $stmt = mysqli_prepare($conn,
    "INSERT INTO content_requests
    (content_title, category_requested, message, status)
    VALUES(?,?,?,?)");

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $title,
        $category,
        $message,
        $status
    );

    return mysqli_stmt_execute($stmt);
}

?>