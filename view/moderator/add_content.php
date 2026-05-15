<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Content</title>
    <link rel="stylesheet" href="../../asset/CSS/manage.css">
</head>

<body>

<div class="dashboard">
<div class="container">

<h1>Add New Content</h1>

<?php if(isset($_SESSION['success'])){ ?>
<p class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
<?php } ?>

<?php if(isset($_SESSION['error'])){ ?>
<p class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php } ?>

<form id="contentForm"
      method="POST"
      enctype="multipart/form-data"
       action="../../controller/Moderator/moderatorController.php?view=add">

<table>

<tr>
<td>Title</td>
<td><input type="text" name="title"></td>
</tr>

<tr>
<td>Description</td>
<td><textarea name="description"></textarea></td>
</tr>

<tr>
<td>Category</td>
<td>
<select name="category_id">
<option value="">Select</option>
<option value="1">Movies</option>
<option value="2">Software</option>
<option value="3">Games</option>
</select>
</td>
</tr>

<tr>
<td>File</td>
<td><input type="file" name="content_file" id="content_file"></td>
</tr>

<tr>
<td colspan="2">
<button type="button" onclick="uploadCheck()" class="action-btn">
    Upload
</button>

<a href="dashboard.php" class="action-btn back-btn">
    Back
</a>
</td>
</tr>

</table>

</form>

</div>
</div>

<script src="../../asset/js/moderator.js"></script>

</body>
</html>