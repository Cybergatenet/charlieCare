<?php
	if($_SESSION){
		header("location: ../service/index.php");
	}else{
		header("location: ../index.html");
	}
?>