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
    cursor: pointer;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: 0.3s;
}

.menu li:hover{
    background: #4b63f3;
    color: white;
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
                Dashboard
        </li>
        <li id="manageModerator">
            <span>👥</span>
            Manage Moderators
        </li>
        <li id="manageContent">
            <span>🎛️</span>
            Manage Contents
        </li>
        <li id="uploadContent">
            <span>⬆️</span>
            Upload Content
        </li>
        <li>
            <span>📬</span>
            Content Request
        </li>
        <li id="logOut">
            <span>⛔</span>
            Log Out
        </li>
    </ul>
</div>