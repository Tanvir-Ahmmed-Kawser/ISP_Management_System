<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../models/categoryModel.php';

$category_id = (int)($_GET['category_id'] ?? 0);

if($category_id <= 0){
    echo json_encode(['success' => false, 'subcategories' => []]);
    exit;
}

$result = task4GetSubCategories($category_id);
$subcategories = [];

while($row = mysqli_fetch_assoc($result)){
    $subcategories[] = [
        'id' => (int)$row['id'],
        'name' => $row['name']
    ];
}

echo json_encode([
    'success' => true,
    'subcategories' => $subcategories
]);
?>
