<?php 
    include('./config.php');

    $id = $_POST['id'];

    // request 1 : income / request 2 : expense
    if(isset($_GET['request'])){
        $request = $_GET['request'];
    }

    if(isset($_GET['uid'])){
        $uid = $_GET['uid'];
    }

    if($request == "income"){
        if($uid == 1){
            $delete_sql = "DELETE FROM `income` WHERE ID = '$id'";
        }else if($uid == 2){
            //echo "income edit";
        }
    }else if ($request == "expense"){
        if($uid == 1){
            $delete_sql = "DELETE FROM `expense` WHERE ID = '$id'";
        }else if($uid == 2){
            //echo "expense edit";
        }
    }

    if(mysqli_query($con, $delete_sql)){
        if($request == "income" && $uid == 1){
            echo "income";
        }else if($request == "expense" && $uid == 1){
            echo "expense";
        }
    }else{
        echo "Delete data Error !";
    }
?>