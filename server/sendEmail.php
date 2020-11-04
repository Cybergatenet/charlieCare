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

if(isset($_POST['contactMsg'])){
    // Instantiation and passing `true` enables exceptions
    // $mail = new PHPMailer(true);

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
            // try {
            //     //Server settings
            //     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            //     $mail->isSMTP();                                            // Send using SMTP
            //     $mail->Host       = 'ssl://smtp.gmail.com';                    // Set the SMTP server to send through
            //     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            //     $mail->Username   = 'abelchinedu2@gmail.com';                     // SMTP username
            //     $mail->Password   = 'uwasomba';                               // SMTP password
            //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            //     // $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            //     $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
            //     //Recipients
            //     $mail->setFrom('abelchinedu2@gmail.com', 'Cybergate Testing');
            //     $mail->addAddress('charlycareclasic@gmail.com', 'Charly_Admin');     // Add a recipient
            //     $mail->addAddress('cybergatenet@yahoo.com');               // Name is optional
            //     $mail->addReplyTo($contact_email, 'Sender of this Email');
            //     $mail->addCC('abelististuwas@yahoo.com');
            //     // $mail->addBCC('bcc@example.com');
            
            //     // Attachments
            //     // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            
            //     // Content
            //     $mail->isHTML(true);                                  // Set email format to HTML
            //     $mail->Subject = $title;
            //     $mail->Body    = $body;
            //     // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
            //     $mail->send();
            //         $errMsg = "Thank you ".$contact_name . " for partnering with us."."\r\n"." Your Request is being considered and we will get back to you ASAP";
            //         $errMsgClass = "alert-success";
            //         $contact_name = $contact_email = $contact_msg = '';
            // } catch (Exception $e) {
            //     $errMsg = "Your email was not successful. Try again later.<br> Mailer Error: {$mail->ErrorInfo}";
			// 	$errMsgClass = "alert-danger";
            // }
//         }
//     }else{
//         $errMsg = "Please Fill in All Fields";
//         $errMsgClass = "alert-danger";
//     }
// }


/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

//Import PHPMailer classes into the global namespace
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;


//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'abelchinedu2@gmail.com';

//Password to use for SMTP authentication
$mail->Password = 'uwasomba';

//Set who the message is to be sent from
$mail->setFrom('charlycareclasic@gmail.com', 'Charly_Admin');

//Set an alternative reply-to address
$mail->addReplyTo('charlycareclasic@gmail.com', 'Charly_Admin');

//Set who the message is to be sent to
$mail->addAddress('cybergatenet@yahoo.com', 'my name');

//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->msgHTML($contact_msg);

//Replace the plain text body with one created manually
// $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if ($mail->send()) {
    $errMsg = "Thank you ".$contact_name . " for partnering with us."."\r\n"." Your Request is being considered and we will get back to you ASAP";
            $errMsgClass = "alert-success";
            $contact_name = $contact_email = $contact_msg = '';
} else {
        $errMsg = "Your email was not successful. Try again later.<br> Mailer Error: {$mail->ErrorInfo}";
		$errMsgClass = "alert-danger";
}

        }
    }else{
        $errMsg = "Please Fill in All Fields";
        $errMsgClass = "alert-danger";
    }
}

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}

?>