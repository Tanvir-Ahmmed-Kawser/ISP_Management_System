<?php

include('../../models/db.php');

$q = $_GET['q'];

$query = "SELECT * FROM contents
WHERE title LIKE '%$q%'
OR description LIKE '%$q%'";

$result = mysqli_query($conn, $query);

$data = [];

while($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
}

header('Content-Type: application/json');

echo json_encode($data);

?>