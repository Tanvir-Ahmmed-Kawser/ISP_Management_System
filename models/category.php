<?php
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../view/login.php');
    }
    require_once('database.php');

    function getAllCategory(){

        $con = getConnection();

        $sql = "select * from categories";

        $result = mysqli_query($con, $sql);

        $categories = [];

        while($row = mysqli_fetch_assoc($result)){
            array_push($categories, $row);
        }
        return $categories;
    }
?>