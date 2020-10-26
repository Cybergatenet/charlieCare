<?php
    // session_start();

    require_once '../login_signup/controllers/authcontroller.php';

    if(!$_SESSION){
        header('location: ../login_signup/login.php');
        exit();
    }

//Avaliable Variables 
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $verified = $_SESSION['verified'];

    $sql = 'SELECT * FROM charlycare_users WHERE email=? OR username=? LIMIT 1';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();


########################################
    // inserting and fetching image
    // check for submit
    $msg = '';
    $msgClass = '';
    // function validate_input($input){
    //     $input = htmlspecialchars($input);
    //     $input = trim($input);
    //     $input = stripslashes($input);
    //     return $input;
    // }
	if(isset($_POST[''])){
        $username = mysqli_real_escape_string($conn, validate_input($_POST['username']));
        $email = mysqli_real_escape_string($conn, validate_input($_POST['email']));
    ###password settings
        $pwd = mysqli_real_escape_string($conn, validate_input($_POST['pwd']));
        $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $phone = mysqli_real_escape_string($conn, validate_input($_POST['phone']));
        $address = mysqli_real_escape_string($conn, validate_input($_POST['address']));
        $state = mysqli_real_escape_string($conn, validate_input($_POST['state']));
        $country = mysqli_real_escape_string($conn, validate_input($_POST['country']));
        $bio_data = mysqli_real_escape_string($conn, validate_input($_POST['bio_data']));
        // $avatar = 'defaultAvatar.png'; // sanitize pics before uplaod
        // $image = validat_image($_FILES['fileToUpload']['name']);
		$target = "../uploads/".basename($_FILES['fileToUpload']['name']);
        $avatar = $_FILES['fileToUpload']['name'];
        
        $password = isset($_POST['pwd']) ? $hash_pwd : $user['pwd'];

    
     $sql = "UPDATE `charlycare_users` SET `pwd` = '$password', `phone` = '$phone', `address` = '$address', `state` = '$state', `country` = '$country', `bio_data` = '$bio_data', `avatar` = '$avatar' WHERE `email` = '$email'";
    
    //  $sql = "UPDATE `charlycare_users` SET `pwd` = ?, `phone` = ?, `address` = ?, `state` = ?, `country` = ?, `bio_data` = ?, `avatar` = ? WHERE `email` = ?";

    //  $stmt = $conn->prepare($sql);
    //  $stmt->bind_param('ssssssss', $hash_pwd, $phone, $address, $state, $country, $bio_data, $avatar, $email);
    //  $stmt->execute();

     
###		

		if(mysqli_query($conn, $sql)){
			$imagery = "UPDATE `charlycare_users` SET `avatar` = '$avatar' WHERE `charlycare_users`.`email` = '$email'";
			if(mysqli_query($conn, $imagery)){
				/// sending image into the image folder
				if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target)){
			// upload was successful
                    $msg = 'Record updated successfully';
                    $msgClass = 'alert-success';
				}else{
					$msg = 'Your image did NOT uploaded';
					$msgClass = 'alert-danger';
				}
			}else{
			// Error occured during second upload
				$msg = 'Error! Upload incomplete. Try Again';
				$msgClass = 'alert-danger';
			}			
		}else{
			// echo 'ERROR: '.mysqli_error($conn);
			$msg = 'An Error occurred during the uplaod. Try Again';
			$msgClass = 'alert-danger';
		}
	}


// 	function validat_image($inputIMG){
// 		$target_dir = "../uploads/";
// 		$target_file = $target_dir . basename($inputIMG);
// 		$uploadOk = 1;
// 		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// 		// Check if image file is a actual image or fake image
// 		// if(isset($_POST["submit"])) {
// 		    $check = getimagesize($inputIMG);
// 		    if($check !== false) {
// 		        $msg = "File is an image - " . $check["mime"] . ".";
// 				$msgClass = 'alert-success';
// 		        $uploadOk = 1;
// 		    } else {
// 		        $msg = "File is not an image.";
// 		        $msgClass = 'alert-danger';
// 		        $uploadOk = 0;
// 		    }
// 		// }
// 		// Check if file already exists
// 		if (file_exists($target_file)) {
// 		    $msg = "Sorry, file already exists.";
// 			$msgClass = 'alert-danger';		    
// 		    $uploadOk = 0;
// 		}
// 		// Check file size
// 		if ($_FILES["fileToUpload"]["size"] > 500000) {
// 		    $msg = "Sorry, your file is too large.";
// 			$msgClass = 'alert-danger';
// 		    $uploadOk = 0;
// 		}
// 		// Allow certain file formats
// 		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// 		&& $imageFileType != "gif" ) {
// 		    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
// 			$msgClass = 'alert-danger';			
// 		    $uploadOk = 0;
// 		}
// 		// Check if $uploadOk is set to 0 by an error
// 		if ($uploadOk == 0) {
// 		    $msg = "Sorry, your file was not uploaded.";
// 			$msgClass = 'alert-danger';		    
// 		// if everything is ok, try to upload file
// 		} else {
// 		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
// 		        $msg = "The file ". basename($inputIMG). " has been uploaded.";
// 				$msgClass = 'alert-success';
// 		        // header('Location: index_merge.php');

// 		    } else {
// 		        $msg = "Sorry, there was an error uploading your file.";
// 				$msgClass = 'alert-danger';
// 		    }
// 		}
// }
    

######################################
    //  mysql --host=us-cdbr-east.cleardb.com --user=b280ac36b578f6 --password=eaa82564 --reconnect heroku_4046d464e26fbe3 < charlycare_users.sql 

    // $username = 'b280ac36b578f6';
    // $passwrod = 'eaa82564';
    // $server = ' heroku_4046d464e26fbe3';
    // $db = 'us-cdbr-east-02.cleardb.com';

    ### git push --repo https://Cybergatenet:abchej3647CHINEDU@bitbucket.org/Cybergatenet/repo.git

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
    <title>User DashBoard | charlycareclasic</title>
    <!-- linking jQuery -->
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <!-- bootstrap here -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <!-- fontAwesome -->
    <link rel="stylesheet" href="../css/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/new_styles.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/user.css">
    <!-- AJAX jQuery script here -->
    <!-- <script> -->
        <!-- // $(document).ready(function() {
        //     let phone = document.querySelector('phone');
        //     let address = document.querySelector('address');
        //     let state = document.querySelector('state');
        //     let country = document.querySelector('country');
        //     let bio_data = document.querySelector('bio_data');
        //     let pwd = document.querySelector('pwd');
        //     let fileToUpload = document.querySelector('fileToUpload');
        // // get email
        //     let email = document.querySelector('user-mail');

        //     $("#updateSettings").click(function() {
        //         $(".wrapper").load("load-settings.php", {
        //             email: email,
        //             phone: phone,
        //             address: address,
        //             state: state,
        //             country: country,
        //             bio_data: bio_data,
        //             pwd: pwd
        //             // fileToUpload: fileToUpload.val()
        //         });
        //         console.log('updateSettings button clicked');
        //     });
        // }); -->
    <!-- </script> -->
</head>
<body>
    <div id="hero"></div>
    <header style="background-color: #e40046; padding-top: 0px; box-shadow: 0px -3px 3px rgba(0, 0, 288, .9) inset;"> <!--initial-red=#e40046 || blue=#2196f3;-->
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
                    <a href="../index.html" class="logo"><img src="../img/charlyLogo22.png" alt="" width="70px"
                            height="50px"></a>
                    <div class="main-title">
                        <h2 class="header-title">CharlyCareCla$ic</h2>
                        <small class="header-small">Family Office</small>
                    </div>
                </div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="../index.html" class="nav-link">Home</a>
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
    <div class="wrapper" style="margin-top: 20px;">
        <div class="profile-header">
            <div class="profile-img">
                <!-- <img src="../img/user.png" width="200px" alt=""> -->
                <img src="../uploads/<?php echo $user['avatar']; ?>" width="200px" alt="No image record. Enter New image">
            </div>
            <div class="profile-nav-info">
                <h3 class="user-name"><?php echo $username; ?></h3>
                <div class="address">
                    <p class="state"><?php echo $user['state']; ?></p>
                    <span class="country"><?php echo $user['country']; ?></span>
                </div>
            </div>
            <div class="profile-option">
                <div class="notification">
                    <i class="fa fa-bell"></i>
                    <span class="alert-msg">1</span> <!-- function to return chat msg_numbers -->
                </div>
            </div>
        </div>
        <div class="main-bg">
            <div class="left-side">
                <div class="profile-side">
                    <p class="mobile-no"><i class="fa fa-phone"></i><?php echo $user['phone']; ?></p>
                    <p class="user-mail"><i class="fa fa-envelope"></i><?php echo $user['email']; ?></p>
                    <div class="user-bio">
                        <h3>Bio-Data</h3>
                        <p class="bio"><?php echo $user['bio_data']; ?></p>
                    </div>
                    <div class="profile-btn">
                        <button class="chatBtn" onclick="redirect()"><i class="fa fa-comment"></i>Chat</button>
                        <button class="createBtn"><i class="fa fa-plus"></i>Create</button>
                    </div>
                    <div class="user-rating">
                        <h3 class="rating">4.3</h3>
                        <div class="rate">
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="no-user">
                                <span>2</span>&nbsp;&nbsp;Reviews
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-side">
                <div class="navs">
                    <ul class="ul">
                        <li onclick="tabs(0);" class="user-post active">Posts</li>
                        <li onclick="tabs(1);" class="user-review">Reviews</li>
                        <li onclick="tabs(2);" class="user-setting">Settings</li>
                    </ul>
                </div>
                <div class="profile-body">
                    <div class="profile-posts tab">
                        <h1>Your Posts</h1>
                        <p>There are no post yet. All Your posts will show here. Review Our terms of use to see how you can create your own posts</p>
                        <button class="chatBtn"><i class="fa fa-plus"></i>Add Post</button>
                    </div>
                    <div class="profile-review tab">
                        <h1>User Reviews</h1>
                        <p>Your Reviews will be displayed here. Contact CharlyCareCla$ic Family Office for more details</p>
                        <button class="chatBtn"><i class="fa fa-plus"></i>Add Review</button>
                    </div>
                    <div class="profile-setting tab">
                        <h1>Account Settings</h1>
                        <p>Make changes to your profile</p>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-group" enctype="multipart/form-data">
                            <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
                            <div class="form-div-div">
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone Number" value="<?php echo $user['phone']; ?>">
                                <!-- <input type="button" class="updateBtn" value="Update Contact"> -->
                            </div>
                            <div class="form-div-div">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Your Contact Address" value="<?php echo $user['address']; ?>">
                                <!-- <input type="button" class="updateBtn" value="Update Address"> -->
                            </div>
                            <div class="form-div-div">
                                <input type="text" class="form-control" id="state" name="state" placeholder="Enter Your State" value="<?php echo $user['state']; ?>">
                                <!-- <input type="button" class="updateBtn" value="Update State"> -->
                            </div>
                            <div class="form-div-div">
                                <input type="text" class="form-control" id="country" name="country" placeholder="Enter Your Country" value="<?php echo $user['country']; ?>">
                                <!-- <input type="button" class="updateBtn" value="Update Country"> -->
                            </div>
                            <div class="form-div-div">
                                <textarea class="form-control" id="bio_data" name="bio_data" placeholder="Update Your Bio-data"><?php echo $user['bio_data']; ?></textarea>
                                <!-- <input type="button" class="updateBtn" value="Update Bio-data"> -->
                            </div>
                            <div class="form-div-div">
                                <input type="password" id="pwd" name="pwd" class="form-control" placeholder="Enter Your New Password" value="">
            <!-- button for show-hide password -->
                                <!-- <span class="fa fa-eye"></span> -->
                                <!-- <input type="button" class="updateBtn"  value="Change Password"> -->
                            </div>
                <!-- New image upload preview -->
                    <div class="img_container">
                        <div class="img_wrapper">
                            <div class="image">
                                <img src="" alt="" id="img-preview">
                            </div>
                            <div class="img_content">
                                <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div class="class">No file chosen, yet!</div>
                            </div>
                            <div id="cancel-btn"><i class="fas fa-times"></i></div>
                            <div class="file-name">File name here</div>
                        </div>
                        <input id="default-btn" name="fileToUpload" type="file" hidden> <!---id="fileToUpload"-->
                        <button type="button" onclick="defaultBtnActive()" id="custom-btn">choose a file</button>
                    </div>
                    <br><br>
                            <button type="submit" class="chatBtn" id="updateSettings" name="submit"><i class="fa fa-plus"></i>Update All</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- including footer here -->
    <footer style="margin-top: 50px;">
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
                        and creativity coupled with radical truthfulness and radical transparency</p>
                </div>
                <!-- Add NEW here -->
                <section class="contact" id="contact">
                    <!-- <div class="heading white animate-left">
                        <h2>Contact Us</h2>
                        <p>Contact us using any of the following links below</p>
                    </div> -->
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
                            <form>
                                <h3>Message Us</h3>
                                <input type="text" name="" placeholder="Full Name">
                                <input type="email" name="" placeholder="Enter Your Email">
                                <textarea placeholder="Your Message here"></textarea>
                                <input class="btn-block" type="submit" name="" value="Send">
                            </form>
                        </div>
                    </div>
                </section>
                <!-- ended here -->
                <div class="footer-content-divider animate-bottom">
                    <div class="social-media">
                        <h4>Follow along</h4>
                        <ul class="social-icons">
                            <li>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/107870477747419/posts/107872007747266/?substory_index=0&app=fbl"><i class="fab fa-facebook-square"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-github-square"></i></a>
                            </li>
                            <li>
                                <a href="https://gh.linkedin.com/in/charles-timothy-3998631a5"><i class="fab fa-linkedin-in"></i></a>
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
            <p style="color: #fff; font-weight:700; margin-top: 20px;">&copy; &nbsp;2020 charlycareclasic.com. All Rights Reserved.</p>
        </div>
    </footer>
    <!-- END including footer here -->
    <!-- link jqery here -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- <script src="../js/main.js"></script> -->
    <script src="../js/user.js"></script>
    <script>
        function redirect(){
            window.location.href = './chat.html';
        }
    </script>
</body>
</html>