<?php
    require('./config.php');
    require('./db.php');


	$table = "CREATE TABLE IF NOT EXISTS `charlycare_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(40) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `bio_data` varchar(255) NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

	 if(mysqli_query($conn, $table) === false){
            echo "CONNECTIOIN LOST: CONTACT ADMIN";
        }

?>