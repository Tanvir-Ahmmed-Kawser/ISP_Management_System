<?php
include('db.php');

function addRequest($title,$category,$message,$ip){

    $con = getConnection();

    $status = "pending";

    $stmt = mysqli_prepare($con,
    "INSERT INTO content_requests
    (content_title,category_requested,message,requester_ip,status)
    VALUES(?,?,?,?,?)");

    mysqli_stmt_bind_param($stmt,"sssss",
    $title,$category,$message,$ip,$status);

    return mysqli_stmt_execute($stmt);
}
?>