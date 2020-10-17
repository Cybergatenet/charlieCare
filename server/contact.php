<?php
	$errMsg = '';
	$errMsgClass = '';

	if(filter_has_var(INPUT_POST, 'contactMsg')){
		$name = htmlspecialchars($_POST['contact_name']);
		$email = htmlspecialchars($_POST['contact_email']);
		$message = htmlspecialchars($_POST['contact_msg']);

		if(!empty($name) && !empty($email) && !empty($message)){
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				$errMsg = "Please use a vaild email";
				$errMsgClass = "alert-danger";
			}else{
				$toemail = "charlycareclasic@gmail.com";
				$title = "Charlycareclasic Contact from ".$name;
				$body = '<html><body>';
				$body .= '<h2>Message For Charlycare Family Office</h2>
					<h4>Name</h4><p>'.$name.'</p>
					<h4>Email</h4><p>'.$email.'</p>
					<h4>Message</h4><p>'.$message.'</p>';
				$body .= '</body></html>';

				$header = "MIME-Version : 1.0" ."\r\n";
				$header .= "Content-Type: text/html;charset: UTF-8" ."\r\n";
				$header .= "From: ".$name. "<".$email.">". "\r\n";

				if(mail($toemail, $title, $body, $header)){
						$errMsg = "Thank you ".$name . " for partnering with us."."\r\n"." Your Request is being considered and we will get back to you ASAP";
						$errMsgClass = "alert-success";
						$name = $email = $subject = $message = '';
				}else{
						$errMsg = "Your email was not successful. Try again later";
						$errMsgClass = "alert-danger";

				}
			}

		} else{
			$errMsg = "Please fill all fields";
			$errMsgClass = "alert-danger";
		}

	}
	
?>