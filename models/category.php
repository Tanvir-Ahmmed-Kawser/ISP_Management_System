<?php
include('db.php');

function getCategories(){
    $con = getConnection();
    return mysqli_query($con,"SELECT * FROM categories");
}
?>