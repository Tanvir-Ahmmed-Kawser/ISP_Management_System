<?php
require_once __DIR__ . '/db.php';

function task4GetTopCategories(){

    $con = getConnection();

    $sql = "SELECT id, name 
            FROM categories 
            WHERE parent_id IS NULL 
            ORDER BY name ASC";

    return mysqli_query($con, $sql);
}

function task4GetAllCategories(){

    $con = getConnection();

    $sql = "SELECT c.id, c.name, p.name AS parent_name
            FROM categories c
            LEFT JOIN categories p 
            ON c.parent_id = p.id
            ORDER BY c.name ASC";

    return mysqli_query($con, $sql);
}

function task4GetSubCategories($category_id){

    $con = getConnection();

    $category_id = (int)$category_id;

    $sql = "SELECT id, name
            FROM categories
            WHERE parent_id = ?
            ORDER BY name ASC";

    $stmt = mysqli_prepare($con, $sql);

    mysqli_stmt_bind_param($stmt, "i", $category_id);

    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}

function task4CategoryExists($category_id){

    $con = getConnection();

    $category_id = (int)$category_id;

    $sql = "SELECT id
            FROM categories
            WHERE id = ?
            LIMIT 1";

    $stmt = mysqli_prepare($con, $sql);

    mysqli_stmt_bind_param($stmt, "i", $category_id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_num_rows($result) === 1;
}
?>