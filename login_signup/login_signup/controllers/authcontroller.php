<?php
    require 'config/db.php';

    $errors = array();
    $username = '';
    $email = '';

    if(isset($_POST['signup'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $cpwd = $_POST['cpwd'];

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
            $errors = "Your Password did NOT match";
        }
    }

    ## connection
    $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $userCount = $result->num_rows;

    if($userCount > 0) {
        $errors['email'] = "Email Already exist";
    }

    if(count($errors) === 0) {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(50));
    }