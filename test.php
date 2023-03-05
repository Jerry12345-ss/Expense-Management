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

    $sql = "SELECT * FROM `expense` WHERE Month BETWEEN '$month_prev' AND '$month_fol' AND Name = '$username' AND Year = '$year' GROUP BY Month";
    $query = mysqli_query($con, $sql);
    
    $array_month = array();
    $array_sum = array();

    while($row = mysqli_fetch_assoc($query)){
        array_push($array_month, $row['Month']);
        array_push($array_sum, $row['Money']);
    }

    // array_merge($array_month, $array_sum)
    // $string = implode(',', $array_month);
    // echo $string;
    // $string = implode(',', $array_sum);
    // echo $string2;
    // print_r($array_month);
    // print_r($array_sum);
?>