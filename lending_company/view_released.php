<?php
session_start();
error_reporting(0);
include('../db_connection/config.php');
if ($_SESSION['user_type'] != 3) {
	header('location: ../index.php');
}?>


<?php
$id = intval($_GET['loan_app_id']);

$sql = "SELECT loan_application.*, user.* FROM loan_application INNER JOIN user on loan_application.debtor_id = user.user_id WHERE loan_application.loan_app_id = $id";
$query = $dbh->prepare($sql);
$query->execute();
$debtor = $query->fetch();
?>

<?php
if (isset($_POST['send_message'])) {
	$id = intval($_GET['loan_app_id']);

	$sender_id = $_POST['sender_id'];
	$receiver_id = $_POST['receiver_id'];
	$date_message = $_POST['date_message'];
	$message = $_POST['message'];

	$insert = "INSERT INTO message(sender_id,receiver_id,message,date_message)VALUES(:sender_id,:receiver_id,:message,:date_message)";
	$query = $dbh->prepare($insert);
	$query->bindParam(':sender_id', $sender_id, PDO::PARAM_STR);
	$query->bindParam(':receiver_id', $receiver_id, PDO::PARAM_STR);
	$query->bindParam(':message', $message, PDO::PARAM_STR);
	$query->bindParam(':date_message', $date_message, PDO::PARAM_STR);
	if ($query->execute()) {
		$_SESSION['status_released'] = "Message Sent";
		header("Location: view_released.php?loan_app_id=$id");
		exit();
	} else {
		$_SESSION['status_released'] = "Message Not Sent";
		header('Location: view_released.php?loan_app_id=$id');
		exit();
	}
}
?>

<?php
if (isset($_POST['released_loan'])) {
	$id = intval($_GET['loan_app_id']);
	$released_date = $_POST['released_date'];
    $sender_id = $_POST['sender_id'];
	$receiver_id = $_POST['receiver_id'];
    $loan_message = $_POST['loan_message'];
	$monthly_due_date = $_POST['monthly_due_date'];
	$remaining_balance = $_POST['remaining_balance'];
	$monthly_interest = $_POST['monthly_interest'];
	$monthly_payable= $_POST['monthly_payable'];
	$payment_status = 'unpaid';
 
	$update = "UPDATE loan_application SET loan_status = 'Released', released_date = :released_date WHERE loan_app_id = $id";
	$query2 = $dbh->prepare($update);
	$query2->bindParam(':released_date',$released_date,PDO::PARAM_STR);
    $query2->execute();

	$s = "SELECT * FROM loan_payment WHERE loan_app_id = $id";
	$ss = $dbh->prepare($s);
	$ss->execute();
	if($ss->rowCount()==0){
		$insert2 = "INSERT INTO loan_payment(loan_app_id,debtor_id,lender_id,remaining_balance,monthly_interest,monthly_payable,monthly_due_date,payment_status)
		VALUES(:loan_app_id,:debtor_id,:lender_id,:remaining_balance,:monthly_interest,:monthly_payable,:monthly_due_date,:payment_status)";
		$insertquery = $dbh->prepare($insert2);
		$insertquery->bindParam(':loan_app_id',$id,PDO::PARAM_STR);
		$insertquery->bindParam(':debtor_id',$receiver_id,PDO::PARAM_STR);
		$insertquery->bindParam(':lender_id',$sender_id,PDO::PARAM_STR);
		$insertquery->bindParam(':remaining_balance',$remaining_balance,PDO::PARAM_STR);
		$insertquery->bindParam(':monthly_interest',$monthly_interest,PDO::PARAM_STR);
		$insertquery->bindParam(':monthly_payable',$monthly_payable,PDO::PARAM_STR);
		$insertquery->bindParam(':monthly_due_date',$monthly_due_date,PDO::PARAM_STR);
		$insertquery->bindParam(':payment_status',$payment_status,PDO::PARAM_STR);
		$insertquery->execute();
	}else{
		$update2 = "UPDATE loan_payment SET debtor_id =:debtor_id,lender_id =:lender_id,remaining_balance=:remaining_balance,
		monthly_interest=:monthly_interest,monthly_payable =:monthly_payable,monthly_due_date=:monthly_due_date,payment_status=:payment_status WHERE loan_app_id =$id";
		$iquery = $dbh->prepare($update2);
		$iquery->bindParam(':debtor_id',$receiver_id,PDO::PARAM_STR);
		$iquery->bindParam(':lender_id',$sender_id,PDO::PARAM_STR);
		$iquery->bindParam(':remaining_balance',$remaining_balance,PDO::PARAM_STR);
		$iquery->bindParam(':monthly_interest',$monthly_interest,PDO::PARAM_STR);
		$iquery->bindParam(':monthly_payable',$monthly_payable,PDO::PARAM_STR);
		$iquery->bindParam(':monthly_due_date',$monthly_due_date,PDO::PARAM_STR);
		$iquery->bindParam(':payment_status',$payment_status,PDO::PARAM_STR);
		$iquery->execute();
	}

    $insert = "INSERT INTO message(sender_id,receiver_id,message,date_message)VALUES(:sender_id,:receiver_id,:message,:date_message)";
	$query = $dbh->prepare($insert);
	$query->bindParam(':sender_id', $sender_id, PDO::PARAM_STR);
	$query->bindParam(':receiver_id', $receiver_id, PDO::PARAM_STR);
    $query->bindParam(':message', $loan_message, PDO::PARAM_STR);
	$query->bindParam(':date_message', $released_date, PDO::PARAM_STR);

	if($query->execute()){
		$_SESSION['status_released'] = "Loan Released!";
		header("Location: view_released.php?loan_app_id=$id");
		exit();
	} else {
		$_SESSION['status_released'] = "Error!";
		header('Location: view_released.php?loan_app_id=$id');
		exit();
	}
}
?>

<?php
if (isset($_POST['declined_loan'])) {
	$id = intval($_GET['loan_app_id']);

	$update = "UPDATE loan_application SET loan_status = 'Declined' WHERE loan_app_id = $id";
	$query2 = $dbh->prepare($update);

	if($query2->execute()){
		$_SESSION['status_declined'] = "Loan Declined!";
		header("Location: view_declined.php?loan_app_id=$id");
		exit();
	} else {
		$_SESSION['status_declined'] = "Error!";
		header('Location: view_declined.php?loan_app_id=$id');
		exit();
	}
}
?>

<?php
$lender_id = $_SESSION['user_id'];

$sql ="SELECT * FROM user WHERE user_id = $lender_id";
$query = $dbh->prepare($sql);
$query->execute();
$user = $query->fetch();
?>

<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
	<base href="../">
	<meta charset="utf-8" />
	<title>Hulam | View Released Loan</title>
	<meta name="description" content="Updates and statistics" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Vendors Styles(used by this page)-->
	<link href="assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors Styles-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="assets/admin/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/admin/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/admin/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<link href="assets/admin/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/admin/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/admin/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
	<link href="assets/admin/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
	<!--end::Layout Themes-->
	<link rel="shortcut icon" href="assets/keen/media/logos/h_small.png" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-fixed aside-minimize-hoverable page-loading">
	<!--begin::Main-->
	<!--begin::Header Mobile-->
	<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
		<!--begin::Logo-->
		<a href="lending_company/index.php">
			<img alt="Logo" src="assets/admin/media/logos/Hulam_Logo.png" class="h-60px w-60px" style="padding-top: 10%; padding: right 50%;" />
		</a>
		<!--end::Logo-->
		<!--begin::Toolbar-->
		<div class="d-flex align-items-center">
			<!--begin::Aside Mobile Toggle-->
			<button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
				<span></span>
			</button>
			<!--end::Aside Mobile Toggle-->
			<!--begin::Header Menu Mobile Toggle-->
			<button class="btn p-0 burger-icon ml-5" id="kt_header_mobile_toggle">
				<span></span>
			</button>
			<!--end::Header Menu Mobile Toggle-->
			<!--begin::Topbar Mobile Toggle-->
			<button class="btn btn-hover-text-primary p-0 ml-3" id="kt_header_mobile_topbar_toggle">
				<span class="svg-icon svg-icon-xl">
					<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<polygon points="0 0 24 0 24 24 0 24" />
							<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
							<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
						</g>
					</svg>
					<!--end::Svg Icon-->
				</span>
			</button>
			<!--end::Topbar Mobile Toggle-->
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header Mobile-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">
			<!--begin::Aside-->
			<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
				<!--begin::Brand-->
				<div class="brand flex-column-auto" id="kt_brand">
					<!--begin::Logo-->
					<a href="lending_company/index.php" class="brand-logo">
						<img alt="Logo" src="assets/admin/media/logos/Hulam_Logo.png" class="h-100px w-90px" style="padding-top: 20%; padding: right 50%;" />
					</a>
					<!--end::Logo-->
					<!--begin::Toggle-->
					<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
						<span class="svg-icon svg-icon svg-icon-xl">
							<!--begin::Svg Icon | path:assets/media/svg/icons/Text/Toggle-Right.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path fill-rule="evenodd" clip-rule="evenodd" d="M22 11.5C22 12.3284 21.3284 13 20.5 13H3.5C2.6716 13 2 12.3284 2 11.5C2 10.6716 2.6716 10 3.5 10H20.5C21.3284 10 22 10.6716 22 11.5Z" fill="black" />
									<path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M14.5 20C15.3284 20 16 19.3284 16 18.5C16 17.6716 15.3284 17 14.5 17H3.5C2.6716 17 2 17.6716 2 18.5C2 19.3284 2.6716 20 3.5 20H14.5ZM8.5 6C9.3284 6 10 5.32843 10 4.5C10 3.67157 9.3284 3 8.5 3H3.5C2.6716 3 2 3.67157 2 4.5C2 5.32843 2.6716 6 3.5 6H8.5Z" fill="black" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
					</button>
					<!--end::Toolbar-->
				</div>
				<!--end::Brand-->
				<!--begin::Aside Menu-->
				<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
					<!--begin::Menu Container-->
					<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
						<!--begin::Menu Nav-->
						<ul class="menu-nav">
							<li class="menu-item menu-item-active" aria-haspopup="true">
								<a href="lending_company/index.php" class="menu-link">
									<span class="svg-icon menu-icon">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
												<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
									<span class="menu-text">Dashboard</span>
								</a>
							</li>
							<li class="menu-section">
								<h4 class="menu-text">Manage Account</h4>
								<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
							</li>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="javascript:;" class="menu-link menu-toggle">
									<span class="svg-icon menu-icon">
									</span>
									<span class="menu-text">My Account</span>
									<i class="menu-arrow"></i>
								</a>
								<div class="menu-submenu">
									<i class="menu-arrow"></i>
									<ul class="menu-subnav">
										<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
											<a href="lending_company/update_profile.php" class="menu-link menu-toggle">
												<i class="menu-bullet">
													<span></span>
												</i>
												<span class="menu-text">My Profile</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="menu-section">
								<h4 class="menu-text">Manage Loan</h4>
								<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
							</li>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="javascript:;" class="menu-link menu-toggle">
									<span class="svg-icon menu-icon">
									</span>
									<span class="menu-text">Setup Loan</span>
									<i class="menu-arrow"></i>
								</a>
								<div class="menu-submenu">
									<ul class="menu-subnav">
										<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
											<a href="lending_company/setup_loan.php" class="menu-link menu-toggle">
												<span class="svg-icon menu-icon">
												</span>
												<span class="menu-text">Setup Loan Features</span>
											</a>
										</li>
										<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
											<a href="lending_company/set_requirements.php" class="menu-link menu-toggle">
												<span class="svg-icon menu-icon">
												</span>
												<span class="menu-text">Set Requirements</span>
											</a>
										</li>
										<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
											<a href="lending_company/setup_payment.php" class="menu-link menu-toggle">
												<span class="svg-icon menu-icon">
												</span>
												<span class="menu-text">Set Mode of Payment</span>
											</a>
										</li>
										<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
											<a href="lending_company/set_notice.php" class="menu-link menu-toggle">
												<span class="svg-icon menu-icon">
												</span>
												<span class="menu-text">Set Loan Notice</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="javascript:;" class="menu-link menu-toggle">
									<span class="svg-icon menu-icon">
									</span>
									<span class="menu-text">Loan Application</span>
									<i class="menu-arrow"></i>
								</a>
								<div class="menu-submenu">
									<i class="menu-arrow"></i>
									<ul class="menu-subnav">
										<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
											<a href="lending_company/pending_loan.php" class="menu-link menu-toggle">
												<i class="menu-bullet">
													<span></span>
												</i>
												<span class="menu-text">Pending Loan</span>
											</a>
										</li>
										<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
											<a href="lending_company/approved_loan.php" class="menu-link menu-toggle">
												<i class="menu-bullet">
													<span></span>
												</i>
												<span class="menu-text">Approved Loan</span>
											</a>
										</li>
										<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                            <a href="lending_company/released_loan.php" class="menu-link menu-toggle">
                                                <i class="menu-bullet">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Release Loan</span>
                                            </a>
                                        </li>
										<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
											<a href="lending_company/declined_loan.php" class="menu-link menu-toggle">
												<i class="menu-bullet">
													<span></span>
												</i>
												<span class="menu-text">Declined Loan</span>
											</a>
										</li>

									</ul>
								</div>
							</li>
							<li class="menu-section">
								<h4 class="menu-text">Manage Payment</h4>
								<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
							</li>
							<li class="menu-item menu-item-submenu" data-menu-toggle="hover">
							<a href="lending_company/record_payment.php" class="menu-link menu-toggle">
									<span class="svg-icon menu-icon">
									</span>
									<span class="menu-text">Add Payment</span>
								</a>
							</li>
							<li class="menu-item menu-item-submenu" data-menu-toggle="hover">
							<a href="lending_company/view_payment.php" class="menu-link menu-toggle">
									<span class="svg-icon menu-icon">
									</span>
									<span class="menu-text">Payment Records</span>
								</a>
							</li>
							<li class="menu-section">
								<h4 class="menu-text">Manage Report</h4>
								<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
							</li>
							<li class="menu-item menu-item-submenu" data-menu-toggle="hover">
							<a href="lending_company/generate_report.php" class="menu-link menu-toggle">
									<span class="svg-icon menu-icon">
									</span>
									<span class="menu-text">Generate Report</span>
								</a>
							</li>
							<!--end::Menu Nav-->
					</div>
					<!--end::Menu Container-->
				</div>
				<!--end::Aside Menu-->
			</div>
			<!--end::Aside-->

			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				<!--begin::Header-->
				<div id="kt_header" class="header header-fixed">
					<!--begin::Container-->
					<div class="container-fluid d-flex align-items-stretch justify-content-between">
						<!--begin::Header Menu Wrapper-->
						<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
							<!--begin::Header Menu-->
							<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
								<!--begin::Header Nav-->
								<ul class="menu-nav">
								<li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here menu-item-active" data-menu-toggle="click" aria-haspopup="true">
                                        <h4 class="menu-text" style="color:blue">Welcome to Hulam! <h4>&nbsp;&nbsp;
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
													?>
												</h6>
											<i class="menu-arrow"></i>
										 </li>
								</ul>
								<!--end::Header Nav-->
							</div>
							<!--end::Header Menu-->
						</div>
						<!--end::Header Menu Wrapper-->
						<!--begin::Topbar-->
						<div class="topbar">
							
							<!--begin::Notifications-->
							<div class="dropdown mr-1">
								<!--begin::Dropdown-->
								<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
									<form>
										<!--begin::Header-->
										<!--end::Header-->
										<!--begin::Content-->
										<div class="tab-content">
											<!--begin::Tabpane-->
											<div class="tab-pane active show p-8" id="topbar_notifications_notifications" role="tabpanel">
												<!--begin::Scroll-->
												<div class="scroll pr-7 mr-n7" data-scroll="true" data-height="300" data-mobile-height="200">
												</div>
												<!--end::Scroll-->
												<!--begin::Action-->
												<div class="d-flex flex-center pt-7">
													<a href="#" class="btn btn-light-primary font-weight-bold text-center">See All</a>
												</div>
												<!--end::Action-->
											</div>
											<!--end::Tabpane-->
											<!--begin::Tabpane-->
											<div class="tab-pane p-8" id="topbar_notifications_events" role="tabpanel">
												<!--begin::Scroll-->
												<div class="scroll pr-7 mr-n7" data-scroll="true" data-height="300" data-mobile-height="200">
													<!--begin::Item-->
													<div class="d-flex align-items-center mb-6">
														<!--begin::Symbol-->
														<div class="symbol symbol-40 symbol-light-primary mr-5">
															<span class="symbol-label">
																<span class="svg-icon svg-icon-lg svg-icon-primary">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Color-profile.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M12,10.9996338 C12.8356605,10.3719448 13.8743941,10 15,10 C17.7614237,10 20,12.2385763 20,15 C20,17.7614237 17.7614237,20 15,20 C13.8743941,20 12.8356605,19.6280552 12,19.0003662 C11.1643395,19.6280552 10.1256059,20 9,20 C6.23857625,20 4,17.7614237 4,15 C4,12.2385763 6.23857625,10 9,10 C10.1256059,10 11.1643395,10.3719448 12,10.9996338 Z M13.3336047,12.504354 C13.757474,13.2388026 14,14.0910788 14,15 C14,15.9088933 13.7574889,16.761145 13.3336438,17.4955783 C13.8188886,17.8206693 14.3938466,18 15,18 C16.6568542,18 18,16.6568542 18,15 C18,13.3431458 16.6568542,12 15,12 C14.3930587,12 13.8175971,12.18044 13.3336047,12.504354 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			<circle fill="#000000" cx="12" cy="9" r="5" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
														</div>
														<!--end::Symbol-->
														<!--begin::Text-->
														<div class="d-flex flex-column font-weight-bold">
															<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Project Launch</a>
															<span class="text-muted">Project campaign planning</span>
														</div>
														<!--end::Text-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex align-items-center mb-6">
														<!--begin::Symbol-->
														<div class="symbol symbol-40 symbol-light-warning mr-5">
															<span class="symbol-label">
																<span class="svg-icon svg-icon-lg svg-icon-warning">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
																			<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
														</div>
														<!--end::Symbol-->
														<!--begin::Text-->
														<div class="d-flex flex-column font-weight-bold">
															<a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg">Report Generation</a>
															<span class="text-muted">Annual report generation</span>
														</div>
														<!--end::Text-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex align-items-center mb-6">
														<!--begin::Symbol-->
														<div class="symbol symbol-40 symbol-light-success mr-5">
															<span class="symbol-label">
																<span class="svg-icon svg-icon-lg svg-icon-success">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Share.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M10.9,2 C11.4522847,2 11.9,2.44771525 11.9,3 C11.9,3.55228475 11.4522847,4 10.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,16 C20,15.4477153 20.4477153,15 21,15 C21.5522847,15 22,15.4477153 22,16 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L10.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			<path d="M24.0690576,13.8973499 C24.0690576,13.1346331 24.2324969,10.1246259 21.8580869,7.73659596 C20.2600137,6.12944276 17.8683518,5.85068794 15.0081639,5.72356847 L15.0081639,1.83791555 C15.0081639,1.42370199 14.6723775,1.08791555 14.2581639,1.08791555 C14.0718537,1.08791555 13.892213,1.15726043 13.7542266,1.28244533 L7.24606818,7.18681951 C6.93929045,7.46513642 6.9162184,7.93944934 7.1945353,8.24622707 C7.20914339,8.26232899 7.22444472,8.27778811 7.24039592,8.29256062 L13.7485543,14.3198102 C14.0524605,14.6012598 14.5269852,14.5830551 14.8084348,14.2791489 C14.9368329,14.140506 15.0081639,13.9585047 15.0081639,13.7695393 L15.0081639,9.90761477 C16.8241562,9.95755456 18.1177196,10.0730665 19.2929978,10.4469645 C20.9778605,10.9829796 22.2816185,12.4994368 23.2042718,14.996336 L23.2043032,14.9963244 C23.313119,15.2908036 23.5938372,15.4863432 23.9077781,15.4863432 L24.0735976,15.4863432 C24.0735976,15.0278051 24.0690576,14.3014082 24.0690576,13.8973499 Z" fill="#000000" fill-rule="nonzero" transform="translate(15.536799, 8.287129) scale(-1, 1) translate(-15.536799, -8.287129)" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
														</div>
														<!--end::Symbol-->
														<!--begin::Text-->
														<div class="d-flex flex-column font-weight-bold">
															<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Smart App</a>
															<span class="text-muted">Project Managemnt &amp; Design</span>
														</div>
														<!--end::Text-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex align-items-center mb-6">
														<!--begin::Symbol-->
														<div class="symbol symbol-40 symbol-light-danger mr-5">
															<span class="symbol-label">
																<span class="svg-icon svg-icon-lg svg-icon-danger">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/General/Thunder-move.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M16.3740377,19.9389434 L22.2226499,11.1660251 C22.4524142,10.8213786 22.3592838,10.3557266 22.0146373,10.1259623 C21.8914367,10.0438285 21.7466809,10 21.5986122,10 L17,10 L17,4.47708173 C17,4.06286817 16.6642136,3.72708173 16.25,3.72708173 C15.9992351,3.72708173 15.7650616,3.85240758 15.6259623,4.06105658 L9.7773501,12.8339749 C9.54758575,13.1786214 9.64071616,13.6442734 9.98536267,13.8740377 C10.1085633,13.9561715 10.2533191,14 10.4013878,14 L15,14 L15,19.5229183 C15,19.9371318 15.3357864,20.2729183 15.75,20.2729183 C16.0007649,20.2729183 16.2349384,20.1475924 16.3740377,19.9389434 Z" fill="#000000" />
																			<path d="M4.5,5 L9.5,5 C10.3284271,5 11,5.67157288 11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L4.5,8 C3.67157288,8 3,7.32842712 3,6.5 C3,5.67157288 3.67157288,5 4.5,5 Z M4.5,17 L9.5,17 C10.3284271,17 11,17.6715729 11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L4.5,20 C3.67157288,20 3,19.3284271 3,18.5 C3,17.6715729 3.67157288,17 4.5,17 Z M2.5,11 L6.5,11 C7.32842712,11 8,11.6715729 8,12.5 C8,13.3284271 7.32842712,14 6.5,14 L2.5,14 C1.67157288,14 1,13.3284271 1,12.5 C1,11.6715729 1.67157288,11 2.5,11 Z" fill="#000000" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
														</div>
														<!--end::Symbol-->
														<!--begin::Text-->
														<div class="d-flex flex-column font-weight-bold">
															<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Volume Service App</a>
															<span class="text-muted">Analytics &amp; Requirement Study</span>
														</div>
														<!--end::Text-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex align-items-center mb-6">
														<!--begin::Symbol-->
														<div class="symbol symbol-40 symbol-light-info mr-5">
															<span class="symbol-label">
																<span class="svg-icon svg-icon-lg svg-icon-info">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Shield-user.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
																			<path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3" />
																			<path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
														</div>
														<!--end::Symbol-->
														<!--begin::Text-->
														<div class="d-flex flex-column font-weight-bold">
															<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Reportio App</a>
															<span class="text-muted">Reporting Dashboard App Planning</span>
														</div>
														<!--end::Text-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex align-items-center mb-6">
														<!--begin::Symbol-->
														<div class="symbol symbol-40 symbol-light-primary mr-5">
															<span class="symbol-label">
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
														</div>
														<!--end::Symbol-->
														<!--begin::Text-->
														<div class="d-flex flex-column font-weight-bold">
															<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Expo Loop</a>
															<span class="text-muted">System Analytics &amp; Development</span>
														</div>
														<!--end::Text-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex align-items-center mb-6">
														<!--begin::Symbol-->
														<div class="symbol symbol-40 symbol-light-info mr-5">
															<span class="symbol-label">
																<span class="svg-icon svg-icon-lg svg-icon-info">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z" fill="#000000" fill-rule="nonzero" transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
																			<path d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z" fill="#000000" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
														</div>
														<!--end::Symbol-->
														<!--begin::Text-->
														<div class="d-flex flex-column font-weight-bold">
															<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Klup App</a>
															<span class="text-muted">App Design &amp; Development</span>
														</div>
														<!--end::Text-->
													</div>
													<!--end::Item-->
												</div>
												<!--end::Scroll-->
											</div>
											<!--end::Tabpane-->
											<!--begin::Tabpane-->
											<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
												<!--begin::Nav-->
												<div class="d-flex flex-center font-weight-bold text-center text-muted min-h-250px">All caught up!
													<br />No new messages.
												</div>
												<!--end::Nav-->
											</div>
											<!--end::Tabpane-->
										</div>
										<!--end::Content-->
									</form>
								</div>
								<!--end::Dropdown-->
							</div>
							<!--end::Notifications-->
							<!--begin::Quick panel-->
							<!--end::Notifications-->
                            <!--begin::Quick panel-->
                            <!--<div class="topbar-item mr-1">
                                <div class="btn btn-icon btn-clean btn-lg" id="kt_quick_panel_toggle">
                                    <span class="svg-icon svg-icon-xl svg-icon-primary">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon
                                    </span>
                                </div>
                            </div>-->
							<!--end::Quick panel-->
							<!--begin::Chat-->
							<div class="topbar-item">
								<div class="btn btn-icon btn-clean btn-lg mr-1" data-toggle="modal" data-target="#kt_chat_modal">
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
							<!--end::Chat-->
							<!--begin::Languages-->
							<div class="dropdown mr-1">
								<!--begin::Dropdown-->
								<div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
									<!--begin::Nav-->

									<!--end::Nav-->
								</div>
								<!--end::Dropdown-->
							</div>
							<!--end::Languages-->
							<!--begin::User-->
							<div class="topbar-item ml-4">
								<div class="btn btn-icon btn-light-primary h-40px w-40px p-0" id="kt_quick_user_toggle">
									<img src="assets/admin/media/users/icon-company.jpg" class="h-30px align-self-end" alt="" />
								</div>
							</div>
							<!--end::User-->
						</div>
						<!--end::Topbar-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Header-->
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="background-image:url('assets/keen/media/logos/banner.png')">
					<div class="subheader py-6 py-lg-8 subheader-transparent" id="kt_subheader">
						<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
							<div class="d-flex align-items-center flex-wrap mr-1">
								<div class="d-flex align-items-baseline flex-wrap mr-5">
									<h4 class="text-white font-weight-bold my-1 mr-5">Dashboard |</h4>
									<h5 class="text-white font-weight-bold my-1 mr-5">Lending Investor</h5>
									<div class="col-xl-12 col-xl-12">
										<?php
										if(isset($_SESSION['status_released'])){
										?>
											<div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
												<div class="alert-text">
													<h4><?php echo $_SESSION['status_released'];?></h4>
												</div>
												<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
											</div>
										<?php unset($_SESSION['status_released']);
										}?>
									</div>
								</div>
							</div>
							<div class="d-flex align-items-center flex-wrap">
								<a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm px-5 my-1 mr-3" id="kt_dashboard_daterangepicker" data-toggle="tooltip" title="Select dashboard daterange" data-placement="top">
									<span class="opacity-60 font-weight-bolder mr-2" id="kt_dashboard_daterangepicker_title">Today</span>
									<span class="font-weight-bolder" id="kt_dashboard_daterangepicker_date">Aug 16</span>
								</a>
							</div>
						</div>
					</div>
					<!--end::Subheader-->
					<!--begin::Entry-->
					<div class="d-flex flex-column-fluid">
						<!--begin::Container-->
						<div class="container">
							<div class="card card-custom gutter-b">
								<div class="card-body">
									<!--begin::Top-->
									<div class="d-flex">
										<!--begin::Pic-->
										<div class="flex-shrink-0 mr-7">
											<div class="symbol symbol-50 symbol-lg-120">
											<img alt="Pic" src="/hulam/assets/keen/hulam_media/<?=$debtor ['profile_pic'] ?>">
											</div>
										</div>
										<!--end::Pic-->
										<!--begin: Info-->
										<div class="flex-grow-1">
											<!--begin::Title-->
											<div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
												<!--begin::User-->
												<div class="mr-3">
													<!--begin::Name-->
													<h4 class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $debtor ['firstname'] . ' ' . $debtor ['middlename'] . ' ' . $debtor ['lastname'] ?></h4>
													<?php
													if($debtor ['loan_status']=='Pending'):?>
														<span class="text-warning font-weight-bolder mr-2">&nbsp;<?= $debtor ['loan_status']?></span>
													<?php elseif($debtor ['loan_status']=='Approved'):?>
														<span class="text-primary font-weight-bolder mr-2">&nbsp;<?= $debtor ['loan_status']?></span>
													<?php elseif($debtor ['loan_status']=='Released'):?>
														<span class="text-info font-weight-bolder mr-2">&nbsp;<?= $debtor ['loan_status']?></span>
													<?php else:?>
														<span class="text-danger font-weight-bolder mr-2">&nbsp;<?= $debtor ['loan_status']?></span>
													<?php endif; ?>
													<!--end::Name-->
													<!--begin::Contacts-->
													<div class="d-flex flex-wrap my-2">
														<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
															<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"></rect>
																	<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"></path>
																	<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"></circle>
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
														<span class="mr-2"><?= $debtor ['email'] ?></span>
													</div>
													<div class="d-flex flex-wrap my-2">
														<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
															<!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker2.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"></rect>
																	<path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"></path>
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span><?= $debtor ['p_street'] . ' ' . $debtor ['p_barangay'] . ' ' . $debtor ['p_city'] . ' ' . $debtor ['p_province'] . ' ' . $debtor ['p_zipcode'] ?>
													</div>
													<div class="d-flex flex-wrap my-2">
														<span class="font-weight-bolder font-size-sm">Contact No:
														</span><?= $debtor ['mobile'] ?>
													</div>
													<!--end::Contacts-->
												</div>
												<!--begin::User-->

												<!--begin::Actions-->
												<div class="my-lg-0 my-1">
													<!-- <?php if($user['loan_status']=='Released'):?>
														<a href="#" class="btn btn-sm btn-light-danger font-weight-bolder mr-2" data-toggle="modal" data-target="#declined_loan">Declined Loan</a>
													<?php elseif($user['loan_status']=='Approved'):?>
													<a href="#" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#released_loan">Released Loan</a>
													<?php endif;?> -->
													<a href="#" class="btn btn-sm btn-light-success font-weight-bolder mr-2" data-toggle="modal" data-target="#message">Send Message</a>
													<!-- <a href="#" class="btn btn-sm btn-light-danger font-weight-bolder mr-2" data-toggle="modal" data-target="#declined_loan">Declined Loan</a> -->
												</div>
												<!--end::Actions-->
											</div>
											<!--end::Title-->
										</div>
										<!--end::Info-->
									</div>
									<!--end::Top-->
									<!--begin::Separator-->
									<div class="separator separator-solid my-7"></div>
									<!--end::Separator-->
									<!--begin::Bottom-->
									<div class="d-flex align-items-center flex-wrap">
										<?php
										$id = intval($_GET['loan_app_id']);

										$sql = "SELECT loan_application.*, user.* FROM loan_application INNER JOIN user on loan_application.debtor_id = user.user_id WHERE loan_application.loan_app_id = $id";
										$query = $dbh->prepare($sql);
										$query->execute();
										$user = $query->fetch();

										$id = $user['debtor_id'];

										$sql = "SELECT * FROM debtors_info WHERE user_id = $id";
										$que = $dbh->prepare($sql);
										$que->execute();
										$res = $que->fetch();
										?>
										<!--begin: Item-->
										<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
											<div class="d-flex flex-column text-dark-75">
												<span class="font-weight-bolder font-size-m">Source of Income</span>
												<span class="font-size-sm">Company Name: &nbsp;<?= $res['company_name'] ?></span>
												<span class="font-size-sm">Monthly Salary: &nbsp;<?= $res['monthly_salary'] ?></span>
												<span class="font-size-sm">Monthly Salary: &nbsp;<?= $res['company_street'] . ' ' . $res['company_barangay'] . ' ' . $res['company_city']
																										. ' ' . $res['company_province'] . ' ' . $res['company_zipcode'] ?></span>
											</div>
										</div>
										<!--end: Item-->
										<!--begin: Item-->
										<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
											<div class="d-flex flex-column text-dark-75">
												<span class="font-weight-bolder font-size-m">Relative Contact:</span>
												<span class="font-size-sm">Relative Name: &nbsp;<?= $res['rel_name'] ?></span>
												<span class="font-size-sm">Relative Mobile No: &nbsp;<?= $res['rel_mobile'] ?></span>
												<span class="font-size-sm">Relation: &nbsp;<?= $res['rel_type'] ?></span>
											</div>
										</div>
										<!--end: Item-->
									</div>
									<!--end::Bottom-->
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<!--begin::Charts Widget 4-->
									<div class="card card-custom card-stretch gutter-b">
										<!--begin::Header-->
										<div class="card-header h-auto border-0">
											<div class="card-title py-5">
												<h3 class="card-label">
													<span class="d-block text-dark font-weight-bolder">Loan Application Details</span>
													<!-- <span class="d-block text-muted mt-2 font-size-sm">More than 500+ new orders</span> -->
												</h3>
											</div>
											<table class="table table-bordered">
												<thead>
													<!-- <tr>
															<th>Application Date</th>

														</tr> -->
												</thead>
												<tbody>
													<?php
													$loan_app_id = intval($_GET['loan_app_id']);

													$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
													$query = $dbh->prepare($sql);
													$query->execute();
													$results = $query->fetchAll(PDO::FETCH_OBJ);
													if ($query->rowCount() > 0) {
														foreach ($results as $res) {
													?>
															<tr>
																<td>Approval Date</td>
																<td><?= htmlentities($res->approval_date); ?></td>
															</tr>
															<tr>
																<td>Released Date</td>
																<td><?= htmlentities($res->released_date); ?></td>
															</tr>
															<tr>
																<td>Application Date</td>
																<td><?= htmlentities($res->date); ?></td>
															</tr>
															<tr>
																<td>Loan Amount</td>
																<td><?= number_format(htmlentities($res->loan_amount), 2); ?></td>
															</tr>
															<tr>
																<td>Loan Term</td>
																<td><?= htmlentities($res->loan_term); ?></td>
															</tr>
															<tr>
																<td>Fix Rate</td>
																<td><?= htmlentities($res->fix_rate); ?>%</td>
															</tr>
															<tr>
																<td>Total Interest</td>
																<td><?= number_format(htmlentities($res->total_interest), 2); ?></td>
															</tr>
															<tr>
																<td>Late Charge</td>
																<td><?= htmlentities($res->late_charges); ?>%</td>
															</tr>
															<tr>
																<td>Total Amoun to Pay</td>
																<td><?= number_format(htmlentities($res->total_amount), 2); ?></td>
															</tr>
															<tr>
																<td>Monthly Payment</td>
																<td><?= number_format(htmlentities($res->monthly_payment), 2); ?></td>

												</tbody>
										<?php }
													} ?>
											</table>
										</div>
										<!--end::Header-->
									</div>
									<!--end::Charts Widget 4-->
								</div>
								<div class="col-lg-6">
									<!--begin::List Widget 11-->
									<div class="card card-custom card-stretch gutter-b">
										<!--begin::Header-->
										<div class="card-header border-0">
											<h3 class="card-title font-weight-bolder text-dark">Submitted Requirements</h3>
											<div class="card-toolbar">
												<div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
												</div>
											</div>
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body pt-0">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Type of Documents</th>
														<th>Uploaded Documents</th>
														<!-- <th>Action</th> -->
													</tr>
												</thead>
												<tbody>
													<?php
													$loan_app_id = intval($_GET['loan_app_id']);

													$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
													$query = $dbh->prepare($sql);
													$query->execute();
													$results = $query->fetchAll(PDO::FETCH_OBJ);
													if ($query->rowCount() > 0) {
														foreach ($results as $res) {
													?>
															<tr>
																<td>Valid ID</td>
																<td><a href="/hulam/assets/keen/hulam_media/<?= htmlentities($res->barangay_clearance) ?>" target="_blank"><?= htmlentities($res->barangay_clearance); ?></a></td>
															</tr>
															<tr>
																<td>Barangay Clearanace</td>
																<td><a href="/hulam/assets/keen/hulam_media/<?= htmlentities($res->barangay_clearance) ?>" target="_blank"><?= htmlentities($res->barangay_clearance); ?></a></td>
															</tr>
															<tr>
																<td>Payslip</td>
																<td><a href="/hulam/assets/keen/hulam_media/<?= htmlentities($res->payslip) ?>" target="_blank"><?= htmlentities($res->payslip); ?></a></td>
															</tr>
															<tr>
																<td>Cedula</td>
																<td><a href="/hulam/assets/keen/hulam_media/<?= htmlentities($res->cedula) ?>" target="_blank"><?= htmlentities($res->cedula); ?></a></td>
															</tr>
															<tr>
																<td>ATM Latest Transaction Receipt</td>
																<td><a href="/hulam/assets/keen/hulam_media/<?= htmlentities($res->atm_transaction) ?>" target="_blank"><?= htmlentities($res->atm_transaction); ?></a></td>
															</tr>
															<tr>
																<td>Certificate of Employment</td>
																<td><a href="/hulam/assets/keen/hulam_media/<?= htmlentities($res->coe) ?>" target="_blank"><?= htmlentities($res->coe); ?></a></td>
															</tr>
															<tr>
																<td>Bank Statement</td>
																<td><a href="/hulam/assets/keen/hulam_media/<?= htmlentities($res->bank_statement) ?>" target="_blank"><?= htmlentities($res->bank_statement); ?></a></td>
															</tr>
															<tr>
																<td>Proof of Billing</td>
																<td><a href="/hulam/assets/keen/hulam_media/<?= htmlentities($res->proof_billing) ?>" target="_blank"><?= htmlentities($res->proof_billing); ?></a></td>
															</tr>
															<tr>
																<td>Co-Maker ID</td>
																<td><a href="/hulam/assets/keen/hulam_media/<?= htmlentities($res->co_maker_id) ?>" target="_blank"><?= htmlentities($res->co_maker_id); ?></a></td>
															</tr>
															<tr>
																<td>Co-Maker Cedula</td>
																<td><a href="/hulam/assets/keen/hulam_media/<?= htmlentities($res->co_maker_cedula) ?>" target="_blank"><?= htmlentities($res->co_maker_cedula); ?></a></td>
															</tr>
															<tr>
																<td>2x2 ID</td>
																<td><a href="/hulam/assets/keen/hulam_media/<?= htmlentities($res->id_pic) ?>" target="_blank"><?= htmlentities($res->id_pic); ?></a></td>
															</tr>
															<tr>
																<td>Official Receipt or Certificate of Registration</td>
																<td><a href="/hulam/assets/keen/hulam_media/<?= htmlentities($res->or_cr) ?>" target="_blank"><?= htmlentities($res->or_cr); ?></a></td>
															</tr>
															<tr>
																<td>Other Document</td>
																<td><a href="/hulam/assets/keen/hulam_media/<?= htmlentities($res->others) ?>" target="_blank"><?= htmlentities($res->others); ?></a></td>
															</tr>
												</tbody>
										<?php }
													} ?>
											</table>
											<!-- Start Modal Approved Loan -->
											<form action="" method="post" enctype="multipart/form-data">
												<div class="modal fade" id="released_loan" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Release Loan?</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<i aria-hidden="true" class="ki ki-close"></i>
																</button>
															</div>
															<!-- <div class="modal-body">
																	<label>Set Releasing Date:</label>
																	<input type="date" name="release_schedule">
															</div> -->
																<?php

																date_default_timezone_set('Asia/Manila');
																$todays_date = date("y-m-d h:i:sa");
																$today = strtotime($todays_date);
																$det = date('Y-m-d h:i:sa', $today);

																?>
																<input type="hidden" name="released_date" value="<?= $det; ?>">
                                                                <input type="hidden" name="loan_message" value="Your loan is released dated <?= $det; ?>. Thank you!">
                                                                <input type="hidden" name="receiver_id" value="<?= htmlentities($res->debtor_id) ?>"> 
																<input type="hidden" name="sender_id" value="<?= $_SESSION['user_id'] ?>">
																<input type="hidden" name="remaining_balance" value="<?= htmlentities($res->total_amount)?>">
																<input type="hidden" name="monthly_interest" value="<?php echo $m = htmlentities($res->loan_amount) * (htmlentities($res->fix_rate)/100) ?>">">
																<input type="text" name="monthly_payable" value="<?= htmlentities($res->monthly_payment)- $m; ?>"> 
															
																
																<?php 
																date_default_timezone_set('Asia/Manila');
																$set_date = date("y-m-d h:i:sa");
																$nextduedate = strtotime('+1 month',strtotime($set_date));
																$det2 = date('Y-m-d h:i:sa', $nextduedate);
																// $d = date("d F Y",strtotime('+1 month',strtotime($res->approval_date)));
																?>
																<input type="hidden" name="monthly_due_date" value="<?= $det2; ?>">


															<div class="modal-footer">
																<!-- <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">No</button> -->
																<button type="submit" name="released_loan" class="btn btn-primary font-weight-bold">Yes</button>
															</div>
														</div>
													</div>
												</div>
											</form>
											<!-- End Modal -->
											<!-- Start Modal Approved Loan -->
											<form action="" method="post" enctype="multipart/form-data">
												<div class="modal fade" id="declined_loan" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Decline Loan?</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<i aria-hidden="true" class="ki ki-close"></i>
																</button>
															</div>
															<div class="modal-footer">
																<!-- <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">No</button> -->
																<button type="submit" name="declined_loan" class="btn btn-primary font-weight-bold">Yes</button>
															</div>
														</div>
													</div>
												</div>
											</form>
											<!-- End Modal -->
											<!-- Start Modal Approved Loan -->
											<form action="" method="post">
												<div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-m" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<i aria-hidden="true" class="ki ki-close"></i>
																</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="receiver_id" value="<?= htmlentities($res->debtor_id) ?>">
																<input type="hidden" name="sender_id" value="<?= $_SESSION['user_id'] ?>">
																<?php
																date_default_timezone_set('Asia/Manila');
																$todays_date = date("y-m-d h:i:sa");
																$today = strtotime($todays_date);
																$det = date("Y-m-d h:i:sa", $today);

																?>
																<input type="hidden" name="date_message" value="<?= $det; ?>">
																<div class="col-lg-12">
																	<textarea rows="4" cols="50" name="message" class="form-control" placeholder="Type here....."></textarea>
																</div>
															</div>
															<div class="modal-footer">
																<!-- <button type="button" class="btn btn-light-danger" data-dismiss="modal">Cancel</button> -->
																<button type="submit" name="send_message" class="btn btn-light-primary font-weight-bold">Send</button>
															</div>
														</div>
													</div>
												</div>
											</form>
											<!-- End Modal -->
										</div>
										<!--end::Body-->
									</div>
									<!--end::List Widget 11-->
								</div>
								<div class="col-lg-12">
									<!--begin::Charts Widget 4-->
									<div class="card card-custom card-stretch gutter-b">
										<!--begin::Header-->
										<div class="card-header h-auto border-0">
											<div class="card-title py-5">
												<h3 class="card-label">
													<span class="d-block text-dark font-weight-bolder">Running Balance</span>
													<!-- <span class="d-block text-muted mt-2 font-size-sm">More than 500+ new orders</span> -->
												</h3>
											</div>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Payment Month Date</th>
														<th>Principal Payment</th>
														<th>Interest Payment</th>
														<th>Total Monthly Payment</th>
														<th>Remaining Balance</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$loan_app_id = intval($_GET['loan_app_id']);

													$sql = "SELECT * FROM running_balance WHERE loan_app_id = $loan_app_id";
													$query = $dbh->prepare($sql);
													$query->execute();
													$results = $query->fetchAll(PDO::FETCH_OBJ);
													if ($query->rowCount() > 0) {
														foreach ($results as $res) {
															//$d = date("d F Y",strtotime('+1 month',strtotime($res->approval_date)));
														
													?>
													<tr>
														<td><?php 
															$approved = $debtor['released_date']; 
															// $nextduedate = strtotime('+1 month',strtotime($approved));
															// $monthly_due_date = date('y-m-d', $nextduedate);
															//echo date("F-d- Y", $d);

															echo date("F-d- Y", strtotime($approved. ' +1 month'));
															// date_default_timezone_set('Asia/Manila');
															// $monthly_due_date = htmlentities($res->paid_date);
															// $d = strtotime($monthly_due_date);
															// echo date("F-d- Y", $d); 
															?>
															
														</td>

														<td>
															<?php 
															$amount = $debtor['loan_amount']/ $debtor['loan_term'];
															echo number_format(($amount), 2);
															?>
														</td>
														<td>
														<?php 
															$amount = $debtor['loan_amount'] * ($debtor['fix_rate']/100);
															echo number_format(($amount), 2);
															?>
														</td>
														<td>
															<?php
															$amount1 = $debtor['loan_amount']/ $debtor['loan_term'];
															$amount2 = $debtor['loan_amount'] * ($debtor['fix_rate']/100);
															$to = $amount1 + $amount2;
															echo number_format(($to), 2);
															?> 
															</td>
														<td>
														<?php
															$amount1 = $debtor['loan_amount']/ $debtor['loan_term'];
															$amount2 = $debtor['loan_amount'] * ($debtor['fix_rate']/100);
															$x = $amount2 * $debtor['loan_term'];
															$to = $amount1 + $amount2;
															$lo = $debtor['loan_amount'] + $x;
															$yes = $lo-$to;
															echo number_format(($yes), 2);
															?> 
														</td>
													</tr>
													
												</tbody>
										<?php }} ?>	
											</table>
										</div>
										<!--end::Header-->
									</div>
									<!--end::Charts Widget 4-->
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end::Container-->
			</div>
			<!--end::Entry-->
		</div>
		<!--end::Content-->
		<!--begin::Footer-->
		<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
			<!--begin::Container-->
			<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
				<!--begin::Copyright-->
				<div class="text-dark order-2 order-md-1">
					<span class="text-muted font-weight-bold mr-2">2021©</span>
					<a href="https://keenthemes.com/keen" target="_blank" class="text-dark-75 text-hover-primary">The Hulam Team</a>
				</div>
				<!--end::Copyright-->
				<!--begin::Nav-->
				<div class="nav nav-dark">
					<a href="https://keenthemes.com/keen" target="_blank" class="nav-link pl-0 pr-2">About</a>
					<a href="https://keenthemes.com/keen" target="_blank" class="nav-link pr-2">Team</a>
					<a href="https://keenthemes.com/keen" target="_blank" class="nav-link pr-0">Contact</a>
				</div>
				<!--end::Nav-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Footer-->
	</div>
	<!--end::Wrapper-->
	</div>
	<!--end::Page-->
	</div>
	<!--end::Main-->

		<!-- begin::User Panel-->
		<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
			<!--begin::Header-->
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
				<h3 class="font-weight-bold m-0">Profile
				
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
					<div class="symbol-label" style="background-image:url('/hulam/assets/keen/hulam_media/<?= $user['profile_pic'] ?>')"></div>
						<i class="symbol-badge bg-success"></i>
					</div>
					<div class="d-flex flex-column">
						<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= $user['company_name']?></a>
						<div class="text-muted mt-1"></div>
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
					<a href="lending_company/update_profile.php" class="navi-item">
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
					<a href="lending_company/make_announcement.php" class="navi-item">
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
								<div class="font-weight-bold">Make Announcement</div>
							</div>
						</div>
					</a>
					<!--end:Item-->
					<!--begin::Item-->
				<a href="lending_company/send_feedback.php" class="navi-item">
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
					<a class="nav-link active" data-toggle="tab" href="#kt_chat_modal">Messages</a>
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
				<div class="navi navi-icon-circle navi-spacer-x-0">
					<?php
					$user_id = $_SESSION['user_id'];
					$sql = "SELECT * FROM message INNER JOIN user ON message.sender_id = user.user_id WHERE message.receiver_id = $user_id ORDER BY date_message desc";
					$query = $dbh->prepare($sql);
					$query->execute();
					$results = $query->fetchAll(PDO::FETCH_OBJ);

					foreach ($results as $res) :

					?> <a href="lending_company/messages.php?sender_id=<?= htmlentities($res->sender_id) ?>">
							<div class="navi-link rounded">
								<div class="symbol symbol-50 mr-3">
								</div>
								<div class="navi-text">
									<div class="font-weight-bold font-size-lg">
										<?php
										$red = htmlentities($res->user_type);

										if ($red == 1) : ?>
											<?= htmlentities($res->firstname) . ' ' . htmlentities($res->middlename) . ' ' . htmlentities($res->lastname); ?>
										<?php elseif ($red == 2) : ?>
											<?= htmlentities($res->firstname) . ' ' . htmlentities($res->middlename) . ' ' . htmlentities($res->lastname); ?>
										<?php elseif ($red == 3) : ?>
											<?= htmlentities($res->company_name); ?>
										<?php elseif ($red == 4) : ?>
											<?= htmlentities($res->firstname) . ' ' . htmlentities($res->middlename) . ' ' . htmlentities($res->lastname); ?>
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
		</div>
	</div>
	<!--end::Content-->
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
				"xxl": 1400
			},
			"colors": {
				"theme": {
					"base": {
						"white": "#ffffff",
						"primary": "#3E97FF",
						"secondary": "#E5EAEE",
						"success": "#08D1AD",
						"info": "#844AFF",
						"warning": "#F5CE01",
						"danger": "#FF3D60",
						"light": "#E4E6EF",
						"dark": "#181C32"
					},
					"light": {
						"white": "#ffffff",
						"primary": "#DEEDFF",
						"secondary": "#EBEDF3",
						"success": "#D6FBF4",
						"info": "#6125E1",
						"warning": "#FFF4DE",
						"danger": "#FFE2E5",
						"light": "#F3F6F9",
						"dark": "#D6D6E0"
					},
					"inverse": {
						"white": "#ffffff",
						"primary": "#ffffff",
						"secondary": "#3F4254",
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
					"gray-200": "#EBEDF3",
					"gray-300": "#E4E6EF",
					"gray-400": "#D1D3E0",
					"gray-500": "#B5B5C3",
					"gray-600": "#7E8299",
					"gray-700": "#5E6278",
					"gray-800": "#3F4254",
					"gray-900": "#181C32"
				}
			},
			"font-family": "Poppins"
		};
	</script>
	<!--end::Global Config-->
	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="assets/admin/plugins/global/plugins.bundle.js"></script>
	<script src="assets/admin/plugins/custom/prismjs/prismjs.bundle.js"></script>
	<script src="assets/admin/js/scripts.bundle.js"></script>
	<!--end::Global Theme Bundle-->
	<!--begin::Page Vendors(used by this page)-->
	<script src="assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
	<!--end::Page Vendors-->
	<!--begin::Page Scripts(used by this page)-->
	<script src="assets/admin/js/pages/widgets.js"></script>
	<!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>
