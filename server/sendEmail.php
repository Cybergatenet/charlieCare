<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

    $errMsg = '';
    $errMsgClass = '';
    $contact_name = $contact_email = $contact_msg = '';

if(isset($_POST['contactMsg'])){
    
    $contact_name = htmlspecialchars($_POST['contact_name']);
    $contact_email = htmlspecialchars($_POST['contact_email']);
    $contact_msg = htmlspecialchars($_POST['contact_msg']);
    
    if(!empty($contact_name) && !empty($contact_email) && !empty($contact_msg)){
        if(filter_var($contact_email, FILTER_VALIDATE_EMAIL) === false){
            $errMsg = "Please use a vaild email";
            $errMsgClass = "alert-danger";
        }else{
            $toemail = "charlycareclasic@gmail.com";
            $title = "Charlycareclasic Contact from ".$contact_name;
            $body = '<html><body>';
            $body .= '<h2>Message For Charlycare Family Office</h2>
            <h4>Name</h4><p>'.$contact_name.'</p>
            <h4>Email</h4><p>'.$contact_email.'</p>
            <h4>Message</h4><p>'.$contact_msg.'</p>';
            $body .= '</body></html>';
            try {
                // Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->SMTPDebug = 0;
                $mail->isSMTP();                      
                $mail->Host       = 'ssl://smtp.gmail.com';
                $mail->SMTPAuth   = true;                  
                $mail->Username   = 'charlycareclasic@gmail.com';
                $mail->Password   = 'ifechukwudi2023';            
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                // $mail->Port       = 587;                        
                $mail->Port       = 465;
            
                //Recipients
                $mail->setFrom('contact@charlycareclasic.com', 'User Contact');
                $mail->addAddress('charlycareclasic@gmail.com', 'Charlycare contact');               
                // $mail->addAddress('cybergatenet@outlook.com', 'Charlycare contact');               
                $mail->addReplyTo($contact_email, 'Sender Contact');
 
                // Content
                $mail->isHTML(true);        
                $mail->Subject = $title;
                $mail->Body = $body;
                    
                $mail->send();
                    $errMsg = "Thank you ".$contact_name . " for partnering with us."."\r\n"." Your Request is being considered and we will get back to you ASAP";
                    $errMsgClass = "alert-success";
                    $contact_name = $contact_email = $contact_msg = '';
            } catch (Exception $e) {
                $errMsg = "Your email was not successful. Try again later.<br> Mailer Error: {$mail->ErrorInfo}";
				$errMsgClass = "alert-danger";
            }
        }
    }else{
        $errMsg = "Please Fill in All Fields";
        $errMsgClass = "alert-danger";
    }
}

?>