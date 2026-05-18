<?php
session_start();
if(!isset($_SESSION['status'])){
    echo json_encode(['success' => false, 'message' => 'Invalid request. Please login again']);
    exit;
}
//check update request status
require_once(__DIR__ . '/../../models/RequestModel.php');
header('Content-Type: application/json');

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = trim($_POST['status']);

    if ($id > 0 && updateRequestStatus($id, $status)) {
        echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update status']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request data']);
}
?>