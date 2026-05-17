<?php
session_start();

/*
If controller does not send $requests,
initialize it as an empty array.
*/
if (!isset($requests) || !is_array($requests)) {
    $requests = array();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Content Requests</title>
    <link rel="stylesheet" href="../../asset/CSS/style.css">
</head>
<body>

<div class="dashboard">
    <div class="container">
        <h1>Member Content Requests</h1>

        <table>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Message</th>
                <th>Status</th>
                <th>Update</th>
            </tr>

            <?php if (!empty($requests)) { ?>
                <?php foreach ($requests as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['content_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['category_requested']); ?></td>
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                        <td id="status-<?php echo $row['id']; ?>">
                            <?php echo htmlspecialchars($row['status']); ?>
                        </td>
                        <td>
                            <select onchange="updateStatus(<?php echo $row['id']; ?>, this.value)">
                                <option value="pending"
                                    <?php if ($row['status'] == 'pending') echo 'selected'; ?>>
                                    Pending
                                </option>

                                <option value="fulfilled"
                                    <?php if ($row['status'] == 'fulfilled') echo 'selected'; ?>>
                                    Fulfilled
                                </option>

                                <option value="rejected"
                                    <?php if ($row['status'] == 'rejected') echo 'selected'; ?>>
                                    Rejected
                                </option>
                            </select>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="5">No content requests found.</td>
                </tr>
            <?php } ?>
        </table>

        <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    </div>
</div>

<script src="../../asset/JS/moderator.js"></script>
</body>
</html>