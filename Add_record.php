<?php
    // Database config and connect
    include('./config.php');

    // Form Submit Data
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    // Get request parameter 
    // reference : https://makitweb.com/how-to-send-get-and-post-ajax-request-with-javascript/
    if(isset($_GET['request'])){
        $request = $_GET['request'];
    }

    // Check request parameter ( 1 => income, 2 => expense )
    if($request == 1){
        $sql = "INSERT INTO income(Money, Description, Date) VALUES('$amount', '$description', '$date')";
    }else if($request == 2){
        $sql = "INSERT INTO expense(Money, Description, Date) VALUES('$amount', '$description', '$date')";
    }else{
        echo "SQL syntax error !";
    }

    // Insert data into database
    // if(mysqli_query($con, $sql)){
    //     echo "The Datas is inserted into Database !";
    // }else{
    //     echo "Insert Database Error !";
    // }    
?>