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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/chart.css">
    <link rel="stylesheet" href="../css/calculate.css">
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
    ?>

    <main>
        <div class="container-fluid" style="padding: 0;">
            <div class="wrapper">
                <div class="sidebar d-flex flex-column">
                    <div class="sidebar-navbar toggle">
                        <ul>
                            <li>
                                <a href="../index.php" class="d-flex align-items-center"><i class='bx bxs-dashboard'></i><span>控制台</span></a>
                                <span class="tooltips">控制台</span>
                            </li>
                            <li>
                                <a href="./incomes.php" class="d-flex align-items-center">
                                    <i class="fa-solid fa-money-check-dollar"></i>
                                    <span>收入</span>
                                </a>
                                <span class="tooltips">收入</span>
                            </li>
                            <li>
                                <a href="./expenses.php" class="d-flex align-items-center">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                    <span>支出</span>
                                </a>
                                <span class="tooltips">支出</span>
                            </li>
                            <li>
                                <a href="./sum.php" class="d-flex align-items-center">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                    <span>總和</span>
                                </a>
                                <span class="tooltips">總和</span>
                            </li>
                            <li class="active">
                                <a href="./chart.php" class="d-flex align-items-center"><i class='bx bxs-chart'></i><span>統計圖表</span></a>
                                <span class="tooltips">統計圖表</span>
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
                                <i class="bx bx-log-out" onclick="logout(1)"></i>
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
                                                <button data-type="line" class="active">折線圖</button>
                                                <button data-type="bar">長條圖</button>                                       
                                                <button data-type="stacked">堆疊圖</button>
                                                <button data-type="horizontal-bar">橫條圖</button>
                                                <button data-type="table">網頁</button>
                                            </div>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="chart-search text-center">
                            <button class="chart-paint btn btn-primary">查詢</button>
                        </div>
                    </div>
                    <div class="chart-div mt-3" style="overflow-x: scroll;">
                        <div class="bordered border-1" style="border-radius: 4px;">
                            <div class="chart-content">
                                <div class="chart-export text-end">
                                    <button class="btn-export" onclick="exportImage()" style="display: none;">匯出</button>
                                </div>
                                <div class="chart-container">
                                    <canvas id="canvasBar" class="chart" data-content="doughnut" style="width: 400px; height: 400px; max-height: 550px;"></canvas>
                                    <div class="chart-result-table"></div>
                                    <!-- <canvas id="canvasBar" class="chart active" data-content="bar" style="width: 400px; height: 400px;max-height:500px;"></canvas>
                                    <canvas id="canvasLine" class="chart active" data-content="line" style="width: 400px; height: 400px;"></canvas>
                                    <canvas id="canvasMixed" class="chart active" data-content="mixed"></canvas> -->
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
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/duration.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.7.570/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script type="module" src="../js/main2.js"></script>
    <script src="../js/logout.js"></script>
    <!-- <script src="../js/chart2.js"></script> -->
    <script src="../js/calculate.js"></script>

    <script>
        // Day.JS plugin : duration
        dayjs.extend(window.dayjs_plugin_duration);

        // Select 
        let year = document.querySelector('#year');
        let month_prev = document.querySelector('#month_prev');
        let month_fol = document.querySelector('#month_fol');
        let types = document.querySelectorAll('.chart-button button');

        let data_year = year.value.slice(0,-1);
        let data_month_prev = month_prev.value.slice(0,-1);
        let data_month_fol = month_fol.value.slice(0,-1);

        // Selected year / month_prev / month_fol
        year.addEventListener('change',()=>{
            console.log(year.value.slice(0,-1));
            data_year = year.value.slice(0,-1);
        });

        month_prev.addEventListener('change',()=>{
            console.log(month_prev.value.slice(0,-1));
            data_month_prev = month_prev.value.slice(0,-1);
        });

        month_fol.addEventListener('change',()=>{
            console.log(month_fol.value.slice(0,-1));
            data_month_fol = month_fol.value.slice(0,-1);
        });

        // Chart type button active
        types.forEach((btn)=>{
            btn.addEventListener('click',()=>{
                document.querySelector('button.active').classList.remove('active');
                btn.classList.add('active');
                type = btn.getAttribute('data-type');
            })
        });

        // Chart Code
        const canvas = document.getElementById('canvasBar');
        const ctx = canvas.getContext('2d');

        let type = 'line';
        let mychart;
        let isPaint = false;

        let income_data = [];
        let expense_data = [];
        let income_month = [];
        let income_money = [];
        let expense_month = [];
        let expense_money = [];
        
        $('.chart-paint').on('click',()=>{
            if(data_month_prev > data_month_fol){
                Swal.fire({
                    icon : 'error',
                    title : '輸入錯誤',
                    text : '前面選擇的月份不能大於後面月份!',
                    showCloseButton: true
                });
            }else{
                const begin = dayjs(`${data_year}-${data_month_prev}`);
                const end = dayjs(`${data_year}-${data_month_fol}`);

                // Get monthly difference 
                const monthDiff = Math.abs(dayjs.duration(begin.diff(end)).months());

                $.ajax({
                    url : `../chart_process.php?year=${data_year}&prev=${data_month_prev}&fol=${data_month_fol}`,
                    type : 'GET',
                    success : (response)=>{
                        if(isPaint){
                            mychart.destroy();
                            isPaint = false;
                        }

                        income_data = [],
                        expense_data = [],
                        income_month = [];
                        income_money = [];
                        expense_month = [];
                        expense_money = [];

                        for(let i = 0; i <= monthDiff; i++){
                            const date = begin.add(i, 'month');
                            income_data.push({year: date.year(), month: date.month()+1, money: null});
                            expense_data.push({year: date.year(), month: date.month()+1, money: null});
                        }

                        let data = JSON.parse(response);

                        // 解構賦值
                        [income_Object, expense_Object] = [data[0], data[1]];
        
                        // Push data into array
                        income_data.forEach( r =>{
                            r.money = (income_Object.find( d=> d.month === r.month)) ?.money ?? 0;
                            income_month.push(`${r.month}月`);
                            income_money.push(r.money);
                        });
                        expense_data.forEach( r =>{
                            r.money = (expense_Object.find(d => d.month === r.month)) ?.money ?? 0;
                            expense_month.push(`${r.month}月`);
                            expense_money.push(r.money);
                        });

                        Chart_paint(type);
                    },
                    error : (error)=>{
                        console.log(error);
                    }
                });
            }
        });
        
        const Chart_paint = (type)=>{
            document.querySelector('.chart-div').style.display = 'block';

            if(type == 'table'){
                document.querySelector('.chart-div .bordered').style.borderWidth = '0px';
                document.querySelector('.chart-container canvas').style.display = 'none';
                document.querySelector('.chart-container .chart-result-table').style.display = 'block'; 
                Generate_table();
            }else{
                document.querySelector('.chart-div .bordered').style.borderWidth = '1px';
                document.querySelector('.chart-container canvas').style.display = 'block';
                document.querySelector('.chart-container .chart-result-table').style.display = 'none';
                isPaint = true;
                Painting(type);
            }
        }

        // Export(Download) Image
        const exportImage = () => {
            // 背景黑色暫不處理
            let a = document.createElement('a');
            a.href = document.querySelector('#canvasBar').toDataURL('image/png', 1.0);
            a.download = 'chart.png';
            a.click();
        }

        const data = (type) => {
            return {
                labels : expense_month,
                datasets : [
                    {
                        fill: (type == 'line')?false:true,
                        label : '收入',
                        data : income_money,
                        backgroundColor : 'rgb(54, 162, 235)',
                        borderColor : 'rgb(54, 162, 235)',
                        borderWidth : (type == 'line')?3:1,
                        hoverBackgroundColor: 'rgba(54, 162, 235, 0.5)',
                        pointRadius: (type == 'line')?8:0,
                        pointHoverRadius : (type == 'line')?10:0,
                    },
                    {
                        fill: (type == 'line')?false:true,
                        label : '支出',
                        data : expense_money,
                        backgroundColor : 'rgb(255, 99, 132)',
                        borderColor : 'rgb(255, 99, 132)',
                        borderWidth : (type == 'line')?3:1,
                        hoverBackgroundColor: 'rgba(255, 99, 132, 0.5)',
                        pointRadius: (type == 'line')?8:0,
                        pointHoverRadius : (type == 'line')?10:0,
                    },
                ]
            } 
        };

        const config = (type) =>{
            if(type == 'horizontal-bar'){
                return {
                    responsive : true,
                    plugins :{
                        tooltip : {
                            backgroundColor: 'rgba(245, 245, 245, 0.7)',
                            borderColor : 'rgba(169, 169, 169, 0.8)',
                            borderWidth : 1,
                            titleColor : 'gray',
                            bodyColor : 'gray',
                            caretSize : 0,
                            titleFont : { size : 18, weight : 'bold' },
                            bodyFont : { size : 18, weight : 'bold' },
                            padding : 10,
                        },
                        title : {
                            display : true,
                            text : `${data_year}年統計圖表`,
                            padding : {
                                top : 15,
                                bottom : 25
                            },
                            font : {
                                size : 22
                            }
                        },
                        legend : {
                            display : true,
                            position: 'bottom',
                            labels: {
                                padding: 30
                            }
                        },
                    },
                    indexAxis: 'y',
                }  
            }else{
                return {
                    responsive : true,
                    plugins :{
                        tooltip : {
                            backgroundColor: 'rgba(245, 245, 245, 0.7)',
                            borderColor : 'rgba(169, 169, 169, 0.8)',
                            borderWidth : 1,
                            titleColor : 'gray',
                            bodyColor : 'gray',
                            caretSize : 0,
                            titleFont : { size : 18, weight : 'bold' },
                            bodyFont : { size : 18, weight : 'bold' },
                            padding : 10,
                        },
                        title : {
                            display : true,
                            text : `${data_year}年統計圖表`,
                            padding : {
                                top : 15,
                                bottom : 25
                            },
                            font : {
                                size : 22
                            }
                        },
                        legend : {
                            display : true,
                            position: 'bottom',
                            labels: {
                                padding: 30
                            }
                        },
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    }, 
                    scales: {
                        x : {
                            stacked : (type == 'stacked')?true:false
                        },
                        y: {
                            stacked : (type == 'stacked')?true:false,
                            type: 'linear',
                            display: true,
                            position: 'left',
                        },
                    }
                }
            }
        };

        // Special type convert
        const Type = (type) =>{
            if(type === 'bar'){
                return type;
            }else if(type === 'line'){
                return type;
            }else if(type === 'stacked'){
                return 'bar';
            }else if(type === 'horizontal-bar'){
                return 'bar';
            }
        }

        // Painting the chart
        const Painting = (type) =>{
            mychart =  new Chart(ctx, {
                type : Type(type),
                data : data(type),
                options : config(type)
            });
        }

        // Generate statistical table
        const Generate_table = () =>{
            document.querySelector('.chart-container .chart-result-table').innerHTML = `
                <h3>${data_year} 年 ${data_month_prev}月 ~ ${data_month_fol} 月統計表</h3>
                <table class='table table-bordered table-striped'>
                    <thead>
                        <tr>
                            <th>月份</th>
                            <th>收入 (元)</th>
                            <th>支出 (元)</th>
                            <th>結餘 (元)</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${myFunction()}
                    </tbody>
                </table>
            `
        }

        const myFunction = () =>{
            let x = '';
            let tr = '';
            for(let i in income_data){
                tr += '<tr>';
                tr += `<td>${income_month[i]}</td><td>${income_money[i]}</td><td>${expense_money[i]}</td><td>${income_money[i] - expense_money[i]}</td>`
                tr += '</tr>';
            }

            x += tr;
            return x;
        }
    </script>
</body>
</html>
