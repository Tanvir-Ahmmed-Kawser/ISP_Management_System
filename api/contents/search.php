<?php
include('../../models/Content.php');

$q = $_GET['q'];

$result = searchContent($q);

$data = [];

while($row=mysqli_fetch_assoc($result)){
    $data[]=$row;
}

echo json_encode($data);
?>