<?php
session_start();
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../../view/login.php');
    }
header('Content-Type: application/json');
/*
if(!isset($_SESSION['user_id'])){
    echo json_encode(["success"=>false,"message"=>"Login required"]);
    exit();
}
*/
if(!isset($_FILES['content_file'])){
    echo json_encode(["success"=>false,"message"=>"File missing"]);
    exit();
}

$file = $_FILES['content_file'];

$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$allowed = ["mp4","pdf","zip","exe","jpg","png","jpeg"];

if(!in_array($ext,$allowed)){
    echo json_encode(["success"=>false,"message"=>"Invalid file type"]);
    exit();
}

if($file['size'] > 50*1024*1024){
    echo json_encode(["success"=>false,"message"=>"File too large"]);
    exit();
}

echo json_encode(["success"=>true,"message"=>"File OK"]);
?>