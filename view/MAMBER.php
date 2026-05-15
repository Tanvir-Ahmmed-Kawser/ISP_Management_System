<?php
include('../models/Content.php');
$result=getAllContents();
?>

<h2>Member Panel</h2>

<input type="text" id="search">
<button onclick="searchData()">Search</button>

<div id="result">

<table border="1">
<tr>
<th>Title</th>
<th>Description</th>
<th>Download</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>
<td><?= $row['title'] ?></td>
<td><?= $row['description'] ?></td>
<td><a href="../files/<?= $row['file_path'] ?>">Download</a></td>
</tr>

<?php } ?>

</table>

</div>

<script src="../assets/js/search.js"></script>

<br>
<a href="request.php">Request Content</a>