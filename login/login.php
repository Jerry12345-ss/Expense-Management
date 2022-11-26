<?php
    // 
    session_start();
    // Database config and connect
    include('../config.php');

    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $sql = "SELECT * FROM `user` WHERE Account = '$email'";
        $query = mysqli_query($con, $sql);

        // 確認資料列數是否大於0
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            if($row['Account'] === $email && $row['Password'] === $password){
                echo "登入成功";
                $_SESSION['account'] = $row['Account'];
                $_SESSION['password'] = $row['Password'];
                $_SESSION['name'] = $row['Name'];
                header("Location: ../index.php");
                exit();
            }else{
                echo "帳號或密碼錯誤!";
                header("Location:login.html");
                exit();
            }
        }else{
            header("Location:login.html");
            exit();
        }
    }