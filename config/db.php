<?php

    require 'constants.php';

    $conn = new mysqli($server, $username, $password, $db);
    // $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // if(!$conn){
        // echo 'Database is not connnecting now. Try again in 24hours';
        // header('location: ../../errors/404.php');
        // die($conn->connection_status);
        // exit("Oop!...NOT connected");
    // }

    if($conn->connect_error) {
        die('Database error-:)= setting up dataBase in 24hours'.'<br>'. $conn->connect_error);
        header('location: ../../errors/404.php');
    }

// php > pg_connect("host=localhost dbname=edb user=enterprisedb password=postgres");

// php > pg_query("create table test(id integer)");

// php > exit

##
// <?php

// echo "My first PHP script!";

// pg_connect("host=localhost dbname=edb user=enterprisedb password=postgres");

// pg_query("create table testing(id integer)");

// echo " script! Executed";

// ?>
