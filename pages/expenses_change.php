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
    <link rel="stylesheet" href="../css/income.css">
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

        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }

        $sql = "SELECT * FROM `expense` WHERE ID = '$id'";
        $query = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($query);
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
                            <li class="active">
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
                          <li class="breadcrumb-item active" aria-current="page"><a href="./expenses.php">Expense</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Edit Expense</li>
                        </ol>
                    </nav>
                    <div class="change-content">
                        <div class="change-header">
                            <h3>Edit Expense</h3>
                        </div>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="col-form-label">Expense Amount :</label>
                                <input type="number" class="form-control" id="amount" name="amount" value="<?php echo $row['Money']?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="col-form-label">Expense Description :</label>
                                <input type="text" class="form-control" id="description" name="description" value="<?php echo $row['Description']?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="col-form-label">Expense Date :</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="修改" style="padding: 10px 25px;">
                            </div>
                        </form>
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
    <script type="module" src="../js/main.js"></script>
    <script src="../js/logout2.js"></script>
</body>
</html>