<?php
    session_start();
    require_once '../../models/database.php';
    require_once '../../models/content.php';
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../login.php');
    }
    $contents = getAllContent();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contents</title>
    <link rel="stylesheet" href="../../asset/CSS/manage.css">
    
</head>
<body>
    <div class="dashboard">
        <?php 
            require_once 'sideBar.php';
        ?>
        <div class="container">
            <div id="topDiv">
                <h1>Manage Contents</h1>
                <input type="button" value="Add new Content" class="btn" id="addContent" 
                onclick="window.location.href='addContent.php'">
            </div>
            <div>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Cetagory</th>
                        <th>Uploader</th>
                        <th>Path</th>
                        <th>Action</th>
                    </tr>
                    <?php if(count($contents)>0) {?>
                        <?php foreach($contents as $content){ ?>
                            <tr>
                                <td>
                                    <?php echo $content['id']; ?>
                                </td>
                                <td>
                                    <?php echo $content['title']; ?>
                                </td>
                                <td>
                                    <?php echo $content['category']; ?>
                                </td>
                                <td>
                                    <?php echo $content['uploader']; ?>
                                </td>
                                <td>
                                    <?php echo $content['file_path']; ?>
                                </td>
                                <td>
                                    <a href="managementUi.php">View</a>
                                    <a href="managementUi.php">Edit</a>
                                    <a href="../../controller/adminController/contentController.php?delete_id=<?php echo $content['id']; ?>">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } 
                    else{ ?>
                        <tr>
                            <td colspan="6" align="center">
                                No content inserted yet...
                            </td>
                        </tr>

                    <?php } ?>
                </table>
            </div>            
        </div>
    </div>
    <?php 
        include_once '../footer.php';
    ?>
</body>
</html>