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

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(isset($_POST['email'])){
            $email = $_POST['email'];

            // Verify email is valid or invalid
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                echo "無效的電子郵件";
            }else{
                $emailCheckQuery = "SELECT * FROM user WHERE Account = '$email'";
                $emailCheckResult = mysqli_query($con,$emailCheckQuery);

                if($emailCheckResult){
                    if(mysqli_num_rows($emailCheckResult) > 0){
                        // Verification_code and expire time here
                        $verification_code = rand(100000,999999);
                        $expire = time() + (60 * 2);
    
                        $forgetRecordQuery = "INSERT INTO codes(Email, Code, Expire) VALUES('$email','$verification_code','$expire')";
                        $forgetRecordResult = mysqli_query($con,$forgetRecordQuery);
                        
                        if($forgetRecordResult){
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
                            
                            $mail -> addAddress($email);
    
                            $output='<p>親愛的用戶您好，</p>';
                            $output.='<p>非常感謝您使用本系統之服務，我們已收到您重置密碼的申請，以下為您的驗證碼 : </p>';
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
                                $_SESSION['email'] = $email;
                                $_SESSION['mode'] = 'forgetPassword';
    
                                echo "success";
                            }else{
                                echo "信件未成功送出, 錯誤資訊 : {$mail->ErrorInfo}";
                            }
                        }else{
                            echo "資料寫入資料庫時發生錯誤!";
                        }  
                    }else{
                        echo "此電子郵件尚未註冊";
                    }
                }else{
                    echo "資料庫讀取或連線時發生錯誤!";
                }
            }
        }
    }
?>