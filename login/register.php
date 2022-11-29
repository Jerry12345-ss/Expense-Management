<?php 
    include('../config.php');

    $error = false;
    $name_error = "";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(empty($_POST['email'])){
            $name_error = "Name is required";
            exit();
        }
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name'])){
            $account = $_POST['email'];
            $password = $_POST['password'];
            $password_hash = password_hash($password, PASSWORD_DEFAULT); 
            $username = $_POST['name'];

            // setting password requirement
            if(strlen($password) < 8){
                $error = true;
                $password_er = '密碼長度至少8個字元以上';
                // header('Location:register.php');
                echo"11";
                exit();
            }
        
            if(! preg_match("/[a-z]/", $password)){
                $error = "密碼必須包含一個英文字母";
                exit();
            }
        
            if(! preg_match("/[0-9]/", $password)){
                $error = "密碼必須包含一個數字";
                exit();
            }

            if($password !== $_POST['con-password']){
                $error = "確認密碼匹配錯誤";
                exit();
            }

            $check_email = "SELECT * FROM user WHERE Account = '$account'";

            // prevent duplicate email (account)
            if(mysqli_num_rows(mysqli_query($con,$check_email)) > 0){
                $is_invalid = true;
                $error = "此帳號已註冊過!";
                exit();
            }else{
                $sql = "INSERT INTO user(Account, Password, Name) VALUES('$account', '$password_hash', '$username')";
                $query = mysqli_query($con, $sql);

                if($query){
                    header("Location:login.php");
                    exit();
                }else{
                    $is_invalid = true;
                    $error = "帳號註冊發生錯誤";
                    exit();
                }
            }
        }
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
    <link rel="stylesheet" href="../css/register.css">
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
            <?php
                // include('./register_process.php');
                $name_error;
            ?>
            <div class="row">
                <div class="card p-0">
                    <div class="card-header">
                        <span>Register</span>
                    </div>
                    <div class="card-body">
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="mb-3 row justify-content-center">
                                <label for="name" class="form-label col-md-2">Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center">
                                <label for="email" class="form-label col-md-2">Email</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center">
                                <label for="password" class="form-label col-md-2">Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center">
                                <label for="con-password" class="form-label col-md-2">Confirm Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="con-password" name="con-password" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="register-btn" value="Register">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="../js/login.js"></script>
</body>
</html>