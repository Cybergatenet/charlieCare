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
                <br><br><br>
                <p>Not A Member?</p>
            </div>

            <a href="./login_signup/signup.php"
                style="background-color: #eee; padding: 7px; margin-bottom: 10px; border-radius: 5px; color: #222;"
                class="btn body-btn">Register</a>

            <!-- WhatsApp Chat Connent Here! -->
            <div class="whatsapp_link bg-success p-2 rounded bordered"><a
                    href="https://api.whatsapp.com/send?phone=233238651493&text=Hi%20CharlyCareCla$ic"><i
                        class="fab fa-whatsapp fa-4x"></i></a></div>
            <!-- Add NEW here -->
            <section class="contact" id="contact">
                <div class="content">
                    <div class="contactInfo animate-right">
                        <h3 id="contactUs">Contact Us</h3>
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
                            <input type="text" name="contact_name" placeholder="Enter Full Name"
                                value="<?php echo $contact_name; ?>">
                            <input type="email" name="contact_email" placeholder="Enter Your Email"
                                value="<?php echo $contact_email; ?>">
                            <textarea name="contact_msg"
                                placeholder="Your Message here"><?php echo $contact_msg; ?></textarea>
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
                <!-- mobile Apps -->
                <div class="mobile">
                    <a href="#">
                        <img src="../img/PlayStore_2x.png" alt="Android App" title="Download our Android App Now">
                    </a>
                    <a href="#">
                        <img src="../img/AppleStore_2x.png" alt="Android App" title="Download our Android App Now">
                    </a>
                </div>
                <div class="newsletter-container">
                    <h4>Newsletter</h4>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="newsletter-form" method="POST">
                        <input type="email" name="email" class="newsletter-input" placeholder="Your email address..."
                            required>
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