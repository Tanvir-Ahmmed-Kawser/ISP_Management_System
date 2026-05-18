<?php
require_once __DIR__ . '/database.php';

// Task 4 - 23-53221-3: top-level categories for member filter tabs/dropdowns
function task4GetTopCategories(){
    $con = getConnection();
    $sql = "select id, name from categories where parent_id is null order by name asc";
    return mysqli_query($con, $sql);
}

// Task 4 - 23-53221-3: all categories for the request box dropdown
function task4GetAllCategories(){
    $con = getConnection();
    $sql = "select c.id, c.name, p.name as parent_name
            from categories c
            left join categories p on c.parent_id = p.id
            order by coalesce(p.name, c.name), c.parent_id is not null, c.name";
    return mysqli_query($con, $sql);
}

// Task 4 - 23-53221-3: dependent sub-category dropdown through AJAX
function task4GetSubCategories($category_id){
    $con = getConnection();
    $category_id = (int)$category_id;

    $sql = "select id, name from categories where parent_id = ? order by name asc";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

// Task 4 - 23-53221-3: validate selected category before creating request
function task4CategoryExists($category_id){
    $con = getConnection();
    $category_id = (int)$category_id;

    $sql = "select id from categories where id = ? limit 1";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_num_rows($result) === 1;
}
?>
