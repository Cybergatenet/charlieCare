<?php
    // session_start();

    require('./db.php');

    // if($_SESSION){
	// 	session_destroy();
	// 	unset($_SESSION['id']);
	// 	unset($_SESSION['username']);
	// 	unset($_SESSION['email']);
	// 	unset($_SESSION['verified']);
	// 	unset($_SESSION['msg']);
	// 	unset($_SESSION['alert-class']);
		
	// 	header("location: ../login_signup/login.php");
	// }else{
	// 	header("location: ../index.php");
	// }

	$table = "CREATE TABLE IF NOT EXISTS `charlycare_chat` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` varchar(255) NOT NULL,
    `msg` varchar(255) NOT NULL,
    `timestamp` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

	//  if(mysqli_query($conn, $table) === false){
  //       echo "CONNECTIOIN LOST: CONTACT ADMIN";
  //   }else{
  //       echo 'created successfully';
  //   }

?>