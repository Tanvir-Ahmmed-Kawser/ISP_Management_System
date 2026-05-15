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
                <input type="button" value="Add new Content" class="btn" id="addContent">
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