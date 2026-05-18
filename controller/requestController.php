<?php
require_once __DIR__ . '/../models/authModel.php';
require_once __DIR__ . '/../models/requestModel.php';
require_once __DIR__ . '/../models/categoryModel.php';

task4StartSession();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: ../views/member.php');
    exit;
}

if(!task4ValidateCsrfToken($_POST['csrf_token'] ?? '')){
    $_SESSION['task4_error'] = 'Security token mismatch. Please refresh and try again.';
    header('Location: ../views/member.php#requestBox');
    exit;
}

$title = trim($_POST['content_title'] ?? '');
$category_id = (int)($_POST['category_id'] ?? 0);
$message = trim($_POST['message'] ?? '');
$requester_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

if($title === '' || strlen($title) < 2 || strlen($title) > 100 || $category_id <= 0 || !task4CategoryExists($category_id) || strlen($message) > 500){
    $_SESSION['task4_error'] = 'Please provide a valid title, category, and message.';
    header('Location: ../views/member.php#requestBox');
    exit;
}

$ok = task4AddContentRequest($title, (string)$category_id, $message, $requester_ip);
$_SESSION[$ok ? 'task4_success' : 'task4_error'] = $ok ? 'Your request has been submitted.' : 'Request could not be submitted.';
header('Location: ../views/member.php#requestBox');
exit;
?>
