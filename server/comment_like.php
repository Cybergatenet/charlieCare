<?php
    session_start();
    require('../config/db.php');
    
    $post_id = $_SESSION['post_id'];
    
    // loading initial comments
    if(isset($_GET['fetch'])){
        $query_comment = 'SELECT * FROM `charlycare_comment` WHERE `post_id`="'.$post_id.'" ORDER BY `timestamp` DESC';
        $return_comments = mysqli_query($conn, $query_comment);
        $comments = array();

        if(mysqli_num_rows($return_comments) > 0){
            while($row = mysqli_fetch_assoc($return_comments)){
                $comments[] = $row;
            }
            // print_r($comments);
            foreach($comments as $comment){
                // fetching users who commented
                $query_users = 'SELECT * FROM `charlycare_users` WHERE `id`="'.$comment['user_id'].'"';
                $return_users = mysqli_query($conn, $query_users);
                $users = array();

                if(mysqli_num_rows($return_users) > 0){
                    while($row = mysqli_fetch_assoc($return_users)){
                        $users[] = $row;
                    }
                }
                foreach($users as $user){
                    $_edit_btn = '';
                    if($_SESSION['id'] == $user['id']){
                        $_edit_btn = '<span class="mx-3 text-primary" data-id="' . $comment['id'] . '">Edit</span> | <span class="mx-3 text-danger" data-id="' . $comment['id'] . '">Delete</span>';
                    }
                    $saved_comment = '<div class="row mt-4">
                        <div class="col-4 col-md-2 div-image">
                            <img src="./uploads/'.$user['avatar'].'" alt="">
                            <h6 class="ml-4">' . $user['username'] . '</h6>
                        </div>
                        <div class="col-7 col-md-7 comment-text p-2">
                        ' . validateOutput($comment['comment']) . '
                        </div>
                        <h6 class="ml-4 text-primary">"' . date("F jS, Y", strtotime($comment['timestamp'])) . '"</h6>
                        <h6>
                            '.$_edit_btn .'
                        </h6>
                    </div>';
                    echo $saved_comment;
                }
                // end of inner foreach
            }
        }
    }
    
    if (isset($_POST['save'])) {
        $user_id = $_SESSION['id'];
        // $post_id = 11;
        $like = 0;
        $unlike = 0;
        $comment = mysqli_real_escape_string($conn, htmlentities($_POST['comment']));
        $timestamp = date('d/m/y h:i:s');
        
        $sql = "INSERT INTO `charlycare_comment` (`user_id`,`post_id`, `like`, `unlike`, `comment`, `timestamp`) VALUES ('$user_id', '$post_id', '$like', '$unlike', '$comment', '$timestamp')";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isiiss', $user_id, $post_id, $like, $unlike, $comment, $timestamp);
        // echo $comment."<br>".$user_id. '<br>'.$id;
        
        if($stmt->execute()){
            // fetching posts here
            $query_comment = 'SELECT * FROM `charlycare_comment` WHERE `post_id`="'.$post_id.'" ORDER BY `timestamp` DESC';
        $return_comments = mysqli_query($conn, $query_comment);
        $comments = array();

        if(mysqli_num_rows($return_comments) > 0){
            while($row = mysqli_fetch_assoc($return_comments)){
                $comments[] = $row;
            }
            // print_r($comments);
            foreach($comments as $comment){
                // fetching users who commented
                $query_users = 'SELECT * FROM `charlycare_users` WHERE `id`="'.$comment['user_id'].'"';
                $return_users = mysqli_query($conn, $query_users);
                $users = array();

                if(mysqli_num_rows($return_users) > 0){
                    while($row = mysqli_fetch_assoc($return_users)){
                        $users[] = $row;
                    }
                }
                foreach($users as $user){
                    $_edit_btn = '';
                    if($_SESSION['id'] == $user['id']){
                        $_edit_btn = '<span class="mx-3 text-primary" data-id="' . $comment['id'] . '">Edit</span> | <span class="mx-3 text-danger" data-id="' . $comment['id'] . '">Delete</span>';
                    }
                    $saved_comment = '<div class="row mt-4">
                        <div class="col-4 col-md-2 div-image">
                            <img src="./uploads/'.$user['avatar'].'" alt="">
                            <h6 class="ml-4">' . $user['username'] . '</h6>
                        </div>
                        <div class="col-7 col-md-7 comment-text p-2">
                        ' . $comment['comment'] . '
                        </div>
                        <h6 class="ml-4 text-primary">"' . date("F jS, Y", strtotime($comment['timestamp'])) . '"</h6>
                        <h6>
                            '.$_edit_btn .'
                        </h6>
                    </div>';
                    echo $saved_comment;
                }
                // end of inner foreach
            }
        }
           
        }else{
            echo "NOT successful".'<br>'.mysqli_error($conn);
        }
    
        
        exit();
    }

    // validation of output
    function validateOutput($resolution){
        $resolution = trim($resolution);
        $resolution = nl2br($resolution);
        return $resolution;
    }
    //   if (mysqli_query($conn, $sql)) {
        //     $id = mysqli_insert_id($conn);
        //   $saved_comment = '<div class="comment_box">
        //           <span class="delete" data-id="' . $id . '" >delete</span>
        //           <span class="edit" data-id="' . $id . '">edit</span>
        //           <div class="display_name">'. $name .'</div>
        //           <div class="comment_text">'. $comment .'</div>
        //       </div>';
        //     echo $saved_comment;
        //   }else {
        //     echo "Error: ". mysqli_error($conn);
        //   }
?>