<?php
    session_start();

    require '../config/db.php';

    $errors = array();
    $username = '';
    $email = '';

    if(isset($_POST['signup'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $cpwd = $_POST['cpwd'];
        $avatar = 'defaultAvatar.png';
        // $userTime = 'CURRENT_TIMESTAMP';
        // define('CURRENT_TIMESTAMP', 'CURRENT_TIMESTAMP');

        // validating user input
        if(empty($username)){
            $errors['username'] = "Username Required!";
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Invalid email Address";
        }
        if(empty($email)){
            $errors['email'] = "Email Required!";
        }
        if(empty($pwd)){
            $errors['pwd'] = "Password Required!";
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
        $errors['email'] = "Email Already exist";
    }

    if(count($errors) === 0) {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $char = "qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM0123456789";
		$token = substr(str_shuffle($char), 0, 8);
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

            // set flash msg
            $_SESSION['msg'] = "Registration Success!";
            $_SESSION['alert-class'] = "alert-success";
            header('location: ./home.php');
            exit();
        }else{
            $errors['db_error'] = "Request NOT successful: failed to register";
            echo 'this error '. mysqli_error($conn);
        }
    }
}

// login controllers
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    // validating user input
    if(empty($username)){
        $errors['username'] = "Username Required!";
    }
    if(empty($pwd)){
        $errors['pwd'] = "Password Required!";
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
            $_SESSION['msg'] = "You are now logged in!";
            $_SESSION['alert-class'] = "alert-success";
            header('location: ../User_dashboard/user.html');
            exit();
        }else{
            $errors['login_failed'] = "Wrong Credentials";
        }
    }
}

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