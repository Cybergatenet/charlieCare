<?php
    session_start();
    
    require_once './config/db.php'; // connection here
    // require_once './server/sendEmail.php';
    require_once './server/newletter.php';

###############################################
// fetching posts here
$query_post = 'SELECT * FROM charlycare_posts ORDER BY post_time DESC';
$return_posts = mysqli_query($conn, $query_post);
$posts = array();

if(mysqli_num_rows($return_posts) > 0){
    while($row = mysqli_fetch_assoc($return_posts)){
        $posts[] = $row;
    }
}
############################################
// Ratings Settings
if(isset($_POST['rate'])){
    echo '<script>alert("Your Rating will be recorded soon", "'.$_POST['rate'].'")</script>';
}
###########################################
function formatText($resolution){
    // $resolution = trim($resolution);
    // $resolution = nl2br($resolution);
    // $resolution = stripslashes($resolution);
    // // $resolution = htmlentities($resolution);
    // // $resolution = htmlspecialchars($resolution);
    // $resolution = str_replace('rnrn',"",str_replace(' rn',"",$resolution));
    // $resolution = str_replace('\r',"\r",str_replace('\n',"\n",$resolution));
    // $resolution = str_replace('\\r',"\r",str_replace('\\n',"\n",$resolution));
    // $resolution = str_replace('\\\r',"\r",str_replace('\\\n',"\n",$resolution));
    // $resolution = str_replace('\\\\', "\r", str_replace('\\\\',"\n",$resolution));
    // $resolution = str_replace('\\ \\', "\r", str_replace('\\ \\',"\n",$resolution));
    // return $resolution;
    ###################################################################
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CharlyCareCla$ic is a single family office that thrives on the ideology of inventing the life we 
    deserve through innovation and creativity.">
    <meta name="keywords"
        content="Charly, CharlyCare, CharlyCareCla$ic, Forex, Online Trading, Investment, Foreign exchange">
    <meta name="author" content="Designed by cybergate communication network">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HomePage | CharlyCareCla$ic</title>
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
    <!-- Bootstrap Styles Added here -->
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <!-- NEW Styles Added here -->
    <link rel="stylesheet" type="text/css" href="./css/new_styles.css">
    <link rel="stylesheet" type="text/css" href="./css/blog.css">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="stylesheet" type="text/css" href="./css/rating.css">
    <style type="text/css">
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
                    <a href="./index.php" class="logo"><img src="./img/charlyLogo22.png" alt="logo" width="20px"
                            height="40px"></a>
                    <div class="main-title">
                        <h2 class="header-title"> CharlyCareCla$ic</h2>
                        <small class="header-small">Family Office</small>
                    </div>
                </div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="./about.html" onclick="alert('Oop!..offline for maintenance!');" class="nav-link">About
                            Us</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="./login_signup/login.php"
                            class="nav-link"><?php echo isset($_SESSION['username']) ? 'Log Out' : 'Log In'; ?>
                        </a>
                    </li> -->
                </ul>
            </nav>
        </div>
    </header>
    <!-- header ends here -->
    <!-- starting header -->
    <div class="container">
        <div class="clip clip1">
            <div class="content">
                <h2>Our Mission</h2>
                <p>Inventing the life we deserve <br> through innovation and creativity</p>
            </div>
        </div>
    </div>
    <!-- ending here -->
    <section class="hero" id="hero">
        <div class="container">
            <h2 class="sub-headline" style="margin-top: 40px;">
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
                    <a href="./about.html" class="btn cta-btn">Explore</a>
                </div>
            </div>
        </div>
    </section>

    <section class="discover-our-story">
        <div class="container">
            <div class="restaurant-info">
                <div class="restaurant-description padding-right animate-left">
                    <div class="global-headline">
                        <h2 class="sub-headline">
                            <span class="first-letter">C</span>harly
                        </h2>
                        <h1 class="headline headline-dark">Care Cla$ic</h1>
                        <div class="asterisk"><i class="fas fa-asterisk"></i></div>
                    </div>
                    <p>CharlyCareCla$ic is a single family office that thrives on the ideology of inventing the life we
                        deserve through innovation and creativity. Its hard to be different in a world where most
                        are conformist, indifferent and inconsistent. What if there could be a better way of living
                        than the world currently know?, we are sure there are much better ways to live a fulfilled life
                        than
                        ever experienced. We do not conform to the status quo, even when status quo is working well.</p>
                </div>
                <div class="restaurant-info-img animate-right">
                    <img src="./img/globe.jpg" alt="">
                </div>
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
                            <p><?php echo substr(formatText($post['post_body']), 0, 100); ?>...</p>
                            <div class="btn" style="position: absolute; bottom: 5%;">
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

    <section class="work" id="work">
        <div class="container">
            <div class="heading">
                <h2>Watch Our videos</h2>
                <p>Learn more by watching our classic videos</p>
            </div>
            <div class="content">
                <div class="serviceBx animate-left">
                    <video class="video" src="./video/charlycareclacis.mp4" poster="" width="100%" controls></video>
                    <h2>Charlycareclasic</h2>
                    <p>Welcome to Charlycareclasic. Where we invent the life we deserve through innovation and
                        creativity.</p>
                </div>
            </div>
            <hr>
            <div class="heading d-grid" id="sponsor">
                <a href="#sponsor" class="btn">View More Contents <i class="fa fa-arrow-down"></i> </a>
                <br>
                <div class="book_cover">
                    <div class="btn animateBtn animate-left" title="Click here to view valid relationship on facebook">
                        <a href="https://m.facebook.com/Valid-Relationship-342407303221634/?ref=bookmarks"
                            target="_blank" rel="noopener noreferrer" class="btn btn-primary font-weight-bold">
                            <img src="./img/validRelationship3.jpeg" alt="The Flipped Mind">
                            <div>
                                <i class="fas fa-users"></i>
                                &nbsp; Valid Relationship
                            </div>
                        </a>
                    </div>
                    <div class="hover_book animateBtn animate-right m-4"
                        title="Click here to view download The Flipped Mind">
                        <img id="bookCover" src="./img/bookCompress.jpg" alt="The Flipped Mind">
                        <div class="d-flex flex-row mb-3">
                            <div class="d-flex flex-column">
                                <a href="./books/THE FLIPPED MIND.pdf" target="_blank">
                                    <button class="btn btn-primary m-3">Download</button>
                                </a>
                                <h5 class="text-white font-weight-bold pl-4"><span id="review">1000</span>+ Downloads
                                </h5>
                            </div>
                            <div class="d-flex flex-column">
                                <button onclick="toggle();" class="btn btn-info m-3">Rate This Book</button>
                                <h5 class="text-white font-weight-bold pl-4"><span id="review">1000</span>+ Reviews</h5>
                                <div class="stars-outer ml-4">
                                    <div class="stars-inner"></div>
                                    <span class="number-rating text-white pl-5">4.7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Ended here -->
    <!-- #@##############################  NewsLetter ########################## -->
    <div class="newsletter">
        <h2>Rate this Book</h2>
        <p>Take a quick Review</p>
        <div class="inputBox">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-group" method="POST">
                <input type="number" id="rating-control" class="form-control" step="0.1" max="5"
                    placeholder="Rate 1 - 5" disable="false">

                <input type="submit" id="rate" name="rate" class="btn btn-primary rounded font-weight-bold p-2"
                    value="Rate">
            </form>
        </div>
        <img src="./img/close.png" class="close" onclick="toggle();" alt="close icon">
    </div>
    <!-- #@##############################  NewsLetter ########################## -->
    <!-- Adding Footer -->
    <?php include_once('./inc/footer_home.php'); ?>

    <!-- scroll reveal -->
    <!-- <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script> -->
    <!-- typewriter effect -->
    <script src="./js/typewriter.js"></script>
    <script src="./js/main.js"></script>
    <script>
    // init alert box
    function toggle() {
        var newsletter = document.querySelector('.newsletter');
        newsletter.classList.toggle('active');
    }
    </script>
    <script src="./js/rating.js"></script>
    <!-- OwlCarousel -->
    <script>
    $(".slider").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });
    </script>
</body>

</html>