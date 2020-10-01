<?php 

    require_once 'controllers/authcontroller.php'; 
    if(!isset($_SESSION['id'])){
        header('location: index.html');
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up | Log In | CharlyCareCla$ic</title>
    <!-- <link rel="stylesheet" href="./css/bootstrap.min.css"> -->
    <!-- fontAwesome -->
    <link rel="stylesheet" href="../css/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="./css/login.css">
</head>
<body>
    <header>
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
                        <a href="../index.html" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" onclick="alert('Oop!..offline for maintenance!');" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="./index.html" onclick="alert('sorry, this app is under maintenance');" class="nav-link">Log In</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- header ends here -->
    <br><br><br><br><br>
            <br><br>
    <section>
        <div class="wrapper">
            <div class="user signinBx">
                <div class="imgBx"><img src="../img/globe.jpg" alt=""></div>
                <div class="formBx">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <h2>Sign In</h2>
                        <!-- error msg here -->
                        <?php if(count($errors) > 0): ?>
                            <div class="alert alert-success">
                                <?php foreach($errors as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <input type="text" placeholder="Username or Email" value="<?php echo $username; ?>">
                        <input type="password" placeholder="Password">
                        <input type="submit" value="Login" name="login">
                        <p class="signup">Don't have an account ? <a href="#" onclick="toggleForm();">Sign Up</a></p>
                    </form>
                </div>
            </div>

            <div class="user signupBx">
                <div class="formBx">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <h2>Create an account</h2>
                        <!-- error msg here -->
                        <?php if(count($errors) > 0): ?>
                            <div class="alert alert-success">
                                <?php foreach($errors as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Enter Your Username">
                        <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter Your Email">
                        <input type="password" placeholder="Create Password">
                        <input type="password" placeholder="Confirm Password">
                        <input type="submit" name="signup" value="Sign Up">
                        <p class="signup">Already have an account ? <a href="#" onclick="toggleForm();">Log In</a></p>
                    </form>
                </div>
                <div class="imgBx"><img src="../img/star.jpg" alt=""></div>
            </div>
        </div>
    </section>


    <!-- <script src="./js/jquery-1.9.1.min.js"></script> -->
    <!-- <script src="./js/bootstrap.min.js"></script> -->
    <!-- header js -->
    <script src="../js/main.js"></script>
    <!-- <script src="./js/login.js"></script> -->
</body>
</html>