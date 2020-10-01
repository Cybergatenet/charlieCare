<?php
	session_start();

	// database connection
   require('../config/config.php');
   require('../config/db.php');

   	$msg = "";
   	$msgClass = "";

	function sanitize_my_email($field) {
    // $field = filter_var($field, FILTER_SANITIZE_EMAIL);
	    if (filter_var($field, FILTER_VALIDATE_EMAIL)){
	        return true;
	    } else {
	        return false;
	    }
	}

	if(isset($_POST['submit'])){

		$char = "qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM0123456789";
		$token = substr(str_shuffle($char), 0, 6);

		$inputmail = mysqli_real_escape_string($conn, $_POST['email']);

		$email = $inputmail;
		$get_email = "SELECT * FROM greencash_table WHERE email = '$email'";
		$query = mysqli_query($conn, $get_email);
		$result = mysqli_num_rows($query);
		if($result === 0){

			$to_email = $email;
			$subject = 'Password Reset';
			$message = '</html></body>';
			$message .= 'Your OTP for Password Reset is: <br>'.$token."\r\n".'You have requested to Reset Your Password. If you dont reconginse this action, kindly report to the <a href="http://www.charlycarecla.herokuapp.com">Admin</a>'."\r\n".' Thank You!';
			$message .= '</body></html>'; 
			$headers = 'From: admin@charlycarecla.herokuapp.com';
			$headers .= "MIME-Version : 1.0" ."\r\n";
			$headers .= "Content-Type: text/html;charset: UTF-8" ."\r\n";
			//check if the email address is invalid $secure_check
			if ($to_email === false) {
			    $msg = "Invalid Email. Try Again";
			    $msgClass = "alert-danger";
			} else { //send email 
			   if(mail($to_email, $subject, $message, $headers)){
				   	$_SESSION['token'] = $token;
				    $_SESSION['email'] = $email;
				    setcookie("greencash_new_token", $token);

				    header('location: enter_pass.php?token='.$token);
				}else{
			    	$msg = "Password Reset Failed. Try Again. OR contact the Admin";
			    	$msgClass = "alert-danger";
				}
			}
	}else{
		$msg = "NO Record Found. Check the Email and try again";
		$msgClass = "alert-danger";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CharlyCareCla$ic is a single family office that thrives on the ideology of inventing the life we 
    deserve through innovation and creativity.">
    <meta name="keywords" content="CharlyCareCla$ic, Forex, Online Trading, Investment, Foreign exchange">
    <meta name="author" content="Designed by cybergate communication network">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset | CharlyCareCla$ic</title>
    <!-- font-awesome cdn | locally hosted -->
    <link rel="icon" href="../img/charlyLogo22.png">
    <!-- fontAwesome here -->
    <link rel="stylesheet" type="text/css" href="../css/css/all.css">
    <!-- Scroll Reveal CDN -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- NEW Styles Added here -->
    <link rel="stylesheet" type="text/css" href="../css/new_styles.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
<header>
        <div class="container">
            <nav class="nav">
                <div class="menu-toggle">
                    <div class="new_menu">
                        <div class="lin"></div>
                        <div class="lin"></div>
                        <div class="lin"></div>
                    </div>
                    <a href="#"><i class="fas fa-times"></i></a>
                </div>
                <div class="main-header-title">
                    <a href="../index.html" class="logo"><img src="../img/charlyLogo22.png" alt="" width="70px"
                            height="50px"></a>
                    <div class="main-title">
                        <h2 class="header-title">CharlyCareCla$ic</h2>
                        <small class="header-small">Family Office</small>
                    </div>
                </div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="../index.html" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="../about.html" onclick="alert('Oop!..offline for maintenance!');" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="../login_signup/index.html" onclick="alert('sorry, this app is under maintenance');" class="nav-link">Log In</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- header ends here -->
    <!-- <div id="header-container">
		<h2 id="header"><a href="../index.html"><span id="color">GREEN</span>CASH</a></h2>        
		<button type="button" id="btn" name="btn">Password Reset</button>
    </div>
	<div id="form-wrapper1" style="margin-top: 10px;">
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<a href="../login.php" class="btn btn-default">BACK</a>
			<caption><h2>Reset Password</h2></caption>
            <h4 class="alert <?php echo $msgClass; ?>" id=""><?php echo $msg; ?></h4>
            <div>
            	<label>Enter Your Email Address</label>
            	<input type="email" name="email" placeholder="Enter Your Email Address To Reset Password" required>
            </div>
            <br>
            <input type="submit" name="submit" class="btn" value="Continue">
		</form>
	</div> -->


<script type="text/javascript">

	// window.onload = () => {
	// 	let comfirm = prompt("Do You Wish To Proceed With Password Reset?", "YES...?");
	// 	if(confirm === false){
	// 		window.location.href = "../login.php";

	// 	}
	// }
	
</script>

<?php include("../inc/footer.php"); ?>

