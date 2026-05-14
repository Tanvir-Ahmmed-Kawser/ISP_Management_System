<?php

include('../../models/Request.php');

$title = $_POST['title'];
$category = $_POST['category'];
$message = $_POST['message'];

$result = addRequest($title, $category, $message);

header('Content-Type: application/json');

echo json_encode([
    "success" => $result
]);

?>