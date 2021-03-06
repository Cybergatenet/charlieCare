<?php
  require_once './process/adminLogin.php';

?>
<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CharlyCareCla$ic is a single family office that thrives on the ideology of inventing the life we 
    deserve through innovation and creativity.">
    <meta name="keywords" content="CharlyCareCla$ic, Forex, Online Trading, Investment, Foreign exchange">
    <meta name="author" content="Designed by cybergate communication network">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../img/charlyLogo22.png" type="image/x-icon">
    <title>DashBoard | CharlyCareCla$ic</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/starter-template.css" rel="stylesheet">
    <!-- custom stylesheet -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- Add ck-editor cdn -->
    <script src="https://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-danger fixed-top">
      <a class="navbar-brand" href="../index.php">CharlyCareCla$ic</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        
      </div>
    </nav>
    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center h3"> Admin Area <small>| Account Login</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="container">
        <div class="row">     
          <div class="col-md-6 col-md-offset-6 mx-auto">
              <form id="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="card p-3">
			      <h4 class="alert <?php echo $msgClass; ?> h6"><?php echo $msg; ?></h4>
                <div class="form-group mx-3">
                    <label for="">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email..." required>
                </div>
                <div class="form-group mx-3">
                    <label for="">Password</label>
                    <input type="password" name="pwd" class="form-control" placeholder="Enter Password..." required>
                </div>
                <div class="form_group mx-3">
                  <label>Admin Security Key</label>
                  <input type="password" name="security" class="form-control" value="" placeholder="Enter Admin Security Key" required>
                </div>
                <button type="submit" name="submit" class="btn btn-danger btn-block mt-2">Login</button>
              </form>
        </div>
      </div>
      </div>
    </section>
    <!-- footer -->
    <footer id="footer">
      <p>Copyright CharlyCareCla$ic family office, &copy; 2020</p>
    </footer>
  

    <!-- ck Editor -->
    <script>
      CKEDITOR.replace( 'editor1' );
    </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery-slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="./js/jquery-3.5.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
<!-- Admin verification -->
    <script type="text/javascript">
      // window.onload = () => {
      //     let anwser = prompt("Enter Admin PassKey", "");
  
      //     if(anwser != "123456"){
      //         window.location.href = "../login_signup/login.php";
      //     }
      // }
  </script>
  </body>
</html>
