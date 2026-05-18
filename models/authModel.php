<?php
function task4StartSession(){
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
}

function task4RequireAdminOrModerator(){
    task4StartSession();

    if(!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'moderator')){
        header('Location: member.php');
        exit;
    }
}

function task4CreateCsrfToken(){
    task4StartSession();

    if(empty($_SESSION['csrf_token'])){
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function task4ValidateCsrfToken($token){
    task4StartSession();
    return !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], (string)$token);
}
?>
