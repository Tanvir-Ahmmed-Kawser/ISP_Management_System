<?php
    session_start();
    require_once '../../models/database.php';
    require_once '../../models/category.php';
    require_once '../../models/content.php';
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../login.php');
    }
    $categories = getAllCategory();
    $content = null;
    if(isset($_GET['edit_id'])){
        $id = $_GET['edit_id'];
        $content = getContentById($id);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Content</title>
    <link rel="stylesheet" href="../../asset/CSS/manage.css">
</head>
<body>
<div class="dashboard">
    <?php
        require_once 'sideBar.php';
    ?>
    <div class="container">
        <h1>Edit Content</h1>
        <form method="POST" action="../../controller/adminController/contentController.php" enctype="multipart/form-data">
            <table border="1">
                <input type="hidden" name="id" value="<?php echo $content['id']; ?>">
                <tr>
                    <td class="dataIndex">Title</td>
                    <td>
                        <input type="text" name="title" id="title" value="<?php echo $content['title']; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="dataIndex">Description</td>
                    <td>
                        <textarea name="description" rows="5" id="description"><?php echo $content['description']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="dataIndex">Category</td>
                    <td>
                        <select name="category" id="category">
                            <option value="">
                                Select Category
                            </option>
                            <?php foreach($categories as $category){ ?>
                                <option value="<?php echo $category['id']; ?>" 
                                <?php if($content['category_id'] == $category['id']){ echo "selected";}?>>
                                    <?php echo $category['name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="dataIndex"> Upload New File </td>
                    <td>
                        <input type="file" name="file" id="file" accept=".jpg,.jpeg,.png,.pdf,.mp4,.exe">
                        <br><br>
                        Current File: <?php echo $content['file_path']; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="update" value="Update Content" class="btn">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    include_once '../footer.php';
?>
</body>
</html>