<?php
    require('./db.php');

	$table = "DROP TABLE `charlycare_posts#########################`";

	// if(mysqli_query($conn, $table) === false){
    //     echo "CONNECTIOIN LOST: CONTACT ADMIN".'<br>'.mysqli_error($conn).'<br>'.$conn->connect_error;
    // }else{
    //     echo "Table Deleted successfully";
    // }
    header('location: errors/404.php');

?>