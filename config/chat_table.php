<?php
	require('./config.php');
    require('./db.php');

	$table = "CREATE TABLE IF NOT EXISTS `greencash_table` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `username` varchar(15) NOT NULL,
	  `surname` varchar(15) NOT NULL,
	  `firstname` varchar(15) NOT NULL,
	  `lastname` varchar(15) NOT NULL,
	  `gender` varchar(7) NOT NULL,
	  `email` varchar(40) NOT NULL,
	  `pwd` varchar(255) NOT NULL,
	  `address` varchar(40) NOT NULL,
	  `nationality` varchar(15) NOT NULL,
	  `state` varchar(15) NOT NULL,
	  `lga` varchar(40) NOT NULL,
	  `phone` varchar(20) NOT NULL,
	  `code` varchar(15) NOT NULL,
	  `amount` varchar(15) NOT NULL,
	  `member` varchar(20) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

	 if(mysqli_query($conn, $table) === false){
            echo "CONNECTIOIN LOST: CONTACT ADMIN";
        }

?>