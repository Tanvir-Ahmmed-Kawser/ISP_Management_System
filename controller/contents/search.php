<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../models/contentModel.php';

$q = $_GET['q'] ?? '';
$category_id = $_GET['category_id'] ?? 0;
$subcategory_id = $_GET['subcategory_id'] ?? 0;
$file_type = $_GET['file_type'] ?? '';

$result = task4SearchContents($q, $category_id, $subcategory_id, $file_type);
$contents = [];

while($row = mysqli_fetch_assoc($result)){
    $contents[] = [
        'id' => (int)$row['id'],
        'title' => $row['title'],
        'description' => $row['description'],
        'file_path' => $row['file_path'],
        'download_count' => (int)$row['download_count'],
        'uploaded_at' => $row['uploaded_at'],
        'category_name' => $row['category_name'],
        'parent_category_name' => $row['parent_category_name']
    ];
}

echo json_encode([
    'success' => true,
    'contents' => $contents
]);
?>
