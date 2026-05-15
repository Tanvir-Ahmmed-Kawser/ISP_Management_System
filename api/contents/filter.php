<?php
include('../../models/db.php');

$con = getConnection();

$cat = $_GET['category'];
$sub = $_GET['subcategory'];

$query = "SELECT * FROM contents WHERE 1=1";

if($cat!="") $query.=" AND category_id='$cat'";
if($sub!="") $query.=" AND subcategory_id='$sub'";

$result = mysqli_query($con,$query);

$data=[];

while($row=mysqli_fetch_assoc($result)){
    $data[]=$row;
}

echo json_encode($data);
?>