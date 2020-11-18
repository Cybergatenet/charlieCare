<?php
	// database connection
    require('../config/db.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';

   	$msg = "";
    $msgClass = "";
    $errors = array();

	function sanitize_email($field) {
    // $field = filter_var($field, FILTER_SANITIZE_EMAIL);
	    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
	        return $field;
	    } else {
	        return false;
	    }
	}

	if(isset($_POST['submit'])){
		$char = "qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM0123456789";
		$token = substr(str_shuffle($char), 0, 6);

        $inputmail = mysqli_real_escape_string($conn, sanitize_email($_POST['email']));
        
        $to_email = $inputmail;
        $subject = 'Password Reset';
        $message = '</html></body>';
        $message .= 'Your OTP for Password Reset is: <br>'.$token."\r\n".'You have requested to Reset Your Password. If you dont reconginse this action, kindly contact <a href="https://www.charlycareclasic.com/index.php/#contactForm">Charlycareclasic Family Office</a>'."\r\n".' Thank You!';
        $message .= '</body></html>'; 
        $headers = 'From: noreply@charlycareclasic.com';
        $headers .= "MIME-Version : 1.0" ."\r\n";
        $headers .= "Content-Type: text/html;charset: UTF-8" ."\r\n";
        //check if the email address is invalid $secure_check
		if ($to_email === false) {
            $errors['emailErr'] = "Invalid Email. Try Again";
            // $msgClass = "alert-danger";
        } else { //send email 
            $sql = 'SELECT * FROM charlycare_users WHERE email=? LIMIT 1';

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $inputmail);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $username = $user['username'];

            $userCount = $result->num_rows;
            $stmt->close();

        if($userCount > 0){
####    sending email here
            $_SESSION['token'] = $token;
            setcookie("charlycareclasic", $token, time() + (86400 * 14), '/');
        
            $mail = new PHPMailer(true);
        
            $mail->SMTPDebug = 0;
            $mail->isSMTP();                      
            $mail->Host       = 'ssl://smtp.gmail.com';
            $mail->SMTPAuth   = true;                  
            $mail->Username   = 'charlycareclasic@gmail.com';
            $mail->Password   = 'ifechukwudi2023';         
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            // $mail->Port       = 587;                        
            $mail->Port       = 465;  
        
            $mail->setFrom('noreply@charlycareclasic.com', 'CharlyCareClasic');
            $mail->addReplyTo('charlycareclasic@gmail.com', 'CharlyCareClasic');
            $mail->addAddress($inputmail, $username);
            $mail->Subject = $subject;
            $mail->IsHTML(true);
            $mail->Body = $message;
        
            if (!$mail->send()) {
                // echo 'Mailer Error: ' . $mail->ErrorInfo;
                $errors['mailErr'] = "Password Reset Failed. Try Again. OR contact the Admin";
                // $msgClass = "alert-danger";
            } else {
                $_SESSION['token'] = $token;
                $_SESSION['email'] = $inputmail;
                $_SESSION['username'] = $username;
                setcookie("Charlycareclasic_pwd_token", $token);
        
                header('location: enter_pass.php?token='.$token);
            }	   
        }else{
            $errors['db_null'] = "NO Record Found. Check the Email and try again";
            // $msgClass = "alert-danger";
        }
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
    <link rel="icon" href="../img/charlyLogo22.png">
    <!-- font-awesome cdn | locally hosted -->
    <link rel="stylesheet" type="text/css" href="../css/css/all.css">
    <!-- Scroll Reveal CDN -->
    <script src="https://unpkg.com/scrollreveal"></script>
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
    <header style="background-color: #2196f3; padding-top: 0px; box-shadow: 0px -3px 5px rgba(0, 0, 0, .9) inset;"> <!--initial-red=#e40046 || blue=#2196f3;-->
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
	<section>
        <div class="wrapper">
            <div class="user signinBx">
                <div class="imgBx"><img src="../img/globe.jpg" alt="image"></div>
                <div class="formBx">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <h2>Reset Password</h2>
                        <!-- error msg here -->
                        <?php if(count($errors) > 0): ?>
                            <div class="alert alert-danger">
                                <?php foreach($errors as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>

                        <input type="email" name="email" placeholder="Enter Your email address" value="">
                        <input type="submit" id="btn" value="Recover Password" name="submit">
                        <p class="signup">Don't have an account ? <a href="../login_signup/signup.php">Sign Up</a><br><br><br><a href="../login_signup/login.php">Sign In Instead?</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- header js -->
    <script src="../js/main.js"></script>
    <script src="../js/login.js"></script>
</body>
</html>