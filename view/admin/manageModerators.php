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
                <input type="button" value="Add Moderator" class="btn" id="addModerator">
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
                    <tr>
                        <td>

                        </td>                
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>
                            <a href="#">View</a>
                            <a href="#">Edit</a>
                            <a href="#">Delete</a>
                        </td>
                    </tr>
                </table>
            </div>            
        </div>
    </div>
    <?php 
        include_once '../footer.php';
    ?>
</body>
</html>