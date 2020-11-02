<?php
	if($_SESSION){
		header("location: ../login_signup/login.php");
	}else{
		header("location: ../index.php");
	}
?>