<?php
    session_start();    
    require_once('../../models/user.php');
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../../view/login.php');
    }

    if(isset($_POST['register'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $role = $_POST['role'];

        if($name == "" || $email == "" || $password == "" || $confirm_password == "" || $role == ""){

            echo "Null input!";

        }
        else if($password != $confirm_password){

            echo "Password does not match!";

        }
        else{

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $user = [
                'name'=>$name,
                'email'=>$email,
                'password_hash'=>$hash,
                'role'=>$role
            ];

            $status = addUser($user);

            if($status){

                header('location: ../../view/admin/manageModerators.php');

            }else{

                echo "Database Error!";
            }
        }

    }

    if(isset($_GET['delete_id'])){

        $id = $_GET['delete_id'];

        $status = deleteUser($id);

        if($status){
            header('location: ../../view/admin/manageModerators.php');
        }else{
            echo "Delete Failed!";
        }
    }
?>








<?php
    // session_start();
    // if(!isset($_SESSION['status'])){
    // echo "Invalid request. Please login again";
    // header('location: ../../view/login.php');
    // }
    // require_once('../../models/user.php');

    // if(isset($_POST['add_moderator'])){

    //     $name = $_POST['name'];
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];

    //     if($name == "" || $email == "" || $password == ""){
    //         echo "All fields required";
    //     }
    //     else{
    //         $src = $_FILES['profile_picture']['tmp_name'];

    //         $ext = explode('.', $_FILES['profile_picture']['name']);
    //         $count = count($ext);

    //         $newName = $_POST['name'].time().".".$ext[$count-1];

    //         $des = '../upload/'.$newName;

    //         if(move_uploaded_file($src, $des)){

    //             $user = [
    //                 'name'=>$name,
    //                 'email'=>$email,
    //                 'password'=>$password,
    //                 'profile_picture'=>$newName
    //             ];

    //             $status = addModerator($user);

    //             if($status){
    //                 header('location: ../view/admin/manageModerator.php');
    //             }else{
    //                 echo "Database error!";
    //             }
    //         }else{
    //             echo "File upload failed";
    //         }
    //     }
    // }
    // if(isset($_GET['delete_id'])){
    //     $id = $_GET['delete_id'];
    //     $status = deleteUser($id);
    //     if($status){
    //         header('location: ../view/admin/manageModerator.php');
    //     }else{
    //         echo "Delete failed";
    //     }
    // }
?>