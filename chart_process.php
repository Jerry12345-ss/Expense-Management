<?php 
    // Session start
    session_start();

    // Database config and connect
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

    $getIncomeQuery = "SELECT SUM(Money), Month FROM `income` WHERE Month BETWEEN '$month_prev' AND '$month_fol' AND Name = '$username' AND Year = '$year' GROUP BY Month";
    $getIncomeResult = mysqli_query($con, $getIncomeQuery);
    $getExpenseQuery = "SELECT SUM(Money), Month FROM `expense` WHERE Month BETWEEN '$month_prev' AND '$month_fol' AND Name = '$username' AND Year = '$year' GROUP BY Month";
    $getExpenseResult = mysqli_query($con, $getExpenseQuery);
    
    $income_array = array();
    $expense_array = array();

    while($row = mysqli_fetch_assoc($getIncomeResult)){
        array_push($income_array,[
            'year' => $year,
            'month' => intval($row['Month']),
            'money' => intval($row['SUM(Money)'])
        ]);
    }

    while($row = mysqli_fetch_assoc($getExpenseResult)){
        array_push($expense_array,[
            'year' => $year,
            'month' => intval($row['Month']),
            'money' => intval($row['SUM(Money)'])
        ]);
    }

    $arr = array($income_array, $expense_array);
    echo json_encode($arr);
?>