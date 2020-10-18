<?php
    require('./config.php');
    require('./db.php');


	$table = "CREATE TABLE IF NOT EXISTS `charlycare_posts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `phone` varchar(20) NOT NULL,
    `address` varchar(255) NOT NULL,
    `country` varchar(255) NOT NULL,
    `avatar` text NOT NULL,
    `post_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

	//  if(mysqli_query($conn, $table) === false){
    //         echo "CONNECTIOIN LOST: CONTACT ADMIN";
    //     }

?>