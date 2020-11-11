<?php
	// database connection
    require('../config/db.php');
    require('../config/gmail.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';

    if(!$_SESSION['token']){
####### comment out here--------GOOD TO GO
        header('location: ../login_signup/login.php');
    }
	
 	$token = $_SESSION['token'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];

	setcookie("new_token", $token, time() + 3600);

	$msg = "";
	$msgClass = "";

	if(isset($_POST['submit'])){

		$var_token = mysqli_real_escape_string($conn, $_POST['token']);
		$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
		$cpwd = mysqli_real_escape_string($conn, $_POST['cpwd']);
        $get_token = mysqli_real_escape_string($conn, $_GET['token']);
        
        if(empty($var_token)){
            $msg = "Token is Required";
			$msgClass = "alert-danger";
        }
        if(empty($pwd)){
            $msg = "Password is Required";
			$msgClass = "alert-danger";
        }
        if(empty($cpwd)){
            $msg = "Confirm Password is Required";
			$msgClass = "alert-danger";
        }
        if(strlen($pwd) < 8){
            $msg = "Password is too short";
			$msgClass = "alert-danger";
        }

		if($pwd === $cpwd){
			if($get_token === $var_token && $token === $var_token){
		// token matched...update table
			$set_pwd = "UPDATE  `charlycare_users` SET  `pwd` =  '$pwd' WHERE  `email` = '$email'";
				if(mysqli_query($conn, $set_pwd)){
        ##### sending a confirmation Email here
					$mail = new PHPMailer(true);
        
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->isSMTP();                      
                    $mail->Host       = 'ssl://smtp.gmail.com';
                    $mail->SMTPAuth   = true;                  
                    $mail->Username   = GMAIL_EMAIL;
                    $mail->Password   = GMAIL_PASS;       
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    // $mail->Port       = 587;                        
                    $mail->Port       = 465;  
                
                    $mail->setFrom('noreply@charlycareclasic.com', 'CharlyCareClasic');
                    $mail->addReplyTo('charlycareclasic@gmail.com', 'CharlyCareClasic');
                    $mail->addAddress($email, $username);
                    $mail->Subject = 'Password Changed';
                    $mail->IsHTML(true);
                    $mail->Body = 'Hi '.$username.', Your Password Reset was successful. If you do not reconginse this action, kindly contact <a href="https://www.charlycareclasic.com/index.php/#contactForm">Charlycareclasic Family Office</a>'."\r\n".' Thank You!';
                
                    if (!$mail->send()) {
                        // echo 'Mailer Error: ' . $mail->ErrorInfo;
                        $msg = "Password Reset Failed. Try Again. OR contact the Admin";
					    $msgClass = "alert-danger";
                    } else {
                        header("location: ./login.php");
                    }

				}else{
					$msg = "Password update Failed!...try again";
					$msgClass = "alert-danger";
					exit();
				}
			}else{
				$msg = "Wrong Token Enter. Check Your Email or Try again";
				$msgClass = "alert-danger";
			}
		}else{
			$msg = "Password Match Failed! Enter Password Again";
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
    <!-- bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <!-- NEW Styles Added here -->
    <link rel="stylesheet" type="text/css" href="../css/new_styles.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <style>
        #btn{
            max-width: 250px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<header style="background-color: #2196f3; padding-top: 0px; box-shadow: 0px -3px 5px rgba(0, 0, 0, .9) inset;">
    <div class="wrapper">
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
                <a href="../index.php" class="logo"><img src="../img/charlyLogo22.png" alt="" width="70px"
                        height="50px"></a>
                <div class="main-title">
                    <h2 class="header-title">CharlyCareCla$ic</h2>
                    <small class="header-small">Family Office</small>
                </div>
            </div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="../index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="../about.html" class="nav-link">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="../login_signup/signup.php" class="nav-link active">Sign Up</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
    <!-- header ends here -->
    <br><br><br><br><br>
            <br><br>
	<section>
        <div class="wrapper">
            <div class="user signinBx">
                <div class="imgBx"><img src="../img/globe.jpg" alt=""></div>
                <div class="formBx">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <h2>Enter New Password</h2>
                        <!-- error msg here -->
                        <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
                        <input type="text" name="token" placeholder="Enter OTP Here" value="">
                        <input type="password" name="pwd" placeholder="Enter New Password" value="">
                        <input type="password" name="cpwd" placeholder="Confirm New password" value="">
                        <input type="submit" id="btn" value="Change Password" name="submit">
                        <p class="signup">Don't have an account ? <a href="../login_signup/signup.php">Sign Up</a><br><br><br><a href="../login_signup/login.php">Log In Instead?</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>

	<?php ### include("../inc/footer.php"); ?>

<script type="text/javascript">

	// window.onload = () => {
	// 	let comfirm = prompt("Do You Wish To Proceed With Password Reset?", "YES...?");
	// 	if(confirm === false){
	// 		window.location.href = "../login.php";

	// 	}
	// }
	
</script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- header js -->
    <!-- <script src="../js/main.js"></script> -->
    <script src="../js/login.js"></script>
</body>
</html>