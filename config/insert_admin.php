<?php
	require('./config.php');
    require('./db.php');

	$table = "INSERT INTO `greencash_table` (`username`, `surname`, `firstname`, `lastname`, `gender`, `email`, `pwd`, `address`, `nationality`, `state`, `lga`, `phone`, `code`, `amount`, `member`) VALUES ('troubleshoot', 'mercy', 'cooler', 'Chinedu', 'male', 'mercygate@yahoo.com', 'zxcvbnm', '54 sululere', 'Nigeria', 'Uyo', 'Ibam', '09078678767', 'asdqwe', '5000', 'VIP')";


	 if(mysqli_query($conn, $table) === false){
            echo "data not inserted : CONTACT ADMIN";
        }

?>