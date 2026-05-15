<?php
include('../../models/db.php');

$con = getConnection();

$id = $_GET['category_id'];

$result = mysqli_query($con,
"SELECT * FROM subcategories WHERE category_id=$id");

$data=[];

while($row=mysqli_fetch_assoc($result)){
    $data[]=$row;
}

echo json_encode($data);
?>