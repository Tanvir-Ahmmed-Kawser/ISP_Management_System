<?php
require_once __DIR__ . '/db.php';

function task4CleanInput($value){
    return trim((string)$value);
}

// Task 4 - 23-53221-3: create content request from an unregistered member
function task4AddContentRequest($content_title, $category_requested, $message, $requester_ip){
    $con = getConnection();

    $content_title = task4CleanInput($content_title);
    $category_requested = task4CleanInput($category_requested);
    $message = task4CleanInput($message);
    $requester_ip = task4CleanInput($requester_ip);
    $status = 'pending';

    if($content_title === '' || $category_requested === ''){
        return false;
    }

    $sql = "insert into content_requests(requester_ip, content_title, category_requested, message, status, created_at)
            values(?, ?, ?, ?, ?, now())";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $requester_ip, $content_title, $category_requested, $message, $status);
    return mysqli_stmt_execute($stmt);
}

// Task 4 - 23-53221-3: admin/moderator read request list
function task4GetAllContentRequests(){
    $con = getConnection();
    $sql = "select id, requester_ip, content_title, category_requested, message, status, created_at
            from content_requests
            order by created_at desc, id desc";
    return mysqli_query($con, $sql);
}

// Task 4 - 23-53221-3: admin/moderator update request status
function task4UpdateContentRequestStatus($request_id, $status){
    $con = getConnection();

    $request_id = (int)$request_id;
    $status = strtolower(trim((string)$status));
    $allowed = ['pending', 'fulfilled', 'rejected'];

    if($request_id <= 0 || !in_array($status, $allowed, true)){
        return false;
    }

    $sql = "update content_requests set status = ? where id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "si", $status, $request_id);
    return mysqli_stmt_execute($stmt);
}
?>
