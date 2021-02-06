<?php 
    require('../config/db.php');

//   $conn = mysqli_connect('localhost', 'root', '123456', 'cybergate_users');
//   if (!$conn) {
//     die('Connection failed ' . mysqli_error($conn));
//   }
  if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $user_id = 3;
  	$sql = "INSERT INTO charlycare_comment (name, comment) VALUES ('{$name}', '{$comment}')";
  	if (mysqli_query($conn, $sql)) {
  	  $id = mysqli_insert_id($conn);
      $saved_comment = '<div class="comment_box">
      		<span class="delete" data-id="' . $id . '" >delete</span>
      		<span class="edit" data-id="' . $id . '">edit</span>
      		<div class="display_name">'. $name .'</div>
      		<div class="comment_text">'. $comment .'</div>
      	</div>';
  	  echo $saved_comment;
  	}else {
  	  echo "Error: ". mysqli_error($conn);
  	}
  	exit();
  }
  // delete comment fromd database
  if (isset($_GET['delete'])) {
  	$id = $_GET['id'];
  	$sql = "DELETE FROM charlycare_comment WHERE id=" . $id;
  	mysqli_query($conn, $sql);
  	exit();
  }
  if (isset($_POST['update'])) {
  	$id = $_POST['id'];
  	$name = $_POST['name'];
  	$comment = $_POST['comment'];
  	$sql = "UPDATE charlycare_comment SET name='{$name}', comment='{$comment}' WHERE id=".$id;
  	if (mysqli_query($conn, $sql)) {
  		$id = mysqli_insert_id($conn);
  		$saved_comment = '<div class="comment_box">
  		  <span class="delete" data-id="' . $id . '" >delete</span>
  		  <span class="edit" data-id="' . $id . '">edit</span>
  		  <div class="display_name">'. $name .'</div>
  		  <div class="comment_text">'. $comment .'</div>
  	  </div>';
  	  echo $saved_comment;
  	}else {
  	  echo "Error: ". mysqli_error($conn);
  	}
  	exit();
  }

  // Retrieve comments from database
  $sql = "SELECT * FROM charlycare_comment";
  $result = mysqli_query($conn, $sql);
  $comments = '<div id="display_area">'; 
  while ($row = mysqli_fetch_array($result)) {
  	$comments .= '<div class="comment_box">
  		  <span class="delete" data-id="' . $row['id'] . '" >delete</span>
  		  <span class="edit" data-id="' . $row['id'] . '">edit</span>
  		  <div class="display_name">'. $row['name'] .'</div>
  		  <div class="comment_text">'. $row['comment'] .'</div>
  	  </div>';
  }
  $comments .= '</div>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CRUD with AJAx</title>
    <!-- <link rel="stylesheet" href="comment_style.css"> -->
    <style>
    .wrapper {
        width: 45%;
        height: auto;
        margin: 10px auto;
        border: 1px solid #cbcbcb;
        background: white;
    }

    /*
        * COMMENT FORM
        **/
    .comment_form {
        width: 80%;
        margin: 100px auto;
        border: 1px solid green;
        background: #fafcfc;
        padding: 20px;
    }

    .comment_form label {
        display: block;
        margin: 5px 0px 5px 0px;
    }

    .comment_form input,
    textarea {
        padding: 5px;
        width: 95%;
    }

    #submit_btn,
    #update_btn {
        padding: 8px 15px;
        color: white;
        background: #339;
        border: none;
        border-radius: 4px;
        margin-top: 10px;
    }

    #update_btn {
        background: #1c7600;
    }

    /*
        * COMMENT DISPLAY AREA
        **/
    #display_area {
        width: 90%;
        padding-top: 15px;
        margin: 10px auto;
    }

    .comment_box {
        cursor: default;
        margin: 5px;
        border: 1px solid #cbcbcb;
        padding: 5px 10px;
        position: relative;
    }

    .delete {
        position: absolute;
        top: 0px;
        right: 3px;
        color: red;
        display: none;
        cursor: pointer;
    }

    .edit {
        position: absolute;
        top: 0px;
        right: 45px;
        color: green;
        display: none;
        cursor: pointer;
    }

    .comment_box:hover .edit,
    .comment_box:hover .delete {
        display: block;
    }

    .comment_text {
        text-align: justify;
    }

    .display_name {
        color: blue;
        padding: 0px;
        margin: 0px 0px 5px 0px;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php echo $comments; ?>
        <form class="comment_form">
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name">
            </div>
            <div>
                <label for="comment">Comment:</label>
                <textarea name="comment" id="comment" cols="30" rows="5"></textarea>
            </div>
            <button type="button" id="submit_btn">POST</button>
            <button type="button" id="update_btn" style="display: none;">UPDATE</button>
        </form>
    </div>
</body>

<!-- Add JQuery -->
<script src="../js/jquery-3.5.1.min.js"></script>
<!-- <script src="scripts.js"></script> -->
<script>
$(document).ready(function() {
    // save comment to database
    $(document).on('click', '#submit_btn', function() {
        var name = $('#name').val();
        var comment = $('#comment').val();
        $.ajax({
            url: 'server.php',
            type: 'POST',
            data: {
                'save': 1,
                'name': name,
                'comment': comment,
            },
            success: function(response) {
                $('#name').val('');
                $('#comment').val('');
                $('#display_area').append(response);
            }
        });
    });
    // delete from database
    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: 'server.php',
            type: 'GET',
            data: {
                'delete': 1,
                'id': id,
            },
            success: function(response) {
                // remove the deleted comment
                $clicked_btn.parent().remove();
                $('#name').val('');
                $('#comment').val('');
            }
        });
    });
    var edit_id;
    var $edit_comment;
    $(document).on('click', '.edit', function() {
        edit_id = $(this).data('id');
        $edit_comment = $(this).parent();
        // grab the comment to be editted
        var name = $(this).siblings('.display_name').text();
        var comment = $(this).siblings('.comment_text').text();
        // place comment in form
        $('#name').val(name);
        $('#comment').val(comment);
        $('#submit_btn').hide();
        $('#update_btn').show();
    });
    $(document).on('click', '#update_btn', function() {
        var id = edit_id;
        var name = $('#name').val();
        var comment = $('#comment').val();
        $.ajax({
            url: 'server.php',
            type: 'POST',
            data: {
                'update': 1,
                'id': id,
                'name': name,
                'comment': comment,
            },
            success: function(response) {
                $('#name').val('');
                $('#comment').val('');
                $('#submit_btn').show();
                $('#update_btn').hide();
                $edit_comment.replaceWith(response);
            }
        });
    });
});
</script>

</html>