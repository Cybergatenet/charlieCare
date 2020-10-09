<?php
	if($_SESSION['username']){
		header("location: ../login_signup/login.php");
	}else{
		header("location: ../index.html");
	}
?>