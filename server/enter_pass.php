<?php
	session_start();

	// database connection
   require('../config/config.php');
   require('../config/db.php');
	
 	$token = $_SESSION['token'];
	$email = $_SESSION['email'];

	setcookie("new_token", $token, time() + 3600);

	$msg = "";
	$msgClass = "";

	function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
	    if (filter_var($field, FILTER_VALIDATE_EMAIL)){
	        return true;
	        echo $field;
	    } else {
	        return false;
	        echo $field;
	    }
	}
	sanitize_my_email($email);

	if(isset($_POST['submit'])){

		$var_token = mysqli_real_escape_string($conn, $_POST['token']);
		$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
		$cpwd = mysqli_real_escape_string($conn, $_POST['cpwd']);
		$get_token = mysqli_real_escape_string($conn, $_GET['token']);

		if($pwd === $cpwd){
			if($get_token === $var_token && $token === $var_token){
		// token matched...update table
			$set_pwd = "UPDATE  `greencash`.`greencash_table` SET  `pwd` =  '$pwd' WHERE  `greencash_table`.`email` = '$email'";
				if(mysqli_query($conn, $set_pwd)){
					$_SESSION['token'] = $token;
				    $_SESSION['email'] = $email;
				    setcookie("new_token", $token);

				    header("location: ../login.php");
				}else{
					$msg = "Password update Failed!...try again";
					$msgClass = "alert-danger";
					exit();
				}
			}else{
				$msg = "Wrong Token Enter. Check Your Email and try again";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GREEN CASH | Reset Password</title>
    <link rel="icon" href="./img/lock.png">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div id="header-container">
		<h2 id="header"><a href="../index.html"><span id="color">GREEN</span>CASH</a></h2>        
		<button type="button" id="btn" name="btn">Password Reset</button>
    </div>
	<div id="form-wrapper1" style="margin-top: 10px;">
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<caption><h2>SET NEW PASSWORD</h2></caption>
            <h4 class="alert <?php echo $msgClass; ?>" id=""><?php echo $msg; ?></h4>
            <div>
            	<label>Enter New Password</label>
            	<input type="password" name="pwd" title="password should 6 to 8 characters long" required>
            </div>
            <div>
            	<label>Confirm New Password</label>
            	<input type="password" name="cpwd" title="password should 6 to 8 characters long" required>
            </div>
            <hr>
            <div>
            	<label>Enter OTP Here</label>
            	<input type="text" name="token" required>
            </div>
            <br>
            <input type="submit" name="submit" class="btn" value="Reset Password">
		</form>
	</div>

<?php include("../inc/footer.php"); ?>
