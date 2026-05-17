<?php
require_once __DIR__ . '/../models/contentModel.php';

$content_id = (int)($_GET['id'] ?? 0);
$content = task4GetContentById($content_id);

if(!$content){
    die('Content not found.');
}

$file_path = __DIR__ . '/../' . ltrim($content['file_path'], '/');

if(!file_exists($file_path)){
    die('File is missing from the server.');
}

task4IncrementDownloadCount($content_id);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
header('Content-Length: ' . filesize($file_path));
readfile($file_path);
exit;
?>
