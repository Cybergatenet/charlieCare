<?php

    // require 'constants.php';

    // $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if($conn->connect_error) {
        // die('Database error-:)' . $conn->connect_error);
        // header('location: ../../errors/404.php');
    }