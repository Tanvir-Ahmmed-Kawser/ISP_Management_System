<?php
require_once __DIR__ . '/db.php';

function task4GetChildCategoryIds($category_id){
    $con = getConnection();
    $category_id = (int)$category_id;
    $ids = [$category_id];

    $sql = "select id from categories where parent_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = mysqli_fetch_assoc($result)){
        $ids[] = (int)$row['id'];
    }

    return $ids;
}

function task4GetHighlightedContents(){
    $con = getConnection();
    $sql = "select c.id, c.title, c.description, c.file_path, c.download_count, c.uploaded_at,
                   cat.name as category_name, parent.name as parent_category_name
            from contents c
            left join categories cat on c.category_id = cat.id
            left join categories parent on cat.parent_id = parent.id
            order by c.download_count desc, c.uploaded_at desc
            limit 6";
    return mysqli_query($con, $sql);
}

function task4SearchContents($q, $category_id, $subcategory_id, $file_type){
    $con = getConnection();

    $q = trim((string)$q);
    $category_id = (int)$category_id;
    $subcategory_id = (int)$subcategory_id;
    $file_type = strtolower(trim((string)$file_type));

    $sql = "select c.id, c.title, c.description, c.file_path, c.download_count, c.uploaded_at,
                   cat.name as category_name, parent.name as parent_category_name
            from contents c
            left join categories cat on c.category_id = cat.id
            left join categories parent on cat.parent_id = parent.id
            where 1 = 1";

    $types = '';
    $params = [];

    if($q !== ''){
        $sql .= " and (c.title like ? or c.description like ?)";
        $types .= 'ss';
        $keyword = '%' . $q . '%';
        $params[] = $keyword;
        $params[] = $keyword;
    }

    if($subcategory_id > 0){
        $sql .= " and c.category_id = ?";
        $types .= 'i';
        $params[] = $subcategory_id;
    } elseif($category_id > 0){
        $ids = task4GetChildCategoryIds($category_id);
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql .= " and c.category_id in ($placeholders)";
        $types .= str_repeat('i', count($ids));

        foreach($ids as $id){
            $params[] = $id;
        }
    }

    if($file_type !== ''){
        $allowed_types = ['mp4', 'mkv', 'pdf', 'zip', 'rar', 'exe', 'txt'];

        if(in_array($file_type, $allowed_types, true)){
            $sql .= " and lower(c.file_path) like ?";
            $types .= 's';
            $params[] = '%.' . $file_type;
        }
    }

    $sql .= " order by c.uploaded_at desc, c.id desc";

    $stmt = mysqli_prepare($con, $sql);

    if($types !== ''){
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function task4GetContentById($content_id){
    $con = getConnection();
    $content_id = (int)$content_id;

    $sql = "select id, title, file_path from contents where id = ? limit 1";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $content_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function task4IncrementDownloadCount($content_id){
    $con = getConnection();
    $content_id = (int)$content_id;

    $sql = "update contents set download_count = download_count + 1 where id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $content_id);
    return mysqli_stmt_execute($stmt);
}
?>
