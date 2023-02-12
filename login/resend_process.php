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
        if(isset($_POST['mode']) && isset($_POST['email'])){
            $mode = $_POST['mode'];
            $email = $_POST['email'];

            function resendEmail($con, $email, $content){
                $verification_code = rand(100000,999999);
                $expire = time() + (60 * 2);
    
                $resendRecordQuery = "INSERT INTO codes(Email, Code, Expire) VALUES('$email','$verification_code','$expire')";
                $resendRecordResult = mysqli_query($con,$resendRecordQuery);
                        
                if($resendRecordResult){
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
                    $output.='<p>'.$content.'</p>';
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
                        $_SESSION['message'] = '我們已經重新寄送驗證碼到您的信箱了，請查看!';
                        echo "success";
                    }else{
                        echo "信件未成功送出, 錯誤資訊 : {$mail->ErrorInfo}";
                    }
                }   
            }

            if($mode === 'forgetPassword'){
                $content = '非常感謝您使用本系統之服務，我們已收到您重置密碼的申請，以下為您的驗證碼 : ';
                resendEmail($con, $email, $content);
            }else if($mode === 'registerUser'){
                $content = '您正在註冊帳號並綁定電子信箱，以下為您的驗證碼 : ';
                resendEmail($con, $email, $content);
            }else{
                echo '錯誤!';
            }
        }
    }
?>