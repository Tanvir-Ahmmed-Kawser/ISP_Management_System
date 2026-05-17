<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../models/authModel.php';
require_once __DIR__ . '/../../models/requestModel.php';

task4StartSession();

if(!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'moderator')){
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Only admin or moderator can update request status.']);
    exit;
}

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Only POST request is allowed.']);
    exit;
}

if(!task4ValidateCsrfToken($_POST['csrf_token'] ?? '')){
    echo json_encode(['success' => false, 'message' => 'Security token mismatch. Please refresh and try again.']);
    exit;
}

$request_id = (int)($_POST['request_id'] ?? 0);
$status = $_POST['status'] ?? '';

$ok = task4UpdateContentRequestStatus($request_id, $status);

echo json_encode([
    'success' => $ok,
    'message' => $ok ? 'Request status updated successfully.' : 'Invalid status or update failed.'
]);
?>
