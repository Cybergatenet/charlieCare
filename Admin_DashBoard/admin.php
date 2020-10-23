<?php
	session_start();

    require('../config/db.php');

    // $_SESSION['admin'] = 'Charly_Admin';
    if(!$_SESSION['admin']){
        // header("location: ./index.php");
        // exit();
    }

//     $query = 'SELECT * FROM greencash_bank ORDER BY merge_at DESC';
//     $result = mysqli_query($conn, $query);
//     $datas = array();
    
//     if(mysqli_num_rows($result) > 0){
//         while($row = mysqli_fetch_assoc($result)){
//             $datas[] = $row;
//         }
//     }
// /////////////////////////////////////////////////////////////////////////
//     #####  SENDING ADMIN MESSAGE HERE ######
//     $errMsg = '';
//     $errMsgClass = '';

//     if(filter_has_var(INPUT_POST, 'submit')){
//         $name = htmlspecialchars($_POST['username']);
//         $email = htmlspecialchars($_POST['email']);
//         $subject = htmlspecialchars($_POST['subject']);
//         $message = htmlspecialchars($_POST['message']);

//         if(!empty($name) && !empty($email) && !empty($subject) && !empty($message)){

//             if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
//                 $errMsg = "Please use a vaild email";
//                 $errMsgClass = "alert-danger";
//             }else{
//                 $toemail = $email;
//                 $title = $subject;
//                 $body = '<html><body>';
//                 $body .= '<h4>Dear '.$name.'</h4>
//                         <p>'.$message.'</p>';
//                 $body .= '</body></html>';

//                 $header = "MIME-Version : 1.0" ."\r\n";
//                 $header .= "Content-Type: text/html;charset: UTF-8" ."\r\n";
//                 $header .= "Admin From Greencash: admin@greencash2020.com". "\r\n";

//                 if(mail($toemail, $title, $body, $header)){
//                         $errMsg = "Hi Admin, Your Email to ".$name." was successful. Cheers!";
//                         $errMsgClass = "alert-success";
//                         $name = $email = $subject = $message = '';
//                 }else{
//                         $errMsg = "Hi Admin, Your email was NOT successful. Try again later";
//                         $errMsgClass = "alert-danger";
//                 }
//             }
//         } else{
//             $errMsg = "Please fill all fields";
//             $errMsgClass = "alert-danger";
//         }
//     }
// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////##########################################################
//     ####       MERGING STARTS HERE
//     $msg = "";
//     $MsgClass = "";

// if(isset($_POST['merge_A'])){
//         $payee = mysqli_real_escape_string($conn, $_POST['payee']);
//         $pay_acc_name = mysqli_real_escape_string($conn, $_POST['pay_acc_name']);
//         $pay_acc_number = mysqli_real_escape_string($conn, $_POST['pay_acc_number']);
//         $pay_bank_name = mysqli_real_escape_string($conn, $_POST['pay_bank_name']);
//         $payer = mysqli_real_escape_string($conn, $_POST['payer']);
//     if(!empty($payee) && !empty($pay_acc_name) && !empty($pay_acc_number) && !empty($pay_bank_name) && !empty($payer)){
//         if($payee === $payer){
//             $msg = 'You Can NOT Merge One Person Twice';
//             $msgClass = "alert-danger";
//         }else{
// ########## Admin will customise these variables himself ##############
//         $sql_merge = "SELECT * FROM greencash_bank WHERE username = '$payee'";
//         $result = mysqli_query($conn, $sql_merge);
//         $post = mysqli_fetch_assoc($result);
//         mysqli_free_result($result);
//         $merge = "merge payment";
//         $merge_at = "";
//         $merge_details = "Account Name: ".$post['acc_name']."<br>"."Account Number: ".$post['acc_number']."<br>"."Bank Name: ".$post['acc_bank'];
//         $image = "My pending image.jpg";
// $id = mysqli_real_escape_string($conn, $_GET['id']);
#### UPDATING PAYER'S ROW

//     $query_payer = "UPDATE `greencash_bank` SET `merge` = '$merge', `merge_details` = '$merge_details', `merge_at` = CURRENT_TIME, `pay_acc_name` = '$pay_acc_name', `pay_acc_number` = '$pay_acc_number', `pay_bank_name` = '$pay_bank_name', `image` = '$image' WHERE `greencash_bank`.`username` = '$payer'";

//         if(mysqli_query($conn, $query_payer)){
//             $msg = 'Successfully Merged A'."<br>";
//             $msgClass = "alert-success";
//             // $payee = $pay_acc_name = $pay_acc_number = $pay_bank_name = $payer = "";
//         }else{
//             // echo 'ERROR: '.mysqli_error($conn);
//             $msg = 'An Error occurred during the merge procees. Try Again';
//             $msgClass = "alert-danger";
//             }
//         }
//    }else{
//     //   some fields are empty
//     $msg = 'Please fill All fields To Continue';
//     $msgClass = "alert-danger";
//     }
// }
//////   #    ///////    #   //////////  #    ////////////    #    //////////   #   ///////
#### UPDATING RECEIVER'S ROW
// if(isset($_POST['merge_B'])){
//         $payee = mysqli_real_escape_string($conn, $_POST['payee']);
//         $pay_acc_name = mysqli_real_escape_string($conn, $_POST['pay_acc_name']);
//         $pay_acc_number = mysqli_real_escape_string($conn, $_POST['pay_acc_number']);
//         $pay_bank_name = mysqli_real_escape_string($conn, $_POST['pay_bank_name']);
//         $payer = mysqli_real_escape_string($conn, $_POST['payer']);
//     if(!empty($payee) && !empty($pay_acc_name) && !empty($pay_acc_number) && !empty($pay_bank_name) && !empty($payer)){
//         if($payee === $payer){
//             $msg = 'You Can NOT Merge One Person Twice';
//             $msgClass = "alert-danger";
//         }else{
//     /// merge variable for just the RECEIVER
//         // get acc_name, number, email
//         $merge = "merged"; 
//         $sql_merge = "SELECT * FROM greencash_bank WHERE username = '$payer'";
//         $result = mysqli_query($conn, $sql_merge);
//         $post = mysqli_fetch_assoc($result);
//         mysqli_free_result($result);
//     // adding payers details here ///
//         $merge_details = "Name: ".$post['acc_name']."<br>";
//         $merge_details .= "Number: ".$post['number']."<br>";
//         $merge_details .= "Email: ".$post['email']."<br>";
//         $merge_details .= "Amount: ".$post['amount'];

//         $query_payee = "UPDATE `greencash_bank` SET `merge` = '$merge', `merge_details` = '$merge_details', `merge_at` = CURRENT_TIME WHERE `greencash_bank`.`username` = '$payee'";

//         if(mysqli_query($conn, $query_payee)){
//             $msg = 'Successfully Merged B';
//             $msgClass = "alert-success";
//             // $payee = $pay_acc_name = $pay_acc_number = $pay_bank_name = $payer = "";
//         }else{
//             // echo 'ERROR: '.mysqli_error($conn);
//             $msg = 'Incomplete merge Process. Contact Webmaster';
//             $msgClass = "alert-danger";
//         }
//     }
// }else{
//     //   some fields are empty
//     $msg = 'Please fill All fields To Continue';
//     $msgClass = "alert-danger";
//     }
// }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////######################################################
/// Admin confirm payments here
// $png = "";
// if(isset($_POST['confirm'])){
//     $payment = mysqli_real_escape_string($conn, $_POST['payment']);
//     $merge = "paid and confirmed";
//     $merge_details = "Cheers!...Your Payment Has Been Confirmed";

//     if(empty($payment)){
//         $png = "<h5 style='color:red;'>ERROR!...You MUST select A Username to complete this action</h5>";
//     }else{
//         $query_payment = "UPDATE greencash_bank SET `merge` = '$merge', `merge_details` = '$merge_details' WHERE `username` = '$payment'";
//         if(mysqli_query($conn, $query_payment)){
//             $png = "<img src='../../../img/pass.png' width='80px' height='80px'>";
//         }else{
//             $png = "<img src='../../../img/error.png' width='80px' height='80px'>";
//         }
//     }
// }

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
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-danger fixed-top">
      <a class="navbar-brand" href="#">CharlyCareCla$ic</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">DashBoard<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages.php">Pages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="posts.php">Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users.php">Users</a>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li class="nav-item active">
            <a class="nav-link" href="#">Welcome, Admin<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./index.php?login=true">Logout</a>
          </li>
          </ul>
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> DashBoard <small> manage your site</small></h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create Content</button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a class="dropdown-item" type="button" data-toggle="model" data-target="#addPage">Add Page</a></li>
                <li><a class="dropdown-item" href="posts.php">Add Post</a></li>
                <li><a class="dropdown-item" href="users.php">Add User</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">DashBoard</li>
<!-- display some msg to the admin here -->
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>DashBoard</a>
              <a href="pages.html" class="list-group-item"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>Pages <span class="badge">12</span></a>
              <a href="posts.html" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Posts <span class="badge">100</span></a>
              <a href="users.html" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Users <span class="badge">1000</span></a>
            </div>
            <div class="well">
              <h4>Disk space Used</h4>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">60%</div>
              </div>
              <h4>BandWidth Used</h4>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">40%</div>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Website Overview</h3>
              </div>
              <div class="panel-body row">
                <div class="col-md-3">
                  <div class="well card dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span>1000</h2>
                    <h4>Users</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card dash-box">
                    <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>12</h2>
                    <h4>Pages</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card dash-box">
                    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>100</h2>
                    <h4>Posts</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card dash-box">
                    <h2><span class="glyphicon glyphicon-start" aria-hidden="true"></span>2000</h2>
                    <h4>Visitors</h4>
                  </div>
                </div>
              </div>
            </div>
            <!-- lstest panel -->
            <div class="panel panel-default">
              <div class="panel-heading bg-danger text-white">
                <h3 class="panel-title">Latest Users</h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-hover bg-white">
                  <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Joined</th>
                  </tr>
                  <tbody>
                  <?php foreach($datas as $data) : ?>
                      <tr class="text-white">
                          <td><?php echo $data['username']; ?></td>
                          <td><?php echo $data['phone']; ?></td>
                          <td><?php echo $data['email']; ?></td>
                          <td><?php echo $data['userTime']; ?></td>
                      </tr>
                  <?php endforeach; ?>
              </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
    </section>
    <!-- footer -->
    <footer id="footer">
      <p>Copyright CharlyCareCla$ic, &copy; 2020</p>
    </footer>

    <!-- Add page Model -->
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true"></span></button>
            <h4 class="modal-title" id="myModalLabel">Add Page</h4>
          </div>
          <div class="modal-body">
                <div class="form-group">
                  <label>Page Title</label>
                  <input type="text" class="form-control" placeholder="Page Title">
              </div>
              <div class="form-group">
                <label>Page Title</label>
                <textarea name="editor1" class="form-control" placeholder="Page Body"></textarea>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Published
              </label>
            </div>
            <div class="form-group">
              <label>Meta Tags</label>
              <input type="text" class="form-control" placeholder="Add Some Tags...">
            </div>
            <div class="form-group">
              <label>Meta Description</label>
              <input type="text" class="form-control" placeholder="Add Meta Description...">
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
        </div>
      </div>
    </div>

   

    <!-- ck Editor -->
    <script>
      CKEDITOR.replace( 'editor1' );
    </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery-slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="./js/jquery-1.9.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>
