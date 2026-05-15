<?php
include('../models/db.php');
include('../models/Auth.php');

checkAdmin();

$con=getConnection();

$result=mysqli_query($con,"SELECT * FROM content_requests");
?>

<h2>Admin Requests</h2>

<table border="1">

<tr>
<th>Title</th>
<th>Category</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>
<td><?= $row['content_title'] ?></td>
<td><?= $row['category_requested'] ?></td>
<td><?= $row['status'] ?></td>
<td>
<a href="../controller/update_status.php?id=<?= $row['id'] ?>&status=approved">Approve</a>
|
<a href="../controller/update_status.php?id=<?= $row['id'] ?>&status=rejected">Reject</a>
</td>
</tr>

<?php } ?>

</table>