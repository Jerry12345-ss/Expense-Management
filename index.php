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
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/sum.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/calculate.css">
    <link rel="stylesheet" href="./css/popup3.css">
    <style>
        .no-chartData-div{
            text-align: center;
            margin: 2rem 0rem;
        }

        @media screen and (min-width:576px){
            .no-chartData-div{
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
<?php
        if(isset($_SESSION['warning_message'])){?>
            <div class="popup-out">
                <div class="important-message">
                    <div class="important-title">
                        <p style="margin-bottom: 0px;">重要公告</p>
                        <div class="close-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    </div>
                    <div class="important-content">
                        <p style="margin-bottom: 0px;">親愛的用戶您好 : </p>
                        <p style="margin-bottom: 0px;">因時程安排與功能修改上遇到一些問題，目前<span style="color:red;">統計圖表的功能暫時無法使用</span>，使用者在圖表部分進行任何操作時將不會顯示相對應資料。使用上造成您的不便，敬請見諒。</p>
                    </div>
                </div>
            </div>
        <?php 
            unset($_SESSION['warning_message']);
        }
    ?>
    <header>
        <nav class="navbar-area" style="position : fixed; z-index : 5000;">
            <div class="container-fluid">
                <div class="nav-wrapper">
                    <div class="logo">
                        <a href="./index.php">
                            <span>記帳管理系統</span>
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
        $month = date('m');

        function Total($parameter, $username, $con, $month){
            if($parameter == 1){
                $incomeTotalQuery = "SELECT SUM(Money) AS Total FROM `income` WHERE Name = '$username' AND Month = '$month'";
                $incomeTotalResult = mysqli_query($con, $incomeTotalQuery);

                if($incomeTotalResult){
                    if(mysqli_num_rows($incomeTotalResult) > 0){
                        while($row = mysqli_fetch_array($incomeTotalResult)){
                            if($row['Total'] == 0){
                                echo 0;
                            }else{
                                echo $row['Total'];
                            }
                        }
                    }else{
                        echo "查無此資料";
                    }
                }else{
                    echo "資料庫連線發生錯誤";
                }
            }else if($parameter == 2){
                $expenseTotalQuery = "SELECT SUM(Money) AS Total FROM `expense` WHERE Name = '$username' AND Month = '$month'";
                $expenseTotalResult = mysqli_query($con, $expenseTotalQuery);
                                        
                if($expenseTotalResult){
                    if(mysqli_num_rows($expenseTotalResult) > 0){
                        while($row2 = mysqli_fetch_array($expenseTotalResult)){
                            if($row2['Total'] == 0){
                                echo 0;
                            }else{
                                echo $row2['Total'];
                            }
                        }
                    }else{
                        echo "查無此資料";
                    }
                }else{
                    echo "資料庫連線發生錯誤";
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
                                <a href="./index.php" class="align-items-center"><i class='bx bxs-dashboard'></i><span>控制台</span></a>
                                <span class="tooltips">控制台</span>
                            </li>
                            <li>
                                <a href="./pages/incomes.php" class=" align-items-center ">
                                    <i class="fa-solid fa-money-check-dollar"></i>
                                    <span>收入</span>
                                </a>
                                <span class="tooltips">收入</span>
                            </li>
                            <li>
                                <a href="./pages/expenses.php" class=" align-items-center ">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                    <span>支出</span>
                                </a>
                                <span class="tooltips">支出</span>
                            </li>
                            <li>
                                <a href="./pages/sum.php" class=" align-items-center ">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                    <span>總和</span>
                                </a>
                                <span class="tooltips">總和</span>
                            </li>
                            <li>
                                <a href="./pages/chart.php" class=" align-items-center"><i class='bx bxs-chart'></i><span>統計圖表</span></a>
                                <span class="tooltips">統計圖表</span>
                            </li>
                        </ul>
                        <div class="username-logout">
                            <div class="log-out align-items-center" style="color: white;">
                                <i class='bx bxs-user-circle'></i>
                                <div class="username" style="flex: 1 1 0;">
                                    <span>
                                        <?php
                                            echo $_SESSION['name'];
                                        ?>
                                    </span>
                                </div>
                                <i class="bx bx-log-out" onclick="logout(0)"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper toggle">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="./index.php">控制台</a></li>

                        </ol>
                    </nav>
                    <div class="sum-data total-div">
                        <ul class="d-flex flex-column">
                            <li class="text-center title"><?php echo $month." 月份"; ?></li>
                            <li class="d-flex justify-content-between">
                                總收入
                                <span class="income-total">$
                                    <?php
                                        Total(1,$username,$con,$month); 
                                    ?>
                                </span>
                            </li>
                            <li class="d-flex justify-content-between">
                                總支出
                                <span class="expense-total">$
                                    <?php
                                        Total(2,$username,$con,$month); 
                                    ?>
                                </span>
                            </li>
                            <li class="d-flex justify-content-between" style="border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;">
                                結餘
                                <span class="sum-total">$
                                    <span class="sum-total-number">
                                        <?php
                                            $t_income = "SELECT SUM(Money) AS Total FROM `income` WHERE Name = '$username' && Month = '$month'";
                                            $total_income = mysqli_query($con, $t_income);
                                            $t_expense = "SELECT SUM(Money) AS Total FROM `expense` WHERE Name = '$username' && Month = '$month'";
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
                                        <span>收入</span>
                                    </div>
                                    <div class="card-link">
                                        <a href="./pages/incomes.php">
                                            <div class="view-all d-flex justify-content-between align-items-center">
                                                <span>查看全部</span>
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
                                        <span>支出</span>
                                    </div>
                                    <div class="card-link">
                                        <a href="./pages/expenses.php">
                                            <div class="view-all d-flex justify-content-between align-items-center">
                                                <span>查看全部</span>
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
                                        <span>總和</span>
                                    </div>
                                    <div class="card-link">
                                        <a href="./pages/sum.php">
                                            <div class="view-all d-flex justify-content-between align-items-center">
                                                <span>查看全部</span>
                                                <i class='bx bx-chevron-right'></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3 mb-3">
                                <div class="card-new card-chart d-flex flex-column">
                                    <div class="card-nbody">
                                        <span>統計圖表</span>
                                    </div>
                                    <div class="card-link">
                                        <a href="./pages/chart.php">
                                            <div class="view-all d-flex justify-content-between align-items-center">
                                                <span>查看全部</span>
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
                            <div class="chart-title d-flex align-items-center justify-content-center">
                                <i class='bx bxs-pie-chart-alt-2 me-2' style="font-size: 25px;"></i>
                                <span style="font-weight: 700;"><?php echo $month." 月份收支統計圖表"; ?></span>
                            </div>
                            <div class="chart-content">
                                <div class="chart-container">
                                    <canvas id="canvasPie" style="width: 400px; height:400px;"></canvas>
                                    <div class="no-chartData">
                                        <div class="no-chartData-div">
                                            <h1>尚未有<?php echo $month; ?>月份收入/支出的資料!</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="calculate-button" title="計算機">
            <i class='bx bxs-calculator bx-sm' style="font-size: 1.7rem;"></i>
        </button>
        <div class="calculate-content">
            <div class="calculate">
                <div class="output">
                    <div data-previous-operand class="previous-operand"></div>
                    <div data-current-operand class="current-operand"></div>
                </div>
                <button class="span-two symbol clearAll" data-value="AC" id="clearAll">AC</button>
                <button class="symbol clear" data-value="DEL" id="clear">DEL</button>
                <button class="operator divide" data-value="/">÷</button>
                <button class="number number7" data-value="7">7</button>
                <button class="number number8" data-value="8">8</button>
                <button class="number number9" data-value="9">9</button>
                <button class="operator multiply" data-value="*">x</button>
                <button class="number number4" data-value="4">4</button>
                <button class="number number5" data-value="5">5</button>
                <button class="number number6" data-value="6">6</button>
                <button class="operator minus" data-value="-">-</button>
                <button class="number number1" data-value="1">1</button>
                <button class="number number2" data-value="2">2</button>
                <button class="number number3" data-value="3">3</button>
                <button class="operator add" data-value="+">+</button>
                <button class="number number0" data-value="0">0</button>
                <button class="number dot" data-value=".">.</button>
                <button class="span-two symbol equal" data-value="=" id="equal">=</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script type="module" src="./js/main2.js"></script>
    <script src="./js/logout.js"></script>
    <script src="./js/calculate.js"></script>

    <script>
        // Chart of this month 
        let canvas = document.querySelector('#canvasPie');
        let ctx = canvas.getContext('2d');

        let chart_income = <?php Total(1,$username,$con,$month); ?>;
        let chart_expense = <?php Total(2,$username,$con,$month); ?>;

        const createChart = () =>{
            const data = {
            labels: ['收入', '支出'],
            datasets: [
                    {
                        fill: true,
                        backgroundColor: ['rgb(54, 162, 235)', 'rgb(255, 99, 132)'],
                        data: [chart_income, chart_expense],
                        hoverOffset: 2
                    }
                ]
            };

            new Chart(ctx,{
                type: 'pie',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip : {
                            backgroundColor: 'rgba(255, 255, 255, 0.7)',
                            borderColor : 'rgba(169, 169, 169, 0.8)',
                            borderWidth : 1,
                            titleColor : 'gray',
                            bodyColor : 'gray',
                            caretSize : 0,
                            titleFont : { size : 18, weight : 'bold' },
                            bodyFont : { size : 18, weight : 'bold' },
                            padding : 15,
                        },
                        legend: {
                            display : true,
                            position: 'bottom',
                            labels : {
                                padding : 30
                            }
                        },
                    }
                },
            });
        } 

        if(chart_expense == 0 && chart_income == 0){
            canvas.style.display = 'none';
            document.querySelector('.no-chartData').style.display = 'block';
        }else{
            canvas.style.display = 'block';
            document.querySelector('.no-chartData').style.display = 'none';
            document.querySelector('.chart-container').style.maxWidth = '500px';
            createChart();
        }

        // Important message close event
        let important_message = document.querySelector('.important-message');

        const MessageZoom = ()=>{
            document.querySelector('.popup-out').style.animation = 'zoomOut 0.5s linear both';
            setTimeout(()=>{
                document.querySelector('.popup-out').classList.add('disappear');
            },'500');
        };

        document.querySelector('.close-btn').addEventListener('click',()=>{
            MessageZoom();
        });

        window.addEventListener('click',()=>{
            MessageZoom();
        });
    </script>
</body>
</html>