<?php
    if(isset($_POST['newsletter'])){
        // echo '<script>alert("Your Email was recorded successfully");</script>';
        $email = $_POST['email'];
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

        $myfile = fopen("newsletter.txt", "a") or die("Temporarily unavaliable");
        $txt = $email."\n";
            if(fwrite($myfile, $txt)){
                echo '<script>alert("Your Email was recorded successfully");</script>';
                fclose($myfile);
            }else{
                echo '<script>alert("Email NOT Recorded. Try Again");</script>';
                fclose($myfile);
            }
        }else{
            echo '<script>alert("Invalid Email Address. Check Your Email And Try Again");</script>';
        }
    }
?>