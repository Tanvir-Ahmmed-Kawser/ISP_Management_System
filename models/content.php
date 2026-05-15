<?php
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../login.php');
    }
    require_once('database.php');

    function addContent($content){

        $con = getConnection();

        $sql = "insert into contents values(
                    null,
                    '{$content['title']}',
                    '{$content['description']}',
                    '{$content['file_path']}',
                    '{$content['category_id']}',
                    '{$content['uploader_id']}',
                    '{$content['download_count']}',
                    current_timestamp()
                )";

        if(mysqli_query($con, $sql)){
            return true;
        }else{
            return false;
        }
    }
    function getAllContent(){
         $con = getConnection();

        $sql = "select contents.id, contents.title, categories.name as category,
                users.name as uploader, contents.file_path from contents
                join categories on contents.category_id = categories.id
                join users on contents.uploader_id = users.id";

        $result = mysqli_query($con, $sql);

        $contents = [];

        while($row = mysqli_fetch_assoc($result)){
            array_push($contents, $row);
        }

        return $contents;
    }

    function deleteContent($id){
        $con = getConnection();
        $sql = "select * from contents where id={$id}";
        $result = mysqli_query($con, $sql);
        $content = mysqli_fetch_assoc($result);
        $file = '../../upload/'.$content['file_path'];
        $sql2 = "delete from contents where id={$id}";
        if(mysqli_query($con, $sql2)){
            if(file_exists($file)){
                unlink($file);
            }
            return true;
        }else{
            return false;
        }
    }
    function updateContent($content){

    }
?>