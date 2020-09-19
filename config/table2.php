<?php
    require('./config.php');
    require('./db.php');


	$table = "CREATE TABLE IF NOT EXISTS `greencash_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `acc_name` varchar(40) NOT NULL,
  `acc_number` varchar(20) NOT NULL,
  `acc_bank` varchar(20) NOT NULL,
  `amount` varchar(15) NOT NULL,
  `merge` varchar(255) NOT NULL,
  `merge_at` datetime NOT NULL,
  `security` varchar(40) NOT NULL,
  `answer` varchar(40) NOT NULL,
  `pay_acc_name` varchar(40) NOT NULL,
  `pay_acc_number` varchar(20) NOT NULL,
  `pay_bank_name` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `ref_number` varchar(40) NOT NULL,
  `ref_by` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

	 if(mysqli_query($conn, $table) === false){
            echo "CONNECTIOIN LOST: CONTACT ADMIN";
        }

?>