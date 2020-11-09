<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    
    require './vendor/autoload.php';
    $mail = new PHPMailer();

    // Settings
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';

    $mail->Host       = "mail.example.com"; 
    $mail->SMTPDebug  = 0;                     
    $mail->SMTPAuth   = true;              
    $mail->Port       = 25;                    
    $mail->Username   = "abelchinedu2@gmail.com"; 
    $mail->Password   = "abchej3647";    

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // $mail->send();
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CharlyCareCla$ic is a single family office that thrives on the ideology of inventing the life we 
    deserve through innovation and creativity.">
    <meta name="keywords" content="CharlyCareCla$ic, Forex, Online Trading, Investment, Foreign exchange">
    <meta name="author" content="Designed by cybergate communication network">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HomePage | CharlieCareClas$ic</title>
    <!-- font-awesome cdn | locally hosted -->
    <link rel="icon" href="./img/logo.png">
    <link rel="stylesheet" type="text/css" href="./css/css/all.css">
    <!-- Scroll Reveal CDN -->
    <script src="https://nupkg.com/scrollreveal"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>



    <!-- <footer>
        <div class="container">
            <div class="back-to-top">
                <a href="#hero"><i class="fas fa-chevron-up"></i></a>
            </div>
            <div class="footer-content">
                <div class="footer-content-about animate-top">
                    <h4>About CharlieCareClas$ic</h4>
                    <div class="asterisk"><i class="fas fa-asterisk"></i></div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint quia sit, in ad reprehenderit a necessitatibus. Culpa ad ab voluptatibus exercitationem deleniti nihil. Laudantium?</p>
                </div>
                <div class="footer-content-divider animate-bottom">
                <div class="social-media">
                    <h4>follow along</h4>
                    <ul class="social-icons">
                        <li>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                                    </li>
                        <li>
                            <a href="#"><i class="fab fa-facebook-square"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fab fa-github-square"></i></a>
                        </li>
                        <li>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </li>
                        <li>
                            <a href="#"><i class="fab fa-tripadvisor"></i></a>
                        </li>
                        </ul>
                    </div>
                    <div class="newsletter-container">
                        <h4>Newsletter</h4>
                        <form action="" class="newsletter-form">
                            <input type="text" class="newsletter-input" placeholder="Your email address...">
                            <button type="submit" class="newsletter-btn">
                            <i class="fas fa-envelope"></i>
                            </button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</footer> -->
        
        <script src="./js/main.js"></script>
</body>
</html>