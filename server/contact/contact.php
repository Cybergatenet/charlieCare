<?php

	$errMsg = '';
	$errMsgClass = '';

	if(filter_has_var(INPUT_POST, 'submit')){
		$name = htmlspecialchars($_POST['username']);
		$email = htmlspecialchars($_POST['email']);
		$subject = htmlspecialchars($_POST['subject']);
		$message = htmlspecialchars($_POST['message']);

		if(!empty($name) && !empty($email) && !empty($subject) && !empty($message)){

			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				$errMsg = "Please use a vaild email";
				$errMsgClass = "alert-danger";
			}else{
				$toemail = "admin@greencash2020.com,siron2020@gmail.com";
				$title = "Greencash Contact from ".$name;
				$body = '<html><body>';
				$body .= '<h2>Request: '.$subject.'</h2>
					<h4>Name</h4><p>'.$name.'</p>
					<h4>Email</h4><p>'.$email.'</p>
					<h4>Message</h4><p>'.$message.'</p>';
				$body .= '</body></html>';

				$header = "MIME-Version : 1.0" ."\r\n";
				$header .= "Content-Type: text/html;charset: UTF-8" ."\r\n";
				$header .= "From: ".$name. "<".$email.">". "\r\n";

				if(mail($toemail, $title, $body, $header)){
						$errMsg = "Thank you ".$name . " for partnering with us."."\r\n"." Your Request is being considered";
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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>GREENCASH | Contact Us</title>
    <link rel="icon" href="./img/lock.png">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<div id="header-container">
		<h2 id="header"><a href="index.html"><span id="color">GREEN</span>CASH</a></h2>        
		<button type="button" id="btn-sm" name="btn" style=""><a href="../login.php">LOG IN</a></button>
	</div>
	<div class="wrapper mt-4">
		<nav class="main-nav">
			<ul>
				<li><a href="../index.html">Home</a></li>
				<li><a href="../about.html">About</a></li>
				<li><a href="../services.php">Service</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
		</nav>
	<div id="form-wrapper1">
		<header class="bg-dark">
			<div class="container p-3">
				<h4 class="text-center text-white">Contact Us Form</h4>
			</div>
		</header>
		<div class="container">
			<h4 class="text-center display-5 mt-3">Help Us Serve You Better, Send Us An Email Today.</h4>
			<div class="alert <?php echo $errMsgClass; ?> mt-3">
				<?php echo $errMsg; ?>
			</div>
			<form method="POST" class="form-group" action="<?php echo $_SERVER['PHP_SELF'] ?>">
				<div>
					<label>Username</label>
					<input type="text" name="username" value="<?php echo isset($_POST['username']) ? "$name" : "" ?>"  class="form-control" placeholder="Enter your Greencash Username here" required>
				</div>
				<div>
					<label>Email</label>
					<input type="text" name="email" value="<?php echo isset($_POST['email']) ? "$email" : "" ?>"  class="form-control" placeholder="Enter your email address here" required>
				</div>
				<div>
					<label>Subject</label>
					<input type="text" name="subject" value="<?php echo isset($_POST['subject']) ? "$subject" : "" ?>"  class="form-control" placeholder="Enter the title of your Message here" required>
				</div>
				<div>
					<label>Message</label>
					<textarea class="form-control" name="message" placeholder="Write a message to the Admin here..." required><?php echo isset($_POST['message']) ? "$message" : ''; ?></textarea>
				</div>
				<br>
				<div>
					<input type="submit" name="submit" value="send" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>

	<!-- adding footer here -->
<footer>
    <div><p>Copyright &copy; 2020. GREENCASH@www.greencash2020.com</p></div>
	<div>
		<nav>
			<a class="btn btn-default" href="../index.html">Home</a>
			<a class="btn btn-default" href="../about.html">About</a>
			<a class="btn btn-default" href="../services.php">Service</a>
			<a class="btn btn-default" href="#">Contact</a>
		</nav>
	</div>
	 <div>
        <p>
            <a href="../terms_and_conditions.html" style="color: white;text-decoration: none;">Terms of Use   </a><span>   |    </span>
            <a href="../policy.html" style="color: white;text-decoration: none;">   Private Policy</a>
        </p>
    </div>
</footer>
</body>
</html>