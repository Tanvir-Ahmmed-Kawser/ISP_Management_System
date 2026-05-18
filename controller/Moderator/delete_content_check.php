<?php
session_start();

if(!isset($_SESSION['status'])){
    echo "Invalid request. Please login again";
    header('location: ../../view/login.php');
}
require_once(__DIR__ . '/../../models/ContentModel.php');
//check if ajax request
$isAjax = isset($_POST['ajax']) && $_POST['ajax'] === '1';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])) {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    } else {
        $_SESSION['error'] = "Invalid request.";
        header('Location: ../../view/moderator/delet_content.php');
    }
    exit;
}
//validate id
$id = intval($_POST['id']);
if ($id <= 0) {
//invalid id
if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Invalid content ID.']);
    } else {
        $_SESSION['error'] = "Invalid content ID.";
        header('Location: ../../view/moderator/delet_content.php');
    }
    exit;
}
// perform deletion
$result = deleteContent($id);

if ($isAjax) {
    header('Content-Type: application/json');
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Content deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete content.']);
    }
    exit;
}

if ($result) {
    $_SESSION['success'] = "Content deleted successfully.";
} else {
    $_SESSION['error'] = "Failed to delete content.";
}

header('Location: ../../view/moderator/delet_content.php');
exit;
