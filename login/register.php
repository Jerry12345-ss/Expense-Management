<?php 
    include('../config.php');

    $account = $_POST['email'];
    $password = $_POST['password'];
    // $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $username = $_POST['name'];

    if(strlen($password) < 8){
        die("密把長度必須至少8個字元以上!");
    }

    if(! preg_match("/[a-z]/", $password)){
        die("密碼必須包含一個英文字母");
    }

    if(! preg_match("/[0-9]/", $password)){
        die("密碼必須包含一個數字");
    }

    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name'])){
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user(Account, Password, Name) VALUES('$account', '$password', '$username')";
        $query = mysqli_query($con, $sql);

        if($query){
            header("Location:login.html");
        }else{
            echo "錯誤!";
        }
    }
?>