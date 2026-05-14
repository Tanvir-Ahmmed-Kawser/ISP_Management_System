<?php

include("partials/header.php");

require_once("../models/db.php");

?>

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
?>

<?php include("partials/footer.php"); ?>