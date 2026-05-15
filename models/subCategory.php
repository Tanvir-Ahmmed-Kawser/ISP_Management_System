<?php
include('db.php');

function getSubCategories($id){
    $con = getConnection();
    return mysqli_query($con,"SELECT * FROM subcategories WHERE category_id=$id");
}
?>