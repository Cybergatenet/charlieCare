<?php
	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require '../vendor/autoload.php';

	$mail = new PHPMailer;

	$errMsg = '';
	$errMsgClass = '';
	$contact_name = $contact_email = $contact_msg = '';

	if(filter_has_var(INPUT_POST, 'contactMsg')){
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
				
				$mail = new PHPMailer;
				$mail->isSMTP(); 
				$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
				$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
				$mail->Port = 587; // TLS only
				$mail->SMTPSecure = 'tls'; // ssl is depracated
				$mail->SMTPAuth = true;
				$mail->Username = 'abelchinedu2@gmail.com';
				$mail->Password = 'uwasomba';
				$mail->setFrom('abelchinedu2@gmail.com', 'testing from user.php');
				$mail->addReplyTo($toemail, 'CharlyCare Admin');
				$mail->addAddress('abelististuwas@yahoo.com', 'reply to myself');
				$mail->Subject = $title;
				$mail->msgHTML($body); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
				// $mail->AltBody = 'HTML messaging not supported';
				// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

				if($mail->send()){
				    $errMsg = "Thank you ".$contact_name . " for partnering with us."."\r\n"." Your Request is being considered and we will get back to you ASAP";
                    $errMsgClass = "alert-success";
                    $contact_name = $contact_email = $contact_msg = '';
				}else{
				    $errMsg = "Your email was not successful. Try again later.<br> Mailer Error: {$mail->ErrorInfo}";
					$errMsgClass = "alert-danger";;
				}
			}

		} else{
			$errMsg = "Please fill all fields";
			$errMsgClass = "alert-danger";
		}

	}

?>