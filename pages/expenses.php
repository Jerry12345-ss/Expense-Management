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
    <link rel="stylesheet" href="../css/income.css">
    <link rel="stylesheet" href="../css/calculate.css">
    <style>
        /* Order Button */
        .record-content .filter{
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .record-content .filter button{
            padding: 8px 16px;
            border-radius: 6px;
            background-color: rgba(40, 44, 52, 0.05);
            color: #2e79c4;
            border: 1px solid transparent;
            margin: 5px;
            display: inline-block;
            transition: all 0.25s ease;
        }

        .record-content .filter button:hover{
            background-color: rgba(214, 233, 254, 0.9);
            border: 1px solid rgb(147, 197, 249);
        }

        .record-content .filter button.active{
            background-color: rgba(214, 233, 254, 0.9);
            border: 1px solid rgb(147, 197, 249);
        }

        /* No-Expense */
        .no-expense{
            text-align: center;
            border: 1px solid rgb(225, 223, 223);
            border-radius: 4px;
            margin: 2rem 0rem;
            padding: 2rem;
        }
        @media screen and (min-width:768px){
            .no-expense{
                margin-left: 2rem;
                margin-right: 2rem;
            }
        }
    </style>
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
                            <li class="active">
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
                            <li>
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
                          <li class="breadcrumb-item active" aria-current="page">支出</li>
                        </ol>
                    </nav>
                    <div class="add-record total-div border border-1">
                        <div class="d-flex flex-column">
                            <div class="total-text item d-flex justify-content-around">
                                <span style="font-weight: 700;">總支出</span>
                                <b class="total expense-total">$<span>
                                        <?php
                                            $username = $_SESSION['name'];
                                            $sql = "SELECT SUM(Money) FROM `expense` WHERE Name = '$username'";
                                            $query = mysqli_query($con, $sql);

                                            while($row = mysqli_fetch_array($query)){
                                                if($row['SUM(Money)'] == 0){
                                                    echo 0;
                                                }else{
                                                    echo $row['SUM(Money)'];
                                                }
                                            }
                                        ?>
                                    </span>
                                </b>
                            </div>
                            <div class="add-button item text-center">
                                <button type="button" class="btn btn-primary new-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">新增新支出</button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight: 700;">新增新支出</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST">
                                                    <div class="mb-3">
                                                        <label class="col-form-label">支出金額 :</label>
                                                        <input type="number" class="form-control" id="amount" name="amount" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="col-form-label">支出描述 :</label>
                                                        <input type="text" class="form-control" id="description" name="description" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="date" class="col-form-label">支出日期 :</label>
                                                        <input type="date" class="form-control" id="date" name="date" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                        <input type="submit" class="btn btn-primary" value="新增">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="record-content">
                        <div class="filter mb-3">
                            <button class="order_asc">日期 : 前 <i class="fa-sharp fa-solid fa-arrow-right"></i> 後</button>
                            <button class="order_desc">日期 : 後 <i class="fa-sharp fa-solid fa-arrow-right"></i> 前</button>
                        </div>
                        <div class="row">
                            <?php
                                $sql = "SELECT * FROM `expense` WHERE Name = '$username' ORDER BY `Date_billing` DESC, `Time_create` DESC";
                                $query = mysqli_query($con, $sql);

                                if(mysqli_num_rows($query) > 0){
                                    while($row = mysqli_fetch_array($query))
                                    {
                                        echo "
                                            <div class='col-sm-6 col-lg-4 mb-4'>
                                                <div class='card expense_card' id='$row[ID]'>
                                                    <div class='card-date card-header d-flex justify-content-between align-items-center'>
                                                        <div class='card-date'>$row[Date_billing]</div>
                                                        <div class='btn-group'>
                                                            <div class='edit-card card-btn' onclick='editCard($row[ID])'>
                                                                <a href='#'>編輯</a>
                                                            </div>
                                                            <div class='delete-card card-btn' onclick='deleteCard(2,$row[ID])'>
                                                                <a href='#'>刪除</a>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class='card-body d-flex justify-content-between'>
                                                        <div class='card-description'>$row[Description]</div>
                                                        <div calss='card-amount' style='font-weight:600'>$ $row[Money]</div>
                                                    </div>
                                                </div>
                                            </div>";
                                    }
                                }else{
                                    echo "
                                        <div>
                                            <div class='no-expense'>
                                                <h1>尚未有支出的資料!</h1>
                                            </div>
                                        </div>
                                    ";
                                }
                            ?>
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
    <script type="module" src="../js/main2.js"></script>
    <script type="module" src="../js/expense_add2.js"></script>
    <script src="../js/logout.js"></script>
    <script src="../js/card_delete.js"></script>
    <script src="../js/calculate.js"></script>

    <script>
        // Edit card
        const editCard = (id) =>{
            window.location.href = `../pages/expenses_change.php?id=${id}`;
        }

        // Order Button active
        $('.record-content .filter button').on('click',function(){
            $('.record-content .filter button').removeClass('active');

            $('.record-content .filter button').each(()=>{
                $(this).addClass('active')
            })
        });

        // Content Order ( DESC / ASC )
        let username = '<?php echo $username; ?>';
        let order = '';

        $('.order_desc').click(()=>{
            order = 'desc';

            ContentOrder(order);
        });

        $('.order_asc').click(()=>{
            order = 'asc';

            ContentOrder(order);
        });

        const ContentOrder = (order) =>{
            $.ajax({
                url : `./expenses_order.php?order=${order}`,
                type : 'POST',
                data : { username : username },
                success :(response)=>{
                    document.querySelector('.record-content .row').innerHTML = `${response}`;
                },
                error :(error)=>{
                    console.log(error);
                }
            })
        }
    </script>
</body>
</html>