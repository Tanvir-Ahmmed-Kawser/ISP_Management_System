<?php
session_start();
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../../view/login.php');
    }
require_once(__DIR__ . '/../../models/ContentModel.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])) {
    $_SESSION['error'] = "Invalid request.";
    header('Location: ../../view/moderator/delet_content.php');
    exit;
}

$id = intval($_POST['id']);
if ($id <= 0) {
    $_SESSION['error'] = "Invalid content ID.";
    header('Location: ../../view/moderator/delet_content.php');
    exit;
}

$result = deleteContent($id);

if ($result) {
    $_SESSION['success'] = "Content deleted successfully.";
} else {
    $_SESSION['error'] = "Failed to delete content.";
}

header('Location: ../../view/moderator/delet_content.php');
exit;
