<?php 
    include('./config.php');

    $id = $_POST['id'];

    // request : 1 => income , request : 2 => expense
    if(isset($_GET['request'])){
        $request = $_GET['request'];
    }

    if($request == 1){
        $delete_sql = "DELETE FROM `income` WHERE ID = '$id'";
    }else if ($request == 2){
        $delete_sql = "DELETE FROM `expense` WHERE ID = '$id'";
    }

    if(mysqli_query($con, $delete_sql)){
        if($request == 1){
            echo "income";
        }else if($request == 2){
            echo "expense";
        }
    }else{
        echo "Delete data Error !";
    }
?>