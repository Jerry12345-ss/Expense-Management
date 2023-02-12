<?php
    // Database config and connect
    include('../config.php');

    // Session start
    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $mode = $_POST['mode'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password_hash = $_POST['password_hash'];
        $code = $_POST['code'];

        function checkVailication($con, $code, $mode, $email){
            // Get and check vailication code is it due 
            $getExpireQuery = "SELECT * FROM codes WHERE Email = '$email' ORDER BY id DESC LIMIT 1";
            $getExpireResult = mysqli_query($con, $getExpireQuery);

            if($getExpireResult){
                if(mysqli_num_rows($getExpireResult) > 0){
                    $row = mysqli_fetch_array($getExpireResult);
                    $expire = $row['Expire'];
                    $now_time = time();
                }else{
                    return '查無資料!';
                }
            }else{
                return '資料庫讀取或連線時發生錯誤!';
            }

            
            if($now_time > $expire){
                return '您的驗證碼已過有效期限';
            }else{
                if($code !== $row['Code']){
                    return '您輸入的驗證碼有錯，請重新輸入';
                }else{
                    return $mode;
                }
            }
        }

        $message_string = checkVailication($con, $code, $mode, $email);

        if($message_string == 'forgetPassword'){
            echo "forgetProcess success";
        }else if($message_string == 'registerUser'){
            // Insert new user( account ) into database
            $insertUserQuery = "INSERT INTO user(Account, Password, Name) VALUES('$email', '$password_hash', '$username')";
            $insertUserResult = mysqli_query($con, $insertUserQuery);

            if($insertUserResult){
                $_SESSION['success_message'] = '帳號註冊成功';
                unset($_SESSION['username']);
                unset($_SESSION['password_hash']);
                echo "registerProcess success";
            }else{
                echo "資料庫讀取或連線時發生錯誤!";
            }
        }else{
            echo $message_string;
        }
    }
?>