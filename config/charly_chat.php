<?php
    session_start();

    // require('./db.php');

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

	$table = "CREATE TABLE IF NOT EXISTS `charlycare_chat` (
    `msg_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `msg` varchar(255) NOT NULL,
    `timestamp` int(11) NOT NULL,
    PRIMARY KEY (`msg_id`)
  ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

	//  if(mysqli_query($conn, $table) === false){
  //       echo "CONNECTIOIN LOST: CONTACT ADMIN".mysqli_error($conn);
  //   }else{
  //       echo 'created successfully';
  //   }

?>