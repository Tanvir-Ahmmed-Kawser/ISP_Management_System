<?php
    session_start();
    require_once('../../models/content.php');
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../../view/login.php');
    }

    if(isset($_POST['upload'])){

        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $uploader_id = $_SESSION['id'];

        $src = $_FILES['file']['tmp_name'];

        $ext = explode('.', $_FILES['file']['name']);
        $count = count($ext);

        $newName = $_POST['category'].time().".".$ext[$count-1];

        $des ='';

        if($_POST['category'] == 'games'){
            $des = '../../asset/Public/Contents/games'.$newName;
        }
        elseif($_POST['category'] == 'movies'){
            $des = '../../asset/Public/Contents/movies'.$newName;
        }
        elseif($_POST['category'] == 'software'){
            $des = '../../asset/Public/Contents/software'.$newName;
        }
        elseif($_POST['category'] == 'tv-series'){
            $des = '../../asset/Public/Contents/tv-series'.$newName;
        }
        else{
            $des = '../../asset/Public/Contents/others'.$newName;
        }

        if($title == "" || $category == ""){
            echo "null input!";
        }else{

            if(move_uploaded_file($src, $des)){

                $content = [
                    'title'=>$title,
                    'description'=>$description,
                    'file_path'=>$newName,
                    'category_id'=>$category,
                    'uploader_id'=>$uploader_id,
                    'download_count'=>0
                ];

                $status = addContent($content);

                if($status){
                    header('location: ../../view/admin/addContent.php');
                }else{
                    echo "Database Error!";
                }

            }else{
                echo "Error uploading file";
            }
        }

    }else{
        echo "invalid request! please submit form...";
    }
    if(isset($_GET['delete_id'])){

    $id = $_GET['delete_id'];

    $status = deleteContent($id);

    if($status){
        header('location: ../../view/admin/manageContents.php');
    }else{
        echo "Delete failed!";
    }
}
?>