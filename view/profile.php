<?php

include("partials/header.php");

require_once("../models/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

$id = $_SESSION['user_id'];

$stmt = $conn->prepare(
"SELECT * FROM users WHERE id=?"
);

$stmt->bind_param("i",$id);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

?>

<h2>Profile</h2>

<form method="POST"
enctype="multipart/form-data">

<input type="text"
value="<?php echo $user['name']; ?>">

<input type="email"
value="<?php echo $user['email']; ?>">

<button type="submit">
Update
</button>

</form>

<?php include("partials/footer.php"); ?>