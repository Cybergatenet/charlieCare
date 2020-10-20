<?php
    // include db_conn
    require_once '../config/db.php';
    $msg = '';
    $msgClass = '';
    function validate_input($input){
        $input = htmlspecialchars($input);
        $input = trim($input);
        $input = stripslashes($input);
        return $input;
    }
        $username = mysqli_real_escape_string($conn, validate_input($_POST['username']));
        $email = mysqli_real_escape_string($conn, validate_input($_POST['email']));
        $pwd = mysqli_real_escape_string($conn, validate_input($_POST['pwd']));
        $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $phone = mysqli_real_escape_string($conn, validate_input($_POST['phone']));
        $address = mysqli_real_escape_string($conn, validate_input($_POST['address']));
        $state = mysqli_real_escape_string($conn, validate_input($_POST['state']));
        $country = mysqli_real_escape_string($conn, validate_input($_POST['country']));
        $bio_data = mysqli_real_escape_string($conn, validate_input($_POST['bio_data']));
        $avatar = 'defaultAvatar.png'; // sanitize pics before uplaod

    
     $sql = "UPDATE `charlycare_users` SET `pwd` = '$hash_pwd', `phone` = '$phone', `address` = '$address', `state` = '$state', `country` = '$country', `bio_data` = '$bio_data', `avatar` = '$avatar' WHERE `charlycare_users`.`email` = '$email'";
        if(mysqli_query($conn, $sql)){
            $msg = 'Record updated successfully';
            $msgClass = 'alert-success';
            header('location: ./user.php');
        }else{
            $msg = 'Record was NOT successfully';
            $msgClass = 'alert-danger';
            header('location: ./user.php');
        }
    //  if (mysql_num_rows($result) > 0) {
    //      while($user = mysqli_fetch_assoc($result)){
    //         //  echo "<p>";
    //         //  echo $row['author'];
    //         //  echo $row['msg'];
    //         //  echo "</p>";
    //         echo $user;
    //      }
    //  }else{
    //      echo "Request NOT successful";
    //  }
?>
 