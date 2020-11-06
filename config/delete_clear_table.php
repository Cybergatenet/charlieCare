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

	$table = "DROP TABLE `charlycare_users`";

	//  if(mysqli_query($conn, $table) === false){
    //         echo "CONNECTIOIN LOST: CONTACT ADMIN".'<br>'.mysqli_error($conn).'<br>'.$conn->connect_error;
    //     }else{
    //         echo "Table Deleted successfully";
    //     }

?>