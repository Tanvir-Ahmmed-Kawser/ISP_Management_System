<?php
include('../models/db.php');

$result = mysqli_query($conn, "SELECT * FROM contents");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Member Contents</title>

    <!-- (OPTIONAL) asset CSS add করলে better look হবে -->
    <link rel="stylesheet" href="../asset/style.css">

</head>
<body>

<h2>Contents List (Member Panel)</h2>

<!-- NAVIGATION (IMPORTANT ADDITION) -->
<a href="request_form.php">Request Content</a>

<br><br>

<!-- SEARCH BOX -->
<input type="text" id="search" placeholder="Search here...">
<button onclick="searchData()">Search</button>

<br><br>

<!-- RESULT AREA -->
<div id="result">

<table border="1" cellpadding="10">

<tr>
    <th>Title</th>
    <th>Description</th>
    <th>Download</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>
    <td><?= $row['title'] ?></td>
    <td><?= $row['description'] ?></td>
    <td>
        <a href="../files/<?= $row['file_path'] ?>" download>
            Download
        </a>
    </td>
</tr>

<?php } ?>

</table>

</div>

<br><br>

<!-- SEARCH SCRIPT -->
<script>

function searchData(){

    let q = document.getElementById('search').value;

    fetch('../api/contents/search.php?q=' + q)
    .then(response => response.json())
    .then(data => {

        let output = `
        <table border="1" cellpadding="10">

        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Download</th>
        </tr>
        `;

        data.forEach(item => {

            output += `
            <tr>
                <td>${item.title}</td>
                <td>${item.description}</td>
                <td>
                    <a href="../files/${item.file_path}" download>
                        Download
                    </a>
                </td>
            </tr>
            `;
        });

        output += `</table>`;

        document.getElementById('result').innerHTML = output;
    });

}

</script>

</body>
</html>