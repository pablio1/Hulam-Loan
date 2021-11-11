<?php
session_start();
error_reporting(0);
include('../db_connection/config.php');

if ($_SESSION['user_type'] != 2) {
	header('location: ../index.php');
}
?>
<?php
$loan_app_id = intval($_GET['loan_app_id']);

$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
$query = $dbh->prepare($sql);
$query->execute();
$get = $query->fetch();
?>

<!--codes to insert the image -->
<?php

if (isset($_POST['save'])) {

	$loan_id = intval($_GET['loan_app_id']);
	$date_upload = date('Y-m-d');

	$images = $_FILES['profile']['name'];
	$tmp_dir = $_FILES['profile']['tmp_name'];
	$imageSize = $_FILES['profile']['size'];

	$upload_dir = '../assets/keen/receipts/';
	$imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
	$valid_extensions = array('jpeg', 'jpg', 'gif', 'pdf', 'doc', 'docx');
	$pic = rand(1000, 10000000) . "." . $imgExt;
	move_uploaded_file($tmp_dir, $upload_dir . $pic);

	$sql = "INSERT INTO loan_receipt(loan_id,images,date_upload)VALUES(:loan_id,:images,:date_upload)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':loan_id', $loan_id, PDO::PARAM_STR);
	$query->bindParam(':images', $pic, PDO::PARAM_STR);
	$query->bindParam(':date_upload', $date_upload, PDO::PARAM_STR);

	if ($query->execute()) {
?>
		<script>
			alert("added successfully");
			window.location.href = (index.php);
		</script>
	<?php
	} else {
	?>
		<script>
			alert("error");
			window.location.href = (index.php);
		</script>
<?php

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
	<script>
		function download_statement_as_csv(table_id, separator = ',') {
			// Select rows from table_id
			var rows = document.querySelectorAll('table#' + table_id + ' tr');
			// Construct csv
			var csv = [];
			for (var i = 0; i < rows.length; i++) {
				var row = [],
					cols = rows[i].querySelectorAll('td, th');
				for (var j = 0; j < cols.length; j++) {
					// Clean innertext to remove multiple spaces and jumpline (break csv)
					var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
					// Escape double-quote with double-double-quote (see https://stackoverflow.com/questions/17808511/properly-escape-a-double-quote-in-csv)
					data = data.replace(/""/g, '""');
					// Push escaped string
					row.push('"' + data + '"');
				}
				csv.push(row.join(separator));
			}
			var csv_string = csv.join('\n');
			// Download it
			var filename = 'export_' + table_id + '_' + new Date().toLocaleDateString() + '.csv';
			var link = document.createElement('a');
			link.style.display = 'none';
			link.setAttribute('target', '_blank');
			link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
			link.setAttribute('download', filename);
			document.body.appendChild(link);
			link.click();
			document.body.removeChild(link);
		}
	</script>
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
					<a href="debtor/apply_now.php" class="nav-item">
						<span class="nav-label px-10">
							<span class="nav-title text-dark-75 font-weight-bold font-size-h4">APPLY NOW</span>
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
			<!--begin::Dropdown-->
			<!--end::Topbar-->
		</div>
		<!--begin::Content-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="background-image:url('assets/keen/media/logos/banner.png')">
			<div class="d-flex flex-column-fluid">
				<div class="container">
					<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<div class="kt-portlet__head-label">
									<h3 class="kt-portlet__head-title"></h3>&nbsp;&nbsp;
									<span>Loans - Statement of Account</span>
								</div>
								<div class="kt-portlet__head-toolbar">
								<div class="my-lg-0 my-1">
									<a href="debtor/loan_information.php" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">
										<< Back</a>
								</div>
								</div>
							</div>
							<div class="container">
								<div class="card card-custom overflow-hidden">
									<div class="card-body p-0" id="view_statement">
										<div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0" style="background-image: url(assets/keen/media/misc/bg-3.jpg);">
											<div class="col-md-9">
												<div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
													<div class="d-flex flex-column flex-root">
														<h2 class="display-4 text-white font-weight-boldest mb-4">STATEMENT OF ACCOUNT
															<?php
															$loan_id = intval($_GET['loan_app_id']);
															$sql = "SELECT loan_application.*, user.* FROM loan_application INNER JOIN user ON loan_application.lender_id = user.user_id WHERE loan_application.loan_app_id = $loan_id ";
															$query = $dbh->prepare($sql);
															$query->execute();
															$res = $query->fetch();
															?>
															<?php
															$loan_id = intval($_GET['loan_app_id']);
															$sql = "SELECT loan_application.*, user.* FROM loan_application INNER JOIN user ON loan_application.debtor_id = user.user_id WHERE loan_application.loan_app_id = $loan_id";
															$query = $dbh->prepare($sql);
															$query->execute();
															$result = $query->fetch();
															?>
															<?php
															$lender_id = $res['user_id'];
															$sql = "SELECT loan_features.*, user.* FROM loan_features INNER JOIN user ON loan_features.lender_id = user.user_id WHERE loan_features.lender_id = $lender_id";
															$query = $dbh->prepare($sql);
															$query->execute();
															$rem = $query->fetch();
															?>

														</h2>
														<h4 class="text-white mb-2"><?= $res['company_name'] ?></h4>
													</div>
													<div class="d-flex flex-column align-items-md-end px-0">
														<a href="#" class="mb-2">
															<img src="assets/keen/company_logo/<?= $rem['company_logo'] ?>" alt="" width="100" height="100" class="mr-2" /><img src="assets/keen/media/logos/h_small.png" alt="" width="100" height="100" />
														</a>
														<span class="text-white d-flex flex-column align-items-md-end opacity-70">
															<span><?= $rem['company_street'] ?>
																<?= $rem['company_barangay'] ?></span>
															<span><?= $rem['company_city'] ?>
																<?= $rem['company_province'] ?>
																<span><?= $rem['company_zipcode'] ?></span>
															</span>
													</div>
												</div>
												<div class="border-bottom w-100 opacity-20"></div>
												<div class="d-flex justify-content-between text-white pt-6">
													<div class="d-flex flex-column flex-root">
														<span class="font-weight-bolder mb-2">DEBTOR DETAILS</span>
														<span class="opacity-70"><?= $result['firstname'] . ' ' . $result['middlename'] . ' ' . $result['lastname']; ?></span>
														<span class="opacity-70">Contact: <?= $result['mobile']; ?></span>
														<span class="opacity-70">Email: <?= $result['email']; ?></span><br />
														<span class="font-weight-bolder mb-2">ADDRESS</span>
														<span class="opacity-70"><?= $result['c_street'] . ' ' . $result['c_barangay'] . ' ' . $result['c_city']; ?></span>
														<span class="opacity-70"><?= $result['c_province'] . ' ' . $result['c_zipcode']; ?></span>
													</div>
													<div class="d-flex flex-column flex-root">
														<span class="font-weight-bolder mb-2">LOAN ACCOUNT NO.</span>
														<span class="opacity-70"><?= $res['loan_app_id']; ?></span><br />
														<span class="font-weight-bolde mb-2r">LOAN DATE</span>
														<span class="opacity-70"><?= $res['date']; ?></span><br />
														<span class="font-weight-bolder mb-2">LOAN TERM</span>
														<span class="opacity-70"><?= $res['loan_term']; ?>&nbsp; Month/s</span>
													</div>
													<div class="d-flex flex-column flex-root">
														<span class="font-weight-bolder mb-2">LOAN AMOUNT</span>
														<span class="opacity-70">&#8369; <?= number_format($res['total_amount'], 2); ?></span><br />
														<span class="font-weight-bolder mb-2">MONTHLY AMORTIZATION</span>
														<span class="opacity-70">&#8369; <?= number_format($res['monthly_payment'], 2); ?></span>
													</div>
												</div>
											</div>
										</div>
										<div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
											<div class="col-md-9">
												<label class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">As of <?= date('m-d-Y'); ?></label></br>
												<table class="table">
													<thead style="background-color:DodgerBlue;">
														<label class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">PAST DUE</lable>
															<tr>
																<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Total Loan Amount</th>
																<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Interest Rate</th>
																<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Monthly Payment</th>
																<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Late Charges</th>
																<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Due Date</th>
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
																<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Due Date</th>
																<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Amount</th>
															</tr>
													</thead>
													<tbody>
														<tr class="font-weight-boldest font-size-l">
															<?php
															// $principal = number_format($res['total_amount']/$res['loan_term'], 2);
															// $interest = number_format(($res['principal_amount']/$res['loan_term'])*($res['interest_rate']/100),2);
															// $monthly = $principal+$interest;

															$time = strtotime($res['released_date']);
															$final = date("Y-m-d", strtotime("+1 month", $time));
															?>
															<td><?= number_format($res['monthly_payment'] - ($res['total_interest'] / $res['loan_term']), 2); ?></td>
															<td>
																<?= number_format($res['total_interest'] / $res['loan_term'], 2) ?>
															</td>
															<td><?= number_format($res['monthly_payment'], 2); ?></td>
															<td><?= $final; ?></td>
															<td><?= number_format($res['monthly_payment'], 2); ?></td>
														</tr>
													</tbody>
												</table>
													
												<div class="d-flex flex-column text-md-right">
													<span class="font-size-lg font-weight-bolder mb-1">TOTAL AMOUNT DUE</span>
													<span class="font-size-h4 font-weight-boldest text-danger mb-1">&#8369;<?= number_format($res['monthly_payment'], 2); ?></span>
												</div>
												<div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
													<table class="table">
														<thead style="background-color:DodgerBlue;">
															<label class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">CREDITED PAYMENTS</lable>
																<tr>
																	<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Reference No.</th>
																	<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Transaction Date</th>
																	<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Remittance Name</th>
																	<th class="font-weight-boldest border-bottom-0 font-size-l text-uppercase">Amount Paid</th>
																</tr>
														</thead>
														<tbody>
															<?php
															$id = intval($_GET['loan_app_id']);

															$sql = "SELECT * FROM payment_details INNER JOIN loan_application ON loan_application.loan_app_id = payment_details.loan_id INNER JOIN user ON payment_details.remittance_id = user.user_id WHERE loan_application.loan_app_id = $id";
															$query = $dbh->prepare($sql);
															$query->execute();
															$return = $query->fetchAll(PDO::FETCH_OBJ);
															if ($query->rowCount() > 0) {
																foreach ($return as $returns) {
															?>
																	<tr class="font-weight-boldest font-size-l ">
																		<td><?= htmlentities($returns->reference_no); ?></td>
																		<td><?= htmlentities($returns->payment_date); ?></td>
																		<td><?= htmlentities($returns->firstname); ?>&nbsp;<?= htmlentities($returns->lastname); ?></td>
																		<td><?= htmlentities($returns->amount_paid); ?></td>
																	</tr>
														</tbody>
													<?php }
															} ?>
													</table>
												</div>
												<div class="d-flex flex-column text-md-right">
													<span class="font-size-lg font-weight-bolder mb-1">TOTAL AMOUNT PAID</span>
													<span class="font-size-h4 font-weight-boldest text-danger mb-1">&#8369;
														<?php

														$id = intval($_GET['loan_app_id']);

														$stmt = "SELECT SUM(amount_paid) AS value_sum FROM payment_details INNER JOIN loan_application ON payment_details.loan_id = loan_application.loan_app_id WHERE loan_application.loan_app_id  = $id";
														$st = $dbh->prepare($stmt);
														$st->execute();
														$row = $st->fetch(PDO::FETCH_ASSOC);
														$sum = $row['value_sum'];
														echo $sum;

														?>
													</span>
												</div>
												<div class="d-flex flex-column text-md-right">
													<span class="font-size-lg font-weight-bolder mb-1">REMAINING BALANCE</span>
													<span class="font-size-h4 font-weight-boldest text-danger mb-1">&#8369;
														<?php 

														$total = htmlentities($returns->total_amount);

														$remaining = $total - $sum;
														echo $remaining;
														?>
													</span>
												</div>
											</div>
										</div>
										<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
											<div class="col-md-9">
												<div class="d-flex justify-content-between">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-light-primary font-weight-bold py-4" data-toggle="modal" data-target="#upload_payment">Upload Payment Receipt</button>
							</div>
						</div>
						<!-- End Modal Content -->
					</div>
				</div>
			</div>
			<!--end::Content-->

		
		<!-- begin: display modal of upload payment -->
		<div class="modal fade" id="upload_payment" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-m" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<div class="kt-portlet__head-label">
							<span class="font-weight-boldest font-size-l">Upload Proof of Payment</span>
						</div>
					</div></br>
					<form action="" method="post" id="kt_form" enctype="multipart/form-data">
						<div class="container">
							<div class="col-xl-6">
								<div class="form-group">
									<input type="file" name="profile" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm" />
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" name="save" class="btn btn-light-primary font-weight-bold">Save</button></br>
							<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--end: display modal of upload payment -->

	

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

                    $sql = "SELECT * FROM message INNER JOIN user ON message.sender_id = user.user_id WHERE message.receiver_id = $user_id";
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

3

					<!--begin::Footer-->
					<div class="card-footer align-items-center">
						<!--begin::Compose-->
						<textarea class="form-control border-0 p-0" rows="2" placeholder="Type a message"></textarea>
						<div class="d-flex align-items-center justify-content-between mt-5">
							<div class="mr-3">
								<a href="#" class="btn btn-clean btn-icon btn-md mr-1">
									<i class="flaticon2-photograph icon-lg"></i>
								</a>
								<a href="#" class="btn btn-clean btn-icon btn-md">
									<i class="flaticon2-photo-camera icon-lg"></i>
								</a>
							</div>
							<div>
								<button type="button" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">Send</button>
							</div>
						</div>
						<!--begin::Compose-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Card-->
			</div>
		</div>
	</div>
	<!--end::Chat Panel-->
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