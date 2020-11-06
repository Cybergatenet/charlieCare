<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require './vendor/autoload.php';

    $errMsg = '';
    $errMsgClass = '';
    $contact_name = $contact_email = $contact_msg = '';

if(isset($_POST['contactMsg'])){
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

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
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'ssl://smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'abelchinedu2@gmail.com';                     // SMTP username
                $mail->Password   = 'uwasomba';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                // $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
                //Recipients
                $mail->setFrom('abelchinedu2@gmail.com', 'Cybergate Testing');
                $mail->addAddress('charlycareclasic@gmail.com', 'Charly_Admin');     // Add a recipient
                $mail->addAddress('cybergatenet@yahoo.com');               // Name is optional
                $mail->addReplyTo($contact_email, 'Sender of this Email');
                $mail->addCC('abelististuwas@yahoo.com');
                // $mail->addBCC('bcc@example.com');
            
                // Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $title;
                $mail->Body    = $body;
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
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