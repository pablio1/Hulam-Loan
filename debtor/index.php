<?php
session_start();
error_reporting(0);
include('../db_connection/config.php');

if ($_SESSION['user_type'] != 2) {
	header('location: ../index.php');
}

$sql = $dbh->prepare('SELECT * FROM loan_application INNER JOIN loan_features ON loan_features.lender_id = loan_application.lender_id INNER JOIN user ON loan_application.lender_id = user.user_id WHERE loan_application.debtor_id = :user_id AND loan_application.loan_status ="Released"');
$sql->execute(['user_id' => $_SESSION['user_id']]);
$loan = $sql->fetch();
?>


<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE user_id =$user_id";
$query = $dbh->prepare($sql);
$query->execute();
$user = $query->fetch();
?>

<?php
if (isset($_POST['upload_payment'])) {
	$loan_app_id = $_POST['loan_app_id'];
	$lender_id = $_POST['lender_id'];
	$debtor_id = $_SESSION['user_id'];
	$upload_date = $_POST['upload_date'];
	$message = "Uploaded proof of payment.";

	$images = $_FILES['receipt']['name'];
	$tmp_dir = $_FILES['receipt']['tmp_name'];
	$imageSize = $_FILES['receipt']['size'];

	$upload_dir = '../assets/keen/receipts/';
	$imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
	$valid_extensions = array('jpeg', 'jpg', 'gif', 'pdf', 'doc', 'docx');
	$receipt = rand(1000, 10000000) . "." . $imgExt;
	move_uploaded_file($tmp_dir, $upload_dir . $receipt);

	$insert = "INSERT INTO message(sender_id,receiver_id,message,date_message)VALUES(:sender_id,:receiver_id,:message,:date_message)";
	$query = $dbh->prepare($insert);
	$query->bindParam(':sender_id', $debtor_id, PDO::PARAM_STR);
	$query->bindParam(':receiver_id', $lender_id, PDO::PARAM_STR);
	$query->bindParam(':message', $message, PDO::PARAM_STR);
	$query->bindParam(':date_message', $upload_date, PDO::PARAM_STR);
	$query->execute();

	$insert = "INSERT INTO loan_receipt(loan_app_id,receipt,upload_date)VALUES(:loan_app_id,:receipt,:upload_date)";
	$query = $dbh->prepare($insert);
	$query->bindParam(':loan_app_id', $loan_app_id, PDO::PARAM_STR);
	$query->bindParam(':receipt', $receipt, PDO::PARAM_STR);
	$query->bindParam(':upload_date', $upload_date, PDO::PARAM_STR);

	if ($query->execute()) {
		$_SESSION['status'] = "Message Sent";
		header("Location: view_payment.php");
		exit();
	} else {
		$_SESSION['status'] = "Message Not Sent";
		header('Location: view_payment.php');
		exit();
	}
}
?>
<?php
function drawStars(int $starRating)
{
echo "<h3 style='color: yellow;'>";
for ($i = 0; $i < $starRating; $i++) {
	echo "&#x2605;";
}
echo "</h3>";
for ($i = 5 - $starRating; $i > 0; $i--) {
	echo "&#x2605;";
}
}
?>


<!DOCTYPE html>

<html lang="en">

<head>
	<base href="../">
	<meta charset="utf-8" />
	<title>Home</title>
	<meta name="description" content="Updates and statistics" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link href="assets/keen/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/keen/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/keen/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/keen/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="assets/keen/media/logos/Hulam_Logo.png" />
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading opacity:0.2" style="background-image: url('assets/keen/media/logos/banner.png');">

	<div id="kt_header_mobile" class="header-mobile header-mobile-fixed">
		<a href="index.php">
			<img alt="Logo" src="assets/keen/media/logos/h_logo2.png" class="max-h-45px" />
		</a>
	</div>

	<div class="d-flex flex-column flex-root">
		<div class="subheader bg-white h-100px" id="kt_subheader">
			<div class="container flex-wrap flex-sm-nowrap">
				<div class="d-none d-lg-flex align-items-center flex-wrap w-250px">
					<a href="debtor/index.php">
						<img alt="Logo" src="assets/keen/media/logos/h_logo2.png" class="max-h-50px" />
					</a>
				</div>
				<div class="subheader-nav nav flex-grow-1">
					<a href="debtor/index.php" class="nav-item active">
						<span class="nav-label px-10">
							<span class="nav-title text-dark-75 font-weight-bold font-size-h4">&nbsp;&nbsp;&nbsp;&nbsp&nbsp;HOME</span>
						</span>
					</a>
					<a href="debtor/update_information.php" class="nav-item">
						<span class="nav-label px-10">
							<span class="nav-title text-dark-75 font-weight-bold font-size-h4">UPDATE INFORMATION</span>
						</span>
					</a>
					<a href="debtor/loan_information.php" class="nav-item">
						<span class="nav-label px-10">
							<span class="nav-title text-dark-75 font-weight-bold font-size-h4">LOAN INFORMATION</span>
						</span>
					</a>

				</div>
			</div>

			<div class="topbar">
				<div class="topbar-item mr-1">
					<div class="btn btn-icon btn-hover-transparent-black btn-clean btn-lg" data-toggle="modal" id="kt_quick_panel_toggle">
						<span class="svg-icon svg-icon-xl svg-icon-primary">
							<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat6.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M14.4862 18L12.7975 21.0566C12.5304 21.54 11.922 21.7153 11.4386 21.4483C11.2977 21.3704 11.1777 21.2597 11.0887 21.1255L9.01653 18H5C3.34315 18 2 16.6569 2 15V6C2 4.34315 3.34315 3 5 3H19C20.6569 3 22 4.34315 22 6V15C22 16.6569 20.6569 18 19 18H14.4862Z" fill="black" />
									<path fill-rule="evenodd" clip-rule="evenodd" d="M6 7H15C15.5523 7 16 7.44772 16 8C16 8.55228 15.5523 9 15 9H6C5.44772 9 5 8.55228 5 8C5 7.44772 5.44772 7 6 7ZM6 11H11C11.5523 11 12 11.4477 12 12C12 12.5523 11.5523 13 11 13H6C5.44772 13 5 12.5523 5 12C5 11.4477 5.44772 11 6 11Z" fill="black" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
					</div>
				</div>
				<div class="topbar-item mr-5">
					<div class="btn btn-icon btn-light-primary h-40px w-40px p-0" id="kt_quick_user_toggle">
					<img src="/hulam/assets/keen/hulam_media/<?= $user['profile_pic']?>" class="h-40px align-self-end" alt="">
					</div>
				</div>
			</div>
		</div>


		<!--begin::Content-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="background-image:url('assets/keen/media/logos/banner.png')">
			<div class="gutter-b" id="kt_breadcrumbs">
                <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <h2 class="text-white font-weight-bold my-1 mr-5">Hi, <?= $_SESSION['firstname']; ?>! Welcome to Hulam.</h2>
							<div class="info text-center">
								<h6 class="text-danger">
									<?php
									$id = $_SESSION['user_id'];

									$sql = "SELECT * FROM user WHERE user_id = $id";
									$query = $dbh->prepare($sql);
									$query->execute();
									$result = $query->fetch();
									$notice = $result['notice_message'];
									if ($result['eligible'] == 'no') {

										echo $notice;
									}
									?></h6>
							</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">

                    </div>
                </div>
            </div>


			<div class="d-flex flex-column-fluid">
				<div class="container">
					
					<div class="col-lg-12">
						<div class="form-group">
							<div class="card card-custom card-stretch card-stretch-half gutter-b">
								<div class="card-body d-flex flex-column">
									<div class="d-flex align-items-center">
										<div class="d-flex flex-column">
											<h4>Filter Amount</h4>
										</div>
									</div>
									<form method="get" autocomplete="off">
										<div class="row">
											<div class="col-lg-3">
												<div class="form-group">
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
											<div class="col-lg-3">
												<div class="input-group mb-3">
													<input class="form-control form-control-lg" type="number" name="amount" value="<?= isset($_GET['amount']) ? $_GET['amount'] : '' ?>" placeholder="Enter Loan Amount" required />
												</div>
											</div>
											<div class="col-lg-3">
												<div class="input-group mb-3">
													<input class="form-control form-control-lg" type="number" name="month" value="<?= isset($_GET['month']) ? $_GET['month'] : '' ?>" placeholder="Months To Pay" required />
												</div>
											</div>
											<div class="col-lg-3">
												<button type="submit" class="btn btn-primary btn-block font-weight-bolder btn-lg">SHOW</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php
					if (!isset($_GET['amount']) && !isset($_GET['type'])) {

						$sql = $dbh->prepare("SELECT * FROM user INNER JOIN loan_features ON user.user_id = loan_features.lender_id WHERE (user_type = 3 OR user_type = 4) AND user.eligible = 'yes'");
						$sql->execute();
						$lenders = $sql->fetchAll();
					} else {
						$amount = $_GET['amount'];
						$type = $_GET['type'];
						$month = $_GET['month'];
						$sql = $dbh->prepare("SELECT * FROM `user` INNER JOIN `loan_features` ON user.user_id = loan_features.lender_id WHERE loan_features.min_loan <= $amount AND $amount <= loan_features.max_loan AND user.user_type = $type AND loan_features.min_term <= $month AND loan_features.max_term >= $month AND user.eligible = 'yes'");
						$sql->execute();
						$lenders = $sql->fetchAll();
					}
					?>
					<?php if ($sql->rowCount() == 0) : ?>
					<div class="container">
						<div class="card card-custom gutter-b">
							<div class="card-body">
								<h1 class="text-center">NO RECORDS FOUND</h1>
							</div>
						</div>
					</div>
					<?php endif; ?>
					<?php foreach ($lenders as $lender) : ?>
					<div class="col-lg-12">
						<div class="form-group">
							<div class="card card-custom card-stretch card-stretch-half gutter-b">
								<div class="d-flex flex-column-fluid">
									<div class="container">
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
																	<!-- <a href="debtor/view_company2.php?lender_id=<?= $lender['lender_id'] ?>" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">View Details</a> -->
																	<?php if ($user['eligible'] == 'no') : ?>
																		<a href="" class="btn btn-sm btn-primary font-weight-bolder" data-target="#notice" data-toggle="modal">View Details</a>
																	<?php else: ?>	
																		<a href="debtor/apply_loan.php?lender_id=<?= $lender['lender_id'] . '&amount=' . $_GET['amount'] . '&month=' . $_GET['month']  ?>" class="btn btn-sm btn-primary font-weight-bolder">View Details</a>
																	<?php endif; ?>
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
													<div class="modal fade" id="exist" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
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
																
															</div>
															<div class="d-flex flex-column">
																<span class="text-dark-75 font-weight-bolder font-size-sm">Rates and Reviews  &nbsp;&nbsp;| <a href="debtor/view_rating.php?lender_id=<?= $lender['lender_id']?>" class="text-primary font-weight-bolder">View</a>
																	
																	<?php
																	if (!isset($_GET['amount']) && !isset($_GET['type'])) {
																		$lender_id = $lender['lender_id'];
																		$sql = $dbh->prepare("SELECT * FROM user INNER JOIN loan_features ON user.user_id = loan_features.lender_id INNER JOIN feedback ON user.user_id  = feedback.lender_id WHERE (user_type = 3 OR user_type = 4) AND user.eligible = 'yes' AND feedback.lender_id = $lender_id");
																		$sql->execute();
																		$len= $sql->fetchAll();
																	} else {
																		$amount = $_GET['amount'];
																		$type = $_GET['type'];
																		$month = $_GET['month'];
																		$sql = $dbh->prepare("SELECT * FROM `user` INNER JOIN `loan_features` ON user.user_id = loan_features.lender_id  INNER JOIN feedback ON user.user_id  = feedback.lender_id WHERE loan_features.min_loan <= $amount AND $amount <= loan_features.max_loan AND user.user_type = $type AND loan_features.min_term <= $month AND loan_features.max_term >= $month AND user.eligible = 'yes'");
																		$sql->execute();
																		$len = $sql->fetchAll();
																	}
																	?>
																	<?php 
																	foreach($len as $rate):
																	?>
																
																		<?php
																		$ratingTotal = $ratingCount = 0;
																		$ratingTotal += $rate['ratings'];
																		$ratingCount++;
																		echo "<p>" . number_format(($ratingTotal / $ratingCount), 2) . " " .
																			drawStars(round($ratingTotal / $ratingCount)) .
																			"</p>";
																		$ratingTotal = 0;
																		$ratingCount = 0;
																		?>
																</span>
																<?php 
															endforeach;
															?>
																
															</div>
														</div>
													</div>
												</div>
											</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>

			</div>
		</div>
	</div>
	<!--begin::Footer-->
	<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
		<!--begin::Container-->
		<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
			<!--begin::Copyright-->
			<div class="text-dark order-2 order-md-1">
				<span class="text-muted font-weight-bold mr-2">2021??</span>
				<a href="http://keenthemes.com/keen" target="_blank" class="text-dark-75 text-hover-primary">The Hulam Team</a>
			</div>
			<!--end::Copyright-->
			<!--begin::Nav-->
			<div class="nav nav-dark order-1 order-md-2">
				<a href="http://keenthemes.com/keen" target="_blank" class="nav-link pr-3 pl-0">About</a>
				<a href="http://keenthemes.com/keen" target="_blank" class="nav-link px-3">Team</a>
				<a href="http://keenthemes.com/keen" target="_blank" class="nav-link pl-3 pr-0">Contact</a>
			</div>

		</div>
	</div>
	</div>

	<!-- begin::User Panel-->
	<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
		<!--begin::Header-->
		<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
			<h3 class="font-weight-bold m-0">User Profile
				<!-- <small class="text-muted font-size-sm ml-2">15 messages</small></h3> -->
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
		</div>
		<!--end::Header-->
		<!--begin::Content-->
		<div class="offcanvas-content pr-5 mr-n5">
			<!--begin::Header-->
			<div class="d-flex align-items-center mt-5">
				<div class="symbol symbol-100 mr-5">
					<div class="symbol-label" style="background-image:url('assets/keen/hulam_media/<?= $user['profile_pic'] ?>')"></div>
					<i class="symbol-badge bg-success"></i>
				</div>
				<div class="d-flex flex-column">
					<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= $_SESSION['firstname']; ?> <?= $_SESSION['lastname']; ?></a>
					<div class="text-muted mt-1">Debtor</div>
					<div class="navi mt-1">
						<a href="#" class="navi-item">
							<span class="navi-link p-0 pb-2">
								<span class="navi-icon mr-1">
									<span class="svg-icon svg-icon-lg svg-icon-primary">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
												<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</span>
								<span class="navi-text text-muted text-hover-primary"><?= $_SESSION['email'] ?></span>
							</span>
						</a>
					</div>
				</div>
			</div>
			<!--end::Header-->
			<!--begin::Separator-->
			<div class="separator separator-dashed mt-8 mb-5"></div>
			<!--end::Separator-->
			<!--begin::Nav-->
			<div class="navi navi-spacer-x-0 p-0">
				<!--begin::Item-->
				<a href="debtor/update_information.php" class="navi-item">
					<div class="navi-link">
						<div class="symbol symbol-40 bg-light mr-3">
							<div class="symbol-label">
								<span class="svg-icon svg-icon-md svg-icon-danger">
									<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Adress-book2.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3" />
											<path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000" />
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
							</div>
						</div>
						<div class="navi-text">
							<div class="font-weight-bold">My Account</div>
						</div>
					</div>
				</a>
				<!--end:Item-->
				<!--begin::Item-->
				<a href="debtor/send_feedback.php" class="navi-item">
					<div class="navi-link">
						<div class="symbol symbol-40 bg-light mr-3">
							<div class="symbol-label">
								<span class="svg-icon svg-icon-md svg-icon-success">
									<!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
											<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
										</g>
									</svg>
									<!--end::Svg Icon-->
									</span>
								</div>
							</div>
						<div class="navi-text">
							<div class="font-weight-bold">Send Feedback</div>
						</div>
					</div>
				</a>
				<!--end:Item-->
				<!--begin::Item-->
				<span class="navi-item mt-2">
					<span class="navi-link">
						<a href="logout.php" class="btn btn-sm btn-light-primary font-weight-bolder py-3 px-6">Sign Out</a>
					</span>
				</span>
				<!--end:Item-->
			</div>
			<!--end::Nav-->
			<!--begin::Separator-->
			<div class="separator separator-dashed my-7"></div>
			<!--end::Separator-->
		</div>
		<!--end::Content-->
	</div>
	<!-- end::User Panel-->


	<!--begin::Quick Panel-->
	<div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
		<!--begin::Header-->
		<div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
			<ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_notifications">Notification</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#kt_quick_panel_logs">Contacts</a>
				</li>
				</li>
			</ul>
			<div class="offcanvas-close mt-n1 pr-5">
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
		</div>
		<!--end::Header-->

		<!--begin::Content-->
		<div class="offcanvas-content px-10">
			<div class="tab-content">
				<div class="tab-pane show pt-2 pr-5 mr-n5 active" id="kt_quick_panel_notifications" role="tabpanel">
				<div class="navi navi-icon-circle navi-spacer-x-0">
					<?php
					$user_id = $_SESSION['user_id'];
					$sql = "SELECT * FROM message INNER JOIN user ON message.sender_id = user.user_id WHERE message.receiver_id = $user_id ORDER BY date_message desc";
					$query = $dbh->prepare($sql);
					$query->execute();
					$results = $query->fetchAll(PDO::FETCH_OBJ);

					foreach ($results as $res) :

					?> <a href="debtor/messages.php?sender_id=<?= htmlentities($res->sender_id) ?>">
							<div class="navi-link rounded">
								<div class="symbol symbol-50 mr-3">
								</div>
								<div class="navi-text">
									<div class="font-weight-bold font-size-lg">
										<?php
										$red = htmlentities($res->user_type);

										if ($red == 1) : ?>
											<?= htmlentities($res->firstname) . '' . htmlentities($res->middlename) . ' ' . htmlentities($res->lastname); ?>
										<?php elseif ($red == 2) : ?>
											<?= htmlentities($res->firstname) . '' . htmlentities($res->middlename) . ' ' . htmlentities($res->lastname); ?>
										<?php elseif ($red == 3) : ?>
											<?= htmlentities($res->company_name); ?>
										<?php elseif ($red == 4) : ?>
											<?= htmlentities($res->firstname) . '' . htmlentities($res->middlename) . ' ' . htmlentities($res->lastname); ?>
										<?php else : ?>
											<?= htmlentities($res->company_name); ?>
										<?php endif; ?>
									</div><span class="font-size-sm"><?= htmlentities($res->date_message); ?></span>
									<div class="text-muted"><?= htmlentities($res->message) ?></div>
								</div>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
				</div>
				<!-- END NOTIFICATION CONTENT -->

				<!-- CONTACTS -->
					<div class="tab-pane fade show pt-3 pr-5 mr-n5" id="kt_quick_panel_logs" role="tabpanel">
						<div class="mb-5">
							<h5 class="font-weight-bold mb-5">Your contacts</h5>
							<?php

							$user_id = $_SESSION['user_id'];
							$sql = "SELECT * FROM message INNER JOIN user ON message.sender_id = user.user_id WHERE (user.user_type!='2' AND user.user_type!='1') AND (message.receiver_id = $user_id OR message.sender_id = $user_id) GROUP BY message.sender_id";
							$query = $dbh->prepare($sql);
							$query->execute();
							$user_name = $query->fetchAll();

							?>
							<?php foreach ($user_name as $contacts) : ?>
							<div class="d-flex align-items-center mb-">
								<div class="symbol symbol-35 flex-shrink-0 mr-3">
									<img alt="Pic" src="/hulam/assets/keen/hulam_media/<?= $contacts['profile_pic']?>" />
								</div>
								<div class="d-flex flex-wrap flex-row-fluid">
									<div class="d-flex flex-column pr-2 flex-grow-1">
										<a href="debtor/messages.php?sender_id=<?= $contacts['sender_id']?>" class="text-dark text-hover-primary mb-1 font-weight-bold font-size-lg"><?= $contacts['company_name']?></a>
									</div>
										<a href="debtor/messages.php?sender_id=<?= $contacts['sender_id']?>" class="btn btn-icon btn-light btn-sm">
											<span class="svg-icon svg-icon-success">
												<span class="svg-icon svg-icon-md">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<polygon points="0 0 24 0 24 24 0 24" />
															<path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-270.000000) translate(-12.000003, -11.999999)" />
														</g>
													</svg>
												</span>
											</span>
										</a>
									</div>
								</div>
							<?php endforeach; ?>
							<div class="d-flex align-items-center mb-6">
								<div class="symbol symbol-35 flex-shrink-0 mr-3">
									<img alt="Pic" src="/hulam/assets/keen/media/logos/h_small.png" />
								</div>
								<?php
								$sql = "SELECT * FROM user WHERE user_type = '1'";
								$query = $dbh->prepare($sql);
								$query->execute();
								$admin = $query->fetch();
								?>
								<div class="d-flex flex-wrap flex-row-fluid">
									<div class="d-flex flex-column pr-2 flex-grow-1">
										<a href="debtor/messages.php?sender_id=<?= $admin['user_id']?>" class="text-dark text-hover-primary mb-1 font-weight-bold font-size-lg">The Hulam Team</a>
									</div>
									<a href="debtor/messages.php?sender_id=<?= $admin['user_id']?>" class="btn btn-icon btn-light btn-sm">
											<span class="svg-icon svg-icon-success">
												<span class="svg-icon svg-icon-md">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<polygon points="0 0 24 0 24 24 0 24" />
															<path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-270.000000) translate(-12.000003, -11.999999)" />
														</g>
													</svg>
												</span>
											</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	<!--end::Quick Panel-->


	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop">
		<span class="svg-icon">
			<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<polygon points="0 0 24 0 24 24 0 24" />
					<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
					<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
				</g>
			</svg>
			<!--end::Svg Icon-->
		</span>
	</div>
	<!--end::Scrolltop-->
	<!--end::Sticky Toolbar-->
	<!--begin::Demo Panel-->
	<div id="kt_demo_panel" class="offcanvas offcanvas-right p-10">
		<!--begin::Header-->
		<div class="offcanvas-header d-flex align-items-center justify-content-between pb-7">
			<h4 class="font-weight-bold m-0">Select A Demo</h4>
			<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_demo_panel_close">
				<i class="ki ki-close icon-xs text-muted"></i>
			</a>
		</div>
		<!--end::Header-->

	</div>
	<!--end::Demo Panel-->
	<script>
		var HOST_URL = "https://preview.keenthemes.com/keen/theme/tools/preview";
	</script>
	<!--begin::Global Config(global config for global JS scripts)-->
	<script>
		var KTAppSettings = {
			"breakpoints": {
				"sm": 576,
				"md": 768,
				"lg": 992,
				"xl": 1200,
				"xxl": 1200
			},
			"colors": {
				"theme": {
					"base": {
						"white": "#ffffff",
						"primary": "#0BB783",
						"secondary": "#E5EAEE",
						"success": "#1BC5BD",
						"info": "#8950FC",
						"warning": "#FFA800",
						"danger": "#F64E60",
						"light": "#F3F6F9",
						"dark": "#212121"
					},
					"light": {
						"white": "#ffffff",
						"primary": "#D7F9EF",
						"secondary": "#ECF0F3",
						"success": "#C9F7F5",
						"info": "#EEE5FF",
						"warning": "#FFF4DE",
						"danger": "#FFE2E5",
						"light": "#F3F6F9",
						"dark": "#D6D6E0"
					},
					"inverse": {
						"white": "#ffffff",
						"primary": "#ffffff",
						"secondary": "#212121",
						"success": "#ffffff",
						"info": "#ffffff",
						"warning": "#ffffff",
						"danger": "#ffffff",
						"light": "#464E5F",
						"dark": "#ffffff"
					}
				},
				"gray": {
					"gray-100": "#F3F6F9",
					"gray-200": "#ECF0F3",
					"gray-300": "#E5EAEE",
					"gray-400": "#D6D6E0",
					"gray-500": "#B5B5C3",
					"gray-600": "#80808F",
					"gray-700": "#464E5F",
					"gray-800": "#1B283F",
					"gray-900": "#212121"
				}
			},
			"font-family": "Poppins"
		};
	</script>
	<!--end::Global Config-->
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
	<!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>