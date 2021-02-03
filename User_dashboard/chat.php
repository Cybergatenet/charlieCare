<?php
    require_once '../login_signup/controllers/authcontroller.php';

    if(!$_SESSION){
        header('location: ../login_signup/login.php');
        exit();
    }

////////////////////////////////////////////////////////////
    ##      Fetching all Users
    $sql = 'SELECT * FROM charlycare_users';

    $stmt = $conn->prepare($sql);
    // $stmt->bind_param('ss', $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_all();

///////////////////////////////////////////////////////////


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
    <link rel="icon" href="../img/charlyLogo22.png">
    <title>User ChatRoom | charlycareclasic</title>
    <!-- linking font-awesome -->
    <link rel="stylesheet" href="../css/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <!-- linking all css files here -->
    <link rel="stylesheet" href="../css/chat.css">
    <style>
    header {
        background-color: #2196f3;
        padding-top: 0px;
        padding-bottom: 0px;
        box-shadow: 0px -3px 3px rgba(0, 0, 288, .9) inset;
    }

    .show {
        position: relative;
    }

    .fa-eye {
        position: relative;
        top: -33px;
        right: -40%;
        font-size: 3rem;
        font-weight: 900;
        text-align: right;
        cursor: pointer;
    }

    .fa-eye:active {
        font-weight: 700;
        transform: scale(0.92);
    }

    @media (max-width: 500px) {
        .fa-eye {
            top: -20px;
            right: -40%;
            font-size: 1.5rem;
            font-weight: 700;
        }
    }
    </style>
</head>

<body>
    <!-- adding header and Nav here -->
    <header>
        <!--initial-red=#e40046 || blue=#2196f3;-->
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
                    <a href="../index.php" class="logo"><img src="../img/charlyLogo22.png" alt="" width="70px"
                            height="50px"></a>
                    <div class="main-title">
                        <h2 class="header-title">CharlyCareCla$ic</h2>
                        <small class="header-small">Family Office</small>
                    </div>
                </div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="../about.html" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="../login_signup/login.php?logout=true" class="nav-link active">Log Out</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- header ends here -->
    <!-- adding header and Nav here -->

    <div id="chat-container">
        <div id="search-container">
            <i class="fas fa-users fa-2x" id="userIcon"></i>
            <input type="text" class="input" placeholder="search users">
            <div class="autocom-box">
                <!-- <li>Abraham Isreal</li>
                <li>Cybergate Abel</li>
                <li>Cybergatenet Chinedu</li>
                <li>Vania Priceness</li>
                <li>Favour Cindy</li>
                <li>Praise Nwaoke</li> -->
            </div>
            <!-- <img src="../img/database_search.png" class="chat-icon" alt="search-box"> -->
            <i class="fas fa-search fa-2x"></i>
        </div>
        <div id="conversation-list">
            <div class="conversation active">
                <img src="../uploads/defaultAvatar.png" alt="Cybergate Abel">
                <div class="title-text">
                    Cybergate Communication Network
                </div>
                <div class="created-date">
                    Mar 18
                </div>
                <div class="conversation-message">
                    This is my chat room app. To be deployed really soon
                </div>
            </div>
            <div class="conversation">
                <img src="../uploads/defaultAvatar.png" alt="Cybergate Abel">
                <div class="title-text">
                    Cybergate Abel
                </div>
                <div class="created-date">
                    Mar 18
                </div>
                <div class="conversation-message">
                    I already love this app
                </div>
            </div>
            <div class="conversation">
                <img src="../uploads/defaultAvatar.png" alt="Cybergate Abel">
                <div class="title-text">
                    Abel Chinedu
                </div>
                <div class="created-date">
                    Mar 18
                </div>
                <div class="conversation-message">
                    chat room app. To be deployed really soon
                </div>
            </div>
            <div class="conversation">
                <img src="../uploads/defaultAvatar.png" alt="Cybergate Abel">
                <div class="title-text">
                    Network worker
                </div>
                <div class="created-date">
                    Mar 18
                </div>
                <div class="conversation-message">
                    Great App
                </div>
            </div>
            <div class="conversation">
                <img src="../uploads/defaultAvatar.png" alt="Cybergate Abel">
                <div class="title-text">
                    Full Crud functionality
                </div>
                <div class="created-date">
                    Mar 18
                </div>
                <div class="conversation-message">
                    To be deployed really soon
                </div>
            </div>
            <div class="conversation">
                <img src="../uploads/defaultAvatar.png" alt="Cybergate Abel">
                <div class="title-text">
                    Cyergatenet Network
                </div>
                <div class="created-date">
                    Mar 18
                </div>
                <div class="conversation-message">
                    This is my chat room app. To be deployed really soon
                </div>
            </div>
            <div class="conversation">
                <img src="../uploads/defaultAvatar.png" alt="Cybergate Abel">
                <div class="title-text">
                    Cyergate Communication Network
                </div>
                <div class="created-date">
                    Mar 18
                </div>
                <div class="conversation-message">
                    This is my chat room app. To be deployed really soon
                </div>
            </div>
            <div class="conversation">
                <img src="../uploads/defaultAvatar.png" alt="Cybergate Abel">
                <div class="title-text">
                    Cyergate Communication Network
                </div>
                <div class="created-date">
                    Mar 18
                </div>
                <div class="conversation-message">
                    This is my chat room app. To be deployed really soon
                </div>
            </div>
            <div class="conversation">
                <img src="../uploads/defaultAvatar.png" alt="Cybergate Abel">
                <div class="title-text">
                    Cyergate Communication Network
                </div>
                <div class="created-date">
                    Mar 18
                </div>
                <div class="conversation-message">
                    This is my chat room app. To be deployed really soon
                </div>
            </div>
        </div>
        <div id="new-message-container">
            <a href="#"><i class="fas fa-plus"></i></a>
        </div>
        <div id="chat-title">
            <small>CharlyCare User</small>
            <i class="fas fa-user"></i>
        </div>
        <div id="chat-message-list">
            <div class="message-row you-message">
                <div class="message-content">
                    <div class="message-text">Okay dear</div>
                    <div class="message-time">Dec 15</div>
                </div>
            </div>
            <div class="message-row other-message">
                <div class="message-content">
                    <img src="../uploads/defaultAvatar.png" alt="profilePic">
                    <div class="message-text">I never belived that i will get this far in Coding and programming in
                        general. But see how far we have gone and God has been faithful to me in all my dealings. Praise
                        be to HIS Holy NAme forever, Amen</div>
                    <div class="message-time">Dec 16</div>
                </div>
            </div>
            <div class="message-row you-message">
                <div class="message-content">
                    <div class="message-text">Good evening</div>
                    <div class="message-time">Dec 15</div>
                </div>
            </div>
            <div class="message-row other-message">
                <div class="message-content">
                    <img src="../uploads/defaultAvatar.png" alt="profilePic">
                    <div class="message-text">I will finish this app tonight</div>
                    <div class="message-time">Dec 16</div>
                </div>
            </div>
            <div class="message-row you-message">
                <div class="message-content">
                    <div class="message-text">its an assurance</div>
                    <div class="message-time">Dec 15</div>
                </div>
            </div>
            <div class="message-row other-message">
                <div class="message-content">
                    <img src="../uploads/defaultAvatar.png" alt="profilePic">
                    <div class="message-text">I have challenged myself</div>
                    <div class="message-time">Dec 16</div>
                </div>
            </div>
            <!-- Ajax call fetch and dump data -->
            <!-- <div class="message-row other-message">
                <div class="message-content">
                    <img src="../uploads/defaultAvatar.png" alt="profilePic" class="chat-image">
                    <div class="chat-message-text"></div>
                    <div class="chat-message-time">1m ago</div>
                </div>
            </div> -->
        </div>
        <div id="chat-form">
            <input type="text" id="msgdata" placeholder="Type a message" autofocus>
            <button type="submit" id="sendData" name="send"><i class="fas fa-paper-plane fa-3x"></i></button>
        </div>
    </div>

    <!-- END including footer here -->

    <!-- ##################################################### -->
    <!-- <a href="#" onclick="toggle();">Notify Me!</a> -->

    <!-- <div class="newsletter">
        <h2>Stay Tuned</h2>
        <p>Get notified at launch</p>
        <div class="inputBox">
            <form action="./server/email.php" method="POST">
                <input type="email" name="" placeholder="Enter Email Address" required>
                <input type="submit" value="Submit">
            </form>
        </div>
        <img src="img/close.png" class="close" onclick="toggle();" alt="cybergate close">
    </div> -->

    <script>
    // fixing header on the top on scroll
    // function scrollPage(){
    //     document.querySelector('.scroll').classList.toggle('scrollpage');
    // }
    // init alert box
    // function toggle(){
    //     var newsletter = document.querySelector('.newsletter');
    //     newsletter.classList.toggle('active');
    // }

    // init count down
    // var countDate = new Date('Jan 1, 2021 00:00:00').getTime();

    // function newYear(){
    //     var now = new Date().getTime();
    //         gap = countDate - now;

    //         var second = 1000;
    //         var minute = second * 60;
    //         var hour = minute * 60;
    //         var day = hour * 24;

    //     var d = Math.floor(gap / (day));
    //     var h = Math.floor((gap % (day)) / (hour));
    //     var m = Math.floor((gap % (hour)) / (minute));
    //     var s = Math.floor((gap % (minute)) / second);

    //     document.getElementById('day').innerText = d;
    //     document.getElementById('hour').innerText = h;
    //     document.getElementById('minute').innerText = m;
    //     document.getElementById('second').innerText = s;

    // }

    // setInterval(function(){
    //         newYear();
    //     },1000);
    </script>
    <!-- ######################################################### -->

    <!-- link jqery here -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- <script src="../js/main.js"></script> -->

    <script src="../js/main.js"></script>
    <script src="../js/chat_suggestions.js"></script>
    <script src="../js/chat.js"></script>
</body>

</html>