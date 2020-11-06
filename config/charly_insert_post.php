<?php
    session_start();

    require('./db.php');

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

    $user_id = "2";
    $user_username = "charly_Admin";
    $country = 'Accra, Ghana';
    $avatar = 'nature4.jpg'; // sanitize pics before uplaod
    $post_title = 'In A glance';
    $post_body = 'We believe in building the life we deserve through innovation and creativity. This is a welcome message to all our users. Thank you for signing in the our site. We promise to bring you amazing contents that will improve and educate your life. Stay tune for much more. Or visit our about us page for more information.';
    $date = date('Y/m/d H:i:s');
    $post_time = $date;

    $sql = "INSERT INTO `charlycare_posts` (`user_id`, `user_username`, `country`, `avatar`, `post_title`, `post_body`, `post_time`) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssss', $user_id, $user_username, $country, $avatar, $post_title, $post_body, $post_time);

    // if($stmt->execute()){
    //     echo "Post data Inserted successfully";
    // }else{
    //     echo "NOT successful".'<br>'.mysqli_error($conn);
    // }

?>

