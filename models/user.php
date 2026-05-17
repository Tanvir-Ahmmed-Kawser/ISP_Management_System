<?php
    if(!isset($_SESSION['status'])){
        echo "Invalid request. Please login again";
        header('location: ../view/login.php');
    }
    require_once('database.php');

    function getAllModerators(){
        $con = getConnection();
        $sql = "select * from users where role='moderator'";
        $result = mysqli_query($con, $sql);
        $users = [];
        while($row = mysqli_fetch_assoc($result)){
            array_push($users, $row);
        }
        return $users;
    }
    function addUser($user){
        $con = getConnection();
        $sql = "insert into users values(
                    null,
                    '{$user['name']}',
                    '{$user['email']}',
                    '{$user['password_hash']}',
                    '{$user['role']}',
                    '',
                    current_timestamp()
                )";
        if(mysqli_query($con, $sql)){
            return true;
        }else{
            return false;
        }
    }
    function deleteUser($id){
        $con = getConnection();
        $sql = "delete from users where id={$id}";
        if(mysqli_query($con, $sql)){
            return true;
        }else{
            return false;
        }
    }
    function getTotalModerators(){
    $con = getConnection();
    $sql = "select count(*) as total from users where role='moderator'";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}
?>








<?php
// session_start();
//     require_once('database.php');

//     function getAllModerators(){

//         $con = getConnection();

//         $sql = "SELECT id, name, email, role, profile_picture 
//                 FROM users 
//                 WHERE role='moderator'";

//         $result = mysqli_query($con, $sql);

//         $users = [];

//         while($row = mysqli_fetch_assoc($result)){
//             array_push($users, $row);
//         }

//         return $users;
//     }

//     function addModerator($user){

//         $con = getConnection();

//         $sql = "INSERT INTO users 
//                 VALUES(
//                     null,
//                     '{$user['name']}',
//                     '{$user['email']}',
//                     '{$user['password']}',
//                     'moderator',
//                     '{$user['profile_picture']}',
//                     current_timestamp()
//                 )";

//         return mysqli_query($con, $sql);
//     }

//     function deleteUser($id){

//         $con = getConnection();

//         $sql = "DELETE FROM users WHERE id=$id";

//         return mysqli_query($con, $sql);
//     }
?>
