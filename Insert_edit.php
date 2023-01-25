<?php
    // Session start
    session_start();
    // Database config and connect
    include('./config.php');

    // Form Submit Data
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $month = date("m",strtotime($date));
    $year = date("Y",strtotime($date));
    $username = $_SESSION['name'];

    // Get request parameter ( 1 => income , 2 => expense )
    if(isset($_GET['request'])){
        $request = $_GET['request'];
    }

    // Get action parameter ( insert / update )
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    // Get id parameter ( update card ID )
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    // Check request parameter
    if($request == 1){
        if($action == "insert"){
            $sql = "INSERT INTO income(Name, Type, Money, Description, Date_billing, Year, Month) VALUES('$username', 'income', '$amount', '$description', '$date', '$year', '$month')";
        }else if($action == "update"){
            $sql = "UPDATE income SET Money = '$amount', Description = '$description', Date_billing = '$date', Year = '$year', Month = '$month' WHERE ID = '$id'";
            echo $id;
        }
    }else if($request == 2){
        if($action == "insert"){
            $sql = "INSERT INTO expense(Name, Type, Money, Description, Date_billing, Year, Month) VALUES('$username', 'expense', '$amount', '$description', '$date', '$year', '$month')";
        }else if($action == "update"){
            $sql = "UPDATE expense SET Money = '$amount', Description = '$description', Date_billing = '$date', Year = '$year', Month = '$month' WHERE ID = '$id'";
        }
    }else{
        echo "SQL syntax error !";
    }

    // Insert data into database / Update data 
    if(mysqli_query($con, $sql)){
        if($action == "insert"){
            echo "The Datas is inserted into Database !";
        }else if($action == "update"){
            echo "The Datas is updated !";
        }
    }else{
        echo "Error !";
    }    
?>