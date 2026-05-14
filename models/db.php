<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ftp_server";

$conn = new mysqli($host, $user, $pass, $dbname);

if($conn->connect_error){
    die("Connection Failed");
}

?>