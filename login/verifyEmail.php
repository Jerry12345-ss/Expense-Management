<?php
    // Database config and connect
    include('../config.php');

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
    }else{
        $username = '';
    }
    
    if(isset($_SESSION['password_hash'])){
        $password_hash = $_SESSION['password_hash'];
    }else{
        $password_hash = '';
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
        .remain-text .time{
            display: flex;
            justify-content: center;
        }
        .remain-text .time span{
            margin: 0 0.5rem;
        }
        .remain-text .resend{
            text-align: center;
        }

        .remain-text .resend a{
            pointer-events: none;
            color: rgb(163, 163, 163);
        }

        @media screen and (min-width:576px){
            .remain-text .time{
                justify-content: flex-start;
            }

            .remain-text .resend{
                text-align: end;
            }
        }

        @media screen and (min-width:768px){
            .remain-text .time span{
                margin: 0px;
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
                            <?php
                                if(isset($_SESSION['mode'])){ ?>
                                    <div class="remain-text mb-3 row justify-content-center align-items-baseline">
                                        <div class="time col-sm-6 col-md-4 mb-3">
                                            <span class=" col-md-5" style="margin-left: 0px;">剩餘時間</span>
                                            <span class=" col-md-2">:</span>
                                            <span class="timer col-md-5" style="color: indianred;"></span>
                                        </div>
                                        <div class="resend col-sm-6 col-md-4">   
                                            <a href='#' style="text-decoration: underline;">重新寄送驗證碼</a>
                                        </div>
                                    </div>
                                <?php }
                            ?>
                            <div class="text-center">
                                <!-- <input type="submit" class="form-btn" value="驗證"> -->
                                <button type="submit" class="form-btn">驗證</button>
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

        // Check VerifyEmail From 
        let mode = '<?php echo $mode; ?>';
        let email = '<?php echo $email; ?>';
        let username = '<?php echo $username; ?>';
        let password_hash = '<?php echo $password_hash; ?>';
        let resend = document.querySelector('.resend a');
        let submit_button = document.querySelector('.card-body .form-btn');
        let code_input = document.querySelector('#code');
        let error_div = document.querySelector('.messagebox');

        document.querySelector('.card-body .verify_form').addEventListener('submit',(event)=>{
            let code = code_input.value;
            
            if(code === ''){
                showErrorMessage('請輸入您的驗證碼');
            }else{
                $.ajax({
                    url : '../login/verifyEmail_process.php',
                    type : 'POST',
                    data : {
                        mode : mode,
                        email :email,
                        username : username,
                        password_hash : password_hash,
                        code : code
                    },
                    success : (response)=>{
                        if(response === 'forgetProcess success'){
                            window.location.href = './resetPassword.php';
                        }else if(response === 'registerProcess success'){
                            window.location.href = './login.php';
                        }else{
                            showErrorMessage(response);
                        }
                    },
                    error : (error)=>{
                        console.log(error);
                    }
                })
            }

            function showErrorMessage(errormessage){
                error_div.innerHTML = `
                    <div class='msg msg-danger'>
                        <div class='msg-icon'>
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <div class='msg-content'>
                            <p>${errormessage}</p>
                        </div>
                    </div>
                `;
            }

            event.preventDefault();
        });

        // OTP Countdown timer
        let timer = 60 * 2;
        let display_time = document.querySelector('.timer');
        startTimer(timer, display_time);

        function startTimer(duration, display) {
            let time = duration, minutes, seconds;
            let countdown = setInterval(()=>{
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = duration;
                    clearInterval(countdown);
                    display.textContent = '時間結束!';
                    resend.style.color = 'cadetblue';
                    resend.style.pointerEvents = 'auto';
                }
            }, 1000);
        }

        // Resend Vailication code 
        resend.addEventListener('click',()=>{
            submit_button.innerHTML = 'Loading <span class="loader"></span>';
            submit_button.disabled = true;

            $.ajax({
                url : './resend_process.php',
                type : 'POST',
                data : {
                    mode : mode,
                    email : email
                },
                success : (response)=>{
                    if(response === 'success'){
                        window.location.href = './verifyEmail.php';
                    }
                },
                error : (error)=>{
                    submit_button.innerHTML = '驗證';
                    submit_button.disabled = false;
                    console.log(error);
                }
            })
        });
    </script>
</body>
</html>