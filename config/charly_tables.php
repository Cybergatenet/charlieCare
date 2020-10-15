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


        schema.sql

        CREATE TABLE users(
          users_id INT NOT NULL AUTO_INCREMENT,
          user_username VARCHAR(100) NOT NULL,
          user_password VARCHAR(40) NOT NULL,
          PRIMARY KEY ( users_id )
        );
        
        CREATE TABLE artist(
          artist_id INT NOT NULL AUTO_INCREMENT,
          artist_name VARCHAR(100) NOT NULL,
          artist_genre VARCHAR(100) NOT NULL,
          artist_imageurl VARCHAR(100) NOT NULL,
          artist_bio VARCHAR(1000) NOT NULL,
          PRIMARY KEY ( artist_id )
        );
        
        CREATE TABLE reviews (
          review_id INT NOT NULL AUTO_INCREMENT,
          user_name  VARCHAR(100) NOT NULL,
          venue VARCHAR(100) NOT NULL,
          number_of_stars INT NOT NULL,
          review_details VARCHAR(10000) NOT NULL,
          artist_id VARCHAR(100) NOT NULL,
          PRIMARY KEY ( review_id )
        );

        First, you should type heroku config to get your clearDB credentials.

        Then, you can ran this command from your terminal : mysql --host=us-cdbr-east.cleardb.com --user=xxxx --password=xxxx --reconnect heroku_xxxxxx < schema.sql
?>