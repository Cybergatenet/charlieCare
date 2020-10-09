<?php

    require 'constants.php';

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if(!$conn){
        echo 'Database is not connnecting now';
        header('location: ../../errors/404.php');
<<<<<<< HEAD
=======
        die($conn->connection_status);
        exit("Oop!...NOT connected");
>>>>>>> 1cc291bc4599ee9cefbb650791cb97211d820877
    }

    if($conn->connect_error) {
        die('Database error-:)= could not connect to database' . $conn->connect_error);
<<<<<<< HEAD
        // header('location: ../../errors/404.php');
=======
        header('location: ../../errors/404.php');
>>>>>>> 1cc291bc4599ee9cefbb650791cb97211d820877
    }
