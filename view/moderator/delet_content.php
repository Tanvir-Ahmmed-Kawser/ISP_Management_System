<?php
session_start();
require_once(__DIR__ . '/../../models/ContentModel.php');

$contents = getAllContents();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Content</title>
    <link rel="stylesheet" href="../../asset/CSS/all_content.css">
</head>
<body>

<div class="container">
    <h1>Delete Uploaded Content</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <p class="success">
            <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            ?>
        </p>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <p class="error">
            <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            ?>
        </p>
    <?php endif; ?>

    <table>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Category</th>
            <th>Uploader</th>
            <th>Downloads</th>
            <th>Action</th>
        </tr>

        <?php if (!empty($contents)): ?>
            <?php foreach ($contents as $index => $row): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['uploader_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['download_count']); ?></td>
                    <td>
                        <form method="POST"
                              action="../../controller/Moderator/delete_content_check.php"
                              onsubmit="return confirm('Are you sure you want to delete this content?');">

                            <input type="hidden"
                                   name="id"
                                   value="<?php echo $row['id']; ?>">

                            <button type="submit" class="delete-btn">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No content available to delete.</td>
            </tr>
        <?php endif; ?>
    </table>

    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
</div>

</body>
</html>