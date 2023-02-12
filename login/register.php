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
    <link rel="stylesheet" href="../css/register.css">
    <style>
        .loader{
            width: 25px;
            height: 25px;
            display: inline-block;
            border: 4px solid #fff;
            border-top-color: transparent;
            border-radius: 50%;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
            vertical-align: middle;
        }

        @keyframes rotation{
            0%{
                transform: rotate(0deg);
            }
            100%{
                transform: rotate(360deg);
            }
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
            <div class="messagebox"></div>
            <div class="row ms-0 me-0">
                <div class="card p-0">
                    <div class="card-header">
                        <span style="font-weight: 700;">會員註冊</span>
                    </div>
                    <div class="card-body">
                        <form  method="POST">
                            <div class="mb-3 row justify-content-center">
                                <label for="name" class="form-label col-md-2">使用者名稱</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="name" name="name">
                                    <div id="error-name"></div>
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center">
                                <label for="email" class="form-label col-md-2">電子郵件</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="email" name="email">
                                    <div id="error-name"></div>
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center">
                                <label for="password" class="form-label col-md-2">密碼</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div id="error-name"></div>
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center">
                                <label for="con_password" class="form-label col-md-2">確認密碼</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="con_password" name="con_password">
                                    <div id="error-name"></div>
                                </div>
                            </div>
                            <div class="text-center">
                                <!-- <input type="submit" class="form-btn" value="註冊">  -->
                                <button type="submit" class="form-btn" disabled>註冊</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.37/dist/sweetalert2.all.min.js"></script>
    <script src="../js/login.js"></script>
    <script src="../js/register_verify.js"></script>
</body>
</html>