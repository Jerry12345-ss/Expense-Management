<?php 
    include('./config.php');

    $account = $_POST['email'];
    $password = $_POST['password'];
    // $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $username = $_POST['name'];

    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name'])){
        $sql = "INSERT INTO user(Account, Password, Name) VALUES('$account', '$password', '$username')";
        $query = mysqli_query($con, $sql);

        if($query){
            header("Location:login.html");
        }else{
            echo "錯誤!";
        }
    }
?>