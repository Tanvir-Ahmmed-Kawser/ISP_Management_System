<?php
include('db.php');

function getAllContents(){
    $con = getConnection();
    return mysqli_query($con,"SELECT * FROM contents");
}

function searchContent($q){
    $con = getConnection();

    $q = "%".$q."%";

    $stmt = mysqli_prepare($con,
    "SELECT * FROM contents WHERE title LIKE ? OR description LIKE ?");

    mysqli_stmt_bind_param($stmt,"ss",$q,$q);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}
?>