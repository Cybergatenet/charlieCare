<?php
	session_start();

    require('../config/db.php');

    $msg = '';
	$msgClass = '';
	
	function validate_input($input){
        $input = htmlspecialchars($input);
        $input = trim($input);
        $input = stripslashes($input);
        return $input;
    }

	// check for submit
	if(isset($_POST['submit'])){
		// echo 'submmited';
		$email = mysqli_real_escape_string($conn, $_POST['email']);
        $pwd = mysqli_real_escape_string($conn, validate_input($_POST['pwd']));
        $security = mysqli_real_escape_string($conn, validate_input($_POST['security']));


		// echo $username."<br>".$pwd."<br>".$security."<br>";

	if(!empty($email) && !empty($pwd) && !empty($security)){

		$query  = "SELECT * FROM charlycare_users WHERE `email` = '$email'";

		$result = mysqli_query($conn, $query);

		if(mysqli_num_rows($result) === false){
			$msg = "Nice Attempt, You are not the Admin. So fuck off!";
			$msgClass = "alert-danger";
			die($conn);
		}

		$admin = mysqli_fetch_assoc($result);
		// var_dump($post);
		if($admin['email'] == $email && $security === 'AC252320BF'){
			
			if(password_verify($pwd, $admin['pwd'])){
				// successful
				header('location: ./admin.php');
			}else{
				// Failed
				$msg = "Wrong credentials";
				$msgClass = "alert-danger";
				// header('location: ../login_signup/login.php');
			}
		}else{
		// Failed
			$msg = "Wrong credentials. Try Again";
			$msgClass = "alert-danger";
		}

		mysqli_free_result($result);

		mysqli_close($conn);
	}else{
	// empty fields
		$msg = "Please Fill in All Empty Fields";
		$msgClass = "alert-danger";
	}
}

?>