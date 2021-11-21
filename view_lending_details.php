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
    <title>Hulam</title>
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
                <!--begin::Content-->
			<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<div class="d-flex flex-column-fluid">
						<div class="container">
							<div class="card card-custom overflow-hidden">
								<div class="card-body p-0">
									<div class="card card-custom gutter-b">
										<div class="card-body">
											
											<div class="col-lg-12">
												<div class="form-group">
													<div class="card card-custom card-stretch card-stretch-half gutter-b">
														<div class="card-body d-flex flex-column">
															<div class="d-flex align-items-center">
															<!-- <div class="info text-center"> -->
																<div class="d-flex flex-column">
																	<h4>Calculate Amount</h4>
																</div>
															</div>
															<form method="get" autocomplete="off">
																<input type="hidden" name="lender_id" value="<?= $_GET['lender_id'] ?>">
																<div class="row">
																	<div class="col-lg-4">
																		<div class="input-group mb-3">
																			<input class="form-control form-control-lg" type="number" name="amount" value="<?= isset($_GET['amount']) ? $_GET['amount'] : '' ?>" placeholder="Enter Loan Amount" required />
																		</div>
																	</div>
																	<div class="col-lg-4">
																		<div class="input-group mb-3">
																			<input class="form-control form-control-lg" type="number" name="month" value="<?= isset($_GET['month']) ? $_GET['month'] : '' ?>" placeholder="Months To Pay" required />
																		</div>
																	</div>
																	<div class="col-lg-2">
																		<button type="submit" class="btn btn-primary btn-block font-weight-bolder btn-lg">SHOW</button>
																	</div>
                                                                    <div class="col-lg-2">
                                                                        <a href="loan.php" class="btn btn-primary btn-block font-weight-bolder btn-lg">
                                                                            < < Back</a>
																	</div>
																</div>
															</form>
															
														</div>
														
													</div>
												</div>
											</div>
											<?php
												if (!isset($_GET['amount']) && !isset($_GET['lender_id'])) {
													$lender_id = $_GET['lender_id'];

													$sql = $dbh->prepare("SELECT * FROM user INNER JOIN loan_features ON user.user_id = loan_features.lender_id WHERE loan_features.lender_id = $lender_id");
													$sql->execute();
													$lenders = $sql->fetchAll();
												} else {
													$amount = $_GET['amount'];
													$lender_id = $_GET['lender_id'];
													$month = $_GET['month'];
													$sql = $dbh->prepare("SELECT * FROM `user` INNER JOIN `loan_features` ON user.user_id = loan_features.lender_id WHERE loan_features.min_loan <= $amount AND $amount <= loan_features.max_loan AND loan_features.min_term <= $month AND loan_features.max_term >= $month AND user.eligible = 'yes'");
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
											<?php foreach ($lenders as $lender) : ?>
											<form action="debtor/logic/apply_loan.php" method="post" enctype="multipart/form-data">
											<div class="card-body">
												<div class="d-flex">
													<div class="flex-shrink-0 mr-7">
														<div class="symbol symbol-50 symbol-lg-120 symbol-circle">
															<img alt="Pic" src="./assets/keen/hulam_media/<?= $lender['profile_pic'] ?>" />
														</div>
													</div>
													<div class="flex-grow-1">
														<div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
															<div class="mr-3">
																<h5><?= $lender['company_name'] ?></h5>
															</div>
                                                            <div class="my-lg-0 my-1">
																<a href="login.php" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">
																	Apply Now</a>
															</div>
														</div>
														<div class="d-flex align-items-center flex-wrap justify-content-between">
															<div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
																<?= $lender['description'] ?>
															</div>
														</div>
														<div class="d-flex align-items-center flex-wrap justify-content-between">
															<div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
																<?= $lender['company_street']?> <?= $lender['company_barangay']?> <?= $lender['company_city']?> <?= $lender['company_province']?> <?= $lender['company_zipcode']?>
															</div>
														</div>
														<div class="d-flex align-items-center flex-wrap justify-content-between">
															<div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
																Mobile: <?= $lender['mobile']?>
															</div>
														</div>
														<div class="d-flex align-items-center flex-wrap justify-content-between">
															<div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
																Landline: <?= $lender['company_landline']?>
															</div>
														</div>
													</div>
												</div>
												
												<table class="table table-bordered">
													<thead>
													</thead>
													<tbody>
														<tr>
															<td>Loan Amount</td>
															<td>
																<span class="font-weight-bolder font-size-h5">
																	<span class="text-dark-50 font-weight-bold">Php &nbsp;</span>
																	<?php
																	if (!isset($_GET['amount'])) {
																		echo '0.00';
																	} else {
																		echo number_format($_GET['amount'], 2);
																	}
																	?>
																</span>
															</td>
														</tr>
														<tr>
															<td>Loan Term</td>
															<td>
																<span class="font-weight-bolder font-size-h5">
																<?= $_GET['month'] ?><span class="text-dark-50 font-weight-bold">&nbsp; Months
																</span>
															</td>
														</tr>
														<tr>
															<td>Interest Rate</td>
															<td>
															<span class="font-weight-bolder font-size-h5">
																<span class="text-dark-50 font-weight-bold"></span><?= $lender['fix_rate'] ?>%</span>
															</td>
														</tr>
														<tr>
															<td>Total Amount to Pay</td>
															<td>
															<span class="font-weight-bolder font-size-h5">
																<span class="text-dark-50 font-weight-bold">Php &nbsp;</span>
																<?php
																if (!isset($_GET['amount'])) {
																	echo '0.00';
																} else {
																	if ($lender['user_type'] == 4) {
																		$amount = $_GET['amount'];
																		$month = $_GET['month'];

																		$initial_interest = $amount * ($lender['fix_rate'] / 100);
																		//500 * (10 /100) = 50
																		$total_interest = $initial_interest * $month;
																		// 50 * 1 = 50
																		$total = $total_interest + $amount;
																		// 50 + 500 = 550
																		echo number_format($total, 2);
																	} else {
																		$amount = $_GET['amount'];
																		$month = $_GET['month'];

																		$initial = $amount * ($lender['fix_rate'] / 100);
																		//30000 * (3 /100) = 900
																		$interest2 = $initial * $month;
																		// 900 * 12 = 10, 800
																		$total2 = $amount + $interest2;
																		// 30000 + 10800
																		echo number_format($total2, 2); //40800
																	}
																}
																?>
															</span>
															</td>
														</tr>
														<tr>
															<td>Monthly Payment</td>
															<td>
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
															</td>
														</tr>
														<tr>
															<td>Total Interest to Pay</td>
															<td>
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
																} ?>
															</span>
															</td>
														</tr>
														<tr>
															<td>Late Charges</td>
															<td>
															<span class="font-weight-bolder font-size-h5">
																<span class="text-dark-50 font-weight-bold"></span><?= $lender['late_charges'] ?>%</span>
															</td>
														</tr>

													</tbody>
												</table>		
												<div class="separator separator-solid my-7"></div>
												<div class="card-body pt-4">
													<div class="card card-custom">
														<div class="card-body">
															<h5 class="text-info font-weight-bolder"> Loan Features</h5>
															<table class="table table-bordered">
																<thead>
																	<tr>
																		<th>Minimimum Loan</th>
																		<th>Maximum Loan</th>
																		<th>Minimum Term</th>
																		<th>Maximum Term</th>
																		<th>Fix Interest Rate</th>
																		<th>Late Charges</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td><?= $lender['min_loan'] ?></td>
																		<td><?= $lender['max_loan'] ?></td>
																		<td><?= $lender['min_term'] ?>%</td>
																		<td><?= $lender['max_term'] ?>%</td>
																		<td><?= $lender['fix_rate'] ?>%</td>
																		<td><?= $lender['late_charges'] ?>%</td>
																	</tr>
																</tbody>

															</table></br>
														
															<h5 class="text-info font-weight-bolder">Reminders</h5>
															<div class="form-group row">
																<div class="col-lg-12">
																		▸ Loan application is subject for approval.</br>
																		▸ Please comply all the requirements provided below to complete the loan application.</br>
																		▸ Requirements uploaded will be validated by the <?= $lender['company_name'] ?>.</br>
																		<label class="font-weight-bolder">Please read</label> 
																		<a href="#" class="font-weight-boldk" data-toggle="modal" data-target="#view_terms">Terms and Conditions |&nbsp;&nbsp;</a>
																		<a href="#" class="font-weight-bold" data-toggle="modal" data-target="#view_privacy">Privacy Statement</a>
																</div>
															</div>
												
															<div class="separator separator-solid my-7"></div>
															<h5 class="text-info font-weight-bolder">List of Required Documents</h5>
															<table class="table table-bordered">
																<thead>
																	<tr>
																		<t >Requirements</th>
																		<th>Remarks</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																$id = intval($_GET['lender_id']);

																$sql = "SELECT loan_requirements.*, requirements_type.* FROM loan_requirements INNER JOIN requirements_type ON requirements_type.req_type_id = loan_requirements.req_type_id WHERE loan_requirements.lender_id = $id";
																$query = $dbh->prepare($sql);
																$query->execute();
																$res2 = $query->fetchAll(PDO::FETCH_OBJ);
																$cnt = 1;
																if ($query->rowCount() > 0) {
																	foreach ($res2 as $result) { ?>
																		<tr>
																			<td><?= htmlentities($result->req_name) ?></td>
																			<td><?= htmlentities($result->remarks) ?></td>
																		</tr>
																<?php $cnt = $cnt + 1;
																	}
																} ?>
															</tbody>
                                               				</table>
															</br>
															<div class="separator separator-dashed mt-8 mb-5"></div>
															<h5 class="text-info font-weight-bolder">Payment Method</h5>
															<table class="table table-bordered">
																<thead>
																	<tr>
																		<th>Mode of Payment</th>
																		<th>Remarks</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	$id = intval($_GET['lender_id']);
																	$sql = "SELECT * FROM mode_payment WHERE lender_id = $id";
																	$query = $dbh->prepare($sql);
																	$query->execute();
																	$res2 = $query->fetchAll(PDO::FETCH_OBJ);
																	$cnt = 1;
																	if ($query->rowCount() > 0) {
																		foreach ($res2 as $result) { ?>
																			<tr>
																				<td><?= htmlentities($result->mode_name) ?></td>
																				<td><?= htmlentities($result->remarks) ?></td>
																			</tr>
																	<?php $cnt = $cnt + 1;
																		}
																	} ?>
																</tbody>
															</table>
															<div class="separator separator-dashed mt-8 mb-5"></div>
															<?php 
															$id = intval($_GET['lender_id']);
															$sql = "SELECT * FROM notice WHERE lender_id = $id";
															$query = $dbh->prepare($sql);
															$query->execute();
															$res3 = $query->fetchAll();
															foreach($res3 as $y):
															?>
															<h5 class="text-info font-weight-bolder"><?= $y['notice_title']?>: </h5>
															<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
																<div class="row">
																	<div class="col-lg-9">
																		<div class="form-group">
																			<!-- <textarea name="remarks[]" class="form-control" rows="4" cols="50" autocomplete="off" placeholder="Remarks"><?= $y['remarks']; ?></textarea> -->
																			<label>▸<?= $y['remarks']; ?></label>
																		</div>
																	</div>
																</div>
															</div>
                                               			 <?php endforeach; ?>
															<h5 class="text-info font-weight-bolder">Reloan/Renewal of Loan</h5>
															<div class="form-group row">
																<div class="col-lg-12">
																		▸ Loan Renewal is only applicable after <label class="text-primary font-weight-bolder"><?= $lender['reloan_period']?> Months </label> from the previous released date of loan.</br>
																		▸ Remaining Balance should be less than <label class="text-primary font-weight-bolder"><?=number_format($lender['reloan_amount'], 2)?> pesos </label> </br>
																</div>
															</div>
															
                                                <?php endforeach; ?>
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