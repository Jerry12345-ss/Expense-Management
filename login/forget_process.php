<?php 
    // Import PHPMailer 
    require "../phpmailer/PHPMailer.php";
    require "../phpmailer/SMTP.php";
    require "../phpmailer/Exception.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // database config and connect
    include('../config.php');

    // session start
    session_start();

    // set default timezone 
    date_default_timezone_set('Asia/Taipei');

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(isset($_POST['email'])){
            $email = $_POST['email'];

            // Verify email is valid or invalid
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                echo 0;
            }else{
                // $Unix_time = strtotime(date('Y-m-d H:i:s'));
                // $new_time = $Unix_time + (60*1);
                // $format_time = date('Y-m-d H:i:s',$new_time);
                // echo $format_time;
                
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
                $output.='<p>非常感謝您使用本系統之服務，我們已收到您重設密碼的申請，以下為您的驗證碼 : </p>';
                $output.='<p><h2>123456</h2></p>';
                $output.='<p>※ 此驗證碼有效期限為10分鐘，敬請於期限內使用。</p>';  
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
                    echo "success";
                }else{
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    }
?>