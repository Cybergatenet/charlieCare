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
		$token = md5($security);
		// echo $email."<br>".$pwd."<br>".$security."<br>";

		if(!empty($email) && !empty($pwd) && !empty($security)){

			$query  = "SELECT * FROM charlycare_users WHERE `email` = '$email'";

			$result = mysqli_query($conn, $query);

			if(mysqli_num_rows($result) === false){
				$msg = "Nice Attempt, You are not the Admin. So fuck off!";
				$msgClass = "alert-danger";
				die($conn);
			}

			$admin = mysqli_fetch_assoc($result);
			// var_dump($admin);
			if($admin['email'] == $email && $admin['token'] === $token && password_verify($pwd, $admin['pwd'])){
			### verify password
				$_SESSION['admin'] = 'Charly_Admin';
				$_SESSION['username'] = $admin['username'];
				$_SESSION['email'] = $email;
				// echo "login success";
				header('location: ./admin.php');
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

// logout
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['admin']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    header('location: ./index.php'); // back to login page
    exit();
  }

?>