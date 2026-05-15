<?php
include('../models/Request.php');

$title=$_POST['title'];
$category=$_POST['category'];
$message=$_POST['message'];
$ip=$_POST['ip'];

addRequest($title,$category,$message,$ip);

header("location: ../views/request.php");
?>