<style>
body{
    margin:0;
    font-family: Arial;
    background:#eafaf1;
}

.dashboard{
    display:flex;
    min-height:100vh;
}

/* SIDEBAR */
.sidebar{
    width:280px;
    background:#1f7a3a;
    padding:25px;
    color:white;
}

/* HEADING */
.heading{
    text-align:center;
    margin-bottom:30px;
    font-size:28px;
}

/* MENU */
.menu{
    list-style:none;
    padding:0;
}

.menu li{
    margin-bottom:12px;
}

.menu li a{
    display:flex;
    gap:10px;
    padding:12px;
    color:white;
    text-decoration:none;
    border-radius:10px;
}

.menu li a:hover{
    background:rgba(255,255,255,0.2);
}

/* MAIN CONTENT AREA */
.container{
    flex:1;
    padding:30px;
    display:flex;
    gap:20px;
    flex-wrap:wrap;
    justify-content:flex-start;
}

/* SQUARE BOX */
.card{
    width:220px;
    height:180px;
    background:white;
    border-radius:0; /* square shape */
    border:2px solid #2ecc71;
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
    cursor:pointer;
    transition:0.3s;
}

/* hover effect */
.card:hover{
    background:#eafaf1;
    transform:scale(1.05);
}

/* TEXT COLOR DARK BLUE */
.card h3,
.card p{
    color:darkblue;
    margin:5px;
}
</style>

<div class="dashboard">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h2 class="heading"> Working AS A Moderator</h2>
        
        

    </div>

    <!-- CONTENT BOX AREA -->
    <div class="container">


 <div class="card">
            <a href="add_content.php">
            <h3>⬆Upload</h3>
            <p>New Content</p>
        </div>


<div class="card">
            <a href="delete_content.php">
            <h3>🗑 Delete</h3>
            <p>Content</p>
        </div>



        <div class="card">
            <a href="all_content.php">
            <h3>🎛 View All</h3>
            <p>Contents</p>
        </div>

        

        <div class="card">
            <a href="request.php">
            <h3>📬 Requests</h3>
            <p>Manage</p>
        </div>



    </div>

</div>