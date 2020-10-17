<?php
	session_start();

	require('../../../config/config.php');
    require('../../../config/db.php');

    $msg = '';
    $msgClass = '';

	// check for submit
	if(isset($_POST['submit'])){
		// echo 'submmited';
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
		$security = mysqli_real_escape_string($conn, $_POST['security']);


		// echo $username."<br>".$pwd."<br>".$security."<br>";

	if(!empty($username) && !empty($pwd) && !empty($security)){
			$hash_pwd = md5($pwd);
			$hash_security = md5($security);

		$query  = "SELECT * FROM greencash_admin WHERE username = '$username'";

		$result = mysqli_query($conn, $query);

		if(mysqli_num_rows($result) === false){
			$msg = "Nice Attempt, You are not the Admin. So fuck off!";
			$msgClass = "alert-danger";
			die($conn);
		}

		$post = mysqli_fetch_assoc($result);
		// var_dump($post);
		if($post['username'] == $username && $post['pwd'] == $hash_pwd && $post['security'] == $hash_security){
		// All passed
			$_SESSION['admin'] = $username;
			header('Location: admin_ufuoma.php');
		}else{
		// Failed
			$msg = "wrong credentials. Try Again";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GREENCASH | ADMIN LOGIN</title>
    <link rel="icon" href="../../../img/lock.png">
    <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../css/style.css">
</head>
<body>
    <div id="header-container">
        <h2 id="header"><a href="./index.php"><span id="color">ADMIN</span>DASH-BOARD</a></h2>        
        <button type="button" id="btn-sm" name="btn"><a href="#">ADMIN LOG IN</a></button>
    </div>
    <!-- starting of admin -->

    <!-- starting of admin -->
 <div id="form-wrapper2" class="container mt-3">
	<div class="container">
	<h1>Adminitrator's Login Page</h1>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<h4 class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></h4>
			<div class="form_group">
				<label>Admin Username</label>
				<input type="text" name="username" class="form-control" value="" placeholder="Enter Admin Username">
			</div>
			<div class="form_group">
				<label>Admin Password</label>
				<input type="password" name="pwd" class="form-control" value="" placeholder="Enter Admin Password">
			</div>
			<div class="form_group">
				<label>Admin Security Key</label>
				<input type="password" name="security" class="form-control" value="" placeholder="Enter Admin Security Key">
			</div>
			<input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg mt-3">
		</form>
	</div>
</div>


<script type="text/javascript">
    window.onload = () => {
        let anwser = prompt("Enter Admin PassKey", "");

        if(anwser != "123456"){
            window.location.href = "../../../index.html";
        }
    }


</script>
	