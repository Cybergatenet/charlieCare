<?php
    session_start();
    require('../config/db.php');

    $data = $_POST['name'];
    // var_dump($data);
    // Updating the  countRating-DB
    $query_count = "UPDATE  `countRating` SET  `download` =  '$data'";
    mysqli_query($conn, $query_count);
    // if(mysqli_query($conn, $query_count)){
    //     echo "updated";
    // }else{
    //     echo "NOT updated";
    // }

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
        echo $count_download['download'];
    }

?>