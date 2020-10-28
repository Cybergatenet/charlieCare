<?php
  session_start();

  require('../config/db.php');

  // $_SESSION['admin'] = 'Charly_Admin';
  if(!$_SESSION['admin']){
      header("location: ./index.php");
      exit();
  }
  $query = 'SELECT * FROM charlycare_users ORDER BY userTime DESC';
    $result = mysqli_query($conn, $query);
    $datas = array();
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $datas[] = $row;
        }
    }
###############################################
// fetching posts here
  $query_post = 'SELECT * FROM charlycare_posts ORDER BY post_time DESC';
  $return_posts = mysqli_query($conn, $query_post);
  $posts = array();

  if(mysqli_num_rows($return_posts) > 0){
      while($row = mysqli_fetch_assoc($return_posts)){
          $posts[] = $row;
      }
  }
?>
<!doctype html>
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
    <!-- Fontawesome link -->
    <link href="./css/css/all.min.css" type="text/css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/starter-template.css" type="text/css" rel="stylesheet">
    <!-- custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <!-- Add ck-editor cdn -->
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-danger fixed-top">
      <a class="navbar-brand" href="../index.php">CharlyCareCla$ic</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">DashBoard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages.php">Pages<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
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
            <h1><span class="fa fa-cogs" aria-hidden="true"></span> Posts <small class="h6"> Manage blog Posts</small></h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle text-white" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create Content</button>
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
            <li><a href="#">DashBoard</a></li>
          <li class="active"> Posts</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
          <div class="list-group">
              <a href="index.php" class="list-group-item active main-color-bg"><span class="fa fa-cogs" aria-hidden="true"></span>&nbsp;&nbsp;DashBoard</a>
              <a href="pages.php" class="list-group-item"><span class="fa fa-list" aria-hidden="true"></span>&nbsp;&nbsp;Pages <span class="badge">12</span></a>
              <a href="posts.php" class="list-group-item"><span class="fa fa-pen" aria-hidden="true"></span>&nbsp;&nbsp;Posts <span class="badge"><small class="h6 text-primary"><?php echo mysqli_num_rows($return_posts); ?></small></span></a>
              <a href="users.php" class="list-group-item"><span class="fa fa-user" aria-hidden="true"></span>&nbsp;&nbsp;Users <span class="badge"><?php echo mysqli_num_rows($result); ?></span></a>
            </div>
            <div class="well">
              <h4>Disk space Used</h4>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">loading...</div>
              </div>
              <h4>BandWidth Used</h4>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">loading...</div>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title p-2">Posts</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="Filter Posts...">
                    </div>
                </div>
                <br>
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Post Title</th>
                        <th>Published</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($posts as $post): ?>
                      <tr>
                        <td><?php echo $post['post_title']; ?></td>
                        <td class="text-primary font-weight-bold"><span class="fa fa-check" aria-hidden="true"></span></td>
                        <td><?php echo $post['post_time']; ?></td>
                        <td><a class="btn btn-default" href="edit.php?post_id=<?php echo $post['id']; ?>">Edit</a> <a class="btn btn-danger" href="edit.php?delete=true&post_id=<?php echo $post['id']; ?>">Delete</a> </td>
                    </tr>
                    <?php endforeach; ?>
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
