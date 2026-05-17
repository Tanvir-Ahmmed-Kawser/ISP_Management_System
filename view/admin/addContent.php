<?php
    session_start();
    require_once '../../models/database.php';
    require_once '../../models/category.php';
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../login.php');
    }
    $categories = getAllCategory();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Content</title>
    <link rel="stylesheet" href="../../asset/CSS/manage.css">
</head>
<body>
<div class="dashboard">
    <?php 
        require_once 'sideBar.php';
    ?>
    <div class="container">    
        <h1>Add New Content</h1>
        <form method="POST" action="../../controller/adminController/contentController.php" enctype="multipart/form-data">
            <table border="1">
                <tr>
                    <td class="dataIndex">Title</td>
                    <td>
                        <input type="text" name="title" id="title">
                    </td>
                </tr>
                <tr>
                    <td class="dataIndex">Description</td>
                    <td>
                        <textarea name="description" rows="5" id="description">
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td class="dataIndex">Category</td>
                    <td>
                        <select name="category" id="category">
                            <option value="">
                                Select Category
                            </option>
                            <?php foreach($categories as $category){?>
                            <option value="<?php echo $category['id']; ?>">
                                <?php echo $category['name']; ?>
                            </option>
                            <?php } ?>                    
                        </select>
                    </td>               
                </tr>
                <tr>
                    <td class="dataIndex">Upload File</td>
                    <td>
                        <input type="file" name="file" id="file" accept=".jpg,.jpeg,.png,.pdf,.mp4,.exe">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" id="btnUpload" name="upload" value="Add Content" class="btn" onclick="">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script src="../../asset/JS/addContentValidation.js"></script>

<?php 
    include_once '../footer.php';
?>

</body>
</html>