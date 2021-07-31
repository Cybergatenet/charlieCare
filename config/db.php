<?php

    require 'constants.php';

    ###############
// $cleardb_usernme = 'bb2bad4130e48c';
// $pwd_cleardb = '89dea8e7';
// $db_name = ' heroku_4855ef7cc781658';
// $url_clear = 'us-cdbr-east-02.cleardb.com';

    // $conn = new mysqli($server, $username, $password, $db);
    // $conn = new mysqli($hostinger_host, $hostinger_username, $hostinger_password, $hostinger_db);

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // if(!$conn){
        // echo 'Database is not connnecting now. Try again in 24hours';
        // header('location: ../../errors/404.php');
        // die($conn->connection_status);
        // exit("Oop!...NOT connected");
    // }

    if($conn->connect_error) {
        die('Database Disconnected-:)= offline for maintenance');
        // .$conn->connect_error);
        header('location: ../../errors/404.php');
    }

// $app->get('/', function() use($app) {
//     $app['monolog']->addDebug('logging output.');
//     return str_repeat('Hello', getenv('TIMES'));
//   });

#####
##CLEARDB_DATABASE_URL:      mysql://bb2bad4130e48c:89dea8e7@us-cdbr-east-02.cleardb.com/heroku_4855ef7cc781658?reconnect=true

?>