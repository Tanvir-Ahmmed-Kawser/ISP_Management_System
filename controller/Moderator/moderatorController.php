<?php

session_start();
require_once(__DIR__ . '/../../models/ContentModel.php');

// STEP 1: only POST allowed
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = "Invalid request";
    header('Location: ../../view/moderator/add_content.php');
    exit;
}

// STEP 2: validation
if (
    empty($_POST['title']) ||
    empty($_POST['description']) ||
    empty($_POST['category_id']) ||
    empty($_FILES['content_file']['name'])
) {
    $_SESSION['error'] = "All fields are required";
    header('Location: ../../view/moderator/add_content.php');
    exit;
}

// STEP 3: data
$title = $_POST['title'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];

// no login required
$user_id = $_SESSION['id'];

// STEP 4: file upload
$file = $_FILES['content_file'];

$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
$new_name = time() . '_' . rand(1000,9999) . '.' . $ext;

$upload_path = __DIR__ . '/../../asset/Public/Contents' . $new_name;

if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
    $_SESSION['error'] = "File upload failed";
    header('Location: ../../view/moderator/add_content.php');
    exit;
}

// STEP 5: DB insert
$result = addContent($title, $description, $new_name, $category_id, $user_id);

// STEP 6: response
if ($result) {
    $_SESSION['success'] = "Content uploaded successfully";
} else {
    $_SESSION['error'] = "Database insert failed";
}

header('Location: ../../view/moderator/add_content.php');
exit;

?>