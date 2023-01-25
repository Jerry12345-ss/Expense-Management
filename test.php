<?php 
    session_start();
    include('./config.php');

    if(isset($_GET['year'])){
        $year = intval($_GET['year']) + 1911;
    }

    if(isset($_GET['prev'])){
        $month_prev = $_GET['prev'];
    }

    if(isset($_GET['fol'])){
        $month_fol = $_GET['fol'];
    }

    $username = $_SESSION['name'];

    $sql = "SELECT Month,SUM(Money) FROM `income` WHERE Month BETWEEN '$month_prev' AND '$month_fol' AND Name = '$username' AND Year = '$year'";
    $query = mysqli_query($con, $sql);
    
    $array_month = array();
    $array_sum = array();

    while($row = mysqli_fetch_array($query)){
        //$array_month = $row['Month'];
        echo $row['Month'];
        echo $row['SUM(Money)'];
    }
?>