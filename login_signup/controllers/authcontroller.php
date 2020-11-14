<?php
    session_start();
    
    require '../config/db.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require '../vendor/autoload.php';

    $errors = array();
    $username = '';
    $email = '';

    ///   Input Validation Function
    function validate_input($input){
        $input = htmlspecialchars($input);
        $input = trim($input);
        $input = stripslashes($input);
        return $input;
    }

    if(isset($_POST['signup'])){
        $username = mysqli_real_escape_string($conn, validate_input($_POST['username']));
        $email = mysqli_real_escape_string($conn, validate_input($_POST['email']));
        $pwd = mysqli_real_escape_string($conn, validate_input($_POST['pwd']));
        $cpwd = mysqli_real_escape_string($conn, validate_input($_POST['cpwd']));
        $phone = 'Mobile Number';
        $address = 'Address';
        $state = 'state';
        $country = 'country';
        $bio_data = 'Bio data is a brief description of yourself. Go to settings, and add your Bio-data';
        $avatar = 'defaultAvatar.png'; // sanitize pics before uplaod
        $date = date('Y/m/d H:i:s');
        $userTime = $date;
        // $verified;

## issue 
        // $userTime = 'CURRENT_TIMESTAMP';
        // define('CURRENT_TIMESTAMP', 'CURRENT_TIMESTAMP');

        // validating user input
        if(empty($username)){
            $errors['username'] = "Username Is Required!";
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Invalid Email Address";
        }
        if(empty($email)){
            $errors['email'] = "Email Is Required!";
        }
        if(empty($pwd)){
            $errors['pwd'] = "Password Is Required!";
        }
        if(strlen($pwd) < 8){
            $errors['pwd'] = "Password Is Too Short";
        }
        if($pwd !== $cpwd){
            $errors['pwd'] = "Your Password did NOT match";
        }

    ## connection
    $emailQuery = "SELECT * FROM charlycare_users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $stmt->close();

    if($userCount > 0) {
        $errors['email'] = "Email NOT Avaliable";
    }

    if(count($errors) === 0) {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $char = "qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM0123456789";
        $token_unhash = substr(str_shuffle($char), 0, 8);
        $token = password_hash($token_unhash, PASSWORD_DEFAULT);
        // $token = bin2hex(random_bytes(50));
        $verified = false;
        
        $sql = "INSERT INTO `charlycare_users` (`username`, `email`, `pwd`, `token`, `phone`, `address`, `state`, `country`, `bio_data`, `avatar`, `userTime`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssssssss', $username, $email, $pwd, $token, $phone, $address, $state, $country, $bio_data, $avatar, $userTime);

        if($stmt->execute()){
            // Signup the user here
            $user_id = $conn->insert_id;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = $verified;
            $_SESSION['token_unhash'] = $token_unhash;

#################### Sending Email Here Using PHPMailer
            send_email($email, $token, $username, $token_unhash);

            // set flash msg
            $_SESSION['msg'] = "Registration Success!";
            $_SESSION['alert-class'] = "alert-success";
            header('location: ./home.php');
            exit();
        }else{
            $errors['db_error'] = "Request NOT successful: failed to register";
        }
    }
}
##################################################################
// login controllers 
if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, validate_input($_POST['username']));
    $pwd = mysqli_real_escape_string($conn, validate_input($_POST['pwd']));
    // validating user input
    if(empty($username)){
        $errors['username'] = "Username Is Required!";
    }
    if(empty($pwd)){
        $errors['pwd'] = "Password Is Required!";
    }
   
    if(count($errors) === 0){
        $sql = 'SELECT * FROM charlycare_users WHERE email=? OR username=? LIMIT 1';

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if(password_verify($pwd, $user['pwd'])){
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = $user['verified'];
            ## check if they are verified
            if($user['verified']){
                // login success
                header('location: ../User_dashboard/user.php');
                exit();
            }else{
                $_SESSION['msg'] = "You Have Not Verified Your Account!";
                $_SESSION['alert-class'] = "alert-success";

                header('location: ./home.php');
            }
        }else{
            $errors['login_failed'] = "Wrong Credentials";
        }
    }
}
#################################################
//  Send email here
function send_email($input, $OTP, $username, $token_unhash){

    setcookie("token", $token_unhash, time() + (86400 * 14), '/');
    
    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();                      
    $mail->Host       = 'ssl://smtp.gmail.com';
    $mail->SMTPAuth   = true;                  
    $mail->Username   = 'abelchinedu2@gmail.com';
    $mail->Password   = 'abchej3647';            
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    // $mail->Port       = 587;                        
    $mail->Port       = 465;  

    $mail->setFrom('noreply@charlycareclasic.com', 'CharlyCareClasic');
    $mail->addReplyTo('charlycareclasic@gmail.com', 'CharlyCareClasic');
    $mail->addAddress($input, $username);
    $mail->Subject = 'Account Activation';
    $mail->IsHTML(true);
    $mail->Body = '<p>Welcome '.$username.', You have requested to register as a member @ <span style="color: blue; font-weight: bold;">CharlyCareCla$ic</span> Family Office. Your request have been received and your account will be up and running in no distant time. Click on the Link below to Activate your Account: <br> <h4><a href="https://www.charlycareclasic.com/login_signup/home.php?otp='.$OTP.'&email='.$input.'" style="background-color: blue; padding: 5px; color: white; font-weight: bold; border-radius: 4px;">Activate Account</a></h4><br><br> If you do not reconginse this activity, kindly report to the <a href="https://www.charlycareclasic.com/#contactUs">Admin</a> <br> Thank You!</p>';

    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        // echo 'The email message was sent.';
    }
}

#################################################

// logout
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['verified']);
    unset($_SESSION['msg']);
    unset($_SESSION['alert-class']);
    header('location: ../login_signup/login.php'); // back to login page
    exit();
}