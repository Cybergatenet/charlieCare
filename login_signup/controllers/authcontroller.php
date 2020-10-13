<?php
    session_start();

    require '../config/db.php';

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
        $avatar = 'defaultAvatar.png'; // sanitize pics before uplaod

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
        if($pwd !== $cpwd){
            $errors['pwd'] = "Your Password did NOT match";
        }
## removed closed curly brace}

    ## connection
    $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
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
        $token_hash = substr(str_shuffle($char), 0, 8);
        $token = password_hash($token_hash, PASSWORD_DEFAULT);
        // $token = bin2hex(random_bytes(50));
        $verified = false;
        // $verified = '0';
#####################################
        // $new_sql = "INSERT INTO `users` (`id`, `username`, `email`, `pwd`, `verified`, `token`, `avatar`, `userTime`) VALUES (NULL, 'cybergate test', 'cybergatetest@gmail.com', MD5('qwerty'), '0', 'nsklnder', 'pic.png', CURRENT_TIMESTAMP)";

        // if(mysqli_query($conn, $new_sql) === false){
        //     echo "data not inserted : CONTACT ADMIN";
        // }
#####################################
        $sql = "INSERT INTO users (username, email, pwd, verified, token, avatar) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssbss', $username, $email, $pwd, $verified, $token, $avatar);

        if($stmt->execute()){
            // login the user here
            $user_id = $conn->insert_id;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = $verified;
            $_SESSION['avatar'] = $avatar;
            $_SESSION['userTime'] = $userTime;

    ###### Sending Email Here
            send_email($email, $token);

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
   
    if(count($errors === 0)){
        $sql = 'SELECT * FROM users WHERE email=? OR username=? LIMIT 1';

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if(password_verify($pwd, $user['pwd'])){

            // login success
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = $user['verified'];

            // set flash msg
            // $_SESSION['msg'] = "You are now logged In!";
            // $_SESSION['alert-class'] = "alert-success";
            header('location: ../User_dashboard/user.html');
            exit();
        }else{
            $errors['login_failed'] = "Wrong Credentials";
        }
    }
}
#################################################
//  Send email here
function send_email($input, $OTP){
    $username = mysqli_real_escape_string(validate_input($_POST['username']));
// Generation of ramdom token
    // $char = "qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM0123456789";
    // $token = substr(str_shuffle($char), 0, 6);
//  creating the session varialbes
    $_SESSION['token'] = $OTP;
# creating cookies
    setcookie("charlycareclasic", $OTP, time() + (86400 * 14), '/');

    $to_email = $input;
    $subject = 'Account Activation';
    $message = '<html><body>';
    $message .= '<p>Welcome '.$username.', You have requested to register as a member @ <span style="color: blue; font-weight: bold;">CharlyCareCla$ic</span> Family Office. Your request have been received and your account will be up and running in no distant time. Click on the Link below to Activate your Account: <br> <h2><a href="http://charlycarecla.herokuapp.com/login_signup/home.php?otp='.$token.'&email='.$input.'" style="background-color: blue; color: white; font-weight: bold; border-radius: 4px;">Activate Account</a></h2><br><br> If you do not reconginse this activity, kindly report to the <a href="http://www.charlycareclasic.com">Admin</a> <br> Thank You!</p>';
    $message .= '</body></html>';

    $headers = "From: noreply@charlycareclasic.com"."\r\n";
    $headers .= "MIME-Version : 1.0" ."\r\n";
    $headers .= "Content-Type: text/html; Charset: UTF-8" ."\r\n";

    mail($to_email, $subject, $message, $headers);

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
    header('location: ../index.html'); // back to index page
    exit();
}