<?php
session_start();
error_reporting(0);
include('db_connection/config.php');
?>
<?php

$sql ="SELECT loan_features.*, user.* FROM loan_features INNER JOIN user ON loan_features.lender_id = user.user_id";
$query = $dbh->prepare($sql);
$query->execute();
$user = $query->fetch();
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Finloans</title>
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
    <link rel="stylesheet" href="assets/finloans/css/animate.css">
    <link rel="stylesheet" href="assets/finloans/css/slicknav.css">
    <link rel="stylesheet" href="assets/finloans/css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="assets/keen/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="assets/keen/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/keen/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/keen/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
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
                                            <li><a href="index.php">about</a></li>
                                            <!-- <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="apply.php">apply loan</a></li>
                                                    <li><a href="elements.php">elements</a></li>
                                                </ul>
                                            </li> -->
                                            <li><a href="index.php">FAQ</a></li>
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

      <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="bradcam_text" >
                        <h3>Salary Loan Offers</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <!--================Blog Area =================-->
        </br>
        <div class="container">
            <div class="col-lg-12">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form action="#">
                        <h3>Filter Amount</h3>
                         <form method="get" autocomplete="off">
                            <div class="row">
                                <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                    <select name="type" class="form-control form-control-lg" required>
                                            <option value="" hidden>Type of Lenders</option>
                                            <option value="3" <?php if (isset($_GET['type'])) {
                                                                    if ($_GET['type'] == 3) {
                                                                        echo 'selected';
                                                                    } else {
                                                                        echo '';
                                                                    }
                                                                } ?>>Lending Company</option>
                                            <option value="4" <?php if (isset($_GET['type'])) {
                                                                    if ($_GET['type'] == 4) {
                                                                        echo 'selected';
                                                                    } else {
                                                                        echo '';
                                                                    }
                                                                } ?>>Individual Investor</option>
                                    </select>                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                    <input type="number" class="form-control" type="number" name="amount" value="<?= isset($_GET['amount']) ? $_GET['amount'] : '' ?>" placeholder="Enter Loan Amount" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" type="number" name="month" value="<?= isset($_GET['month']) ? $_GET['month'] : '' ?>" placeholder="Months To Pay" required />
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <a href="loan.php">
                                    <button class="button rounded-0 primary-bg text-primary w-100 btn_1 boxed-btn" type="submit">Search
                                    </button></a>
                                </div>
                            </div>
                            </div>
                        </form>
                    </aside>
                </div>
            </div> 
            <div class="row">
                <di v class="container">
                <?php
                if (!isset($_GET['amount']) && !isset($_GET['type'])) {

                    $sql = $dbh->prepare("SELECT * FROM user INNER JOIN loan_features ON user.user_id = loan_features.lender_id INNER JOIN feedback ON feedback.lender_id = user.user_id WHERE (user_type = 3 OR user_type = 4) AND user.eligible = 'yes'");
                    $sql->execute();
                    $lenders = $sql->fetchAll();
                } else {
                    $amount = $_GET['amount'];
                    $type = $_GET['type'];
                    $month = $_GET['month'];
                    $sql = $dbh->prepare("SELECT * FROM `user` INNER JOIN `loan_features` ON user.user_id = loan_features.lender_id INNER JOIN feedback ON feedback.lender_id = user.user_id WHERE loan_features.min_loan <= $amount AND $amount <= loan_features.max_loan AND user.user_type = $type AND loan_features.min_term <= $month AND loan_features.max_term >= $month AND user.eligible = 'yes'");
                    $sql->execute();
                    $lenders = $sql->fetchAll();
                }
                ?>

                <?php if ($sql->rowCount() == 0) : ?>

                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <h1 class="text-center">NO RECORDS FOUND</h1>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                ?>
                <?php foreach ($lenders as $lender) : ?>
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 mr-7">
                                    <div class="symbol symbol-50 symbol-lg-120 symbol-circle">
                                        <img alt="Pic" src="/hulam/assets/keen/hulam_media/<?= $lender['profile_pic'] ?>" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                                        <div class="mr-3">
                                            <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $lender['company_name'] ?></a>
                                        </div>
                                        <div class="my-lg-0 my-1">
                                            <a href="debtor/view_company.php?lender_id=<?= $lender['lender_id'] ?>" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">View Details</a>
                                            <a href="login.php" class="btn btn-sm btn-primary font-weight-bolder">Apply Now</a>
                                           
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                                        <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                                            <?= $lender['description'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Modal -->
                            <div class="modal fade" id="notice" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-m" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Account Not Activated.</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="font-weight-bolder font-size-lg" for="input-username">To activate your account you need to complete updating your profile information and wait for the activation to start applying loan.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <!-- Start Modal -->
                            <div class="modal fade" id="notice2" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-m" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">You have an existing loan associated with this account.</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="font-weight-bolder font-size-lg" for="input-username"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <div class="separator separator-solid my-7"></div>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">Monthly Payment</span>
                                        <span class="font-weight-bolder font-size-h5">
                                            <span class="text-dark-50 font-weight-bold">Php &nbsp;</span>
                                            <?php

                                            if (!isset($_GET['amount'])) {
                                                echo '0.00';
                                            } else {
                                                if ($lender['user_type'] == 4) {
                                                    $amount = $_GET['amount'];
                                                    $month = $_GET['month'];
                                                    $new_rate = $month * ($lender['fix_rate'] / 100);
                                                    //1 * 10/100 = 0.1
                                                    $initial_amount = $amount * $new_rate;
                                                    //500 * 0.1 = 50
                                                    $add_interest = $initial_amount + $amount;
                                                    //50 + 500 = 550
                                                    echo number_format($add_interest / $month, 2);
                                                    //550 /1 = 550
                                                } else {
                                                    $amount = $_GET['amount'];
                                                    $month = $_GET['month'];
                                                    //30000
                                                    $initial_amount =  $amount * ($lender['fix_rate'] / 100);
                                                    //30000 * 0.03 = 900
                                                    $add_interest = $amount / $month;
                                                    //30000 / 12 =2500
                                                    echo number_format($add_interest + $initial_amount, 2);
                                                    //2500 + 900 = 3400
                                                }
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">Loan Term</span>
                                        <span class="font-weight-bolder font-size-h5">
                                            <?= $_GET['month'] ?>&nbsp;<span class="text-dark-50 font-weight-bold">Months</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">Fixed Interest Rate</span>
                                        <span class="font-weight-bolder font-size-h5">
                                            <span class="text-dark-50 font-weight-bold"></span><?= $lender['fix_rate'] ?>%</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">Total Interest</span>
                                        <span class="font-weight-bolder font-size-h5">
                                            <span class="text-dark-50 font-weight-bold">Php &nbsp;</span>
                                            <?php
                                            if (!isset($_GET['amount'])) {
                                                echo '0.00';
                                            } else {
                                                if ($lender['user_type'] == 4) {
                                                    $amount = $_GET['amount'];
                                                    $month = $_GET['month'];
                                                    $new_rate = $amount * ($lender['fix_rate'] / 100); //500 * 0.1 = 50
                                                    $total = $new_rate * $month; //50 * 1
                                                    echo number_format($total, 2);
                                                } else {
                                                    $amount = $_GET['amount'];
                                                    $month = $_GET['month'];
                                                    $new_rate = $amount * ($lender['fix_rate'] / 100); //30000* 0.3 = 900
                                                    $total = $new_rate * $month; //900 * 12

                                                    echo number_format($total, 2);
                                                }
                                            }

                                            ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    
                                    <div class="d-flex flex-column">
                                        <span class="text-dark-75 font-weight-bolder font-size-sm">Average Rating</br>
                                        <?php
                                        function drawStars(int $starRating)
                                        {
                                            echo "<span style='color: yellow;'>";
                                            for ($i = 0; $i < $starRating; $i++) {
                                                echo "&#x2605;";
                                            }
                                            echo "</span>";
                                            for ($i = 5 - $starRating; $i > 0; $i--) {
                                                echo "&#x2605;";
                                            }
                                        }
                                        ?>
                                     <?php
                                        $ratingTotal = $ratingCount = 0;
                                        $ratingTotal += $lender['ratings'];
                                        $ratingCount++;
                                        echo "<p>" . number_format(($ratingTotal / $ratingCount), 2) . " " .
                                            drawStars(round($ratingTotal / $ratingCount)) .
                                            "</p>";
                                        $ratingTotal = 0;
                                        $ratingCount = 0;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <!--end::Card-->
                </div>
            </div>
        </div>
    <!--================ Loan Search Area =================-->

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
                        
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        
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

    <!--contact js-->
    <script src="assets/finloans/js/contact.js"></script>
    <script src="assets/finloans/js/jquery.ajaxchimp.min.js"></script>
    <script src="assets/finloans/js/jquery.form.js"></script>
    <script src="assets/finloans/js/jquery.validate.min.js"></script>
    <script src="assets/finloans/js/mail-script.js"></script>

    <script src="assets/finloans/js/main.js"></script>
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }

        });
    </script>

    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="assets/keen/plugins/global/plugins.bundle.js"></script>
    <script src="assets/keen/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="assets/keen/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="assets/keen/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/keen/js/pages/widgets.js"></script>
</body>
</html>