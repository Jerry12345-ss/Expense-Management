<?php 
    include('./config.php');

    // if(isset($_GET['order'])){
    //     $order = $_GET['order'];
    // }

    $sql = "SELECT * From user ORDER BY id ASC";
    $query = mysqli_query($con, $sql);
   
    // if($order == 'DESC'){
        // if(mysqli_num_rows($query)>0){
        //     while($row = mysqli_fetch_array($query)){
        //         echo '<div>'.$row['Account'].'</div>';
        //     }
        // }
    // }else if($order == 'ASC'){
    //     if(mysqli_num_rows($query)>0){
    //         while($row = mysqli_fetch_array($query)){
    //             echo '<div>'.$row['Time_create'].'</div>';
    //         }
    //     }
    // }

    // if(mysqli_num_rows($query)>0){
    //     while($row = mysqli_fetch_array($query)){
    //         echo '<div>'.$row['Account'].'</div>';
    //         $_SESSION['order'] = 'desc';
    //     }
    // }

    echo 'desc';
    $_SESSION['order'] = 'DESC';
?>