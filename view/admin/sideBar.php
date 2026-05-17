<?php
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../login.php');
    }
?>
<style>
    .sidebar{
    width: 300px;
    background: #c2f3f2f2;
    padding: 25px;
    border-radius: 18px;
}
.headding{
    margin-bottom: 35px;
    font-size: 38px;
    color: #111;
}
.menu{
    list-style: none;
}
.menu li{
    padding: 16px 18px;
    margin-bottom: 15px;
    border-radius: 14px;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: 0.3s;
}
.menu .active{
    background: #4b63f3;
    color: white;
}
</style>
<div class="sidebar">
    <h2 class="headding">
        Admin Panel
    </h2>
    <ul class="menu">
        <li id="dashboard" class="list">
            <span>📊</span>
            <a href="adminDashboard.php">Dashboard</a>
        </li>
        <li id="manageModerator">
            <span>👥</span>
            <a href="manageModerators.php">Manage Moderators</a>
        </li>
        <li id="manageContent">
            <span>🎛️</span>
            <a href="manageContents.php">Manage Contents</a>
        </li>
        <li id="addContent">
            <span>⬆️</span>
            <a href="addContent.php">Upload Content</a>
        </li>
        <li id="viewRequest">
            <span>📬</span>
            <a href="../moderator/request.php">View Request</a>
        </li>
        <li id="logOut">
            <span>⛔</span>
            <a href="../../controller/logout.php">Log Out</a>
        </li>
    </ul>
</div>
<script src="../../asset/JS/sideBar.js"></script>