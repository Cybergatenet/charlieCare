<?php
    session_start();
    require('../config/db.php');

    $id = isset($_GET['post_id']);
    echo $id.' is the id';
    if (isset($_POST['save'])) {
        $user_id = $_SESSION['id'];
        $post_id = 11;
        $like = 0;
        $unlike = 0;
        $comment = $_POST['comment'];
        $timestamp = date('d/m/y h:i:s');
        
        $sql = "INSERT INTO `charlycare_comment` (`user_id`,`post_id`, `like`, `unlike`, `comment`, `timestamp`) VALUES ('$user_id', '$post_id', '$like', '$unlike', '$comment', '$timestamp')";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isiiss', $user_id, $post_id, $like, $unlike, $comment, $timestamp);
        // echo $comment."<br>".$user_id. '<br>'.$id;
        
        if($stmt->execute()){
            // echo 'successfully';
            // fetching posts here
            $query_comment = 'SELECT * FROM `charlycare_comment` ORDER BY `timestamp` DESC';
            $return_comments = mysqli_query($conn, $query_comment);
            $comments = array();

            if(mysqli_num_rows($return_comments) > 0){
                while($row = mysqli_fetch_assoc($return_comments)){
                    $comments[] = $row;
                }
                print_r($comments);
                // foreach($comments as $comment){
                //     $saved_comment = '<div class="comment_box">
                //         <span class="delete" data-id="' . $comment['id'] . '" >delete</span>
                //         <span class="edit" data-id="' . $comment['id'] . '">edit</span>
                //         <div class="display_name">'. $name .'</div>
                //         <div class="comment_text">'. $comment .'</div>
                //     </div>';
                //     echo $saved_comment;
                // }
            }
        }else{
            echo "NOT successful".'<br>'.mysqli_error($conn);
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
          exit();
    }
?>