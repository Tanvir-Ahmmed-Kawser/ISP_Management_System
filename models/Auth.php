<?php
session_start();

function checkAdminOrModerator(){

    if(!isset($_SESSION['role'])){
        die("Access Denied");
    }

    if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'moderator'){
        die("Access Denied");
    }
}
?>