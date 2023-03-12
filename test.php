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

    $sql = "SELECT SUM(Money), Month FROM `income` WHERE Month BETWEEN '$month_prev' AND '$month_fol' AND Name = '$username' AND Year = '$year' GROUP BY Month";
    $query = mysqli_query($con, $sql);
    $sql2 = "SELECT SUM(Money), Month FROM `expense` WHERE Month BETWEEN '$month_prev' AND '$month_fol' AND Name = '$username' AND Year = '$year' GROUP BY Month";
    $query2 = mysqli_query($con, $sql2);
    
    $income_array = array();
    $expense_array = array();

    while($row = mysqli_fetch_assoc($query)){
        array_push($income_array,[
            'year' => $year,
            'month' => $row['Month'],
            'money' => $row['SUM(Money)']
        ]);
    }

    while($row = mysqli_fetch_assoc($query2)){
        array_push($expense_array,[
            'year' => $year,
            'month' => $row['Month'],
            'money' => $row['SUM(Money)']
        ]);
    }

    $arr = array($income_array,$expense_array);
    echo json_encode($arr);
?>