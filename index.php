<?php
session_start();

if (isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] == 1) {
        header('location: admin/index.php');
    }
    if ($_SESSION['user_type'] == 2) {
        header('location: debtor/index.php');
    }
    if ($_SESSION['user_type'] == 3) {
        header('location: lending_company/index.php');
    }
    if ($_SESSION['user_type'] == 4) {
        header('location: individual_investor/index.php');
    }
    if ($_SESSION['user_type'] == 5) {
        header('location: payment_center/index.php');
    }
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>HULAM LOAN</title>
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
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.php">
                                        <img src="assets/finloans/img/h_logo2.png" alt="h-20px" width="100%">
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
                                            <li><a href="#faq">FAQ</a></li>
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
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="slider_text">
                            <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".1s">Get your Salary Loan here!</h3>
                            <div class="sldier_btn wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">
                                <a href="#how" class="boxed-btn3">How it Works</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->

    <!-- service_area_start  -->
    <div class="service_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-90">
                        <span class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s"></span>
                        <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">What we offer for you</h3>
                        <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">We offer a platform where debtors and lending investors.</p>
                        <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">interact as a business partner.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single_service wow fadeInLeft" data-wow-duration="1.2s" data-wow-delay=".5s">
                        <div class="service_icon_wrap text-center">
                            <div class="service_icon ">
                                <img src="assets/finloans/img/svg_icon/service_1.png" alt="">
                            </div>
                        </div>
                        <!-- <div class="info text-center">
                            <span>Home Loan</span>
                            <h3>$3000-$10000</h3>
                        </div> -->
                        <div class="service_content" width="100%" height="150">
                            <ul>
                                <span style="color: white">We offer various trusted company that<span>
                                        <span style="color: white">offers personal loan and undergone a registration</span>
                                        <span style="color: white">and signed an agreement with us with fixed interest rate</span>
                                        <span style="color: white">and verification process is strictly monitored.</span>
                            </ul>
                            <div class="apply_btn">
                                <button class="boxed-btn3" type="submit">Apply Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single_service wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                        <div class="service_icon_wrap text-center">
                            <div class="service_icon ">
                                <img src="assets/finloans/img/svg_icon/service_1.png" alt="">
                            </div>
                        </div>
                        <!-- <div class="info text-center">
                            <span>car Loan</span>
                            <h3>$3000-$10000</h3>
                        </div> -->
                        <div class="service_content" width="100%" height="100">
                            <ul>
                                <span style="color: white">We provide system feature like search engine<span>
                                        <span style="color: white">where you can search any amount you want</span>
                                        <span style="color: white">and that are being offered in the various company</span>
                                        <span style="color: white">with information of its interest rate and monthly payment.</span>
                            </ul>
                            <div class="apply_btn">
                                <button class="boxed-btn3" type="submit">Apply Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service_area_end  -->

    <!-- about_area_start  -->
    <div class="about_area" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="about_img wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">
                        <img src="assets/finloans/img/about/about.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="about_info pl-68">
                        <div class="section_title wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".3s">
                            <h3>Why Choose Us?</h3>
                        </div>
                        <p class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".4s">We are dedicated to serve to provide financial support to our clients by giving them varities of lenders to choose from. </p>
                        <div class="about_list">
                            <ul>
                                <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".5s">Loans with interest rate favourable to the clients.</li>
                                <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".6s">Customize a loan based on the amount.</li>
                                <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".7s">Loans are strictly monitored and will be approved quickly.</li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".8s">
                                <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".9s">We enhance 2 ways of login, to confirm the identity of the user..</li>
                            </ul>
                        </div>
                        <div class="about_btn wow fadeInRight" data-wow-duration="1.3s" data-wow-delay=".5s">
                            <a class="boxed-btn3" href="apply.php">About Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about_area_end  -->

    <div class="works_area" id="how">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-90">
                        <span class="wow lightSpeedIn" data-wow-duration="1s" data-wow-delay=".1s"></span>
                        <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">How it Works</h3>
                        <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">We provide online instant cash loans with quick approval that suit your term</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="single_works wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                        <span>
                            01
                        </span>
                        <h3>Register an Account</h3>
                        <p>Register an account with details provided and login your account.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="single_works wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                        <span>
                            02
                        </span>
                        <h3>Apply for Loan</h3>
                        <p>Hulam has a search engine for amount the clients needed,
                            the company displayed based on the amount choosen by the clients</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="single_works wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">
                        <span>
                            03
                        </span>
                        <h3>Application Review</h3>
                        <p>The application will be reviewed by the company the client chose.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="single_works wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">
                        <span>
                            04
                        </span>
                        <h3>Approval of Loan</h3>
                        <p>The approval of loan will be seen at the notification panel with information about the transaction.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion_area" id="faq">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-6">
                    <div class="faq_ask pl-68">
                        <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">Frequently ask</h3>
                        <div id="accordion">
                            <div class="card wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".3s">
                                <div class="card-header" id="headingOnee">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOnee" aria-expanded="true" aria-controls="collapseOnee">
                                            What is email verification?
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOnee" class="collapse show" aria-labelledby="headingOnee" data-parent="#accordion">
                                    <div class="card-body">
                                        It is a security feature of this system to enhance the security level of the user's account.
                                        To verify your account, you need to click the link sent through the email you provided.
                                    </div>
                                </div>
                            </div>
                            <div class="card wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".4s">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            How does the loan interest rate work?
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">Loan interest rate are to be calculated depending on the lending investors' inputted rate
                                        that are inside the standard given by the BSP or Bangko Sentral ng Pilipinas.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="apply_loan overlay">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-7">
                    <div class="assets/finloans/loan_text wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">
                        <h3>Apply for a Loan for your startup,
                            education or company</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="assets/finloans/loan_btn wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".4s">
                        <a class="boxed-btn3" href="login.php">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer start -->
    <footer class="footer" id="contact">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="assets/finloans/img/h_logo2.png" alt="h-20px" width="50%">
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
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | <a href="index.php" target="_blank">The Hulam Team</a>
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