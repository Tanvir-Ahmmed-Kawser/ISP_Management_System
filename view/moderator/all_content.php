<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Uploaded Contents</title>
    <link rel="stylesheet" href="../../asset/CSS/all_content.css">
</head>
<body>

<div class="container">
    <h1>All Uploaded Contents</h1>

    <form method="GET" action="../../controller/Moderator/view_content.php" class="search-form">
        <input type="text"
               name="search"
               placeholder="Search by title"
               value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

        <select name="category">
            <option value="">All Categories</option>
            <option value="1">Movies</option>
            <option value="2">Software</option>
            <option value="3">TV Series</option>
            <option value="4">Games</option>
            <option value="5">Music</option>
            <option value="6">E-Books</option>
        </select>

        <button type="submit">Search</button>
    </form>

    <table>
        <tr>
            <th>Title</th>
            <th>Discription</th>
            <th>Catagory</th>
            <th>File</th>
           
        </tr>

        <?php if (!empty($contents)) { ?>
            <?php foreach ($contents as $row) { ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td><a href="../../uploads/<?php echo $row['file_path']; ?>" target="_blank">View File</a></td>
                   
                       
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5">No content found.</td>
            </tr>
        <?php } ?>
    </table>

    <a href="../../view/moderator/dashboard.php" class="back-btn">Back</a>
</div>

</body>
</html>