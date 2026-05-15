<?php
include('../models/Category.php');
$cats=getCategories();
?>

<h2>Request Box</h2>

<form action="../controller/MemberController.php" method="POST">

<input type="text" name="title" placeholder="Title"><br><br>

<select id="category" name="category">
<?php while($c=mysqli_fetch_assoc($cats)){ ?>
<option value="<?= $c['name'] ?>"><?= $c['name'] ?></option>
<?php } ?>
</select>

<br><br>

<select id="subcategory" name="subcategory"></select>

<br><br>

<textarea name="message"></textarea>

<input type="hidden" name="ip" value="<?= $_SERVER['REMOTE_ADDR']; ?>">

<br><br>

<button type="submit">Send</button>

</form>

<script src="../assets/js/request.js"></script>