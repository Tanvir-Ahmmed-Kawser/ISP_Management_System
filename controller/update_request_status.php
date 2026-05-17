<?php
session_start();
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../view/login.php');
    }

require_once(__DIR__ . '/../../models/RequestModel.php');

if (isset($_POST['id']) && isset($_POST['status'])) {

    $id = $_POST['id'];
    $status = $_POST['status'];

    if (updateRequestStatus($id, $status)) {
        echo "success";
    } else {
        echo "failed";
    }

} else {
    echo "invalid";
}
?>