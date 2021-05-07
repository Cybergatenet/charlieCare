<?php
    session_start();

    // require('./db.php');

    if($_SESSION){
		session_destroy();
		unset($_SESSION['id']);
		unset($_SESSION['username']);
		unset($_SESSION['email']);
		unset($_SESSION['verified']);
		unset($_SESSION['msg']);
		unset($_SESSION['alert-class']);
		
		header("location: ../login_signup/login.php");
	}else{
		header("location: ../index.php");
	}

    $username = "Charlycare_Admin";
    $email = "charlycareclasic@gmail.com";
    $phone = '+23323-865-1493';
    $address = '190/B Castle Road, Accra | Ghana';
    $state = 'Accra';
    $country = 'Ghana';
    $bio_data = 'Bio data is a brief description of yourself. Go to settings, and add your Bio-data. OR contact webmaster for more details';
    $avatar = 'defaultAvatar.png'; // sanitize pics before uplaod
    $date = date('Y/m/d H:i:s');
    $userTime = $date;
    $isAdmin = true;
    $token = md5('AC252320BF');
    $pwd = 'Charly_ADMIN2020';

    $pwd = password_hash($pwd, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `charlycare_users` (`username`, `email`, `pwd`, `token`, `phone`, `address`, `state`, `country`, `bio_data`, `avatar`, `userTime`, `isAdmin`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssssssi', $username, $email, $pwd, $token, $phone, $address, $state, $country, $bio_data, $avatar, $userTime, $isAdmin);

    // if($stmt->execute()){
    //     echo "Admin data Inserted successfully";
    // }else{
    //     echo "NOT successful".'<br>'.mysqli_error($conn);
    // }

?>