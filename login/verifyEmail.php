<?php
    // Database config and connect
    include('../config.php');

    // Store all errors
    $errors = [];

    // 如果已登入過，將會自動跳轉至 index.php (瀏覽器未關閉過的情況下)
    session_start();
    if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
        header("Location: ../index.php");
        exit(); 
    }

    if(isset($_SESSION['mode'])){
        $mode = $_SESSION['mode'];
    }

    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
    }
  
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
    
    if(isset($_SESSION['password_hash'])){
        $password_hash = $_SESSION['password_hash'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['code'])){
            $code = $_POST['code'];

            function checkVailication($con, $code, $mode, $email){
                // Get and check vailication code is it due 
                $getExpireQuery = "SELECT * FROM codes WHERE Email = '$email' ORDER BY id DESC LIMIT 1";
                $getExpireResult = mysqli_query($con, $getExpireQuery);

                if($getExpireResult){
                    if(mysqli_num_rows($getExpireResult) > 0){
                        $row = mysqli_fetch_array($getExpireResult);
                        $expire = $row['Expire'];
                        $now_time = time();
                    }else{
                        // $errors['expire_errors'] = '查無資料!';
                        return '查無資料!';
                    }
                }else{
                    // $errors['db_errors'] = '資料庫讀取或連線時發生錯誤!';
                    return '資料庫讀取或連線時發生錯誤!';
                }

                if($code == ''){
                    // $errors['code_null'] = '請輸入驗證碼';
                    return '請輸入驗證碼';
                }else{
                    if($now_time > $expire){
                        // $errors['expire'] = '您的驗證碼已過有效期限';
                        return '您的驗證碼已過有效期限';
                    }else{
                        if($code !== $row['Code']){
                            // $errors['code_error'] = '您輸入的驗證碼有錯，請重新輸入';
                            return '您輸入的驗證碼有錯，請重新輸入';
                        }else{
                            return $mode;
                        }
                    }
                }
            }

            $message_string = checkVailication($con, $code, $mode, $email);

            if($message_string == 'forgetPassword'){
                header("location: resetPassword.php");
            }else if($message_string == 'registerUser'){
                // Insert new user( account ) into database
                $insertUserQuery = "INSERT INTO user(Account, Password, Name) VALUES('$email', '$password_hash', '$username')";
                $insertUserResult = mysqli_query($con, $insertUserQuery);

                if($insertUserResult){
                    $_SESSION['success_message'] = '帳號註冊成功';
                    unset($_SESSION['username']);
                    unset($_SESSION['password_hash']);
                    header('location: login.php');
                }else{
                    echo "資料庫讀取或連線時發生錯誤!";
                }
            }else{
                array_push($errors,$message_string);
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
        <?php
            if($errors > 0){
                foreach($errors AS $displayErrors){
                ?>
                <div class="messagebox">
                    <div class='msg msg-danger'>
                        <div class='msg-icon'>
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <div class='msg-content'>
                            <p><?php echo $displayErrors; ?></p>
                        </div>
                    </div>
                </div>
                <?php
                }
            }
        ?> 
            <div class="row ms-0 me-0">
                <div class="card p-0">
                    <div class="card-header">
                        <span style="font-weight: 700;">信箱驗證</span>
                    </div>
                    <div class="card-body">
                        <form  class="verify_form" method="POST" action="verifyEmail.php">
                            <div class="mb-3 row justify-content-center align-items-baseline">
                                <label for="code" class="form-label col-md-2">驗證碼</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="code" name="code">
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="form-btn" value="驗證">
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
    <script>
        $('.msg-success').delay('3000').fadeOut();
    </script>
</body>
</html>