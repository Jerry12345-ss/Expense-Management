<?php
    // session start
    session_start();

    // database config and connect
    include('../config.php');

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(isset($_POST['email']) && isset($_POST['password'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM `user` WHERE Account = '$email'";
            $query = mysqli_query($con, $sql);

            // confirm whether the number of data columns is greater than 0 (confirm whether there is an account)
            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                
                // verify password
                if(password_verify($password, $row['Password'])){
                    echo "登入成功";

                    // get IP location
                    function Get_ip(){
                        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                            $myip = $_SERVER['HTTP_CLIENT_IP'];
                        }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                            $myip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                        }else{
                            $myip= $_SERVER['REMOTE_ADDR'];
                        }

                        return $myip;
                    }

                    // insert user login time data in database
                    $username = $row['Name'];
                    $ip = Get_ip();
                    $history = "INSERT INTO login_history(IP, Account, Name) VALUES('$ip', '$email', '$username')";
                    mysqli_query($con, $history);

                    // store data in session variables
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $row['ID'];
                    $_SESSION['name'] = $row['Name'];
                    exit();
                }else{
                    echo("密碼錯誤");
                    exit();
                }
            }else{
                echo("無此帳號");
                exit();
            }
        }
    }