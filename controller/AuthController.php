<?php

session_start();

require_once("../models/db.php");

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if(empty($name) || empty($email) || empty($password)){
        echo "All fields required";
    }

    else if(strlen($password) < 8){
        echo "Password minimum 8 characters";
    }

    else{

        $check = $conn->prepare(
        "SELECT * FROM users WHERE email=?"
        );

        $check->bind_param("s",$email);

        $check->execute();

        $result = $check->get_result();

        if($result->num_rows > 0){

            echo "Email already exists";
        }

        else{

            $hash = password_hash(
            $password,
            PASSWORD_DEFAULT
            );

            $stmt = $conn->prepare(
            "INSERT INTO users(name,email,password_hash,role)
            VALUES(?,?,?,?)"
            );

            $stmt->bind_param(
            "ssss",
            $name,
            $email,
            $hash,
            $role
            );

            if($stmt->execute()){
                header("Location: ../view/adminDashboard.php");
            }
        }
    }
}

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare(
    "SELECT * FROM users WHERE email=?"
    );

    $stmt->bind_param("s",$email);

    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows == 1){

        $user = $result->fetch_assoc();

        if(password_verify(
            $password,
            $user['password_hash']
        )){

            $_SESSION['user_id'] = $user['id'];

            $_SESSION['name'] = $user['name'];

            $_SESSION['role'] = $user['role'];

            if($user['role'] === 'admin'){                
                $_SESSION['status'] =true;
                $_SESSION['id'] = $user['id'];
                header("Location: ../view/admin/adminDashboard.php");
                exit;
            }

            else if($user['role'] === 'moderator'){                
                $_SESSION['status'] =true;
                $_SESSION['id'] = $user['id'];
                header("Location: ../view/moderator/dashboard.php");
                exit;
            }
        }

        else{
            echo "Wrong Password";
        }
    }

    else{
        echo "Invalid email or password";
    }
}

?>