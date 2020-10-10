<?php require_once 'controllers/authcontroller.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CharlyCareCla$ic is a single family office that thrives on the ideology of inventing the life we 
    deserve through innovation and creativity.">
    <meta name="keywords" content="CharlyCareCla$ic, Forex, Online Trading, Investment, Foreign exchange">
    <meta name="author" content="Designed by cybergate communication network">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../img/charlyLogo22.png">
    <title>Account Verification | Charlycarecla$ic</title>
    <!-- fontAwesome -->
    <link rel="stylesheet" href="../css/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css"> 
    <style>
        body{
            min-height: 100vh;
        }
        .container{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 3px solid rgba(0, 0, 0, 0.5);
            padding: 20px 100px;
            width: 400px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<header style="background-color: #2196f3; padding-top: 0px; box-shadow: 0px -3px 5px rgba(0, 0, 0, .9) inset;"> <!--initial-red=#e40046 || blue=#2196f3;-->
        <div class="wrapper">
            <nav class="nav">
                <div class="menu-toggle">
                    <div class="new_menu">
                        <div class="lin"></div>
                        <div class="lin"></div>
                        <div class="lin"></div>
                    </div>
                    <a href="#"><i class="fas fa-times"></i></a>
                </div>
                <div class="main-header-title">
                    <a href="./index.html" class="logo"><img src="../img/charlyLogo22.png" alt="" width="70px"
                            height="50px"></a>
                    <div class="main-title">
                        <h2 class="header-title">CharlyCareCla$ic</h2>
                        <small class="header-small">Family Office</small>
                    </div>
                </div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="../index.html" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="../about.html" onclick="alert('Oop!..offline for maintenance!');" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="./login.php" class="nav-link active">Log Out</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- header ends here -->
    <br><br><br><br><br>
            <br><br>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 offset-md-12 form-div login">
            <?php if(isset($_SESSION['msg'])): ?>
                <div class="alert <?php echo $_SESSION['alert-class']; ?>">
                    <?php 
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                        unset($_SESSION['alert-class']);
                    ?>
                </div>
            <?php endif; ?>

                <h3>Welcome, <?php echo ucfirst($_SESSION['username']); ?></h3>

                <a href="./login.php?logout=1" class="btn btn-danger m-2">Log out</a>

                <?php if(!$_SESSION['verified']): ?>
                    <div class="alert alert-warning h4">
                        You need to verify your account.
                        Sign in to your email account and click on the verification link we just emailed you at <strong><?php echo $_SESSION['email']; ?></strong>
                    </div>
                <?php endif; ?>

                <?php if($_SESSION['verified']): ?>
                    <button class="btn btn-block btn-lg btn-primary">I am verified!</button>
                <?php endif; ?>
            </div>
        </div>
    </div>    



    <script src="../js/jquery-1.9.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>