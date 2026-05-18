<?php
session_start();
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../../view/login.php');
    }
require_once(__DIR__ . '/../../models/ContentModel.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$contents = getAllContents($search, $category);

include(__DIR__ . '/../../view/moderator/all_content.php');
?>