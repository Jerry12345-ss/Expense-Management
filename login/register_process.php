<?php 
    // Import PHPMailer 
    require "../phpmailer/PHPMailer.php";
    require "../phpmailer/SMTP.php";
    require "../phpmailer/Exception.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Database config and connect
    include('../config.php');

    // Session start
    session_start();

    // Set default timezone 
    date_default_timezone_set('Asia/Taipei');

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name'])){
            $account = $_POST['email'];
            $password = $_POST['password'];
            $password_hash = password_hash($password, PASSWORD_DEFAULT); 
            $username = $_POST['name'];
            $con_password = $_POST['con_password'];

            // Verify email is valid or invalid
            if(filter_var($account, FILTER_VALIDATE_EMAIL) === false){
                echo "無效的電子郵件";
            }else{
                if($password !== $con_password){
                    echo "確認密碼匹配錯誤";
                }else{
                    $emailCheckQuery = "SELECT * FROM user WHERE Account = '$account'";
                    $emailCheckResult = mysqli_query($con, $emailCheckQuery);

                    // Prevent duplicate email (account)
                    if($emailCheckResult){
                        if(mysqli_num_rows($emailCheckResult) > 0){
                            echo "此帳號已註冊過";
                        }else{
                            // Verification_code and expire time here
                            $verification_code = rand(100000,999999);
                            $expire = time() + (60 * 2);

                            $registerRecordQuery = "INSERT INTO codes(Email, Code, Expire) VALUES('$account','$verification_code','$expire')";
                            $registerRecordResult = mysqli_query($con, $registerRecordQuery);
                            
                            if($registerRecordResult){
                                $mail = new PHPMailer();
    
                                $mail -> IsSMTP();
                                $mail -> SMTPAuth = true;
                                $mail -> Host = 'smtp.gmail.com';
                                $mail -> SMTPSecure = 'tls';
                                $mail -> Port = '587';
        
                                $mail -> CharSet = 'UTF-8';
                                $mail -> Username = 'justway123456@gmail.com';
                                $mail -> Password = 'qztpddhrjzxjewsh';
                                $mail -> From = 'justway123456@gmail.com';
                                $mail -> FromName = 'Expense Management';
                                
                                $mail -> addAddress($account);
        
                                $output='<p>親愛的用戶您好，</p>';
                                $output.='<p>您正在註冊帳號並綁定電子信箱，以下為您的驗證碼 : </p>';
                                $output.='<p><h2>'.$verification_code.'</h2></p>';
                                $output.='<p>※ 此驗證碼有效期限為2分鐘，敬請於期限內使用。</p>';  
                                $output.='<p>若你對此操作沒有印象，可能是有人未經許可使用了你的信箱，或嘗試盜用你的帳號。為保護你的帳號安全，請勿與其他人分享你的驗證碼。</p>';	
                                $output.='<p>-------------------------------------------------------------</p>';
                                $output.='<p>本郵件為自動送出，請勿直接回覆。</p>';
                                $output.='<p>如果有任何疑問，請透過以下信箱聯絡我們 : </p>';
                                $output.='<p>justway123456@gmail.com</p>';
                                $body = $output; 
                                $subject = "[Expense Management]電子郵件驗證";
        
                                $mail -> isHTML(true);
                                $mail -> Subject = $subject;
                                $mail -> Body = $body;
                                
                                if($mail -> Send()){
                                    $_SESSION['message'] = '我們已經寄送驗證碼到您的信箱了，請查看!';
                                    $_SESSION['email'] = $account;
                                    $_SESSION['username'] = $username;
                                    $_SESSION['password_hash'] = $password_hash;
                                    $_SESSION['mode'] = 'registerUser';
        
                                    echo "success";
                                }else{
                                    echo "信件未成功送出, 錯誤資訊 : {$mail->ErrorInfo}";
                                }
                            }else{
                                echo "資料寫入資料庫時發生錯誤!";
                            }
                        }
                    }else{
                        echo "資料庫讀取或連線時發生錯誤!";
                    }
                }
            }
        }
    }
?>