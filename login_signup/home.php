<?php require_once 'controllers/authcontroller.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/login.css">    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">
            <?php if(isset($_SESSION['msg'])): ?>
                <div class="alert <?php echo $_SESSION['alert-class']; ?>">
                    <?php 
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                        unset($_SESSION['alert-class']);
                    ?>
                </div>
            <?php endif; ?>

                <h3>Welcome, <?php echo $_SESSION['username']; ?></h3>

                <a href="./index.html?logout=1" class="logout">logout</a>

                <?php if(!$_SESSION['verified']): ?>
                    <div class="alert alert-warning">
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



    <script src="./js/jquery-1.9.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</body>
</html>