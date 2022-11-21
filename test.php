<?php
    // Database config and connect
    include('./config.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_email =mysqli_query($con,"SELECT Account,Password FROM `expense_user` WHERE Account = '$email' AND Password = '$password'");

    if(mysqli_num_rows($check_email) > 0){
        echo '<script>window.location = "./index.php"</script>';
    }else{
        echo "Nope";
    }
?>