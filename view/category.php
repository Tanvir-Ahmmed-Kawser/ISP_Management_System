<?php
session_start();
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../login.php');
    }
?>
<?php

include("partials/header.php");

require_once("../models/db.php");

$id = $_GET['id'];

$stmt = $conn->prepare(
"SELECT * FROM contents WHERE category_id=?"
);

$stmt->bind_param("i",$id);

$stmt->execute();

$result = $stmt->get_result();

?>

<h2>Contents</h2>

<?php

while($row = $result->fetch_assoc()){

?>

<div class="card">

<h3>
<?php echo htmlspecialchars($row['title']); ?>
</h3>

<p>
<?php echo htmlspecialchars($row['description']); ?>
</p>

<a href="<?php echo $row['file_path']; ?>">
Download
</a>

</div>

<?php
}
?>

<?php include("partials/footer.php"); ?>