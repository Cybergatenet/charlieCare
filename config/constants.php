<?php
	// define('ROOT_URL', 'http://www.charlycareclasic.com/');
    // define('DB_HOST', 'localhost');
    // define('DB_USER', 'root');
    // define('DB_PASS', '123456');
    // define('DB_NAME', 'cyber_user');
    // define('DB_NAME', 'cybergate_user');

### ClearDb Config
    // $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $url = parse_url(getenv("CLEARDB_AMBER_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);
    

    // $server = $url["host"];
    // $username = $url["user"];
    // $password = $url["pass"];
    // $db = substr($url["path"], 1);
    // $dns = 'modern-pomegranate-97jr4y64uu0qld0gn0vlwv2j.herokudns.com';

    // $username = 'bb2bad4130e48c';
    // $passwrod = '89dea8e7';
    // $server = ' heroku_4855ef7cc781658';
    // $db = 'us-cdbr-east-02.cleardb.com';



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