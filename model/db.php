<?php
    $host = "127.0.0.1";
    $dbuser = "root";
    $dbpassword = "";
    $bdname ="projectdb";
    function getConnection(){
        global $host;
        global $dbuser;
        global $dbpassword;
        global $bdname;

        $con = mysqli_connect($host, $dbuser, $dbpassword, $bdname);
    }
?>