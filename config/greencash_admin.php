<?php
	 require('./config.php');
    require('./db.php');

	$table = "INSERT INTO `greencash_admin` (`id`, `username`, `pwd`, `security`) VALUES (NULL, 'Admin_Ufuoma', MD5('i am the admin2020'), MD5('AC252320BF')), (NULL, 'super_admin', MD5('SuperAdmin2020'), MD5('AC252320BF'))";


	 if(mysqli_query($conn, $table) === false){
            echo "data not inserted : CONTACT ADMIN";
        }

?>

