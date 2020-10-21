<?php
    require('./db.php');


	$table = "CREATE TABLE IF NOT EXISTS `charlycare_usersNEW` (
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
    `userTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
  ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

	 if(mysqli_query($conn, $table) === false){
            echo "CONNECTIOIN LOST: CONTACT ADMIN".'<br>'.mysqli_error($conn).'<br>'.$conn->connect_error;
        }else{
            echo "Table created successfully";
        }

?>