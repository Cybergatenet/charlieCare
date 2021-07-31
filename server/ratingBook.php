<?php
    session_start();
    require('../config/db.php');

    $rating = $_POST['name'];
    // Calculating Rate
    if($rating > 5){
        $rating = 5;
    }
    if($rating < 0.1){
        $rating = 1;
    }
    $rating = intval($rating);

    // fetching posts here
    $query_post = 'SELECT * FROM countRating';
    $return_posts = mysqli_query($conn, $query_post);
    $posts = array();
    $rating_db;

    if(mysqli_num_rows($return_posts) > 0){
        while($row = mysqli_fetch_assoc($return_posts)){
            $posts[] = $row;
        }
    }
    
    foreach($posts as $count_download){
        $rate_count = $count_download['rate_count'];
        // $rating_db = $count_download['rating'];
        echo $rate_count;
    }
    // $new_rating = $rating + $rating_db / $rate_count + 1;
    // echo $new_rating;

    // Updating the  countRating-DB
    $query_count = "UPDATE  `countRating` SET  `rate_count` =  '$rating'";
    mysqli_query($conn, $query_count);
    // if(mysqli_query($conn, $query_count)){
    //     echo "updated";
    // }else{
    //     echo "NOT updated";
    // }

?>