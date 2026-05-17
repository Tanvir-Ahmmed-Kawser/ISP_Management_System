<?php
session_start();
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../../view/login.php');
    }
require_once(__DIR__ . '/../../models/RequestModel.php');

$requests = getAllRequests();

include(__DIR__ . '/../../view/moderator/request.php');
?>