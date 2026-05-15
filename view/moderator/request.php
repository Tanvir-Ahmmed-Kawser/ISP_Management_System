<?php
session_start();
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Content Requests</title>
    <link rel="stylesheet" href="../../asset/CSS/manage.css">
</head>
<body>
<div class="dashboard">
   

    <div class="container">
        <h1>Member Content Requests</h1>

        <table>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Message</th>a
                <th>Status</th>
                <th>Update</th>
            </tr>

            <?php foreach ($requests as $row): ?>
            <tr>
                <td><?= $row['content_title'] ?></td>
                <td><?= $row['category_requested'] ?></td>
                <td><?= $row['message'] ?></td>
                <td id="status-<?= $row['id'] ?>"><?= $row['status'] ?></td>
                <td>
                    <select onchange="updateStatus(<?= $row['id'] ?>, this.value)">
                        <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="fulfilled" <?= $row['status'] == 'fulfilled' ? 'selected' : '' ?>>Fulfilled</option>
                        <option value="rejected" <?= $row['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                    </select>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<script src="../../asset/JS/moderator.js"></script>
</body>
</html>