<?php
session_start();
error_reporting(0);
include('../db_connection/config.php');

if($_SESSION['user_type'] != 2) {
	header('location: ../index.php');
}?>


<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE user_id =$user_id";
$query = $dbh->prepare($sql);
$query->execute();
$user = $query->fetch();
?>

<?php 
//$loan_app_id = intval($_GET['loan_app_id']);

// $sql = "SELECT loan_application.*, user.* FROM loan_application INNER JOIN user ON loan_application.lender_id = user.user_id WHERE loan_application.loan_app_id = $loan_app_id AND loan_application.status= 'approved'";
// $query = $dbh->prepare($sql);
// $query->execute();
// $run = $query->fetch();


?>

<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head><base href="../">
		<meta charset="utf-8" />
		<title>Loan Information: Running Balance</title>
		<meta name="description" content="Updates and statistics" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
        <!--begin::Page Custom Styles(used by this page)-->
		<link href="assets/keen/css/pages/wizard/wizard-2.css" rel="stylesheet" type="text/css" />
		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="assets/keen/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="assets/keen/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/keen/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/keen/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="assets/keen/media/logos/Hulam_Logo.png" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile header-mobile-fixed">
			<!--begin::Logo-->
			<a href="debtor/index.php">
				<img alt="Logo" src="assets/keen/media/logos/h_logo2.png" class="max-h-30px" />
			</a>
			<!--end::Logo-->

			<!-- TOOL BAR -->
			
		</div>
		<!--end::Header Mobile-->


		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->

				<!--begin::Subheader-->
				<div class="subheader bg-white h-100px" id="kt_subheader">
						<div class="container flex-wrap flex-sm-nowrap" >
							<!--begin::Logo-->
							<div class="d-none d-lg-flex align-items-center flex-wrap w-250px">
								<!--begin::Logo-->
								<a href="debtor/index.php">
									<img alt="Logo" src="assets/keen/media/logos/h_logo2.png" class="max-h-50px" />
								</a>
								<!--end::Logo-->
							</div>
							<!--end::Logo-->
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
								<a href="debtor/payment_information.php" class="nav-item">
									<span class="nav-label px-5">
										<span class="nav-title text-dark-75 font-weight-bold font-size-h4">PAYMENT INFORMATION</span>
									</span>
								</a>
							</div>
						</div>
						
						<!--begin::Topbar-->
						<div class="topbar">
							<!--begin::Chat-->
							<div class="topbar-item mr-1">
								<div class="btn btn-icon btn-hover-transparent-black btn-clean btn-lg" data-toggle="modal" data-target="#kt_chat_modal">
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
							<!--begin::Quick panel-->
							<div class="topbar-item mr-1">
									<div class="btn btn-icon btn-clean btn-lg" id="kt_quick_panel_toggle">
										<span class="svg-icon svg-icon-xl svg-icon-primary">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
													<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</div>
								</div>
								<!--end::Quick panel-->
							<!--begin::User-->
							<div class="topbar-item mr-3">
								<div class="btn btn-icon btn-hover-transparent-black w-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
									<span class="svg-icon svg-icon-xl svg-icon-primary">
										<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="48px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
												<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</div>
							</div>
							<!--end::User-->
							</div>
						<!--end::Topbar-->
					</div>
					<!--end::Subheader-->

						<!--begin::Content-->

						<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="background-image:url('assets/keen/media/logos/banner.png')">
						<?php
							$loan_id = $_GET['loan_app_id'];
							$sql = "SELECT * FROM loan_application INNER JOIN user ON loan_application.lender_id = user.user_id WHERE loan_app_id = $loan_id;";
							$query = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($query);
							// echo "<pre>";
							// print_r($result);

							
						?>
						<div class="d-flex flex-column-fluid" >
							<div class="container" >
								<div class="card card-custom gutter-b card-stretch" >
									<div class="card-header border-0 pt-6">
										<h3 class="card-title align-items-start flex-column">
											<span class="card-label font-weight-bolder font-size-h4 text-dark-75">Running Balance Information</span>
										</h3>
									</div>
									<!--begin::Body-->
									<?php
										
									?>
									<div class="card-body pt-4">
										<div class="card card-custom">
											<div class="card-body">
								
												<h5 style="color:royalblue"> Running Balance to: <?php echo $result[29]; ?> &nbsp;Loan </h5>
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
														
														$months = array("","January","February","March","April","May","June","July","August","September","October","November","December");
														$numOfMonths = count($months);
														//$numOfMonths;
														////////////////////////////////////////////////////////////
														$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id;";
														$query = mysqli_query($conn, $sql);
														$result = mysqli_fetch_row($query);
														$monthlyPayment = $result[7];
														$balance = $result[6];
														// echo "<pre>";
														// print_r($result);
														// echo "</pre>";
														///////////////////////////////////////////////////////////
														//$date = date("m"); //11
														$date = 12; // if 2 months // remember this is a month // 13 - 2 = 11 // $numberOfMonths - $date = 11//
														//echo $date;
														$testTotal = ($numOfMonths - $date); //2 //13 - 2 //1
														///////////////////////////////////////////////////////////
														// if()

														///////////////////////////////////////////////////////////
														$monthLending = $result['4'];
														$monthLeft = $monthLending - $testTotal; // 6 - 

														if($monthLeft < 0){
															$testTotal = $monthLending;
															//echo "Apol";
														}

														//echo "Month Left: ".$monthLeft; //-5
														//if($monthLeft)
														//echo "Total: ".$testTotal; //2
														$counter = 0;
														//echo $numOfMonths;
														
														$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
														$counterMonth = 6; //- 5 = 1
														$cMonth = 0; //= 8;

														//

														// $query = $dbh->prepare($sql);
														// $query->execute();
														// $results = $query->fetchAll(PDO::FETCH_OBJ);
														// if($query->rowCount() > 0){
														// 	foreach($results as $result){
															
															while($testTotal > $counter ){
																$balance -= $monthlyPayment;
														?>
														<tr>
															<td><?php echo $months[$date]; ?></td>
															<td><?php echo "N/A"; ?></td>
															<td><?php echo "N/A"; ?></td>
															<td><?php echo $result[7]; ?></td>
															<td><?php echo $balance; ?></td>
															
															<!-- <th scope="row">
															<?php 
															// $date = date("y-m-d");
															// $approval_date = "2022-01-01";
															// while(strtotime($approval_date)<=strtotime($date)){
															// 	echo date("F-Y",strtotime($date));
															// 	$date = date("y-m-d",strtotime("+1 month",strtotime($date)));
															// }?>
															</th>
															<td><?= $m = htmlentities($result->monthly_payment)-(htmlentities($result->total_interest)/htmlentities($result->loan_term));?></td>
															<td><?= $in = htmlentities($result->total_interest)/htmlentities($result->loan_term);?></td>
															<td><?= $total = $m + $in; ?></td>
															<td><?= htmlentities($result->total_amount)-$total ?></td> -->
														</tr>
														<?php $date++; $counter++;}?>

														<?php
															$monthCounter = 1;
															if($monthLeft > 0){
																while($monthLeft >= $monthCounter){
																	$balance -= $monthlyPayment;
																	echo "
																		<tr>
																			<td>".$months[$monthCounter]."</td>
																			<td>N/A</td>
																			<td>N/A</td>
																			<td>".$monthlyPayment."</td>
																			<td>".$balance."</td>
																		</tr>
																	";
																	$monthCounter++;
																}
															}
														?>
													</tbody>
													
												</table></br><!--
												<div class="separator separator-dashed mt-8 mb-5"></div>
												<h5> Pending Loan Application</h5>
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>Loan Date</th>
															<th>Lending Investor</th>
															<th>Principal Amount</th>
															<th>Running Balance</th>
															<th>Monthly Payable</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$sql ="SELECT loan_application.*, user.* FROM loan_application INNER JOIN user ON loan_application.lender_id = user.user_id WHERE loan_application.debtor_id = $user_id AND loan_application.status ='pending'";
														$query = $dbh->prepare($sql);
														$query->execute();
														$results=$query->fetchAll(PDO::FETCH_OBJ);
														$cnt=1;

														if($query->rowCount() > 0)
														{  
															foreach($results as $result)
															{
														?>
														<tr>
															<th scope="row"><?php echo htmlentities($result->date);?></th>
															<td><?php echo htmlentities($result->company_name);?></td>
															<td><?php echo htmlentities($result->total_amount);?></td>
															<td><?php echo htmlentities($result->monthly_payable);?></td>
															
															<td><a href="">cancel</a></td>
														</tr>
														<?php }}?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									--!>

										<!-- display modal of Statement of Account details -->
										<div class="modal fade" id="soa" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
												<div class="modal-content">
													<!-- Modal Header -->
													<div class="modal-header">
														<div class="kt-portlet__head-label">
															<h3 class="kt-portlet__head-title"><?php echo $get['fullname'];?></h3>&nbsp;&nbsp;
															<span>Loans - Statement of Account</span>
														</div>
														<div class="kt-portlet__head-toolbar">
															<div class="kt-portlet__head-toolbar-wrapper">
																<div class="dropdown dropdown-inline">
																	<button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<i class="flaticon-more-1"></i>
																	</button>
																	<div class="dropdown-menu dropdown-menu-right">
																		<ul class="kt-nav">
																			<li class="kt-nav__section kt-nav__section--first">
																				<span class="kt-nav__section-text">Export Tools</span>
																			</li>
																			<li class="kt-nav__item">
																				<a href="payee/payeeinfo.php?payeeid=<?php echo $get22['payeeid'];?>" onclick="download_employeedetails_as_csv('employeedetails');" class="kt-nav__link">
																					<i class="kt-nav__link-icon la la-file-text-o"></i>
																					<span class="kt-nav__link-text">CSV</span>
																				</a>
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--begin: Datatable -->

													<!--begin::Content-->
													<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
														<!--begin::Breadcrumbs-->
														<div class="gutter-b" id="kt_breadcrumbs">
															<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
																<!--begin::Info-->
																<div class="d-flex align-items-center flex-wrap mr-1">
																	
																</div>
																<!--end::Info-->

															
															</div>
														</div>
														<!--end::Breadcrumbs-->
														<!--begin::Entry-->
														<div class="d-flex flex-column-fluid">
															<!--begin::Container-->
															<div class="container">
																<!-- begin::Card-->
																<div class="card card-custom overflow-hidden">
																	<div class="card-body p-0">
																		<!-- begin: Invoice-->
																		<!-- begin: Invoice header-->
																		<div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0" style="background-image: url(assets/keen/media/misc/bg-3.jpg);">
																			<div class="col-md-9">
																				<div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
																				<div class="d-flex flex-column flex-root">
																					<h2 class="display-4 text-white font-weight-boldest mb-4">STATEMENT OF ACCOUNT</h2>
																					<h6 class="text-white mb-2">Hulam Online Lending System</h6>
																					</div>
																					<div class="d-flex flex-column align-items-md-end px-0">
																						<!--begin::Logo-->
																						<a href="#" class="mb-5">
																							<img src="assets/keen/media/logos/h_small.png" alt="" />
																						</a>
																						<!--end::Logo-->
																						<span class="text-white d-flex flex-column align-items-md-end opacity-70">
																							<span>Mactan, Lapu-Lapu City </span>
																							<span>Cebu 6015</span>
																						</span>
																					</div>
																				</div>
																				<div class="border-bottom w-100 opacity-20"></div>
																				<div class="d-flex justify-content-between text-white pt-6">
																					<div class="d-flex flex-column flex-root">
																					<span class="font-weight-bolder mb-2">LOAN ACCOUNT NO.</span>
																						<span class="opacity-70">HL000014</span><br />
																						<span class="font-weight-bolde mb-2r">LOAN DATE</span>
																						<span class="opacity-70">Sept 17, 2021</span><br />
																						<span class="font-weight-bolder mb-2">FIRST MONTHLY AMORTIZATION</span>
																						<span class="opacity-70">December 05, 2021</span>
																					</div>
																					<div class="d-flex flex-column flex-root">
																						<span class="font-weight-bolder mb-2">DEBTOR DETAILS</span>
																						<span class="opacity-70">Aname Perdiguez</span>
																						<span class="opacity-70">Phone: 09454909530</span><br />
																						<span class="font-weight-bolder mb-2">ADDRESS</span>
																						<span class="opacity-70">Isuya, Mactan Lapu-Lapu City Cebu 6015</span>
																					</div>
																					<div class="d-flex flex-column flex-root">
																						<span class="font-weight-bolder mb-2">LENDER DETAILS</span>
																						<span class="opacity-70">ASIA LINK FINANCE CORPORATION</span>
																						<span class="opacity-70">Phone: 09454909530</span><br />
																						<span class="font-weight-bolder mb-2">ADDRESS</span>
																						<span class="opacity-70">Isuya, Mactan Lapu-Lapu City Cebu 6015</span>
																					</div>
																				</div>
																			</div>
																		</div>
																		<!-- end: Invoice header-->
																		<!-- begin: Invoice body-->
																		<div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
																			<div class="col-md-9">
																			<label class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">As of September 20, 2021</label></br>
																				<!-- <div class="table-responsive"> -->
																						<table class="table">
																						<thead style="background-color:DodgerBlue;">
																							<label class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">PAST DUE</lable>
																							<tr>
																								<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Principal Amount</th>
																								<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Interest Rate</th>
																								<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Monthly Payment</th>
																								<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Penalty</th>
																								<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Amount</th>
																							</tr>
																						</thead>
																						<tbody>
																							<tr class="font-weight-boldest font-size-l">
																								<td>0</td>
																								<td>0</td>
																								<td>0</td>
																								<td>0</td>
																								<td>0</td>
																							</tr>
																						</tbody>
																						<table>
																					<table class="table">	
																						<thead style="background-color:DodgerBlue;">
																							<label class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">CURRENT DUE</lable>
																							<tr>
																								<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Principal Amount</th>
																								<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Interest Rate</th>
																								<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Monthly Payment</th>
																								<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Penalty</th>
																								<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Amount</th>
																							</tr>
																						</thead>
																						<tbody>
																							<tr class="font-weight-boldest font-size-l">
																								<!-- <td class="text-right pt-7">Principal</td> -->
																								<!-- <td class="text-danger pr-0 pt-7 text-right">9,561.23</td> -->
																								<td>10,000</td>
																								<td>100.00</td>
																								<td>933.00</td>
																								<td>0</td>
																								<td>933.00</td>
																							</tr>
																						</tbody>
																					</table>
																					<div class="d-flex flex-column text-md-right">
																						<span class="font-size-lg font-weight-bolder mb-1">TOTAL AMOUNT DUE</span>
																						<span class="font-size-h4 font-weight-boldest text-danger mb-1">933.00</span>
																						<!-- <span>Taxes Included</span> -->
																					</div>

																					<!-- begin: Invoice footer-->
																					<div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
																						<table class="table">	
																							<thead style="background-color:DodgerBlue;">
																								<label class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">CREDITED PAYMENTS</lable>
																								<tr>
																									<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase" >Date of Payment</th>
																									<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase" >Post Date</th>
																									<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Transaction No.</th>
																									<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Transaction Date</th>
																									<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Payment Method</th>
																									<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Amount</th>
																								</tr>
																							</thead>
																							<tbody>
																								<tr class="font-weight-boldest font-size-l ">
																									<td>09-20-2021</td>
																									<td>09-22-2021</td>
																									<td>HL012345</td>
																									<td>09-20-2021</td>
																									<td>Palawan Pawnshop</td>
																									<td>933.00</td>
																								</tr>
																							</tbody>
																						</table>
																					</div>
																					<div class="d-flex flex-column text-md-right">
																						<span class="font-size-lg font-weight-bolder mb-1">TOTAL PAID AMOUNT</span>
																						<span class="font-size-h4 font-weight-boldest text-danger mb-1">933.00</span>
																					
																					</div>
																					<div class="d-flex flex-column text-md-right">
																						<span class="font-size-lg font-weight-bolder mb-1">REMAINING BALANCE</span>
																						<span class="font-size-h4 font-weight-boldest text-danger mb-1">10,267.00</span>
																					</div>
																			</div>
																		</div>
																			<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
																				<div class="col-md-9">
																					<div class="d-flex justify-content-between">
																						<button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download SOA</button>
																						<button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Print SOA</button>
																					</div>
																				</div>
																			</div>
																			<!-- end: Invoice action-->
																			<!-- end: Invoice-->
																		</div>
																	</div>
																	<!-- end::Card-->
																</div>
																<!--end::Container-->
															</div>
															<!--end::Entry-->
														</div>
														<!--end::Content-->
													<!-- modal footer -->
													<div class="modal-footer">
														<button type="button" class="btn btn-light-primary font-weight-bold py-4" data-target="#upload_payment" data-toggle="modal">Upload Payment Receipt</button>
														<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
													</div>
													<!-- end footer -->
												</div> <!--modal header-->	
											</div> <!--modal header-->
										</div>
										<!--modal end-->


													<!-- Status Loan Application -->
													<div class="modal fade" id="view_status" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
														<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
															<div class="modal-content">
																<!-- Modal Header -->								
																<div class="row">
																	<div class="col-xxl-12">
																		<!--begin::List Widget 5-->
																		<div class="card card-custom card-stretch gutter-b">
																			<!--begin::Header-->
																			<div class="card-header border-0 pt-5">
																				<h3 class="card-title align-items-start flex-column">
																					<span class="card-label font-weight-bolder font-size-h4 text-dark-75">Loan Application Timeline</span>
																				</h3>
																			</div>
																			<!--end::Header-->
																			<!--begin::Body-->
																			<div class="card-body pt-6">
																				<div class="tab-content mt-5" id="myTabList5">
																					<!--begin::Tap pane-->
																					<div class="tab-pane fade show active" id="kt_tab_list_5_2" role="tabpanel" aria-labelledby="kt_tab_list_5_2">
																						<!--begin::Timeline-->
																						<div class="timeline timeline-5">
																							<div class="timeline-items">
																								<!--begin::Item-->
																								<div class="timeline-item">
																									<!--begin::Icon-->
																									<div class="timeline-media bg-light-primary">
																										<span class="svg-icon svg-icon-primary svg-icon-md">
																											<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
																											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																													<rect x="0" y="0" width="24" height="24" />
																													<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
																													<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
																												</g>
																											</svg>
																											<!--end::Svg Icon-->
																										</span>
																									</div>
																									<!--end::Icon-->
																									<!--begin::Info-->
																									<div class="timeline-desc timeline-desc-light-primary">
																										<span class="font-weight-bolder text-primary">Subject for Approval</span>
																										<p class="font-weight-normal text-dark-50 pt-1 pb-2">10-17-2021 8:47 PM</p>
																									</div>
																									<!--end::Info-->
																								</div>
																								<!--end::Item-->
																								<!--begin::Item-->
																								<div class="timeline-item">
																									<!--begin::Icon-->
																									<div class="timeline-media bg-light-primary">
																										<span class="svg-icon svg-icon-primary svg-icon-md">
																											<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
																											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																													<rect x="0" y="0" width="24" height="24" />
																													<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
																													<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
																												</g>
																											</svg>
																											<!--end::Svg Icon-->
																										</span>
																									</div>
																									<!--end::Icon-->
																									<!--begin::Info-->
																									<div class="timeline-desc timeline-desc-light-primary">
																										<span class="font-weight-bolder text-primary">Loan Application Submitted</span>
																										<p class="font-weight-normal text-dark-50 pt-1 pb-2">10-17-2021 8:47 PM</p>
																									</div>
																									<!--end::Info-->
																								</div>
																								<!--end::Item-->
																								<!-- modal footer -->
																								<div class="modal-footer">
																									<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																								</div>
																								<!-- end footer -->
																							</div>
																						</div>
																						<!--end::Timeline-->
																					</div>
																					<!--end::Tap pane-->
																				</div>
																			</div>
																			<!--end::Body-->
																		</div>
																		<!--end::List Widget 4-->
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--end::Row-->
												</div>
											</div>									


											<!-- begin: display modal of upload payment -->
											<div class="modal fade" id="upload_payment" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-m" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<div class="kt-portlet__head-label">
																<span class="font-weight-boldest font-size-l">Upload Proof of Payment</span>
															</div>
														</div></br>
														<div class="container">
															<div class="col-xl-6">
																<div class="form-group">
																	<input type="file" name="file" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm"/>
																</div>
															</div>
														</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!--end: display modal of upload payment -->

											<!--begin::Tab Pane-->
											<div class="tab-pane fade" id="kt_tab_mixed_2_2" role="tabpanel" aria-labelledby="kt_tab_mixed_2_2">
												<!--begin::Item-->
												<div class="d-flex align-items-center justify-content-between mb-6">
													<!--begin::Text-->
													<div class="d-flex flex-column">
														<a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Popular Authors</a>
														<span class="text-muted font-weight-bold">Most Successful</span>
													</div>
													<!--end::Text-->
													<!--begin::Progress-->
													<div class="d-flex align-items-center">
														<span class="text-muted mr-3 font-size-sm font-weight-bolder">83%</span>
														<div class="progress progress-xs min-w-65px h-5px">
															<div class="progress-bar bg-success" role="progressbar" style="width: 83%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center justify-content-between mb-6">
													<!--begin::Text-->
													<div class="d-flex flex-column">
														<a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">New Users</a>
														<span class="text-muted font-weight-bold">Awesome Users</span>
													</div>
													<!--end::Text-->
													<!--begin::Progress-->
													<div class="d-flex align-items-center">
														<span class="text-muted mr-3 font-size-sm font-weight-bolder">47%</span>
														<div class="progress progress-xs min-w-65px h-5px">
															<div class="progress-bar bg-info" role="progressbar" style="width: 47%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center justify-content-between mb-6">
													<!--begin::Text-->
													<div class="d-flex flex-column">
														<a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Top Authors</a>
														<span class="text-muted font-weight-bold">Successful Fellas</span>
													</div>
													<!--end::Text-->
													<!--begin::Progress-->
													<div class="d-flex align-items-center">
														<span class="text-muted mr-3 font-size-sm font-weight-bolder">65%</span>
														<div class="progress progress-xs min-w-65px h-5px">
															<div class="progress-bar bg-warning" role="progressbar" style="width: 65%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center justify-content-between">
													<!--begin::Text-->
													<div class="d-flex flex-column">
														<a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Active Customers</a>
														<span class="text-muted font-weight-bold">Best Customers</span>
													</div>
													<!--end::Text-->
													<!--begin::Progress-->
													<div class="d-flex align-items-center">
														<span class="text-muted mr-3 font-size-sm font-weight-bolder">71%</span>
														<div class="progress progress-xs min-w-65px h-5px">
															<div class="progress-bar bg-danger" role="progressbar" style="width: 71%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Item-->
											</div>
											<!--end::Tab Pane-->
											<!--begin::Tab Pane-->
											<div class="tab-pane fade" id="kt_tab_mixed_2_3" role="tabpanel" aria-labelledby="kt_tab_mixed_2_3">
												<!--begin::Item-->
												<div class="d-flex align-items-center justify-content-between mb-6">
													<!--begin::Text-->
													<div class="d-flex flex-column">
														<a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">New Users</a>
														<span class="text-muted font-weight-bold">Awesome Users</span>
													</div>
													<!--end::Text-->
													<!--begin::Progress-->
													<div class="d-flex align-items-center">
														<span class="text-muted mr-3 font-size-sm font-weight-bolder">47%</span>
														<div class="progress progress-xs min-w-65px h-5px">
															<div class="progress-bar bg-info" role="progressbar" style="width: 47%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center justify-content-between mb-6">
													<!--begin::Text-->
													<div class="d-flex flex-column">
														<a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Active Customers</a>
														<span class="text-muted font-weight-bold">Best Customers</span>
													</div>
													<!--end::Text-->
													<!--begin::Progress-->
													<div class="d-flex align-items-center">
														<span class="text-muted mr-3 font-size-sm font-weight-bolder">71%</span>
														<div class="progress progress-xs min-w-65px h-5px">
															<div class="progress-bar bg-danger" role="progressbar" style="width: 71%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center justify-content-between mb-6">
													<!--begin::Text-->
													<div class="d-flex flex-column">
														<a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Top Authors</a>
														<span class="text-muted font-weight-bold">Successful Fellas</span>
													</div>
													<!--end::Text-->
													<!--begin::Progress-->
													<div class="d-flex align-items-center">
														<span class="text-muted mr-3 font-size-sm font-weight-bolder">65%</span>
														<div class="progress progress-xs min-w-65px h-5px">
															<div class="progress-bar bg-warning" role="progressbar" style="width: 65%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center justify-content-between">
													<!--begin::Text-->
													<div class="d-flex flex-column">
														<a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Popular Authors</a>
														<span class="text-muted font-weight-bold">Most Successful</span>
													</div>
													<!--end::Text-->
													<!--begin::Progress-->
													<div class="d-flex align-items-center">
														<span class="text-muted mr-3 font-size-sm font-weight-bolder">83%</span>
														<div class="progress progress-xs min-w-65px h-5px">
															<div class="progress-bar bg-success" role="progressbar" style="width: 83%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Item-->
											</div>
											<!--end::Tab Pane-->
										</div>
										<!--end::Tab Content-->
									</div>
									<!--end::Body-->
								</div>
								<!--end::Mixed Widget 2-->
							</div>
						</div>
						



						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
					
					</div>						</div>
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
								<a href="http://keenthemes.com/keen" target="_blank" class="text-dark-75 text-hover-primary">The Hulam Team</a>
							</div>
							<!--end::Copyright-->
							<!--begin::Nav-->
							<div class="nav nav-dark order-1 order-md-2">
								<a href="http://keenthemes.com/keen" target="_blank" class="nav-link pr-3 pl-0">About</a>
								<a href="http://keenthemes.com/keen" target="_blank" class="nav-link px-3">Team</a>
								<a href="http://keenthemes.com/keen" target="_blank" class="nav-link pl-3 pr-0">Contact</a>
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
					<div class="symbol-label" style="background-image:url('assets/keen/hulam_media/<?= $user['profile_pic']?>')"></div>
						<i class="symbol-badge bg-success"></i>
					</div>
					<div class="d-flex flex-column">
						<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= $_SESSION['firstname'];?> <?= $_SESSION['lastname'];?></a>
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
									<span class="navi-text text-muted text-hover-primary">gregamit31@gmail.com</span>
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
					<a href="custom/apps/user/profile-1/personal-information.html" class="navi-item">
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
								<div class="text-muted">Profile info
								<span class="label label-light-danger label-inline font-weight-bold">update</span></div>
							</div>
						</div>
					</a>
					<!--end:Item-->
					<!--begin::Item-->
					<a href="custom/apps/user/profile-3.html" class="navi-item">
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
								<div class="font-weight-bold">My Tasks</div>
								<div class="text-muted">Todo and tasks</div>
							</div>
						</div>
					</a>
					<!--end:Item-->
					<!--begin::Item-->
					<a href="custom/apps/user/profile-2.html" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-primary">
										<!--begin::Svg Icon | path:assets/media/svg/icons/General/Half-star.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12,4.25932872 C12.1488635,4.25921584 12.3000368,4.29247316 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 L12,4.25932872 Z" fill="#000000" opacity="0.3" />
												<path d="M12,4.25932872 L12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.277344,4.464261 11.6315987,4.25960807 12,4.25932872 Z" fill="#000000" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold">My Events</div>
								<div class="text-muted">Logs and notifications</div>
							</div>
						</div>
					</a>
					<!--end:Item-->
					<!--begin::Item-->
					<a href="custom/apps/userprofile-1/overview.html" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-info">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3" />
												<path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold">My Statements</div>
								<div class="text-muted">latest tasks and projects</div>
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
							$sql = "SELECT * FROM message INNER JOIN user ON message.sender_id = user.user_id WHERE user.user_type!='2' AND user.user_type!='1' GROUP BY message.sender_id";
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
										<a href="debtor/send_message_investor.php?lender_id=<?= $contacts['sender_id']?>" class="text-dark text-hover-primary mb-1 font-weight-bold font-size-lg"><?= $contacts['company_name']?></a>
									</div>
										<a href="debtor/send_message_investor.php?lender_id=<?= $contacts['sender_id']?>" class="btn btn-icon btn-light btn-sm">
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
							<!-- <div class="d-flex align-items-center mb-6">
								<div class="symbol symbol-35 flex-shrink-0 mr-3">
									<img alt="Pic" src="/hulam/assets/keen/media/logos/h_small.png" />
								</div>
								<div class="d-flex flex-wrap flex-row-fluid">
									<div class="d-flex flex-column pr-2 flex-grow-1">
										<a href="debtor/send_message.php" class="text-dark text-hover-primary mb-1 font-weight-bold font-size-lg">The Hulam Team</a>
									</div>
										<a href="debtor/send_message.php" class="btn btn-icon btn-light btn-sm">
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
							</div> -->
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
		<!--begin::Demo Panel-->
		<div id="kt_demo_panel" class="offcanvas offcanvas-right p-10">
		
		</div>
		<!--end::Demo Panel-->
		<script>var HOST_URL = "https://preview.keenthemes.com/keen/theme/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="assets/keen/plugins/global/plugins.bundle.js"></script>
		<script src="assets/keen/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="assets/keen/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="assets/keen/js/pages/custom/wizard/wizard-2.js"></script>
        <!--begin::Page Scripts(used by this page)-->
		<script src="assets/keen/js/pages/features/file-upload/image-input.js"></script>
        <script src="assets/keen/js/pages/features/file-upload/dropzonejs.js"></script>
        <!--begin::Page Scripts(used by this page)-->
		<script src="assets/keen/js/pages/features/ktdatatable/base/data-local.js"></script>
		<!--end::Page Scripts-->
	</body>	
	<!--end::Body-->
</html>