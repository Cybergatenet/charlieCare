<?php
    require('./db.php');

	$insert_Admin = "INSERT INTO `charlycare_users` (`id`, `username`, `pwd`, `security`) VALUES (NULL, 'Charly_Admin', MD5('i am the admin2020'), MD5('AC252320BF'))";


	//  if(mysqli_query($conn, $testData) === false){
            // echo "data not inserted : CONTACT ADMIN";
        // }

?>

