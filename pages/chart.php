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
</head>
<body>
    <header>
        <nav class="navbar-area" style="position: fixed; z-index : 5000;">
            <div class="container-fluid">
                <div class="nav-wrapper">
                    <div class="logo">
                        <a href="../index.php">
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
        include('../config.php');
        session_start();

        $username =$_SESSION['name'];

        $sql = "SELECT SUM(Money) FROM `income` WHERE Month = '11' AND Name = '$username'";
        $sql2 = "SELECT SUM(Money) FROM `income` WHERE Month = '12' AND Name = '$username'";
        $query = mysqli_query($con,$sql);
        $query2 = mysqli_query($con,$sql2);

        while($row = mysqli_fetch_array($query)){
            $Nov = $row['SUM(Money)'];
        }

        while($row2 = mysqli_fetch_array($query2)){
            $Dec = $row2['SUM(Money)'];
        }
    ?>

    <main>
        <div class="container-fluid" style="padding: 0;">
            <div class="wrapper">
                <div class="sidebar d-flex flex-column">
                    <div class="sidebar-navbar toggle">
                        <ul>
                            <li>
                                <a href="../index.php" class="d-flex align-items-center"><i class='bx bxs-dashboard'></i><span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="./incomes.php" class="d-flex align-items-center">
                                    <i class="fa-solid fa-money-check-dollar"></i>
                                    <span>Incomes</span>
                                </a>
                            </li>
                            <li>
                                <a href="./expenses.php" class="d-flex align-items-center">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                    <span>Expenses</span>
                                </a>
                            </li>
                            <li>
                                <a href="./sum.php" class="d-flex align-items-center">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                    <span>Sum</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="./chart.php" class="d-flex align-items-center"><i class='bx bxs-chart'></i><span>Chart</span></a>
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
                          <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Chart</li>
                        </ol>
                    </nav>
                    <div class="chart-button">
                        <div class="d-flex justify-content-end">
                            <div class="button-sections">
                                <button onclick="createDoughnut()" data-type="doughnut" >Doughnut</button>
                                <button onclick="createBar()" data-type="bar">Groupd Bar</button>
                                <button onclick="createLine()" data-type="line">Line</button>
                                <button onclick="createMixed()" data-type="mixed">Mixed</button>
                            </div>
                        </div>
                    </div>
                    <div class="chart-div" style="overflow-x: scroll;">
                        <div class="d-flex flex-column border border-1" style="border-radius: 4px;">
                            <div class="chart-content">
                                <div class="chart-container">
                                    <canvas id="canvasDoughnut" class="chart active" data-content="doughnut"></canvas>
                                    <canvas id="canvasBar" class="chart" data-content="bar"></canvas>
                                    <canvas id="canvasLine" class="chart" data-content="line"></canvas>
                                    <canvas id="canvasMixed" class="chart" data-content="mixed"></canvas>
                                    <!-- 參考 Sass-SCSS -->
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
    <script type="module" src="../js/main5.js"></script>
    <script src="../js/logout2.js"></script>
    <script src="../js/chart2.js"></script>

    <script>
        // Chart Test
        const ctg = document.getElementById('canvasDoughnut');
        const ctx = document.getElementById('canvasBar');
        const ctl = document.getElementById('canvasLine');

        let nov = <?php echo $Nov; ?>;
        let dec = <?php echo $Dec; ?>;

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
                    labels : ['11月','12月'],
                    datasets : [
                        {
                            fill: true,
                            label : 'Income',
                            data : [nov,dec],
                            backgroundColor : 'rgb(54, 162, 235)',
                            borderColor : 'rgb(54, 162, 235)',
                            borderWidth : 1
                        },
                        {
                            fill: true,
                            label : 'Expense',
                            data : [40,20],
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
