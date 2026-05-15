<!DOCTYPE html>
<html>
<head>
    <title>All Contents</title>
    <link rel="stylesheet" href="../../asset/CSS/moderator.css">
</head>
<body>
<div class="dashboard">
    

    <div class="container">
        <h1>All Uploaded Contents</h1>

        <table>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Uploader</th>
                <th>Downloads</th>
                <th>Action</th>
            </tr>

            <?php foreach ($contents as $row): ?>
            <tr>
                <td><?= $row['title'] ?></td>
                <td><?= $row['category_name'] ?></td>
                <td><?= $row['uploader_name'] ?></td>
                <td><?= $row['download_count'] ?></td>
                <td>
                    <a class="delete-btn"
                       href="/moderator/delete/<?= $row['id'] ?>"
                       onclick="return confirm('Delete this content?')">
                        Delete
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
</body>
</html>