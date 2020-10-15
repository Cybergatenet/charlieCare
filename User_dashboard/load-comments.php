<?php
    // include db_conn
    $commentsNewCount = $_POST['commentsNewCount'];
     $sql = "SELECT * FROM posts LIMIT $commentsNewCount";
     $result = mysqli_query($conn, $sql);
     if (mysql_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)){
             echo "<p>";
             echo $row['author'];
             echo $row['msg'];
             echo "</p>";
         }
     }else{
         echo "there are no posts";
     }
?>