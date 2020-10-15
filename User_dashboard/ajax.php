<?php
    // include db_conn
    $sql = "SELECT * FROM posts LIMIT 2";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- link to jquery -->
    <script>
        $(document).ready(function() {
            let commentsCount = 2;
            $("button").click(function() {
                commentsCount = commentsCount + 2;
                $("#comments").load("load-comments.php", {
                    commentsNewCount: commentsCount
                });
            });
        });
    </script>
</head>
<body>
    <form action="" method="">
        <div id="comments">
            <!-- php code here for the fetch result -->
        </div>
        <button type="submit">Read More</button>
    </form>
</body>
</html>