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
    <link rel="stylesheet" href="../css/sum.css">
</head>
<body>
    <header>
        <nav class="navbar-area">
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
                    </div>
                </div>
                <div class="content-wrapper">
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
                                        $sql = "SELECT SUM(Money) AS Total FROM `income`";
                                        $query = mysqli_query($con, $sql);

                                        while($row = mysqli_fetch_array($query)){
                                            echo $row['Total'];
                                        }
                                    ?>
                                </span>
                            </li>
                            <li class="d-flex justify-content-between">
                                Total Expense
                                <span class="expense-total">$
                                    <?php
                                        $sql2 = "SELECT SUM(Money) AS Total FROM `expense`";
                                        $query = mysqli_query($con, $sql2);
                                        

                                        while($row2 = mysqli_fetch_array($query)){
                                            echo $row2['Total'];
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
    
    <script>
        // Check balance value to change text color
        let sum_total = document.querySelector('.sum-total');
        let number =  document.querySelector('.sum-total-number').textContent;
        sum_total.style.color = number < 0 ? "rgb(219, 17, 17)" : "rgb(85, 130, 214)";
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script type="module" src="../js/main5.js"></script>
</body>
</html>


