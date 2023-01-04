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
    <link rel="stylesheet" href="../css/sum.css">
    <link rel="stylesheet" href="../css/calculate.css">
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
                            <li class="active">
                                <a href="./sum.php" class="d-flex align-items-center">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                    <span>Sum</span>
                                </a>
                            </li>
                            <li>
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
                          <li class="breadcrumb-item active" aria-current="page">Sum</li>
                        </ol>
                    </nav>
                    <div class="sum-data total-div">
                        <ul class="d-flex flex-column">
                            <li class="text-center title">All Data</li>
                            <li class="d-flex justify-content-between">
                                Total Income
                                <span class="income-total">$
                                    <?php
                                        $username = $_SESSION['name']; 
                                        $sql = "SELECT SUM(Money) AS Total FROM `income` WHERE Name = '$username'";
                                        $query = mysqli_query($con, $sql);

                                        while($row = mysqli_fetch_array($query)){
                                            if($row['Total'] == 0){
                                                echo 0;
                                            }else{
                                                echo $row['Total'];
                                            }
                                        }
                                    ?>
                                </span>
                            </li>
                            <li class="d-flex justify-content-between">
                                Total Expense
                                <span class="expense-total">$
                                    <?php
                                        $sql2 = "SELECT SUM(Money) AS Total FROM `expense` WHERE Name = '$username'";
                                        $query = mysqli_query($con, $sql2);
                                        

                                        while($row2 = mysqli_fetch_array($query)){
                                            if($row2['Total'] == 0){
                                                echo 0;
                                            }else{
                                                echo $row2['Total'];
                                            }
                                        }
                                    ?>
                                </span>
                            </li>
                            <li class="d-flex justify-content-between" style="border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;">
                                Balance
                                <span class="sum-total">$
                                    <span class="sum-total-number">
                                        <?php
                                            $qry = mysqli_query($con,$sql);
                                            $qry2 = mysqli_query($con,$sql2);

                                            $row = mysqli_fetch_assoc(($qry));
                                            $row2 = mysqli_fetch_assoc(($qry2));

                                            echo $row['Total'] - $row2['Total'];
                                        ?>
                                    </span>
                                </span>                                 
                            </li>
                        </ul>
                    </div>
                    <div class="record-content">
                        <div class="row">
                            <?php
                                $sql = "SELECT * FROM `income` WHERE Name = '$username' UNION SELECT * FROM `expense` WHERE Name = '$username' ORDER BY `Date_billing` DESC, `Time_create` DESC";
                                $query = mysqli_query($con, $sql);

                                while($row = mysqli_fetch_array($query))
                                {
                                    if($row['Type'] == 'income'){
                                        echo "
                                        <div class='col-sm-6 col-lg-4 mb-3'>
                                            <div class='card income_card'>
                                                <div class='card-date card-header d-flex justify-content-between align-items-center'>
                                                    <div class='card-date'>$row[Date_billing]</div>
                                                </div>
                                                <div class='card-body d-flex justify-content-between'>
                                                    <div class='card-description'>$row[Description]</div>
                                                    <div calss='card-amount' style='font-weight:600'>$ $row[Money]</div>
                                                </div>
                                            </div>
                                        </div>";
                                    }else if($row['Type'] == 'expense'){
                                        echo "
                                        <div class='col-sm-6 col-lg-4 mb-3'>
                                            <div class='card expense_card'>
                                                <div class='card-date card-header d-flex justify-content-between align-items-center'>
                                                    <div class='card-date'>$row[Date_billing]</div>
                                                </div>
                                                <div class='card-body d-flex justify-content-between'>
                                                    <div class='card-description'>$row[Description]</div>
                                                    <div calss='card-amount' style='font-weight:600'>$ $row[Money]</div>
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="calculate-button">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.37/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script type="module" src="../js/main.js"></script>
    <script src="../js/logout2.js"></script>
    <script src="../js/calculate.js"></script>
    
    <script>
        // Check balance value to change text color
        let sum_total = document.querySelector('.sum-total');
        let number =  document.querySelector('.sum-total-number').textContent;
        sum_total.style.color = number < 0 ? "rgb(219, 17, 17)" : "rgb(85, 130, 214)";
    </script>
</body>
</html>


