<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../models/authModel.php';
require_once __DIR__ . '/../../models/requestModel.php';
require_once __DIR__ . '/../../models/categoryModel.php';

task4StartSession();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Only POST request is allowed.']);
    exit;
}

if(!task4ValidateCsrfToken($_POST['csrf_token'] ?? '')){
    echo json_encode(['success' => false, 'message' => 'Security token mismatch. Please refresh and try again.']);
    exit;
}

$title = trim($_POST['content_title'] ?? '');
$category_id = (int)($_POST['category_id'] ?? 0);
$message = trim($_POST['message'] ?? '');
$requester_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

if($title === ''){
    echo json_encode(['success' => false, 'message' => 'Content title is required.']);
    exit;
}

if(strlen($title) < 2 || strlen($title) > 100){
    echo json_encode(['success' => false, 'message' => 'Title must be between 2 and 100 characters.']);
    exit;
}

if($category_id <= 0 || !task4CategoryExists($category_id)){
    echo json_encode(['success' => false, 'message' => 'Please select a valid category.']);
    exit;
}

if(strlen($message) > 500){
    echo json_encode(['success' => false, 'message' => 'Message cannot exceed 500 characters.']);
    exit;
}

$category_requested = (string)$category_id;
$ok = task4AddContentRequest($title, $category_requested, $message, $requester_ip);

echo json_encode([
    'success' => $ok,
    'message' => $ok ? 'Your content request has been submitted.' : 'Request could not be submitted.'
]);
?>
