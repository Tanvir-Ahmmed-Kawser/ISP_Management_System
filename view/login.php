<?php include("header.php"); 
session_start();
?>

<h2>Login</h2>

<form method="POST"
action="../controller/AuthController.php">

<input type="email"
name="email"
placeholder="Enter Email">

<input type="password"
name="password"
placeholder="Enter Password">

<button type="submit"
name="login">

Login

</button>

</form>

<?php include("footer.php"); ?>