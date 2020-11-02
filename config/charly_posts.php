<?php
    require('./db.php');


	$table = "CREATE TABLE IF NOT EXISTS `charlycare_posts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` varchar(255) NOT NULL,
    `user_username` varchar(255) NOT NULL,
    `country` varchar(255) NOT NULL,
    `avatar` text NOT NULL,
    `post_title` varchar(255) NOT NULL,
    `post_body` text NOT NULL,
    `post_time` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

	//  if(mysqli_query($conn, $table) === false){
    //     echo "CONNECTIOIN LOST: CONTACT ADMIN";
    // }else{
    //     echo 'created successfully';
    // }

?>