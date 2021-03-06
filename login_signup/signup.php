<?php 

    require_once 'controllers/authcontroller.php'; 
    // if(!isset($_SESSION['id'])){
    //     header('location: ../index.html');
    //     exit();
    // }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CharlyCareCla$ic is a single family office that thrives on the ideology of inventing the life we 
    deserve through innovation and creativity.">
    <meta name="keywords" content="CharlyCareCla$ic, Forex, Online Trading, Investment, Foreign exchange">
    <meta name="author" content="Designed by cybergate communication network">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up | CharlyCareCla$ic</title>
    <link rel="icon" href="../img/charlyLogo22.png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- fontAwesome -->
    <link rel="stylesheet" href="../css/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <style>
    .error {
        color: red;
        font-size: 90%;
    }
    </style>
</head>

<body>
    <header style="background-color: #2196f3; padding-top: 0px; box-shadow: 0px -3px 5px rgba(0, 0, 0, .9) inset;">
        <!--initial-red=#e40046 || blue=#2196f3;-->
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
                    <a href="../index.php" class="logo"><img src="../img/charlyLogo22.png" alt="" width="70px"
                            height="50px"></a>
                    <div class="main-title">
                        <h2 class="header-title">CharlyCareCla$ic</h2>
                        <small class="header-small">Family Office</small>
                    </div>
                </div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="../about.html" onclick="alert('Oop!..offline for maintenance!');"
                            class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="./login.php" class="nav-link active">Log In</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- header ends here -->
    <!-- <br><br><br> -->
    <section>
        <div class="wrapper">
            <div class="user signupBx">
                <div class="formBx">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="signupForm" id="signupForm">
                        <h2>Create an account</h2>
                        <!-- error msg here -->
                        <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <?php foreach($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <input type="text" name="username" value="<?php echo $username; ?>"
                            placeholder="Enter Your Full Name" title="Surname First, then other Names">
                        <div class="error" id="usernameErr"></div>
                        <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter Your Email">
                        <div class="error" id="emailErr"></div>
                        <input type="password" placeholder="Create Password" name="pwd">
                        <div class="error" id="pwdErr"></div>
                        <input type="password" name="cpwd" placeholder="Confirm Password">
                        <div class="error" id="cpwdErr"></div>
                        <input type="submit" name="signup" value="Sign Up">
                        <p class="signup">Already have an account ? <a href="./login.php">Log In</a></p>
                    </form>
                </div>
                <div class="imgBx"><img src="../img/star2.png" alt=""></div>
            </div>
        </div>
    </section>


    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- header js -->
    <script src="../js/main.js"></script>
    <script src="../js/login.js"></script>
    <script src="../js/validation.js"></script>
</body>

</html>