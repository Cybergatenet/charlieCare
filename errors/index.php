<?php
	if($_SESSION){
		header("location: ../login_signup/index.php");
	}else{
		header("location: ../index.html");
	}
?>