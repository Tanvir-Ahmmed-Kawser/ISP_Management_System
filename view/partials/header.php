<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>

<title>FTP Server</title>

<link rel="stylesheet"
href="../asset/css/style.css">

</head>

<body>

<nav>

<a href="home.php">Home</a>

<?php if(isset($_SESSION['user_id'])){ ?>

<a href="profile.php">Profile</a>

<a href="../controller/LogoutController.php">
Logout
</a>

<?php } else { ?>

<a href="login.php">Login</a>

<?php } ?>

</nav>

<div class="container">