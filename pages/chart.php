<?php
    // 如果未登入進去 index.php, 會自動跳轉至 login.php
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location: ../login/login.php");
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Management</title>

    <link rel="icon" type="image/icon" href="../img/icon.png">

    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/chart.css">
    <link rel="stylesheet" href="../css/calculate2.css">
</head>
<body>
    <header>
        <nav class="navbar-area" style="position: fixed; z-index : 5000;">
            <div class="container-fluid">
                <div class="nav-wrapper">
                    <div class="logo">
                        <a href="../index.php">
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
        include('../config.php');

        $username =$_SESSION['name'];
        $year = date('Y');
        $new_year = $year-1911;

        $array_month_income = array();
        $array_month_expense = array();
        $array_sum_income = array();
        $array_sum_expense = array();

        $sql = "SELECT MAX(Month) AS month , SUM(Money) FROM `income` WHERE Name = '$username' GROUP BY Month";
        $sql2 = "SELECT MAX(Month) AS month , SUM(Money) FROM `expense` WHERE Name = '$username' GROUP BY Month";
        $query = mysqli_query($con, $sql);
        $query2 = mysqli_query($con, $sql2);
        $row = mysqli_fetch_array($query);
        $row2 = mysqli_fetch_array($query2);

        while($row = mysqli_fetch_array($query)){
            $income_month = $row['month'].'月';
            $income_sum = $row['SUM(Money)'];
            array_push($array_month_income, $income_month);
            array_push($array_sum_income, $income_sum);
        }

        while($row2 = mysqli_fetch_array($query2)){
            $expense_month = $row2['month'].'月';
            $expense_sum = $row2['SUM(Money)'];
            array_push($array_month_expense, $expense_month);
            array_push($array_sum_expense, $expense_sum);
        }

        $result = count($array_month_income) > count($array_month_expense) ? $array_month_income : $array_month_expense;

        // print_r($array_month_expense);
        // print_r($array_month_income);
        // print_r($array_sum_expense);
        // print_r($array_sum_income);
    ?>

    <main>
        <div class="container-fluid" style="padding: 0;">
            <div class="wrapper">
                <div class="sidebar d-flex flex-column">
                    <div class="sidebar-navbar toggle">
                        <ul>
                            <li>
                                <a href="../index.php" class="d-flex align-items-center"><i class='bx bxs-dashboard'></i><span>控制台</span></a>
                            </li>
                            <li>
                                <a href="./incomes.php" class="d-flex align-items-center">
                                    <i class="fa-solid fa-money-check-dollar"></i>
                                    <span>收入</span>
                                </a>
                            </li>
                            <li>
                                <a href="./expenses.php" class="d-flex align-items-center">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                    <span>支出</span>
                                </a>
                            </li>
                            <li>
                                <a href="./sum.php" class="d-flex align-items-center">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                    <span>總和</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="./chart.php" class="d-flex align-items-center"><i class='bx bxs-chart'></i><span>統計圖表</span></a>
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
                                <i class="bx bx-log-out"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper toggle">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="../index.php">控制台</a></li>
                          <li class="breadcrumb-item active" aria-current="page">統計圖表</li>
                        </ol>
                    </nav>
                    <div class="chart-table">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="text-align: end;">統計期間 (年)</th>
                                    <td>
                                        <select name="year" id="year" style="margin-left: 0.5rem;">
                                            <option><?php echo $new_year."年"; ?></option>
                                            <option><?php echo ($new_year - 1)."年"; ?></option>
                                            <option><?php echo ($new_year - 2)."年"; ?></option> 
                                            <option><?php echo ($new_year - 3)."年"; ?></option> 
                                            <option><?php echo ($new_year - 4)."年"; ?></option> 
                                            <option><?php echo ($new_year - 5)."年"; ?></option> 
                                            <option><?php echo ($new_year - 6)."年"; ?></option> 
                                            <option><?php echo ($new_year - 7)."年"; ?></option> 
                                            <option><?php echo ($new_year - 8)."年"; ?></option> 
                                            <option><?php echo ($new_year - 9)."年"; ?></option> 
                                            <option><?php echo ($new_year - 10)."年"; ?></option> 
                                            <option><?php echo ($new_year - 11)."年"; ?></option> 
                                            <option><?php echo ($new_year - 12)."年"; ?></option> 
                                            <option><?php echo ($new_year - 13)."年"; ?></option> 
                                            <option><?php echo ($new_year - 14)."年"; ?></option> 
                                            <option><?php echo ($new_year - 15)."年"; ?></option> 
                                            <option><?php echo ($new_year - 16)."年"; ?></option>
                                            <option><?php echo ($new_year - 17)."年"; ?></option> 
                                            <option><?php echo ($new_year - 18)."年"; ?></option> 
                                            <option><?php echo ($new_year - 19)."年"; ?></option> 
                                            <option><?php echo ($new_year - 20)."年"; ?></option> 
                                            <option><?php echo ($new_year - 21)."年"; ?></option> 
                                            <option><?php echo ($new_year - 22)."年"; ?></option>                                    
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: end;">統計期間 (月)</th>
                                    <td>
                                        <select name="month_prev" id="month_prev" style="margin-left: 0.5rem;">
                                            <option>01月</option>
                                            <option>02月</option>
                                            <option>03月</option>
                                            <option>04月</option>
                                            <option>05月</option>
                                            <option>06月</option>
                                            <option>07月</option>
                                            <option>08月</option>
                                            <option>09月</option>
                                            <option>10月</option>
                                            <option>11月</option>
                                            <option>12月</option>
                                        </select>
                                        <span> ~ </span>
                                        <select name="month_fol" id="month_fol">
                                            <option>01月</option>
                                            <option>02月</option>
                                            <option>03月</option>
                                            <option>04月</option>
                                            <option>05月</option>
                                            <option>06月</option>
                                            <option>07月</option>
                                            <option>08月</option>
                                            <option>09月</option>
                                            <option>10月</option>
                                            <option>11月</option>
                                            <option>12月</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: middle; text-align: end;">顯示格式</th>
                                    <td>
                                    <div class="chart-button">
                                        <div class="d-flex justify-content-start">
                                            <div class="button-sections">
                                                <button onclick="createDoughnut()" data-type="doughnut" >Doughnut</button>
                                                <button onclick="createBar()" data-type="bar">Groupd Bar</button>
                                                <button onclick="createLine()" data-type="line">Line</button>
                                                <button onclick="createMixed()" data-type="mixed">Mixed</button>
                                            </div>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="chart-button mb-2">
                        <div class="d-flex justify-content-end">
                            <div class="button-sections">
                                <button onclick="createDoughnut()" data-type="doughnut" >Doughnut</button>
                                <button onclick="createBar()" data-type="bar">Groupd Bar</button>
                                <button onclick="createLine()" data-type="line">Line</button>
                                <button onclick="createMixed()" data-type="mixed">Mixed</button>
                            </div>
                        </div>
                    </div> -->

                    <!-- <button>export</button> -->

                    <div class="chart-div" style="overflow-x: scroll;">
                        <div class="border border-1" style="border-radius: 4px;">
                            <div class="chart-content">
                                <div class="chart-container">
                                    <canvas id="canvasDoughnut" class="chart active" data-content="doughnut" style="width: 400px; height: 400px;"></canvas>
                                    <canvas id="canvasBar" class="chart" data-content="bar" style="width: 400px; height: 400px;"></canvas>
                                    <canvas id="canvasLine" class="chart" data-content="line" style="width: 400px; height: 400px;"></canvas>
                                    <canvas id="canvasMixed" class="chart" data-content="mixed"></canvas>
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
    <script type="module" src="../js/main.js"></script>
    <script src="../js/logout2.js"></script>
    <script src="../js/chart2.js"></script>
    <script src="../js/calculate3.js"></script>

    <script>
        // Select 
        let year = document.querySelector('#year');
        let month_prev = document.querySelector('#month_prev');
        let month_fol = document.querySelector('#month_fol');

        year.addEventListener('change',()=>{
            console.log(year.value.slice(0,-1));
            //console.log(parseInt(year.value));
        });

        month_prev.addEventListener('change',()=>{
            console.log(month_prev.value.slice(0,-1));
        });

        month_fol.addEventListener('change',()=>{
            console.log(month_fol.value.slice(0,-1));
        });

        const month = ['01','02','03','04','05','06',];
        // Chart Test
        const ctg = document.getElementById('canvasDoughnut');
        const ctx = document.getElementById('canvasBar');
        const ctl = document.getElementById('canvasLine');

        // let array_month_income = <?php echo json_encode($array_month_income);?>;
        // let array_month_expense = <?php echo json_encode($array_month_expense);?>;
        // let array_sum_income = <?php echo json_encode($array_sum_income);?>;
        // let array_sum_expense = <?php echo json_encode($array_sum_expense);?>;
        
        // let result_month = (array_month_income.length > array_month_expense.length ? array_month_income : array_month_expense);

        // const arr_function = result_month.map((month, index) =>{
        //     let monthObject = {};
        //     monthObject.month = month;
        //     monthObject.income = {};
        //     monthObject.income = array_sum_income[index];
        //     monthObject.expense = {};
        //     monthObject.expense = array_sum_expense[index];
        //     // monthObject.sum = {};
        //     // monthObject.sum = array_sum[index];

        //     return monthObject;
        // });

        // console.log(arr_function);

        const createDoughnut = () =>{
            const mychart = new Chart(ctg,{
                type : 'doughnut',
                data : {
                    labels : ['Income','Expense'],
                    datasets : [{
                        fill: true,
                        label : 'Test',
                        data : [60, 40],
                        backgroundColor : ['rgb(54, 162, 235)','rgb(255, 99, 132)'],
                        borderColor : ['rgb(54, 162, 235)','rgb(255, 99, 132)'],
                        borderWidth : 1
                    }]
                },
                option : {
                    title : {
                        display : true,
                        text : 'Expense Management Doughnut'
                    },
                    animation : {
                        animateScale : true,
                        animateRotate : true
                    },
                    responsive : true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'right',
                    },
                }
            })
        }
        
        createDoughnut();

        const createBar = () =>{
            const mychart = new Chart(ctx,{
                type : 'bar',
                data : {
                    // labels : array_month_expense,
                    datasets : [
                        {
                            fill: true,
                            label : 'Income',
                            // data : array_sum_income,
                            backgroundColor : 'rgb(54, 162, 235)',
                            borderColor : 'rgb(54, 162, 235)',
                            borderWidth : 1
                        },
                        {
                            fill: true,
                            label : 'Expense',
                            // data : array_sum_expense,
                            backgroundColor : 'rgb(255, 99, 132)',
                            borderColor : 'rgb(255, 99, 132)',
                            borderWidth : 1
                        },

                    ]
                },
                option : {
                    responsive : true,
                    maintainAspectRatio: false,
                    plugins :{
                        title : {
                            display : true,
                            text : 'Expense Management Bar'
                        },
                        legend : {
                            position: 'right',
                        }
                    }
                }
            })
        }

        const createLine = () =>{
            const mychart = new Chart(ctl,{
                type : 'line',
                data : {
                    labels : ['8月','9月','10月','11月','12月'],
                    datasets : [
                        {
                            fill: true,
                            label : 'Income',
                            data : [30200,29874,32541,36745,35108],
                            // backgroundColor : 'rgb(54, 162, 235)',
                            // borderColor : 'rgb(54, 162, 235)',
                            // borderWidth : 1
                            fillColor : "rgba(220,220,220,0.2)",
                            strokeColor : "rgba(220,220,220,1)",
                            pointColor : "rgba(220,220,220,1)",
                            pointStrokeColor : "#fff",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                        },
                        {
                            fill: true,
                            label : 'Expense',
                            data : [16543,12789,14200,12900,21630],
                            fillColor: "rgba(151,187,205,0.2)",
                            strokeColor: "rgba(151,187,205,1)",
                            pointColor: "rgba(151,187,205,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(151,187,205,1)",
                        },

                    ]
                },
                option : {
                    responsive : true,
                    maintainAspectRatio: false,
                    plugins :{
                        title : {
                            display : true,
                            text : 'Expense Management Line'
                        },
                        legend : {
                            position: 'right',
                        }
                    }
                }
            })
        }

        const createMixed = () =>{}
    </script>
</body>
</html>
