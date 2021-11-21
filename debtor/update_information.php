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

<?php
if (isset($_POST['upload_photo'])) {
	$user_id = $_SESSION['user_id'];

	$images = $_FILES['profile_pic']['name'];
	$tmp_dir = $_FILES['profile_pic']['tmp_name'];
	$imageSize = $_FILES['profile_pic']['size'];

	$upload_dir = '../assets/keen/hulam_media/';
	$imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
	$valid_extensions = array('jpeg', 'jpg', 'gif', 'pdf', 'doc', 'docx');
	$profile_pic = rand(1000, 10000000) . "." . $imgExt;
	move_uploaded_file($tmp_dir, $upload_dir . $profile_pic);

	$update = "UPDATE user SET profile_pic = :profile_pic WHERE user_id = $user_id";
	$update_query = $dbh->prepare($update);
	$update_query->bindParam(':profile_pic', $profile_pic, PDO::PARAM_STR);
	$update_query->execute();

	if ($update_query) {
		$_SESSION['status_profile'] = "Updated Profile Photo!";
		header("location: update_information.php");
		exit();
	} else {
		$_SESSION['status_profile'] = "Error!";
		header("location: update_information.php");
		exit();
	}
}
?>
<?php
if (isset($_POST['valid_id'])) {
	$user_id = $_SESSION['user_id'];

	$images = $_FILES['valid_id']['name'];
	$tmp_dir = $_FILES['valid_id']['tmp_name'];
	$imageSize = $_FILES['valid_id']['size'];

	$upload_dir = '../assets/keen/hulam_media/';
	$imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
	$valid_extensions = array('jpeg', 'jpg', 'gif', 'pdf', 'doc', 'docx');
	$valid_id = rand(1000, 10000000) . "." . $imgExt;
	move_uploaded_file($tmp_dir, $upload_dir . $valid_id);

	$sql = "SELECT * FROM debtors_info WHERE user_id = $user_id";
	$query = $dbh->prepare($sql);
	$query->execute();
	if ($query->rowCount() == 0) {
		$insert = "INSERT INTO debtors_info(user_id,valid_id)VALUES(:user_id,:valid_id)";
		$insert_query = $dbh->prepare($insert);
		$insert_query->bindParam(':user_id', $user_id, PDO::PARAM_STR);
		$insert_query->bindParam(':valid_id', $valid_id, PDO::PARAM_STR);
		$insert_query->execute();
	} else {
		$update = "UPDATE debtors_info SET valid_id = :valid_id WHERE user_id = $user_id";
		$insert_query = $dbh->prepare($update);
		$insert_query->bindParam(':valid_id', $valid_id, PDO::PARAM_STR);
		$insert_query->execute();
	}
	if ($insert_query) {
		$_SESSION['status_profile'] = "Updated Profile Photo!";
		header("location: update_information.php");
		exit();
	} else {
		$_SESSION['status_profile'] = "Error!";
		header("location: update_information.php");
		exit();
	}
}
?>
<?php
if (isset($_POST['selfie_id'])) {
	$user_id = $_SESSION['user_id'];

	$images = $_FILES['selfie_id']['name'];
	$tmp_dir = $_FILES['selfie_id']['tmp_name'];
	$imageSize = $_FILES['selfie_id']['size'];

	$upload_dir = '../assets/keen/hulam_media/';
	$imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
	$valid_extensions = array('jpeg', 'jpg', 'gif', 'pdf', 'doc', 'docx');
	$selfie_id = rand(1000, 10000000) . "." . $imgExt;
	move_uploaded_file($tmp_dir, $upload_dir . $selfie_id);

	$sql = "SELECT * FROM debtors_info WHERE user_id = $user_id";
	$query = $dbh->prepare($sql);
	$query->execute();
	if ($query->rowCount() == 0) {
		$insert = "INSERT INTO debtors_info(user_id,selfie_id)VALUES(:user_id,:selfie_id)";
		$insert_query = $dbh->prepare($insert);
		$insert_query->bindParam(':user_id', $user_id, PDO::PARAM_STR);
		$insert_query->bindParam(':selfie_id', $selfie_id, PDO::PARAM_STR);
		$insert_query->execute();
	} else {
		$update = "UPDATE debtors_info SET selfie_id = :selfie_id WHERE user_id = $user_id";
		$insert_query = $dbh->prepare($update);
		$insert_query->bindParam(':selfie_id', $selfie_id, PDO::PARAM_STR);
		$insert_query->execute();
	}
	if ($insert_query) {
		$_SESSION['status_profile'] = "Updated Selfie ID!";
		header("location: update_information.php");
		exit();
	} else {
		$_SESSION['status_profile'] = "Error!";
		header("location: update_information.php");
		exit();
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<base href="../">
	<meta charset="utf-8" />
	<title>Update Information</title>
	<meta name="description" content="Updates and statistics" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link href="assets/keen/css/pages/wizard/wizard-2.css" rel="stylesheet" type="text/css" />
	<link href="assets/keen/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/keen/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/keen/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/keen/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="assets/keen/media/logos/Hulam_Logo.png" />
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading" style="background-image: url('assets/keen/media/logos/banner2.png')">
	<div id="kt_header_mobile" class="header-mobile header-mobile-fixed">
		<a href="debtor/index.php">
			<img alt="Logo" src="assets/keen/media/logos/h_logo2.png" class="max-h-30px" />
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
					<a href="debtor/index.php" class="nav-item ">
						<span class="nav-label px-10">
							<span class="nav-title text-dark-75 font-weight-bold font-size-h4">&nbsp;&nbsp;&nbsp;&nbsp&nbsp;HOME</span>
						</span>
					</a>
					<a href="debtor/update_information.php" class="nav-item active">
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
                <!--end::Nav-->
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

		<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="background-image:url('assets/keen/media/logos/banner.png')">
			<div class="gutter-b" id="kt_breadcrumbs">
				<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<div class="d-flex align-items-center flex-wrap mr-1">
						<div class="d-flex align-items-baseline flex-wrap mr-5">
							<h2 class="text-white font-weight-bold my-1 mr-5">UPDATE INFORMATION</h2>
						</div>
					</div>
					<div class="d-flex align-items-center">

					</div>
				</div>
			</div>
			<div class="d-flex flex-column-fluid">
				<div class="container">
					<div class="card card-custom">
						<div class="card-body p-0">
							<div class="wizard-body py-8 px-8 py-lg-20 px-lg-10">
								<div class="row">
									<div class="offset-xxl-2 col-xxl-8">
										<?php if (isset($_GET['e']) && $_GET['e'] != '') : ?>
											<div class="alert alert-danger text-center">
												<?= $_GET['e'] ?>
											</div>
										<?php endif; ?>
										<?php
										if (isset($_SESSION['status_profile'])) {
										?>
											<div class="alert alert-success alert-dismissable" id="flash-msg">
												<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
												<h4><?= $_SESSION['status_profile'] ?></h4>
											</div>
										<?php
											unset($_SESSION['status_profile']);
										} ?>
										<h4 class="mb-10 font-weight-bold text-dark">Update Your Information</h4>
										<form action="" method="post" id="kt_form" enctype="multipart/form-data">
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label text-right"></label>
												<div class="col-lg-9 col-xl-6">
													<div class="image-input image-input-outline" id="kt_image_1">
														<div class="image-input-wrapper" style="background-image: url(/hulam/assets/keen/hulam_media/<?= $user['profile_pic']?>"></div>
														<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="upload photo">
															<i class="fa fa-pen icon-sm text-muted" style="margin-left: 27px;"></i>
															<!-- <input type="file" name="profile" accept=".png, .jpg, .jpeg" /> -->
															<input type="file" name="profile_pic" class="form-control" accept="*/image">
															<input type="hidden" name="profile_avatar_remove" />
														</label>
														<span class="btn btn-xs btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel Photo">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
													</div>
													&nbsp;&nbsp;<button type="submit" name="upload_photo" class="btn btn-primary btn-sm">confirm photo</button>
												</div>
											</div>
										</form>
										<form action="debtor/logic/update_information.php" method="post" id="kt_form">
											<div class="row">
												<div class="col-lg-4">
													<div class="form-group">
														<label>Last Name</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" name="lname" required value="<?= isset($_GET['e']) ? $_GET['lname'] : $_SESSION['lastname'] ?>" />
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group">
														<label>First Name</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" name="fname" required value="<?= isset($_GET['e']) ? $_GET['fname'] : $_SESSION['firstname'] ?>" />
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group">
														<label>Middle Name</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" name="mname" required value="<?= isset($_GET['e']) ? $_GET['mname'] : $_SESSION['middlename'] ?>" />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-4">
													<div class="form-group">
														<label>Gender</label> <span class="text-danger">*</span>
														<select name="gender" class="form-control" required>
															<option value="<?= $user['gender']?>"><?= $user['gender']?></option>
															<option value="Male" <?php if (isset($_GET['e'])) {
																						if ($_GET['gender'] == 'Male') {
																							echo 'selected';
																						}
																					} else {
																						if ($_SESSION['gender'] == 'Male') {
																							echo 'selected';
																						}
																					} ?>>Male</option>
															<option value="Female" <?php if (isset($_GET['e'])) {
																						if ($_GET['gender'] == 'Female') {
																							echo 'selected';
																						}
																					} else {
																						if ($_SESSION['gender'] == 'Female') {
																							echo 'selected';
																						}
																					} ?>>Female</option>
														</select>
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Email Address</label> <span class="text-danger">*</span>
														<input type="email" class="form-control" required value="<?= $_SESSION['email'] ?>" disabled />
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Date Of Birth</label> <span class="text-danger">*</span>
														<input type="date" class="form-control" required name="b_day" value="<?= isset($_GET['e']) ? $_GET['b_day'] :  $user['b_day'] ?>" />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-4">
													<div class="form-group">
														<label>Mobile</label> <span class="text-danger">*</span>
														<input maxlength="11" minlength="11" type="text" required="required" class="form-control" required name="mobile" placeholder="0900000000" value="<?= isset($_GET['e']) ? $_GET['mobile'] :  $_SESSION['mobile']?>"/>
														<label><span style="color:green">&#x2714;</span><span style="font-family: Courier New; font-size: 11px"> Atleast 11 digits</label></span>
				
													</div>

												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Landline</label> <span class="text-danger">*</span>
														<input maxlength="7" minlength="7" type="text" class="form-control" name="landline" placeholder="0000000" value="<?= isset($_GET['e']) ? $_GET['landline'] :  $user['landline'] ?>" placeholder="Enter landline number" />
														<label><span style="color:green">&#x2714;</span><span style="font-family: Courier New; font-size: 11px"> Atleast 7 digits.</label></span>
													</div>
												</div>
											</div>
											<h4 class="mb-10 font-weight-bold text-dark">Setup Your Location</h4>
											<div class="row">
												<div class="col-xl-6">
													<div class="form-group">
														<h6>Current Address</h6>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-4">
													<div class="form-group">
														<label>Street</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" name="c_street" value="<?= isset($_GET['e']) ? $_GET['c_street'] : $user['c_street'] ?>" placeholder="Enter street" />
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Barangay</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" required name="c_barangay" value="<?= isset($_GET['e']) ? $_GET['c_barangay'] : $user['c_barangay'] ?>" placeholder="Enter barangay" />
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>City/Municipality</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" required name="c_city" value="<?= isset($_GET['e']) ? $_GET['c_city'] : $user['c_city'] ?>" placeholder="Enter city" />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-4">
													<div class="form-group">
														<label>Province</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" required name="c_province" value="<?= isset($_GET['e']) ? $_GET['c_province'] : $user['c_province'] ?>" placeholder="Enter barangay" />
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Zip Code</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" required name="c_zipcode" value="<?= isset($_GET['e']) ? $_GET['c_zipcode'] : $user['c_zipcode'] ?>" placeholder="Enter zipcode" />
														<label><span style="color:green">&#x2714;</span><span style="font-family: Courier New; font-size: 11px"> Atleast 4 digits</label></span>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-6">
													<div class="form-group">
														<h6>Permanent Address</h6>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-4">
													<div class="form-group">
														<label>Street</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" name="p_street" value="<?= isset($_GET['e']) ? $_GET['p_street'] : $user['p_street'] ?>" placeholder="Enter street" />
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Barangay</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" required name="p_barangay" value="<?= isset($_GET['e']) ? $_GET['p_barangay'] : $user['p_barangay'] ?>" placeholder="Enter barangay" />
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>City/Municipality</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" required name="p_city" value="<?= isset($_GET['e']) ? $_GET['p_city'] :$user['p_city'] ?>" placeholder="Enter city" />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-4">
													<div class="form-group">
														<label>Province</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" required name="p_province" value="<?= isset($_GET['e']) ? $_GET['p_province'] : $user['p_province'] ?>" placeholder="Enter province" />
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Zip Code</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" required name="p_zipcode" value="<?= isset($_GET['e']) ? $_GET['p_zipcode'] : $user['p_zipcode'] ?>" placeholder="Enter zipcode" />
														<label><span style="color:green">&#x2714;</span><span style="font-family: Courier New; font-size: 11px"> Atleast 4 digits</label></span>
													</div>
												</div>
											</div>
											<h4 class="mb-10 font-weight-bold text-dark">Source of Income</h4>
											<?php
											$user_id = $_SESSION['user_id'];

											$sql = "SELECT * FROM debtors_info WHERE user_id = $user_id";
											$query = $dbh->prepare($sql);
											$query->execute();
											$set = $query->fetch();
											?>
											<div class="row">
												<div class="col-xl-4">
													<div class="form-group">
														<label>Company Name</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" required name="company_name" value="<?= isset($_GET['e']) ? $_GET['company_name'] : $set['company_name'] ?>" placeholder="Enter company name" />
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Monthly Salary<span class="text-danger">*</span>
															<input type="number" class="form-control" required name="monthly_salary" value="<?= isset($_GET['e']) ? $_GET['monthly_salary'] : $set['monthly_salary'] ?>" placeholder="Enter company name" />
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Mobile No.<span class="text-danger">*</span>
															<input maxlength="11" minlength="11" type="text" class="form-control" required name="company_mobile" value="<?= isset($_GET['e']) ? $_GET['company_mobile'] : $set['company_mobile'] ?>" placeholder="Enter company mobile" />
															<label><span style="color:green">&#x2714;</span><span style="font-family: Courier New; font-size: 11px"> Atleast 11 digits</label></span>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-4">
													<div class="form-group">
														<label>Landline No.</label> <span class="text-danger">*</span>
														<input maxlength="7" minlength="7" type="text" class="form-control" required name="company_landline" value="<?= isset($_GET['e']) ? $_GET['company_landline'] : $set['company_landline'] ?>" placeholder="Enter company landline" />
														<label><span style="color:green">&#x2714;</span><span style="font-family: Courier New; font-size: 11px"> Atleast 7 digits</label></span>
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Email Address.</label>
														<input type="text" class="form-control" required name="company_email" value="<?= isset($_GET['e']) ? $_GET['company_email'] : $set['company_email'] ?>" placeholder="Enter company email" />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-6">
													<div class="form-group">
														<h6>Company Address</h6>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-4">
													<div class="form-group">
														<label>Street</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" name="company_street" value="<?= isset($_GET['e']) ? $_GET['company_street'] : $set['company_street'] ?>" placeholder="Enter street" />
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Barangay</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" required name="company_barangay" value="<?= isset($_GET['e']) ? $_GET['company_barangay'] : $set['company_barangay'] ?>" placeholder="Enter barangay" />
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>City/Municipality</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" required name="company_city" value="<?= isset($_GET['e']) ? $_GET['company_city'] : $set['company_city'] ?>" placeholder="Enter city" />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-4">
													<div class="form-group">
														<label>Province</label> <span class="text-danger">*</span>
														<input type="text" class="form-control" required name="company_province" value="<?= isset($_GET['e']) ? $_GET['company_province'] : $set['company_province'] ?>" placeholder="Enter city" />
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Zip Code</label> <span class="text-danger">*</span>
														<input maxlength="4" minlength="4" type="text" class="form-control" required name="company_zipcode" value="<?= isset($_GET['e']) ? $_GET['company_zipcode'] : $set['company_zipcode'] ?>" placeholder="Enter zipcode" />
														<label><span style="color:green">&#x2714;</span><span style="font-family: Courier New; font-size: 11px"> Atleast 4 digits</label></span>
													</div>
												</div>
											</div>
											<h4 class="mb-10 font-weight-bold text-dark">Identity Verification</h4>
											<div class="row">
												<div class="col-xl-6">
													<div class="form-group">
														<h6>Relatives Contact</h6>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-4">
													<div class="form-group">
														<label>Fullname:</label>
														<input type="text" class="form-control" name="rel_name" value="<?= isset($_GET['e']) ? $_GET['rel_name'] : $set['rel_name'] ?>" />
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Mobile No:</label>
														<input maxlength="11" minlength="11" type="text" class="form-control" name="rel_mobile" value="<?= isset($_GET['e']) ? $_GET['rel_mobile'] : $set['rel_mobile'] ?>" />
														<label><span style="color:green">&#x2714;</span><span style="font-family: Courier New; font-size: 11px"> Atleast 11 digits</label></span>
													</div>
												</div>
												<div class="col-xl-4">
													<div class="form-group">
														<label>Relation:</label>
														<input type="text" class="form-control" name="rel_type" value="<?= isset($_GET['e']) ? $_GET['rel_type'] : $set['rel_type'] ?>" />
													</div>
												</div>
											</div>
											<div class="d-flex justify-content-between border-top mt-5 pt-10">
											<div></div>
											<div>
												<button type="submit" name="submit" class="btn btn-success font-weight-bolder px-10 py-3">Submit</button>
											</div>
										</div>
										</form>
										<div class="separator separator-solid my-7"></div>
										<div class="row">
											<h5>Upload Requirements</h5>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Type of Documents</th>
														<th>Uploaded Documents</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Valid ID</br>
															<span class="text-muted font-size-sm">UMID/SSS ID, PASSPORT ID, NATIONAL ID</span>
															<p class="text-muted font-size-sm">Accept files docx, jpeg, png, pdf</p>
														</td>
														<td><a href="/hulam/assets/keen/hulam_media/<?= $set['valid_id']?>" target="_blank"><?= $set['valid_id']; ?></a></td>
														<td><a href="" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#valid_id">Update</a></td>
													</tr>
													<tr>
														<td>Selfie Holding Your ID</br>
															<span class="text-muted font-size-sm">Hold your ID just below your chin and take photo.</span>
															<p class="text-muted font-size-sm">Accept files docx, jpeg, png, pdf</p>
														</td>
														<td><a href="/hulam/assets/keen/hulam_media/<?= $set['selfie_id']?>" target="_blank"><?= $set['selfie_id']?></a></td>
														<td><a href="" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#bselfie">Update</a></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									
									
									<!-- Start Modal -->
									<form action="" method="post" enctype="multipart/form-data">
										<div class="modal fade" id="valid_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered modal-md" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Upload VALID ID</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<i aria-hidden="true" class="ki ki-close"></i>
														</button>
													</div>
													<div class="col-xl-4">
														<!-- <label class="font-weight-bolder font-size-lg" for="input-username">Upload/Edit Valid ID</label> -->
														<div class="form-group">
															<input type="file" name="valid_id" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm mt-3" />
														</div>
													</div>
													<div class="modal-footer">
														<button type="submit" name="valid_id" class="btn btn-primary font-weight-bold">Save changes</button>
													</div>
												</div>
											</div>
										</div>
									</form>
									<!-- End Modal -->
									<!-- Start Modal -->
									<form action="" method="post" enctype="multipart/form-data">
										<div class="modal fade" id="bselfie" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered modal-md" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Upload SELFIE HOLDING YOUR ID</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<i aria-hidden="true" class="ki ki-close"></i>
														</button>
													</div>
													<div class="col-xl-4">
														<!-- <label class="font-weight-bolder font-size-lg" for="input-username">Upload/Edit Selfie Holding Your ID</label> -->
														<div class="form-group">
															<input type="file" name="selfie_id" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm mt-3" />
														</div>
													</div>
													<div class="modal-footer">
														<button type="submit" name="selfie_id" class="btn btn-primary font-weight-bold">Save changes</button>
													</div>
												</div>
											</div>
										</div>
									</form>
									<!-- End Modal -->
							</div>
						</div>
					</div>
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