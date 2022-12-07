<?php 
    include('./config.php');

    $id = $_POST['id'];

    // request 1 : income / request 2 : expense
    if(isset($_GET['request'])){
        $request = $_GET['request'];
    }

    // action edit / delete
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    echo $request;

    // if($request == 1){
    //     if($action == 'edit'){
    //         echo "income edit";
    //         //$card_sql = "DELETE FROM `income` WHERE ID = '$id'";
    //     }else if($action == 'delete'){
    //         echo "income delete";
    //         //$card_sql = "DELETE FROM `income` WHERE ID = '$id'";
    //     }
    // }else if($request == 2){
    //     if($action == 'edit'){
    //         echo "expense edit";
    //         //$card_sql = "DELETE FROM `expense` WHERE ID = '$id'";
    //     }else if($action == 'delete'){
    //         echo "expense delete";
    //         //$card_sql = "DELETE FROM `expense` WHERE ID = '$id'";
    //     }
    // }

    // $delete = "DELETE FROM `income` WHERE ID = '$id'";
    // $delete_quary = mysqli_query($con, $delete);
?>