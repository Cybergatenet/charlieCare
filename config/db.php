<?php

    require 'constants.php';

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // if(!$conn){
        // echo 'Database is not connnecting now. Try again in 24hours';
        // header('location: ../../errors/404.php');
        // die($conn->connection_status);
        // exit("Oop!...NOT connected");
    // }

    if($conn->connect_error) {
        die('Database error-:)= setting up dataBase in 24hours' . $conn->connect_error);
        header('location: ../../errors/404.php');
    }
