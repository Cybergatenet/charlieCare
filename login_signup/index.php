<?php
	if($_SESSION['username']){
		header("location: ./login.php");
	}else{
		header("location: ../index.html");
	}
?>