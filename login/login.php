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
</head>
<body>
    <header>
        <nav>
            <div class="container-fluid" style="padding: 0 1.5rem;">
                <div class="nav-wrapper d-flex justify-content-between align-items-center">
                    <div class="nav-logo">
                        <a href="./login.php">
                            <span>Expense Management</span>
                        </a>
                    </div>
                    <div class="nav-hamburger">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class='bx bx-menu bx-sm'></i>
                        </button>
                    </div>
                    <div class="nav-list">
                        <ul>
                            <li><a href="./login.php">Login</a></li>
                            <li><a href="./register.php">Register</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
        <div class="error-message"></div>
            <div class="row ms-0 me-0">
                <div class="card p-0">
                    <div class="card-header">
                        <span>Login</span>
                    </div>
                    <div class="card-body">
                        <form  method="POST">
                            <div class="mb-3 row justify-content-center">
                                <label for="email" class="form-label col-md-2">Email</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div id="error-name"></div>
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center">
                                <label for="password" class="form-label col-md-2">Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div id="error-name"></div>
                                </div>
                            </div>
                            <!-- <div class="row justify-content-center">
                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Rember me
                                    </label>
                                </div>
                            </div> -->
                            <div class="text-center">
                                <input type="submit" class="form-btn" value="Login" disabled>
                            </div>
                            <!-- 忘記密碼(重設密碼)看情況 -->
                            <!-- 第三方登入 - FB, 可做可不做 -->
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
    <script src="../js/login_verify.js"></script>
</body>
</html>