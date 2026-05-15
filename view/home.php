<?php

require_once 'header.php';

require_once("../models/db.php");

?>

<h1>Welcome to FTP Server System</h1>
<h2>Categories</h2>

<?php

$query =
"SELECT * FROM categories
WHERE parent_id IS NULL";

$result = $conn->query($query);

while($row = $result->fetch_assoc()){

?>

<div class="card">

<h3>

<a href="category.php?id=<?php echo $row['id']; ?>">

<?php echo htmlspecialchars($row['name']); ?>

</a>

</h3>

</div>

<?php
}

require_once 'Member.php';
?>

<?php include_once 'footer.php'; ?>