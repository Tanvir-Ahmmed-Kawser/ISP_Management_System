<?php
session_start();
    require_once '../../models/database.php';
    require_once '../../models/user.php';
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../login.php');
    }
    $users = getAllModerators();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Moderator</title>
    <link rel="stylesheet" href="../../asset/CSS/manage.css">
    
</head>
<body>
    <div class="dashboard">
        <?php 
            require_once 'sideBar.php';
        ?>
        <div class="container">
            <div id="topDiv">
                <h1>Manage Moderators</h1>
                <input type="button" value="Add Moderator" class="btn" id="btnAddModerator" onclick="window.location.href='../register.php'">
            </div>
            <div>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Profile Picture</th>
                        <th>Action</th>
                    </tr>
                    <?php if(count($users) > 0){ ?>
                        <?php foreach($users as $user){ ?>            
                        <tr>
                            <td>
                                <?php echo $user['id']; ?>
                            </td>              
                            <td>
                                <?php echo $user['name']; ?>
                            </td>
                            <td>
                                <?php echo $user['email']; ?>
                            </td>
                            <td>
                                <?php echo $user['role']; ?>
                            </td>
                            <td>
                                No image.
                            </td>
                            <td>
                                <a href="#">View</a>
                                <a href="#">Edit</a>
                                <a href="../../controller/adminController/userController.php?delete_id=<?php echo $user['id']; ?>">
                                   Delete
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    <?php }else{ ?>
                        <tr>
                            <td colspan="6" align="center">
                                No Moderator Found
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