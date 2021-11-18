<?php
session_start();
error_reporting(0);
include('../db_connection/config.php');

if ($_SESSION['user_type'] != 2) {
	header('location: ../index.php');
}?>

<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE user_id =$user_id";
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
	<title>Loan Information</title>
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
			<div class="container flex-wrap flex-sm-nowrap">
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
					<a href="debtor/index.php" class="nav-item ">
						<span class="nav-label px-10">
							<span class="nav-title text-dark-75 font-weight-bold font-size-h4">&nbsp;&nbsp;&nbsp;&nbsp&nbsp;HOME</span>
						</span>
					</a>
					<a href="debtor/update_information.php" class="nav-item">
						<span class="nav-label px-10">
							<span class="nav-title text-dark-75 font-weight-bold font-size-h4">UPDATE INFORMATION</span>
						</span>
					</a>
					<a href="debtor/loan_information.php" class="nav-item active">
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
				<!--end::Nav-->
			</div>

			<!--begin::Topbar-->
			<div class="topbar">
				<!--begin::Chat-->
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

			<div class="d-flex flex-column-fluid">
				<div class="container">
					<div class="card card-custom gutter-b card-stretch">
					<div class="card card-custom gutter-b">
						<div class="card-body">
							<div class="d-flex">
								<div class="flex-shrink-0 mr-7">
									<h4 class="font-weight-bolder">Loan Account NO: <?= $loan['loan_app_id']; ?></h4>
									<span>Lending Account Name:&nbsp;<?= $loan['company_name'] ?> </span>
								</div>
								<div class="flex-grow-1">
									<div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
										<div class="mr-3">
											<!-- <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $loan['firstname'] ?></a> -->
										</div>
										<div class="my-lg-0 my-1">
											<a href="" class="btn btn-sm btn-primary font-weight-bolder" data-toggle="modal" data-target="#upload_payment"></data-target> Upload Proof of Payment</a>
										</div>
									</div>
								</div>
							</div></br>
							<div class="d-flex align-items-center">
								<div class="d-flex flex-column">
									<a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Loan Information
									</a>
									<span class="font-weight-bolder text-primary">
										<?php
										date_default_timezone_set('Asia/Manila');
										$todays_date = date("y-m-d h:i:sa");
										$today = strtotime($todays_date);
										$det = date("F-m-Y h:i:sa", $today);

										?>
										as of <?= $det ?></span>
								</div>
							</div>
							<div class="d-flex align-items-center flex-wrap">
								<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
									<div class="d-flex flex-column text-dark-75">
										<span class="font-weight-bolder font-size-lg">Remaining Balance: &nbsp; PHP
											<?php
											$user_id = $_SESSION['user_id'];
											$loan_app_id = $loan['loan_app_id'];

											$sql = "SELECT * FROM loan_payment WHERE loan_app_id = :loan_app_id";
											$query = $dbh->prepare($sql);
											$query->bindParam(':loan_app_id',$loan_app_id,PDO::PARAM_STR);
											$query->execute();
											$loan_pay = $query->fetch();
											echo number_format($loan_pay['remaining_balance'], 2);
											?>
										</span>
									</div>
								</div>
								<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
									<div class="d-flex flex-column text-dark-75">
										<span class="font-weight-bolder font-size-lg">Previous Balance:
											<?php
											$late_charge = $loan_pay['late_charge'];
											$overdue_charge = $loan_pay['overdue_charge'];
											$total_overdue = $late_charge + $overdue_charge;
											echo number_format($total_overdue, 2)
											?>
										</span>
									</div>
								</div>
								<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
									<div class="d-flex flex-column text-dark-75">
										<span class="font-weight-bolder font-size-lg">Current Balance:&nbsp; PHP
										<?php
											$monthly_payable = $loan_pay['monthly_payable'];
											$monthly_interest = $loan_pay['monthly_interest'];
											$total_current = $monthly_payable + $monthly_interest;
											echo number_format($total_current, 2);
											?>
										</span>
									</div>
								</div>
								<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
									<div class="d-flex flex-column text-dark-75">
										<span class="font-weight-bolder font-size-lg">Total Amount Due:&nbsp; PHP
											<?php
											$totalamount = $total_overdue + $total_current;
											echo number_format($total_current, 2) 
											?>
										</span>
										<span class="font-weight-bolder text-primary">
											<?php
											if($query->rowCount()==0){
												echo 0.00;
											}else{
												date_default_timezone_set('Asia/Manila');
												$nextdate = strtotime($loan_pay['monthly_due_date']);
												$det2 = date("F-m-Y", $nextdate);
											
											}
											 ?>
											Next due date: <?= $det2 ?></span>
											</div>
										</div>
									</div>
								</div>
							</div>
				

							<!-- begin: display modal of upload payment -->
							<form action="" method="post" enctype="multipart/form-data">
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
												<?php
													date_default_timezone_set('Asia/Manila');
													$todays_date = date("y-m-d h:i:sa");
													$today = strtotime($todays_date);
													$det = date("Y-m-d h:i:sa", $today);

													?>
													<input type="hidden" name="upload_date" value="<?= $det; ?>">
													<input type="hidden" name="loan_app_id" value="<?= $loan['loan_app_id']?>">
													<input type="hidden" name="lender_id" value="<?= $loan['lender_id']?>">
													<input type="file" name="receipt" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm" />
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" name="" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
											<button type="submit" name="upload_payment" class="btn btn-light-info font-weight-bold">Submit</button>
										</div>
									</div>
								</div>
							</div>
							</form>
		
						<!--end: display modal of upload payment -->
						<div class="separator separator-dashed mt-8 mb-5"></div>
						<!--begin::Body-->
						<div class="card-body pt-4">
							<div class="card card-custom">
								<div class="card-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Loan Account No</th>
												<th>Lending Investor</th>
												<th>Total Loan Amount</th>
												<th>Loan Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$user_id = $_SESSION['user_id'];

											$sql = "SELECT * FROM loan_application INNER JOIN user ON loan_application.lender_id = user.user_id WHERE loan_application.debtor_id = $user_id";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											if ($query->rowCount() > 0) {
												foreach ($results as $res) {
											?>
													<tr>
														<th scope="row"><?= htmlentities($res->loan_app_id); ?></th>
														<td><?= htmlentities($res->company_name); ?></td>
														<td><?= number_format(htmlentities($res->total_amount), 2); ?></td>
														<td><?php 
															$red = htmlentities($res->loan_status);
															if($red =="Approved"):?>
																<span class="btn btn-info btn-shadow font-weight-bold">Approved</span>
															<?php elseif($red == "Pending"): ?>
																<span class="btn btn-warning btn-shadow font-weight-bold">Pending</span>
															<?php elseif($red == "Released"): ?>
																<span class="btn btn-success btn-shadow font-weight-bold">Released</span>
															<?php else: ?>
																<span class="btn btn-warning btn-shadow font-weight-bold">Pending</span>
															<?php endif; ?>
														</td>
														<td>
															<div class="dropdown dropdown-inline">
																<a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">
																	<span class="svg-icon svg-icon-md">
																	<i class="flaticon2-gear text-primary"></i></span></a>
																<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
																	<ul class="navi flex-column navi-hover py-2">
																		<li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">
																			Choose an action:
																		</li>
																		<li class="navi-item"> 
																			<?php
																			$red = htmlentities($res->loan_status);
																			if($red =="Approved"):?>
																				<a href="debtor/view_approved_application.php?loan_app_id=<?= htmlentities($res->loan_app_id); ?>" class="navi-link"> <span class="navi-icon"><i class="la la-print"></i></span> <span class="navi-text">Loan Details</span> </a> </li>
																			<?php elseif($red == "Released"): ?>
																				<a href="debtor/view_released_loan.php?loan_app_id=<?= htmlentities($res->loan_app_id); ?>" class="navi-link"> <span class="navi-icon"><i class="la la-print"></i></span> <span class="navi-text">Loan Details</span> </a> </li>
																			<?php elseif($red =="Pending"): ?>
																				<a href="debtor/view_pending_application.php?loan_app_id=<?= htmlentities($res->loan_app_id); ?>" class="navi-link"> <span class="navi-icon"><i class="la la-print"></i></span> <span class="navi-text">Loan Details</span> </a> </li>
																			<?php else: ?>
																				<a href="debtor/view_pending_application.php?loan_app_id=<?= htmlentities($res->loan_app_id); ?>" class="navi-link"> <span class="navi-icon"><i class="la la-print"></i></span> <span class="navi-text">Loan Details</span> </a> </li>
																			<?php endif; ?>
																		<li class="navi-item"> 
																			<a href="debtor/running_balance.php?loan_app_id=<?= htmlentities($res->loan_app_id); ?>" class="navi-link"> <span class="navi-icon"><i class="la la-copy"></i></span> <span class="navi-text">Running Balance</span> </a> </li>
																		<li class="navi-item"> 
																			<a href="debtor/view_statement.php?loan_app_id=<?= htmlentities($res->loan_app_id); ?>" class="navi-link"> <span class="navi-icon"><i class="la la-file-excel-o"></i></span> <span class="navi-text">Statement of Account</span> </a> </li>
																		<li class="navi-item"> 
																			<a href="debtor/rating.php?lender_id=<?php echo htmlentities($res->lender_id); ?>" class="navi-link"> <span class="navi-icon"><i class="la la-file-text-o"></i></span> <span class="navi-text">Rate this Investor</span> </a> </li>
																		<!-- <li class="navi-item"> <a href="#" class="navi-link"> <span class="navi-icon"><i class="la la-file-pdf-o"></i></span> <span class="navi-text">PDF</span> </a> </li> -->
																		<li class="navi-item"> 
																			<a href="debtor/view_payment2.php?loan_app_id=<?php echo htmlentities($res->loan_app_id); ?>" class="navi-link"> <span class="navi-icon"><i class="la la-file-text-o"></i></span> <span class="navi-text">Payment History</span> </a> </li>
																	</ul>
																</div>
															</div>
														</td>
													</tr>
												</tbody>
										<?php }
											} ?>
									</table>
								</div>
							</div>
						</div>
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
										<input type="file" name="file" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm" />
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

	</div>
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
								<span class="navi-text text-muted text-hover-primary"><?= $_SESSION['email']?></span>
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
	<!--begin::Demo Panel-->
	<div id="kt_demo_panel" class="offcanvas offcanvas-right p-10">

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
