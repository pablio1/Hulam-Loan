<?php
session_start();
error_reporting(0);
include('db_connection/config.php');
?>


<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hulam Loan</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/finloans/img/Hulam_Logo.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/finloans/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/finloans/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/finloans/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/finloans/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/finloans/css/themify-icons.css">
    <link rel="stylesheet" href="assets/finloans/css/nice-select.css">
    <link rel="stylesheet" href="assets/finloans/css/flaticon.css">
    <link rel="stylesheet" href="assets/finloans/css/gijgo.css">
    <link rel="stylesheet" href="assets/finloans/css/animate.min.css">
    <link rel="stylesheet" href="assets/finloans/css/slick.css">
    <link rel="stylesheet" href="assets/finloans/css/slicknav.css">

    <link rel="stylesheet" href="assets/finloans/css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.php">
                                    <img src="assets/finloans/img/hulam.png" alt="h-20px" width="100%">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.php">home</a></li>
                                            <li><a href="loan.php">Loan</a></li>
                                            <li><a href="#about">about</a></li>
                                            <!-- <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="apply.php">apply loan</a></li>
                                                    <li><a href="elements.php">elements</a></li>
                                                </ul>
                                            </li> -->
                                            <li><a href="FAQ.php">FAQ</a></li>
                                            <li><a href="#contact">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-l-3 col-lg-4">
                                <div class="Appointment">
                                    <div class="phone_num d-none d-xl-block">
                                        <a href="#"> <i class="fa fa-phone"></i> +63 9454909530</a>
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <a class="boxed-btn4" href="sign_up.php">Sign-Up</a>
                                    </div>&nbsp;&nbsp;
                                    <div class="d-none d-lg-block">
                                        <a class="boxed-btn4" href="login.php">Log-In</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1">
            <div class="container">
                <?php
                $sql = $dbh->prepare("SELECT * FROM user WHERE token = :token");
                $sql->execute(['token' => $_GET['token']]);
                $user = $sql->fetch(); 

                if ($sql->rowCount() > 0) :
                    $sql = $dbh->prepare("UPDATE user SET status = 'verified', token = '' WHERE token = :token");
                    $sql->execute(['token' => $_GET['token']]);
                ?>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-8">
                            <div class="payment_form white-bg wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">
                                <div class="info text-center">
                                    <p>Welcome <?= $user['firstname'] ?>. Thank you for verifying your account, you may now login your account<span></span></p>
                                    <div class="submit_btn">
                                        <a href="login.php">
                                            <button class="boxed-btn3">Login</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-7 col-md-6">
                            <div class="slider_text">
                                <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".1s">Create an account as</h3>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $sql = "SELECT * FROM user_type WHERE user_name != 'Admin'";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $result = $query->fetchAll();
                        foreach ($result as $user) :
                        ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="payment_form white-bg wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">
                                    <div class="info text-center">
                                        <p><?php echo $user['user_name']; ?><span></span></p>
                                        <div class="submit_btn">
                                            <a href="sign_up2.php?id=<?php echo $user['id']; ?>">
                                                <button class="boxed-btn3" type="submit">Sign Up</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->

     <!-- footer start -->
     <footer class="footer" id="contact">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="assets/finloans/img/hulam.png" alt="h-20px" width="50%">
                                </a>
                            </div>
                            <p>
                                hulamloan@gmail.com <br>
                                +63 945 490 9530 <br>
                                Mactan, Lapu-Lapu City Cebu 6015
                            </p>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".4s">
                            <h3 class="footer_title">
                                Services
                            </h3>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".5s">
                            <h3 class="footer_title">
                                Useful Links
                            </h3>
                            <ul>
                                <li><a href="#about">About</a></li>
                                <!-- <li><a href="#">Blog</a></li> -->
                                <li><a href="#contact"> Contact</a></li>
                                <!-- <li><a href="#">Support</a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".6s">
                            <h3 class="footer_title">
                                Subscribe
                            </h3>
                            <form action="#" class="newsletter_form">
                                <input type="text" placeholder="Enter your mail">
                                <button type="submit">Subscribe</button>
                            </form>
                            <p class="newsletter_text">You may send us your email if you wish to receive a newsletter for the updates of loan rates.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".3s">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="index.php" target="_blank">The Hulam Team</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/ footer end  -->

    <!-- link that opens popup -->
    <!-- JS here -->
    <script src="assets/finloans/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="assets/finloans/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/finloans/js/popper.min.js"></script>
    <script src="assets/finloans/js/bootstrap.min.js"></script>
    <script src="assets/finloans/js/owl.carousel.min.js"></script>
    <script src="assets/finloans/js/isotope.pkgd.min.js"></script>
    <script src="assets/finloans/js/ajax-form.js"></script>
    <script src="assets/finloans/js/waypoints.min.js"></script>
    <script src="assets/finloans/js/jquery.counterup.min.js"></script>
    <script src="assets/finloans/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/finloans/js/scrollIt.js"></script>
    <script src="assets/finloans/js/jquery.scrollUp.min.js"></script>
    <script src="assets/finloans/js/wow.min.js"></script>
    <script src="assets/finloans/js/nice-select.min.js"></script>
    <script src="assets/finloans/js/jquery.slicknav.min.js"></script>
    <script src="assets/finloans/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/finloans/js/plugins.js"></script>
    <script src="assets/finloans/js/gijgo.min.js"></script>
    <script src="assets/finloans/js/slick.min.js"></script>



    <!--contact js-->
    <script src="assets/finloans/js/contact.js"></script>
    <script src="assets/finloans/js/jquery.ajaxchimp.min.js"></script>
    <script src="assets/finloans/js/jquery.form.js"></script>
    <script src="assets/finloans/js/jquery.validate.min.js"></script>
    <script src="assets/finloans/js/mail-script.js"></script>

    <script src="assets/finloans/js/main.js"></script>
</body>

</html>