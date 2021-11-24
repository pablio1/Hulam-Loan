<?php
session_start();
error_reporting(0);
include('../db_connection/config.php');
if ($_SESSION['user_type'] != 3) {
	header('location: ../index.php');
} ?>

<?php
$user_id = $_SESSION['user_id'];

$sql ="SELECT * FROM user WHERE user_id = $user_id";
$query = $dbh->prepare($sql);
$query->execute();
$user = $query->fetch();


$loan_app_id = intval($_GET['loan_app_id']);
$query = $dbh->prepare("SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id");
$query->execute();
$loanAppDetail = $query->fetch();


$lateCharges = (($loanAppDetail['late_charges'] / 100) * $loanAppDetail['monthly_payment'] );// + $loanAppDetail['monthly_payment'];
$monthlyPaymentLoad = $loanAppDetail['monthly_payment'];

?>


<?php

?>
<?php

//echo "<script>alert(1)</script>";


if(isset($_POST["payId"])){
	$dtId=$_POST["payId"];

	if ($dtId != "")
	{
		

	$query = $dbh->prepare("SELECT * FROM loan_payment_detail WHERE lp_Id = $dtId");
	$query->execute();
	$loanPaymentSelected = $query->fetch();

	//print_r($loanPaymentSelected);
	
	$loadAppId = $_GET['loan_app_id'];
	$currentPaymentMonth = $loanPaymentSelected['due_date'];
	$monthlyPayAmt = $loanPaymentSelected['monthly_pay'];


	$query = $dbh->prepare("SELECT * FROM loan_application WHERE loan_app_id = $loadAppId");
	$query->execute();
	$loanAppDetail = $query->fetch();

	$query = $dbh->prepare("SELECT * FROM loan_payment_detail WHERE loan_app_id = $loadAppId");
	$query->execute();
	$loanpaymentDetails = $query->fetchAll(PDO::FETCH_OBJ);

	//print_r($loanAppDetail);
	$lateCharges = (($loanAppDetail['late_charges'] / 100) * $monthlyPayAmt ) + $monthlyPayAmt;
	$lateChargesFee = (($loanAppDetail['late_charges'] / 100) * $monthlyPayAmt );
	//echo "<script>alert('lateCharges: $lateCharges')</script>";

	$TotalLateCharge = 0;
	$TotalAllMonthDue = 0;

	$monthlyPasDuePayAmt = 0;
	$monthlyPasDuePayCharge = 0;

	$selectedDateDue = $loanPaymentSelected['status'];
	//echo "<script>alert('lateCharges: $selectedDateDue')</script>";

	$passDueId[] = null;
	$pasDueIds = "";

	$noMonthDue = 0;
	$noMonthDueSemiPayed = 0;
	foreach ($loanpaymentDetails as $dtDetail)
	{
		$status = $dtDetail->status;
		$dtIdDetailsId = $dtDetail->lp_Id;

		if ($dtId == $dtDetail->lp_Id)
		{
			break;
		}

		if ($status == 0)
		{
			$monthlyPasDuePayAmt = $monthlyPayAmt;
			$TotalLateCharge = ($loanAppDetail['late_charges'] / 100) * $monthlyPayAmt;
			$monthlyPasDuePayCharge = ($loanAppDetail['late_charges'] / 100) * $monthlyPayAmt;
			//$TotalAllMonthDue = $TotalAllMonthDue + $lateCharges + $monthlyPayAmt;

			$passDueId[] = $dtIdDetailsId;
			$pasDueIds .= "-".$dtIdDetailsId;
			$noMonthDue++;

		}
		else if ($status == -1)
		{
			$monthlyPasDuePayAmt = ($monthlyPayAmt / 2);
			$TotalLateCharge = ($loanAppDetail['late_charges'] / 100) * $monthlyPayAmt;
			$monthlyPasDuePayCharge = ($loanAppDetail['late_charges'] / 100) * $monthlyPayAmt;
			//$TotalAllMonthDue = $TotalAllMonthDue + $lateCharges;// + $monthlyPasDuePayAmt;

			$pasDueIds .= "-".$dtIdDetailsId;
			$noMonthDue++;
			$noMonthDueSemiPayed++;
		}
	}


	

	if ($noMonthDue == 0)
	{
		$noMonthDue = 1;
	}
	//echo "<script>alert('$noMonthDueSemiPayed')</script>";
	//
	//Number of month equal to 0 has semi payment
	if ($noMonthDueSemiPayed == 0)
	{
		$totalPasDueMonthly = $monthlyPasDuePayAmt * $noMonthDue;
		$totalPasDueLateChage = $monthlyPasDuePayCharge * $noMonthDue;
	
		$totalPasDueAmount = $totalPasDueMonthly  + $totalPasDueLateChage;
		$pasDueAdvance = $totalPasDueMonthly / 2;

		$TotalAllMonthDue = $totalPasDueAmount;
	}
	else
	{
		$monthlyPasDuePayAmt = $monthlyPayAmt;
		$totalPasDueMonthly = $monthlyPasDuePayAmt * $noMonthDue;
		$totalPasDueLateChage = $monthlyPasDuePayCharge * $noMonthDue;
	
		$totalPasDueAmount = $totalPasDueMonthly  + $totalPasDueLateChage;
		$pasDueAdvance = $monthlyPayAmt * $noMonthDueSemiPayed;

		//echo "<script>alert('$noMonthDueSemiPayed * $monthlyPayAmt')</script>";
		
		for ( $x = 0; $x < $noMonthDueSemiPayed; $x++ )
		{
			$totalPasDueAmount = $totalPasDueAmount - ($monthlyPayAmt / 2);
			$pasDueAdvance = abs($pasDueAdvance - ($monthlyPayAmt / 2));
		}

		
		$TotalAllMonthDue = $totalPasDueAmount;
	}
	//abs($pasDueAdvance);

	if ($TotalAllMonthDue == 0)
	{
		$TotalAllMonthDue = $monthlyPayAmt;
	}
}
else
{
	//$loan['monthly_payment'] = 0;
}
	//echo "<script>alert('$totalPasDueAmount')</script>";
}
?>

<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
	<base href="../">
	<meta charset="utf-8" />
	<title>Hulam | Dashboard</title>
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
			<img alt="Logo" src="assets/keen/hulam_media/<?= $user['profile_pic'] ?>" class="h-60px w-60px" style="padding-top: 10%; padding: right 50%;" />
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
				<div class="brand flex-column-auto " id="kt_brand">
					<!--begin::Logo-->
					<a href="lending_company/index.php" class="brand-logo">
						<img alt="Logo" src="/hulam/assets/keen/hulam_media/<?= $user['profile_pic'] ?>" class="h-100px w-90px" style="padding-top: 20%; padding: right 50%;" />
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
								<a href="lending_company/released_loan.php" class="menu-link menu-toggle">
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
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="javascript:;" class="menu-link menu-toggle">
									<span class="svg-icon menu-icon">
									</span>
									<span class="menu-text">Generate Report</span>
									<i class="menu-arrow"></i>
								</a>
								<div class="menu-submenu">
									<ul class="menu-subnav">
										<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
											<a href="lending_company/generate_report.php" class="menu-link menu-toggle">
												<span class="svg-icon menu-icon">
												</span>
												<span class="menu-text">Debtor Report</span>
											</a>
										</li>
									</ul>
								</div>
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
							<!--begin::Quick panel-->
							<div class="topbar-item mr-1">
								<div class="btn btn-icon btn-clean btn-lg" id="kt_quick_panel_toggle">
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
							<!--end::Quick panel-->
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
									<img src="assets/keen/hulam_media/<?= $user['profile_pic'] ?>" class="h-40px align-self-end" alt="" />
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
					<!--begin::Subheader-->
					<div class="subheader py-6 py-lg-8 subheader-transparent" id="kt_subheader">
						<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
							<!--begin::Info-->
							<div class="d-flex align-items-center flex-wrap mr-1">
								<!--begin::Page Heading-->
								<div class="d-flex align-items-baseline flex-wrap mr-5">
									<!--begin::Page Title-->
									<h4 class="text-white font-weight-bold my-1 mr-5">Dashboard |</h4>
									<h5 class="text-white font-weight-bold my-1 mr-5">Lending Investor</h5>
									<div class="col-xl-12 col-xl-12">
										<?php
										if (isset($_SESSION['status_payment'])) {
										?>
											<div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
												<div class="alert-text">
													<h4><?php echo $_SESSION['status_payment']; ?></h4>
												</div>
												<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
											</div>
										<?php unset($_SESSION['status_payment']);
										} ?>
									</div>
								</div>

								<!--end::Page Heading-->
							</div>
							<!--end::Info-->
						</div>
					</div>
					<!--end::Subheader-->


					<!--begin::Entry-->
					<div class="d-flex flex-column-fluid">
						<!--begin::Container-->
						<div class="container ">
							<div class="row align-items-center justify-content-center">
								<div class="col-md-6">
									<!--begin::Card-->
									<div class="card card-custom gutter-b">
										<div class="card-header">
											<h3 class="card-title">Record Payment</h3>
											<div class="card-toolbar">
												<div class="example-tools justify-content-center">
													<a href="lending_company/released_loan.php" class="btn btn-secondary">
														<< Back</a>
												</div>
											</div>
										</div>
										<!--begin::Form-->

										
											<?php
											$loan_app_id = intval($_GET['loan_app_id']);
											$lender_id = $_SESSION['user_id'];

											$sql = "SELECT loan_application.*, user.* FROM loan_application INNER JOIN user ON loan_application.debtor_id = user.user_id 
											WHERE loan_application.loan_app_id = '$loan_app_id'";
											$query = $dbh->prepare($sql);
											$query->execute();
											$loan = $query->fetch();

											$sql = "SELECT * FROM loan_application WHERE loan_app_id = '$loan_app_id'";
											$query = $dbh->prepare($sql);
											$query->execute();
											$loanApp = $query->fetch();
											$monthlyPayment = $loanApp['monthly_payment'];
											//print(monthlyPayment);
											

											$todaysMonth = date("m/Y"); 
											$sql = "SELECT * FROM `loan_payment_detail` WHERE loan_app_id = $loan_app_id && DATE_FORMAT(due_date,'%c/%Y') = $todaysMonth";
											$query = $dbh->prepare($sql);
											$query->execute();
											$currentPayment = $query->fetch();

											

											
											//print_r($todaysMonth);

											$sql = "SELECT * FROM running_balance WHERE loan_app_id = $loan_app_id";
											$query = $dbh->prepare($sql);
											$query->execute();
											$loan2 = $query->fetch();

											$loan2['monthly_pay'] = $monthlyPasDuePayAmt;

											$loan['late_charge'] = $monthlyPasDuePayCharge;

											$advancePayment = 0;
											//$paymSemi = $loanPaymentSelected['status'];
											//echo '<script>alert('.$paymSemi.')</script>';
											if ($loanPaymentSelected['status'] == -1)
											{
												//$loan2['payment'] = $loanPaymentSelected['semi_payment1'];
												$advancePayment1 = $loanPaymentSelected['semi_payment1'];
												$loan['monthly_payment'] = $loan['monthly_payment'] - $advancePayment1;
												$TotalAllMonthDue = $TotalAllMonthDue - $advancePayment1;

											}

											//$monthlyPasDuePayAmt = 0;
											//$monthlyPasDuePayCharge 
											?>
											<div class="card-body">
												<div class="alert alert-custom alert-default" role="alert">
													<div class="alert-text">
														<h6>LOAN ACCOUNT NO:&nbsp;&nbsp;<span class="text-primary font-weight-bolder"><?= $loan['loan_app_id'] ?></span></h6>
														<label class="text-lg">Name:&nbsp;&nbsp;<?= $loan['firstname'] . ' ' . $loan['middlename'] . ' ' . $loan['lastname'] ?></label></br>
														<label class="text-lg">Remaining Balance:&nbsp;&nbsp;Php <?= number_format($loan2['remaining_balance'], 2) ?></label>
														<div class="separator separator-dashed mt-2 mb-2"></div>

														<!-- PAST DUE -->
														<h6 class="text-sm">PAST DUE: </h6>
														<div class="col-md-12 bg-light text-center">
															<table class="table table-borderless">
																<thead>
																	<!-- <tr>
																		<th>Application Date</th>
																	</tr> -->
																</thead>
																<tbody>
																	<tr>
																		<td><label class="text-lg">Monthly Payable</label></td>
																		<?php 
																		if ($monthlyPasDuePayAmt == 0)
																		{
																			$noMonthDue = 0;
																		}
																		?>
																		<td><?= $pastamount = number_format($loan2['monthly_pay'], 2) ?> (<?= $noMonthDue ?> Month/s)</td>
																	</tr>
																	<tr>
																		<td><label class="text-lg">Late Charge</td>

																		<td><label class="text-lg"><?= $late1 =  number_format($loan['late_charge'], 2) ?> (<?= $noMonthDue ?> Month/s)</td>
																	</tr>
																	<tr>
																		<td><label class="text-lg">Advance Payment(Bi-Monthly)</td>

																		<td><label class="text-lg"><?= $advance1  =  number_format($pasDueAdvance, 2) ?> </td>
																	</tr>
																</tbody>
															</table>
														</div>
														<div class="col-md-12 bg-light text-right">
															<label class="text-info font-weight-bolder text-right">Past Due Amount:&nbsp;&nbsp;

															<?= 
															 number_format($totalPasDueAmount,2);
															/*
																$past = $pastamount; 
																$past2 = ($past * $noMonthDue) + $late1;
																$total1 = $past2 - $advance1;
																*/
															?>
															</label>
														</div>

														<!-- CURRENT DUE -->
														<h6 class="text-sm">CURRENT DUE:</h6>
														<div class="col-md-12 bg-light text-center">
															<table class="table table-borderless">
																<thead>
																	<!-- <tr>
																		<th>Application Date</th>
																	</tr> -->
																</thead>
																<tbody>
																	<tr>
																		<td><label class="text-lg">Monthly Payable</label></td>

																		<td><?= $currentamount =  number_format($loan['monthly_payment'], 2) ?></td>
																	</tr>
																	<tr>
																		<td><label class="text-lg">Advance Payment(Bi-Monthly)</td>

																		<td><label class="text-lg"><?= $advance2 = number_format($advancePayment1, 2) ?></td>
																	</tr>
																</tbody>
															</table>
														</div>
														<div class="col-md-12 bg-light text-right">
															<label class="text-info font-weight-bolder text-right">Current Due Amount:&nbsp;&nbsp;
																<?= 
																$current = $currentamount; 
																$total2 = ($current - $advance2);
																?>
															</label>
														</div>
														<div class="col-md-12 bg-light text-right">
															<label class="text-danger font-weight-bolder text-right">TOTAL AMOUNT DUE:&nbsp;&nbsp;
																<?php
																	//if () 
																?>
																<?=
																	$monthly_pay = number_format(($TotalAllMonthDue+ ($loan['monthly_payment'] - $advancePayment1)), 2);

																?>
															</label>
														</div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-3 col-form-label">Payment For</label>
													<div class="col-9">
													<form method="POST" action="">
														<select id='payId' name='payId' class='form-control' onchange="this.form.submit()">
														   <!-- <option value=''hidden>*** SELECT ***</option> -->
															<?php 
																$loan_app_id = intval($_GET['loan_app_id']);
																$sql = "SELECT * FROM loan_payment_detail WHERE loan_app_id = $loan_app_id";
																$query = $dbh->prepare($sql);
																$query->execute();
																$results = $query->fetchAll(PDO::FETCH_OBJ);

																foreach ($results as $res) {
																	 $id =  $res->lp_Id;
																	 $date = date("F j, Y",strtotime($res->due_date));
																	 $status =  $res->status;

																	 if ($status != 1)
																	 {
																		?> 
																		<option value='<?=  $id ?>' <?php  if($dtId == $id){ echo 'selected';}  ?>><?= htmlentities($date);?></option>
																	<?php
																	} ?>
																	<?php
																}
															?>
														</select>
													</form>	
													<?php 
														 
													?>
													<input name="loan_app_id" id='loan_app_id' class="form-control" type="number" value='<?= $loan_app_id; ?>' hidden />
													</div>
												</div>
												<div class="form-group row">
												<label class="col-3 col-form-label">Payment Type</label>
													<div class="col-9">
														  <input type="radio" id="semiPayment" name="payment_type" value="semi" onchange='onPaymentOption(this)'>
														  <label for="semiPayment">Semi-Monthly</label>
														  <input type="radio" id="fullPayment" name="payment_type" value="full" onchange='onPaymentOption(this)'>
														  <label for="fullPayment">Monthly</label>
													</div>
												</div>
												<div class="form-group row">
														<label class="col-3 col-form-label">Date Paid</label>
															<div class="col-9">
																<input name="date_paid" id='date_paid' class="form-control" type="datetime-local" id="example-datetime-local-input" onchange='checkDue()'/>
																<input type="hidden" id='pasDueIds' name="pasDueIds" value="<?= $pasDueIds ?>">
																<input type="hidden" id='no_pas_due' name="no_pas_due" value="<?= $noMonthDue ?>">
																<input type="hidden" id='monthly_pay' name="monthly_pay" value="<?= $loan2['monthly_pay'] ?>">
																<input type="hidden" id='start_date' name="start_date" value="<?= $loan2['start_date'] ?>">
																<input type="hidden" id='end_date' name="end_date" value="<?= $loan2['end_date'] ?>">
																<input type="hidden" id='remaining_balance' name="remaining_balance" value="<?= $loan2['remaining_balance'] ?>">
																<input type="hidden" id='debtor_id' name="debtor_id" value="<?= $debtor_id ?>">
																<input type="hidden" id='lender_id' name="lender_id" value="<?= $lender_id ?>">
																<input type="hidden" id='lateCharges' name="lateCharges" value="<?= $lateCharges ?>">
																<input type="hidden" id='Total' name="Total" value="<?= $monthly_pay ?>">
																<input type="hidden" id='monthlyPaymentLoan' name="monthlyPaymentLoan" value="<?= $monthlyPaymentLoad ?>">
																<input type="hidden" id='lateChargesFee' name="lateChargesFee" value="<?= $lateChargesFee ?>">
																<input type="hidden" id='loan_status' name="loan_status" value="<?= $selectedDateDue ?>">
																<?php
																	date_default_timezone_set('Asia/Manila');
																	$todays_date = date("y-m-d h:i:sa");
																	$today = strtotime($todays_date);
																	$det = date('Y-m-d h:i:sa', $today);
																	?>
																<input type="hidden" id='date_message' name="date_message" value="<?= $det; ?>">
															</div>
														
												</div>
												<div class="form-group row">
													<label class="col-3 col-form-label">Amount Paid</label>
													<div class="col-9">
														<input name="payment" id='paymentAmount' class="form-control" type="number" value='<?= ($TotalAllMonthDue+ ($loan['monthly_payment'] - $advancePayment1)); ?>' required />
													</div>
												
												</div>
												<div class="form-group row">
													<div class='col-12' style="margin-top: 10px;">
															<div class="card-footer border-0 d-flex align-items-center justify-content-between pt-0">
																<span></span>
																<button type="submit" name="pay" onclick='OnRecordPayment()' class="btn btn-md btn-primary font-weight-bolder px-6">Submit</button>
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
				<!--end::Content-->




				<!--begin::Footer-->
				<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
					<!--begin::Container-->
					<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
						<!--begin::Copyright-->
						<div class="text-dark order-2 order-md-1">
							<span class="text-muted font-weight-bold mr-2">2021©</span>
							<a href="https://keenthemes.com/keen" target="_blank" class="text-dark-75 text-hover-primary">Hulam</a>
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
					<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= $_SESSION['company_name']?></a>
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



	<!--begin::Sticky Toolbar-->

	<!--end::Sticky Toolbar-->

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
	<!--begin::Page Scripts(used by this page)-->
	<script src="assets/admin/js/pages/features/charts/apexcharts.js"></script>
	<!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>


<script type='text/javascript'>

	function OnRecordPayment()
	{
		var payment = $('#paymentAmount').val();
		var payId = $('#payId').val();
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		var remaining_balance = $('#remaining_balance').val();
		var date_message = $('#date_message').val(); 
		var date_paid = $('#date_paid').val();
		var no_pas_due = $('#no_pas_due').val();
		var monthly_pay = $('#monthly_pay').val();
		var loan_app_id = $('#loan_app_id').val();
		var pasDueIds = $('#pasDueIds').val();
		var lender_id = $('#lender_id').val();
		var debtor_id = $('#debtor_id').val();
		var lateCharges = $('#lateCharges').val();
		var monthlyPaymentLoan = $('#monthlyPaymentLoan').val();
        var paymentType = document.querySelector('input[name="payment_type"]:checked').value;
		var tempAmt = $('#tempAmt').val();
		
		
		var formData = new FormData();

		//var payAmt = (payment - lateCharges);
		
		formData.append("loan_app_id",loan_app_id);
		formData.append("payment",payment);
		formData.append("payId",payId);
		formData.append("start_date",end_date);
		formData.append("end_date",end_date);
		formData.append("remaining_balance",remaining_balance);
		formData.append("date_message",date_message);
		formData.append("date_paid",date_paid);
		formData.append("no_pas_due",no_pas_due);
		formData.append("pasDueIds",pasDueIds);
		formData.append("lender_id",lender_id);
		formData.append("monthly_pay",tempAmt);
		formData.append("debtor_id",debtor_id);
		formData.append("amount",payment);
		formData.append("lateCharges",lateCharges);
		formData.append("paymentType",paymentType);
		formData.append("monthlyPaymentLoan",monthlyPaymentLoan);
		


		console.log("loan_app_id : "+loan_app_id);
		console.log("payment : "+payment);
		console.log("payId : "+payId);
		console.log("start_date : "+start_date);
		console.log("end_date : "+end_date);
		console.log("remaining_balance : "+remaining_balance);
		console.log("date_message : "+date_message);
		console.log("date_paid : "+date_paid);
		console.log("no_pas_due : "+no_pas_due);
		console.log("pasDueIds : "+pasDueIds);
		console.log("lender_id : "+lender_id);
		console.log("monthly_pay : "+tempAmt);
		console.log("debtor_id : "+debtor_id);
		console.log("amount : "+payment);
		console.log("lateCharges : "+lateCharges);
		console.log("paymentType : "+paymentType);
		console.log("monthlyPaymentLoan : "+monthlyPaymentLoan);

		//alert(payAmt);

		

		if (payment < 0 )//|| payment > monthly_pay)
		{
			alert('Amount Not Valid!');
			return;
		}
		else if (String(date_paid)  == 'undefined')
		{
			alert('Date Not Valid!');
			return;
		}

		var url = "/hulam/lending_company/logic.php?Action=pay";

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			//document.getElementById("demo").innerHTML =
			console.log(xhttp);
			var ret = this.responseText;
				if (ret == 1)
				{
					alert("Success!");
					window.location = "/hulam/lending_company/view_released.php?loan_app_id="+loan_app_id;
				}
			}
		};
		xhttp.open("POST", url, true);
		xhttp.send(formData);
				//alert('test');
		//*/
		
	}

	function checkDue()
	{
		var payId = $('#payId').val();
		var selectedDate =  $('#date_paid').val();
		var DueDateSelectedDate =  $('#currentPaymentMonth').val();
		var amtAmount = $('#paymentAmount').val();
		var monthly_pay = $('#monthly_pay').val();
		var lateCharges = $('#lateCharges').val();
		var lateChargesFee = $('#lateChargesFee').val();
		var monthlyPaymentLoan = $('#monthlyPaymentLoan').val();
		var no_pas_due = $('#no_pas_due').val();
		var loan_status = $('#loan_status').val();
		var Total = $('#Total').val();
		
		
	
		//$('#tempAmt').val(amtAmount);
		//alert(no_pas_due);

		try{
			var paymentType = document.querySelector('input[name="payment_type"]:checked').value;

			if (paymentType == 'semi')
			{
				if (no_pas_due == 0)
				{
					if (loan_status == -1)
					{
						var url = "/hulam/lending_company/logic.php?Action=GetDueDateById&Id="+payId;

						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
							//document.getElementById("demo").innerHTML =
							console.log(xhttp);
							var retDueDate = this.responseText;
							var dtSelected =  new Date(selectedDate);
							var dtDue =  new Date(retDueDate);
								
								if (dtSelected > dtDue)
								{
									if (dtSelected.getDay() != dtDue.getDay())
									{
										alert('Payment Over Due!\nAdditional '+lateChargesFee);


										$('#paymentAmount').val(parseFloat(monthlyPaymentLoan / 2)+parseFloat(lateChargesFee));
										
									}
									else
									{
										$('#paymentAmount').val(monthlyPaymentLoan /2);
										
									}
									
								}
								else
								{
									$('#paymentAmount').val(monthlyPaymentLoan /2);
								}
							}
						};
						xhttp.open("POST", url, true);
						xhttp.send();

						return;
					}

					var amtToPay = monthlyPaymentLoan / 2;
					$('#paymentAmount').val(amtToPay);
					return;
					//console.log("TEST "+amtToPay);
				}
				else if (no_pas_due > 0)
				{
					
					document.querySelector('input[name="payment_type"]:checked').checked = false;
					alert('Opps! Semi-Monthly not Available\nYou have past due!');
					//document.querySelector('input[name="payment_type"]').value = false;
					//document.getElementByName("payment_type").checked = false;
					return;
				}

				
			} 
		    else if (paymentType == 'full')
			{
				var url = "/hulam/lending_company/logic.php?Action=GetDueDateById&Id="+payId;

						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
							//document.getElementById("demo").innerHTML =
							console.log(xhttp);
							var retDueDate = this.responseText;
							var dtSelected =  new Date(selectedDate);
							var dtDue =  new Date(retDueDate);
								
								if (dtSelected > dtDue)
								{
									if (dtSelected.getDay() != dtDue.getDay())
									{
										alert('Payment Over Due!\nAdditional '+lateChargesFee);


										$('#paymentAmount').val(parseFloat(amtAmount)+parseFloat(lateChargesFee));
										
									}
									else
									{
										$('#paymentAmount').val(amtAmount);
										
									}
									
								}
								else
								{
									$('#paymentAmount').val(amtAmount);
								}
							}
						};
						xhttp.open("POST", url, true);
						xhttp.send();

						return;
			}
		}catch{
			//var selectedDate =  $('#date_paid').val();
			alert('Please select payment type!');
			
			$('#date_paid').val(selectedDate);
			return;
		}

		
		//alert('naabot diris');
		var url = "/hulam/lending_company/logic.php?Action=GetDueDateById&Id="+payId;

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			//document.getElementById("demo").innerHTML =
			console.log(xhttp);
			var retDueDate = this.responseText;
			var dtSelected =  new Date(selectedDate);
			var dtDue =  new Date(retDueDate);
				
				if (dtSelected > dtDue)
				{
					if (dtSelected.getDay() != dtDue.getDay())
					{
						alert('Payment Over Due!\nAdditional '+lateChargesFee);


						$('#paymentAmount').val(parseFloat(monthlyPaymentLoan)+parseFloat(lateChargesFee));
						
					}
					else
					{
						$('#paymentAmount').val(monthlyPaymentLoan);
						
					}
					
				}
				else
				{
					$('#paymentAmount').val(monthlyPaymentLoan);
				}
			}
		};
		xhttp.open("POST", url, true);
		xhttp.send();

	
	}

	function onPaymentOption(e)
	{
		var no_pas_due = $('#no_pas_due').val();
		//var origValueAmt = $('#monthlyPaymentLoan').val();
	   
		var res = e.value;
		if (res == "semi")
		{
			if (no_pas_due > 0)
			{
				alert('Semi-Monthly Payment Not Valid!\nYou have a past due.');
				//var result = origValueAmt /2;
				//$('#paymentAmount').val(result)
				document.querySelector('input[name="payment_type"]:checked').checked = false;
				document.getElementById('fullPayment').checked = true;// querySelector('input[id="fullPayment"]:checked').checked = true;
			}

		}
		else
		{
			//$('#paymentAmount').val($('#monthlyPaymentLoan').val());
			
		}
		
	
	}
</script>