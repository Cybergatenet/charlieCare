<?php
    session_start();
    
	// database connection
    require('../config/db.php');


            //////////// ///       ///       ////    ////////////// 
          ///       ///  ///       ///     ///  ///       ///
        ///              ///       ///    ///   ///       ///
        ///              /////////////   ///////////      ///
        ///              ///       ///  ///      ///      ///
         ///       //    ///       /// ///       ///      ///
          //////////     ///       //////        ///      ///


    // echo "reciving this files from the other end";
    if(isset($_POST['send'])){
      $user_id = mysqli_insert_id($conn);
      $msg = $_POST['msgData'];
      $timestamp = 2555;
      // echo date("F jS, Y", strtotime($blog['post_time']));
      $sql = "INSERT INTO `charlycare_chat` (`user_id`, `msg`, `timestamp`) VALUES ('$user_id', '$msg', '$timestamp')";
      if (mysqli_query($conn, $sql)) {

        $sql = 'SELECT * FROM charlycare_chat';

        $stmt = $conn->prepare($sql);
        // $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = $result->fetch_all();

        // var_dump($users);
        foreach($users as $user){
          $id = mysqli_insert_id($conn);

          // if($user[''])
          echo '<br>'. print_r($user, true). '<br>'; 
          // $saved_comment = '<div class="comment_box">
          //     <span class="delete" data-id="' . $user['id'] . '" >delete</span>
          //     <span class="edit" data-id="' . $user['user_id'] . '">edit</span>
          //     <div class="display_name">'. $user['msg'] .'</div>
          //     <div class="comment_text">'. $user['timestamp'] .'</div>
          //   </div>';
          // echo $saved_comment;
        }
      }else{
        echo "DATA was NOT inserted";
      }
    }else{
      echo "NO data sent here";
    }

?>