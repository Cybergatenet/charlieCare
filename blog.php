<?php
    session_start();
    require_once './config/db.php'; // connection here
    require_once './server/newletter.php';

    require_once './server/sendEmail.php';
// fetching posts here
$query_posts = 'SELECT * FROM charlycare_posts ORDER BY post_time DESC';
$return_posts = mysqli_query($conn, $query_posts);
$posts = array();

if(mysqli_num_rows($return_posts) > 0){
    while($row = mysqli_fetch_assoc($return_posts)){
        $posts[] = $row;
    }
}

#### Fetching single post
    $post_id = mysqli_real_escape_string($conn, htmlspecialchars($_GET['post_id']));
    $_SESSION['post_id'] = $post_id;
    $query_post = "SELECT * FROM charlycare_posts WHERE `id`='$post_id' LIMIT 1";
    $result = mysqli_query($conn, $query_post);
    $blog_posts = array();
  
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $blog_posts[] = $row;
        }
    }

    function formatText($resolution){
        $resolution = trim($resolution);
        $resolution = nl2br($resolution);
        // $resolution = stripslashes($resolution);
        // $resolution = htmlentities($resolution);
        // $resolution = htmlspecialchars($resolution);

        $resolution = str_replace(array("&gt;", "&lt;", "&quot;", "&amp;", "&nbsp;"), array(">", "<", "\"", "&", ""), $resolution);
        $resolution = html_entity_decode($resolution, ENT_QUOTES | ENT_XML1, 'UTF-8');
        
        $resolution = html_entity_decode($resolution);

        $resolution = htmlspecialchars_decode($resolution);
        
        $resolution = str_replace(array("<p>", "</p>", "<p>&nbsp;</p>", "<strong><p>", "</strong></p>"), array("", "", "", "", ""), $resolution);
        
        // $resolution = str_replace(' r ',"", str_replace(' n ',"",$resolution));
        $resolution = str_replace('rnrn',"", str_replace('rn ',"",$resolution));
        // $resolution = str_replace(' r',"\r", str_replace('n ',"\n",$resolution));
        $resolution = str_replace('<p>rn</p>',"", str_replace('<p>rn</p>',"",$resolution));
        $resolution = str_replace('\\r',"\r", str_replace('\\n',"\n",$resolution));
        $resolution = str_replace('\\\r',"\r", str_replace('\\\n',"\n",$resolution));
        $resolution = str_replace('\\\\', "\r", str_replace('\\\\',"\n",$resolution));
        $resolution = str_replace('\\ \\', "\r", str_replace('\\ \\',"\n",$resolution));
        return $resolution;
    }

    // fetching comments, likes and unlike here
    $query_comments = 'SELECT * FROM `charlycare_comment` ORDER BY `timestamp` DESC';
    $return_comments = mysqli_query($conn, $query_comments);
    $comments = array();

    if(mysqli_num_rows($return_comments) > 0){
        while($row = mysqli_fetch_all($return_comments)){
            $comments[] = $row;
        }
        // print_r($comments);
        // echo count($comments);
        // echo mysqli_num_rows($return_comments);

        // foreach ($comments as $comment) {
        //     // if(count($comment['like']) > 0);
        //     echo count($comment['like'] == 0);
        // }
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
    <title>Blog Post | CharlyCareCla$ic</title>
    <!-- font-awesome cdn | locally hosted -->
    <link rel="icon" href="./img/charlyLogo22.png">
    <!-- fontAwesome here -->
    <link rel="stylesheet" type="text/css" href="./css/css/all.css">
    <!-- Scroll Reveal CDN -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- jQuery CDN here && other cdns here-->
    <script src="./js/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- NEW Styles Added here -->
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/new_styles.css">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="stylesheet" href="./css/blog.css">
    <style>
    .hero {
        width: 100%;
        height: 100vh;
        background: url('./img/globe.jpg') center no-repeat;
        background-size: cover;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        text-align: center;
    }

    .content {
        display: inline-grid;
        /* display: block; */
        position: relative;
        max-width: 90%;
        margin: 10px auto;
    }

    pre {
        display: inline-block;
        /* font-size: 87.5%; */
        /* color: #212529; */
        margin-top: 0;
        margin-bottom: 0;
        overflow: scroll;

    }

    .whatsapp_link {
        position: fixed;
        top: 90%;
        right: 20px;
        z-index: 100;
        width: 60px;
        height: 60px;
        cursor: pointer;
        opacity: 0.6;
    }

    .whatsapp_link a i {
        font-size: 5rem;
        color: whitesmoke;
    }

    .whatsapp_link:hover {
        opacity: 1;
    }

    #update_btn {
        padding: 8px 15px;
        color: white;
        border: none;
        border-radius: 4px;
        margin-top: 10px;
        font-weight: 700;
        background: #1c7600;
    }

    #comment_box {}

    .edit,
    .delete {
        pointer-events: all;
        cursor: pointer;
    }

    .row {
        position: relative;
    }

    .right {
        position: absolute;
        bottom: 10px;
        right: 20px;
        text-align: right;
    }

    @media (min-width: 900px) {
        .content .btn {
            display: inline-block !important;
            padding: 10px;
            font-size: 1.5rem;
            line-height: 2;
            font-weight: 700;
        }
    }

    @media (max-width: 400px) {
        .content.setMobile {
            margin: 0px;
        }
    }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <nav class="nav">
                <div class="menu-toggle">
                    <div class="new_menu">
                        <div class="lin"></div>
                        <div class="lin"></div>
                        <div class="lin"></div>
                    </div>
                    <a href="#"><i class="fas fa-times"></i></a>
                </div>
                <div class="main-header-title">
                    <a href="./index.php" class="logo"><img src="./img/charlyLogo22.png" alt="" width="70px"
                            height="50px"></a>
                    <div class="main-title">
                        <h2 class="header-title"> CharlyCareCla$ic</h2>
                        <small class="header-small">Family Office</small>
                    </div>
                </div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="./index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="./about.html" class="nav-link active">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="./login_signup/login.php" class="nav-link">Log In</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- header ends here -->
    <!-- this hero section is a consideration and can be removed -->
    <section class="hero" id="hero">
        <div class="container">
            <h2 class="sub-headline">
                <span class="first-letter">I</span>nventing
            </h2>
            <br><br><br><br><br>
            <p style="color: #fff;" class="sub-headline typeWriterOne" data-wait="6000"
                data-words='["the life we deserve"]'></p>
            <br><br><br><br><br>
            <p style="color: #fff;" class="sub-headline typeWriterTwo" data-wait="8000"
                data-words='["through innovation"]'></p>
            <br><br><br><br><br>
            <p style="color: #fff;" class="sub-headline typeWriterThree" data-wait="10000"
                data-words='["and creativity"]'></p>
            <br><br><br>
            <h1 class="headline">Charly_Care_Cla$ic</h1>
            <div class="headline-description">
                <div class="separator">
                    <div class="line line-left"></div>
                    <div class="asterisk"><i class="fas fa-asterisk"></i></div>
                    <div class="line line-right"></div>
                </div>
                <div class="single-animation">
                    <h5>Family Office</h5>
                    <a href="#" class="btn cta-btn">Read More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Posts here -->

    <section class="culinary-delight">
        <div class="container">
            <div class="row p-3 text-justify">
                <?php foreach($blog_posts as $blog): ?>
                <div class="card p-3 pl-0">
                    <div class="img"><img src="./uploads/<?php echo $blog['avatar']; ?>" width="100%" alt="post image">
                    </div>
                    <div class="content setMobile">
                        <center>
                            <div class="title"><?php echo $blog['post_title']; ?></div>
                        </center>
                        <p class="m-3" style="text-align: justify; white-space: pre-line;">
                            <?php echo formatText($blog['post_body']); ?></p>
                        <h5 class="text-primary text-left float-left">Post Details:
                            <?php echo date("F jS, Y", strtotime($blog['post_time'])); ?>
                            | <?php echo $blog['country']; ?></h5>
                        <!-- <div class="btn h6">
                            <a href="./blog.php?post_id=<?php echo $blog['id']; ?>"
                                class="btn btn-primary btn-md-block">Prev. Page</a>
                            <a href="./blog.php?post_id=<?php echo $blog['id']; ?>"
                                class="btn btn-primary btn-md-block">Next Page</a>
                        </div> -->
                        <div class="border rounded comment-area">
                            <?php foreach ($comments as $comment) { ?>

                            <button
                                onclick="alert('<?php echo isset($_SESSION['username']) ? 'yes' : 'You are not logged in'; ?>');"
                                class="btn btn-sm"><i class="fa fa-thumbs-up"></i>
                                <span><?php echo count($comment[3]) > 0; ?></span>
                            </button>
                            <button onclick="alert('You are not logged in!');" class="btn btn-sm"><i
                                    class="fa fa-thumbs-down"></i>
                                <span><?php echo count($comment[4] != 0); ?></span>
                            </button>
                            <button class="btn btn-sm"><i class="fa fa-comment"></i>
                                <span><?php echo count($comment[5] != ''); ?></span>
                            </button>
                            <?php } ?>
                        </div>
                        <form action="" class="form-group">
                            <textarea class="form-control mt-2" name="" id="comment" cols="30" rows="3"
                                placeholder="Write a comment..." required></textarea>
                            <?php echo isset($_SESSION['username']) ? '<button class="btn btn-primary btn-md float-right mt-3" id="comment_btn"
                                type="submit">Post</button>' : '<button class="btn btn-primary btn-md float-right mt-3" id="comment_btn"
                                type="submit" disabled>Log in to comment</button>'; ?>
                            <button type="button" id="update_btn" style="display: none;">UPDATE</button>
                        </form>
                        <div class="comment-box m-3">
                            <!-- <div class="row">
                                <div class="col-4 col-md-2 div-image">
                                    <img src="./uploads/defaultAvatar.png" alt="">
                                    <h5 class="ml-4">Username User</h5>
                                </div>
                                <div class="col-7 col-md-7 comment-text p-2">
                                    The year 2020 may had given you uncooked seed but you blew it,the year 2021 is
                                    giving you a cooked seed to be consistent in growing it,so it could give you a
                                    garden
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <section class="services" id="services">
        <div class="container">
            <div class="heading white animate-top">
                <h2>Our Blog</h2>
                <p>Stay connected for amazing contents</p>
            </div>
            <div class="content">
                <div class="slider owl-carousel">
                    <?php foreach($posts as $post): ?>
                    <div class="card" style="min-height: 420px; max-height: 420px; height: 420px;">
                        <div class="img">
                            <img src="./uploads/<?php echo $post['avatar']; ?>" alt="post image">
                        </div>
                        <div class="content">
                            <div class="title"><?php echo $post['post_title']; ?></div>
                            <p><?php echo substr(formatText($post['post_body']), 0, 75); ?>...</p>
                            <div class="btn" style="position: absolute; bottom: -50px;">
                                <a href="./blog.php?post_id=<?php echo $post['id']; ?>" class="btn btn-danger">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- WhatsApp Chat Connent Here! -->
    <div class="whatsapp_link bg-success p-2 rounded bordered"><a
            href="https://api.whatsapp.com/send?phone=233238651493&text=Hi%20CharlyCareCla$ic"><i
                class="fab fa-whatsapp fa-4x"></i></a></div>

    <!-- stop Blog Posts here -->
    <section class="culinary-delight">
        <div class="container">
            <div class="restaurant-info">
                <div class="restaurant-description padding-right animate-left">
                    <div class="global-headline">
                        <h2 class="sub-headline">
                            <span class="first-letter">C</span>harly
                        </h2>
                        <h1 class="headline headline-dark">Care Cla$ic</h1>
                        <div class="asterisk"><i class="fas fa asterisk"></i></div>
                    </div>
                    <p>CharlyCareCla$ic is a single family office that thrives on the ideology of inventing the life we
                        deserve through innovation and creativity. its hard to be different in a world where most are
                        conformist, indifferent and inconsistent. What if there could be a better way of living than the
                        world currently know?, we are sure there are much better ways to live a fulfilled life than ever
                        experienced. We do not conform to the status quo, even when status quo is working well.</p>
                    <a href="./login_signup/signup.php" class="btn body-btn">Register</a>
                </div>
                <div class="image-group">
                    <img class="animate-top" src="img/nature.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- culinary-delight ends -->
    <footer>
        <div class="container">
            <div class="back-to-top">
                <a href="#hero"><i class="fas fa-chevron-up"></i></a>
            </div>
            <div class="footer-content">
                <div class="footer-content-about animate-top">
                    <h4>About Charly Care Cla$ic</h4>
                    <div class="asterisk"><i class="fas fa-asterisk"></i></div>
                    <p>We drive our mission through a culture of excellence, constantly improving and winning with
                        integrity. Our approach and process is aimed at inventing the life we deserve through innovation
                        and creativity coupled with radical truthfulness and radical transparency.</p>
                </div>
                <!-- Add NEW here -->
                <section class="contact" id="contact">
                    <div class="content">
                        <div class="contactInfo animate-right">
                            <h3>Contact Us</h3>
                            <div class="contactInfoBx">
                                <div class="box">
                                    <div class="icon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="text">
                                        <h3>Address</h3>
                                        <p>190/B Castle Road<br>Accra | Ghana</p>
                                    </div>
                                </div>
                                <div class="box">
                                    <div class="icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="text">
                                        <h3>Phone</h3>
                                        <p>+23323-865-1493</p>
                                    </div>
                                </div>
                                <div class="box">
                                    <div class="icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="text">
                                        <h3>Email</h3>
                                        <p>charlycareclasic@gmail.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="formBx animate-top">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <h3>Message Us</h3>
                                <div class="alert <?php echo $errMsgClass; ?>"><?php echo $errMsg; ?></div>
                                <input type="text" name="contact_name" placeholder="Enter Full Name">
                                <input type="email" name="contact_email" placeholder="Enter Your Email">
                                <textarea name="contact_msg" placeholder="Your Message here"></textarea>
                                <input class="btn-block" type="submit" name="contactMsg" value="Send">
                            </form>
                        </div>
                    </div>
                </section>
                <!-- ended here -->
                <div class="footer-content-divider animate-bottom">
                    <div class="social-media">
                        <h4>follow along</h4>
                        <ul class="social-icons">
                            <li>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a
                                    href="https://www.facebook.com/107870477747419/posts/107872007747266/?substory_index=0&app=fbl"><i
                                        class="fab fa-facebook-square"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="https://gh.linkedin.com/in/charles-timothy-3998631a5"><i
                                        class="fab fa-linkedin-in"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="newsletter-container">
                        <h4>Newsletter</h4>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="newsletter-form" method="POST">
                            <input type="email" name="email" class="newsletter-input"
                                placeholder="Your email address..." required>
                            <button type="submit" name="newsletter" class="newsletter-btn">
                                <i class="fas fa-envelope"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <p style="color: #fff; font-weight:700; margin-top: 20px;">&copy; &nbsp;2020 charlycareclasic.com. All
                Rights Reserved.</p>
        </div>
    </footer>
    <!-- scroll reveal -->
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    <!-- typewriter effect -->
    <script src="./js/typewriter.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/comment_like.js"></script>
    <!-- OwlCarousel -->
    <script>
    $(".slider").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });
    </script>
    <script>
    // CKEDITOR.on('txtDescription', function (ev) {
    // ev.editor.dataProcessor.writer.setRules('br',
    //     {
    //         indent: false,
    //         breakBeforeOpen: false,
    //         breakAfterOpen: false,
    //         breakBeforeClose: false,
    //         breakAfterClose: false
    //     });
    // });

    // config.enterMode = CKEDITOR.ENTER_BR;
    // config.shiftEnterMode = CKEDITOR.ENTER_BR;
    </script>
</body>

</html>