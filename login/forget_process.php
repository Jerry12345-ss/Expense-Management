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

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(isset($_POST['email'])){
            $email = $_POST['email'];

            // Verify email is valid or invalid
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                echo 0;
            }else{
                $mail = new PHPMailer();

                $mail -> IsSMTP();
                $mail -> SMTPAuth = true;
                $mail -> Host = 'smtp.gmail.com';
                $mail -> SMTPSecure = 'tls';
                $mail -> Port = '587';

                $mail -> Username = 'justway123456@gmail.com';
                $mail -> Password = '27936702';
                $mail -> From = 'justway123456@gmail.com';
                $mail -> FromName = 'Expense Management';
                
                $mail -> addAddress($email);

                $output='<p>Dear user,</p>';
                $output.='<p>Please click on the following link to reset your password.</p>';
                $output.='<p>-------------------------------------------------------------</p>';
                $output.='<p>Please be sure to copy the entire link into your browser.
                The link will expire after 1 day for security reason.</p>';
                $output.='<p>If you did not request this forgotten password email, no action 
                is needed, your password will not be reset. However, you may want to log into 
                your account and change your security password as someone may have guessed it.</p>';   	
                $output.='<p>Thanks,</p>';
                $output.='<p>AllPHPTricks Team</p>';
                $body = $output; 
                $subject = "Password Recovery - AllPHPTricks.com";

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