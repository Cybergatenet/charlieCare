<?php
    session_start();
    require('../config/db.php');
     // fetching posts here
     $query_post = 'SELECT * FROM countRating';
     $return_posts = mysqli_query($conn, $query_post);
     $posts = array();
 
     if(mysqli_num_rows($return_posts) > 0){
         while($row = mysqli_fetch_assoc($return_posts)){
             $posts[] = $row;
         }
     }
     
     foreach($posts as $count_download){
         echo $count_download['rating'];
     }
?>