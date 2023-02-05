<?php
    // 如果已登入過，將會自動跳轉至 index.php (瀏覽器未關閉過的情況下)
    session_start();
    if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
        header("Location: ../index.php");
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

    <link rel="icon" type="image/icon" href="../img/icon.png">

    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/register2.css">
    <style>
        main .error-message .error-msg{
            display: flex;
            flex-wrap: nowrap;
            width: 100%;
            height: 100%;
            min-height: 60px;
            background-color: #FFF;
            border: 1px solid black;
            margin-bottom: 2rem;
            box-shadow: 2px 4px 10px rgba(0,0,0,0.1);
        }

        main .error-message .error-msg .msg-icon{
            background: black;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #FFF;
            font-size: 1.6rem;
            flex: 1;
            padding: 0.5rem;
        }

        main .error-message .error-msg .msg-content{
            background: #FFF;
            color: black;
            display: flex;
            align-items: center;
            flex: 8;
            padding: 1.2rem;
            font-size: 1.2rem;
        }

        main .error-message .error-msg.msg-danger{
            border: 1px solid #d46361;
        }

        main .error-message .error-msg.msg-danger .msg-icon{
            background: #d46361;
        }

        main .error-message .error-msg.msg-danger .msg-content{
            color: #d46361;
        }

        main .error-message .error-msg .msg-content p{
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="container-fluid" style="padding: 0 1.5rem;">
                <div class="nav-wrapper d-flex justify-content-between align-items-center">
                    <div class="nav-logo">
                        <a href="./login.php">
                            <span>記帳管理系統</span>
                        </a>
                    </div>
                    <div class="nav-hamburger">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class='bx bx-menu bx-sm'></i>
                        </button>
                    </div>
                    <div class="nav-list">
                        <ul>
                            <li><a href="./login.php">登入</a></li>
                            <li><a href="./register.php">註冊</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
        <?php
            if(isset($_SESSION['message'])){
                ?>
                <div class="messagebox">
                    <div class='msg msg-success'>
                        <div class='msg-icon'>
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class='msg-content'>
                            <p><?php echo $_SESSION['message']; ?></p>
                        </div>
                    </div>
                </div>
                <?php
                // In order to show message once
                unset($_SESSION['message']);
            }
        ?>
        <div class="error-message"></div>
            <div class="row ms-0 me-0">
                <div class="card p-0">
                    <div class="card-header">
                        <span style="font-weight: 700;">會員登入</span>
                    </div>
                    <div class="card-body">
                        <form  method="POST">
                            <div class="mb-3 row justify-content-center align-items-baseline">
                                <label for="email" class="form-label col-md-2">電子郵件</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div id="error-name"></div>
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center align-items-baseline">
                                <label for="password" class="form-label col-md-2">密碼</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div id="error-name"></div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-2"></div>
                                <div class="col-md-6 forget-password">
                                    <a href="./forget.php">忘記密碼</a>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="form-btn" value="登入" disabled>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="../js/login.js"></script>
    <script src="../js/login_verify2.js"></script>
    <script>
        $('.messagebox').delay('3000').fadeOut();
    </script>
</body>
</html>