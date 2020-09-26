<?php require_once 'controllers/authcontroller.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up | Log In</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/login.css">
</head>
<body>
    <section>
        <div class="container">
            <div class="user signinBx">
                <div class="imgBx"><img src="./img/bg_1.png" alt=""></div>
                <div class="formBx">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h2>Sign In</h2>
                        <input type="text" placeholder="Username">
                        <input type="password" placeholder="Password">
                        <input type="submit" value="Login">
                        <p class="signup">Don't have an account ? <a href="#" onclick="toggleForm();">Sign Up</a></p>
                    </form>
                </div>
            </div>

            <div class="user signupBx">
                <div class="formBx">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h2>Create an account</h2>
                        <!-- error msg here -->
                        <div class="alert alert-success">
                            Login success
                        </div>
                        <input type="text" name="username" value="<?php echo $username ?>" placeholder="Enter Your Username">
                        <input type="email" name="email" value="<?php echo $email ?>" placeholder="Enter Your Email">
                        <input type="password" placeholder="Create Password">
                        <input type="password" placeholder="Confirm Password">
                        <input type="submit" name="signup" value="Sign Up">
                        <p class="signup">Already have an account ? <a href="#" onclick="toggleForm();">Log In</a></p>
                    </form>
                </div>
                <div class="imgBx"><img src="./img/bg_2.png" alt=""></div>
            </div>
        </div>
    </section>


    <script src="./js/jquery-1.9.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/login.js"></script>
</body>
</html>