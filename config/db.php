<?php

    require 'constants.php';

    ###############
// $cleardb_usernme = 'bb2bad4130e48c';
// $pwd_cleardb = '89dea8e7';
// $db_name = ' heroku_4855ef7cc781658';
// $url_clear = 'us-cdbr-east-02.cleardb.com';

    // $conn = new mysqli($server, $username, $password, $db);

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
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

//
// $app->get('/', function() use($app) {
//     $app['monolog']->addDebug('logging output.');
//     return str_repeat('Hello', getenv('TIMES'));
//   });
    


#####
##CLEARDB_DATABASE_URL:      mysql://bb2bad4130e48c:89dea8e7@us-cdbr-east-02.cleardb.com/heroku_4855ef7cc781658?reconnect=true
##HEROKU_POSTGRESQL_RED_URL: postgres://miybpuvqhzxiie:45aaaa01572163c923524e84edfbf43cd4cab6b6d7cba257568425f09d6df109@ec2-54-160-161-214.compute-1.amazonaws.com:5432/d735mp7tf0lee5

?>