<?php
require_once __DIR__ . '/../models/authModel.php';
require_once __DIR__ . '/../models/requestModel.php';

task4RequireAdminOrModerator();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: ../views/requests.php');
    exit;
}

if(!task4ValidateCsrfToken($_POST['csrf_token'] ?? '')){
    $_SESSION['task4_error'] = 'Security token mismatch. Please refresh and try again.';
    header('Location: ../views/requests.php');
    exit;
}

$request_id = (int)($_POST['request_id'] ?? 0);
$status = $_POST['status'] ?? '';
$ok = task4UpdateContentRequestStatus($request_id, $status);

$_SESSION[$ok ? 'task4_success' : 'task4_error'] = $ok ? 'Request status updated.' : 'Invalid status or update failed.';
header('Location: ../views/requests.php');
exit;
?>
