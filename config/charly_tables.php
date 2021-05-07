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

	$table = "CREATE TABLE IF NOT EXISTS `charlycare_users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `pwd` varchar(255) NOT NULL,
    `verified` BOOLEAN NOT NULL DEFAULT FALSE,
    `token` varchar(255) NOT NULL,
    `phone` varchar(20) NOT NULL,
    `address` varchar(255) NOT NULL,
    `state` varchar(255) NOT NULL,
    `country` varchar(255) NOT NULL,
    `bio_data` text NOT NULL,
    `avatar` text NOT NULL,
    `userTime` varchar(255) NOT NULL,
    `isAdmin` BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
  ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

	//  if(mysqli_query($conn, $table) === false){
  //           echo "CONNECTIOIN LOST: CONTACT ADMIN".'<br>'.mysqli_error($conn).'<br>'.$conn->connect_error;
  //       }else{
  //           echo "Table created successfully";
  //       }

?>