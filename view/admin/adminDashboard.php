<?php
    session_start();
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DashBoard</title>
    <link rel="stylesheet" href="../../asset/CSS/adminDashboard.css">
</head>
<body>
    <div class="dashboard">
        <?php require_once 'sideBar.php'; ?> 

        <div class="mainContent">
            <div class="welcomeBox">
                <div>
                    <h1>
                        Welcome, Admin!
                    </h1>
                    <p>
                        Manage moderator, contents and monitor system statics from this dashboard.
                    </p>
                </div>
                <div>
                    <input type="button" value="👤 Profile" id="viewProfile" name="viewProfile">
                </div>
            </div>
            <div class="sateContainer">
                <div class="stateBox">
                    <div>
                        <div class="icon">🎛️</div>
                        <h3>
                            Total Contents
                            <p id="totalContent">00</p>
                        </h3>
                        
                    </div>
                </div>
                <div class="stateBox">
                    <div>
                        <div class="icon">📁</div>
                        <h3>
                            Total Catagories
                            <p id="totalCatagories">00</p>
                        </h3>
                    </div>
                </div>
                <div class="stateBox">
                    <div>
                        <div class="icon">👤</div>
                        <h3>
                            Total Moderators
                            <p id="totalModerators">00</p>
                        </h3>
                    </div>
                </div>
                <div class="stateBox">
                    <div>
                        <div class="icon">💬</div>
                        <h3>
                            Request Pending
                            <p id="totalRequest">00</p>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="addItems">
                <div class="itemCard">
                    <div class="addIcon">
                        👤+
                    </div>
                    <h2>
                        Add New Moderator
                    </h2>
                    <p>
                        Create moderator accounts to help manage media content.
                    </p>
                    <input type="button" id="btnAddModerator" name="btnAddModerator" value="Add Moderator">
                </div>
                <div class="itemCard">
                    <div class="uploadIcon">
                        ☁
                    </div>
                    <h2>
                        Upload Content
                    </h2>
                    <p>
                        Add new movies, software, games, or TV series to the library.
                    </p>
                    <input type="button" name="btnUpload" value="Upload Now" id="btnUpload">
                </div>
            </div>
        
            <div class="table">
                <div class="tableHeader">
                <h2>Recently Added Content</h2>
                <input type="button" name="viewAll" id="btnViewAll" value="View All">        
                </div>
                <table border="1">
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Uploader</th>
                        <th>Downloads</th>
                        <th>Uploaded At</th>
                    </tr>
                    <tr>
                        <td colspan="5">
                            This feature is comming soon.... Click on View All. Thank you!
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>   
    <script src="../../asset/JS/admin.js"></script> 
</body>
</html>
<?php include_once '../footer.php'; ?>