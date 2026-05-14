<?php include("partials/header.php"); ?>

<h2>Register</h2>

<form method="POST"
action="../controller/AuthController.php"
onsubmit="return validateRegister()">

<input type="text"
name="name"
placeholder="Enter Name"
required>

<input type="email"
name="email"
placeholder="Enter Email"
required>

<input type="password"
id="password"
name="password"
placeholder="Enter Password"
required>

<input type="password"
id="confirm_password"
name="confirm_password"
placeholder="Confirm Password"
required>

<select name="role">

<option value="admin">Admin</option>

<option value="moderator">
Moderator
</option>

</select>

<button type="submit"
name="register">

Register

</button>

</form>

<script src="../asset/js/validation.js"></script>

<?php include("partials/footer.php"); ?>