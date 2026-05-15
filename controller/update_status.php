<?php
include('../models/db.php');

$con=getConnection();

$id=$_GET['id'];
$status=$_GET['status'];

mysqli_query($con,
"UPDATE content_requests SET status='$status' WHERE id=$id");

header("location: ../views/admin_requests.php");
?>