<?php
    require('./db.php');

	$testData = "INSERT INTO `users` (`id`, `username`, `pwd`, `security`) VALUES (NULL, 'charly_admin', MD5('i am the admin2020'), MD5('AC252320BF')), (NULL, 'super_admin', MD5('SuperAdmin2020'), MD5('AC252320BF'))";


	 if(mysqli_query($conn, $testData) === false){
            echo "data not inserted : CONTACT ADMIN";
        }

?>

