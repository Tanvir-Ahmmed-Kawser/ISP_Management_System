<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'ISP Media FTP'; ?></title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <header class="main-header">
        <div class="brand-box">
            <h1>ISP Media FTP</h1>
            <p>Task 4 - Member Browse, Search, Filter and Request Box</p>
        </div>

        <nav class="top-nav">
            <a href="member.php">Home</a>
            <a href="member.php#browseSection">Browse</a>
            <a href="member.php#requestBox">Request Box</a>
            <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'moderator')){ ?>
                <a href="requests.php">Manage Requests</a>
            <?php } ?>
        </nav>
    </header>
