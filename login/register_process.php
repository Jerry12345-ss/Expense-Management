<?php 
    include('../config.php');

    $error = "";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name'])){
            $account = $_POST['email'];
            $password = $_POST['password'];
            $password_hash = password_hash($password, PASSWORD_DEFAULT); 
            $username = $_POST['name'];

            // setting password requirement
            if(strlen($password) < 8){
                $error = "密碼長度至少8個字元以上";
                header('Location:register.php');
                exit();
            }
        
            if(! preg_match("/[a-z]/", $password)){
                $error = "密碼必須包含一個英文字母";
                exit();
            }
        
            if(! preg_match("/[0-9]/", $password)){
                $error = "密碼必須包含一個數字";
                exit();
            }

            if($password !== $_POST['con-password']){
                $error = "確認密碼匹配錯誤";
                exit();
            }

            $check_email = "SELECT * FROM user WHERE Account = '$account'";

            // prevent duplicate email (account)
            if(mysqli_num_rows(mysqli_query($con,$check_email)) > 0){
                $is_invalid = true;
                $error = "此帳號已註冊過!";
                exit();
            }else{
                $sql = "INSERT INTO user(Account, Password, Name) VALUES('$account', '$password_hash', '$username')";
                $query = mysqli_query($con, $sql);

                if($query){
                    header("Location:login.php");
                    exit();
                }else{
                    $is_invalid = true;
                    $error = "帳號註冊發生錯誤";
                    exit();
                }
            }
        }
    }
?>