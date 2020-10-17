 <?php

        if(isset($_POST['logout'])){
            
            session_destroy();

            header("Location: ".ROOT_URL."");
        }
?>
 <!-- starting of admin -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GREENCASH | ADMIN</title>
    <link rel="icon" href="../../../img/lock.png">
    <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../css/style.css">
    <style type="text/css">
        #btn-sm{
            border: 1px solid #fff;
            border-radius: 5px;
        }
        #btn-sm:hover{
            background-color: #fff;
            color: #000;
        }
        #btn-sm:active{
            background-color: #0f0;
            color: #000;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="header-container">
        <h2 id="header"><a href="./index.html"><span id="color">ADMIN</span>DASH-BOARD</a></h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"><input type="submit" name="logout" id="btn-sm" value="LOG OUT"></form>
    </div>
    <!-- starting of admin -->
