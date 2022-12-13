<?php
    // 如果未登入進去 index.php, 會自動跳轉至 login.php
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location: login/login.php");
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="public">
    <title>Expense Management</title>

    <link rel="icon" type="image/icon" href="./img/icon.png">

    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style2.css">
    <link rel="stylesheet" href="./css/sum.css">
    <link rel="stylesheet" href="./css/home.css">
</head>
<body>
    <header>
        <nav class="navbar-area" style="position : fixed; z-index : 5000;">
            <div class="container-fluid">
                <div class="nav-wrapper">
                    <div class="logo">
                        <a href="./index.php">
                            <span>Expense Management</span>
                        </a>
                    </div>
                    <div class="sidebar-hamburger">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class='bx bx-menu bx-sm'></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <?php
        include('./config.php');

        $username = $_SESSION['name'];

        function Total($parameter, $username, $con){
            if($parameter == 1){
                $t_income = "SELECT SUM(Money) AS Total FROM `income` WHERE Name = '$username'";
                $total_income = mysqli_query($con, $t_income);

                while($row = mysqli_fetch_array($total_income)){
                    if($row['Total'] == 0){
                        echo 0;
                    }else{
                        echo $row['Total'];
                    }
                }
            }else if($parameter == 2){
                $t_expense = "SELECT SUM(Money) AS Total FROM `expense` WHERE Name = '$username'";
                $total_expense = mysqli_query($con, $t_expense);
                                        
                while($row2 = mysqli_fetch_array($total_expense)){
                    if($row2['Total'] == 0){
                        echo 0;
                    }else{
                        echo $row2['Total'];
                    }
                }
            }
        }
    ?>

    <main>
        <div class="container-fluid" style="padding: 0;">
            <div class="wrapper">
                <div class="sidebar d-flex flex-column">
                    <div class="sidebar-navbar toggle">
                        <ul>
                            <li class="active">
                                <a href="./index.php" class="d-flex align-items-center"><i class='bx bxs-dashboard'></i><span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="./pages/incomes.php" class="d-flex align-items-center ">
                                    <i class="fa-solid fa-money-check-dollar"></i>
                                    <span>Incomes</span>
                                </a>
                            </li>
                            <li>
                                <a href="./pages/expenses.php" class="d-flex align-items-center ">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                    <span>Expenses</span>
                                </a>
                            </li>
                            <li>
                                <a href="./pages/sum.php" class="d-flex align-items-center ">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                    <span>Sum</span>
                                </a>
                            </li>
                            <li>
                                <a href="./pages/chart.php" class="d-flex align-items-center"><i class='bx bxs-chart'></i><span>Chart</span></a>
                            </li>
                        </ul>
                        <div class="username-logout">
                            <div class="log-out d-flex align-items-center" style="color: white;">
                                <i class='bx bxs-user-circle'></i>
                                <div class="username" style="flex: 1 1 0;">
                                    <span>
                                        <?php
                                            echo $_SESSION['name'];
                                        ?>
                                    </span>
                                </div>
                                <i class="bx bx-log-out "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper toggle">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Overview</li>
                        </ol>
                    </nav>
                    <!-- 先以 sum 為主, 之後再修改程式內容 -->
                    <div class="sum-data total-div">
                        <ul class="d-flex flex-column">
                            <li class="text-center title">This Month</li>
                            <li class="d-flex justify-content-between">
                                Total Income
                                <span class="income-total">$
                                    <?php
                                        Total(1,$username,$con); 
                                    ?>
                                </span>
                            </li>
                            <li class="d-flex justify-content-between">
                                Total Expense
                                <span class="expense-total">$
                                    <?php
                                        Total(2,$username,$con); 
                                    ?>
                                </span>
                            </li>
                            <li class="d-flex justify-content-between" style="border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;">
                                Balance
                                <span class="sum-total">$
                                    <span class="sum-total-number">
                                        <?php
                                            $t_income = "SELECT SUM(Money) AS Total FROM `income` WHERE Name = '$username'";
                                            $total_income = mysqli_query($con, $t_income);
                                            $t_expense = "SELECT SUM(Money) AS Total FROM `expense` WHERE Name = '$username'";
                                            $total_expense = mysqli_query($con, $t_expense);                               

                                            $row = mysqli_fetch_assoc(($total_income));
                                            $row2 = mysqli_fetch_assoc(($total_expense));

                                            echo $row['Total'] - $row2['Total'];
                                        ?>
                                    </span>
                                </span>                                 
                            </li>
                        </ul>
                    </div>
                    <div class="link-div mt-4">
                        <div class="row">
                            <div class="col-sm-6 col-lg-3 mb-3">
                                <div class="card-new card-income d-flex flex-column">
                                    <div class="card-nbody">
                                        <?php
                                            $cou_inocme = "SELECT COUNT(Name) FROM `income` WHERE Name = '$username'";
                                            $cou_query = mysqli_query($con, $cou_inocme);

                                            while($row = mysqli_fetch_array($cou_query)){
                                                echo $row['COUNT(Name)']; 
                                            }
                                        ?>
                                        <span>Income</span>
                                    </div>
                                    <div class="card-link">
                                        <a href="./pages/incomes.php">
                                            <div class="view-all d-flex justify-content-between align-items-center">
                                                <span>View All</span>
                                                <i class='bx bx-chevron-right'></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3 mb-3">
                                <div class="card-new card-expense d-flex flex-column">
                                    <div class="card-nbody">
                                        <?php
                                            $cou_expense = "SELECT COUNT(Name) FROM `expense` WHERE Name = '$username'";
                                            $cou_query2 = mysqli_query($con, $cou_expense);

                                            while($row = mysqli_fetch_array($cou_query2)){
                                                echo $row['COUNT(Name)']; 
                                            }
                                        ?>
                                        <span>Expense</span>
                                    </div>
                                    <div class="card-link">
                                        <a href="./pages/expenses.php">
                                            <div class="view-all d-flex justify-content-between align-items-center">
                                                <span>View All</span>
                                                <i class='bx bx-chevron-right'></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3 mb-3">
                                <div class="card-new card-sum d-flex flex-column">
                                    <div class="card-nbody">
                                        <?php
                                            $cou_qry = mysqli_query($con,$cou_inocme);
                                            $cou_qry2 = mysqli_query($con,$cou_expense);

                                            $row = mysqli_fetch_assoc(($cou_qry));
                                            $row2 = mysqli_fetch_assoc(($cou_qry2));

                                            echo $row['COUNT(Name)'] + $row2['COUNT(Name)'];
                                        ?>
                                        <span>Sum</span>
                                    </div>
                                    <div class="card-link">
                                        <a href="./pages/sum.php">
                                            <div class="view-all d-flex justify-content-between align-items-center">
                                                <span>View All</span>
                                                <i class='bx bx-chevron-right'></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3 mb-3">
                                <div class="card-new card-chart d-flex flex-column">
                                    <div class="card-nbody">
                                        <span>Chart</span>
                                    </div>
                                    <div class="card-link">
                                        <a href="./pages/chart.php">
                                            <div class="view-all d-flex justify-content-between align-items-center">
                                                <span>View All</span>
                                                <i class='bx bx-chevron-right'></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-div" style="overflow-x: scroll;">
                        <div class="d-flex flex-column border border-1" style="border-radius: 4px;">
                            <div class="chart-title d-flex align-items-center">
                                <i class='bx bxs-pie-chart-alt-2 me-2' style="font-size: 25px;"></i>
                                <span>This is title</span>
                            </div>
                            <div class="chart-content">
                                <div class="chart-container">
                                    <canvas id="canvasPie"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- jQuey -->
    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.37/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="./js/main5.js"></script>

    <script>
        const log_out = document.querySelector('.bx-log-out');

        log_out.addEventListener('click',()=>{
            Swal.fire({
                icon : 'question',
                title : '您確定要登出嗎 ?',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: 'indianred',
                confirmButtonText: '確定',
                cancelButtonText: '取消',
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        url : `./login/logout.php`,
                        type : 'POST',
                        success : ()=>{
                            window.location.href = './login/login.php'
                        },
                        error : (error)=>{
                            console.log(error);
                        }
                    })
                }
            });
        });

        // Chart Test
        let canvas = document.querySelector('#canvasPie');
        let ctx = canvas.getContext('2d');

        let chart_income = '<?php Total(1,$username,$con); ?>';
        let chart_expense = '<?php Total(2,$username,$con); ?>';

        const data = {
        labels: ['expense', 'income'],
        datasets: [
                {
                    fill: true,
                    label: 'Dataset 1',
                    backgroundColor: ['red','blue'],
                    data: [chart_expense,chart_income],
                }
            ]
        };

        new Chart(ctx,{
            type: 'pie',
            data: data,
            option: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Pie Chart'
                    },
                    // rotation: -0.7 * Math.PI
                }
            },
        });
    </script>
</body>
</html>