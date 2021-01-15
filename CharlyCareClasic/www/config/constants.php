<?php

	// define('ROOT_URL', 'http://www.charlycareclasic.com/');
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '123456');
    // define('DB_NAME', 'cyber_user');
    define('DB_NAME', 'cybergate_user');

    // $username = 'b280ac36b578f6';
    // $passwrod = 'eaa82564';
    // $server = ' heroku_4046d464e26fbe3';
    // $db = 'us-cdbr-east-02.cleardb.com';

### ClearDb Config MAIN ###)()()()()()({}{}{)(){}###
    // $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $url = parse_url(getenv("CLEARDB_AMBER_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    // echo $server."the server".'<br>';
    // var_dump($url);
### ClearDb Config MAIN


    // $server = $url["host"];
    // $username = $url["user"];
    // $password = $url["pass"];
    // $db = substr($url["path"], 1);
    // $dns = 'modern-pomegranate-97jr4y64uu0qld0gn0vlwv2j.herokudns.com';

    



    ### main database
    // define('DB_HOST', 'ec2-54-160-161-214.compute-1.amazonaws.com');
    // define('DB_DATABASE', 'd735mp7tf0lee5');
    // define('DB_USER', '
    // miybpuvqhzxiie');
    // define('DB_PASS', '45aaaa01572163c923524e84edfbf43cd4cab6b6d7cba257568425f09d6df109');
    // define('DB_PORT', '
    // 5432');
    // define('DB_NAME', 'd18ng7n9fd505o');
    // define('DB_URL', 'postgres://miybpuvqhzxiie:45aaaa01572163c923524e84edfbf43cd4cab6b6d7cba257568425f09d6df109@ec2-54-160-161-214.compute-1.amazonaws.com:5432/d735mp7tf0lee5');
    // define('HEROKU_CLI', 'heroku pg:psql postgresql-closed-04594 --app charlycarecla');

    // $info = 'Creating cleardb:ignite on ⬢ charlycarecla... free
    // Created cleardb-fluffy-82340 as CLEARDB_AMBER_URL
    // Use heroku addons:docs cleardb to view documentation
    // ';
