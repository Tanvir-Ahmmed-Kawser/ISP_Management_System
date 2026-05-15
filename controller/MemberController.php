<?php

include('../models/Request.php');

if(isset($_POST['submit'])){

    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $message = trim($_POST['message']);

    if($title == "" || $category == ""){

        echo "Required fields missing!";
        exit;
    }

    $result = addRequest($title, $category, $message);

    if($result){
        header("Location: ../views/member.php");
    }
    else{
        echo "Insert Failed";
    }

}
?>