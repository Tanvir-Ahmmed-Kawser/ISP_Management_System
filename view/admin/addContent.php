



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
        <form method="POST" enctype="multipart/form-data">
            <table border="1">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" rows="5">
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">
                            <option value="">
                                Select Category
                            </option>                       
                        </select>
                    </td>               
                </tr>
                <tr>
                    <td>Upload File</td>
                    <td>
                        <input type="file" name="content_file">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="upload" value="Upload Content" class="btn">
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